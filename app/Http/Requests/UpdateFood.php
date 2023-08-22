<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateFood extends FormRequest
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

            'image' => 'nullable|image',
            'category' => 'nullable|string|max:255',
            'title' => 'nullable|string|max:255|regex:/^[a-zA-Z& ]+$/',
            'content' => 'nullable|string|regex:/^[a-zA-Z& ]+$/|between:30,600',
            'image_size'     => 'required|in:x1,x3'
            ];
    }

    public function messages(){
        return [

            'category.string'    => 'category field must be string! ',
            'title.regex' => 'The title must include only english letters.',
            'content.regex' => 'The description must include only english letters.',
            'image_size.in' => 'image size must be x1 or x3' ,
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

