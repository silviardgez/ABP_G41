<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/ActivitiesstatisticsMapper.php");

class Activitiesstatistics{

	private $activityname;
	private $activityid;
	private $porcentajeMatriculados;
	
	public function __construct($activityname=NULL, $activityid=NULL, $porcentajeMatriculados=NULL, $matriculados=NULL, $deportistas=NULL){
		$this->activityname = $activityname;
		$this->activityid = $activityid;
		$this->porcentajeMatriculados = $porcentajeMatriculados;
		$this->matriculados = $matriculados;
		$this->deportistas = $deportistas;
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
	
	public function setPorcentajeMatriculadosd($porcentajeMatriculados){
		$this->porcentajeMatriculados = $porcentajeMatriculados;
	}

	public function getPorcentajeMatriculados(){
		return $this->porcentajeMatriculados;
	}
	
	public function setMatriculados($matriculados){
		$this->matriculados = $matriculados;
	}

	public function getMatriculados(){
		return $this->matriculados;
	}
	
	public function setDeportistas($deportistas){
		$this->deportistas = $deportistas;
	}

	public function getDeportistas(){
		return $this->deportistas;
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
