<?php

namespace App\Application\Quiz\ActionProcessor;

use App\Domain\Common\Factories\Models\UserActionDTOFactoryContract;
use App\Domain\Common\Services\Models\UserActionServiceContract;
use App\Domain\Quiz\Services\QuizStatisticsServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Traits\SecondsToHms;
use App\Infrastructure\Quiz\ActionProcessor\AbstractQuizActionProcessor;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

final readonly class AddBossDamageActionProcessor extends AbstractQuizActionProcessor
{
    use SendMessage;
    use SecondsToHms;

    /**
     * @inheritDoc
     */
    public function getActionAlias(): ActionAliasTypeEnum|array
    {
        return ActionAliasTypeEnum::BossAddDamage;
    }

    /**
     * @inheritDoc
     */
    public function getActionType(): ActionTypeEnum|array
    {
        return [ActionTypeEnum::PerQuestion, ActionTypeEnum::PerQuiz];
    }

    public function processAction(
        QuizDTO $quiz,
        UserDTO $user,
        QuizActionDTO $action,
        QuizUserAnswerDTO $userAnswer
    ): void {
        if (
            ! $this->isCorrectAnswer($userAnswer)
            || ! $this->validateData($action->getData() ?: [])
        ) {
            return;
        }

        $data = $action->getData();
        // TODO: Вынести сообщения в шаблонизатор и в таблицу, чтобы можно было менять их в админке.
        $this->sendMessage(
            $user->getVkPeerId(),
            sprintf(
                'Вы правильно ответили на вопрос и заслужили повышение урона по боссу на %d%% %s!',
                $data['damage_percent'],
                $action->getDuration()
                    ? "на {$this->secondsToHms($action->getDuration())}"
                    : 'навсегда',
            )
        );

        Log::info('User added damage to boss', [
            'user' => $user->getId(),
            'quiz' => $quiz->getId(),
            'action' => $action->getId(),
            'userAnswer' => $userAnswer->getId(),
            'data' => $data,
        ]);

        /** @var UserActionDTOFactoryContract $userActionFactory */
        $userActionFactory = app(UserActionDTOFactoryContract::class);
        $userAction = $userActionFactory::createFromParams(
            null,
            $user->getId(),
            $action->getId(),
            $action->getDuration() ? now()->addSeconds($action->getDuration()) : null,
        );

        /** @var UserActionServiceContract $userActionService */
        $userActionService = app(UserActionServiceContract::class);
        $userActionService->save($userAction);

        Log::info('User action saved', [
            'user' => $user->getId(),
            'action' => $action->getId(),
            'userAction' => $userAction->getId(),
        ]);
    }

    /**
     * Валидация данных в действии.
     */
    private function validateData(array $data): bool
    {
        $validator = Validator::make($data, ['damage_percent' => 'required|numeric|min:0']);

        $result = ! $validator->fails();
        if (! $result) {
            Log::error('Validation error in AddBossDamageActionProcessor', [
                'data' => $data,
                'errors' => $validator->errors(),
            ]);
        }

        return $result;
    }

    /**
     * Проверка, является ли ответ пользователя правильным.
     */
    private function isCorrectAnswer(QuizUserAnswerDTO $userAnswer): bool
    {
        /** @var QuizStatisticsServiceContract $quizStatisticsService */
        $quizStatisticsService = app(QuizStatisticsServiceContract::class);

        return $quizStatisticsService->isAnswerCorrect($userAnswer);
    }
}
