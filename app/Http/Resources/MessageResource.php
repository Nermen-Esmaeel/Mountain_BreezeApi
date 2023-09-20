<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
            'Full Name' => $this->full_name,
            'Email' => $this->email,
            'Phone' => $this->phone,
            'Subject' => $this->subject,
            'content' => $this->content,
            'agree' => $this->agree,
            'created_at' => $this->created_at->format('d/m/Y'),


        ];
    }
}
