<?php
namespace Core;

use Core\DB;

class Model implements DbModelInterface
{    
    protected $table_name;

    protected $id_column;

    protected $columns = [];

    protected $collection;

    protected $sql;

    protected $params = [];
    
    public $checkRate;

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
            if ($params  === 'pDESC') {
                 $this->sql = "SELECT * FROM $this->table_name ORDER BY price DESC";
            } 
            else if ($params === 'pASC') {
                  $this->sql = "SELECT * FROM $this->table_name ORDER BY price ASC";
            } 
            else if ($params  === 'qASC') {
                  $this->sql = "SELECT * FROM $this->table_name ORDER BY qty ASC";
            } 
            else if ($params  === 'qDESC') {
                   $this->sql = "SELECT * FROM $this->table_name ORDER BY qty DESC";
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

    public function select()
    {
        return $this->collection;
    }

    public function selectFirst()
    {
        return isset($this->collection[0]) ? $this->collection[0] : null;
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
        if (isset($_GET['customer_id'])) {
         
        return $_GET['customer_id'];
        } 
        else {
            return NULL;
        }
        
    return filter_input(INPUT_GET, 'customer_id');
    }
  
}