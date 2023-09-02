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
<<<<<<< HEAD
       
        return [

          
            'Full Name' => $this->full_name,
            'Phone' => $this->phone,
            'Email' => $this->email,
            // 'Check_in_date' => $this->check_in_date->format('d/m/Y'),
            // 'Check_out_date' => $this->check_out_date->format('d/m/Y'),
            'Room Type' => $this->room_type,
            'guests_number' => $this->guests_number,
            'content' => $this->content,
        
=======

        return [

            'Full Name' => $this->full_name,
            'Phone' => $this->phone,
            'Email' => $this->email,
            'Check_in_date' => $this->check_in_date,
            'Check_out_date' => $this->check_out_date,
            'Room Type' => $this->room_type,
            'guests_number' => $this->guests_number,
            'content' => $this->content,
            'created_at' => $this->created_at->format('d/m/Y'),

>>>>>>> 6f78e98 (feat(controller,middleware):Booking management)
        ];
    }
}