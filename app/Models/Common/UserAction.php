<?php

namespace App\Models\Common;

use App\Models\Quiz\QuizAction;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class UserAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_action_id',
        'ends_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quizAction(): BelongsTo
    {
        return $this->belongsTo(QuizAction::class);
    }
}
