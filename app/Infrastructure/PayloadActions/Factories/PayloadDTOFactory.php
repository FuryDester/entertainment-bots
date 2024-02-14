<?php

namespace App\Infrastructure\PayloadActions\Factories;

use App\Domain\PayloadActions\Factories\PayloadDTOFactoryContract;
use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;

final class PayloadDTOFactory implements PayloadDTOFactoryContract
{
    public static function createFromParams(string $type, ?int $id = null, ?array $data = null): PayloadDTO
    {
        return (new PayloadDTO())
            ->setType($type)
            ->setId($id)
            ->setData($data);
    }
}
