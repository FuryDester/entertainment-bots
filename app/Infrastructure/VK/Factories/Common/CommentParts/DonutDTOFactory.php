<?php

namespace App\Infrastructure\VK\Factories\Common\CommentParts;

use App\Domain\VK\Factories\Common\CommentParts\DonutDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\DonutDTO;

final readonly class DonutDTOFactory implements DonutDTOFactoryContract
{
    public static function createByParams(bool $isDon, string $placeholder): DonutDTO
    {
        return (new DonutDTO)
            ->setIsDon($isDon)
            ->setPlaceholder($placeholder);
    }
}
