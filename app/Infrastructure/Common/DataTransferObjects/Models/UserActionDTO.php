<?php

namespace App\Infrastructure\Common\DataTransferObjects\Models;

use App\Infrastructure\Common\DataTransferObjects\AbstractDTO;
use Illuminate\Support\Carbon;

final class UserActionDTO extends AbstractDTO
{
    protected int $userId;

    protected int $quizActionId;

    protected ?Carbon $endsAt;

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): UserActionDTO
    {
        $this->userId = $userId;

        return $this;
    }

    public function getQuizActionId(): int
    {
        return $this->quizActionId;
    }

    public function setQuizActionId(int $quizActionId): UserActionDTO
    {
        $this->quizActionId = $quizActionId;

        return $this;
    }

    public function getEndsAt(): ?Carbon
    {
        return $this->endsAt;
    }

    public function setEndsAt(?Carbon $endsAt): UserActionDTO
    {
        $this->endsAt = $endsAt;

        return $this;
    }
}
