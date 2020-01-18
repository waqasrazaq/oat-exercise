<?php


namespace App\Domains\Question\Classes;

use App\Domains\Question\Interfaces\IQuestionsRepository;
use App\Domains\Question\Models\Question;
use Illuminate\Support\Facades\Storage;

/**
 * Class JSONQuestionRepository
 * @package App\Domains\Question\Classes
 */
class JSONQuestionRepository implements IQuestionsRepository
{
    /**
     * @return array|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function getQuestions()
    {
        $raw_question_list = Storage::disk('local')->exists((config('common.json_filename'))) ? json_decode(Storage::disk('local')->get(config('common.json_filename'))) : [];
        $questions = array();
        foreach($raw_question_list as $question_data) {
            $question = new Question(
                $question_data->text,
                $question_data->createdAt,
                $question_data->choices[0]->text,
                $question_data->choices[1]->text,
                $question_data->choices[2]->text
            );
            array_push($questions, $question);
        }
        return $questions;
    }

    /**
     * @param Question $new_question
     * @return Question|mixed
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function saveQuestion(Question $new_question)
    {
        $all_questions = Storage::disk('local')->exists(config('common.json_filename')) ? json_decode(Storage::disk('local')->get(config('common.json_filename'))) : [];
        array_push($all_questions, $new_question);
        Storage::disk('local')->put(config('common.json_filename'), json_encode($all_questions));

        return $new_question;
    }
}
