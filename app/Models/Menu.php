<?php
namespace Models;

use Core\Model;

/**
 * Class Menu
 */
class Menu extends Model
{
    /**
     * Menu constructor.
     */
    function __construct()
    {
        $this->table_name = "menu";
    }
}
