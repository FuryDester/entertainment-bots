<?php

namespace App\Domain\VK\Factories\Common\CommentParts;

use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\DonutDTO;

interface DonutDTOFactoryContract
{
    public static function createByParams(bool $isDon, string $placeholder): DonutDTO;
}
