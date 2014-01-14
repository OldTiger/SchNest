<?php

namespace application\models;

class User {
	private $id;
	private $account;
	private $password;
	private $institute;
	private $email;
	private $comment;
	private $name;
	private $ip;
	private $portrait;
	private $cookie;
	
	function __set($property_name,$value){
		$this->$property_name = $value;
	}
	function __get($property_name){
		return $this->$property_name;
	}
}

?>