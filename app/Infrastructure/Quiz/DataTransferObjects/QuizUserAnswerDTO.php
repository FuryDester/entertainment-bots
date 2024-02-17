<?php

namespace App\Infrastructure\Quiz\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class QuizUserAnswerDTO extends AbstractDTO
{
    protected ?int $id;

    protected int $questionId;

    protected ?int $answerId;

    protected ?string $answerText;

    protected int $userId;

    protected Carbon $answeredAt;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): QuizUserAnswerDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId): QuizUserAnswerDTO
    {
        $this->questionId = $questionId;

        return $this;
    }

    public function getAnswerId(): ?int
    {
        return $this->answerId;
    }

    public function setAnswerId(?int $answerId): QuizUserAnswerDTO
    {
        $this->answerId = $answerId;

        return $this;
    }

    public function getAnswerText(): ?string
    {
        return $this->answerText;
    }

    public function setAnswerText(?string $answerText): QuizUserAnswerDTO
    {
        $this->answerText = $answerText;

        return $this;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): QuizUserAnswerDTO
    {
        $this->userId = $userId;

        return $this;
    }

    public function getAnsweredAt(): Carbon
    {
        return $this->answeredAt;
    }

    public function setAnsweredAt(Carbon $answeredAt): QuizUserAnswerDTO
    {
        $this->answeredAt = $answeredAt;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): QuizUserAnswerDTO
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): QuizUserAnswerDTO
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
