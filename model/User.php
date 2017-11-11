<?php

require_once(__DIR__."/../core/ValidationException.php");

class User{

	private $username;
	private $pass;

	public function __construct($username=NULL, $pass=NULL){
		$this->username = $username;
		$this->pass = $pass;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function setPass($pass){
		$this->pass = $pass;
	}

	public function ValidRegister(){
		$errors = array();
		if (strlen($this->username) < 5) {
			$errors["username"] = "Username must be at least 5 characters length";

		}
		if (strlen($this->pass) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPass(){
		return $this->pass;
	}
	
}







?>
