<?php

namespace Helge\Session;

/**
 * Simple wrapper around common session_* functions.
 * Class Session
 * Responsible for dealing with setting, getting and deleting of session variables
 */
class Session
{


    /**
     * Starts the session via session_start
     */
    public static function start()
    {
        // If the session is not isStarted
        if (!self::isStarted()) {
            session_start();
        }
    }

    public static function isStarted()
    {
        return isset($_SESSION);
    }

    public static function status()
    {
        return session_status();
    }


    /**
     * Gets or sets the cache limiter option for the session
     *
     * Valid options:
     *      - nocache: Disallows any client/proxy from caching
     *      - public: Allows caching by proxy and client
     *      - private: Disallows caching by proxies and allows the client to cache the contents.
     *
     * Setting the cache limiter to '' will turn off automatic sending of cache headers.
     * @option string $cache_limiter the option for the cache limiter
     */
    public static function cacheLimiter($cache_limiter = false)
    {
        if ($cache_limiter === false) {
            session_cache_limiter();
        } else {
            session_cache_limiter($cache_limiter);
        }
    }

    public static function savePath($path = null)
    {
        session_save_path($path);
    }

    /**
     * Sets a session variable with key of $key and value of $value, creating they key if it does not exist
     * @param string $key
     * @param string $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Returns the value stored in the session variable $key or null if that key does not exist
     * @param string $key
     * @return mixed
     */
    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }

        return null;
    }

    /**
     * @param string $key deletes the session variable with key of $key
     */
    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }


    /**
     * Clear all data in any session variable
     */
    public static function clear()
    {
        session_unset();
    }


    /**
     * Discards the session array changes and finishes the session
     */
    public static function abort()
    {
        session_abort();
    }

    /**
     * Reinitialize the session with the original value stored in the session storage, changes in $_SESSION is discarded.
     */
    public static function reset()
    {
        session_reset();
    }

    /**
     * Closes the session and (if chosen) wWrites session data to the session save path.
     * @var bool $save whether or not to write the current session data to the session storage
     */
    public static function close($save = true)
    {
        if ($save) {
            session_write_close();
        } else {
            if (version_compare(phpversion(), "5.6.0")) {
                session_abort();
            } else {
                throw new \Exception("Your php version is outdated, upgrade please...");
            }
        }
    }


    /**
     * Returns a string of the serialized session data, requires that a session is started before use.
     * @return string the serialized session values, false if no session is started.
     */
    public static function encode()
    {
        if (self::isStarted()) {
            return session_encode();
        }

        return false;
    }


    /**
     * Takes a serialized string of session data and populates $_SESSION with said decoded data
     * @param string $data serialized session data to be decoded
     * @return bool true on success, false on failure
     */
    public static function decode($data)
    {
        return session_decode($data);
    }
}