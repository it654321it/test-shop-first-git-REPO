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
    
     public function checkFirstname($a)
    {
    //...     
    return $this;
    }
    
     public function checkLastname($a)
    {
    //...       
    return $this;
    }
    
     public function checkTel($a)
    {
    //...       
    return $this;
    }
    
     public function checkEmail($a)
    {
    //...       
    return $this;
    }
    
    public function checkCity($a)
    {
    //...  
    return $this;
    }
    
    public function checkPass($a, $b)
    { 
    //...  
    return $this;
    }
          
}