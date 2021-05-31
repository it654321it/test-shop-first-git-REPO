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
        setcookie('addActionResult', 0, 0);
        $this->set('title', "Товари");
        $products = $this->getModel('Product')
            ->initCollection()
            ->sortProducts($this->getSortParams())
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
            $model->checkPostValues(filter_input(INPUT_POST, 'editSKU'), filter_input(INPUT_POST, 'editName'),
                filter_input(INPUT_POST, 'editPrice'), filter_input(INPUT_POST, 'editQTY'), filter_input(INPUT_POST, 'editDsc'));
            $model->saveEditItem($id, $values); 
        }

        $this->set('product', $model->getItem($this->getId())); 
        $this->renderLayout();
    }

    public function addAction() 
    {
        $this->set('title', "Додавання товару");
        $model = $this->getModel('Product');
        $model->checkPostValues(filter_input(INPUT_POST, 'newSKU'), filter_input(INPUT_POST, 'newName'),
                filter_input(INPUT_POST, 'newPrice'), filter_input(INPUT_POST, 'newQTY'), filter_input(INPUT_POST, 'newDsc'));
        
        if ( $model->addItem() === 1 ) {
            Controller::redirect('/product/edit');
        }
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

        if ( $model->deleteItem($id) === 1 ) {
                Controller::redirect('/product/list');  
        }
          
    $this->renderLayout();
    }
   
    public function getSortParams()
    {
        $selected[0] = filter_input(INPUT_POST, 'sort');
        $selected[1] = filter_input(INPUT_POST, 'prcFrom');
        $selected[2] = filter_input(INPUT_POST, 'prcTo');

    return $selected;
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