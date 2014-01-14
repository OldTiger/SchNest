<?php

require_once 'DB.php';
class AttService {
	static public function addAtt($pid,$uid){
		try{
			$db = new DB();
			$query_sql = "INSERT INTO attention (`pid`, `uid`) VALUES ('$pid', '$uid')";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		}catch (Exception $e){
			echo "已关注";
		}	
	}
	static public function delAttn($pid,$uid){
		try {
			$db = new DB();
			$delete_sql = "delete from attention where uid = '$uid' and pid = '$pid'";
				
			$result = mysql_query($delete_sql);
			if($result == 1){
				return true;
			}else return false;
		} catch (Exception $e) {
			echo $e->__toString();
		}
	
	}
}

?>