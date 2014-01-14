<?php

/**
 * Userinfo
 * 
 * @author
 * @version 
 */
require_once 'Zend/Controller/Action.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/UserService.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/MsgService.php';
class UserinfoController extends Zend_Controller_Action {
	/**
	 * The default action - show the home page
	 */
	public function indexAction() {
		// TODO Auto-generated Userinfo::indexAction() default action
	}
	
	public function infoAction(){
		session_start();
		$data = array();
		$uid  = $_SESSION['uid'];
		if ($_POST['email']) {
			$data['email']=$_POST['email'];
		}
		if ($_POST['institute']) {
			$data['institute']=$_POST['institute'];
		}
		if ($_POST['usrcomment']) {
			$data['usrcomment']=$_POST['usrcomment'];
		}
		if($_FILES['img']){
			$uptypes = array (
					'image/jpg',
					'image/png',
					'image/jpeg',
					'image/pjpeg',
					'image/gif',
					'image/bmp',
					'image/x-png'
			);
			$max_file_size = 20000000;
			$destination_folder = '../UserImage/'.$_SESSION['uid'].'/';
			$upfile = $_FILES['img'];
			$name = $upfile['name'];             //文件名
			$type = $upfile['type'];             //文件类型
			$size = $upfile['size'];             //文件大小
			$tmp_name = $upfile['tmp_name'];     //临时文件
			$error = $upfile['error'];         //出错原因
			if ($max_file_size < $size) {        //判断文件的大小
				echo '上传文件太大';
				exit ();
			}
				
			if (!in_array($type, $uptypes)) {        //判断文件的类型
				echo '上传文件类型不符' . $type;
				exit ();
			}
				
			if (!file_exists($destination_folder)) {
				mkdir($destination_folder);
			}
			if (file_exists($destination_folder . $_FILES["img"]["name"])) {
				if (!move_uploaded_file($_FILES["img"]["tmp_name"], $destination_folder.$_FILES["img"]["name"])) {
					echo "移动文件出错";
					exit ();
				}
				$url = "localhost/SchNest/application"."/UserImage/".$_SESSION['uid'].'/' . $_FILES["img"]["name"];
				$data['usrportrait']=$url;
			} else {
				if (!move_uploaded_file($_FILES["img"]["tmp_name"], $destination_folder . $_FILES["img"]["name"])) {
					echo "移动文件出错";
					exit ();
				}
				$url = "localhost/SchNest/application"."/UserImage/".$_SESSION['uid'].'/' . $_FILES["img"]["name"];
				$data['usrportrait']=$url;
			}
		}
		if (UserService::updateData($data, $uid)) {
			echo "success";
		}else {
			echo "false";
		}
	}
	public function listOldMsgAction(){
		$uid =session_start(); 
		$uid =$_SESSION['uid'];
		$count =$_POST['count'];
		if (!$count) {
			$count=0;
		}
		$msg_arr= MsgService::getMsgByUid($uid,$count);
		if($msg_arr) {
			echo json_encode((object)$msg_arr,JSON_UNESCAPED_UNICODE);
		}else echo "fail";
	}
}