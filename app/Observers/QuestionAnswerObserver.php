<?php

namespace App\Observers;

use App\Models\QuestionAnswer;

class QuestionAnswerObserver
{
    /**
     * Handle the QuestionAnswer "created" event.
     */
    public function created(QuestionAnswer $questionAnswer): void
    {
        $questionAnswer->question()->update(['status' => 'answered']);
    }

    /**
     * Handle the QuestionAnswer "deleted" event.
     */
    public function deleted(QuestionAnswer $questionAnswer): void
    {
        if ($questionAnswer->question && $questionAnswer->question->answers()->count() === 0) {
            $questionAnswer->question->update(['status' => 'pending']);
        }
    }
}
