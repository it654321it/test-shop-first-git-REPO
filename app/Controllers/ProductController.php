<?php
namespace Controllers;

use Core\Controller;
use Core\View;
use Core\Helper;
use SimpleXMLElement;
use DOMDocument;

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

        if (Helper::isAdmin(@$_SESSION['admin_role']) == 1) {
            $id = filter_input(INPUT_GET, 'id');
            
            if ($id) {

                $values = $model->getPostValues();
                $this->set('product', $values);
                $this->set('saved', 1); 
                $model->checkPostValues(filter_input(INPUT_POST, 'editSKU'), filter_input(INPUT_POST, 'editName'),
                    filter_input(INPUT_POST, 'editPrice'), filter_input(INPUT_POST, 'editQTY'), filter_input(INPUT_POST, 'editDsc'));
                
                $model->saveEditItem($id);
                 
            }
            
        $this->set('product', $model->getItem($this->getId())); 
        } 
        else { 
            Controller::redirect('/product/edit2'); 
        }
        
    $this->renderLayout();
    }

    public function addAction() 
    {
        $this->set('title', "Додавання товару");
        $model = $this->getModel('Product');
        
        if (Helper::isAdmin(@$_SESSION['admin_role']) == 1) {
            $model->checkPostValues(filter_input(INPUT_POST, 'newSKU'), filter_input(INPUT_POST, 'newName'),
                    filter_input(INPUT_POST, 'newPrice'), filter_input(INPUT_POST, 'newQTY'), filter_input(INPUT_POST, 'newDsc'));

            if ( $model->addItem() == 1 ) {
                Controller::redirect('/product/edit');
            }
        }
        else { 
            Controller::redirect('/product/add2'); 
        }
        
     $this->renderLayout(); 
     }

    public function deleteAction() 
    {
        $this->set('title', "Видалення товару");
        $model = $this->getModel('Product');
        
        if (Helper::isAdmin($_SESSION['admin_role']) == 1) {
            $id = filter_input(INPUT_GET, 'id');

             if ($id) {
                  $values = $model->getPostValues();
                  $this->set('product', $values);            
             }

            if ( $model->deleteItem($id) == 1 ) {
                    Controller::redirect('/product/list');  
            }
        } 
        else { 
            Controller::redirect('/product/delete2');
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
    
    public function xmlAction()
    {       
            if (Helper::isAdmin($_SESSION['admin_role']) == 1) {

               $products = $this->getModel('Product')
                                           ->initCollection()
                                           ->getCollection()->select();

               $this->set('products', $products);          
               $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><products/>');

                foreach ($products as $product) {
                    $xmlProduct = $xml->addChild('product');
                    $xmlProduct->addChild('id', $product['id']);
                    $xmlProduct->addChild('sku', $product['sku']);
                    $xmlProduct->addChild('name', $product['name']);
                    $xmlProduct->addChild('price', $product['price']);
                    $xmlProduct->addChild('qty', $product['qty']);
                    $xmlProduct->addChild('description', $product['description']);
                }

                $dom = new DOMDocument("1.0");
                $dom->preserveWhiteSpace = false;
                $dom->formatOutput = true;
                $dom->loadXML($xml->asXML());
                $filename = './app/views/product/products.xml';                
                $file = fopen($filename,'w');           
                fwrite($file, $dom->saveXML());
                fclose($file);   
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($filename).'"');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($filename));
                readfile($filename);
                exit;
            } 
            else { 
                Controller::redirect('/product/xml2');
            } 
  
    $this->renderLayout();
    }
    
}