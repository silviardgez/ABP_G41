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
	private $tablas;
	private $tiempos;
	
	public function __construct($dni=NULL, $deportistname=NULL, $deportistsurname=NULL, $asistenciaActividades=NULL, $matriculas=NULL, $asistenciasTotales=NULL, $porcentajeMatriculas=NULL, $porcentajeAsistencias=NULL, $tablas=NULL, $tiempos=NULL){
		$this->dni = $dni;
		$this->deportistname = $deportistname;
		$this->deportistsurname = $deportistsurname;
		$this->asistenciaActividades = $asistenciaActividades;
		$this->matriculas = $matriculas;
		$this->asistenciasTotales = $asistenciasTotales;
		$this->porcentajeMatriculas = $porcentajeMatriculas;
		$this->porcentajeAsistencias = $porcentajeAsistencias;
		$this->tablas = $tablas;
		$this->tiempos = $tiempos;
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
	
	public function setTablas($tablas){
		$this->tablas = $tablas;
	}

	public function getTablas(){
		return $this->tablas;
	}
	
	public function getTabla($indice){
		return $this->tablas[$indice]["ID_TABLA"];
	}
	
	public function setTiempos($tiempos){
		$this->tiempos = $tiempos;
	}
	
	public function getTiempos(){
		return $this->tiempos;
	}
}
?>
