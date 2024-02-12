<?php

namespace App\Application\VK\Services\Actions\Processors;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Exception;
use HaydenPierce\ClassFinder\ClassFinder;
use Illuminate\Support\Facades\Log;
use VK\Client\VKApiClient;
use VK\Exceptions\Api\VKApiMessagesCantFwdException;
use VK\Exceptions\Api\VKApiMessagesChatBotFeatureException;
use VK\Exceptions\Api\VKApiMessagesChatDisabledException;
use VK\Exceptions\Api\VKApiMessagesChatNotAdminException;
use VK\Exceptions\Api\VKApiMessagesChatUnsupportedException;
use VK\Exceptions\Api\VKApiMessagesChatUserLeftException;
use VK\Exceptions\Api\VKApiMessagesChatUserNoAccessException;
use VK\Exceptions\Api\VKApiMessagesContactNotFoundException;
use VK\Exceptions\Api\VKApiMessagesDenySendException;
use VK\Exceptions\Api\VKApiMessagesIntentCantUseException;
use VK\Exceptions\Api\VKApiMessagesIntentLimitOverflowException;
use VK\Exceptions\Api\VKApiMessagesKeyboardInvalidException;
use VK\Exceptions\Api\VKApiMessagesMessageCannotBeForwardedException;
use VK\Exceptions\Api\VKApiMessagesPeerBlockedReasonByTimeException;
use VK\Exceptions\Api\VKApiMessagesPrivacyException;
use VK\Exceptions\Api\VKApiMessagesTooLongForwardsException;
use VK\Exceptions\Api\VKApiMessagesTooLongMessageException;
use VK\Exceptions\Api\VKApiMessagesTooManyPostsException;
use VK\Exceptions\Api\VKApiMessagesUserBlockedException;
use VK\Exceptions\Api\VKApiMessagesUserNotDonException;
use VK\Exceptions\Api\VKApiNotFoundException;
use VK\Exceptions\VKApiException;
use VK\Exceptions\VKClientException;

final class MessageNewAction implements Actionable
{
    public static function getActionName(): ActionEnum
    {
        return ActionEnum::MessageNew;
    }

    /**
     * @throws VKApiMessagesChatNotAdminException
     * @throws VKApiMessagesDenySendException
     * @throws VKApiMessagesPrivacyException
     * @throws VKApiMessagesIntentLimitOverflowException
     * @throws VKApiMessagesTooLongMessageException
     * @throws VKApiMessagesUserNotDonException
     * @throws VKApiMessagesChatUserLeftException
     * @throws VKApiMessagesMessageCannotBeForwardedException
     * @throws VKApiMessagesChatUserNoAccessException
     * @throws VKApiMessagesChatUnsupportedException
     * @throws VKApiMessagesTooManyPostsException
     * @throws VKApiMessagesChatBotFeatureException
     * @throws VKClientException
     * @throws VKApiMessagesIntentCantUseException
     * @throws VKApiMessagesCantFwdException
     * @throws VKApiMessagesUserBlockedException
     * @throws VKApiMessagesPeerBlockedReasonByTimeException
     * @throws VKApiException
     * @throws VKApiMessagesKeyboardInvalidException
     * @throws VKApiNotFoundException
     * @throws VKApiMessagesChatDisabledException
     * @throws VKApiMessagesTooLongForwardsException
     * @throws VKApiMessagesContactNotFoundException
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
                'result' => $commandResult,
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
        $executors = array_filter($executors, static fn ($executor) => is_subclass_of($executor, AbstractCommandExecutor::class));

        foreach ($executors as $executor) {
            /** @var AbstractCommandExecutor $executor */
            $executor = app($executor);
            if (!in_array($commandInput, $executor->getAliases())) {
                continue;
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
