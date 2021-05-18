<?php
namespace Core;

/**
 * Class Controller
 */
class Controller
{
    protected $data = [];

    public function __construct()
    {
        $this->set('layoutPath', App::getLayoutDir() . DS. 'layout.php');
        $this->set('menuPath', App::getViewDir() . DS. 'menu.php');
    }

    protected function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    protected function get($key)
    {
        return $this->data[$key];
    }

    public function renderLayout()
    {
        $this->set('menuCollection',$this->getMenuCollection());
        $menu =  new View($this->data, $this->get('menuPath'));

        $content = new View($this->data);

        $this->set('menu', $menu);
        $this->set('content', $content);

        $view = new View($this->data, $this->get('layoutPath'));

        echo $view->render();
    }

     /**
     * @param $name
     * @return mixed
     */
    public function getModel($name)
    {
        $name = '\\Models\\' . ucfirst($name);
        $model = new $name();
        return $model;
    }

     /**
     * @return mixed
     */
     private function getMenuCollection()
     {
        return $this->getModel('menu')
            ->initCollection()
            ->sort(array('sort_order'=>'ASC'))
            ->getCollection()
            ->select();
     }

     protected function forward($route)
     {
         App::run($route);
     }
    
}