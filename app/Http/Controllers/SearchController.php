<?php

namespace App\Http\Controllers;

use App\Classes\DuckDuckGoArticleSearch;
use App\Classes\ImagesWikiSearch;
use App\Classes\RamblerSearch;
use App\Classes\WikiSearch;
use App\Classes\YandexSearch;
use App\Classes\RuTubeSearch;
use App\Http\Requests\SearchRequest;
use Illuminate\Http\JsonResponse;

class SearchController {

  /**
   * Запрос выполнен успешно
   */
  private const OK_CODE = 200;

  /**
   * По запросу нет результатов
   */
  private const NO_CONTENT_CODE = 204;

  private const video_searchers = [
    'rutube' => RuTubeSearch::class,
  ];

  private const image_searchers = [
    'image_wiki' => ImagesWikiSearch::class,
  ];

  private const article_searchers = [
    'yandex' => YandexSearch::class,
    'duck' => DuckDuckGoArticleSearch::class,
    'wiki' => WikiSearch::class,
    'rambler' => RamblerSearch::class,
  ];

  private const audio_searchers = [];

  private const presentation_searchers = [];

  /**
   * Осуществляется поиск по всем ресурсам с использованием предпочтений поиска пользователя
   *
   * @param \App\Http\Requests\SearchRequest $request
   * @return \Illuminate\Http\JsonResponse
   */
  public function search(SearchRequest $request): JsonResponse {
    $data = $request->validated();
    $code = self::OK_CODE;
    $result = [];

    foreach ($data['filters'] as $content_type) {

      $searchers = "self::{$content_type}_searchers";

      if (defined($searchers)) {
        foreach (constant($searchers) as $key => $searcher) {
          if (in_array($key, $data['searchers'])) {
            $searcher = new $searcher;
            if (isset($result[$content_type])) {
              $result[$content_type] = $result[$content_type]->merge($searcher->search($data['search']));
            } else {
              $result[$content_type] = $searcher->search($data['search']);
            }
          }
        }
      }
    }

    // если нет результатов - код 204
    if (empty($result)) {
      $code = self::NO_CONTENT_CODE;
    }

    // foreach ($result as $content_type => $items) {
    //   $result[$content_type] = SearchResult::collection($items);
    // }

    return response()->json([
      'content' => $result
    ], $code);
  }
}
