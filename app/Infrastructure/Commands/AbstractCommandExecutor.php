<?php

namespace App\Infrastructure\Commands;

use App\Infrastructure\Commands\DataTransferObjects\Common\CommandArgumentDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use Illuminate\Support\Facades\Log;

abstract class AbstractCommandExecutor
{
    use SendMessage;

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
     * Можно ли использовать команду в беседе или только в личных сообщениях
     *
     * @return bool - true - только в личных сообщениях, false - везде
     */
    abstract public function onlyForPersonalMessages(): bool;

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

                continue;
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

}
