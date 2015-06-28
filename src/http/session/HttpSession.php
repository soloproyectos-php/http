<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http
 */

namespace soloproyectos\http\session;
use soloproyectos\arr\Arr;
use soloproyectos\http\exception\HttpException;

/**
 * Class HttpSession.
 *
 * This class is used to access the session variables.
 *
 * @package Http\Session
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http
 */
class HttpSession
{
    /**
     * Starts a session, if not already started.
     *
     * @return void
     */
    public static function start()
    {
        if (!session_id()) {
            session_start();
        }
    }

    /**
     * Gets a session attribute.
     *
     * @param string $name    Session attribute.
     * @param mixed  $default Default value (default is "")
     *
     * @return mixed
     */
    public static function get($name, $default = "")
    {
        HttpSession::start();
        return Arr::get($_SESSION, $name, $default);
    }

    /**
     * Sets a session attribute.
     *
     * @param string $name  Session attribute.
     * @param mixed  $value Value attribute.
     *
     * @return void
     */
    public static function set($name, $value)
    {
        HttpSession::start();

        if (!preg_match("/^[\_a-z]/i", $name)) {
            throw new HttpException("Invalid session attribute: $name");
        }

        $_SESSION[$name] = $value;
    }

    /**
     * Does the session attribute exist?
     *
     * @param string $name Session attribute.
     *
     * @return boolean
     */
    public static function is($name)
    {
        HttpSession::start();
        return Arr::is($_SESSION, $name);
    }

    /**
     * Deletes a session attribute.
     *
     * @param string $name Session attribute.
     *
     * @return void
     */
    public static function del($name)
    {
        HttpSession::start();
        Arr::del($_SESSION, $name);
    }

    /**
     * Deletes all session variables.
     *
     * @return void
     */
    public static function clear()
    {
        HttpSession::start();
        session_unset();
    }

    /**
     * Saves data and closes the current session.
     *
     * @return void
     */
    public static function close()
    {
        HttpSession::start();
        session_write_close();
    }
}
