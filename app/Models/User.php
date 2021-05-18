<?php
namespace Models;

use Core\Model;

/**
 * Class User
 */
class User extends Model
{

    /**
     * @return string
     */
    public function getName()
    {
        return 'customer';
    }

}