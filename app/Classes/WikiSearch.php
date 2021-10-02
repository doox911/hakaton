<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use DiDom\Document;
use Illuminate\Support\Collection;

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
   * @return \Illuminate\Support\Collection
   * @throws \DiDom\Exceptions\InvalidSelectorException
   * @throws \GuzzleHttp\Exception\GuzzleException
   */
  public function search(string $search_string): Collection {
    $items = collect();

    $search_string = mb_strtolower($search_string);
    $request_words = explode(' ', $search_string);

    $url = self::$base_url . '/w/index.php?search=';
    $url .= implode('+', $request_words);
    $url .= '&title=Служебная:Поиск&go=Перейти&profile=advanced&fulltext=1&ns0=1';

    $res = $this->client->request('GET', $url);
    $response_html = (string)$res->getBody();

    $search_page_document = new Document($response_html);
    $founded_links = collect();

    foreach ($search_page_document->find('.mw-search-result-heading > a') as $result_text) {
      $external_link = urldecode(self::$base_url . $result_text->attr('href'));
      $founded_links->push($external_link);
    }

    // парсим найденные ссылки и собираем результаты в объекты
    foreach ($founded_links as $link) {
      $res = $this->client->request('GET', $link);
      $response_html = (string)$res->getBody();

      $article_page_document = new Document($response_html);

      // удаляем не нужные элементы
      collect($article_page_document->find('[role=navigation]'))->each->remove();
      collect($article_page_document->find('.mw-editsection'))->each->remove();
      //collect($article_page_document->find('.mw-parser-output'))->each->remove();
      collect($article_page_document->find('sup.reference'))->each->remove();
      collect($article_page_document->find('style'))->each->remove();
      collect($article_page_document->find('script'))->each->remove();
      collect($article_page_document->find('head'))->each->remove();

      $article = (object)[
        'title' => $article_page_document->first('h1.firstHeading')->text(),
        'content' => html_entity_decode($article_page_document->first('.mw-body-content')->text()),
        'type' => 'text',
        'source' => $link,
        'source_type' => strtolower(self::class),
      ];

      $items->push($article);
    }

    return $items;
  }
}
