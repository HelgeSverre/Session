# Session

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

## Requirements

- PHP 5.6.0 >=

## Usage

```php
<?php
require 'vendor/autoload.php';

use Helge\Session\Session;

/**
 * Start a session, you can specify the session_name, session_id and session_cache_limiter
 * when starting a session since these need to be set before the session is actually started.
 * returns true if the session is started successfully, false if not.
 */
Session::start($name = null, $id = null, $cacheLimiter = null);


/**
 * returns true if the session is started, false if not.
 */
Session::isStarted();


/**
 * Returns the status of the session which is an INT that maps to these constants:
 * - PHP_SESSION_DISABLED if sessions are disabled.
 * - PHP_SESSION_NONE if sessions are enabled, but none exists.
 * - PHP_SESSION_ACTIVE if sessions are enabled, and one exists.
 */
Session::status();


/**
 * Gets or sets the type of cache HTTP Headers are sent to the client
 * More information: http://php.net/manual/en/function.session-cache-limiter.php
 * returns the the current cache limiter as a string
 */
Session::cacheLimiter($cacheLimiter = null);


/**
 * gets or sets the session save path, if you want to change the path where sessions 
 * are stored, this must be called BEFORE a session is started
 */
Session::savePath($path = null);


/**
 * Sets the $_SESSION[$key] variable to $value
 */
Session::set($key, $value);


/**
 * Returns $_SESSION[$key] if it exists, false if not.
 */
Session::get($key);


/**
 * does unset($_SESSION[$key]) if the key exists
 */
Session::delete($key);


/**
 * Sets the name of the session or returns the name of the current session if no params are passed.
 */
Session::name($name = null);


/**
 * Clears the session by calling session_unset()
 */
Session::clear();


/**
 * Discards the session array and finishes the session
 */
Session::abort();


/**
 * Resets the session with the values that are in the session store, the current session data is discarded
 */
Session::reset();


/**
 * Closes the session and (if chosen) writes session data to the session save path.
 */
Session::close($save = true);


/**
 * Returns the serialized session data, example: username|s:11:"helgesverre";password|s:11:"password123";
 */
Session::encode();


/**
 * Takes serialized session data and populates the $_SESSION variable with them.
 */
Session::decode($data);


/**
 * Get and/or set the current session id
 */
Session::id($id = null);

```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/helgesverre/session.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/helgesverre/session.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/helgesverre/session
[link-downloads]: https://packagist.org/packages/helgesverre/session
[link-author]: https://github.com/helgesverre