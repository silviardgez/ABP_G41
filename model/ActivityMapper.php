<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class ActivityMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//Busca una actividad por nombre
	public function findActivityByName($name){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD WHERE NOMBRE=?");
		$stmt->execute(array($name));
		$activity = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($activity != null) {
			return new Activity($activity["NOMBRE"], $activity["TIPO"], $activity["HORA_INI"], $activity["HORA_FIN"], $activity["DURACION"], $activity["COLOR"]);
		} else {
			return NULL;
		}
	}

	//Devuelve los nombres de todas las actividades grupales
	public function getGrupalActivitiesName(){
		$stmt = $this->db->prepare("SELECT NOMBRE FROM ACTIVIDAD where TIPO='GRUPAL' GROUP BY 1");
		$stmt->execute();
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, $activity["NOMBRE"]);
		}

		return $grupalActivities;
	}
	

	//Devuelve todas las actividades grupales 
	public function getGrupalActivities($weekDay){
		$stmt = $this->db->prepare("SELECT *, (hour(HORA_FIN) - hour(HORA_INI)) + (minute(HORA_FIN) - minute(HORA_INI))/60 AS 'DURACION' FROM ACTIVIDAD where TIPO='GRUPAL' && DIA = ? ORDER BY HORA_INI");
		$stmt->execute(array($weekDay));
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, new Activity($activity["NOMBRE"], $activity["TIPO"], $activity["HORA_INI"], $activity["HORA_FIN"], $activity["DURACION"], $activity["COLOR"]));
		}

		return $grupalActivities;
	}

	public function delete(Activity $activity){
		$stmt = $this->db->prepare("DELETE from ACTIVIDAD WHERE NOMBRE=?");
		$stmt->execute(array($activity->getActivityName()));
	}
}
