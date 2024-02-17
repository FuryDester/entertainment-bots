<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizUserStatusDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizUserStatusesRepositoryContract;
use App\Events\Quiz\QuizUserStatusUpdated;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use App\Infrastructure\Quiz\DataTransferObjects\QuizUserStatusDTO;
use App\Infrastructure\Quiz\Enums\Cache\QuizEnum;
use App\Models\Quiz\QuizUserStatus;
use Illuminate\Support\Facades\Cache;

final class QuizUserStatusesRepository implements QuizUserStatusesRepositoryContract
{
    use FormBaseCacheKey;
    use SaveDto;

    /**
     * {@inheritDoc}
     */
    public function save(QuizUserStatusDTO $quizUserStatus): bool
    {
        $result = $this->saveDto(new QuizUserStatus, $quizUserStatus);
        if ($result) {
            QuizUserStatusUpdated::dispatch();
        }

        return $result;
    }

    /**
     * {@inheritDoc}
     */
    public function getUserQuizStatus(UserDTO $user, QuizDTO $quiz): QuizUserStatusDTO
    {
        return Cache::tags(QuizEnum::QuizUserStatusesRepository->value)
            ->remember(
                $this->formBaseCacheKey($user->getId(), $quiz->getId()),
                CacheTimeEnum::HOUR->value * 6,
                static function () use ($user, $quiz) {
                    $data = QuizUserStatus::query()
                        ->where('user_id', $user->getId())
                        ->where('quiz_id', $quiz->getId())
                        ->first();

                    if ($data === null) {
                        return null;
                    }

                    $data = $data->toArray();

                    /** @var QuizUserStatusDTOFactoryContract $factory */
                    $factory = app(QuizUserStatusDTOFactoryContract::class);

                    return $factory::createFromParams(
                        $data['id'] ?? null,
                        $data['user_id'] ?? $user->getId(),
                        $data['quiz_id'] ?? $quiz->getId(),
                        $data['is_done'] ?? false,
                        $data['done_at'] ?? null,
                        $data['created_at'] ?? null,
                        $data['updated_at'] ?? null
                    );
                }
            );
    }
}
