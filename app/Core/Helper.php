<?php
namespace Core;

class Helper 
{
    public static function getCustomer($id) // не використовується
   {
           $this->set('title', "Карточка користувача"); 
           $сustomer = $this->getModel('Customer')  
           ->filter(array('customer_id'=>$id))     
           ->getCollectionVIEW()
           ->selectFirst();
           $this->set('customer', $сustomer);
          
   $this->renderLayout();         
   }
   
}