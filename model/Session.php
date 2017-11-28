<?php
require_once (__DIR__ . "/../core/ValidationException.php");
require_once (__DIR__ . "/../model/SessionMapper.php");
class Session {
	private $observation;
	private $sessionDay;
	private $sessionHour;
	private $idSession;
	private $idClientTable;
	
	public function __construct($idSession = NULL, $dateSession = NULL, $hour = NULL, $observation = NULL, $idClientTable = NULL) {
		$this->idSession = $idSession;
		$this->observation = $observation;
		$this->sessionDay = $dateSession;
		$this->sessionHour = $hour;
		$this->idClientTable = $idClientTable;
	}
	
	public function setObservation($observation) {
		$this->observation = $observation;
	}
	
	public function setSessionDay($sessionDay) {
		$this->session = $sessionDay;
	}
	
	public function setSessionHour($sessionHour) {
		$this->sessionHour = $sessionHour;
	}
	
	public function setIdClientTable($idClientTable){
		$this->idClientTable = $idClientTable;
	}
	
	public function getObservation() {
		return $this->observation;
	}
	
	public function getSessionDay() {
		return $this->sessionDay;
	}
	
	public function getSessionHour() {
		return $this->sessionHour;
	}
	
	public function getSessionId() {
		return $this->idSession;
	}
	
	public function getIdClientTable() {
		return $this->idClientTable;
	}
}

?>
