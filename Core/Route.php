<?php


namespace AksuSoftware\Core;


class Route
{
    public static array $routes = [];

    public static function get($path, $callback)
    {
        self::$routes['get'][$path] = $callback;
    }

    public static function post($path, $callback)
    {
        self::$routes['post'][$path] = $callback;
    }

    public static function dispatch()
    {
        print_r(self::$routes);
    }
}