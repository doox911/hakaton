<?php

use DiDom\Document;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|


sudo apt-get update
sudo apt-get install composer
composer require imangazaliev/didom


*/


Route::get('/wiki', static function () {



    // приходит с фронта
    $request_string = 'Мама мыла раму';

    dump('Запрос: ' . $request_string);


    $request_string = mb_strtolower($request_string);
    $request_words = explode(' ', $request_string);

    $url = 'https://ru.wikipedia.org/w/index.php?search=';

    $is_first = true;
    foreach ($request_words as $word) {
        if (!$is_first) {
            $url .= '+';
        }

        $url .= $word;

        $is_first = false;
    }

    $url .= '&title=Служебная:Поиск&go=Перейти&wprov=acrw1_-1';

    // TODO: нужно будет написать скрипт который по крону раз в час забирает свежие актуальный прокси-IP
    //       с этого сайта https://hidemy.name/ru/proxy-list/, перед записью в
    //       базу в идеале чтобы IP ещё проверялся на работоспособность
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

    $http_client_params = [
        'timeout' => 30.0,
        'cookie' => true,
        'request.options' => [],
    ];

    if (!empty($proxy_ip_list)) {
        $http_client_params['request.options']['proxy'] = 'tcp://' . $proxy_ip_list[array_rand($proxy_ip_list)];
    }

    $client = new GuzzleHttp\Client($http_client_params);

    $res = $client->request('GET', $url);
    $response_html = (string)$res->getBody();

    $search_page_document = new Document($response_html);
    $founded_links = collect();

    foreach ($search_page_document->find('.mw-search-result-heading > a') as $result_text) {
        $founded_links->push($result_text->attr('href'));
    }


    $search_results = collect();

    foreach ($founded_links as $link) {
        $res = $client->request('GET', $link);
        $response_html = (string)$res->getBody();

        $article_page_document = new Document($response_html);

        $search_result = (object)[
            'title' => 'Заголовок контента',
            'content' => 'контент',
            'type' => 'text',
            'source' => $link,
        ];

        dd($article_page_document->find('h1.firstHeading'));

        $search_results->push($search_result);
    }


    dump($http_client_params['request.options']);
    dump($search_results);
    dd();
    //echo $document->first('title::text');


    // echo $document->first('img');

    // $text_result = (object)[
    //     'title' => 'Заголовок контента',
    //     'content' => 'контент',
    //     'type' => 'text',
    //     'source' => 'ссылка на страницу откуда взял текст',
    // ];
    //
    // $image_result = (object)[
    //     'title' => 'Подпись картинки',
    //     'content' => 'ссылка на картинку',
    //     'type' => 'image',
    //     'source' => 'ссылка на страницу откуда взял картинку',
    // ];

});

Route::get('/{any}', 'FrontendController@index')->where('any', '.*');
