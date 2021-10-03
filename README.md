## Текущая версия проекта реализована менее, чем за сутки тремя человеками :-)

# Реализованная функциональность
#### Возможность задания критериев для поиска материалов по предложению/слову/словосочетанию;
#### Фильтрация того, что необходимо найти и где необходимо искать;
#### Поиск статей
#### Поиск видео
#### Поиск изображений
#### Поиск аудио(в разработке)
#### Поиск презентаций(в разработке)

# Будущая функциональность
#### Добавление алгоритмов поиска презентаций
#### Добавление алгоритмов поиска аудиофайлов
#### Сохранение историй поиска (localstorage)
#### Многопользовательская реализация (задействовать БД) 
#### Перевод компонентов vue на typescript
#### Онлайн проигрывание и скачивание видео/аудио контента 

# Особенность проекта в следующем:
#### Дружелюбный кроссплатформенный интерфейс;
#### Удобный сбор информации в одном окне с различных источников;
#### Переход по источникам в новом окне, что не сбивает основные результаты поиска;
#### Масштабируемость проекта. Простое добавление новых поисковиков.

# Основной стек технологий:
#### Laravel, Vue, Vuetify, JavaScript

# Демо
#### Приложение доступно по адресу: <a href="http://a681-185-9-75-238.ngrok.io">ngrok</a>
#### Скринкаст доступен по адресу: <a href="https://cloud.mail.ru/public/he3q/btmTfpxL5">screencast</a>

# Требования
### Вариант 1
#### 1.docker && docker-compose;
### Вариант 2
#### 1.web-сервер с поддержкой PHP(версия 8.0+) интерпретации (apache, nginx);
#### 2.composer (версия 2.0+);
#### 3.npm (версия 7.0+);

# Инструкция по установке

### Linux(Дебиан семейства)
 - cd /var/www && git clone git@github.com:doox911/hakaton.git && cd hakaton/
 - ``` 
   docker run --rm --interactive --tty \
   --volume $PWD:/app \
   composer install
   ```
 - `cd frontend`
 - `npm install`
 - `npm run build`
 - `cd .. && ./vendor/bin/sail up`

*Приложение будет доступно на http://0.0.0.0*

#### 1) cd /var/www && git clone https://github.link.com iprill && cd iprill/
#### 2) composer install
#### 3) cd frontend/ && npm install
#### 4) Установить докер, там всё по инструкции с офф.сайта. 
> пункты 5-7 для пользователей windows
#### 5) Если у тебя винда то нужно в магазине приложений винды установить Ubuntu, для этого нужно в поиске написать linux и выбрать убунту.
#### 6) Установить ubuntu дистрибутивом по умолчанию
   * wsl -s НАЗВАНИЕ_СИСТЕМЫ
   * убедиться можно через wsl -l
   * https://stackoverflow.com/a/65513584
#### 7) Запустить команду ./vendor/bin/sail up (windows - wsl && ./vendor/bin/sail up)
#### 8) cp .env.example .env
#### 9) php artisan key:generate

## РАЗРАБОТЧИКИ
#### Поляков Андрей frontend https://t.me/Doox911
#### Карчевский Алексей fullstack https://t.me/AlexKar
#### Альметов Родион fullstack https://t.me/radar4ick





