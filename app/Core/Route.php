<?php
namespace Core;

/**
 * Class Route
 */
class Route
{

    /**
     * @var null
     */
    private static $controller = null;
    /**
     * @var null
     */
    private static $action = null;

    /**
     * @return mixed|string
     */
    public static function getBP()
    {
        return self::getBasePath();
    }

    /**
     * @return mixed|string
     */
    public static function getBasePath()
    {
        $base_path = substr(ROOT, strlen($_SERVER['DOCUMENT_ROOT']));
        if (DS !== '/') {
            $base_path = str_replace(DS,'/', $base_path);
        }
        return $base_path;
    }

    /**
     * @param $uri
     */
    public static function init(string $route = null)
    {
         if (!$route) {
             $request = explode('?', $_SERVER['REQUEST_URI']);
             $uri = $request[0];
             $route = substr($uri, strlen(self::getBasePath()));
         }
         $route_array = explode('/', $route);
         if ($route_array[0] === "") {
              array_shift($route_array);
         }
         if (isset($route_array[0]) && $route_array[0] === 'index.php') {
              array_shift($route_array);
         }
         self::$controller = !empty($route_array[0]) ? $route_array[0] : 'index';
         self::$action = !empty($route_array[1]) ? $route_array[1] : 'index';
    }

    /**
     * @return null
     */
    public static function getAction()
     {
        return self::$action;
     }

    /**
     * @return null
     */
    public static function getController()
     {
        return self::$controller;
     }

}
