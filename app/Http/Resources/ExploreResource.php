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

            'id' => $this->id,
            'article_cover' => asset($this->article_cover),
            'title' => [
                'en' => $this->title_en,
                'ar' => $this->title_ar,
            ],
            'sub_title' => [
                'en' => $this->sub_title_en,
                'ar' => $this->sub_title_ar,
            ],
            'description' => [
                'en' => $this->content_en,
                'ar' => $this->content_ar,
            ],
            'category' => $this->category,
            'date' => $this->date,
            'videos'     =>  ArticleVideoResource::collection($this->videos),
            'images' => ImageResource::collection($this->images)
        ];
    }
}
