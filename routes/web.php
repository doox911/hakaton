<?php

use App\Classes\DuckDuckGoArticleSearch;
use App\Classes\ImagesWikiSearch;
use App\Classes\RamblerSearch;
use App\Classes\WikiSearch;
use App\Classes\YouTubeSearch;
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
*/

Route::get('yt', static function(){
  $res = (new YouTubeSearch())->search('iphone 13');
  dd($res);
});

Route::get('duck', static function () {
  $res = (new DuckDuckGoArticleSearch())->search('лермонтов');
  dd($res);
});

Route::get('/wiki', static function () {
  $res = (new RamblerSearch)->search('учи ру');
  //$res = (new WikiSearch)->search('nano nano');
  //$res = (new ImagesWikiSearch)->search('Серпухов');
  dd($res);
});

Route::get('/getimages', function () {
  $need_content = [
    ['type' => 'articles', 'count' => 10],
    ['type' => 'images', 'count' => 25],
  ];

  $text = 'Ostrov krit'; //Строка запроса
  $text = strtolower(trim($text)); //вычистим лишние пробелы и приведем к нижнему регистру
  $text = preg_replace('/[^\wа-яА-ЯёЁ]/u', '+', $text);

  $articles = [];
  $images = [];

  foreach ($need_content as $content) {
    if ($content['type'] === 'articles') {
      $iterate = 1;
      while (count($articles) < $content['count']) {
        $response = \Illuminate\Support\Facades\Http::get('https://search.yahoo.com/search', [
          'p' => $text,
          'ei' => 'UTF-8',
          'b' => $iterate,
        ]);
        $html = $response->getBody()->getContents();
        $document = new \DiDom\Document($html);
        $posts = $document->find('.algo');

        foreach ($posts as $post) {
          $href = $post->first('h3')->first('a');
          $title = $href;
          $title->firstInDocument('span')->remove();
          $articles[] = [
            'title' => $title->text(),
            'href' => $href->getAttribute('href'),
            'content' => $post->first('.compText')->text(),
          ];
        }
        $iterate += 7; //Шаг поисковика яху = 7
      }
    } else if ($content['type'] === 'images') {
      // while (count($images) < $content['count']){
      $response = \Illuminate\Support\Facades\Http::get('https://www.bing.com/images/search', [ //Яху берет картинки с бинга
        'q' => $text,
      ]);
      $html = $response->getBody()->getContents();
      $document = new \DiDom\Document($html);

      $imgs = $document->find('img');
      foreach ($imgs as $img) {
        $url = $img->getAttribute('src');

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        $base64 = "data:image/png;base64,<?php echo base64_encode($output);?>"; //Не проверял

        $images[] = [
          'src' => $url,
          'content' => $base64,
        ];
      }
      // } //Не знаю как картинки взять с новой страницы
    }
  }
  echo print_r($articles);
  echo print_r($images);

});

Route::get('/{any}', 'FrontendController@index')->where('any', '.*');
