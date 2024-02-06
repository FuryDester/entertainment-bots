<?php

namespace App\Domain\VK\Factories\Common\MessageParts;

use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\MessageParts\ActionParts\PhotoDTO;
use App\Infrastructure\VK\Enums\MessageEventTypeEnum;

interface ActionDTOFactoryContract
{
    public static function createFromParams(
        MessageEventTypeEnum $type,
        ?int $memberId,
        ?string $text,
        ?string $email,
        ?PhotoDTO $photo,
    ): ActionDTO;

    /**
     * @param array{
     *     type: string,
     *     member_id: int|null,
     *     text: string|null,
     *     email: string|null,
     *     photo: array|null,
     * } $data
     */
    public static function createFromApiData(array $data): ActionDTO;
}
