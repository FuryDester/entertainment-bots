<?php

namespace App\Domain\VK\Factories\Common\CommentParts;

use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\ThreadDTO;

interface ThreadDTOFactoryContract
{
    public static function createFromParams(
        int $count,
        ?array $items = null,
        ?bool $canPost = null,
        ?bool $showReplyButton = null,
        ?bool $groupsCanPost = null,
    ): ThreadDTO;
}
