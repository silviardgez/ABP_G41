<?php
require_once (__DIR__ . "/../core/ValidationException.php");
require_once (__DIR__ . "/../model/SessionMapper.php");
class Session {
	private $observation;
	private $sessionDay;
	private $sessionHourIni;
	private $sessionHourFin;
	private $duration;
	private $idSession;
	private $idClientTable;
	private $dni;
	private $idTable;
	
	public function __construct($idSession = NULL, $dateSession = NULL, $hourIni = NULL, $hourFin = NULL, $duration = NULL, $observation = NULL, $idClientTable = NULL, $dni = NULL, $idTable = NULL) {
		$this->idSession = $idSession;
		$this->observation = $observation;
		$this->sessionDay = $dateSession;
		$this->sessionHourIni = $hourIni;
		$this->sessionHourFin = $hourFin;
		$this->duration = $duration;
		$this->idClientTable = $idClientTable;
		$this->dni = $dni;
		$this->idTable = $idTable;
	}
	
	public function setObservations($observation) {
		$this->observation = $observation;
	}
	
	public function setSessionDay($sessionDay) {
		$this->sessionDay = $sessionDay;
	}
	
	public function setSessionHourIni($sessionHourIni) {
		$this->sessionHourIni = $sessionHourIni;
	}

	public function setSessionHourFin($sessionHourFin) {
		$this->sessionHourFin = $sessionHourFin;
	}

	public function setDuration($duration) {
		$this->duration = $duration;
	}
	
	public function setIdClientTable($idClientTable){
		$this->idClientTable = $idClientTable;
	}

	public function setDNIUser($dni){
		$this->dni = $dni;
	}
	
	public function getObservations() {
		return $this->observation;
	}
	
	public function getSessionDay() {
		return $this->sessionDay;
	}
	
	public function getSessionHourIni() {
		return $this->sessionHourIni;
	}

	public function getSessionHourFin() {
		return $this->sessionHourFin;
	}

	public function getDuration() {
		return $this->duration;
	}
	
	public function getSessionId() {
		return $this->idSession;
	}
	
	public function getIdClientTable() {
		return $this->idClientTable;
	}
	
	public function getDNIUser() {
		return $this->dni;
	}
	
	public function getIdTable() {
		return $this->idTable;
	}
}

?>
