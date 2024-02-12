<?php

namespace App\Infrastructure\Commands;

use App\Infrastructure\Commands\DataTransferObjects\Common\CommandArgumentDTO;
use App\Infrastructure\VK\DataTransferObjects\AccessTokenDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
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

abstract class AbstractCommandExecutor
{
    /**
     * Описание команды (что она делает)
     */
    abstract public function getDescription(): string;

    /**
     * Использование команды (как её использовать)
     */
    abstract public function getUsage(): string;

    /**
     * Алиасы команды (как можно вызвать команду)
     */
    abstract public function getAliases(): array;

    /**
     * Получение аргументов команды
     *
     * @return CommandArgumentDTO[]
     */
    abstract public function getArguments(): array;

    /**
     * Выполнение команды
     *
     * @param CommandArgumentDTO[] $arguments
     */
    abstract protected function execute(MessageDTO $message, array $arguments): bool;

    /**
     * Получение имени команды
     */
    public function getName(): string
    {
        return (new \ReflectionClass($this))->getShortName();
    }

    /**
     * Запуск команды
     */
    public function run(MessageDTO $message): bool
    {
        if (!($text = $message->getText())) {
            return false;
        }

        $text = preg_replace('/\s\s+/', ' ', trim($text));
        $parts = explode(' ', $text);
        array_shift($parts);

        $arguments = $this->getArguments();
        if (empty($arguments)) {
            Log::info("Executing command {$this->getName()} without arguments", [
                'arguments' => [],
                'message' => $message->toArray(),
            ]);
            return $this->execute($message, []);
        }

        $lastArgumentValue = [];
        foreach ($parts as $partNumber => $part) {
            if (count($arguments) - 1 <= $partNumber) {
                $lastArgumentValue[] = $part;
            }

            $arguments[$partNumber]->setValue($part);
        }
        $arguments[count($arguments) - 1]->setValue(implode(' ', $lastArgumentValue));
        Log::info("Parsed arguments from string", [
            'arguments' => $arguments,
            'message' => $message->getText(),
        ]);

        Log::info("Executing command {$this->getName()} with arguments", [
            'arguments' => $arguments,
            'message' => $message->toArray(),
        ]);
        return $this->execute($message, $arguments);
    }

    /**
     * Генерация информации о команде
     */
    public function generateInfoOutput(): string
    {
        return sprintf(
            "Команда: %s\nОписание: %s\nИспользование: %s\nАлиасы: %s",
            $this->getName(),
            $this->getDescription(),
            $this->getUsage(),
            implode(', ', $this->getAliases())
        );
    }

    /**
     * Отправка сообщения ВК
     *
     * @throws VKApiMessagesChatNotAdminException
     * @throws VKApiMessagesDenySendException
     * @throws VKApiMessagesIntentLimitOverflowException
     * @throws VKApiMessagesPrivacyException
     * @throws VKApiMessagesTooLongMessageException
     * @throws VKApiMessagesUserNotDonException
     * @throws VKApiMessagesChatUserLeftException
     * @throws VKApiMessagesMessageCannotBeForwardedException
     * @throws VKApiMessagesChatUnsupportedException
     * @throws VKApiMessagesChatUserNoAccessException
     * @throws VKApiMessagesTooManyPostsException
     * @throws VKApiMessagesChatBotFeatureException
     * @throws VKClientException
     * @throws VKApiMessagesIntentCantUseException
     * @throws VKApiMessagesCantFwdException
     * @throws VKApiMessagesUserBlockedException
     * @throws VKApiMessagesKeyboardInvalidException
     * @throws VKApiMessagesPeerBlockedReasonByTimeException
     * @throws VKApiException
     * @throws VKApiMessagesChatDisabledException
     * @throws VKApiNotFoundException
     * @throws VKApiMessagesTooLongForwardsException
     * @throws VKApiMessagesContactNotFoundException
     */
    protected function sendMessage(int $peerId, string $message, bool $disableMentions = false): void
    {
        /** @var AccessTokenDTO $accessToken */
        $accessToken = app(AccessTokenDTO::class);

        $vkClient = new VKApiClient();
        $vkClient->messages()->send($accessToken->getAccessToken(), [
            'message' => $message,
            'peer_id' => $peerId,
            'random_id' => rand(0, 10000000),
            'disable_mentions' => (int) $disableMentions,
        ]);
    }
}
