<?php 
class Place{
	private $name;
	private $id;
	private $comment;
	private $category;
	private $cre_time;
	private $owner;//id of owner
	function __construct($name,$id,$comment,$category,$cre_time){
		$this->name  = $name;
		$this->owner = $id;
		$this->comment = $comment;
		$this->category = $category;
		$this->cre_time = $cre_time;
	}
	function __set($property_name,$value){
		$this->$property_name = $value;
	}
	function __get($property_name){
		return $this->$property_name;
	}
}
?>

