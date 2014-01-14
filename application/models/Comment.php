<?php

namespace application\models;

class Comment {
	private $message_id;
	private $uid;
	private $time;
	private $content;
	private $cid;

	function __set($property_name,$value){
		$this->$property_name = $value;
	}
	function __get($property_name){
		return $this->$property_name;
	}
}

?>