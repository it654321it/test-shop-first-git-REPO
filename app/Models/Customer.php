<?php
namespace Models;

use Core\Model;

class Customer extends Model
{

    function __construct()
    {
        $this->table_name="customer"; 
        $this->id_column = "customer_id";
    }
          
}