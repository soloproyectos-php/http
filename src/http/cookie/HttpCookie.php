<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http
 */
namespace soloproyectos\http\cookie;
use soloproyectos\arr\Arr;

/**
 * Class HttpCookie.
 *
 * @package Http\Cookie
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http
 */
class HttpCookie
{
    /**
     * Default expiration time: one year.
     */
    const DEFAULT_EXPIRATION_TIME = 31536000;

    /**
     * Gets a cookie attribute.
     *
     * @param string $name    Attribute name.
     * @param string $default Default value (default is "")
     *
     * @return mixed
     */
    public static function get($name, $default = "")
    {
        return Arr::get($_COOKIE, $name, $default);
    }

    /**
     * Sets a cookie attribute.
     *
     * @param string  $name           Attribute name.
     * @param mixed   $value          Attribute value.
     * @param integer $expirationTime Expiration time in seconds (default is one year)
     * @param string  $path           Server path (default is '/')
     * @param string  $domain         Domain name (not required)
     * @param boolean $secure         Secure cookie
     * @param boolean $httponly       HTTP only cookie
     *
     * @return void
     */
    public static function set(
        $name,
        $value,
        $expirationTime = HttpCookie::DEFAULT_EXPIRATION_TIME,
        $path = "/",
        $domain = "",
        $secure = false,
        $httponly = false
    ) {
        setcookie(
            $name,
            $value,
            time() + $expirationTime,
            $path,
            $domain,
            $secure,
            $httponly
        );
    }

    /**
     * Does the cookie attribute exist?
     *
     * @param string $name Attribute name.
     *
     * @return boolean
     */
    public static function is($name)
    {
        return Arr::is($_COOKIE, $name);
    }

    /**
     * Deletes a cookie attribute.
     *
     * @param string  $name     Cookie name
     * @param string  $path     Server path (default is '/')
     * @param string  $domain   Domain name (not required)
     * @param boolean $secure   Secure cookie (default is false)
     * @param boolean $httponly Http only cookie (default is false)
     *
     * @return void
     */
    public static function del($name, $path = "/", $domain = "", $secure = false, $httponly = false)
    {
        setcookie($name, "", time() - 3600, $path, $domain, $secure, $httponly);
        Arr::del($_COOKIE, $name);
    }
}
