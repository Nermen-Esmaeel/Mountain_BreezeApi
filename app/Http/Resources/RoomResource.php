<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RoomResource extends JsonResource
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
            'title' => [
                'en' => $this->title_en,
                'ar' => $this->title_ar,
            ],
            'sub_title' => [
                'en' => $this->sub_title_en,
                'ar' => $this->sub_title_ar,
            ],
            'content' => [
                'en' => $this->content_en,
                'ar' => $this->content_ar,
            ],
            'type' => $this->type,
            'guests_number' => $this->guests_number,
            'floor' => $this->floor,
            'room_services' => $this->room_services,
            'bed' => $this->bed,
            'TV' => $this->TV,
            'price' => $this->price,
            'images' =>  ImageResource::collection($this->images),
        ];
    }
}
