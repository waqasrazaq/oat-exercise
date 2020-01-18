<?php

namespace Tests\Feature;

use Tests\TestCase;

class QuestionsAPITest extends TestCase
{

    public function testGetQuestionsAPI()
    {
        $response = $this->json('get', '/api/questions?lang=en');

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'text' => 'What is the capital of Luxembourg ?',
            ]);
    }

    public function testGetQuestionsWithInvalidInput() {
        $response = $this->json('get', '/api/questions?lang=34');

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                'lang field must contain only alphabets',
            ]);
    }

    public function testPostQuestionAPI()
    {
        $response = $this->json('post', '/api/questions',
            [ "text"=>"Lorem ipsum", "createdAt"=>"2019-06-01 00:00:00", "choices"=>[["text"=>"choice a"],["text"=>"choice b"], ["text"=>"choice c"]]]);

        $response
            ->assertStatus(200)
            ->assertJsonFragment([
                'text' => 'Lorem ipsum',
            ]);
    }

    public function testPostQuestionAPIWithLessChoices()
    {
        $response = $this->json('post', '/api/questions',
            [ "text"=>"Lorem ipsum", "createdAt"=>"2019-06-01 00:00:00", "choices"=>[["text"=>"choice a"],["text"=>"choice b"]]]);

        $response
            ->assertStatus(422)
            ->assertJsonFragment([
                'There must be three choices in a question',
            ]);
    }
}
