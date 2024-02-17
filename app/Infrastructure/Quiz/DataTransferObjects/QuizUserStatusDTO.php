<?php

namespace App\Infrastructure\Quiz\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class QuizUserStatusDTO extends AbstractDTO
{
    protected ?int $id;

    protected int $quizId;

    protected int $userId;

    protected bool $isDone;

    protected ?Carbon $doneAt;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): QuizUserStatusDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getQuizId(): int
    {
        return $this->quizId;
    }

    public function setQuizId(int $quizId): QuizUserStatusDTO
    {
        $this->quizId = $quizId;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): QuizUserStatusDTO
    {
        $this->userId = $userId;

        return $this;
    }

    public function isDone(): bool
    {
        return $this->isDone;
    }

    public function setIsDone(bool $isDone): QuizUserStatusDTO
    {
        $this->isDone = $isDone;

        return $this;
    }

    public function getDoneAt(): ?Carbon
    {
        return $this->doneAt;
    }

    public function setDoneAt(?Carbon $doneAt): QuizUserStatusDTO
    {
        $this->doneAt = $doneAt;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): QuizUserStatusDTO
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): QuizUserStatusDTO
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
