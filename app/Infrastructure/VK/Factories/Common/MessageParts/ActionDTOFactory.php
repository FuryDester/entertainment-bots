<?php

namespace App\Infrastructure\VK\Factories\Common\MessageParts;

use App\Domain\VK\Factories\Common\MessageParts\ActionDTOFactoryContract;
use App\Domain\VK\Factories\Common\MessageParts\ActionParts\PhotoDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;
use App\Infrastructure\VK\Enums\MessageEventTypeEnum;

final readonly class ActionDTOFactory implements ActionDTOFactoryContract
{
    public static function createFromParams(
        MessageEventTypeEnum $type,
        ?int $memberId,
        ?string $text,
        ?string $email,
        ?PhotoDTO $photo,
    ): ActionDTO {
        return (new ActionDTO)
            ->setType($type)
            ->setMemberId($memberId)
            ->setText($text)
            ->setEmail($email)
            ->setPhoto($photo);
    }

    /**
     * {@inheritDoc}
     */
    public static function createFromApiData(array $data): ActionDTO
    {
        /** @var PhotoDTOFactoryContract $photoFactory */
        $photoFactory = app(PhotoDTOFactoryContract::class);

        return (new ActionDTO)
            ->setType(MessageEventTypeEnum::from($data['type']))
            ->setMemberId($data['member_id'] ?? null)
            ->setText($data['text'] ?? null)
            ->setEmail($data['email'] ?? null)
            ->setPhoto(($data['photo'] ?? null) ? $photoFactory::createFromApiData($data['photo']) : null);
    }
}
