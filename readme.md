# Laravel Bitly Client Package

[![Latest Stable Version](https://poser.pugx.org/bramalho/laravel-bitly-client/v/stable)](https://packagist.org/packages/bramalho/laravel-bitly-client)
[![Total Downloads](https://poser.pugx.org/bramalho/laravel-bitly-client/downloads)](https://packagist.org/packages/bramalho/laravel-bitly-client)
[![License](https://poser.pugx.org/bramalho/laravel-bitly-client/license)](https://packagist.org/packages/bramalho/laravel-bitly-client)

Laravel Bitly Client is a Laravel package that provide a simple client for the [Bitly](https://bitly.com/) URL shorten.

## Installation
Install the package
```sh
composer require bramalho/laravel-bitly-client
```

Add the service provider in `config/app.php`

```php
BRamalho\LaravelBitlyClient\LaravelBitlyClientServiceProvider::class,
```

Publish the configs
```sh
php artisan vendor:publish --provider 'BRamalho\LaravelBitlyClient\LaravelBitlyClientServiceProvider'
```

Add your Bitly credentials in your `.env` file
```sh
BITLY_LOGIN=your_api_login
BITLY_API_KEY=your_api_key
```

## Usage
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BRamalho\LaravelBitlyClient\BitlyClient;
use BRamalho\LaravelBitlyClient\InvalidCredentialsException;
use BRamalho\LaravelBitlyClient\UnableToGenerateURLException;

class HomeController extends Controller
{
    /**
     * @return array
     * @throws InvalidCredentialsException
     * @throws UnableToGenerateURLException
     */
    public function index()
    {
        $bitlyClient = new BitlyClient();

        return $bitlyClient->generate('https://brunoramalho.com');
    }
}
```

This will return something like:
```php
[
    'url' => 'http://bit.ly/2KiTbFW',
    'hash' => '2KiTbFW',
    'global_hash' => '2KiTbWs',
    'long_url' => 'https://brunoramalho.com/'
    'new_hash' => 0
]
```

## License
The **Laravel Bitly Client** is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).
