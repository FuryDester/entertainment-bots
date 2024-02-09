<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class QuizQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'type',
        'points',
        'quiz_id',
    ];

    public function quiz(): HasOne
    {
        return $this->hasOne(Quiz::class);
    }

    public function answers(): BelongsTo
    {
        return $this->belongsTo(QuizAnswer::class, 'question_id');
    }

    public function userAnswers(): BelongsTo
    {
        return $this->belongsTo(QuizUserAnswer::class, 'question_id');
    }
}
