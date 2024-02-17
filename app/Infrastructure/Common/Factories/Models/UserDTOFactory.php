<?php

namespace App\Infrastructure\Common\Factories\Models;

use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;
use Illuminate\Support\Carbon;

final readonly class UserDTOFactory implements UserDTOFactoryContract
{
    /**
     * {@inheritDoc}
     */
    public static function createFromData(array $data): UserDTO
    {
        return (new UserDTO)
            ->setId($data['id'] ?? null)
            ->setVkUserId($data['vk_user_id'])
            ->setVkPeerId($data['vk_peer_id'])
            ->setIsAdmin($data['is_admin'])
            ->setState(ActionStageEnum::tryFrom($data['state']) ?: ActionStageEnum::Index)
            ->setData($data['data'] ?? null)
            ->setLastActivityAt(($data['last_activity_at'] ?? null) ? (new Carbon($data['last_activity_at'])) : null)
            ->setCreatedAt(($data['created_at'] ?? null) ? (new Carbon($data['created_at'])) : null)
            ->setUpdatedAt(($data['updated_at'] ?? null) ? (new Carbon($data['updated_at'])) : null);
    }
}
