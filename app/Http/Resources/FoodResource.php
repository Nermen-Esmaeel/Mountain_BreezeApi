<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FoodResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,
            'image' => asset($this->image),
            'category' => $this->category,
            'title' => [
                'en' => $this->title_en,
                'ar' => $this->title_ar,
            ],

             'content' => [
                'en' => $this->content_en,
                'ar' => $this->content_ar,
            ],
            'image_size' => $this->image_size,


        ];
    }
}
