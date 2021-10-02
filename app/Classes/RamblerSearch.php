<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use App\Http\Resources\SearchResult;
use DiDom\Document;
use DiDom\Exceptions\InvalidSelectorException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Throwable;

/**
 * RamblerSearch scrapper
 *
 * Сайты в поисковие Rambler
 *
 * sudo apt-get update
 * sudo apt-get install composer
 * composer require imangazaliev/didom
 */
class RamblerSearch extends AbstractSearch {

  protected static string $base_url = 'https://nova.rambler.ru/';

  /**
   * @param string $search_string
   * @return AnonymousResourceCollection
   * @throws InvalidSelectorException
   * @throws GuzzleException
   */
  public function search(string $search_string): AnonymousResourceCollection {
    $items = collect();

    $search_string = mb_strtolower($search_string);

    $url = self::$base_url . '/search?utm_source=head&utm_campaign=self_promo&utm_medium=form&utm_content=search&query=';
    $url .= $search_string;

    $res = $this->client->request('GET', $url);
    $response_html = (string)$res->getBody();

    $search_page_document = new Document($response_html);
    $founded_links = collect();

    foreach ($search_page_document->find('#client section article') as $article) {
      $article_text = $article->text();

      if (mb_stristr($article_text, 'Реклама') !== false) {
        continue;
      }

      $element_a = $article->first('h2 > a');

      if ($element_a) {
        $founded_links->push(urldecode($element_a->attr('href')));
      }
    }

    $founded_links = collect(['https://uchi.ru/']);


    // парсим найденные ссылки и собираем результаты в объекты
    foreach ($founded_links as $link) {
      try {
        $res = $this->client->request('GET', $link);
        $response_html = (string)$res->getBody();
      } catch (Throwable $e) {
        // TODO: добавить сайт в чёрный список
        continue;
      }

      $article_page_document = new Document($response_html);

      $description_object = $article_page_document->first('meta[name=description]');

      $content = '';

      if ($description_object) {
        $content = $description_object->attr('content');
      }

      if (empty($content)) {
        continue;
      }

      $article = (object)[
        'title' => $article_page_document->first('title')->text(),
        'content' => $content,
        'type' => 'text',
        'source' => $link,
        'source_type' => strtolower(self::class),
      ];

      $items->push($article);
    }

    return SearchResult::collection($items);
  }
}
