<?php
namespace Controllers;

use Core\Controller;

/**
 * Class ErrorController
 */
class ErrorController extends Controller
{
    /**
     *
     */
    public function error404Action()
    {
        $this->set("title", "Error 404");
        header("HTTP/1.0 404 Not Found");
        $this->renderLayout();
    }

}