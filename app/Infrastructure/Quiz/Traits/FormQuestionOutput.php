<?php

namespace App\Infrastructure\Quiz\Traits;

use App\Domain\PayloadActions\Factories\PayloadDTOFactoryContract;
use App\Domain\Quiz\Services\Models\QuizAnswerServiceContract;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use Sally\VkKeyboard\Contracts\Keyboard\Button\FactoryInterface;
use Sally\VkKeyboard\Facade;
use Sally\VkKeyboard\Object\Keyboard\Button\Text;

trait FormQuestionOutput
{
    /**
     * Формирование вопроса для отправки пользователю.
     * TODO: Добавить поддержку разных типов вопросов.
     * @return array{
     *     keyboard: array,
     *     message: string,
     * }
     */
    private function formQuestion(QuizQuestionDTO $question): array
    {
        $message = sprintf("Вопрос #%d\n%s", $question->getId(), $question->getQuestion());

        /** @var QuizAnswerServiceContract $answerService */
        $answerService = app(QuizAnswerServiceContract::class);
        $answers = $answerService->getQuizAnswersByQuestion($question);

        $keyboard = Facade::createInlineKeyboard(static function (FactoryInterface $factory) use ($answers, $question) {
            $keyboardData = [];
            /** @var PayloadDTOFactoryContract $payloadFactory */
            $payloadFactory = app(PayloadDTOFactoryContract::class);

            foreach ($answers as $answer) {
                $payload = $payloadFactory::createFromParams(ActionStageEnum::QuizProgress, $answer->getId(), [
                    'question_id' => $question->getId(),
                    'quiz_id' => $question->getQuizId(),
                ]);

                $keyboardData[] = [
                    $factory->text($answer->getAnswer(), $payload->toArray(), Text::COLOR_BLUE),
                ];
            }

            return $keyboardData;
        });

        return [
            'keyboard' => $keyboard,
            'message' => $message,
        ];
    }
}
