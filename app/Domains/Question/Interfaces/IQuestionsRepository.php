<?php


namespace App\Domains\Question\Interfaces;

use App\Domains\Question\Models\Question;

/**
 * Interface IQuestionsRepository
 * @package App\Domains\Question\Interfaces
 */
interface IQuestionsRepository
{
    /**
     * @return mixed
     */
    public function getQuestions();

    /**
     * @param Question $new_question
     * @return mixed
     */
    public function saveQuestion(Question $new_question);
}
