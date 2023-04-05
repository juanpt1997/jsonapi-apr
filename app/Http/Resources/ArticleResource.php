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
            // ? data is redundant because3 laravel resources actually returns the response encapsulated as data
            // 'data' => [
                'type' => 'articles',
                'id' => (string) $this->resource->getRouteKey(),
                'attributes' => [
                    'title' => $this->resource->title,
                    'slug' => $this->resource->slug,
                    'content' => $this->resource->content,
                ],
                'links' => [
                    'self' => route('api.v1.articles.show', $this->resource),
                ]
            // ]
        ];
    }

    // overriding that method we are able to send the response with a header as the JSON Api Spec requires
    public function toResponse($request)
    {
        return parent::toResponse($request)->withHeaders([
            'Location' => route('api.v1.articles.show', $this->resource)
        ]);
    }
}
