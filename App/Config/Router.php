<?php namespace App\Config;

class Router
{
    public static function get($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'GET') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function post($route, $callback)
    {
        if (strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') !== 0) {
            return;
        }

        self::on($route, $callback);
    }

    public static function on($regex, $callback)
    {
        $params = strtok($_SERVER['REQUEST_URI'], '?');
        $params = (stripos($params, "/") !== 0) ? "/" . $params : $params;
        $regex = str_replace('/', '\/', $regex);
        $is_match = preg_match('/^' . ($regex) . '$/', $params, $matches, PREG_OFFSET_CAPTURE);

        if ($is_match) {
            array_shift($matches);
            $params = array_map(function ($param) {
                return $param[0];
            }, $matches);
            $callback(new Request($params));
        }
    }
}