<?php

namespace App\Infrastructure\Quiz\Enums\Cache;

enum QuizTagsEnum: string
{
    case QuizRepository = 'quiz_repository';
    case QuizUserStatusesRepository = 'quiz_user_statuses_repository';
    case QuizQuestionRepository = 'quiz_question_repository';
    case QuizUserStatusRepository = 'quiz_user_status_repository';
    case QuizUserAnswerRepository = 'quiz_user_answer_repository';
    case QuizAnswerRepository = 'quiz_answer_repository';
    case QuizActionRepository = 'quiz_action_repository';
}
