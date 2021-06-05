<?php
namespace Controllers;

use Core\App;
use Core\Controller;
use Core\View;
use Core\Helper; 

class LoginController extends Controller
{
    
    public function loginAction()
    {
        $this->set('title', "Вхід в систему"); 
        
        if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {

           $email = filter_input(INPUT_POST, 'email');             
           $password = md5(filter_input(INPUT_POST, 'password'));            
           $params =array (
                'email'=>$email,
                'password'=> $password
            );

            $customer = $this->getModel('Customer')->initCollection()
            ->filterUser($params)
            ->getCollection()
            ->selectFirst(); 
              
            if( count($customer) > 7   &&  !empty($customer['customer_id']) ) {
                
                $_SESSION['id'] = $customer['customer_id'];
                $_SESSION['admin_role'] = $customer['admin_role'];               
                $_SESSION['data'] = $customer['first_name']. ' '. $customer['last_name'];
                
                if ( !file_exists( App::getViewDir().DS. 'menuLOGIN.php' ) ) {

                    copy(App::getViewDir() . DS. 'menu-login-copy.php', App::getViewDir() . DS. 'menuLOGIN.php');
                    clearstatcache();
                 }
          
                if ( file_exists( App::getViewDir().DS. 'menu.php' ) ) {
 
                    unlink(App::getViewDir().DS. 'menu.php' );
                    clearstatcache();
                    
                    copy( App::getViewDir().DS. 'menu-logout-copy.php' , App::getViewDir().DS. 'menu.php' );
                    clearstatcache();

                    if ( ! file_exists( App::getViewDir().DS. 'menuLOGOUT.php' ) ) {

                          copy( App::getViewDir().DS. 'menu-logout-copy.php' , App::getViewDir().DS. 'menuLOGOUT.php' );
                          clearstatcache();
                      } else {

                            rename(App::getViewDir() . DS. 'menuLOGOUT.php', App::getViewDir() . DS. 'menu.php');
                            clearstatcache(); 
                      }
                Controller::redirect('/index/hellowuser');
                } 
                else {
                     copy( App::getViewDir().DS. 'menu-login-copy.php' , App::getViewDir().DS. 'menu.php' );
                     clearstatcache();
                }               
            } 
            else {
                $this->invalid_password = 1;
            }
        }
    
    $this->renderLayout();
    }
    
}