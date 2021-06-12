<?php
namespace Models;

use Core\Model;
use Core\DB;

class Customer extends Model
{

    function __construct()
    {
        $this->table_name="customer"; 
        $this->id_column = "customer_id";
    }
        
    public function getCustomerCollection()
    {
        $db = new DB();
        $this->sql = "SELECT * FROM  $this->table_name WHERE $this->id_column= $this->params;"; 
        $this->collection = $db->query($this->sql); 

    return $this;
    }
    
    public function filterUser($params)
    {         
            $db = new DB();                
            $this->sql = "SELECT email, password FROM $this->table_name;";
            $arr = $db->query($this->sql);
            $email = $password = null;
                
            for ($i=0; $i<count($arr); $i++) {
                if ( $arr[$i]['email'] == $params['email'] )  {
                    $email = $i;
                } 

                if ( $arr[$i]['password'] == $params['password'] )  {
                    $password = $i;
                }
           } 
                
             if ( $email !== null && $password !== null && $email === $password ) {
                   $email++;
                   $columns = implode(',',$this->getColumns());
                   $this->sql = "select $columns from  $this->table_name WHERE customer_id=$email";
             } 
             else {
                     if ( $email === null && $params['email'] || $email === null && $params['email'] === null ) {
                        echo "<script type='text/javascript'>alert('Некоректне значення електронної адреси!"
                         . " Спробуйте ще раз ! ');</script>";
                    } 
                    else if ($password === null && $params['password'] || $password === null && $params['password'] === null ) {
                        echo "<script type='text/javascript'>alert('Некоректне значення пароля! Спробуйте ще раз ! ');</script>";
                    }
                    else if ($email !== $password && $email === null 
                                 || $email !== $password && $password === null
                                 || $email === null && $password === null
                                 || $email !== $password) {
                        echo "<script type='text/javascript'>alert('Користувача з таким паролем і такою ел.адресою - не існує ! "
                        . "Спробуйте ще раз ! ');</script>";
                    }
             }

    return $this;
    }
    
}