<?php

namespace App\Infrastructure\Quiz\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Carbon\Carbon;

final class QuizDTO extends AbstractDTO
{
    protected ?int $id;

    protected string $title;

    protected string $description = '';

    protected string $image = '';

    protected ?Carbon $startsAt;

    protected ?Carbon $endsAt;

    protected ?int $actionId;

    protected int $questionCooldown = 0;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): QuizDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): QuizDTO
    {
        $this->title = $title;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): QuizDTO
    {
        $this->description = $description;
        return $this;
    }

    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): QuizDTO
    {
        $this->image = $image;
        return $this;
    }

    public function getStartsAt(): ?Carbon
    {
        return $this->startsAt;
    }

    public function setStartsAt(?Carbon $startsAt): QuizDTO
    {
        $this->startsAt = $startsAt;
        return $this;
    }

    public function getEndsAt(): ?Carbon
    {
        return $this->endsAt;
    }

    public function setEndsAt(?Carbon $endsAt): QuizDTO
    {
        $this->endsAt = $endsAt;
        return $this;
    }

    public function getActionId(): ?int
    {
        return $this->actionId;
    }

    public function setActionId(?int $actionId): QuizDTO
    {
        $this->actionId = $actionId;
        return $this;
    }

    public function getQuestionCooldown(): int
    {
        return $this->questionCooldown;
    }

    public function setQuestionCooldown(int $questionCooldown): QuizDTO
    {
        $this->questionCooldown = $questionCooldown;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): QuizDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): QuizDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
