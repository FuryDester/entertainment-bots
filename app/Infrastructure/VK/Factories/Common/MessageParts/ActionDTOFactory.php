<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\MessageParts\ActionDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;
use App\Infrastructure\VK\Enums\MessageEventTypeEnum;

final class ActionDTOFactory implements ActionDTOFactoryContract
{
    public static function createFromParams(
        MessageEventTypeEnum $type,
        ?int $memberId,
        ?string $text,
        ?string $email,
        ?PhotoDTO $photo,
    ): ActionDTO {
        return (new ActionDTO())
            ->setType($type)
            ->setMemberId($memberId)
            ->setText($text)
            ->setEmail($email)
            ->setPhoto($photo);
    }
}
