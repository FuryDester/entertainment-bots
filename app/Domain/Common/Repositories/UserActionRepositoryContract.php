<?php

namespace App\Domain\Common\Repositories;

use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;

interface UserActionRepositoryContract
{
    public function save(UserActionDTO $action): bool;

    /**
     * Получение активных действий пользователя
     *
     * @param  ActionAliasTypeEnum[]|null  $aliases  фильтр по алиасам
     * @return UserActionDTO[]
     */
    public function getActiveActionsByUser(UserDTO $user, ?array $aliases = []): array;
}
