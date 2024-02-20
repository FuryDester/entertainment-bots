<?php

namespace App\Domain\Quiz\Repositories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionTypeEnum;

interface QuizActionRepositoryContract
{
    /**
     * Получение действий по типу действия.
     * @return QuizActionDTO[]
     */
    public function getByType(ActionTypeEnum $type): array;

    public function getById(int $id): ?QuizActionDTO;
}
