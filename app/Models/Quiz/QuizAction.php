<?php

namespace App\Models\Quiz;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class QuizAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'alias',
        'type',
        'value',
    ];

    public function quiz(): HasMany
    {
        return $this->hasMany(Quiz::class, 'action_id');
    }
}
