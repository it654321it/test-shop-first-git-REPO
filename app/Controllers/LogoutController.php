<?php
namespace Controllers;

use Core\Controller;
use Core\App;

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

        if ( file_exists ( App::getViewDir().DS. 'menuLOGOUT.php' ))  {
                unlink( App::getViewDir().DS. 'menuLOGOUT.php' );
                clearstatcache(); 
                
                rename (App::getViewDir() . DS. 'menu.php', App::getViewDir() . DS. 'menuLOGOUT.php');
                clearstatcache(); 
                
                rename (App::getViewDir() . DS. 'menuLOGIN.php', App::getViewDir() . DS. 'menu.php');
                clearstatcache();
           } 
           else {
                rename (App::getViewDir() . DS. 'menu.php', App::getViewDir() . DS. 'menuLOGOUT.php');
                clearstatcache(); 
                
                copy( App::getViewDir().DS. 'menu-login-copy.php' , App::getViewDir().DS. 'menu.php' );
                clearstatcache();
           }
           
    $this->renderLayout();
    }     
}