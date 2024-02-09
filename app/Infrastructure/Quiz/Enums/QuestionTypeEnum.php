<?php

namespace App\Infrastructure\Quiz\Enums;

enum QuestionTypeEnum: string
{
    case Single = 'single';
    case Multiple = 'multiple';
    case Open = 'open';
}
