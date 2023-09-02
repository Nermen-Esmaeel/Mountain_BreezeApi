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
<<<<<<< HEAD
            'category_en' => $this->category_en,
            'category_ar' => $this->category_ar,
            'title_en' => $this->title_en,
            'title_ar' => $this->title_ar,
            'content_en' => $this->content_en,
            'content_ar' => $this->content_ar,
=======
            'category' => [
                'en' => $this->category_en,
                'ar' => $this->category_ar,
            ],
            'title' => [
                'en' => $this->title_en,
                'ar' => $this->title_ar,
            ],

             'content' => [
                'en' => $this->content_en,
                'ar' => $this->content_ar,
            ],

>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
            'image_size' => $this->image_size,


        ];
    }
}
