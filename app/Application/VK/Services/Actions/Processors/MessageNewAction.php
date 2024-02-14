<?php

namespace App\Application\VK\Services\Actions\Processors;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;

final class MessageNewAction implements Actionable
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
    protected static function processCommands(MessageDTO $message): bool|null
    {
        $commandPrefix = config('integrations.vk.command_prefix');
        if (!str_starts_with($message->getText(), $commandPrefix)) {
            return null;
        }

        $command = substr($message->getText(), strlen($commandPrefix));
        Log::info('Command line detected', [
            'command' => $command,
        ]);

        $commandInput = mb_strtolower(explode(' ', $command)[0]);
        $executors = ClassFinder::getClassesInNamespace('App\Application\Commands');
        $executors = array_filter(
            $executors,
            static fn ($executor) => is_subclass_of($executor, AbstractCommandExecutor::class)
        );

        return self::tryRunExecutor($commandInput, $message, $executors);
    }

    protected static function processPayloadMessages(MessageDTO $message): bool|null
    {
        return null;
    }

    private static function tryRunExecutor(string $commandInput, MessageDTO $message, array $executors): bool|null
    {
        $isPersonal = config('integrations.vk.peer_id_delta') < $message->getPeerId();

        foreach ($executors as $executor) {
            /** @var AbstractCommandExecutor $executor */
            $executor = app($executor);
            if (!in_array($commandInput, $executor->getAliases())) {
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
}
