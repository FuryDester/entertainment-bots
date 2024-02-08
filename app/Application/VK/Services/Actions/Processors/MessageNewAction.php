<?php

namespace App\Application\VK\Services\Actions\Processors;

use App\Domain\VK\Factories\Common\MessageContextDTOFactoryContract;
use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
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
     */
    public static function perform(CallbackRequestDTO $data): bool
    {
        /** @var MessageContextDTOFactoryContract $messageContextFactory */
        $messageContextFactory = app(MessageContextDTOFactoryContract::class);

        $messageContext = $messageContextFactory::createFromApiData($data->getObject());
        $message = $messageContext->getMessage();
        Log::info(sprintf(
            'MessageNewAction from id: %d, peerId: %d, text: %s',
            $message->getFromId(),
            $message->getPeerId(),
            $message->getText() ?: 'empty message text'
        ));

        // TODO: Remove after testing
        if (mt_rand(0, 20) === 0 && $message->getText()) {
            Log::info('MessageNewAction: random success');
            /** @var AccessTokenDTO $accessToken */
            $accessToken = app(AccessTokenDTO::class);

            $client = new VKApiClient();
            $client->messages()->send($accessToken->getAccessToken(), [
                'peer_id' => $message->getPeerId(),
                'message' => 'Попка-дурак повторяет: ' . $message->getText(),
                'random_id' => mt_rand(0, 1000000),
            ]);
        }

        return true;
    }
}
