<?php

namespace App\Models\Common;

use App\Models\Quiz\QuizUserAnswer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'vk_user_id',
        'vk_peer_id',
        'is_admin',
    ];

    public function userAnswers(): BelongsTo
    {
        return $this->belongsTo(QuizUserAnswer::class);
    }
}
