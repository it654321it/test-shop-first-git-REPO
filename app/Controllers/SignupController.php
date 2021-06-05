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
        $model = $this->getModel('Customer');
        $model->checkFirstname(filter_input(INPUT_POST, 'firstname')); // ще не працює
        $model->checkLastname(filter_input(INPUT_POST, 'lastname')); // ще не працює
        $model->checkTel(filter_input(INPUT_POST, 'tel')); // ще не працює
        $model->checkEmail(filter_input(INPUT_POST, 'emailcheck')); // ще не працює
        $model->checkCity(filter_input(INPUT_POST, 'city')); // ще не працює
        $model->checkPass(filter_input(INPUT_POST, 'pass_1'), filter_input(INPUT_POST, 'pass_2')); // ще не працює

        if ( $model->addCustomer() === 1 ) { // ще не працює
            $_SESSION['data'] = filter_input(INPUT_POST, 'firstname'). ' '. filter_input(INPUT_POST, 'lastname');
            echo "<script type='text/javascript'>alert('Новий користувач в БД внесений !');</script>";
            Controller::redirect('/customer/info');

        }
     $this->renderLayout(); 
     }

    public function getId()
    {      
        if (isset($_GET['id'])) {           
            return $_GET['id'];
        } else {
            return NULL;
        }
    return filter_input(INPUT_GET, 'id');
    }
    
}