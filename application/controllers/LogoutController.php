<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/UserService.php';
require_once 'Zend/Controller/Action.php';
class LogoutController extends Zend_Controller_Action{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function indexAction()
	{
		 
	}
	public function logoutAction(){
		/*clear cookie*/
		setcookie('feedType',"",time()-1,"/");
		setcookie('feedValue',"",time()-1,"/");
		$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/index.html", 301);
	}
}

?>