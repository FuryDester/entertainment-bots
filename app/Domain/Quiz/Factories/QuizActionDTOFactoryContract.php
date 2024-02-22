<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;
use App\Models\Quiz\QuizAction;
use Illuminate\Support\Carbon;

interface QuizActionDTOFactoryContract
{
    /**
     * @param array{
     *     id?: int,
     *     alias: ActionAliasTypeEnum,
     *     type: ActionTypeEnum,
     *     data?: array,
     *     duration?: int,
     *     created_at?: Carbon|string,
     *     updated_at?: Carbon|string,
     * } $data
     */
    public static function createFromParams(array $data): QuizActionDTO;

    public static function createFromModel(QuizAction $model): QuizActionDTO;
}
