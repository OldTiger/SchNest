<?php


require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/PlaService.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/Place.php';
require_once 'Zend/Controller/Action.php';

class PlaceController extends Zend_Controller_Action {
	public function init()
	{
		/* Initialize action controller here */
	}
	public function getlistAction() {
		$pla_arr = array();
		if ($_POST['category']!=NULL) {
			if ($_POST['count']!=NULL&&$_POST['count']>=0) {
				$pla_arr=PlaService::getListByCategory($_POST['category'],$_POST['count']);
			}else {
				$pla_arr=PlaService::getListByCategory($_POST['category'],0);
			}
		}else{
			$pla_arr=PlaService::getListByTime($_POST['count']);
		}
		//header('Content-Type:application/json');
		echo json_encode((object)$pla_arr,JSON_UNESCAPED_UNICODE);
	}
	public function createAction() {
		session_start();		
		$name     = $_POST['place_name'];
		$comment  = $_POST['place_comment'];
		$category = $_POST['place_category'];
		$cre_time = date("Y-m-d H:i:s");
		$uid       = $_SESSION['uid'];
		$place    = new Place($name, $uid, $comment, $category, $cre_time);
		
		if (PlaService::crePlace($place)) {
    		$this->getResponse()->setRedirect("http://localhost/SchNest/application/views/scripts/index/place.html", 301);
		}else{
			echo "create place fail";
		}
	}
	public function updatePlaAction(){
		session_start();
		$uid = $_SESSION['uid'];
		/*need to check uid*/
		$pla_arr = array();
		if ($_POST['pid']) {
			$pid=$_POST['pid'];
		}else return false;
		if ($_POST['name']) {
			$pla_arr['pname']=$_POST['name'];
		}
		if ($_POST['comment']) {
			$pla_arr['pcomment']=$_POST['comment'];
		}
		if($_POST['category']){
			$pla_arr['pcategory']=$_POST['category'];
		}
		
		if (PlaService::updatePla($pla_arr, $pid)) {
			echo "success";
		}else echo "false";
	}
	public function  delPlaAction(){
		session_start();
		$uid = $_SESSION['uid'];
		$pid = $_POST['pid'];
		if(PlaService::delPlcaceByPid($pid, $uid)){
			echo "success";
		}else{
			echo "fail";
		}
	}
}

?>