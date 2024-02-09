<?php

namespace App\Infrastructure\Quiz\DataTransferObjects;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use App\Infrastructure\Quiz\Enums\QuestionTypeEnum;
use Illuminate\Support\Carbon;

final class QuizQuestionDTO extends AbstractDTO
{
    protected ?int $id;

    protected string $question;

    protected QuestionTypeEnum $type;

    protected int $points = 1;

    protected int $quizId;

    protected ?Carbon $createdAt;

    protected ?Carbon $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): QuizQuestionDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getQuestion(): string
    {
        return $this->question;
    }

    public function setQuestion(string $question): QuizQuestionDTO
    {
        $this->question = $question;
        return $this;
    }

    public function getType(): QuestionTypeEnum
    {
        return $this->type;
    }

    public function setType(QuestionTypeEnum $type): QuizQuestionDTO
    {
        $this->type = $type;
        return $this;
    }

    public function getPoints(): int
    {
        return $this->points;
    }

    public function setPoints(int $points): QuizQuestionDTO
    {
        $this->points = $points;
        return $this;
    }

    public function getQuizId(): int
    {
        return $this->quizId;
    }

    public function setQuizId(int $quizId): QuizQuestionDTO
    {
        $this->quizId = $quizId;
        return $this;
    }

    public function getCreatedAt(): ?Carbon
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?Carbon $createdAt): QuizQuestionDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): ?Carbon
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?Carbon $updatedAt): QuizQuestionDTO
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}
