# Translate App

> Simple app to suggest similar phrases based on user input

The goal of this app was to try and make a phrase lookup system using jQuery
as the only framework. At the same time, I also wanted to have a realtime
lookup for the database, hence the hacky GET/POST "endpoints" in the vanilla
PHP. It would have been a lot tidier to use Laravel or another nice PHP
framework.

## Usage

### Create Containers

The app consists of 3 docker containers, nginx, php-fpm, and mariadb, giving us
a nice LEMP stack essentially.

```bash
docker-compose up -d
```

### Setup Database

In order to make use of this app, we first need to setup the database to ensure
it has the correct encoding for foreign language support as well as the correct
database structure and all the necessary tables.

This script also creates some basic seed data.

```bash
./setup.sh
```

### Accessing the App

In your web browser, navigate to `localhost:8080`. This should present you with
the UI for this app.
