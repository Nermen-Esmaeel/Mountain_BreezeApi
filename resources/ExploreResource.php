<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExploreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'article_cover' => $this->article_cover,
            'title' => [
                'en' => $this->title_en,
                'ar' => $this->title_ar,
            ],
            'description' => [
                'en' => $this->content_en,
                'ar' => $this->content_ar,
            ],
            'tags' => $this->tags,
            'date' => $this->date,
            'section' => $this->section

        ];
    }
}
