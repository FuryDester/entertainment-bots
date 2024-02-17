<?php

namespace App\Models\Common;

use App\Models\Quiz\QuizUserAnswer;
use App\Models\Quiz\QuizUserStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'vk_user_id',
        'vk_peer_id',
        'is_admin',
        'state',
        'data',
        'last_activity_at',
    ];

    public function userAnswers(): HasMany
    {
        return $this->hasMany(QuizUserAnswer::class);
    }

    public function quizStatuses(): HasMany
    {
        return $this->hasMany(QuizUserStatus::class);
    }
}
