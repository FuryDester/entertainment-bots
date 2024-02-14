<?php

namespace App\Infrastructure\PayloadActions\Enums;

enum ActionStageEnum: string
{
    case Index = 'index';
    case QuizInfo = 'quiz_info';
    case QuizProgress = 'quiz_progress';
}
