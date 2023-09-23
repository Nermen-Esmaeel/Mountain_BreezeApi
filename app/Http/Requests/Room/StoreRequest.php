<?php

namespace App\Http\Requests\Room;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title_en' => 'required|string',
            'title_ar' => 'required|string',
            'sub_title_en' => 'required|string',
            'sub_title_ar' => 'required|string',
            'type' => 'required|string',
            'guests_number' => 'required|integer',
            'price' => 'required|numeric',
            'content_en' => 'required|string',
            'content_ar' => 'required|string',
            'images.*' => 'required',
            'room_services' => 'required|boolean',
            'bed' => 'required|boolean',
            'floor' => 'required|integer|min:1',
            'TV' => 'required|boolean'
        ];
    }
}
