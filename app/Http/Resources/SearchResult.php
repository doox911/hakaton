<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class SearchResult extends JsonResource {
  /**
   * Transform the resource into an array.
   * {
   *  title: string, - Заголовок контента
   *  content: string - контент
   *  type: string, - тип контента
   *  source: string - источник контента
   * }
   *
   * @param \Illuminate\Http\Request $request
   * @return array
   */
    public function toArray($request): array {

        $search_result = $this->resource;

        return [
            'title' => $search_result->title,
            'content' => $search_result->content,
            'type' => $search_result->type,
            'source' => $search_result->source,
        ];
    }
}
