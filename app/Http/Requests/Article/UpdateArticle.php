<?php

namespace App\Http\Requests\Article;

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
            'article_cover' => 'image|file',
            'category' => 'in:Resort Events,Sport Events,Nature,Activity,Chalet,Restaurant,Pool',
            'title_en' => 'nullable|string',
            'title_ar' => 'nullable|string',
            'sub_title_en' => 'string',
            'sub_title_ar' => 'string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'date'     => 'nullable'
        ];
    }

    public function messages(){
        return [

            'category.in'    => 'category field must be Resort Events , Sport Events , Nature , Activity , Chalet , Restaurant or Pool ',
            'title_en.regex' => 'The title_en must include only english letters.',
            'title_ar.regex' => 'The title_ar must include only arabic letters.',
            'content_en.regex' => 'The content_en must include only english letters.',
            'content_ar.regex' => 'The content_ar must include only arabic letters.',

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
