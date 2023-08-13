# ProtectMe

ProtectMe is a hands-on service designed to help users learn about web security. Through this service, users can launch vulnerable websites on their local development environments, experience both cyber attacks and countermeasures firsthand, and thereby deepen their understanding of web security. Currently, you can learn about the following vulnerabilities:

-   [XSS](./XSS.md)

## [日本語](../../README.md) | English

## Setup

We utilize Docker to run a multi-page application developed in Laravel (Linux, nginx, MySQL, PHP) on your local development environment.

### 前提

-   [Git](https://git-scm.com/)installed
-   [Docker for Mac / Windows](https://www.docker.com/products/docker-desktop/)installed

```console
$ git --version
git version 2.26.2
$ docker --version
Docker version 20.10.5, build 55c4c88
```

### Installation

```console
$ git clone git@github.com:yuta-sawamura/protect-me.git
$ cd protect-me
$ docker compose build
$ docker compose up -d
$ docker compose exec app composer install
$ docker compose exec app cp .env.example .env
$ docker compose exec app php artisan key:generate
$ docker compose exec app php artisan storage:link
$ docker compose exec app chmod -R 777 storage bootstrap/cache
$ docker compose exec app php artisan migrate:fresh --seed
```

After following the steps above, access the application by navigating to http://localhost/ in your browser.

### Tips

```console
# To create containers
$ docker compose up -d

# To destroy containers
$ docker compose down

# To remove containers, images, and volumes
$ docker compose down --rmi all --volumes

# To reset tables and data
$ docker compose exec app php artisan migrate:fresh --seed

# To enter the app container
$ docker compose exec app bash

# To enter the web container
$ docker compose exec web ash

# To enter the db container
$ docker compose exec db bash

# To connect to MySQL within the db container
$ docker compose exec db bash -c 'mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE'

```

## Hands-on

-   [XSS](./XSS.md)
