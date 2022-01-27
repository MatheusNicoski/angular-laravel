## Instação

Executar:
`composer install -vvv`,
`cp .env.example .env`,
`php artisan key:generate`

Criar banco de dados e configurar `.env`

`php artisan migrate --seed`
`php artisan serve`

Acessar http://127.0.0.1:8000 (padrão porta 8000)