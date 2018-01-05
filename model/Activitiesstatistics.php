<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/ActivitiesstatisticsMapper.php");

class Activitiesstatistics{

	private $activityname;
	private $activityid;
	private $porcentajeMatriculados;
	private $matriculados;
	private $deportistas;
	private $asistentes;
	private $porcentajeAsistentes;
	private $dia;
	private $horainicio;
	private $arrayAsistentesAño;
	
	public function __construct($activityname=NULL, $activityid=NULL, $dia=null, $horainicio=null, $porcentajeMatriculados=NULL,  $matriculados=NULL, $deportistas=NULL, $asistentes=NULL, $porcentajeAsistentes=NULL, $arrayAsistentesAño=NULL){
		$this->activityname = $activityname;
		$this->activityid = $activityid;
		$this->dia = $dia;
		$this->horainicio = $horainicio;
		$this->porcentajeMatriculados = $porcentajeMatriculados;
		$this->matriculados = $matriculados;
		$this->deportistas = $deportistas;
		$this->asistentes = $asistentes;
		$this->porcentajeAsistentes = $porcentajeAsistentes;
		$this->arrayAsistentesAño = $arrayAsistentesAño;
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
	
	public function setPorcentajeMatriculados($porcentajeMatriculados){
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

	public function setAsistentes($asistentes){
		$this->asistentes = $asistentes;
	}

	public function getAsistentes(){
		return $this->asistentes;
	}
	
	public function setPorcentajeAsistentes($porcentajeAsistentes){
		$this->porcentajeAsistentes = $porcentajeAsistentes;
	}

	public function getPorcentajeAsistentes(){
		return $this->porcentajeAsistentes;
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
	
	public function setArrayAsistentesAño($arrayAsistentesAño){
		$this->arrayAsistentesAño = $arrayAsistentesAño;
	}

	public function getArrayAsistentesAño(){
		return $this->arrayAsistentesAño;
	}
}
?>
