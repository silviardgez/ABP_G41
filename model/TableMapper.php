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

	//Busca una tabla por id
	public function getTableById($id){
		$stmt = $this->db->prepare("SELECT * FROM TABLA WHERE ID_TABLA=?");
		$stmt->execute(array($id));
		$table = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($table != null) {
			return new Table($table["ID_TABLA"], $table["TIPO"]);
		} else {
			return NULL;
		}
	}

	public function delete($id){
		$stmt = $this->db->prepare("DELETE from TABLA WHERE ID_TABLA=?");
		$stmt->execute(array($id));
	}

	public function deletecurrent($id, $idEntr){
		$stmt = $this->db->prepare("DELETE from INCLUYE WHERE ID_TABLA=? AND ID_ENTRENA=?");
		$stmt->execute(array($id,$idEntr));
	}
	
	public function deleteUserFromTable($id, $dni){
		$stmt = $this->db->prepare("DELETE from ENGLOBA WHERE ID_TABLA=? AND DNI=?");
		$stmt->execute(array($id,$dni));
	}

	public function update(Table $table){
		$stmt = $this->db->prepare("UPDATE TABLA set TIPO=? WHERE ID_TABLA=?");
		$stmt->execute(array($table->getType(), $table->getTableId()));
	}

	public function add(Table $table){
		$stmt = $this->db->prepare("INSERT INTO TABLA(TIPO) VALUES(?)");
		$stmt->execute(array($table->getType()));
	}
	
	public function addTraining($training, $tableId){
		$stmt = $this->db->prepare("INSERT INTO INCLUYE(ID_ENTRENA,ID_TABLA) VALUES(?,?)");
		$stmt->execute(array($training, $tableId));
	}
	
	public function addUser($table, $user){
		$stmt = $this->db->prepare("INSERT INTO ENGLOBA(ID_TABLA, DNI) VALUES(?,?)");
		$stmt->execute(array($table,$user));
	}
	
	//Devuelve los entrenamientos que no están asociados a una tabla dada
	public function getTrainings($id){
		$stmt = $this->db->prepare("SELECT * FROM ENTRENAMIENTO WHERE ID_ENTRENA NOT IN (SELECT T2.ID_ENTRENA FROM ENTRENAMIENTO T1 JOIN INCLUYE T2 WHERE T1.ID_ENTRENA = T2.ID_ENTRENA AND T2.ID_TABLA = ?)");
		$stmt->execute(array($id));
		$grupalTrainings_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalTrainings = array();
		
		foreach ($grupalTrainings_db as $training) {
			array_push($grupalTrainings, new Training($training["ID_ENTRENA"], $training["ID_EJERCICIO"], $training["NUM_REP"], $training["TIEMPO"]));
		}
		
		return $grupalTrainings;
	}
	
}
