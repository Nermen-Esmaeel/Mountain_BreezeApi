<?php

namespace App\Http\Requests\Food;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreFood extends FormRequest
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
            'image' => 'image|file',
            'category' => 'required|in:Westren Food,Oriental Food,Traditional Food',
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'image_size'     => 'nullable|in:x1,x3'
        ];
    }

    public function messages(){
        return [
            'category.in'    => 'category field must be Westren Food , Oriental Food or Traditional Food',
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
