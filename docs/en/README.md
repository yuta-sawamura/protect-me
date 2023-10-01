# ProtectMe

ProtectMe is a hands-on service designed to help users learn about web security. Through this service, users can launch vulnerable websites on their local development environments, experience both cyber attacks and countermeasures firsthand, and thereby deepen their understanding of web security. Currently, you can learn about the following vulnerabilities:

-   [XSS](./XSS.md)

## [日本語](../../README.md) | English

## Setup

We utilize Docker to run a multi-page application developed in Laravel (Linux, nginx, MySQL, PHP) on your local development environment.

### Prerequisite

-   [Git](https://git-scm.com/)installed
-   [Docker for Mac / Windows](https://www.docker.com/products/docker-desktop/)installed

```console
$ git --version
git version x.x.x
$ docker --version
Docker version x.x.x, build xxxxx
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

## Hands-on

After building the setup, deepen your understanding of vulnerabilities through hands-on activities.

-   [XSS](./XSS.md)

## Tips

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
