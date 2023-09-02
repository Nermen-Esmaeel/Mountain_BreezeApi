<?php

namespace App\Http\Requests\Explore;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'article_cover' => 'image|file',
            'tags' => 'in:Events,Nature,Activity,Chalet,Restaurant,Pool',
            'title_en' => 'string|max:255|regex:/^[a-zA-Z& ]+$/|max:100',
            'title_ar' => 'string|max:255|regex:/^[\p{Arabic} ]+$/u|max:100',
            'content_en' => 'nullable|string|regex:/^[a-zA-Z& ]+$/|max:1500',
            'content_ar' => 'nullable|string|regex:/^[\p{Arabic} ]+$/u|max:1500',
            'date'     => 'nullable|date',
            'section' => 'date'
        ];
    }
}
