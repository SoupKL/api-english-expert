Для запуска докера необходимо выполнить несколько команд 
```shell
docker-compose up --build -d
```
```shell
docker exec -it laravel_app bash
```
```shell
composer install
```
```shell
php artisan key:generate
```
```shell
php artisan migrate
```

так-же может понадобится 
```shell
composer install
php artisan key:generate
php artisan migrate
```
