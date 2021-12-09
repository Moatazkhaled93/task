# Visipoint V5

System Admin: Please have a look at https://laravel.com/docs/6.x/queues#dealing-with-failed-jobs

The size of JSON documents stored in JSON columns is limited to the value of the max_allowed_packet system variable

## Docker

Run `docker-compose up -d --build`

then copy .env.example `cp .env.example .env`

and edit .env file with your uid (`id` in ubuntu)

then run `./composer install`

and run `./php-artisan key:generate`

then go to Migration below and follow the steps (using ./php-artisan which directly accesses the php artisan command inside the docker)

## Installation

You will need to make sure your server meets the following requirements:

- PHP >= 7.2.0
- BCMath PHP Extension
- Ctype PHP Extension
- Fileinfo PHP extension
- JSON PHP Extension
- Mbstring PHP Extension
- OpenSSL PHP Extension
- PDO PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

After cloning the app will follow these steps:

1. run `composer install` to install dependencies
2. copy from .env.example to a new file named .env `cp .env.example .env`
3. Directories within the storage and the `bootstrap/cache` directories should be writable by your web server or Laravel will not run. `chmod -R 0777 storage bootstrap/cache`
4. run `php artisan key:generate`

## Migrations

The Laravel application has mulitple database connections. To make sure the migrations run correctly and the tables are created in the correct DBs, you must do the followig:

**Migrate Passport**

Passport is a little annoying as it can't be used in conjuction with the migrate flags `--database` & `--path=path/to/migration`. It also uses the `.env` variable and not the config variable `DB_CONNECTION`.

Make sure the `.env` has the correct `DB_CONNECTION` set.

**.env**

```
DB_CONNECTION=master
```

**Install Passport**

```
$ php artisan migrate
$ php artisan passport:install
```

**Run Migrations**

```
$ php artisan migrate --database=master --path=database/migrations/master
$ php artisan migrate --database=app --path=database/migrations/app/

for migrate and seed
$ php artisan migrate:refresh --seed
```

As you can see we are making aure that a databse connection is specified and a location where the migration files are.

## Endpoints

_/api/login - POST_

_/api/register - POST_

Please see the Postman for endpoint structures, body, headers, etc.

To make POST calls you need to set the `.env` variables using data from table `oauth_clients`.

Set variables

```
PASSPORT_CLIENT_ID=2
PASSPORT_CLIENT_SECRET=<GET FROM DB>
PASSPORT_REDIRECT_URI=http://localhost
```

You can then make API calls.


Pretty URLs
--------
### Apache

Laravel includes a public/.htaccess file that is used to provide URLs without the index.php front controller in the path. Before serving Laravel with Apache, be sure to enable the mod_rewrite module so the .htaccess file will be honored by the server.

If the .htaccess file that ships with Laravel does not work with your Apache installation, try this alternative:

    Options +FollowSymLinks -Indexes
    RewriteEngine On

    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

### Nginx
If you are using Nginx, the following directive in your site configuration will direct all requests to the index.php front controller:

```
location / {
    try_files $uri $uri/ /index.php?$query_string;
}
```

# task
