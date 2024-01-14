Выполнить команды послеодвательно
```
cp .env.example .env

docker-compose up -d --build
docker-compose run --rm -u root app composer i
docker-compose run --rm npm i
docker-compose run --rm npm run build

docker-compose run --rm app php artisan key:generate
docker-compose run --rm app php artisan migrate --seed
```
Перейти по url
http://localhost/

