<?php

namespace App\Infrastructure\Quiz\Enums\Cache;

enum QuizEnum: string
{
    case QuizRepository = 'quiz_repository';
    case QuizUserStatusesRepository = 'quiz_user_statuses_repository';
}
