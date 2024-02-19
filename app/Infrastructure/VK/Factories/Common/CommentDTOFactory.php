<?php

namespace App\Infrastructure\VK\Factories\Common;

use App\Domain\VK\Factories\Common\CommentDTOFactoryContract;
use App\Domain\VK\Factories\Common\CommentParts\DonutDTOFactoryContract;
use App\Domain\VK\Factories\Common\CommentParts\ThreadDTOFactoryContract;
use App\Infrastructure\VK\DataTransferObjects\Common\CommentDTO;
use App\Infrastructure\VK\DataTransferObjects\Requests\CallbackRequestDTO;

final readonly class CommentDTOFactory implements CommentDTOFactoryContract
{

    /**
     * @inheritDoc
     */
    public static function createFromData(array $data): CommentDTO
    {
        return (new CommentDTO)
            ->setId($data['id'])
            ->setFromId($data['from_id'])
            ->setText($data['text'] ?? null)
            ->setDonut($data['donut'] ?? null)
            ->setReplyToUser($data['reply_to_user'] ?? null)
            ->setReplyToComment($data['reply_to_comment'] ?? null)
            ->setAttachments($data['attachments'])
            ->setParentsStack($data['parents_stack'] ?? [])
            ->setThread($data['thread'] ?? null)
            ->setPostId($data['post_id'])
            ->setOwnerId($data['owner_id']);
    }

    public static function createFromCallbackData(CallbackRequestDTO $request): CommentDTO
    {
        $data = $request->getObject();

        $donut = null;
        if ($data['donut'] ?? null) {
            /** @var DonutDTOFactoryContract $donutFactory */
            $donutFactory = app(DonutDTOFactoryContract::class);
            $donut = $donutFactory::createByParams($data['donut']['is_don'], $data['donut']['placeholder']);
        }

        $thread = null;
        if ($data['thread'] ?? null) {
            /** @var ThreadDTOFactoryContract $threadFactory */
            $threadFactory = app(ThreadDTOFactoryContract::class);
            $thread = $threadFactory::createFromParams(
                $data['thread']['count'],
                $data['thread']['items'] ?? null,
                $data['thread']['can_post'] ?? null,
                $data['thread']['show_reply_button'] ?? null,
                $data['thread']['groups_can_post'] ?? null,
            );
        }

        return (new CommentDTO)
            ->setId($data['id'])
            ->setFromId($data['from_id'])
            ->setText($data['text'] ?? null)
            ->setDonut($donut)
            ->setReplyToUser($data['reply_to_user'] ?? null)
            ->setReplyToComment($data['reply_to_comment'] ?? null)
            ->setAttachments($data['attachments'])
            ->setParentsStack($data['parents_stack'] ?? [])
            ->setThread($thread)
            ->setPostId($data['post_id'])
            ->setOwnerId($data['owner_id']);
    }
}
