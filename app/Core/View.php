<?php
declare(strict_types=1);

namespace Core;

use Core\Url;

class View
{

    /** @var array */
    private $data;

    /** @var string */
    private $viewPath;

    /**
     * @param array       $data
     * @param string|null $viewPath
     */
    public function __construct(array $data = [], string $viewPath = null)
    {
        $this->data = $data;
        $this->viewPath = $viewPath;
    }

    public static function getViewDir(): string
    {
        return App::getAppDir() . DS . 'views';
    }

    public function getData()
    {
        return $this->data;
    }

    protected function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function get($key)
    {
        return $this->data[$key];
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $path = $this->viewPath;
        if ($path === null) {
            $path = $this->getDefaultPath();
        }

        // render partial view data.
        array_walk($this->data, static function(&$item, $key) {
            if ($item instanceof View) {
                $item = $item->render();
            }
        });
        extract($this->data, EXTR_SKIP);
        ob_start();

        include $path;

        return ob_get_clean();
    }

    /**
     * @return string
     */
    private function getDefaultPath(): string
    {
        $controllerName = Route::getController();
        $actionName = Route::getAction();
        $path = self::getViewDir() . DS . $controllerName . DS . $actionName . '.php';
        $path404 = self::getViewDir() . DS . 'error' . DS . 'error404.php';
        return file_exists($path) ? $path : $path404;
    }

     private function getBP(): string
     {
         return Route::getBP();
     }

     public function getBlock(string $name): View
     {
         $path = self::getViewDir() . DS . $name . '.php';
         return new View($this->getData(), $path);
     }
}
