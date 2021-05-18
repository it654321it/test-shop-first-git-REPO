<?php
namespace Controllers;

use Core\Controller;
use Core\View;

/**
 * Class ProductController
 */
class CustomerController extends Controller
{
    public function indexAction()
    {
        $this->forward('customer/list');
    }

    /**
     *
     */
    public function listAction()
    {
        $this->set('title', "Клієнти");

        $сustomer = $this->getModel('Customer')
            ->initCollection()
            ->sort($this->getSortParams())
            ->getCollection()
            ->select();
        $this->set('customer', $сustomer);

        $this->renderLayout();
    }



    public function getSortParams()
    {
        $params = [];
        $sortfirst = filter_input(INPUT_POST, 'sortfirst');
        if ($sortfirst === "price_DESC") {
            $params['price'] = 'DESC';
        } else {
            $params['price'] = 'ASC';
        }
        $sortsecond = filter_input(INPUT_POST, 'sortsecond');
        if ($sortsecond === "qty_DESC") {
            $params['qty'] = 'DESC';
        } else {
            $params['qty'] = 'ASC';
        }
        
        return $params;

    }
    
}