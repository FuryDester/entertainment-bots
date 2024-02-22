<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizUserAnswerDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizUserAnswerRepositoryContract;
use App\Events\Quiz\QuizUserAnswerUpdated;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserAnswerDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizTagsEnum;
use App\Models\Quiz\QuizQuestion;
use App\Models\Quiz\QuizUserAnswer;
use Illuminate\Support\Facades\Cache;

final readonly class QuizUserAnswerRepository implements QuizUserAnswerRepositoryContract
{
    use FormBaseCacheKey;
    use SaveDto;

    public function save(QuizUserAnswerDTO $answer): bool
    {
        $result = $this->saveDto(new QuizUserAnswer, $answer);
        if ($result) {
            QuizUserAnswerUpdated::dispatch();
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getByUserAndQuestion(UserDTO $user, QuizQuestionDTO $question): ?QuizUserAnswerDTO
    {
        return Cache::tags(QuizTagsEnum::QuizUserAnswerRepository->value)
            ->remember(
                $this->formBaseCacheKey($user->getId(), $question->getId()),
                CacheTimeEnum::WEEK->value,
                static function () use ($user, $question) {
                    $data = QuizUserAnswer::where('user_id', $user->getId())
                        ->where('question_id', $question->getId())
                        ->first();

                    /** @var QuizUserAnswerDTOFactoryContract $factory */
                    $factory = app(QuizUserAnswerDTOFactoryContract::class);

                    return $data ? $factory::createFromModel($data) : null;
                }
            );
    }

    public function getAnswersByQuiz(UserDTO $user, QuizDTO $quiz): array
    {
        return Cache::tags(QuizTagsEnum::QuizUserAnswerRepository->value)
            ->remember(
                $this->formBaseCacheKey($user->getId(), $quiz->getId()),
                CacheTimeEnum::WEEK->value,
                static function () use ($user, $quiz) {
                    $questions = QuizQuestion::where('quiz_id', $quiz->getId())->get('id')->pluck('id');

                    /** @var QuizUserAnswerDTOFactoryContract $factory */
                    $factory = app(QuizUserAnswerDTOFactoryContract::class);

                    return QuizUserAnswer::where('user_id', $user->getId())
                        ->whereIn('question_id', $questions)
                        ->get()
                        ->map(static function (QuizUserAnswer $answer) use ($factory) {
                            return $factory::createFromModel($answer);
                        })
                        ->all();
                }
            );
    }
}
