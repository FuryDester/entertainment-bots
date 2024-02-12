<?php

namespace App\Domain\Commands\Factories\Common;

use App\Infrastructure\Commands\DataTransferObjects\Common\CommandArgumentDTO;

interface CommandArgumentDTOFactoryContract
{
    public static function createFromParams(
        string $alias,
        string $description,
        bool $required = false,
        ?string $value = null
    ): CommandArgumentDTO;
}
