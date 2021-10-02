<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use Illuminate\Support\Collection;

/**
 * YouTube scrapper
 */
class RuTubeSearch extends AbstractSearch {

  protected static string $url = 'https://rutube.ru/api/search/video/?query=%s';

  public function search(string $search_string): Collection {
    $videos = collect();

    $search_string = mb_strtolower($search_string);
    $request_words = explode(' ', $search_string);

    // search card
    $url = sprintf(self::$url, implode('+', $request_words));
    $res = $this->client->request('GET', $url);
    $response_json = json_decode($res->getBody());
    foreach ($response_json->results as $video) {
      $info = [
        'title' => $video->title,
        'image_url' => $video->thumbnail_url,
        'content' => $video->description,
        'type' => 'video',
        'source' => $video->video_url,
        'source_type' => strtolower(self::class),
      ];

      $videos->push($info);
    }

    return $videos;
  }
}
