## 42dev shop

A fully responsive, multi-language online shop system with order tracking and multiple categories.

Custom integrations available via:

- http://42dev.eu
- Email: office@42dev.eu
- Twitter: @42_dev

### Installation

* Check out repo, ensure directory permissions are correct (mostly: `app/storage/` musst be writeable for the webserver user).

* Run `composer update`

* Set up your DB credentials in $WEB_ROOT/.env.php
``
    <?php
    return [
      'DB_HOST' => '127.0.0.1',
      'DB_NAME' => 'shop',
      'DB_USER' => 'shop',
      'DB_PASSWORD' => 'mypassword'
    ];
``

* Run `php artisan migrate:refresh --seed --env=production` to set up the database and fill it with sample data.

* Add `SetEnv APP_ENV production` to your vhost configuration (if you use Apache) to set the correct environment.
