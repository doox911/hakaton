<?php

namespace App\Contracts;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * Интерфейс для классов поиска
 * М - Масштабируемость
 */
interface ISearch {

    /**
     * function for search
     *
     * @param string $search_string
     * @return AnonymousResourceCollection
     */
    public function search(string $search_string): AnonymousResourceCollection;
}
