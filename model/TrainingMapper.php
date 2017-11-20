<?php

require_once(__DIR__."/../core/PDOConnection.php");


class TrainingMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//Devuelve todos los entrenamientos
	public function getTrainings(){
		$stmt = $this->db->prepare("SELECT * FROM ENTRENAMIENTO");
		$stmt->execute();
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, new Activity($activity["NOMBRE"], $activity["TIPO"], $activity["HORA_INI"], $activity["HORA_FIN"]));
		}

		return $grupalActivities;
	}
	
}
