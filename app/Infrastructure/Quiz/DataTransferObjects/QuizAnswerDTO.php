<?php

namespace App\Infrastructure\Quiz\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class QuizAnswerDTO extends AbstractDTO
{
    protected ?int $id;

    protected string $answer;

    protected int $questionId;

    protected bool $isCorrect;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): QuizAnswerDTO
    {
        $this->id = $id;

        return $this;
    }

    public function getAnswer(): string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer): QuizAnswerDTO
    {
        $this->answer = $answer;

        return $this;
    }

    public function getQuestionId(): int
    {
        return $this->questionId;
    }

    public function setQuestionId(int $questionId): QuizAnswerDTO
    {
        $this->questionId = $questionId;

        return $this;
    }

    public function isCorrect(): bool
    {
        return $this->isCorrect;
    }

    public function setIsCorrect(bool $isCorrect): QuizAnswerDTO
    {
        $this->isCorrect = $isCorrect;

        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): QuizAnswerDTO
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): QuizAnswerDTO
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
