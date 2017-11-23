<?php

require_once(__DIR__."/../core/PDOConnection.php");


class TableMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//Devuelve todas las tablas
	public function getTables($id){
		$stmt = $this->db->prepare("SELECT T1.ID_TABLA, T1.TIPO, T2.ID_ENTRENA FROM TABLA T1 JOIN INCLUYE T2 WHERE T1.ID_TABLA = T2.ID_TABLA AND T1.ID_TABLA = ?"); 
		$stmt->execute(array($id));
		$tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, new Table($table["ID_TABLA"], $table["TIPO"], $table["ID_ENTRENA"]));
		}

		return $tables;
	}

	//Devuelve el id de las tablas que tienen asociado algun ejercicio
	public function getIdTablesWithExercises(){
		$stmt = $this->db->prepare("SELECT DISTINCT ID_TABLA FROM `INCLUYE` WHERE 1"); 
		$stmt->execute();
		$tables_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$tables = array();

		foreach ($tables_db as $table) {
			array_push($tables, $table["ID_TABLA"]);
		}

		return $tables;
	}

	public function delete(Table $table){
		$stmt = $this->db->prepare("DELETE from ENTRENAMIENTO WHERE ID_ENTRENA=?");
		$stmt->execute(array($training->getTrainingId()));
	}

	public function update(Training $training){
		$stmt = $this->db->prepare("UPDATE ENTRENAMIENTO set ID_EJERCICIO=?, NUM_REP=?, TIEMPO=? WHERE ID_ENTRENA=?");
		$stmt->execute(array($training->getExerciseId(), $training->getRepeats(), $training->getTime(), $training->getTrainingId()));
	}
	
}
