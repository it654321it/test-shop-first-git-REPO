<?php
namespace Core;

use Core\DB;
//use PDO;

class Model implements DbModelInterface
{

    protected $table_name;

    protected $id_column;

    protected $columns = [];

    protected $collection;

    protected $sql;

    protected $params = [];

    public function initCollection()
    {
        $columns = implode(',',$this->getColumns());
        $this->sql = "select $columns from " . $this->table_name ;
        return $this;
    }

    public function getColumns()
    {
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);    
        foreach($results as $result) {
            array_push($this->columns, $result['Field']);
        }
        return $this->columns;
    }

    public function sort($params)
    {
       if ( $params ) {
           
            $db = new DB(); 
          
            if ($params  === 'pDESC') {
                 $this->sql = "SELECT * FROM $this->table_name ORDER BY price DESC";
            } 
            else if ($params  === 'pASC') {
                  $this->sql = "SELECT * FROM $this->table_name ORDER BY price ASC";
            } 
            else if ($params  === 'qASC') {
                  $this->sql = "SELECT * FROM $this->table_name ORDER BY qty ASC";
            } 
            else if ($params  === 'qDESC') {
                   $this->sql = "SELECT * FROM $this->table_name ORDER BY qty DESC";
            } 
      } 
      else {
           $this->sql = "SELECT * FROM $this->table_name ORDER BY name";
      } 
  
    return $this;
    }

    public function filter()
    {
       $params = $this->getId();
       $this->params = $params; 
       
       return $this;
    }

    public function getCollection()
    {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);   
        return $this;
    }
    
    public function getCollectionAll()
    {
        $db = new DB();
        $this->sql = "SELECT * FROM  $this->table_name WHERE $this->id_column=$this->params;"; 
        $this->collection = $db->query($this->sql); 

    return $this;
    }

    public function select()
    {
        return $this->collection;
    }

    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    public function getItem($id)
    {
        $sql = "SELECT * FROM $this->table_name WHERE $this->id_column=?;";
        $db = new DB();
        $params = array($id);
    
    return $db->query($sql, $params)[0];
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

    public function getTableName(): string
    {
        return $this->table_name;
    }

    public function getPrimaryKeyName(): string
    {
        return $this->id_column;
    }

    public function getId()
    {
        return 1;
    }
    
    public function addItem()
    {
       if ( filter_input(INPUT_POST, 'ad') !== null) {
           
           $db = new DB();
           $this->sql = "SELECT MAX(id) AS MaxProductId FROM $this->table_name;";
           $lastID = $db->query($this->sql);
           $newID = $lastID[0]['MaxProductId'] ;
           $newID++;
           $db = new DB();
           $price = str_replace ( ',' , '.' , $_POST['newPrice'] );
           $postValues = "'".(string)($_POST['newSKU'])."','".(string)($_POST['newName'])."',"
                   .$price.",".(string)($_POST['newQTY']).",'".(string)($_POST['newDsc'])."'"; 

           $this->sql = "INSERT INTO $this->table_name VALUES ($newID, $postValues);";
           $db->query($this->sql);          
           echo "<script type='text/javascript'>alert('Інформація про новий товар додана!');</script>";   
      } 
   }
   
    public function deleteItem($id)
    {
        if( filter_input(INPUT_POST, 'del') !== null ) {    
            
           $db = new DB();
           $this->sql = "DELETE FROM $this->table_name WHERE id=$id";
           $db->query($this->sql);       
           echo "<script type='text/javascript'>alert('Інформація про товар видалена!');</script>";   
        } 
    }
    
    public function saveEditItem($id, $values)
    {
        if ( filter_input(INPUT_POST, 'edit') !== null ) {

            $sku = filter_input(INPUT_POST, 'editSKU');
            $name = filter_input(INPUT_POST, 'editName');
            $price = filter_input(INPUT_POST, 'editPrice');
            $qty = filter_input(INPUT_POST, 'editQTY');
            $dsc = filter_input(INPUT_POST, 'editDsc');
            $db = new DB();
            $this->sql = "UPDATE $this->table_name SET sku = '$sku', name = '$name', price = $price, qty = $qty, description = '$dsc' WHERE id=$id;";
        
            echo "<script type='text/javascript'>alert('Інформацію про даний товар успішно змінено !');</script>";         
       } 
  }
  
}