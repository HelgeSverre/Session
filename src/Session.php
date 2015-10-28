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

    /**
     * @param string $name The session name can't consist of digits only, at least one letter must be present. Otherwise a new session id is generated every time.
     * @param string $id session ID characters in the range a-z A-Z 0-9 , (comma) and - (minus)
     * @param int $cacheLimiter
     */
    public static function start($name = null, $id = null, $cacheLimiter = null)
    {
        // If the session is not isStarted
        if (!self::isStarted()) {


            if ($name) {
                self::name($name);
            }

            if ($id) {
                self::id($id);
            }

            if ($cacheLimiter) {
                self::cacheLimiter($cacheLimiter);
            }

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
     * Gets or sets the type of cache HTTP Headers are sent to the client
     *
     * More information: http://php.net/manual/en/function.session-cache-limiter.php
     *
     * Possible values:
     * - public
     *     - Expires: (sometime in the future, according session.cache_expire)
     *     - Cache-Control: public, max-age=(sometime in the future, according to session.cache_expire)
     *     - Last-Modified: (the timestamp of when the session was last saved)
     * - private_no_expire
     *     - Cache-Control: private, max-age=(session.cache_expire in the future), pre-check=(session.cache_expire in the future)
     *     - Last-Modified: (the timestamp of when the session was last saved)
     * - private
     *     - Expires: Thu, 19 Nov 1981 08:52:00 GMT
     *     - Cache-Control: private, max-age=(session.cache_expire in the future), pre-check=(session.cache_expire in the future)
     *     - Last-Modified: (the timestamp of when the session was last saved)
     * - nocache
     *     - Expires: Thu, 19 Nov 1981 08:52:00 GMT
     *     - Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0
     *     - Pragma: no-cache
     *
     * @param string $cacheLimiter the type of cache limiter public|private_no_expire|private|nocache
     * @return string the current cache limiter
     */
    public static function cacheLimiter($cacheLimiter = null)
    {
        return session_cache_limiter($cacheLimiter);
    }


    /**
     * Get/set the current session save path, must be called BEFORE the session is started
     * @param string $path Session data path. If specified, the path to which data is saved will be changed.
     * @return string The path of the current directory used for data storage.
     */
    public static function savePath($path = null)
    {
        return session_save_path($path);
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
     * Get and/or set the current session name
     * @param string $name if specified, the new name for the session
     * @return string the current session name
     */
    public static function name($name = null)
    {
        return session_name($name);
    }


    /**
     * Clear all data in any session variable
     */
    public static function clear()
    {
        session_unset();
    }


    /**
     * Discards the session array and finishes the session
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
     * Closes the session and (if chosen) writes session data to the session save path.
     * @param bool $save whether or not to write the current session data to the session storage
     */
    public static function close($save = true)
    {
        if ($save) {
            session_write_close();
        } else {
            self::abort();
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

    /**
     * Get and/or set the current session id
     * @param string $id session ID characters in the range a-z A-Z 0-9 , (comma) and - (minus)
     * @return string the current session id
     */
    private static function id($id = null)
    {
        return session_id($id);
    }
}