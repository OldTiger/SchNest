<?php
use application\models\Place;
require_once 'DB.php';
class PlaService {
	static public function crePlace($Place){
		try{
			$db = new DB();
			$query_sql = "INSERT INTO schnest (`pname`, `uid`,`pcomment`,`pcategory`,`ptime`) VALUES ('$Place->name','$Place->owner','$Place->comment','$Place->category', '$Place->cre_time')";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
	static public function delPlcaceByPid($pid,$uid){
		try{
			$db = new DB();
			$query_sql = "delete from schnest where pid = '$pid' and uid ='$uid';";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;
			}
			else return false;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
	static public function getPlaceInfo($name){
		try{
			$db = new DB();
			$query_sql = "sel from user where pname = '$name';";
			$result = $db->query($query_sql);
			
			if($result == 1){
				$row = mysql_fetch_object($result);
				$place = array();
				$place['name'] = $row->pname;
				$place['comment'] = $row->pcomment;
				$place['category'] = $row->pcategory;
				$place['time'] = $row->time;
				$place['uid'] = $row->uid;
				$place['pid'] = $row->pid;
				return place;
			}
			else return flase;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
	 //get 10 place information
	static public function getListByTime($count){
		$ordernumber = 0;
		$planumber = 0;
		$place = array();
		$pla_arr = array();
		$db = new DB();
		$query_sql="select * from schnest order by ptime desc";
		$result = $db->query($query_sql);
		while($row = mysql_fetch_object($result)){
			if($ordernumber>=$count*10 && $placenumber<10)
			{
				$place['name'] = $row->pname;
				$place['comment'] = $row->pcomment;
				$place['category'] = $row->pcategory;
				$place['time'] = $row->time;
				$place['uid'] = $row->uid;
				$place['pid'] = $row->pid;
				$pla_arr[] = $place;
				$planumber++;
			}
		}
		return $pla_arr;
	}
	static public function updatePla($data,$pid){
		$db  = new DB();
		if (count($data)==0||!$pid) {
			return true;
		}else {
			$update_sql_part1 = "update schnest set ";
			$update_sql_part2 = "";
			$update_sql_part3 = "where pid ='$pid';";
			foreach ($data as $key=>$val){
				$update_sql_part2=$update_sql_part2.$key.'='."'$val',";
			}
			$update_sql_part2=substr_replace($update_sql_part2," ",strlen($update_sql_part2)-1,1);
			$update_sql=$update_sql_part1.$update_sql_part2.$update_sql_part3;
			$result = $db->query($update_sql);
			if ($result==1) {
				return true;
			}else return false;
		}
	}
	//get placeList by category
	static public function getListByCategory($category,$count){
		$ordernumber = 0;
		$planumber = 0;
		$place = array();
		$pla_arr = array();
		$db = new DB();
		$query_sql="select * from schnest where pcategory='$category' order by ptime desc";
		$result = $db->query($query_sql);
		while($row = mysql_fetch_object($result)){
			if($ordernumber>=$count*10 && $planumber<10)
			{
				$place['name'] = $row->pname;
				$place['comment'] = $row->pcomment;
				$place['category'] = $row->pcategory;
				$place['time'] = $row->ptime;
				$place['uid'] = $row->uid;
				$place['pid'] = $row->pid;
				$pla_arr[] = $place;
				$planumber++;
			}
		}
		return $pla_arr;
	}

}
?>