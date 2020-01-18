<?php


namespace App\Domains\Question\Classes;

use App\Domains\Question\Interfaces\IQuestionsRepository;
use App\Domains\Question\Models\Question;

/**
 * Class CSVQuestionRepository
 * @package App\Domains\Question\Classes
 */
class CSVQuestionRepository implements IQuestionsRepository
{
    /**
     * @return array|mixed
     */
    public function getQuestions()
    {
        $file = fopen(storage_path()."/".config('common.data_files_path')."/".config('common.csv_filename'), "r");
        $all_data = array();

        $header = true;
        while (($data = fgetcsv($file, 0, ",")) !==FALSE)
        {
            if ($header) {
                $header = false;
                continue;
            }
            array_push($all_data, new Question($data[0], $data[1], $data[2], $data[3], $data[4]));
        }
        fclose($file);

        return $all_data;
    }

    /**
     * @param Question $new_question
     * @return Question|mixed
     */
    public function saveQuestion(Question $new_question)
    {
        $handle = fopen(storage_path()."/".config('common.data_files_path')."/".config('common.csv_filename'), "a");
        fputcsv($handle,
            array(
                $new_question->text,
                $new_question->createdAt,
                $new_question->choices[0]["text"],
                $new_question->choices[1]["text"],
                $new_question->choices[2]["text"]
            )
        );
        fclose($handle);
        return $new_question;
    }
}
