<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use App\Http\Resources\SearchResult;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * YouTube scrapper
 */
class YouTubeSearch extends AbstractSearch {

  protected static string $url = 'https://www.youtube.com/';

  public function search(string $search_string): AnonymousResourceCollection {
    $videos = collect();

    $search_string = mb_strtolower($search_string);
    $request_words = explode(' ', $search_string);

    // search card
    $url = sprintf(self::$url, implode('+', $request_words));
    $res = $this->client->request('GET', $url);

    return $videos;
  }
}
