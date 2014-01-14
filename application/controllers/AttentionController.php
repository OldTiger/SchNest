<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/AttService.php';

require_once 'Zend/Controller/Action.php';

class AttentionController extends Zend_Controller_Action
{

	public function init()
	{
		/* Initialize action controller here */
	}

	public function attentionAction()
	{
		$pid=$_POST['pid'];
		session_start();
		$uid=$_SESSION['uid'];
		if (AttService::addAtt($pid, $uid)) {
			echo "success";
		}else echo "fail";
	}
	public  function deleteAction() {
		$pid=$_POST['pid'];
		session_start();
		$uid=$_SESSION['uid'];
		if (AttService::delAttn($pid, $uid)) {
			echo "success";
		}else echo "fail";
	}

}
?>
