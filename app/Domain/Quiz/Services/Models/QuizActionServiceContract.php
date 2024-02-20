<?php

namespace App\Domain\Quiz\Services\Models;

use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;

interface QuizActionServiceContract
{
    /**
     * Получение действий по типу действия.
     * @return QuizActionDTO[]
     */
    public function getByType(ActionTypeEnum $type): array;

    public function getById(int $id): ?QuizActionDTO;
}
