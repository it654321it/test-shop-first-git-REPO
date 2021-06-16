<?php
namespace Models;

use Core\Model;
use Core\DB;
use PDO;

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
           $sku = htmlspecialchars(filter_input(INPUT_POST, 'newSKU'), ENT_QUOTES);
           $name = htmlspecialchars(filter_input(INPUT_POST, 'newName'), ENT_QUOTES);
           $price = htmlspecialchars(filter_input(INPUT_POST, 'newPrice'), ENT_QUOTES);
           $qty = htmlspecialchars(filter_input(INPUT_POST, 'newQTY'), ENT_QUOTES);
           $description = htmlspecialchars(filter_input(INPUT_POST,'newDsc'), ENT_QUOTES);
           $this->sql = "INSERT INTO $this->table_name VALUES (?,?,?,?,?,?);";
           $query = $db->getConnection();
           $protectedQuery = $query->prepare($this->sql);
           $protectedQuery->execute(array($newID, $sku, $name, $price, $qty, $description));
           
       return 1;
       } 
      
    return 0;
    }
       
    public function deleteItem($id)
    {
        if( filter_input(INPUT_POST, 'del') !== null ) {    
            
           $db = new DB();
           $this->sql = "DELETE FROM $this->table_name WHERE id=?"; 
           $query = $db->getConnection();
           $protectedQuery = $query->prepare($this->sql);
           $protectedQuery->execute(array($id));
           echo "<script type='text/javascript'>alert('Інформація про товар видалена!');</script>";   
         
        return 1;
        } 

    return 0;
    }
        
    public function saveEditItem($id)
    {
        if ( $this->checkRate == 1) {

            $sku = htmlspecialchars(filter_input(INPUT_POST, 'editSKU'));
            $name = htmlspecialchars(filter_input(INPUT_POST, 'editName'));
            $price = filter_input(INPUT_POST, 'editPrice');
            $qty = filter_input(INPUT_POST, 'editQTY');
            $dsc = htmlspecialchars(filter_input(INPUT_POST, 'editDsc'));
            $db = new DB();
            $this->sql = "UPDATE $this->table_name SET sku = ?, name = ?, price = ?, qty = ?, description = ? WHERE id=?;";
            $query = $db->getConnection();
            $protectedQuery = $query->prepare($this->sql);
            $protectedQuery->execute(array($sku, $name, $price, $qty, $dsc, $id));
            echo "<script type='text/javascript'>alert('Інформацію про даний товар успішно змінено !');</script>"; 
       
       return 1;
       } 
      
    return 0; 
    }
    
    public function sortProducts($params)
    {         
       if (@$_COOKIE['sort'] !== null && filter_input(INPUT_POST, 'sort') === null) {
                $params[0] = $_COOKIE['sort'];
       }
            
       if (@$_COOKIE['prcFrom'] !== null && @$_COOKIE['prcTo'] !== null 
               && filter_input(INPUT_POST, 'prcFrom') === null && filter_input(INPUT_POST, 'prcTo') === null) {
                $params[1] = @$_COOKIE['prcFrom'];
                $params[2] = @$_COOKIE['prcTo'];
       }
            
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
           echo "<script type='text/javascript'>window.alert('Максимальну ціну не задано або задано не коректно (повторіть спробу). "
           . "Буде застосовано сортування за замовчуванням до всього діапазону товарів!');</script>";
       
       return $this;
       }
       
       if ( $goodMinPrice === 0 && $goodMaxPrice === 1) {
           $this->sql = "SELECT * FROM $this->table_name WHERE price ORDER BY price ASC";
           echo "<script type='text/javascript'>window.alert('Мінімальну ціну не задано або задано не коректно (повторіть спробу). "
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
            $this->sql = "SELECT ? FROM $this->table_name WHERE id=?;";
            $query = $db->getConnection();
            $protectedQuery = $query->prepare($this->sql);
            $protectedQuery->execute(array($columns[$i], $id));
            $valuesTmp[$columns[$i]] = $protectedQuery->fetchAll();
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
            $patternSku = '/^[a-z]{1}[0-9]{1,10}$/i';
           
            $name = trim($name);
            $patternName = '/^[a-z\s]{1,30}$/i';
            
            $price = trim($price);
            $patternPrice = '/\d{1,12}\.{0,1}\d{0,2}$/';
            
            $qty = trim($qty);
            $patternQty = '/^[0-9]{1,12}$/i'; 
            
            $dsc = trim($dsc);
            $patternDsc = '/^[a-z\s]{1,50}$/i';

            if ( empty($sku) ) {
               echo "<script type='text/javascript'>alert('Артикул не може бути порожнім. Повторіть спробу!');</script>"; 
               $_POST['newSKU'] =  null;
               $this->checkRate = 0;
               return;
            } 
            else if ( !preg_match($patternSku, $sku) ) {
                echo "<script type='text/javascript'>alert('Не вірний артикул. Першим символом артикулу має бути будь-яка "
                  . "латинська літера, всі інші-цифри (не менше 1 цифри), і загалом-в назві має бути не більше 10 символів. Повторіть спробу! "
                   . ");</script>"; 
                $_POST['newSKU'] = null;
                $this->checkRate = 0;
                return;
            }    
            else if ( empty($name) ) {
                echo "<script type='text/javascript'>alert('Назва не може бути порожньою. Повторіть спробу !');</script>"; 
                $_POST['newName'] = null;
                $this->checkRate = 0;
                return;
            }            
            else if ( !preg_match($patternName, $name) ) {
                echo "<script type='text/javascript'>alert('Не вірна назва. Всі символи мають бути латинськими літерами "
                    . "(до 30 літер в назві, без цифр, можуть бути пробіли). Повторіть спробу !');</script>"; 
                $_POST['newName'] = null;
                $this->checkRate = 0;
                return;
            }            
            else if ( empty($price) ) {
                echo "<script type='text/javascript'>alert('Ціна не може бути порожньою. Повторіть спробу !');</script>"; 
                $_POST['newPrice'] = null;
                $this->checkRate = 0;
                return;
            } 
            else if ( !preg_match($patternPrice, $price) || !is_numeric($price) ) {
                echo "<script type='text/javascript'>alert('Не вірна ціна. В ціні мають бути присутні тільки цифри "
                    . "(до 14 цифр: максимум 12 цифр до крапки і макисмум 2 цифри після крапки). Повторіть спробу !');</script>"; 
                $_POST['newPrice'] = null;
                $this->checkRate = 0;
                return;
            }                        
            else if ( empty($qty) ) {
                echo "<script type='text/javascript'>alert('Кількість не може бути порожньою. Повторіть спробу !');</script>"; 
                $_POST['newQTY'] = null;
                $this->checkRate = 0;
                return;
            }
            else if ( !preg_match($patternQty, $qty) || !is_numeric($qty) ) {
                echo "<script type='text/javascript'>alert('Не вірна кількість товару. Кількість має складатись тільки з цифр "
                . "(максимум 12 цифр). Повторіть спробу !');</script>"; 
                $_POST['newQTY'] = null;
                $this->checkRate = 0;
                return;
            }
            else if ( empty($dsc) ) {
                echo "<script type='text/javascript'>alert('Опис не може бути порожнім. Повторіть спробу !');</script>"; 
                $_POST['newDsc'] = null;
                $this->checkRate = 0;
                return;
            }
            else if ( !preg_match($patternDsc, $dsc) ) {
                echo "<script type='text/javascript'>alert('Не вірний опис. Опис може містити тільки латинські літери та пробіли (до 50 літер)."
                . " Повторіть спробу !');</script>"; 
                $_POST['newDsc'] = null;
                $this->checkRate = 0;
                return;
            }
        
        $this->checkRate = 1;
        }
    }
    
}