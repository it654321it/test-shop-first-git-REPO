<?php
namespace Models;

use Core\Model;
use Core\DB;

class Signup extends Model
{

    function __construct()
    {
        $this->table_name="customer"; 
        $this->id_column = "customer_id";
    }
        
    public function checkSignupPostValues($firstname, $lastname, $tel, $emailCustomer, $city, $pass_1, $pass_2)
    {
        $this->checkRate = 0;
        if ( filter_input(INPUT_POST, 'signupButton') !== null ) {
                
            $firstname = trim($firstname);
            $patternFirstName = '/^[a-z-]{1,15}$/i';
            
            $lastname = trim($lastname);
            $patternLastName = '/^[a-z-]{1,20}$/i';

            $tel = trim($tel);
            $patternTel = '/^[0-9]{10}$/i';

            $email = htmlspecialchars( trim($emailCustomer) );
            $patternEmail = '/^[a-z-_0-9]{1,15}@[a-z]{1,10}[.]{1}[a-z]{1,5}$/i'; 

            $city = trim($city);
            $patternCity = '/^[a-z-\s]{1,20}$/i';

            $pass_1 = trim($pass_1);
            $pass_2 = trim($pass_2);
            $patternPswd = '/^[a-z0-9]{8,16}$/i';
            
            if ( empty($firstname) && empty($lastname) && empty($tel) && empty($email) && empty($city) && empty($pass_1) && empty($pass_2)) {
               echo "<script type='text/javascript'>alert('Не введено жодних реєстраційних даних. Повторіть спробу !');</script>"; 
               $this->checkRate = false;
               return;
            } 
                
            if ( empty($firstname) || !preg_match($patternFirstName, $firstname) ) {
               echo "<script type='text/javascript'>alert('Ім'я користувача відстунє або не відповідає вимогам. Повторіть спробу !');</script>"; 
               $_POST['firstname'] = null;
               $this->checkRate = false;
               return;
            } 
          
            if ( empty($lastname) || !preg_match($patternLastName, $lastname) ) {
                echo "<script type='text/javascript'>alert('Прізвище користувача відстунє або не відповідає вимогам. Повторіть спробу !');</script>"; 
                $_POST['lastname'] = null;
                $this->checkRate = false;
                return;
            } 

            if ( empty($tel) || !preg_match($patternTel, $tel) ) {
                echo "<script type='text/javascript'>alert('Номер телефону користувача відстуній або не відповідає вимогам. "
                    . "Повторіть спробу !');</script>"; 
                $_POST['tel'] = null;
                $this->checkRate = false;
                return;
            }

            if ( empty($emailCustomer) || !preg_match($patternEmail, $emailCustomer) ) {
                echo "<script type='text/javascript'>alert('Електронна адреса користувача відстуня або не відповідає вимогам."
                    . " Повторіть спробу !');</script>"; 
                $_POST['emailCustomer'] = null;
                $this->checkRate = false;
                return;
            } 
            else {
                  $db = new DB();
                  $this->sql = "SELECT * FROM $this->table_name WHERE email=?;";                 
                  $query = $db->getConnection();
                  $protectedQuery = $query->prepare($this->sql);
                  $protectedQuery->execute(array($email));
                  
                  if ( count ($protectedQuery->fetchAll()) !== 0 ) { 
                      echo "<script type='text/javascript'>alert('Дана електронна адреса вже використовується. Введіть інакшу !');</script>"; 
                      $this->checkRate = false;
                  return;
                  }
             }

            if ( empty($city) ||  !preg_match($patternCity, $city) ) {
                echo "<script type='text/javascript'>alert('Назва міста відстуня або не відповідає вимогам. Повторіть спробу !');</script>"; 
                $_POST['city'] = null;
                $this->checkRate = false;
                return;
            }

            if ( empty($pass_1) || empty($pass_2) ) {
                echo "<script type='text/javascript'>alert('Один або обидва паролі порожні. Повторіть спробу !');</script>"; 
                $this->checkRate = false;
                return;
            }
            else if ( $pass_1 !== $pass_2 ) {
                echo "<script type='text/javascript'>alert('Уведені паролі не співпадають. Повторіть спробу !');</script>"; 
                $_POST['pass_1'] = $_POST['pass_2'] = null;
                $this->checkRate = false;
                return;
            } 
            else if ( !preg_match($patternPswd, $pass_1) ) {
                echo "<script type='text/javascript'>alert('Уведені паролі не відповідають встановленим вимогам до паролів. Повторіть спробу !');</script>"; 
                $_POST['pass_1'] = $_POST['pass_2'] = null;
                $this->checkRate = false;
                return;
            }

        $this->checkRate = 1;
        }
    }
  
    public function addCustomer() 
    { 
     
     if ( filter_input(INPUT_POST, 'signupButton') !== null ) {
         
        if ( $this->checkRate === 1) {
          
            $db = new DB();
            $this->sql = "SELECT MAX(customer_id) AS MaxCustomerId FROM $this->table_name;";
            $lastId = $db->query($this->sql);
            $nextId = $lastId[0]['MaxCustomerId'] ;
            $nextId++;
            $db = new DB();
            $hlname = htmlspecialchars((filter_input(INPUT_POST, 'lastname')));
            $hfname = htmlspecialchars((filter_input(INPUT_POST, 'firstname'))); 
            $htel = htmlspecialchars((filter_input(INPUT_POST, 'tel')));
            $hemail = htmlspecialchars((filter_input(INPUT_POST, 'emailCustomer')));
            $hcity = htmlspecialchars((filter_input(INPUT_POST, 'city')));
            $hpass = md5( htmlspecialchars ((filter_input ( INPUT_POST, 'pass_1'))));
            $this->sql = "INSERT INTO $this->table_name VALUES (?,?,?,?,?,?,?,?);"; 
            $query = $db->getConnection();
            $protectedQuery = $query->prepare($this->sql);
            $protectedQuery->execute(array($nextId, $hlname, $hfname, $htel, $hemail, $hcity, $hpass, 0));

        return 1;
        }  
     } 

   }
}