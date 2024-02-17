<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizQuestionDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizQuestionRepositoryContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizEnum;
use App\Models\Quiz\QuizQuestion;
use Illuminate\Support\Facades\Cache;

final readonly class QuizQuestionRepository implements QuizQuestionRepositoryContract
{
    use FormBaseCacheKey;

    /**
     * @inheritDoc
     */
    public function getQuestionsByQuiz(QuizDTO $quiz, UserDTO $user = null): array
    {
        return Cache::tags(QuizEnum::QuizQuestionRepository->value)
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
                        });
                }
            );
    }
}
