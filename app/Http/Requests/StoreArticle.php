<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreArticle extends FormRequest
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

            'category' => 'required|string|max:255',
            'title' => 'required|string|max:255|regex:/^[a-zA-Z& ]+$/',
            'content' => 'required|string|regex:/^[a-zA-Z& ]+$/|between:30,600',
            'date'     => 'required|date'
        ];
    }

    public function messages(){
        return [
            'category'    => 'The category field is required! ',
            'title.regex' => 'The title must include only english letters.',
            'content.regex' => 'The description must include only english letters.',
             'date.required' => 'Date field is required!' ,

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
