<?php

namespace App\Jobs\Quiz;

use App\Domain\Common\Services\Models\UserServiceContract;
use App\Domain\Quiz\Services\Models\QuizQuestionServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\Traits\FormQuestionOutput;
use App\Infrastructure\Quiz\Traits\QuizAvailability;
use App\Infrastructure\Quiz\Traits\QuizEnd;
use App\Infrastructure\VK\Traits\Messages\SendMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

final class SendQuizQuestion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use FormQuestionOutput;
    use QuizAvailability;
    use QuizEnd;
    use SendMessage;

    /**
     * Create a new job instance.
     */
    public function __construct(
        public UserDTO $user,
        public QuizDTO $quiz,
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var QuizQuestionServiceContract $questionService */
        $questionService = app(QuizQuestionServiceContract::class);
        $question = $questionService->getRandomQuestion($this->quiz, $this->user);

        /** @var UserServiceContract $userService */
        $userService = app(UserServiceContract::class);
        // Необходимо обновить пользователя, т.к. его данные могли измениться.
        $user = $userService->findByVkIdAndPeerId($this->user->getVkUserId(), $this->user->getVkPeerId());

        if (! $question) {
            $this->quizEnd($user, $this->quiz);

            return;
        }

        $questionData = $this->formQuestion($question);
        $this->sendMessage($user->getVkPeerId(), $questionData['message'], ['keyboard' => $questionData['keyboard']]);

        $user->setState(ActionStageEnum::QuizProgress);
        $user->setData([
            'question_id' => $question->getId(),
            'quiz_id' => $question->getQuizId(),
        ]);

        $userService->save($user);

        Log::info('Quiz question sent', [
            'quiz_id' => $this->quiz->getId(),
            'question_id' => $question->getId(),
            'user' => $user->toArray(),
        ]);
    }
}
