<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => 'string',
            'title_ar' => 'string',
            'sub_title_en' => 'string',
            'sub_title_ar' => 'string',
            'type' => 'string',
            'guests_number' => 'integer',
            'price' => 'numeric',
            'content_en' => 'string',
            'content_ar' => 'string',
            'images.*' => 'image|file',
            'room_services' => 'boolean',
            'bed' => 'boolean',
            'floor' => 'integer|min:1',
            'TV' => 'boolean'
        ];
    }
}
