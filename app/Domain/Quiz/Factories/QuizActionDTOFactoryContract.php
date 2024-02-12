<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use Illuminate\Support\Carbon;

interface QuizActionDTOFactoryContract
{
    public static function createFromParams(
        ?int $id,
        ActionAliasTypeEnum $alias,
        ActionTypeEnum $type,
        ?string $value,
        ?Carbon $createdAt,
        ?Carbon $updatedAt,
    ): QuizActionDTO;
}
