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
        echo self::getUrl();
//        $method = self::getMethod();
//        foreach (self::$routes[$method] as $path => $callback)
//        {
//            echo $path . PHP_EOL;
//        }
    }

    /**
     * @return mixed
     */
    public static function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public static function getUrl()
    {
        return $_SERVER['REQUEST_URI'];
    }
}