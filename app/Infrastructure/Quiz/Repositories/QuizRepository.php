<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizRepositoryContract;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizEnum;
use App\Models\Quiz\Quiz;
use Illuminate\Support\Facades\Cache;

final class QuizRepository implements QuizRepositoryContract
{
    use FormBaseCacheKey;

    public function getQuizById(int $id): ?QuizDTO
    {
        return Cache::tags(QuizEnum::QuizRepository->value)
            ->remember(
                $this->formBaseCacheKey($id),
                CacheTimeEnum::DAY->value,
                static function () use ($id) {
                    return Quiz::query()->find($id);
                }
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getAvailableQuizzes(): array
    {
        $now = now();
        $quizzes = Cache::tags(QuizEnum::QuizRepository->value)
            ->remember(
                $this->formBaseCacheKey(),
                CacheTimeEnum::HOUR->value * 6,
                static function () use ($now) {
                    return Quiz::query()
                        ->where(fn ($query) => $query->where('start_at', '<=', $now)->orWhereNull('start_at'))
                        ->orWhere(fn ($query) => $query->where('end_at', '>=', $now)->orWhereNull('end_at'))
                        ->get();
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
}
