<?php

namespace App\Classes;

use App\Contracts\ISearch;
use App\Http\Resources\SearchResult;
use http\Exception\RuntimeException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomSearch implements ISearch {

    protected string $url = '';

    public function search(string $search_string): AnonymousResourceCollection {
        if (!$this->url) {
            throw new RuntimeException('url cannot be empty');
        }

        $result = collect();

        // TODO: Implement search() method.

        return SearchResult::collection($result);
    }

    /**
     * set Custom Url for search
     *
     * @param string $url
     * @return \App\Classes\CustomSearch
     */
    public function setUrl(string $url): self {
        $this->url = $url;

        return $this;
    }
}
