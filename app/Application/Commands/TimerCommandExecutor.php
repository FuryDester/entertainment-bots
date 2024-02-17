<?php

namespace App\Application\Commands;

use App\Domain\Commands\Factories\Common\CommandArgumentDTOFactoryContract;
use App\Domain\Commands\Factories\Timer\TimerJobPayloadDTOFactoryContract;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\Common\Traits\WordDeclension;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Jobs\Commands\Timer\ProcessTimerCommand;
use Illuminate\Support\Facades\Log;

final readonly class TimerCommandExecutor extends AbstractCommandExecutor
{
    use WordDeclension;

    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Установка таймера на определенное время с возможностью установки сообщения.';
    }

    /**
     * {@inheritDoc}
     */
    public function getUsage(): string
    {
        return 'таймер [время] [сообщение]';
    }

    /**
     * {@inheritDoc}
     */
    public function getAliases(): array
    {
        return ['таймер', 'timer', 'время', 'уведомление', 'уведомить', 'напомнить', 'напоминание', 'напомни'];
    }

    public function onlyForPersonalMessages(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    public function getArguments(): array
    {
        /** @var CommandArgumentDTOFactoryContract $factory */
        $factory = app(CommandArgumentDTOFactoryContract::class);

        return [
            $factory::createFromParams('время', 'Время, через которое нужно уведомить. Например: 30', true),
            $factory::createFromParams('сообщение', 'Сообщение, которое нужно отправить. Например: Пора вставать!'),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(MessageDTO $message, array $arguments): bool
    {
        $time = (int) $arguments[0]->getValue();
        if ($time <= 0) {
            $this->sendMessage($message->getPeerId(), 'Время должно быть больше 0.');

            return true;
        }

        $messageText = $arguments[1]->getValue();

        /** @var TimerJobPayloadDTOFactoryContract $timerJobFactory */
        $timerJobFactory = app(TimerJobPayloadDTOFactoryContract::class);
        $timerJobPayload = $timerJobFactory::createFromParams(
            $message->getFromId(),
            $message->getPeerId(),
            $time,
            $messageText,
        );

        ProcessTimerCommand::dispatch($timerJobPayload)->delay(now()->addMinutes($time));
        Log::info('Timer job dispatched', ['payload' => $timerJobPayload->toArray()]);

        $outputMessage = sprintf(
            'Таймер на %d %s установлен.%s',
            $time,
            $this->declension($time, ['минуту', 'минуты', 'минут']),
            $messageText ? (' Текст: '.$messageText) : '',
        );
        $this->sendMessage($message->getPeerId(), $outputMessage);

        return true;
    }
}
