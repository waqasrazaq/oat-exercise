<?php
namespace App\Domains\Question\Classes;

use App\Domains\Question\Helpers\QuestionTranslator;
use App\Domains\Question\Models\Question;

/**
 * Class QuestionsManager
 * @package App\Domains\Question\Classes
 */
class QuestionsManager
{
    private $questionRepo;

    /**
     * QuestionsManager constructor.
     */
    public function __construct()
    {
        if((config('common.question_source')==="JSON"))
            $this->questionRepo = new JSONQuestionRepository();
        else if ((config('common.question_source')==="CSV"))
            $this->questionRepo = new CSVQuestionRepository();
    }

    /**
     * @param $lang
     * @return mixed
     * @throws \ErrorException
     */
    public function getAllQuestions($lang)
    {
        return QuestionTranslator::translateQuestions($this->questionRepo->getQuestions(), $lang);
    }

    /**
     * @param Question $question
     * @return Question|mixed
     */
    public function saveQuestion(Question $question)
    {
        return $this->questionRepo->saveQuestion($question);
    }
}
