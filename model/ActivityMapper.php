<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class ActivityMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	
	//Devuelve todas las actividades
	public function getActivities(){

	}

	//Devuelve todas las actividades grupales
	public function getGrupalActivities(){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD where TIPO='GRUPAL'");
		$stmt->execute();
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, new Activity($activity["NOMBRE"], $activity["TIPO"], $activity["HORA_INI"], $activity["HORA_FIN"]));
		}

		return $grupalActivities;
	}
	
}
