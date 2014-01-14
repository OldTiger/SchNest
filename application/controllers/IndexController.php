<?php
use application;
require_once 'Zend/Controller/Action.php';
class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/index.html", 301);
    }


}
?>
