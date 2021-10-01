1) Сгенерить ключ на гит хаб https://docs.github.com/en/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent

2) Спулить проект в папку с сайтами, создать в веб-сервере хост, например hakaton.loc

3) в корне проекта сделать
   composer install

4) в папке frontend сделать
   npm install

5) Установить докер, там всё по инструкции с офф.сайта.

6) Если у тебя винда то нужно в магазине приложений винды установить Ubuntu, для этого нужно в поиске написать linux и выбрать убунту.

7) Установить ubuntu дистрибутивом по умолчанию
   wsl -s НАЗВАНИЕ_СИСТЕМЫ
   , убедиться можно через
   wsl -l
   https://stackoverflow.com/a/65513584

8) Запустить команду ./vendor/bin/sail up (если у тебя винда, то запусти установленную убунту выполнив команду wsl - откроется папка проекта в убунте и там выполнить ./vendor/bin/sail up
   )

9) скопировать файл
   .env.example
   с названием .env

10) запустить команду
    php artisan key:generate

11) Кайфовать
