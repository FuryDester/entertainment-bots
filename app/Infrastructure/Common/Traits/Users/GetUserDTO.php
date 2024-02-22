<?php

namespace App\Infrastructure\Common\Traits\Users;

use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Domain\Common\Services\Models\UserServiceContract;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;

trait GetUserDTO
{
    /**
     * Создание или получение пользователя по данным сообщения
     */
    private static function getUserDto(int $vkUserId, int $peerId): UserDTO
    {
        /** @var UserServiceContract $userService */
        $userService = app(UserServiceContract::class);
        $user = $userService->findByVkIdAndPeerId($vkUserId, $peerId);
        if (! $user) {
            /** @var UserDTOFactoryContract $userFactory */
            $userFactory = app(UserDTOFactoryContract::class);

            $user = $userFactory::createFromData([
                'vk_user_id' => $vkUserId,
                'vk_peer_id' => $peerId,
                'is_admin' => false,
                'state' => ActionStageEnum::Index->value,
            ]);
            $userService->save($user);
        }

        return $user;
    }
}
