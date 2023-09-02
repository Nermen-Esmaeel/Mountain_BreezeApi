<?php

namespace App\Http\Requests\Galary;

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
            'type' => 'required|in:Events,Nature,Activity,Chalet,Restaurant',
            'images.*' => 'required'
        ];
    }
}
