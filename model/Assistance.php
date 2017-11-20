<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/AssistanceMapper.php");

class Assistance{

	private $activityname;
	private $activityid;
	private $dni;
	private $dateassistance;
	private $timeassistance;

	
	public function __construct($activityname=NULL, $activityid=NULL, $dni=NULL, $dateassistance=NULL, $timeassistance=NULL){
		$this->activityname = $activityname;
		$this->activityid = $activityid;
		$this->dni = $dni;
		$this->dateassistance = $dateassistance;
		$this->timeassistance = $timeassistance;
	}

	public function setActivityname($activityname){
		$this->activityname = $activityname;
	}

	public function getActivityname(){
		return $this->activityname;
	}
	
	public function setActivityid($activityid){
		$this->activityid = $activityid;
	}

	public function getActivityid(){
		return $this->activityid;
	}
	
	public function setDni($dni){
		$this->dni = $dni;
	}

	public function getDni(){
		return $this->dni;
	}
	
	
	public function setDateassistance($dateassistance){
		$this->dateassistance = $dateassistance;
	}

	public function getDateassistance(){
		return $this->dateassistance;
	}
	
	public function setTime($timeassistance){
		$this->timeassistance = $timeassistance;
	}

	public function getTime(){
		return $this->timeassistance;
	}

	
/*
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

	public function checkIsValidForCurrentUpdate($pass,$npass,$rpass) {
		$errors = array();
		$expresion = '/^[9|6|7][0-9]{8}$/'; 
		$this->userMapper = new UserMapper();
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
		if($this->getPass() != md5($pass)){
			$errors["oldpasswd"] = "Incorrect password";
		}
		if (strlen($this->pass) < 5) {
			$errors["passwd"] = "Password must be at least 5 characters length";
		}
		if($rpass != $npass){
			$errors["passwd"] = "Passwords do not match";
		}
		if (sizeof($errors) > 0) {
			throw new ValidationException($errors, "user is not valid");
		}
	}*/

	public function getIdSesion(){
		return $this->id_sesion;
	}

	public function getIdTable(){
		return $this->id_table;
	}
	
}







?>
