<?php

namespace App\Listeners\Quiz;

use App\Events\Quiz\QuizCompleted;

final readonly class CheckForQuizAction
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     */
    public function handle(QuizCompleted $event): void
    {
        // TODO: Implement actions here
    }
}
