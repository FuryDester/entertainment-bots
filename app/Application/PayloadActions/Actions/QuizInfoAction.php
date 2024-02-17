<?php

namespace App\Application\PayloadActions\Actions;

use App\Domain\PayloadActions\Factories\PayloadDTOFactoryContract;
use App\Domain\Quiz\Services\QuizServiceContract;
use App\Domain\VK\Services\Api\UploadImageServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Traits\SecondsToHms;
use App\Infrastructure\PayloadActions\AbstractPayloadAction;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\Traits\QuizAvailability;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use Illuminate\Support\Facades\Log;
use Sally\VkKeyboard\Contracts\Keyboard\Button\FactoryInterface;
use Sally\VkKeyboard\Facade;

final class QuizInfoAction extends AbstractPayloadAction
{
    use QuizAvailability;
    use SecondsToHms;
    use SendMessage;

    public function getActionName(): ActionStageEnum
    {
        return ActionStageEnum::QuizInfo;
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleActions(): array
    {
        return [ActionStageEnum::Index, ActionStageEnum::QuizInfo];
    }

    protected function execute(MessageDTO $message, PayloadDTO $payload, UserDTO $user): bool
    {
        $id = $payload->getId();
        /** @var QuizServiceContract $quizService */
        $quizService = app(QuizServiceContract::class);

        $quiz = $quizService->getQuizById($id);
        if (! $quiz) {
            Log::warning('Quiz not found', [
                'quiz_id' => $id,
                'user' => $user->toArray(),
            ]);

            $this->sendMessage($message->getPeerId(), 'Указанный тест не найден');

            return true;
        }

        if (! $this->canStartQuiz($message, $quiz, $user)) {
            Log::warning('Quiz not available', [
                'quiz_id' => $id,
                'user' => $user->toArray(),
            ]);

            return true;
        }

        $text = $this->formQuizDescription($quiz);

        $messageData = [
            'keyboard' => $this->generateKeyboard($quiz),
        ];
        if ($quiz->getImage()) {
            /** @var UploadImageServiceContract $uploadImageService */
            $uploadImageService = app(UploadImageServiceContract::class);
            $result = $uploadImageService->uploadImage($quiz->getImage());
            if ($result) {
                $messageData['attachment'] = $result;
            }
        }

        $this->sendMessage($message->getPeerId(), $text, $messageData);
        Log::info('Quiz info', [
            'quiz' => $quiz->toArray(),
            'user' => $user->toArray(),
        ]);

        return true;
    }

    /**
     * Проверка доступности теста для пользователя.
     * Возвращает true, если тест доступен, иначе false.
     */
    private function canStartQuiz(MessageDTO $message, QuizDTO $quiz, UserDTO $user): bool
    {
        $data = $this->checkQuizAvailability($quiz, $user);
        if (! $data['by_time']) {
            $this->sendMessage($message->getPeerId(), 'Тест еще не начался или уже закончился');

            return false;
        }

        if (! $data['by_completed']) {
            $this->sendMessage($message->getPeerId(), 'Вы уже прошли этот тест');

            return false;
        }

        return true;
    }

    /**
     * Формирование описания теста.
     */
    private function formQuizDescription(QuizDTO $quiz): string
    {
        return sprintf(
            "Тест: %s\nОписание: %s\nВремя начала: %s\nВремя окончания: %s%s",
            $quiz->getTitle(),
            $quiz->getDescription(),
            $quiz->getStartsAt()?->format('Y-m-d H:i:s') ?: 'Бессрочно',
            $quiz->getEndsAt()?->format('Y-m-d H:i:s') ?: 'Бессрочно',
            $quiz->getQuestionCooldown() ?
                "\nИнтервал между вопросами: ".$this->secondsToHms($quiz->getQuestionCooldown()).' сек.'
                : '',
        );
    }

    /**
     * Генерация клавиатуры с кнопкой для начала теста.
     */
    private function generateKeyboard(QuizDTO $quiz): string
    {
        return Facade::createInlineKeyboard(static function (FactoryInterface $factory) use ($quiz) {
            /** @var PayloadDTOFactoryContract $payloadFactory */
            $payloadFactory = app(PayloadDTOFactoryContract::class);
            $payloadData = $payloadFactory::createFromParams(ActionStageEnum::QuizStart, $quiz->getId())->toArray();

            return [
                $factory->text('Начать тест', $payloadData),
            ];
        });
    }
}
