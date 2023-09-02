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
<<<<<<< HEAD
            'name' => $this->name,
            'type' => $this->type,
            'guests_number' => $this->guests_number,
            'price' => $this->price,
            'content' => $this->content,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
=======
            'name' => [
                'en' => $this->name_en,
                'ar' => $this->name_ar,
            ],
            'content' => [
                'en' => $this->content_en,
                'ar' => $this->content_ar,
            ],
            'type' => $this->type,
            'guests_number' => $this->guests_number,
            'price' => $this->price,
>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
            'room.images' =>  ImageResource::collection($this->images),
        ];
    }
}
