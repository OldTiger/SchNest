<?php

use application\models\Comment;
require_once 'Zend/Controller/Action.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/MsgService.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/Comment.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/SchNest/application/models/CmtService.php';

class PublishController extends Zend_Controller_Action{
	public  function publishAction(){
		session_start();
		$message =  new Message();
		$message->time = date('Y-m-d H:i:s');
		$message->content = $_POST['content'];
		$message->uid = $_SESSION['uid'];
		$message->pid = $_POST['pid'];
		//if we have image ,save it and get url
		if ($_FILES['img']) {
			$uptypes = array (
					'image/jpg',
					'image/png',
					'image/jpeg',
					'image/pjpeg',
					'image/gif',
					'image/bmp',
					'image/x-png'
			);
			
			$max_file_size = 20000000;                 //上传文件大小限制，单位BYTE
			$destination_folder = '../UserImage/';     //上传文件路径
			$upfile = $_FILES['img'];
			//print_r($_FILES['upfile']);
			
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
			
			if (file_exists("../UserImage/" . $_FILES["img"]["name"])) {
				if (!move_uploaded_file($_FILES["img"]["tmp_name"], "../UserImage/".$_FILES["img"]["name"])) {
					echo "移动文件出错";
					exit ();
				}
				$message->url = "localhost/SchNest/application"."/UserImage/" . $_FILES["img"]["name"];
			} else {
				if (!move_uploaded_file($_FILES["img"]["tmp_name"], "../UserImage/" . $_FILES["img"]["name"])) {
					echo "移动文件出错";
					exit ();
				}
				$message->url = "localhost/SchNest/application"."/UserImage/" . $_FILES["img"]["name"];
			}	
		}
		if(MsgService::publishMsg($message)){
			echo "success!";
		}else{
			echo "failure!";
		}
	}
	//reconstruct the message in android device 利用wid对消息进行重发
	public function republishAction() {
		$message = new Message();
		$message->time = date('Y-m-d H:i:s');
		$message->content = $_POST['content'];
		$message->uid = $_POST['uid'];
		$message->pid = $_POST['pid'];
		if(MsgService::publishMsg($message)){
			echo "success!";
		}else{
			echo "failure!";
		}
	}
	public  function commentAction(){
		session_start();
		$uid = $_SESSION['uid'];
		$comment = new Comment();
		
		$comment->message_id = $_POST['wid'];
		$comment->uid = $uid;
		$comment->content = $_POST['content'];
		$comment->time = date('Y-m-d H:i:s');
		if (CmtService::comment($comment)) {
			echo "success";
		}else{
			echo "fail";
		}
	}

}
?>