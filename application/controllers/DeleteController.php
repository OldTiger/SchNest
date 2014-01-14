<?php
require_once 'Zend/Controller/Action.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/MsgService.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/CmtService.php';

class DeleteController extends Zend_Controller_Action  {
	public function init()
	{
		/* Initialize action controller here */
	}
	public function deleteMsgAction() {
		$wid = $_POST['wid'];
		session_start();
		$uid = $_SESSION['uid'];
		/*need to check authority*/
		if (MsgService::delMsg($wid)) {
			echo "success";
		}else echo "fail";
	}
	public function deleteCmtAction(){
		$cid = $_POST['cid'];
		session_start();
		$uid = $_SESSION['uid'];
		/*need to check authority*/
		if (CmtService::delcomment($cid)) {
			echo "success";
		}else echo "fail";
	}
}

?>