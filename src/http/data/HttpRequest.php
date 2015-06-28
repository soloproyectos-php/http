<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
namespace soloproyectos\http\data;
use soloproyectos\arr\Arr;
use soloproyectos\http\data\HttpDataInterface;

/**
 * Class HttpRequest.
 *
 * This class is used to access the request variables.
 *
 * @package Http\Data
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http-controller/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http-controller
 */
class HttpRequest implements HttpDataInterface
{
    /**
     * Gets a request attribute.
     *
     * @param string $name    HttpRequest attribute.
     * @param string $default Default value (not required)
     *
     * @return mixed
     */
    public function get($name, $default = "")
    {
        $param = Arr::get($_REQUEST, $name, $default);

        if ($_SERVER["REQUEST_METHOD"] == "GET" && is_string($param)) {
            $param = urldecode($param);
        }

        return $param;
    }

    /**
     * Sets a request attribute.
     *
     * @param string $name  HttpRequest attribute.
     * @param mixed  $value HttpRequest value.
     *
     * @return void
     */
    public function set($name, $value)
    {
        $_REQUEST[$name] = $value;
    }

    /**
     * Does the request attribute exist?
     *
     * @param string $name HttpRequest attribute.
     *
     * @return boolean
     */
    public function exist($name)
    {
        return Arr::is($_REQUEST, $name);
    }

    /**
     * Deletes a request attribute.
     *
     * @param string $name HttpRequest attribute.
     *
     * @return void
     */
    public function delete($name)
    {
        Arr::del($_REQUEST, $name);
    }
}
