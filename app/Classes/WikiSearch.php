<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use App\Http\Resources\SearchResult;
use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Wikipedia scrapper
 *
 * Статьи с википедии
 *
 * sudo apt-get update
 * sudo apt-get install composer
 * composer require imangazaliev/didom
 */
class WikiSearch extends AbstractSearch {

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

    $is_first = true;
    foreach ($request_words as $word) {
      if (!$is_first) {
        $url .= '+';
      }

      $url .= $word;

      $is_first = false;
    }

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

      // удаляем не нужные элементы
      collect($article_page_document->find('[role=navigation]'))->each->remove();
      collect($article_page_document->find('.mw-editsection'))->each->remove();
      collect($article_page_document->find('sup.reference'))->each->remove();

      $article = (object)[
        'title' => $article_page_document->first('h1.firstHeading')->text(),
        'content' => $article_page_document->first('.mw-body-content')->text(),
        'type' => 'text',
        'source' => $link,
      ];

      $items->push($article);
    }

    return SearchResult::collection($items);
  }
}
