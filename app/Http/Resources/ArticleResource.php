<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
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
            'article_cover' => $this->article_cover,
            'category' => $this->category,
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

            'date' => $this->date,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),

            'tags' =>  TagResource::collection($this->whenLoaded('tags')),
            'images' =>  ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
