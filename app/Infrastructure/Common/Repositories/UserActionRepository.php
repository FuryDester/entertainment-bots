<?php

namespace App\Infrastructure\Common\Repositories;

use App\Domain\Common\Factories\Models\UserActionDTOFactoryContract;
use App\Domain\Common\Repositories\UserActionRepositoryContract;
use App\Events\Common\UserActionUpdated;
use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Enums\Cache\CacheTimeEnum;
use App\Infrastructure\Common\Enums\Cache\UserCacheEnum;
use App\Infrastructure\Common\Traits\Cache\FormBaseCacheKey;
use App\Infrastructure\Common\Traits\Repositories\SaveDto;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;
use App\Models\Common\UserAction;
use Illuminate\Support\Facades\Cache;

final readonly class UserActionRepository implements UserActionRepositoryContract
{
    use FormBaseCacheKey;
    use SaveDto;

    public function save(UserActionDTO $action): bool
    {
        $result = $this->saveDto(new UserAction, $action);
        if ($result) {
            UserActionUpdated::dispatch();
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function getActiveActionsByUser(UserDTO $user, ?array $aliases = []): array
    {
        $aliases = array_map(static fn (ActionAliasTypeEnum $alias) => $alias->value, $aliases);
        $data = Cache::tags(UserCacheEnum::UserActionRepository->value)
            ->remember(
                $this->formBaseCacheKey($user->getId(), $aliases),
                CacheTimeEnum::HOUR->value * 6,
                static function () use ($user, $aliases) {
                    $query = UserAction::query()
                        ->where('user_id', $user->getId())
                        ->where('ends_at', '>=', now());

                    if ($aliases) {
                        $query->whereHas('quizAction', static function ($query) use ($aliases) {
                            $query->whereIn('alias', $aliases);
                        });
                    }

                    /** @var UserActionDTOFactoryContract $factory */
                    $factory = app(UserActionDTOFactoryContract::class);
                    return $query
                        ->get()
                        ->map(static fn (UserAction $action) => $factory::createFromModel($action))
                        ->all();
                }
            );

        return array_filter($data, static fn (UserActionDTO $action) => $action->getEndsAt() >= now());
    }
}
