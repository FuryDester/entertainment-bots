<?php

namespace App\Listeners\Quiz;

use App\Events\Quiz\QuizQuestionAnswered;

final class CheckForQuestionAction
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
    public function handle(QuizQuestionAnswered $event): void
    {
        // TODO: Implement actions here
    }
}
