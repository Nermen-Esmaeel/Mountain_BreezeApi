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

            
            'article_cover' => $this->article_cover,
            'category' => $this->category,
            'title' => $this->title,
            'content' => $this->content,
            'date' => $this->date,
            'created_at' => $this->created_at->format('d/m/Y'),
            'updated_at' => $this->updated_at->format('d/m/Y'),
           'article.images'=>  ImageResource::collection($this->images),
        ];
    }
}
