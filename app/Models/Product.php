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

}