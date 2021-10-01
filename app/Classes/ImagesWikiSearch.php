<?php

namespace App\Classes;

use App\Contracts\ISearch;
use App\Http\Resources\SearchResult;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ImagesWikiSearch implements ISearch {

    public static string $url = 'https://commons.wikimedia.org/w/index.php?search=';

    /**
     * @inheritDoc
     */
    public function search(string $search_string): AnonymousResourceCollection {
        $images = collect();

        // TODO: Implement search() method.

        return SearchResult::collection($images);
    }
}
