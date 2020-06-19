# Seul Pour Noël (Alone for Christmas)


## Installation

### Download composer
```bash
$ curl -s https://getcomposer.org/installer | php
```

### Install project
```bash
$ php composer.phar install
```

### Copy env
```bash
cp .env.example .env
```
### Generate key
```bash
$ php artisan key:generate
```

### Migrate database
```bash
$ touch database.sqlite
$ php artisan migrate:refresh --seed
```

### Launch the development server
```bash
$ php artisan serve
```

