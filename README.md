## How to setup the app

1. Clone the repo: on terminal run `git clone https://github.com/hrgweb/ota-exam.git`.

    1.1. Once cloned. Create a copy of .env file from .env.example by running `cp .env.example .env`.

2. Check out to branch `feature/ota-exam`.

> If using Docker Desktop

3. Make sure you are in the working directory. Then in terminal run `docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php83-composer:latest \
    composer install --ignore-platform-reqs
   `.

    This will install packages for app requirements.
4. Next run `sail up -d` and `sail artisan key:generate`.

> If not using Docker

3. In terminal run `composer install`.
4. Next run `php artisan key:generate`, `php artisan migrate` and `php artisan serve`.

6. Now you are ready to test the api endpoints.