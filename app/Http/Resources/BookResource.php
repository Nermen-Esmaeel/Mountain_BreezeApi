<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
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
            'Full_Name' => $this->full_name,
            'Phone' => $this->phone,
            'Email' => $this->email,
            'Check_in_date' => $this->check_in_date,
            'Check_out_date' => $this->check_out_date,
            'Room_Type' => $this->room_type,
            'guests_number' => $this->guests_number,
            'content' => $this->content,
            'created_at' => $this->created_at->format('d/m/Y'),


        ];
    }
}
