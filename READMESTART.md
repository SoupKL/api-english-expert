Для запуска докера необходимо выполнить несколько команд 
```shell
docker-compose up --build -d

docker exec -it laravel_app bash
composer install
php artisan key:generate
php artisan migrate
```
так-же может понадобится 
```shell
composer install
php artisan key:generate
php artisan migrate
```
