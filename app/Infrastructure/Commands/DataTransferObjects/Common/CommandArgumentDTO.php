<?php

namespace App\Infrastructure\Commands\DataTransferObjects\Common;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;

final class CommandArgumentDTO extends AbstractDTO
{
    protected string $alias;

    protected string $description;

    protected ?string $value;

    protected bool $required = false;

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function setAlias(string $alias): CommandArgumentDTO
    {
        $this->alias = $alias;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): CommandArgumentDTO
    {
        $this->description = $description;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(?string $value): CommandArgumentDTO
    {
        $this->value = $value;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setRequired(bool $required): CommandArgumentDTO
    {
        $this->required = $required;

        return $this;
    }
}
