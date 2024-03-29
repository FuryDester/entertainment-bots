<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizQuestionRepositoryContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizTagsEnum;
use App\Models\Quiz\QuizQuestion;
use Illuminate\Support\Facades\Cache;

final readonly class QuizQuestionRepository implements QuizQuestionRepositoryContract
{
    use FormBaseCacheKey;

    /**
     * {@inheritDoc}
     */
    public function getQuestionsByQuiz(QuizDTO $quiz, ?UserDTO $user = null): array
    {
        return Cache::tags([QuizTagsEnum::QuizQuestionRepository->value, QuizTagsEnum::QuizUserAnswerRepository->value])
            ->remember(
                $this->formBaseCacheKey($quiz->getId(), $user?->getId()),
                CacheTimeEnum::WEEK->value,
                static function () use ($quiz, $user) {
                    /** @var QuizQuestionDTOFactoryContract $factory */
                    $factory = app(QuizQuestionDTOFactoryContract::class);
                    $query = QuizQuestion::query()->where('quiz_id', $quiz->getId());

                    if ($user) {
                        $query->whereDoesntHave('userAnswers', static function ($query) use ($user) {
                            $query->where('user_id', $user->getId());
                        });
                    }

                    return $query
                        ->get()
                        ->map(static function (QuizQuestion $question) use ($factory) {
                            return $factory::createFromModel($question);
                        })
                        ->all();
                }
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getById(int $id): ?QuizQuestionDTO
    {
        return Cache::tags(QuizTagsEnum::QuizQuestionRepository->value)
            ->remember(
                $this->formBaseCacheKey($id),
                CacheTimeEnum::WEEK->value,
                static function () use ($id) {
                    /** @var QuizQuestionDTOFactoryContract $factory */
                    $factory = app(QuizQuestionDTOFactoryContract::class);
                    $question = QuizQuestion::query()->find($id);

                    return $question ? $factory::createFromModel($question) : null;
                }
            );
    }
}
