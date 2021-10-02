<?php

namespace App\Services;

use Illuminate\Support\Collection;

/**
 * Class ProxyService
 *
 * @package Service
 */
class ProxyService {

  /**
   *  TODO: нужно будет написать скрипт который по крону раз в час забирает свежие актуальный прокси-IP
   *        с этого сайта https://hidemy.name/ru/proxy-list/, перед записью в
   *        базу в идеале чтобы IP ещё проверялся на работоспособность
   *
   * @return Collection
   */
  public static function getProxyIpCollection(): Collection {
    $proxy_ip_list = [
      // '172.67.70.88:80',
      // '172.67.254.108:80',
      // '172.67.181.188:80',
      // '172.67.181.193:80',
      // '172.67.74.107:80',
      // '172.67.253.233:80',
      // '172.67.253.207:80',
      // '172.67.70.7:80',
      // '172.67.242.194:80',
      // '172.67.181.191:80',
      // '172.67.181.69:80',
      // '172.67.253.249:80',
      // '172.67.182.153:80',
    ];

    return collect($proxy_ip_list);
  }
}
