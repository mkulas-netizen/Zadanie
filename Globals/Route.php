<?php


namespace Globals;


class Route
{


    /*** 404 page */
    public static function show_404()
    {
        header("HTTP/1.0 404 NOT FOUND");
        include_once("View/ServerPages/404.php");
        die();
    }


    /**
     * @return false|string[]
     * segment url
     */
    public function get_segments()
    {
        $current_url = 'http' .
            (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 's://' : '://') .
            $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $path = str_replace(BASE_URL, '', $current_url);
        $path = trim(parse_url($path, PHP_URL_PATH), '/');
        return explode('/', $path);
    }


    /**
     * @param $index
     * @return false|mixed|string
     */
   public  function segment($index)
    {
        $segments = $this->get_segments();
        return isset($segments[$index - 1]) ? $segments[$index - 1] : false;
    }
}