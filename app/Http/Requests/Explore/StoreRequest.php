<?php

namespace App\Http\Requests\Explore;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'article_cover' => 'required|image|file',
            'category' => 'required|in:Events,Nature,Activity,Chalet,Restaurant,Pool',
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'sub_title_en' => 'required|string',
            'sub_title_ar' => 'required|string',
            'content_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'date'     => 'nullable|date',
            'images.*' => 'image',
            'video' => 'url'
        ];
    }
}
