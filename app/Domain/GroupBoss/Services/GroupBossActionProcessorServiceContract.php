<?php

namespace App\Domain\GroupBoss\Services;

use App\Infrastructure\Common\DataTransferObjects\Models\UserActionDTO;
use App\Infrastructure\GroupBoss\ActionProcessor\AbstractGroupBossActionProcessor;

interface GroupBossActionProcessorServiceContract
{
    public function getActionProcessor(UserActionDTO $action): ?AbstractGroupBossActionProcessor;
}
