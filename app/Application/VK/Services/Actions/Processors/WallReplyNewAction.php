<?php

namespace App\Application\VK\Services\Actions\Processors;

use App\Domain\GroupBoss\Services\GroupBossExecutorContract;
use App\Domain\GroupBoss\Services\Models\GroupBossServiceContract;
use App\Domain\VK\Factories\Common\CommentDTOFactoryContract;
use App\Domain\VK\Services\Actions\Processors\Actionable;
use App\Infrastructure\Common\DataTransferObjects\Models\UserDTO;
use App\Infrastructure\Common\Traits\Users\GetUserDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;
use App\Infrastructure\VK\Enums\ActionEnum;
use Illuminate\Support\Facades\Log;

final class WallReplyNewAction implements Actionable
{
    use GetUserDTO;

    public static function getActionName(): ActionEnum
    {
        return ActionEnum::WallReplyNew;
    }

    public static function perform(CallbackRequestDTO $data): bool
    {
        /** @var CommentDTOFactoryContract $commentFactory */
        $commentFactory = app(CommentDTOFactoryContract::class);
        $comment = $commentFactory::createFromCallbackData($data);

        Log::info('WallReplyNewAction', ['comment' => $comment]);

        $user = self::getUserDto($comment->getFromId(), $comment->getFromId());
        if (self::tryProcessGroupBoss($comment, $user)) {
            return true;
        }

        // Some more logic here...

        return true;
    }

    /**
     * Запускает обработку комментария, если это комментарий к посту с групповым боссом.
     *
     * @return bool Успешность обработки. Если не групповой босс, то false.
     */
    private static function tryProcessGroupBoss(CommentDTO $comment, UserDTO $user): bool
    {
        if (
            ! $comment->getText()
            || $comment->getFromId() <= 0
        ) {
            return false;
        }

        /** @var GroupBossServiceContract $groupBossService */
        $groupBossService = app(GroupBossServiceContract::class);

        $groupBoss = $groupBossService->findByComment($comment);
        if (! $groupBoss) {
            return false;
        }

        /** @var GroupBossExecutorContract $groupBossExecutor */
        $groupBossExecutor = app(GroupBossExecutorContract::class);
        $result = $groupBossExecutor->execute($comment, $user, $groupBoss);
        Log::info('Group boss executed', [
            'result' => $result,
            'comment' => $comment->toArray(),
            'user' => $user->toArray(),
        ]);

        return true;
    }
}
