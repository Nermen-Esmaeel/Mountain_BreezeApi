<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UpdateArticle extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [

            'category' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255|regex:/^[a-zA-Z& ]+$/',
            'content' => 'nullable|string|regex:/^[a-zA-Z& ]+$/|between:30,600',
            'date'     => 'nullable'
        ];
    }

    public function messages(){
        return [
            'category.string'    => 'category field must be string! ',
            'title.regex' => 'The title must include only english letters.',
            'content.regex' => 'The description must include only english letters.',


        ];
    }
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' =>false,
            'errors' => $validator->errors()
        ]));

    }

}
