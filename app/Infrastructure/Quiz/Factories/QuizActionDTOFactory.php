<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizActionDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use App\Models\Quiz\QuizAction;
use Illuminate\Support\Carbon;

final readonly class QuizActionDTOFactory implements QuizActionDTOFactoryContract
{
    public static function createFromParams(array $data): QuizActionDTO
    {
        return (new QuizActionDTO)
            ->setId($data['id'] ?? null)
            ->setAlias($data['alias'])
            ->setType($data['type'])
            ->setData($data['data'])
            ->setDuration($data['duration'] ?? null)
            ->setCreatedAt(($data['created_at'] ?? null) ? new Carbon($data['created_at']) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? new Carbon($data['updated_at']) : null);
    }

    public static function createFromModel(QuizAction $model): QuizActionDTO
    {
        return (new QuizActionDTO)
            ->setId($model->id)
            ->setAlias(ActionAliasTypeEnum::from($model->alias))
            ->setType(ActionTypeEnum::from($model->type))
            ->setData($model->data ? json_decode($model->data, true) : null)
            ->setDuration($model->duration)
            ->setCreatedAt($model->created_at ? new Carbon($model->created_at) : null)
            ->setUpdatedAt($model->updated_at ? new Carbon($model->updated_at) : null);
    }
}
