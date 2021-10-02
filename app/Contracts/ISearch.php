<?php

namespace App\Contracts;

use Illuminate\Support\Collection;

/**
 * Интерфейс для классов поиска
 * М - Масштабируемость
 */
interface ISearch {

  /**
   * function for search
   *
   * @param string $search_string
   * @return \Illuminate\Support\Collection
   */
    public function search(string $search_string): Collection;
}
