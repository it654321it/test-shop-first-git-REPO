<?php
namespace Controllers;

use Core\Controller;
use Core\View;
use Core\DB;

class SignupController extends Controller
{
    public function signupAction()
    {
        $this->set('title', "Реєстрація нового користувача"); 
        $model = $this->getModel('Signup');
        $model->checkSignupPostValues(filter_input(INPUT_POST, 'firstname'), filter_input(INPUT_POST, 'lastname'), filter_input(INPUT_POST, 'tel'),
                            filter_input(INPUT_POST, 'emailCustomer'), filter_input(INPUT_POST, 'city'), filter_input(INPUT_POST, 'pass_1'), 
                                filter_input(INPUT_POST, 'pass_2'));

        if ( $model->addCustomer() === 1 ) {          
            Controller::redirect('/customer/welcome');
        }
        
     $this->renderLayout();
     }

    public function getId()
    {        
        if (isset($_GET['id'])) {
  
            return $_GET['id'];
        } 
        else {     
            return NULL;
        }
        
    return filter_input(INPUT_GET, 'id');
    }
    
}