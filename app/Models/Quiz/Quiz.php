<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class Quiz extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'starts_at',
        'ends_at',
        'action_id',
        'question_cooldown',
    ];

    public function action(): HasOne
    {
        return $this->hasOne(QuizAction::class, localKey: 'action_id');
    }

    public function questions(): BelongsTo
    {
        return $this->belongsTo(QuizQuestion::class);
    }

    public function userStatuses(): BelongsTo
    {
        return $this->belongsTo(QuizUserStatus::class);
    }
}
