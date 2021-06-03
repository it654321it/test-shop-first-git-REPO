<?php
namespace Controllers;

use Core\Controller;

class LogoutController extends Controller
{

    public function logoutAction()
    {
        $this->set('title', "Вихід");
        $this->getModel('Customer');
        $_SESSION = [];

        if (!empty($_COOKIE[session_name()]))
        {
            setcookie(session_name(), "", time() - 3600, "/");
        }
        session_destroy();
        Controller::redirect('/product/list');
        $this->renderLayout();
    }     
}