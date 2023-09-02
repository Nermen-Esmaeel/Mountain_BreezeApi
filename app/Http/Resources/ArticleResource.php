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
            'article_cover' => asset($this->article_cover),
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

            'date' => $this->date,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
           'article.images'=>  ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
