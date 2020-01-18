<?php


namespace App\Domains\Question\Models;

/**
 * Class Question
 * @package App\Domains\Question\Models
 */
class Question
{
    public $text = "";
    public $createdAt = "";
    public $choices = [];

    /**
     * Question constructor.
     * @param $text
     * @param $created_at
     * @param $choice_one
     * @param $choice_two
     * @param $choice_three
     */
    public function __construct($text, $created_at, $choice_one, $choice_two, $choice_three)
    {
        $this->text = $text;
        $this->createdAt = $created_at;
        array_push($this->choices, array("text"=>$choice_one));
        array_push($this->choices, array("text"=>$choice_two));
        array_push($this->choices, array("text"=>$choice_three));
    }

    /**
     * @return false|string
     */
    public function toJSON()
    {
        return json_encode(array("text"=>$this->text, "created_at"=>$this->createdAt, "choices"=>$this->choices));
    }
}
