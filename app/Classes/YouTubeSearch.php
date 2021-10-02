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

        // TODO: Implement search() method.

        return SearchResult::collection($videos);
    }
}
