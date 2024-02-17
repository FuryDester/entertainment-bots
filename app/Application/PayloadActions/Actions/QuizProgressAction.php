<?php

namespace App\Application\PayloadActions\Actions;

use App\Domain\Quiz\Factories\QuizUserAnswerDTOFactoryContract;
use App\Domain\Quiz\Services\Models\QuizAnswerServiceContract;
use App\Domain\Quiz\Services\Models\QuizQuestionServiceContract;
use App\Domain\Quiz\Services\Models\QuizServiceContract;
use App\Domain\Quiz\Services\Models\QuizUserAnswerServiceContract;
use App\Events\Quiz\QuizQuestionAnswered;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Traits\SecondsToHms;
use App\Infrastructure\PayloadActions\AbstractPayloadAction;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\Traits\QuizEnd;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\MessageDTO;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use App\Jobs\Quiz\SendQuizQuestion;
use Illuminate\Support\Facades\Log;

final readonly class QuizProgressAction extends AbstractPayloadAction
{
    use QuizEnd;
    use SecondsToHms;
    use SendMessage;

    public function getActionName(): ActionStageEnum
    {
        return ActionStageEnum::QuizProgress;
    }

    /**
     * {@inheritDoc}
     */
    public function getPossibleActions(): array
    {
        return [ActionStageEnum::QuizStart, ActionStageEnum::QuizProgress];
    }

    protected function execute(MessageDTO $message, PayloadDTO $payload, UserDTO $user): bool
    {
        if (! $this->checkStates($user, $message)) {
            return true;
        }

        $answerId = $payload->getId();
        $data = $payload->getData();
        $quizId = ($data['quiz_id'] ?? null) ? (int) $data['quiz_id'] : null;
        $questionId = ($data['question_id'] ?? null) ? (int) $data['question_id'] : null;

        if (! $this->validateAnswer($user, $quizId, $questionId, $answerId)) {
            return true;
        }

        /** @var QuizUserAnswerDTOFactoryContract $userAnswerFactory */
        $userAnswerFactory = app(QuizUserAnswerDTOFactoryContract::class);
        $userAnswer = $userAnswerFactory::createFromParams(
            null,
            $questionId,
            $answerId,
            null,
            $user->getId(),
            now(),
            now(),
            now(),
        );

        /** @var QuizUserAnswerServiceContract $userAnswerService */
        $userAnswerService = app(QuizUserAnswerServiceContract::class);
        $userAnswerService->save($userAnswer);

        Log::info('User answered question', [
            'user' => $user->toArray(),
            'question_id' => $questionId,
            'answer_id' => $answerId,
        ]);

        $this->sendMessage($user->getVkPeerId(), 'Ответ принят.');
        QuizQuestionAnswered::dispatch();

        $this->sendOrEndQuiz($user, $quizId);

        return true;
    }

    /**
     * Первичная проверка состояний пользователя и сообщения.
     */
    private function checkStates(UserDTO $user, MessageDTO $message): bool
    {
        if ($user->getState() !== ActionStageEnum::QuizProgress) {
            Log::warning('User is not in quiz progress state', [
                'user' => $user->toArray(),
                'message' => $message->toArray(),
            ]);

            return false;
        }

        $userData = $user->getData();
        if (! $userData) {
            Log::critical('User data is empty', [
                'user' => $user->toArray(),
                'message' => $message->toArray(),
            ]);

            $this->sendMessage($user->getVkPeerId(), 'Произошла ошибка. Попробуйте начать тест заново.');

            return false;
        }

        return true;
    }

    /**
     * Проверка пришедших данных на валидность.
     * Пришедший ответ должен принадлежать вопросу, а вопрос к тесту.
     * Пришедший ответ не был ранее выбран пользователем.
     */
    private function validateAnswer(UserDTO $user, ?int $quizId, ?int $questionId, ?int $answerId): bool
    {
        /** @var QuizAnswerServiceContract $answerService */
        $answerService = app(QuizAnswerServiceContract::class);
        $answer = $answerService->getById($answerId);

        if (! $this->isValidStructure($quizId, $questionId, $answer)) {
            Log::warning('Invalid structure or answer was already given (old question answered?)', [
                'quiz_id' => $quizId,
                'question_id' => $questionId,
                'answer_id' => $answerId,
            ]);

            return false;
        }

        /** @var QuizUserAnswerServiceContract $userAnswerService */
        $userAnswerService = app(QuizUserAnswerServiceContract::class);
        $userAnswer = $userAnswerService->getByUserAndQuestion($user, (new QuizQuestionDTO)->setId($questionId));
        if ($userAnswer) {
            Log::warning('User already answered this question', [
                'user' => $user->toArray(),
                'question_id' => $questionId,
                'answer_id' => $answerId,
            ]);
        }

        return ! $userAnswer;
    }

    /**
     * Проверка структуры данных.
     * Проверяется, принадлежат ли ответ к вопросу, а вопрос к тесту.
     */
    private function isValidStructure(?int $quizId, ?int $questionId, ?QuizAnswerDTO $answer): bool
    {
        if (! $quizId || ! $questionId || ! $answer) {
            return false;
        }

        /** @var QuizServiceContract $quizService */
        $quizService = app(QuizServiceContract::class);
        $quiz = $quizService->getQuizById($quizId);

        /** @var QuizQuestionServiceContract $questionService */
        $questionService = app(QuizQuestionServiceContract::class);
        $question = $questionService->getById($questionId);

        return $question->getQuizId() === $quiz->getId() && $answer->getQuestionId() === $question->getId();
    }

    /**
     * Отправка следующего вопроса или завершение теста.
     */
    private function sendOrEndQuiz(UserDTO $user, int $quizId): void
    {
        /** @var QuizServiceContract $quizService */
        $quizService = app(QuizServiceContract::class);
        $quiz = $quizService->getQuizById($quizId);

        $questionService = app(QuizQuestionServiceContract::class);
        $question = $questionService->getRandomQuestion($quiz, $user);
        if (! $question) {
            $this->quizEnd($user, $quiz);

            return;
        }

        $cooldown = $quiz->getQuestionCooldown();
        if ($cooldown) {
            $this->sendMessage(
                $user->getVkPeerId(),
                "Следующий вопрос будет отправлен через {$this->secondsToHms($cooldown)}."
            );
        }

        SendQuizQuestion::dispatch($user, $quiz)->delay(now()->addSeconds($cooldown));
    }
}
