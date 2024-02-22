<?php

namespace App\Infrastructure\VK\Factories\Common\CommentParts;

use App\Domain\VK\Factories\Common\CommentParts\ThreadDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\ThreadDTO;

final readonly class ThreadDTOFactory implements ThreadDTOFactoryContract
{
    public static function createFromParams(
        int $count,
        ?array $items = null,
        ?bool $canPost = null,
        ?bool $showReplyButton = null,
        ?bool $groupsCanPost = null,
    ): ThreadDTO {
        return (new ThreadDTO)
            ->setCount($count)
            ->setItems($items)
            ->setCanPost($canPost)
            ->setShowReplyButton($showReplyButton)
            ->setGroupsCanPost($groupsCanPost);
    }
}
