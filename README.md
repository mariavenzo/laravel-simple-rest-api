# laravel-simple-rest-api
Simple Laravel REST API Server

## Installation Guide
- Run `git clone https://github.com/mariavenzo/laravel-simple-rest-api`
- Run `cd laravel-simple-rest-api`
- Run `composer install`
- Configure your .ENV file with your database credentials: `
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_simple_rest_api
DB_USERNAME=root
DB_PASSWORD=
`
- Create a dabase named `laravel_simple_rest_api` or choose another name of your personal choice
- Run `php artisan migrate`
- Test the routes:
  -  `GET /laravel-simple-rest-api/clientes`
  - `GET /laravel-simple-rest-api/clientes/1`
  - `POST /laravel-simple-rest-api/clientes`
  - `PUT /laravel-simple-rest-api/clientes/1`
  - `DELETE /laravel-simple-rest-api/clientes/1`
  - `POST /laravel-simple-rest-api/clientes/1/planos/1`
  - `GET /laravel-simple-rest-api/clientes/1/planos`
  - `GET /laravel-simple-rest-api/clientes/1/planos/1`
  - `DELETE /laravel-simple-rest-api/clientes/1/planos/1`

### TODO's List
- User authentication & authorization
- Resource Api Pagination
- Fix the bugs
- Improve some code
