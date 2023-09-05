<?php

namespace App\Http\Requests\Food;

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
            'category_en' => 'required|in:Westren Food,Oriental Food,Traditional Food',
            'category_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic} ]+$/u|max:100',
            'title_en' => 'nullable|string|max:255|regex:/^[a-zA-Z& ]+$/|max:100',
            'title_ar' => 'nullable|string|max:255|regex:/^[\p{Arabic} ]+$/u|max:100',
            'content_en' => 'nullable|string|regex:/^[a-zA-Z& ]+$/|max:1500',
            'content_ar' => 'nullable|string|regex:/^[\p{Arabic} ]+$/u|max:1500',
            'image_size'     => 'required|in:x1,x3'
            ];
    }

    public function messages(){
        return [

            'category.in'    => 'category field must be Westren Food , Oriental Food or Traditional Food',
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

