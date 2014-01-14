<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/UserService.php';
require_once 'Zend/Controller/Action.php';
class RegisterController extends Zend_Controller_Action{
	public function init()
	{
		/* Initialize action controller here */
	}
	
	public function indexAction()
	{
		 
	}
	public function registerAction(){
		$email = $_POST['email'];
		$psw = $_POST['password'];
		$userac = $_POST['userac'];
		if(UserService::register($userac, $psw,$email)){
			echo "register success!";
		}else{
			echo "register failure!";
		}
	}
}

?>