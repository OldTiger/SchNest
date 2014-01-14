<?php


use application\models\Comment;

require_once 'DB.php';
require_once 'Place.php';
require_once 'Comment.php';

class CmtService {
	//return array
	static public function getCmtByUid($uid,$count) {	
		$ordernumber = 0;//判断取出消息的起始数目
		$cmtnumber = 0;//数组包含消息的数目
		$cmt_arr = array();
		$cmt = array();
		$db = new DB();
		$query_sql = "select * from comment where uid = '$uid' order by ctime desc";
		$result = $db->query($query_sql);
		while($row = mysql_fetch_object($result)){
			if($ordernumber>=$count*5 && $cmtnumber<5)
			{
				$cmt['cid'] = $row->cid;
				$cmt['message_id']= $row->wid;
				$cmt['uid']= $row->uid;
				$cmt['time'] = $row->ctime;
				$cmt['content'] = $row->content;
				$cmt_arr[] = $cmt;
					
				$cmtnumber++;
			}
			$ordernumber++;
		}
			
		if($cmtnumber == 9){
			$cmt_arr['count'] = 10;
		}
		else $cmt_arr['count'] = $cmtnumber;
			
		return $cmt_arr;
	} 
	//return array
	static public function getCmtByWid($wid,$count) {
		$ordernumber = 0;//判断取出消息的起始数目
		$cmtnumber = 0;//数组包含消息的数目
		$cmt_arr = array();
		$cmt = array();
		$db = new DB();
		$query_sql = "select * from comment where wid = '$wid' order by ctime desc";
		$result = $db->query($query_sql);
		while($row = mysql_fetch_object($result)){
			if($ordernumber>=$count*5 && $cmtnumber<5)
			{
				$cmt['cid'] = $row->cid;
				$cmt['message_id']= $row->wid;
				$cmt['uid']= $row->uid;
				$cmt['time'] = $row->ctime;
				$cmt['content'] = $row->content;
				$cmt_arr[] = $cmt;
					
				$cmt[] = $Cmtresult;
					
				$cmtnumber++;
			}
			$ordernumber++;
		}
			
		if($cmtnumber == 9){
			$cmt_arr['count'] = 10;
		}
		else $cmt_arr['count'] = $cmtnumber;
			
		return $cmt_arr;
	}
	static public function comment($comment){
		try{
			$db = new DB();
			$query_sql = "INSERT INTO comment (`wid`, `uid`,`ctime`,`ccontent`) VALUES ('$comment->message_id', '$comment->uid','$comment->time','$comment->content')";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
	static public function delcomment($cid){
		try{
			$db = new DB();
			$query_sql = "delete from comment where cid = $cid;";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
}
?>