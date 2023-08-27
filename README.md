# ProtectMe

ProtectMe は、Web セキュリティについてハンズオンで学習するためのサービスです。このサービスでは、脆弱性を持つ Web サイトをローカル開発環境で起動し、攻撃と対策を体験することで、Web セキュリティについての理解を深めます。以下の脆弱性について学ぶことができます。

-   [XSS](./docs/ja/XSS.md)

## 日本語 | [English](./docs/en/README.md)

## 環境構築

Docker を活用して、Laravel(Linux, nginx, MySQL,PHP)で開発されたマルチページアプリケーションをローカル開発環境で起動します。

### 前提

-   [Git](https://git-scm.com/)をインストール済み
-   [Docker for Mac / Windows](https://www.docker.com/products/docker-desktop/)をインストール済み

```console
$ git --version
git version 2.26.2
$ docker --version
Docker version 20.10.5, build 55c4c88
```

### インストール

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

上記手順の完了後、ブラウザで http://localhost/ にアクセスしてください。

### Tips

```console
# コンテナを作成する
$ docker compose up -d

# コンテナを破棄する
$ docker compose down

# コンテナ、イメージ、ボリュームを破棄する
$ docker compose down --rmi all --volumes

# テーブル、データをリセットする
$ docker compose exec app php artisan migrate:fresh --seed

# appコンテナに入る
$ docker compose exec app bash

# webコンテナに入る
$ docker compose exec web ash

# dbコンテナに入る
$ docker compose exec db bash

# dbコンテナのMySQLに接続する
$ docker compose exec db bash -c 'mysql -u $MYSQL_USER -p$MYSQL_PASSWORD $MYSQL_DATABASE'
```

## ハンズオン

-   [XSS](./docs/ja/XSS.md)
