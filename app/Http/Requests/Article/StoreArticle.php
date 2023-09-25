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
            'category' => 'required|in:Resort Events,Sport Events,Activity,Nature,Chalet,Restaurant,Pool',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'sub_title_en' => 'required|string',
            'sub_title_ar' => 'required|string',
            'content_en' => 'nullable|string|regex:/^[a-zA-Z& ]+$/',
            'content_ar' => 'nullable|string|regex:/^[\p{Arabic} ]+$/u',
            'date'     => 'nullable|date'
        ];
    }

    public function messages(){
        return [

            'article_cover'   => 'Article cover image field is required!',
            'category.in'    => 'category field must be Resort Events , Sport Events , Nature , Activity , Chalet , Restaurant or Pool ',
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
