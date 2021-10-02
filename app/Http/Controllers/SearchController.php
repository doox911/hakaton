<?php

namespace App\Http\Controllers;

use App\Classes\CustomSearch;
use App\Classes\ImagesWikiSearch;
use App\Classes\WikiSearch;
use App\Classes\YandexSearch;
use App\Classes\YouTubeSearch;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\JsonResponse;

class SearchController {

  private const video_searchers = [
    'youtube' => YouTubeSearch::class,
  ];

  private const image_searchers = [
    'image_wiki' => ImagesWikiSearch::class,
  ];

  private const article_searchers = [
    'yandex' => YandexSearch::class,
    'wiki' => WikiSearch::class,
  ];

  /**
   * Осуществляется поиск по всем ресурсам с использованием предпочтений поиска пользователя
   *
   * @param \App\Http\Requests\SearchRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function search(SearchRequest $request): JsonResponse {
    $data = $request->validated();

    $result = [];

    foreach ($data['filters'] as $content_type) {

      $searchers = "self::{$content_type}_searchers";

      if (defined($searchers)) {
        foreach (constant($searchers) as $key => $searcher) {
          if (in_array($key, $data['searchers'])) {
            $searcher = new $searcher;
            $result[$content_type] = array_merge($result[$content_type], $searcher->search($data['search']));
          }
        }
      } else {
        $result['custom'] = array_merge(
          $result[$content_type],
          (new CustomSearch())->setUrl('https://custom_url.org')->search($data['search'])
        );
      }
    }

    return response()->json([
      'content' => $result
    ], 200);
  }
}
