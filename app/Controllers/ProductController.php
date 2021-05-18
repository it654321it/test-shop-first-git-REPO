<?php
namespace Controllers;

use Core\Controller;
use Core\View;

class ProductController extends Controller
{
    public function indexAction()
    {
        $this->forward('product/list');
    }

    public function listAction()
    {
        $this->set('title', "Товари");
        $products = $this->getModel('Product')
            ->initCollection()
            ->sort($this->getSortParams())
            ->getCollection()
            ->select();
        $this->set('products', $products);
        $this->renderLayout();
    }

   public function viewAction() 
   {
        $this->set('title', "Карточка товару"); 
        $products = $this->getModel('Product')
            ->initCollection()
            ->filter()
            ->getCollectionAll()
            ->selectFirst(); 
        $this->set('products', $products);
        $this->renderLayout();
    }

    public function editAction()
    {
        $model = $this->getModel('Product');
        $this->set('saved', 0);
        $this->set("title", "Редагування товару"); 
        $id = filter_input(INPUT_GET, 'id');

        if ($id) {
            $values = $model->getPostValues();
            $this->set('product', $values);
            $this->set('saved', 1); 
            $model->saveEditItem($id, $values); 
        }
        $this->set('product', $model->getItem($this->getId())); 
        $this->renderLayout();
    }

    public function addAction() 
    {
        $this->set('title', "Додавання товару");
        $model = $this->getModel('Product');
        $model->addItem(); 
        $this->renderLayout(); 
     }

    public function deleteAction() 
    {
        $this->set('title', "Видалення товару");
        $model = $this->getModel('Product');
        $id = filter_input(INPUT_GET, 'id');

         if ($id) {
              $values = $model->getPostValues();
              $this->set('product', $values);            
         }
         
        $model->deleteItem($id);
        $this->renderLayout();
    }
   
    public function getSortParams()
    {
        $params = filter_input(INPUT_POST, 'sort');
       
    return $params;
    } 

    public function getId()
    {
        if (isset($_GET['id'])) {
            return $_GET['id'];
        } 
        else {
            return NULL;
        }

    return filter_input(INPUT_GET, 'id');
    }  
    
}