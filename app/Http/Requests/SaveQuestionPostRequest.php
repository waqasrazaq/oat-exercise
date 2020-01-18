<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class SaveQuestionPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => 'required',
            'createdAt' => 'required',
            'choices' => 'required|array|min:3|max:3',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'text.required' => 'text field is required',
            'createdAt.required' => 'createdAt field is required',
            'choices.required' => 'choices field is required',
            'choices.array' => 'choices field must be a list',
            'choices.min' => 'There must be three choices in a question',
            'choices.max' => 'More than three choices are not allowed',
        ];
    }

    /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json(['errors' => $errors
        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY));
    }
}
