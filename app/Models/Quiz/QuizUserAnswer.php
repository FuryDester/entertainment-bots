<?php

namespace App\Models\Quiz;

use App\Models\Common\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class QuizUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'question_id',
        'answer_id',
        'answer_text',
        'answered_at',
    ];

    public function question(): HasOne
    {
        return $this->hasOne(QuizQuestion::class, localKey: 'question_id');
    }

    public function answer(): HasOne
    {
        return $this->hasOne(QuizAnswer::class, localKey: 'answer_id');
    }

    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
}
