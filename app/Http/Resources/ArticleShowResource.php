<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleShowResource extends JsonResource
{
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'url' => route('articles.show', $this->slug),
            'title' => $this->title,
            'date' => $this->published_at?->format('Y-m-d'),
            'author' => new AuthorResource($this->author),
            'content' => $this->content,
        ];
    }
}
