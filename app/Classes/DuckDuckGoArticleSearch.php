<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use App\Http\Resources\SearchResult;
use DiDom\Document;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * DuckDuckGo scrapper
 *
 * search articles from duck duck go
 */
class DuckDuckGoArticleSearch extends AbstractSearch {

  protected static string $base_url = 'https://html.duckduckgo.com/html/?q=';

  public function search(string $search_string): AnonymousResourceCollection {
    $articles = collect();

    // $search_string = mb_strtolower($search_string);
    // $request_words = explode(' ', $search_string);
    //
    // $url = self::$base_url . implode('+', $request_words);
    //
    // $res = $this->client->request('GET', $url);
    //
    // $response_html = (string)$res->getBody();
    //
    // $search_page_document = new Document($response_html);
    //
    // $founded_links = collect();
    //
    // foreach ($search_page_document->find('.result__a') as $result_text) {
    //   $founded_links->push(self::$base_url . $result_text->attr('href'));
    // }
    //
    //
    // // парсим найденные ссылки и собираем результаты в объекты
    // foreach ($founded_links as $link) {
    //   $res = $this->client->request('GET', $link);
    //   $response_html = (string)$res->getBody();
    //
    //   // dump($link);
    //   $article_page_document = new Document($response_html);
    //   // dd($article_page_document);
    //
    //   // удаляем не нужные элементы
    //   collect($article_page_document->find('[role=navigation]'))->each->remove();
    //   collect($article_page_document->find('.mw-editsection'))->each->remove();
    //   collect($article_page_document->find('sup.reference'))->each->remove();
    //
    //   $article = (object)[
    //     'title' => $article_page_document->first('h1.firstHeading')->text(),
    //     'content' => $article_page_document->first('.mw-body-content')->text(),
    //     'type' => 'text',
    //     'source' => $link,
    //   ];
    //
    //   $articles->push($article);
    // }

    return SearchResult::collection($articles);
  }
}
