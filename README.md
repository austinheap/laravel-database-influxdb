# Laravel 5.5+ InfluxDB Database Package

[![Current Release](https://img.shields.io/github/release/austinheap/laravel-database-influxdb.svg)](https://github.com/austinheap/laravel-database-influxdb/releases)
[![Total Downloads](https://img.shields.io/packagist/dt/austinheap/laravel-database-influxdb.svg)](https://packagist.org/packages/austinheap/laravel-database-influxdb)
[![Build Status](https://travis-ci.org/austinheap/laravel-database-influxdb.svg?branch=master)](https://travis-ci.org/austinheap/laravel-database-influxdb)
[![Code Climate](https://codeclimate.com/github/austinheap/laravel-database-influxdb/badges/gpa.svg)](https://codeclimate.com/github/austinheap/laravel-database-influxdb)
[![Scrutinizer CI](https://scrutinizer-ci.com/g/austinheap/laravel-database-influxdb/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/austinheap/laravel-database-influxdb/)
[![SensioLabs](https://insight.sensiolabs.com/projects/dc020687-c653-42f0-b006-79d5c7742fb0/mini.png)](https://insight.sensiolabs.com/projects/dc020687-c653-42f0-b006-79d5c7742fb0)
[![Test Coverage](https://codeclimate.com/github/austinheap/laravel-database-influxdb/badges/coverage.svg)](https://codeclimate.com/github/austinheap/laravel-database-influxdb)
[![StyleCI](https://styleci.io/repos/110926889/shield?branch=master)](https://styleci.io/repos/110926889)

## A package for accessing InfluxDB from Laravel 5.5+, based on configuration settings.

There is [documentation for `laravel-database-influxdb` online](https://austinheap.github.io/laravel-database-influxdb/),
the source of which is in the [`docs/`](https://github.com/austinheap/laravel-database-influxdb/tree/master/docs)
directory. The most logical place to start are the [docs for the `InfluxDbServiceProvider` class](https://austinheap.github.io/laravel-database-influxdb/classes/AustinHeap.Database.InfluxDb.InfluxDbServiceProvider.html).

## Installation

### Step 1: Composer

Via Composer command line:

```bash
$ composer require austinheap/laravel-database-influxdb
```

Or add the package to your `composer.json`:

```json
{
    "require": {
        "austinheap/laravel-database-influxdb": "0.1.*"
    }
}
```

### Step 2: Enable the package (Optional)

This package implements Laravel 5.5's auto-discovery feature. After you install it the package provider and facade are added automatically.

If you would like to declare the provider and/or alias explicitly, then add the service provider to your `config/app.php`:

```php
'providers' => [
    //
    AustinHeap\Database\InfluxDb\InfluxDbServiceProvider::class,
];
```

And then add the alias to your `config/app.php`:

```php
'aliases' => [
    //
    'InfluxDb' => AustinHeap\Database\InfluxDb\InfluxDbFacade::class,
];
```

### Step 3: Configure the package

Publish the package config file:

```bash
$ php artisan vendor:publish --provider="AustinHeap\Database\InfluxDb\InfluxDbServiceProvider"
```

You may now place your defaults in `config/influxdb.php`.

## Full .env Example

To override values in `config/influxdb.php`, simply add the following to your .env file:

```bash
INFLUXDB_PROTOCOL=https
INFLUXDB_USER=my-influxdb-user
INFLUXDB_PASS=my-influxdb-pass
INFLUXDB_HOST=my-influxdb.server
```

## References

- [influxdata/influxdb-php](https://github.com/influxdata/influxdb-php)

## Credits

This is a fork of [pdffiller/laravel-influx-provider](https://github.com/pdffiller/laravel-influx-provider).

- [pdffiller/laravel-influx-provider Contributors](https://github.com/pdffiller/laravel-influx-provider/graphs/contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
