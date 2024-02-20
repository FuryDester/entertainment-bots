<?php

namespace App\Infrastructure\Quiz\Repositories;

use App\Domain\Quiz\Factories\QuizActionDTOFactoryContract;
use App\Domain\Quiz\Repositories\QuizActionRepositoryContract;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use App\Infrastructure\Quiz\Enums\Cache\QuizTagsEnum;
use App\Models\Quiz\QuizAction;
use Illuminate\Support\Facades\Cache;

final readonly class QuizActionRepository implements QuizActionRepositoryContract
{
    use FormBaseCacheKey;

    /**
     * {@inheritDoc}
     */
    public function getByType(ActionTypeEnum $type): array
    {
        return Cache::tags(QuizTagsEnum::QuizActionRepository->value)
            ->remember(
                $type->value,
                CacheTimeEnum::DAY->value * 5,
                static function () use ($type) {
                    /** @var QuizActionDTOFactoryContract $factory */
                    $factory = app(QuizActionDTOFactoryContract::class);

                    return QuizAction::where('type', $type->value)
                        ->get()
                        ->map(static fn (QuizAction $action) => $factory::createFromModel($action))
                        ->all();
                }
            );
    }

    public function getById(int $id): ?QuizActionDTO
    {
        return Cache::tags(QuizTagsEnum::QuizActionRepository->value)
            ->remember(
                $this->formBaseCacheKey($id),
                CacheTimeEnum::DAY->value,
                static function () use ($id) {
                    /** @var QuizActionDTOFactoryContract $factory */
                    $factory = app(QuizActionDTOFactoryContract::class);

                    $data = QuizAction::find($id);
                    if ($data === null) {
                        return null;
                    }

                    return $factory::createFromModel($data);
                }
            );
    }
}
