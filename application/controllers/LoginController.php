<?php
//namespace application\controllers;
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/UserService.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/User.php';
require_once 'Zend/Controller/Action.php';
class LoginController  extends Zend_Controller_Action{
   public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    	
    }
   	public function loginAction(){
   		
		try {
			session_start();
			$userac    = $_POST['userac'];
			$psw	   = $_POST['password'];
			$autoLogin = $_POST['atuologin'];
			$feedType  = $_COOKIE['feedType'];
			$feedValue = $_COOKIE['feedValue'];
			
			if ($feedType!=null && $feedValue!=null) {
				/*deal with cookie*/
				$user=UserService::checkCookie($feedValue, $feedType);
				if($user!=false){
						
						$_SESSION['uid']=$user['uid'];
						$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/home.html", 301);
						return 0;
				}else {
					/*clear cookie*/
					setcookie('feedType',"",time()-1,"/");
					setcookie('feedValue',"",time()-1,"/");
					/*jump to login*/
					if ($_POST['userac']==null&&$_POST['password']==null) {
						$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/index.html", 301);
						return 0;
					}
				}
			}

			if($userac==null||$psw==null){
				$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/home.html", 301);
				return 0;
			}
			if($user=UserService::login($userac, $psw)){
				$_SESSION['uid']=$user['uid'];				
    			$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/home.html", 301);
    			if($autoLogin=="true")
    			{	
    				setcookie('feedType',"week",time()+60*60*24*7,"/");
    				$str= $userac+time();
    				setcookie('feedValue',$str,time()+60*60*24*7,"/");
    				if (UserService::setCookie($userac,$str)) {
    				} else echo"set cookie error";		
    			}else {
    				setcookie('feedType',"once",time()+60*60,"/");
    				$str= $userac+time();
    				setcookie('feedValue',$str,time()+60*60,"/");
    				if (UserService::setCookie($userac,$str)) {
    				} else echo"set cookie error";				
    			}
			}else{
				echo "LoginFailure\n";
			}
		} catch (Exception $e) {
			echo $e->__toString();
		}	
	}

}

?>