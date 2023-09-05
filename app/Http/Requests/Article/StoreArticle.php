<?php

namespace App\Http\Requests\Article;

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

            'article_cover' => 'required|image|file',
            'category_en' => 'required|in:Westren Food,Oriental Food,Traditional Food',
            'category_ar' => 'required|string|max:255|regex:/^[\p{Arabic} ]+$/u|max:100',
            'title_en' => 'required|string|max:255|regex:/^[a-zA-Z& ]+$/|max:100',
            'title_ar' => 'required|string|max:255|regex:/^[\p{Arabic} ]+$/u|max:100',
            'content_en' => 'required|string|regex:/^[a-zA-Z& ]+$/|max:1500',
            'content_ar' => 'required|string|regex:/^[\p{Arabic} ]+$/u|max:1500',
            'date'     => 'required|date'
        ];
    }

    public function messages(){
        return [

            'article_cover'       => 'Article cover image field is required!',
            'category_en.regex'    => 'The category_en must include only english letters. ',
            'category_ar.regex'    => 'The category_ar must include only arabic letters.',
            'title_en.regex' => 'The title_en must include only english letters.',
            'title_ar.regex' => 'The title_ar must include only arabic letters.',
            'content_en.regex' => 'The content_en must include only english letters.',
            'content_ar.regex' => 'The content_ar must include only arabic letters.',
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
