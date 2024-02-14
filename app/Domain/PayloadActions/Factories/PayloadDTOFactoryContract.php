<?php

namespace App\Domain\PayloadActions\Factories;

use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;

interface PayloadDTOFactoryContract
{
    public static function createFromParams(string $type, ?int $id = null, ?array $data = null): PayloadDTO;
}
