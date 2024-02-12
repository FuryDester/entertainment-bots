<?php

namespace App\Domain\Quiz\Factories;

use App\Infrastructure\Quiz\DataTransferObjects\QuizDTO;
use Illuminate\Support\Carbon;

interface QuizDTOFactoryContract
{
    /**
     * @param array{
     *     id?: int,
     *     title: string,
     *     description?: string,
     *     image: string,
     *     starts_at?: Carbon,
     *     ends_at?: Carbon,
     *     action_id?: int,
     *     question_cooldown?: int,
     *     created_at?: Carbon,
     *     updated_at?: Carbon,
     * } $data
     */
    public static function createFromData(array $data): QuizDTO;
}
