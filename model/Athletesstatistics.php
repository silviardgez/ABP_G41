<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/AthletesstatisticsMapper.php");

class Athletesstatistics{

	private $dni;
	private $deportistname;
	private $deportistsurname;
	private $asistenciaActividades;
	private $matriculas;
	private $asistenciasTotales;
	private $porcentajeMatriculas;
	private $porcentajeAsistencias;
	
	public function __construct($dni=NULL, $deportistname=NULL, $deportistsurname=NULL, $asistenciaActividades=NULL, $matriculas=NULL, $asistenciasTotales=NULL, $porcentajeMatriculas=NULL, $porcentajeAsistencias=NULL){
		$this->dni = $dni;
		$this->deportistname = $deportistname;
		$this->deportistsurname = $deportistsurname;
		$this->asistenciaActividades = $asistenciaActividades;
		$this->matriculas = $matriculas;
		$this->asistenciasTotales = $asistenciasTotales;
		$this->porcentajeMatriculas = $porcentajeMatriculas;
		$this->porcentajeAsistencias = $porcentajeAsistencias;
	}

	public function setDni($dni){
		$this->dni = $dni;
	}

	public function getDni(){
		return $this->dni;
	}
	
	public function setDeportistname($deportistname){
		$this->deportistname = $deportistname;
	}

	public function getDeportistname(){
		return $this->deportistname;
	}
	
	public function setDeportistpellidos($deportistsurname){
		$this->deportistsurname = $deportistsurname;
	}

	public function getDeportistsurname(){
		return $this->deportistsurname;
	}
	
	public function setAsistenciaActividades($asistenciaActividades){
		$this->asistenciaActividades = $asistenciaActividades;
	}

	public function getAsistenciaActividades(){
		return $this->asistenciaActividades;
	}
	
	public function setMatriculas($matriculas){
		$this->matriculas = $matriculas;
	}

	public function getMatriculas(){
		return $this->matriculas;
	}
	
	public function setAsistenciasTotales($asistenciasTotales){
		$this->asistenciasTotales = $asistenciasTotales;
	}

	public function getAsistenciasTotales(){
		return $this->asistenciasTotales;
	}
	
	public function setPorcentajeMatriculas($porcentajeMatriculas){
		$this->porcentajeMatriculas = $porcentajeMatriculas;
	}

	public function getPorcentajeMatriculas(){
		return $this->porcentajeMatriculas;
	}

	public function setPorcentajeAsistencias($porcentajeAsistencias){
		$this->porcentajeAsistencias = $porcentajeAsistencias;
	}

	public function getPorcentajeAsistencias(){
		return $this->porcentajeAsistencias;
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
