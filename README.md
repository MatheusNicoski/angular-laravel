## Instação backend

Executar:

`git clone https://github.com/MatheusNicoski/angular-laravel.git`,

`cd backend`,

`composer install -vvv`,

`cp .env.example .env`,

`php artisan key:generate`


Criar banco de dados e configurar `.env`

`php artisan migrate --seed`

`php artisan serve`

Acessar http://127.0.0.1:8000 (padrão porta 8000)

## Instação front

`cd front`

`npm install`

`ng serve`

Acessar http://localhost:4200 (padrão porta 4200)
