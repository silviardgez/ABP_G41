<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/AssistanceMapper.php");

class Assistance{

	private $activityname;
	private $activityid;
	private $dni;
	private $dateassistance;
	private $timeassistance;
	private $dia;
	private $horainicio;
	private $arrayAsis;
	
	public function __construct($activityname=NULL, $activityid=NULL, $dia=NULL, $horainicio=NULL, $dni=NULL, $dateassistance=NULL, $timeassistance=NULL, $arrayAsis=NULL){
		$this->activityname = $activityname;
		$this->activityid = $activityid;
		$this->dni = $dni;
		$this->dateassistance = $dateassistance;
		$this->timeassistance = $timeassistance;
		$this->dia = $dia;
		$this->horainicio = $horainicio;
		$this->arrayAsis = $arrayAsis;
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
	
	public function setDia($dia){
		$this->dia = $dia;
	}

	public function getDia(){
		return $this->dia;
	}
	
	public function setHorainicio($horainicio){
		$this->horainicio = $horainicio;
	}

	public function getHorainicio(){
		return $this->horainicio;
	}

	public function setArrayAsis($arrayAsis){
		$this->arrayAsis = $arrayAsis;
	}

	public function getArrayAsis(){
		return $this->arrayAsis;
	}
}
?>
