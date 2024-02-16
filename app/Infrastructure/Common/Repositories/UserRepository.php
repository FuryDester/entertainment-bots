<?php

namespace App\Infrastructure\Common\Repositories;

use App\Domain\Common\Factories\Models\UserDTOFactoryContract;
use App\Domain\Common\Repositories\UserRepositoryContract;
use App\Events\Common\UserUpdated;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Enums\Cache\UserCacheEnum;
use App\Infrastructure\Common\Traits\ArrayKeysToSneakCase;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Models\Common\User;
use Illuminate\Support\Facades\Cache;

final class UserRepository implements UserRepositoryContract
{
    use SaveDto;
    use FormBaseCacheKey;
    use ArrayKeysToSneakCase;

    /**
     * {@inheritDoc}
     */
    public function findByVkIdAndPeerId(int $vkId, int $peerId): ?UserDTO
    {
        return Cache::tags(UserCacheEnum::UserRepository->value)
            ->remember(
                $this->formBaseCacheKey($vkId, $peerId),
                CacheTimeEnum::HOUR->value,
                static function () use ($vkId, $peerId) {
                    $model = User::where('vk_user_id', $vkId)->where('vk_peer_id', $peerId)->first();
                    if (!$model) {
                        return null;
                    }

                    /** @var UserDTOFactoryContract $userFactory */
                    $userFactory = app(UserDTOFactoryContract::class);
                    return $userFactory::createFromData($model->toArray());
                },
            );
    }

    /**
     * {@inheritDoc}
     */
    public function save(UserDTO $user): bool
    {
        $result = $this->saveDto(new User(), $user);
        if ($result) {
            UserUpdated::dispatch();
        }

        return $result;
    }
}
