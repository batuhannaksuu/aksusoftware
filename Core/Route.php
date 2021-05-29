<?php


namespace AksuSoftware\Core;


use AksuSoftware\App\Controllers\Home;

class Route
{
    public static array $patterns = [
        '{id[0-9]?}' => '([0-9]+)',
        '{url[0-9]}?}' => '([0-9a-zA-Z-_]+)'
    ];

    public static bool $hasRoute = false;
    public static array $routes = [];
    public static string $prefix = '';
    /**
     * @param $path
     * @param $callback
     */
    public static function get($path, $callback): Route
    {
        self::$routes['get'][self::$prefix . $path] = [
            'callback' => $callback
        ];
        return new self();
    }

    /**
     * @param $path
     * @param $callback
     */
    public static function post($path, $callback)
    {
        self::$routes['post'][$path] = [
            'callback' => $callback
        ];
    }


    public static function dispatch()
    {
        $url = self::getUrl();
        $method = self::getMethod();
        foreach (self::$routes[$method] as $path => $props) {
            $callback = $props['callback'];
            foreach (self::$patterns as $key => $pattern) {
                $path = preg_replace('#' . $key . '#', $pattern, $path);
            }
            $pattern = '#^' . $path . '$#';

            if (preg_match($pattern, $url, $params)) {
                array_shift($params);

                self::$hasRoute = true;
                if (is_callable($callback)) {

                    echo call_user_func_array($callback, $params);

                } elseif (is_string($callback)) {
                    [$controllerName, $methodName] = explode('@', $callback);
                    $controllerName = '\AksuSoftware\App\Controllers\\' . $controllerName;
                    $controller = new $controllerName();
                    echo call_user_func_array([$controller, $methodName], $params);
                }
            }
        }
        self::hasRoute();
    }


    public static function hasRoute()
    {
        if (self::$hasRoute === false) {
            die('Sayfa bulunamadı');
        }
    }

    /**
     * @return string
     */
    public static function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * @return string
     */
    public static function getUrl(): string
    {
        return str_replace(getenv('BASE_PATH'), null, $_SERVER['REQUEST_URI']);
    }

    public function name($name)
    {
        $key = array_key_last(self::$routes['get']);
        self::$routes['get'][$key]['name'] = $name;
        //print_r(self::$routes);
    }

    public static function url(string $name,array $params = []): string
    {
        $route = array_key_first(array_filter(self::$routes['get'],function($route) use($name){
            return $route['name'] === $name;
        }));
        return str_replace(array_keys($params),array_values($params),$route);
    }

    /**
     * @param $prefix
     * @return Route
     */
    public static function prefix($prefix) : Route
    {
        self::$prefix = $prefix;
        return new self();
    }

    /**
     * @param \Closure $closure
     */
    public static function group(\Closure $closure): void
    {
        $closure();
        self::$prefix = '';
    }

}