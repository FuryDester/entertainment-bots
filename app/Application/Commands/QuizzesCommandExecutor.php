<?php

namespace App\Application\Commands;

use App\Domain\Common\Services\UserServiceContract;
use App\Domain\PayloadActions\Factories\PayloadDTOFactoryContract;
use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Infrastructure\Commands\AbstractCommandExecutor;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use Sally\VkKeyboard\Contracts\Keyboard\Button\FactoryInterface;
use Sally\VkKeyboard\Facade;
use Sally\VkKeyboard\Object\Keyboard\Button\Text;

final readonly class QuizzesCommandExecutor extends AbstractCommandExecutor
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

        /** @var UserServiceContract $userService */
        $userService = app(UserServiceContract::class);
        $user = $userService->findByVkIdAndPeerId($message->getFromId(), $message->getPeerId());
        $quizzes = $quizService->getAvailableQuizzes($user);
        if (empty($quizzes)) {
            $this->sendMessage(
                $message->getPeerId(),
                'На данный момент доступные для прохождения викторины отсутствуют.'
            );

            return true;
        }

        $keyboard = Facade::createInlineKeyboard(static function (FactoryInterface $factory) use ($quizzes) {
            $keyboardData = [];
            /** @var PayloadDTOFactoryContract $payloadFactory */
            $payloadFactory = app(PayloadDTOFactoryContract::class);

            foreach ($quizzes as $quiz) {
                $payload = $payloadFactory::createFromParams(ActionStageEnum::QuizInfo, $quiz->getId());
                $keyboardData[] = [
                    $factory->text($quiz->getTitle(), $payload->toArray(), Text::COLOR_RED),
                ];
            }

            return $keyboardData;
        });

        $this->sendMessage($message->getPeerId(), 'Доступные викторины', ['keyboard' => $keyboard]);

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
