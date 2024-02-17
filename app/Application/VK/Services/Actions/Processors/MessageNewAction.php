<?php

namespace App\Application\VK\Services\Actions\Processors;

use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Domain\Common\Services\UserServiceContract;
use App\Domain\PayloadActions\Factories\PayloadDTOFactoryContract;
use App\Domain\PayloadActions\PayloadActionServiceContract;
use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\AbstractPayloadAction;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

final readonly class MessageNewAction implements Actionable
{
    public static function getActionName(): ActionEnum
    {
        return ActionEnum::MessageNew;
    }

    /**
     * @throws Exception
     */
    public static function perform(CallbackRequestDTO $data): bool
    {
        /** @var MessageContextDTOFactoryContract $messageContextFactory */
        $messageContextFactory = app(MessageContextDTOFactoryContract::class);

        $messageContext = $messageContextFactory::createFromApiData($data->getObject());
        $message = $messageContext->getMessage();
        Log::info('MessageNewAction', [
            'message' => $message->toArray(),
        ]);

        // Process commands
        $commandResult = self::processCommands($message);
        if ($commandResult !== null) {
            Log::info('Command executed, got result', [
                'message' => $message->toArray(),
                'result' => $commandResult,
            ]);

            return true;
        }

        // Process messages with special payload
        $payloadResult = self::processPayloadMessages($message);
        if ($payloadResult !== null) {
            Log::info('Payload message executed, got result', [
                'message' => $message->toArray(),
                'result' => $payloadResult,
            ]);

            return true;
        }

        return true;
    }

    /**
     * @throws Exception
     */
    private static function processCommands(MessageDTO $message): ?bool
    {
        $commandPrefix = config('integrations.vk.command_prefix');
        if (! str_starts_with($message->getText(), $commandPrefix)) {
            return null;
        }

        $command = substr($message->getText(), strlen($commandPrefix));
        Log::info('Command line detected', [
            'command' => $command,
        ]);

        $commandInput = mb_strtolower(explode(' ', $command)[0]);
        $executors = array_filter(
            ClassFinder::getClassesInNamespace('App\Application\Commands'),
            static fn ($executor) => is_subclass_of($executor, AbstractCommandExecutor::class)
        );

        return self::tryRunExecutor($commandInput, $message, $executors);
    }

    private static function processPayloadMessages(MessageDTO $message): ?bool
    {
        $payload = $message->getPayload();
        if (! $payload) {
            return null;
        }

        $payloadData = json_decode($payload, true);
        if (! $payloadData || ! is_array($payloadData)) {
            return null;
        }

        return self::processPreparedPayload($payloadData, $message);
    }

    private static function tryRunExecutor(string $commandInput, MessageDTO $message, array $executors): ?bool
    {
        $isPersonal = config('integrations.vk.peer_id_delta') < $message->getPeerId();

        foreach ($executors as $executor) {
            /** @var AbstractCommandExecutor $executor */
            $executor = app($executor);
            if (! in_array($commandInput, $executor->getAliases())) {
                continue;
            }

            if ($isPersonal && $executor->onlyForPersonalMessages()) {
                Log::warning('Command is personal, but executor is not', [
                    'command' => $commandInput,
                    'executor' => $executor->getName(),
                    'message' => $message->toArray(),
                ]);

                return null;
            }

            Log::info('Command found', [
                'command' => $commandInput,
                'executor' => $executor->getName(),
                'text' => $message->getText(),
            ]);

            return $executor->run($message);
        }

        return null;
    }

    private static function processPreparedPayload(array $payloadData, MessageDTO $message): ?bool
    {
        $payloadValidator = Validator::make($payloadData, [
            'type' => ['required', 'string', 'in:'.implode(',', Arr::pluck(ActionStageEnum::cases(), 'value'))],
            'id' => ['nullable', 'integer'],
            'data' => ['nullable', 'array'],
        ]);

        if ($payloadValidator->fails()) {
            Log::warning('Payload validation failed', [
                'payload' => $payloadData,
                'message' => $message->toArray(),
                'errors' => $payloadValidator->errors()->toArray(),
            ]);

            return null;
        }

        /** @var PayloadDTOFactoryContract $payloadFactory */
        $payloadFactory = app(PayloadDTOFactoryContract::class);
        $payloadDTO = $payloadFactory::createFromParams(
            ActionStageEnum::from($payloadData['type']),
            $payloadData['id'] ?? null,
            $payloadData['data'] ?? null,
        );

        $payloadWorkers = config('app.payload_workers');
        foreach ($payloadWorkers as $workerClass) {
            /** @var AbstractPayloadAction $worker */
            $worker = app($workerClass);

            if ($worker->getActionName() !== $payloadDTO->getType()) {
                continue;
            }

            $user = self::getUserDto($message->getFromId(), $message->getPeerId());

            return self::tryHandleWorker($message, $worker, $user, $payloadDTO);
        }

        Log::warning('Payload worker not found', [
            'payload' => $payloadDTO->toArray(),
            'message' => $message->toArray(),
        ]);

        return null;
    }

    /**
     * Создание или получение пользователя по данным сообщения
     */
    private static function getUserDto(int $vkUserId, int $peerId): UserDTO
    {
        /** @var UserServiceContract $userService */
        $userService = app(UserServiceContract::class);
        $user = $userService->findByVkIdAndPeerId($vkUserId, $peerId);
        if (! $user) {
            /** @var UserDTOFactoryContract $userFactory */
            $userFactory = app(UserDTOFactoryContract::class);

            $user = $userFactory::createFromData([
                'vk_user_id' => $vkUserId,
                'vk_peer_id' => $peerId,
                'is_admin' => false,
                'state' => ActionStageEnum::Index->value,
            ]);
            $userService->save($user);
        }

        return $user;
    }

    private static function tryHandleWorker(
        MessageDTO $message,
        AbstractPayloadAction $worker,
        UserDTO $user,
        PayloadDTO $payload
    ): ?bool {
        /** @var PayloadActionServiceContract $payloadService */
        $payloadService = app(PayloadActionServiceContract::class);
        if (! $payloadService->canHandle($payload->getType()->value, $user)) {
            Log::warning('Payload worker cannot handle', [
                'worker' => $worker::class,
                'payload' => $payload->toArray(),
                'message' => $message->toArray(),
                'user' => $user->toArray(),
            ]);

            return null;
        }

        Log::info('Payload worker found', [
            'worker' => $worker::class,
            'payload' => $payload->toArray(),
            'message' => $message->toArray(),
            'user' => $user->toArray(),
        ]);

        return $worker->run($message, $payload, $user);
    }
}
