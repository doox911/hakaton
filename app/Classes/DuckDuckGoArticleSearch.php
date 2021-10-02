<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use DiDom\Document;
use Illuminate\Support\Collection;

/**
 * DuckDuckGo scrapper
 *
 * search articles from duck duck go
 */
class DuckDuckGoArticleSearch extends AbstractSearch {

  protected static string $base_url = 'https://duckduckgo.com/html/?q=%s&kl=ru-ru';
  protected static string $base_json_url = 'https://api.duckduckgo.com/?q=%s&format=json&pretty=1&kl=ru-ru';

  public function search(string $search_string): Collection {
    $articles = collect();

    $search_string = mb_strtolower($search_string);
    $request_words = explode(' ', $search_string);

    // search card
    $url_json = sprintf(self::$base_json_url, implode('+', $request_words));
    $res_json = $this->client->request('GET', $url_json);

    $json_response = json_decode($res_json->getBody());

    $articles->push([
      'title' => $json_response->Heading,
      'content' => $json_response->AbstractText,
      'type' => 'text',
      'source' => $json_response->AbstractURL,
    ]);

    // search other
    $url = sprintf(self::$base_url, implode('+', $request_words));
    $res = $this->client->request('GET', $url);

    $response_html = (string)$res->getBody();
    $search_page_document = new Document($response_html);

    $founded_links = collect();
    foreach ($search_page_document->find('#links > div > div') as $result_text) {
      $url = urldecode(($result_text->first('h2 > a')->attr('href')));
      $url = mb_substr($url, mb_stripos($url, '=') + 1);
      $url = mb_substr($url, 0, mb_stripos($url, '&'));

      $founded_links->push($url);
    }

    // парсим найденные ссылки и собираем результаты в объекты
    // todo take 5 - оптимизация скорости ответа
    foreach ($founded_links->take(5)->unique()->values() as $link) {
      $res = $this->client->request('GET', $link);
      $response_html = (string)$res->getBody();

      $article_page_document = new Document($response_html);

      $description = $article_page_document->first("meta[name='Description']");

      if (!$description) {
        $description = $article_page_document->first("meta[name='description']");
      }

      if (!$description) {
        continue;
      }


      $article = (object)[
        'title' => $article_page_document->first('title')->text(),
        'content' => $description->attr('content'),
        'type' => 'text',
        'source' => $link,
        'source_type' => strtolower(self::class),
      ];

      $articles->push($article);
    }

    return $articles;
  }
}
