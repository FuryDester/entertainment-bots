<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

final class QuizAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'answer',
        'question_id',
        'is_correct',
    ];

    public function question(): HasOne
    {
        return $this->hasOne(QuizQuestion::class, localKey: 'question_id');
    }
}
