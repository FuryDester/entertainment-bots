<?php

namespace App\Domain\VK\Factories\Common;

use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\DonutDTO;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentParts\ThreadDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;

interface CommentDTOFactoryContract
{
    /**
     * @param array{
     *     id: int,
     *     from_id: int,
     *     date: int,
     *     text: string|null,
     *     donut?: DonutDTO,
     *     owner_id: int,
     *     post_id: int,
     *     reply_to_user?: int,
     *     reply_to_comment?: int,
     *     attachments: object[],
     *     parents_stack: int[],
     *     thread?: ThreadDTO,
     * } $data
     */
    public static function createFromData(array $data): CommentDTO;

    public static function createFromCallbackData(CallbackRequestDTO $request): CommentDTO;
}
