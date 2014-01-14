<?php
use application\models\User;
require_once 'DB.php';
require_once 'Place.php';
require_once 'Comment.php';
require_once 'User.php';


class UserService {
	/*return true or false*/
	static public function login($username,$psw){
		try {
			$db  = new DB();
			$query_sql = "select * from user where usrac='$username'";
			$result = $db->query($query_sql);
			while($row = mysql_fetch_object($result)){
				if($row->usrpswd==$psw){
					$user['uid']=$row->uid;
					$user['email']=$row->email;
					$user['userac']=$row->usrac;
					$user['institute']=$row->institute;
					$user['name']=$row->usrname;
					$user['usercomment']=$row->usrcomment;
					$user['portrait']=$row->usrportrait;
					return $user;
				}
				else return false;
			}
		} catch (Exception $e) {
			echo $e->__toString();
		}	
	}
	
	/*return true or false*/
	static public function register($usrac,$psw,$email){
		try{
			$db = new DB();
			$query_sql = "INSERT INTO user (`usrac`, `usrpswd`,`email`) VALUES ('$usrac', '$psw','$email')";
			$result = $db->query($query_sql);
			if($result == 1){
				return true;				
			}
			else return false;
		}catch (Exception $e){
			echo $e->toString();
		}
	}
	/*return true or false*/

	static public function setPortrait($url,$uid){
		if (isset($message->url)){
			$update_sql = "update user set usrportrait= '$url' where uid ='$uid'";
			$result = $db->query($update_sql);
			if($result == 1){
				return true;
			}else return false;
			
		}else {
			return false;
		}
	}
	static public function updateData($data,$uid){
		try {
			$db  = new DB();
			if (count($data)==0||!$uid) {
				return true;
			}else {
				$update_sql_part1 = "update user set ";
				$update_sql_part2 = "";
				$update_sql_part3 = "where uid ='$uid';";
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
		} catch (Exception $e) {
			echo $e->__toString();
		}
	}
	/*set cookie
	 * return true and flase
	 * */
	static public function setCookie($userac,$str){
			try {
					$db  = new DB();
					$update_sql = "update user set usrcookie= '$str' where usrac ='$userac'";
					$result = $db->query($update_sql);
					if ($result==1) {
						return true;
					}else return false;
				}
			catch (Exception $e) {
				echo $e->__toString();
			}	
		}
	/* 
	 * return true and false
	 * 
	 * */
		static public function checkCookie($cookie,$type){
			if ($type==NULL) {
				return false;
			}else {
				try {
					$db  = new DB();
					$query_sql = "select * from user where usrcookie ='$cookie'";
					$result = $db->query($query_sql);
					while($row = mysql_fetch_object($result)){
						if($row!=null){
							$once_time=60*60;
							$week_time=$once_time*24*7;
							$user=array();
							if ($type=="once") {
								if ((time()-($row->usrcookie-$row->usrac))>=$once_time) {
									return false;
								}else {
									$user['uid']=$row->uid;								
		 							$user['email']=$row->email;
		 							$user['userac']=$row->usrac;
									$user['institute']=$row->institute;
									$user['name']=$row->usrname;
									$user['usercomment']=$row->usrcomment;
									$user['portrait']=$row->usrportrait;
		 							return $user;
								}
							}else if ($type=="week") {
								if ((time()-($row->usrcookie-$row->usrac))>=$week_time) {
									return false;
								}else {
									$user['uid']=$row->uid;								
		 							$user['email']=$row->email;
		 							$user['userac']=$row->usrac;
									$user['institute']=$row->institute;
									$user['name']=$row->usrname;
									$user['usercomment']=$row->usrcomment;
									$user['portrait']=$row->usrportrait;
		 							return $user;
								}
							}
							
						}else return false;
					}
				}
				catch (Exception $e) {
					echo $e->__toString();
				}
			}
		}	




}

?>