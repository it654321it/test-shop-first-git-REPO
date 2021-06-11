<?php
namespace Core;

class Helper 
{
    public static function isAdmin($adminRole)
    {       
        if ($adminRole == 1) {
               return 1;
        } 
        else {
               return 0;
        }

    }
   
}