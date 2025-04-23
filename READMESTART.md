Для запуска докера необходимо выполнить несколько команд 
```
docker-compose up --build -d

docker exec -it laravel_app bash
composer install
php artisan key:generate
php artisan migrate
```
так-же может понадобится 
```
composer install
php artisan key:generate
php artisan migrate
```
