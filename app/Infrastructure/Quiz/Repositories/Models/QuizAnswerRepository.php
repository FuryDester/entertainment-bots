<?php

namespace App\Infrastructure\Quiz\Repositories\Models;

use App\Domain\Quiz\Factories\QuizAnswerDTOFactoryContract;
use App\Domain\Quiz\Repositories\Models\QuizAnswerRepositoryContract;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Quiz\DataTransferObjects\QuizAnswerDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizQuestionDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizEnum;
use App\Models\Quiz\QuizAnswer;
use Illuminate\Support\Facades\Cache;

final readonly class QuizAnswerRepository implements QuizAnswerRepositoryContract
{
    use FormBaseCacheKey;

    /**
     * {@inheritDoc}
     */
    public function getQuizAnswersByQuestion(QuizQuestionDTO $question): array
    {
        return Cache::tags(QuizEnum::QuizAnswerRepository->value)
            ->remember(
                $this->formBaseCacheKey($question->getId()),
                CacheTimeEnum::WEEK->value,
                static function () use ($question) {
                    /** @var QuizAnswerDTOFactoryContract $factory */
                    $factory = app(QuizAnswerDTOFactoryContract::class);

                    return QuizAnswer::query()
                        ->where('question_id', $question->getId())
                        ->get()
                        ->map(fn (QuizAnswer $answer) => $factory::createFromModel($answer))
                        ->toArray();
                }
            );
    }

    public function getById(int $id): ?QuizAnswerDTO
    {
        return Cache::tags(QuizEnum::QuizAnswerRepository->value)
            ->remember(
                $this->formBaseCacheKey($id),
                CacheTimeEnum::WEEK->value,
                static function () use ($id) {
                    /** @var QuizAnswerDTOFactoryContract $factory */
                    $factory = app(QuizAnswerDTOFactoryContract::class);

                    $data = QuizAnswer::find($id);

                    return $data ? $factory::createFromModel($data) : null;
                }
            );
    }

    /**
     * {@inheritDoc}
     */
    public function getByIds(array $ids): array
    {
        return Cache::tags(QuizEnum::QuizAnswerRepository->value)
            ->remember(
                $this->formBaseCacheKey($ids),
                CacheTimeEnum::WEEK->value,
                static function () use ($ids) {
                    /** @var QuizAnswerDTOFactoryContract $factory */
                    $factory = app(QuizAnswerDTOFactoryContract::class);

                    return QuizAnswer::query()
                        ->whereIn('id', $ids)
                        ->get()
                        ->map(fn (QuizAnswer $answer) => $factory::createFromModel($answer))
                        ->toArray();
                }
            );
    }
}
