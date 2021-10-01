<?php

namespace App\Classes;

use App\Contracts\ISearch;
use App\Http\Resources\SearchResult;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Wikipedia scrapper
 */
class WikiSearch implements ISearch {

    public static string $url = 'https://ru.wikipedia.org/wiki/';

    public function search(string $search_string): AnonymousResourceCollection {
        $articles = collect();

        // TODO: Implement search() method.

        return SearchResult::collection($articles);
    }
}
