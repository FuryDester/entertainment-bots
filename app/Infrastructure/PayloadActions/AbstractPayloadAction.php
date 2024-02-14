<?php

namespace App\Infrastructure\PayloadActions;

abstract class AbstractPayloadAction
{
    public function getActionName(): string
    {
        return static::class;
    }

    /**
     * @return string[]
     */
    abstract public function getPossibleActions(): array;
}
