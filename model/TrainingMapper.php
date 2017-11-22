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
		$grupalTrainings_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalTrainings = array();

		foreach ($grupalTrainings_db as $training) {
			array_push($grupalTrainings, new Training($training["ID_ENTRENA"], $training["ID_EJERCICIO"], $training["NUM_REP"], $training["TIEMPO"]));
		}

		return $grupalTrainings;
	}

	//Devuelve un entrenamiento dado un id
	public function getTrainingById($trainingId){
		$stmt = $this->db->prepare("SELECT * FROM ENTRENAMIENTO WHERE ID_ENTRENA=?");
		$stmt->execute(array($trainingId));

		$training = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($training != null) {
			return new Training($training["ID_ENTRENA"], $training["ID_EJERCICIO"], $training["NUM_REP"], $training["TIEMPO"]);
		} else {
			return NULL;
		}
	}

	public function delete(Training $training){
		$stmt = $this->db->prepare("DELETE from ENTRENAMIENTO WHERE ID_ENTRENA=?");
		$stmt->execute(array($training->getTrainingId()));
	}

	public function update(Training $training){
		$stmt = $this->db->prepare("UPDATE ENTRENAMIENTO set ID_EJERCICIO=?, NUM_REP=?, TIEMPO=? WHERE ID_ENTRENA=?");
		$stmt->execute(array($training->getExerciseId(), $training->getRepeats(), $training->getTime(), $training->getTrainingId()));
	}
	
}
