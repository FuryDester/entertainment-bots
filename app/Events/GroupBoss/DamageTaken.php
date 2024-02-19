<?php

namespace App\Events\GroupBoss;

use App\Infrastructure\GroupBoss\DataTransferObjects\GroupBossUserActionDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class DamageTaken
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct(
        public GroupBossUserActionDTO $action,
        public CommentDTO $comment,
    ) {
    }
}
