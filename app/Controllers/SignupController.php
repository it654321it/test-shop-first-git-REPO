<?php
namespace Controllers; //назва простору

use Core\Controller; //використовувати методу класу Controller з папки Core
use Core\View; //використовувати методу класу View з папки Core
use Core\DB;//використовувати методу класу DB з папки Core

use Core\Helper;//новий метод - починаючи з задачі №33
//use Core\App;// я додав - але ефекту - нуль
/**
 * Class ProductController
 */
class SignupController extends Controller // ProductController - це дочірній клас класу Controller
{

    public function signupAction() // додавання нового товару в базу даних
    {
        //echo 'запускаємо метод addAction() в скрипті ProductController.php','<br>';
        //запускається
        $this->set('title', "Реєстрація нового користувача");//записати у змінну $data в ключ "title" - значення "Додавання товару"
        
        // метод getModel - з Controller.php
        $model = $this->getModel('Customer');// отримання назви моделі з методу getModel і присвоєння цього значення змінній екземпляру $model
        
        // методи check... в Model.php
        $model->checkFirstname(filter_input(INPUT_POST, 'firstname')); // працює
        $model->checkLastname(filter_input(INPUT_POST, 'lastname')); // працює
        $model->checkTel(filter_input(INPUT_POST, 'tel')); // працює
        $model->checkEmail(filter_input(INPUT_POST, 'emailcheck')); // працює
        $model->checkCity(filter_input(INPUT_POST, 'city')); // працює
        $model->checkPass(filter_input(INPUT_POST, 'pass_1'), filter_input(INPUT_POST, 'pass_2')); // працює

        if ( $model->addCustomer() === 1 ) {
            $_SESSION['data'] = filter_input(INPUT_POST, 'firstname'). ' '. filter_input(INPUT_POST, 'lastname');// працює при любих редиректах
            echo "<script type='text/javascript'>alert('Новий користувач в БД внесений !');</script>";// не працює
            Helper::redirect('/customer/info');// працює, але повідомлення НЕ виводиться
            //Helper::redirect('/product/list'); // працює, але повідомлення НЕ виводиться
            //Helper::redirect('/index/hellowuser'); // не працює, але повідомлення виводиться
        }
        // метод getModel в Controller.php
        $this->renderLayout(); // працює

     }

     /**
     * @return mixed
     */
    public function getId() // перевіряє чи існує рядок з номер id за значенням суперглобальної змінної GET (в адр.рядку) в ...таблиці і видає значення id
    // використовується як має бути
    {
        //echo 'запускаємо метод getId() в скрипті ProductController.php','<br>';
        
        if (isset($_GET['id'])) {
            //echo '$_GET[id] знайдено ';// 
            //echo '$_GET[id]= ' . $_GET['id'];
            
            return $_GET['id'];
        } else {
            //echo '$_GET[id] не знайдено ';
            return NULL;
        }
    return filter_input(INPUT_GET, 'id');
    }
    
}