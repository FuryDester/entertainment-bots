<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizEnum;
use App\Models\Quiz\Quiz;
use Illuminate\Support\Facades\Cache;

final readonly class QuizRepository implements QuizRepositoryContract
{
    use FormBaseCacheKey;

    public function getQuizById(int $id): ?QuizDTO
    {
        return Cache::tags(QuizEnum::QuizRepository->value)
            ->remember(
                $this->formBaseCacheKey($id),
                CacheTimeEnum::DAY->value,
                static function () use ($id) {
                    /** @var QuizDTOFactoryContract $factory */
                    $factory = app(QuizDTOFactoryContract::class);

                    $data = Quiz::query()->find($id);
                    if ($data === null) {
                        return null;
                    }

                    return $factory::createFromData($data->toArray());
                }
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableQuizzes(?UserDTO $user = null): array
    {
        $now = now();
        $quizzes = Cache::tags([QuizEnum::QuizRepository->value, QuizEnum::QuizUserStatusRepository->value])
            ->remember(
                $this->formBaseCacheKey($user?->getId()),
                CacheTimeEnum::HOUR->value * 6,
                static function () use ($now, $user) {
                    $query = Quiz::query()
                        ->where(
                            fn ($query) => $query
                                ->where(fn ($subQuery) => $subQuery
                                    ->where('starts_at', '<=', $now)
                                    ->orWhereNull('starts_at')
                                )
                                ->orWhere(fn ($subQuery) => $subQuery
                                    ->where('ends_at', '>=', $now)
                                    ->orWhereNull('ends_at')
                                )
                        );

                    if ($user) {
                        $query->where(
                            fn ($query) => $query->doesntHave('userStatuses')->orWhereHas(
                                'userStatuses',
                                fn ($query) => $query->where('user_id', $user->getId())->where('is_done', false)
                            )
                        );
                    }

                    return $query->get();
                }
            );

        /** @var QuizDTOFactoryContract $quizFactory */
        $quizFactory = app(QuizDTOFactoryContract::class);

        return $quizzes
            ->map(static fn (Quiz $quiz) => $quizFactory::createFromData($quiz->toArray()))
            // Поскольку результаты кэшируются, то нам необходимо отфильтровать по дате вручную
            ->filter(static function (QuizDTO $quiz) use ($now) {
                return ($quiz->getStartsAt() <= $now || $quiz->getStartsAt() === null)
                    && ($quiz->getEndsAt() >= $now || $quiz->getEndsAt() === null);
            })
            ->all();
    }

    public function hasUserCompletedQuiz(QuizDTO $quizId, UserDTO $user): bool
    {
        return Quiz::query()
            ->where('id', $quizId)
            ->whereHas('userStatuses', fn ($query) => $query->where('user_id', $user->getId())->where('is_done', true))
            ->exists();
    }
}
