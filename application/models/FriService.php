<?php

namespace models;

class FriService {
	static public function makeFre($uid,$friendid){
		try{
			$db = new DB();
			$query_sql = "INSERT INTO friend (`uid`, `friendid`) VALUES ('$uid', '$friendid')";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
	static public function delFre($uid,$friendid){
		try {
			$host = "localhost";
			$user = "root";
			$pass = "999";
			$db = "schnest";
			$connection = mysql_connect($host,$user,$pass);
			mysql_select_db($db) or die ("unable to connect2");
			$query_sql = "delete from friend where uid = '$uid'and friendid = '$friendid'";
				
			$result = mysql_query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		} catch (Exception $e) {
			echo $e->__toString();
		}
	}
}

?>