<?php

namespace App\Events\GroupBoss\Models;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

final class GroupBossUpdated
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     */
    public function __construct()
    {
    }
}
