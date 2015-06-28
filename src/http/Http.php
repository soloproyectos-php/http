<?php
/**
 * This file is part of SoloProyectos common library.
 *
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http
 */
namespace soloproyectos\http;
use soloproyectos\text\Text;

/**
 * Class Http.
 *
 * This class is used to send POST requests.
 *
 * @package Http
 * @author  Gonzalo Chumillas <gchumillas@email.com>
 * @license https://github.com/soloproyectos-php/http/blob/master/LICENSE The MIT License (MIT)
 * @link    https://github.com/soloproyectos-php/http
 */
class Http
{
    /**
     * Appends parameters to a given url.
     *
     * For example:
     * ```php
     * echo Http::addParams("http://www.mysite.php", array("username" => "John", "id" => 101));
     * ```
     *
     * @param string $url    URL
     * @param array  $params Associative array of parameters
     *
     * @return strings.
     */
    static public function addParams($url, $params)
    {
        $query = parse_url($url, PHP_URL_QUERY);
        $separator = (Text::isEmpty($query)? "?" : "&");
        return Text::concat($separator, $url, http_build_query($params));
    }
}
