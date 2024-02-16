<?php

namespace App\Infrastructure\PayloadActions\Enums;

enum ActionStageEnum: string
{
    case Index = '';
    case QuizInfo = 'quiz_info';
    case QuizStart = 'quiz_start';
    case QuizProgress = 'quiz_progress';
}
