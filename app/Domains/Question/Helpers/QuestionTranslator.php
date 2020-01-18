<?php


namespace App\Domains\Question\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;

/**
 * Class QuestionTranslator
 * @package App\Domains\Question\Helpers
 */
class QuestionTranslator
{
    /**
     * @param $question_list
     * @param $lang
     * @return mixed
     * @throws \ErrorException
     */
    public static function translateQuestions($question_list, $lang)
    {
        if ($lang==='en')
            return $question_list;

        foreach($question_list as $question) {
            $question->text = GoogleTranslate::trans($question->text, $lang, 'en');

            for($i=0; $i<sizeof($question->choices); $i++) {
                $question->choices[$i]["text"] = GoogleTranslate::trans($question->choices[$i]["text"], $lang, 'en');
            }
        }

        return $question_list;
    }
}
