<?php

namespace App\Http\Controllers;

use App\Domains\Question\Classes\QuestionsManager;
use App\Domains\Question\Models\Question;
use App\Http\Requests\GetQuestionsRequest;
use App\Http\Requests\SaveQuestionPostRequest;
use Illuminate\Http\JsonResponse;
use Validator;
use Exception;

/**
 * Class QuestionController
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{
    /**
     * @param GetQuestionsRequest $request
     * @param QuestionsManager $questionsManager
     * @return JsonResponse
     */
    public function getQuestions(GetQuestionsRequest $request, QuestionsManager $questionsManager) {
        $lang = $request->input("lang");

        try {
            $questions = $questionsManager->getAllQuestions($lang);
        } catch (Exception $e) {
            return response()->json(['errors' => "Internal server error"], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($questions, JsonResponse::HTTP_OK);
    }

    /**
     * @param SaveQuestionPostRequest $request
     * @param QuestionsManager $questionsManager
     * @return JsonResponse
     */
    public function saveQuestion(SaveQuestionPostRequest $request, QuestionsManager $questionsManager) {

        $question = new Question(
            $request->input("text"),
            $request->input("createdAt"),
            $request->input("choices")[0]["text"],
            $request->input("choices")[1]["text"],
            $request->input("choices")[2]["text"]
        );

        try {
            $question = $questionsManager->saveQuestion($question);
        } catch (Exception $e) {
            return response()->json(['errors' => "Internal server error"], JsonResponse::HTTP_INTERNAL_SERVER_ERROR);
        }

        return response()->json($question, JsonResponse::HTTP_OK);
    }
}
