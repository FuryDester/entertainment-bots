<?php

namespace App\Infrastructure\GroupBoss\ActionProcessor;

use App\Infrastructure\Quiz\DataTransferObjects\QuizActionDTO;
use App\Infrastructure\Quiz\Enums\ActionAliasTypeEnum;

abstract readonly class AbstractGroupBossActionProcessor
{
    /**
     * @return ActionAliasTypeEnum|ActionAliasTypeEnum[]
     */
    abstract public function getActionAlias(): ActionAliasTypeEnum|array;

    public function isProcessable(QuizActionDTO $action): bool
    {
        return $action->getAlias() === $this->getActionAlias();
    }

    public function run(): void {
       //
    }

    abstract public function processAction(): void;
}
