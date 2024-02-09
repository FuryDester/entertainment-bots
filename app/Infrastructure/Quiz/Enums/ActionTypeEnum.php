<?php

namespace App\Infrastructure\Quiz\Enums;

enum ActionTypeEnum: string
{
    case PerQuestion = 'question';
    case PerQuiz = 'quiz';
}
