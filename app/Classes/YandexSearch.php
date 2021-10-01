<?php

namespace App\Classes;

use App\Contracts\ISearch;
use App\Http\Resources\SearchResult;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Yandex scrapper
 */
class YandexSearch implements ISearch {

    public static string $url = 'https://yandex.ru/';

    public function search(string $search_string): AnonymousResourceCollection {
        $articles = collect();

        // TODO: Implement search() method.

        return SearchResult::collection($articles);
    }
}
