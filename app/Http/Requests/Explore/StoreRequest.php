<?php

namespace App\Http\Requests\Explore;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'article_cover' => 'required|image|file',
            'tags' => 'required|in:Events,Nature,Activity,Chalet,Restaurant,Pool',
            'title_en' => 'required|string|max:255|regex:/^[a-zA-Z& ]+$/|max:100',
            'title_ar' => 'required|string|max:255|regex:/^[\p{Arabic} ]+$/u|max:100',
            'content_en' => 'nullable|string|regex:/^[a-zA-Z& ]+$/|max:1500',
            'content_ar' => 'nullable|string|regex:/^[\p{Arabic} ]+$/u|max:1500',
            'date'     => 'nullable|date',
            'section' => 'required_if:tags,Events|date'
        ];
    }
}
