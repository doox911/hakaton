<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use App\Http\Resources\SearchResult;
use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Картинки с википедии
 */
class ImagesWikiSearch extends AbstractSearch  {
  protected static string $base_url = 'https://ru.wikipedia.org';

  /**
   * @param string $search_string
   * @return AnonymousResourceCollection
   * @throws InvalidSelectorException
   * @throws GuzzleException
   */
  public function search(string $search_string): AnonymousResourceCollection {
    $items = collect();

    $search_string = mb_strtolower($search_string);
    $request_words = explode(' ', $search_string);

    $url = self::$base_url . '/w/index.php?search=';
    $url .= implode('+', $request_words);
    $url .= '&title=Служебная:Поиск&go=Перейти&wprov=acrw1_-1';

    $res = $this->client->request('GET', $url);
    $response_html = (string)$res->getBody();

    $search_page_document = new Document($response_html);
    $founded_links = collect();

    foreach ($search_page_document->find('.mw-search-result-heading > a') as $result_text) {
      $founded_links->push(self::$base_url . $result_text->attr('href'));
    }

    // парсим найденные ссылки и собираем результаты в объекты
    foreach ($founded_links as $link) {
      $res = $this->client->request('GET', $link);
      $response_html = (string)$res->getBody();

      $article_page_document = new Document($response_html);

      foreach ($article_page_document->find('a.image img') as $image) {
        $image_url = $image->attr('src');

        if (mb_stristr($image_url, '//') === false) {
          $image_url = self::$base_url . $image_url;
        }

        $items->push((object)[
          'title' => $image->attr('alt'),
          'content' => $image_url,
          'type' => 'image',
          'source' => $link,
        ]);
      }
    }

    return SearchResult::collection($items);
  }
}
