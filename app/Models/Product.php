<?php
namespace Models;

use Core\Model;
use Core\DB;

class Product extends Model
{

    function __construct()
    {
        $this->table_name = "products";
        $this->id_column = "id";
    }
      
    public function getCollectionAll()
    {
        $db = new DB();
        $this->sql = "SELECT * FROM  $this->table_name WHERE $this->id_column=$this->params;"; 
        $this->collection = $db->query($this->sql); 

    return $this;
    }
    
    public function getItem($id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE $this->id_column=?;";
        $db = new DB();
        $params = array($id);
    
    return $db->query($sql, $params)[0];
    }
        
    public function addItem()
    {
       if ( $this->checkRate == 1) {
           
           $this->sql = "SELECT MAX(id) AS MaxProductId FROM $this->table_name;";
           $db = new DB();
           $lastID = $db->query($this->sql);
           $newID = $lastID[0]['MaxProductId'] ;
           $newID++;
           $db = new DB();
           $sku = htmlspecialchars((filter_input(INPUT_POST, 'newSKU')));
           $name = htmlspecialchars((filter_input(INPUT_POST, 'newName')));
           $description = htmlspecialchars($_POST['newDsc'], ENT_QUOTES);
           
           $postValues = "'".$sku."','".$name."',".(string)$_POST['newPrice'].",".(string)($_POST['newQTY']).",'".$description."'"; 

           $this->sql = "INSERT INTO $this->table_name VALUES ($newID, $postValues);";
           $db->query($this->sql);  
           
       return 1;
       } 
      
    return 0;
    }
       
    public function deleteItem($id)
    {
        if( filter_input(INPUT_POST, 'del') !== null ) {    
            
           $db = new DB();
           $this->sql = "DELETE FROM $this->table_name WHERE id=$id";
           $db->query($this->sql);       
           echo "<script type='text/javascript'>alert('Інформація про товар видалена!');</script>";   
         
        return 1;
        } 

    return 0;
    }
        
    public function saveEditItem($id, $values)
    {
        if ( $this->checkRate == 1) {

            $sku = htmlspecialchars(filter_input(INPUT_POST, 'editSKU'));
            $name = htmlspecialchars(filter_input(INPUT_POST, 'editName'));
            $price = filter_input(INPUT_POST, 'editPrice');
            $qty = filter_input(INPUT_POST, 'editQTY');
            $dsc = htmlspecialchars(filter_input(INPUT_POST, 'editDsc'));
            $db = new DB();
            $this->sql = "UPDATE $this->table_name SET sku = '$sku', name = '$name', price = $price, qty = $qty, description = '$dsc' WHERE id=$id;";
            $db->query($this->sql);
            echo "<script type='text/javascript'>alert('Інформацію про даний товар успішно змінено !');</script>"; 
       }   
    }
    
    public function sortProducts($params)
    {       
       if ($params[0] =='pASC' || $params[0] =='pDESC' || $params[0] =='qASC' || $params[0] =='qDESC') {
           $goodSelection = 1;
       } 
       else {
           $goodSelection = 0;
       }
       
       if (is_numeric($params[1])) {
           $goodMinPrice = 1;
           $params[1] = str_replace (',','.', $params[1]);
       } 
       else {
           $goodMinPrice = 0;
       }
       
       if (is_numeric($params[2])) {
           $goodMaxPrice = 1;
           $params[2] = str_replace (',','.', $params[2]);
       } 
       else {
           $goodMaxPrice = 0;
       }
       
       if ( $goodMinPrice === 1 && $goodMaxPrice === 0) {
           $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price ASC";
           echo "<script type='text/javascript'>window.alert('Мінімальну ціну не задано або задано не коректно (повторіть спробу). "
           . "Буде застосовано сортування за замовчуванням до всього діапазону товарів!');</script>";
       
       return $this;
       }
       
       if ( $goodMinPrice === 0 && $goodMaxPrice === 1) {
           $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price ASC";
           echo "<script type='text/javascript'>window.alert('Максимальну ціну не задано або задано не коректно (повторіть спробу). "
           . "Буде застосовано сортування за замовчуванням до всього діапазону товарів!');</script>";
       
       return $this;
       }
       
       if ((int)($params[1])>(int)($params[2])) {
           $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price ASC";
           echo "<script type='text/javascript'>window.alert('Ціна зліва є більшою за ціну зправа (не коректно)."
           . " Необхідно ввести коректний діапазон цін (ціна зліва має бути меншою за ціну зправа)! "
                   . "Буде застосовано сортування за замовчуванням до всього діапазону товарів!');</script>";
       
       return $this;
       }
              
       if ($goodSelection === 0 && $goodMinPrice === 0 && $goodMaxPrice === 0) {
            $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price ASC";
       }
       
       if ($goodSelection === 1 && $goodMinPrice === 0 && $goodMaxPrice === 0) {
           
           if ($params[0] === 'pDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price DESC";
            } 
            else if ($params[0] === 'pASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price ASC";
            } 
            else if ($params[0] === 'qASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY qty ASC";
            } 
            else if ($params[0] === 'qDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY qty DESC";
            } 
       }
       
       if ($goodSelection === 1 && $goodMinPrice === 1 && $goodMaxPrice === 0) {
           
           $prcFrom = $params[1];
           $prcTo = $_COOKIE['maxPrice']; 
           
           if ($params[0] === 'pDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price DESC";
            } 
            else if ($params[0] === 'pASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price ASC";
            } 
            else if ($params[0] === 'qASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY qty ASC";
            } 
            else if ($params[0] === 'qDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY qty DESC";
            }
        } 
       
        if ($goodSelection === 1 && $goodMinPrice === 0 && $goodMaxPrice === 1) {
           
           $prcFrom = 0;
           $prcTo = $_COOKIE['maxPrice']; 
           
           if ($params[0] === 'pDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price DESC";
            } 
            else if ($params[0] === 'pASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price ASC";
            } 
            else if ($params[0] === 'qASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY qty ASC";
            } 
            else if ($params[0] === 'qDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY qty DESC";
            }
        }
       
        if ($goodSelection === 1 && $goodMinPrice === 1 && $goodMaxPrice === 1) {
           
           $prcFrom = $params[1];
           $prcTo = $params[2]; 
           
           if ($params[0] === 'pDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price DESC";
            } 
            else if ($params[0] === 'pASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price ASC";
            } 
            else if ($params[0] === 'qASC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY qty ASC";
            } 
            else if ($params[0] === 'qDESC') {
                $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY qty DESC";
            }
        }
        
        if ($goodSelection === 0 && $goodMinPrice === 1 && $goodMaxPrice === 1) {
           
           $prcFrom = $params[1];
           $prcTo = $params[2]; 
           $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price ASC";
        }    
        
        if ($goodSelection === 0 && $goodMinPrice === 1 && $goodMaxPrice === 0) {
           
           $prcFrom = $params[1];
           $prcTo = $_COOKIE['maxPrice']; 
           $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price ASC";
        }
        
        if ($goodSelection === 0 && $goodMinPrice === 0 && $goodMaxPrice === 1) {
           
           $prcFrom = 0;
           $prcTo = $params[2]; 
           $this->sql = "SELECT * FROM $this->table_name WHERE price BETWEEN $prcFrom AND $prcTo ORDER BY price ASC";
        }
  
    return $this;
    }
    
