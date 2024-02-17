<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function action(): BelongsTo
    {
        return $this->belongsTo(QuizAction::class, 'action_id');
    }

    public function questions(): HasMany
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function userStatuses(): HasMany
    {
        return $this->hasMany(QuizUserStatus::class);
    }
}
