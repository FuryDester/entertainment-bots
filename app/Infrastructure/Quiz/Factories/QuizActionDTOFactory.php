<?php

namespace App\Infrastructure\Quiz\Factories;

use App\Domain\Quiz\Factories\QuizActionDTOFactoryContract;
use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Support\Carbon;

final class QuizActionDTOFactory implements QuizActionDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        ActionAliasTypeEnum $alias,
        ActionTypeEnum $type,
        ?string $value,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizActionDTO {
        return (new QuizActionDTO)
            ->setId($id)
            ->setAlias($alias)
            ->setType($type)
            ->setValue($value)
            ->setCreatedAt($createdAt)
            ->setUpdatedAt($updatedAt);
    }
}
