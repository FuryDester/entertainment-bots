<?php

namespace App\Application\Commands;

use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use Sally\VkKeyboard\Contracts\Keyboard\Button\FactoryInterface;
use Sally\VkKeyboard\Facade;
use Sally\VkKeyboard\Object\Keyboard\Button\Text;

final class QuizzesCommandExecutor extends AbstractCommandExecutor
{
    /**
     * {@inheritDoc}
     */
    public function getDescription(): string
    {
        return 'Показывает список доступных викторин';
    }

    /**
     * {@inheritDoc}
     */
    public function getUsage(): string
    {
        return 'квизы';
    }

    /**
     * {@inheritDoc}
     */
    public function getAliases(): array
    {
        return ['квизы', 'викторина', 'викторины', 'викторину', 'квиз'];
    }

    /**
     * {@inheritDoc}
     */
    public function getArguments(): array
    {
        return [];
    }

    /**
     * {@inheritDoc}
     */
    protected function execute(MessageDTO $message, array $arguments): bool
    {
        /** @var QuizServiceContract $quizService */
        $quizService = app(QuizServiceContract::class);

        // TODO: Add check for completed quizzes
        $quizzes = $quizService->getAvailableQuizzes();
        if (empty($quizzes)) {
            $this->sendMessage($message->getPeerId(), 'На данный момент доступные для прохождения викторины отсутствуют.');
            return true;
        }

        /** @var FactoryInterface $keyboardFactory */
        $keyboardFactory = app(FactoryInterface::class);
        $keyboardData = [];
        foreach ($quizzes as $quiz) {
            $keyboardData[] = [
                $keyboardFactory->text($quiz->getTitle(), [
                    'type' => 'quiz',
                    'id' => $quiz->getId(),
                ], Text::COLOR_RED),
            ];
        }

        $this->sendMessage($message->getPeerId(), 'Доступные викторины', Facade::createInlineKeyboard($keyboardData));
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function onlyForPersonalMessages(): bool
    {
        return true;
    }
}
