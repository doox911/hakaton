<?php

namespace App\Abstractions;

use App\Contracts\ISearch;
use App\Services\ProxyService;
use GuzzleHttp\Client;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

abstract class AbstractSearch implements ISearch {

  /**
   * @var string
   */
  protected static string $url = '';

  /**
   * @var \GuzzleHttp\Client
   */
  protected Client $client;

  /**
   * Конструктор
   */
  public function __construct() {
    $proxy_ip_list = ProxyService::getProxyIpCollection();

    $http_client_params = [
      'timeout' => 30.0,
      'cookie' => true,
      'request.options' => [],
    ];

    if ($proxy_ip_list->isNotEmpty()) {
      $http_client_params['request.options']['proxy'] = 'tcp://' . $proxy_ip_list[array_rand($proxy_ip_list->toArray())];
    }

    $this->client = new Client($http_client_params);
  }


  abstract public function search(string $search_string): AnonymousResourceCollection;
}
