<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/UserMapper.php");

class User{

	private $username;
	private $pass;
	private $name;
	private $surname;
	private $email;
	private $date_born;
	private $admin;
	private $coach;
	private $deportist;
	private $tlf;

	public function __construct($username=NULL, $pass=NULL, $name=NULL, $surname=NULL, $email=NULL, $date_born=NULL, $admin=NULL,$coach=NULL,$deportist=NULL,$tlf=NULL){
		$this->username = $username;
		$this->pass = $pass;
		$this->name = $name;
		$this->surname = $surname;
		$this->email = $email;
		$this->date_born = $date_born;
		$this->admin = $admin;
		$this->coach = $coach;
		$this->deportist = $deportist;
		$this->tlf = $tlf;
	}

	public function setUsername($username){
		$this->username = $username;
	}

	public function setPass($pass){
		$this->pass = $pass;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setSurname($surname){
		$this->surname = $surname;
	}

	public function setEmail($email){
		$this->email = $email;
	}

	public function setDateBorn($date_born){
		$this->date_born = $date_born;
	}

	public function setAdmin($admin){
		$this->admin = $admin;
	}

	public function setCoach($coach){
		$this->coach = $coach;
	}

	public function setDeportist($deportist){
		$this->deportist = $deportist;
	}

	public function setTlf($tlf){
		$this->tlf = $tlf;
	}

	public function validar_username($username){
		$letra = substr($username, -1);
		$numeros = substr($username, 0, -1);
		if ( substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1) == $letra && strlen($letra) == 1 && strlen ($numeros) == 8 ){
			return true;
		}else{
			return false;
		}
	}

	public function ValidRegister($pass_rep){
		$errors = array();
		$expresion = '/^[9|6|7][0-9]{8}$/'; 
		$this->userMapper = new UserMapper();
		if (strlen($this->username) < 8 ) {
			$errors["DNI"] = "DNI must be at least 8 characters length";
		}
		if(!$this->userMapper->is_valid_DNI($this->getUsername())){
			$errors["DNI"] = "DNI exists";
		}
		if(!$this->validar_username($this->username) || $this->getUsername()==NULL){
			$errors["DNI"] = "DNI incorrect";
		}
		if (strlen($this->pass) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if($pass_rep != $this->pass){
			$errors["passwd"] = "Passwords do not match";
		}
		if(strlen($this->tlf) != 9){
			$errors["tlf"] = "The phone number must have 9 numbers";
		}
		if(!preg_match($expresion, $this->tlf)){ 
			$errors["tlf"] = "The phone number is wrong";
		}
		if(!$this->is_valid_email($this->email)){
			$errors["email"] = "The email is wrong";
		}
		if($this->getName()==NULL){
			$errors["name"] = "The name is wrong";
		}
		if($this->getSurname()==NULL){
			$errors["surname"] = "The surname is wrong";
		}
		if($this->getDateBorn()==NULL){
			$errors["dateborn"] = "The date born is wrong";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "user is not valid");
		}
	}

	public function is_valid_email($str){
		return (false !== strpos($str, "@") && false !== strpos($str, "."));
	}

	public function getUsername(){
		return $this->username;
	}

	public function getPass(){
		return $this->pass;
	}

	public function getName(){
		return $this->name;
	}

	public function getSurname(){
		return $this->surname;
	}

	public function getEmail(){
		return $this->email;
	}

	public function getDateBorn(){
		return $this->date_born;
	}

	public function getAdmin(){
		return $this->admin;
	}

	public function getCoach(){
		return $this->coach;
	}

	public function getDeportist(){
		return $this->deportist;
	}

	public function getTlf(){
		return $this->tlf;
	}

	public function checkIsValidForUpdate() {
		$errors = array();
		$expresion = '/^[9|6|7][0-9]{8}$/'; 
		if (!isset($this->username)) {
			$errors["DNI"] = "DNI is mandatory";
		}
		if(strlen($this->tlf) != 9){
			$errors["tlf"] = "The phone number must have 9 numbers";
		}
		if(!preg_match($expresion, $this->tlf)){ 
			$errors["tlf"] = "The phone number is wrong";
		}
		if(!$this->is_valid_email($this->email)){
			$errors["email"] = "The email is wrong";
		}
		if($this->getName()==NULL){
			$errors["name"] = "The name is wrong";
		}
		if($this->getSurname()==NULL){
			$errors["surname"] = "The surname is wrong";
		}
		if($this->getDateBorn()==NULL){
			$errors["dateborn"] = "The date born is wrong";
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "user is not valid");
		}
	}
	
}

?>