    public function getPostValues()
    {
        $valuesTmp = [];
        $values = [];
        $columns = $this->getColumns();
        $id = filter_input(INPUT_GET, 'id');
        
        for ($i=0; $i<count($columns); $i++) {
            $db = new DB();
            $this->sql = "SELECT $columns[$i] FROM $this->table_name WHERE id=$id;";
            $valuesTmp[$columns[$i]] = $db->query($this->sql);
        }
        
        foreach($valuesTmp as $lv_1) {
           foreach($lv_1 as $lv_2) {
               foreach($lv_2 as $lv_3) { 
                    array_push ($values, $lv_3);
               }
           }              
        }

    return $values;
    }
    
    public function checkPostValues($sku, $name, $price, $qty, $dsc)
    {
        $this->checkRate = 0;
        if ( filter_input(INPUT_POST, 'ad') !== null || filter_input(INPUT_POST, 'edit') !== null ) {
                
            $sku = trim($sku);
            $pattern = '/^[a-z]{1}[0-9]{1,30}$/i';

            if ( empty($sku) || !preg_match($pattern, $sku) ) {
               echo "<script type='text/javascript'>alert('Не правильно введено артикул (sku) товару. Повторіть спробу !');</script>"; 
               $_POST['newSKU'] =  null;
               $this->checkRate = fault;
               return;
            } 
            else {
                $name = trim($name);
                $pattern = '/^[a-z\s]{1,30}$/i';
                
                if ( empty($name) || !preg_match($pattern, $name) ) {
                    echo "<script type='text/javascript'>alert('Не правильно введено назву товару. Повторіть спробу !');</script>"; 
                    $_POST['newName'] = null;
                    $this->checkRate = fault;
                    return;
                } 
                else {
                    $price = trim($price);
                    $pattern = '/\d{1,12}\.{0,1}\d{0,2}$/';
                    
                    if ( empty($price) || !preg_match($pattern, $price) || !is_numeric($price) ) {
                        echo "<script type='text/javascript'>alert('Не правильно введено ціну товару. Повторіть спробу !');</script>"; 
                        $_POST['newPrice'] = null;
                        $this->checkRate = fault;
                        return;
                    } 
                    else {
                        $qty = trim($qty);
                        $pattern = '/^[0-9]{1,12}$/i'; 
            
                        if ( empty($qty) || !preg_match($pattern, $qty) || !is_numeric($qty) ) {
                            echo "<script type='text/javascript'>alert('Не правильно введено кількість товару. Повторіть спробу !');</script>"; 
                            $_POST['newQTY'] = null;
                            $this->checkRate = fault;
                            return;
                        } 
                        else {
                            $dsc = trim($dsc);
                            $pattern = '/^[a-z\s]{1,50}$/i';
            
                            if ( empty($dsc) ||  !preg_match($pattern, $dsc) ) {
                                echo "<script type='text/javascript'>alert('Не правильно введено опис товару. Повторіть спробу !');</script>"; 
                                $_POST['newDsc'] = null;
                                $this->checkRate = fault;
                                return;
                            }
                        }
                    }
                }
            }
        
        $this->checkRate = 1;
        }
    }
    
}