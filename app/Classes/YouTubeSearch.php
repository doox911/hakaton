<?php

namespace App\Classes;

use App\Contracts\ISearch;
use App\Http\Resources\SearchResult;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * YouTube scrapper
 */
class YouTubeSearch implements ISearch {

    public static string $url = 'https://www.youtube.com/';

    public function search(string $search_string): AnonymousResourceCollection {
        $videos = collect();

        // TODO: Implement search() method.

        return SearchResult::collection($videos);
    }
}
