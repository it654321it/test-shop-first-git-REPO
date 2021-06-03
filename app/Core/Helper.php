<?php
namespace Core;

class Helper 
{
    public static function getCustomer($id) 
   {
    //echo 'запускаємо метод getCustomer() в Helper.php','<br>';    
    //echo '$_SESSION[id]='.$_SESSION['id'].'<br>';
    //echo '$_SESSION[...]='.'<br>';
    //var_dump($_SESSION[]); echo '<br>';
    
//        if (!empty($_SESSION['id'])) {//якщо значення суперглобальної змінної $_SESSION['id'] не дорівнює нулю, то - виконати наступні дії:
        
            // не оригінал
            // метод set - з Controller.php - отримання назви титулки веб-сторінки
           $this->set('title', "Карточка користувача"); 
            
        // запускаємо метод getModel в Controller.php
       // getModel($name) - метод для отримання назви моделі в залежності від того який пункт менб вибра користувач
           
           // оригінал
           //return self::getModel('Customer')->initCollection() // запускаємо метод initCollection() в Model.php - отримання назв стовпчиків з відповідної таблиці + запит в таблицю
           
             // не оригінал
            // запускаємо метод getModel() в Controller.php
            $сustomer = $this->getModel('Customer')  
            // запускаємо метод initCollection() в Model.php - отримання назв стовпчиків з відповідної таблиці + запит в таблицю
             //->initCollection() 
             
             // оригінал
             // метод filter в Model.php
            //->filter(array('customer_id'=>$_SESSION['id'])) // filter() - метод фільтрування даних в таблиці за параметром customer_id
              ->filter(array('customer_id'=>$id))     
             // оригінал
            // метод filter в Model.php
            //->getCollection() // getCollection() - отримати з таблиці дані про конкретного користувача з customer_id = id
                    
            // не оригінал
             ->getCollectionVIEW() // getCollection() - отримати з таблиці дані про конкретного користувача з customer_id = id
               
             // метод filter в Model.php
            ->selectFirst(); // selectFirst() -  отримує перший масив змінної-масиву $collection[0]  

          // не оригінал
          $this->set('customer', $сustomer);
          // не оригінал
          $this->renderLayout();
             
//        } 
//        else {
//            return null; // інакше - вернути нуль - нічого не робити
//        }
   }
   
}