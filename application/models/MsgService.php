<?php
	use application\models\Message;

    require_once 'DB.php';
	require_once 'Place.php';
	require_once 'Message.php';
	class MsgService {

		static public function getMsgByPid($pid,$count) {	//返回数组类型
			$ordernumber = 0;//判断取出消息的起始数目
			$msgnumber = 0;//数组包含消息的数目
			$msg = array();
			$msg_arr = array();
			$db = new DB();
			$query_sql = "select * from message where pid = '$pid' order by wtime desc";
			$result = $db->query($query_sql);
			while($row = mysql_fetch_object($result)){
				if($ordernumber>=$count*10 && $msgnumber<10)
				{

					$msg['time'] = $row->wtime;
					$msg['content'] = $row->wcontent;
					$msg['url'] = $row->url;
					$msg['id'] = $row->wid ;
					$msg['support'] = $row->support;
					$msg['disdain'] = $row->disdain;
					$msg['uid'] = $row->uid;
					$msg['pid'] = $row->pid;
					
					$msg_arr[] = $msg;
					
					$msgnumber++;
				}
				$ordernumber++;				
			}
			
			if($msgnumber == 9){
				$msg_arr['count'] = 10;
			}
			else $msg_arr['count'] = $msgnumber;
			
			return $msg_arr;
		}
		
		///////////////////////////////////
		//get msg by cookie//////////////////
		/////////////////////////////////////
		
		static public function getMsgByCookie($cookie){
			$ordernumber = 0;//判断取出消息的起始数目
			$msgnumber = 0;//数组包含消息的数目
			$msg = array();
			$msg_arr = array();
			$db = new DB();
			$query_sql = "select * from message where usrcookie = '$cookie' order by wtime desc";
			$result = $db->query($query_sql);
			while($row = mysql_fetch_object($result)){
				if($ordernumber>=$count*10 && $msgnumber<10)
				{
						
					$msg['time'] = $row->wtime;
					$msg['content'] = $row->wcontent;
					$msg['url'] = $row->url;
					$msg['id'] = $row->wid ;
					$msg['support'] = $row->support;
					$msg['disdain'] = $row->disdain;
					$msg['uid'] = $row->uid;
					$msg['pid'] = $row->pid;
						
					$msg_arr[] = $msg;
						
					$msgnumber++;
				}
				$ordernumber++;
			}
				
			if($msgnumber == 9){
				$msg_arr['count'] = 10;
			}
			else $msg_arr['count'] = $msgnumber;
				
			return $msg_arr;
		}

		
		///////////////////////////////////
		//get msg by uid//////////////////
		/////////////////////////////////
		
		static public function getMsgByUid($uid,$count) {
			$ordernumber = 0;//判断取出消息的起始数目
			$msgnumber = 0;//数组包含消息的数目
			$msg = array();
			$msg_arr = array();
			$db = new DB();
			$query_sql = "select * from message where uid = '$uid' order by wtime desc";
			$result = $db->query($query_sql);
			while($row = mysql_fetch_object($result)){
				if($ordernumber>=$count*10 && $msgnumber<10)
				{
					
					$msg['time'] = $row->wtime;
					$msg['content'] = $row->wcontent;
					$msg['url'] = $row->url;
					$msg['id'] = $row->wid ;
					$msg['support'] = $row->support;
					$msg['disdain'] = $row->disdain;
					$msg['uid'] = $row->uid;
					$msg['pid'] = $row->pid;
					
					$msg_arr[] = $msg;
					
					$msgnumber++;
				}
				$ordernumber++;				
			}
			
 			if($msgnumber == 9){
 				$msg_arr['count'] = 10;
 			}
 			else $msg_arr['count'] = $msgnumber;
			
			return $msg_arr;
		}
		
		static public function republish($message){
		
		}
		
		static public function publishMsg($message){
			try{
				$db = new DB();
				if ($message->url) {
					$query_sql = "INSERT INTO message(`pid`,`wtime`,`wcontent`,`uid`,`url`)
					VALUES('$message->pid','$message->time','$message->content','$message->uid','$message->url') ";
				}else {
					$query_sql = "INSERT INTO message(`pid`,`wtime`,`wcontent`,`uid`)
					VALUES('$message->pid','$message->time','$message->content','$message->uid') ";
				}
					
				$result = $db->query($query_sql);
				if($result == 1){
					return true;
				}
				else return false;
			}catch (Exception $e){
				echo $e->toString();
			}
		}
		
		static public function supportMsg($wid){
			try {
				$db  = new DB();
				$query_sql = "select support from message where wid='$wid'";
				$result = $db->query($query_sql);
				$row = mysql_fetch_row($result);
				$supportnum = $row[0] + 1;
				$query_sql_insert = "update message set support = '$supportnum'";
				$db->query($query_sql_insert);
			} catch (Exception $e) {
				echo $e->__toString();
			}
		}
		static public function delMsg($wid){
			try {
				$db = new DB();
				$delete_sql = "delete from message where wid = '$wid';";
				$result = $db->query($delete_sql);
				if($result == 1){
					return true;
				}
				else return false;
			} catch (Exception $e) {
				echo $e->__toString();
			}
		}
		static public function disdainMsg($wid){
			try {
				$db  = new DB();
				$query_sql = "select disdain from message where wid='$wid'";
				$result = $db->query($query_sql);
				$row = mysql_fetch_row($result);
				$disdainnum = $row[0] + 1;
				$query_sql_insert = "update message set disdain = '$disdainnum'";
				$db->query($query_sql_insert);
			} catch (Exception $e) {
				echo $e->__toString();
			}
		
		}
	}
?>