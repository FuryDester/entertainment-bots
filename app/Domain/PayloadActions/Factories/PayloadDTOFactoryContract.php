<?php

namespace App\Domain\PayloadActions\Factories;

use App\Infrastructure\PayloadActions\DataTransferObjects\PayloadDTO;
use App\Infrastructure\PayloadActions\Enums\ActionStageEnum;

interface PayloadDTOFactoryContract
{
    public static function createFromParams(ActionStageEnum $type, ?int $id = null, ?array $data = null): PayloadDTO;
}
