<?php

namespace App\Infrastructure\Commands\Factories\Common;

use App\Domain\Commands\Factories\Common\CommandArgumentDTOFactoryContract;
use App\Infrastructure\Commands\DataTransferObjects\Common\CommandArgumentDTO;

final class CommandArgumentDTOFactory implements CommandArgumentDTOFactoryContract
{
    public static function createFromParams(
        string $alias,
        string $description,
        bool $required = false,
        ?string $value = null
    ): CommandArgumentDTO {
        return (new CommandArgumentDTO)
            ->setAlias($alias)
            ->setDescription($description)
            ->setRequired($required)
            ->setValue($value);
    }
}
