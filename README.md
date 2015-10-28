# session

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Total Downloads][ico-downloads]][link-downloads]

This is a very simple around common ```session_*``` functions in the Standard PHP Library, created for no other purpose 
than to give a more "OOP"-feely way to get and set session variables, with some added convenciences like built-in 
checking if a key exists and such.

## Install

Via Composer

``` bash
$ composer require helgesverre/session
```

## Usage

```php
<?php
require 'vendor/autoload.php';

use Helge\Session;


Session::function start();
Session::started();
Session::status();
Session::cacheLimiter();
Session::set($key, $value);
Session::get($key);
Session::delete($key);
Session::clear();
Session::abort();
Session::reset();
Session::commit();
Session::encode();
Session::decode($data);

```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/helgesverre/session.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/helgesverre/session.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/helgesverre/session
[link-downloads]: https://packagist.org/packages/helgesverre/session
[link-author]: https://github.com/helgesverre