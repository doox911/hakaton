<?php

namespace App\Classes;

use App\Abstractions\AbstractSearch;
use Illuminate\Support\Collection;

/**
 * Yandex scrapper
 */
class YandexSearch extends AbstractSearch {

    protected static string $url = 'https://yandex.ru/';

    public function search(string $search_string): Collection {
        $articles = collect();

        // TODO: Implement search() method.

        return $articles;
    }
}
