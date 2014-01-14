<?php

class Message {
	private $time;
	private $content;
	private $url;
	private $id;
	private $support;//the number of supporting people
	private $disdain;//the number of disdaining people
	private $uid;
	private $pid;
	function __set($property_name,$value){
		$this->$property_name = $value;
	}
	function __get($property_name){
		return $this->$property_name;
	}
}

?>