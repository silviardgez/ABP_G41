<?php
// file: model/ExerciseMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class ExerciseMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	

	public function showAllExercises(){
		$stmt = $this->db->prepare("SELECT * FROM EJERCICIO");
		$stmt->execute();
		$exercises_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$exercise = array();
		//var_dump($exercises_db);

		foreach ($exercises_db as $exercises) {
			array_push($exercise, new Exercise($exercises["ID_EJERCICIO"], $exercises["NOMBRE"], $exercises["TIPO"], $exercises["IMAGEN"], $exercises["VIDEO"]));
		}

		return $exercise;

	}

	public function findExerciseById($id){
		$stmt = $this->db->prepare("SELECT * FROM EJERCICIO WHERE ID_EJERCICIO=?");
		$stmt->execute(array($id));
		$exercise = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($exercise != null) {
			return new Exercise(
				$exercise["ID_EJERCICIO"],
				$exercise["NOMBRE"],
				$exercise["TIPO"],
				$exercise["IMAGEN"],
				$exercise["VIDEO"]);
		} else {
			return NULL;
		}
	}

	public function update(Exercise $exercise){
		$stmt = $this->db->prepare("UPDATE EJERCICIO set NOMBRE=?, TIPO=?, IMAGEN=?, VIDEO=? where ID_EJERCICIO=?");
		$stmt->execute(array($exercise->getName(), $exercise->getType(), $exercise->getImage(), $exercise->getVideo(), $exercise->getId()));
	}

	public function delete($exercise){
		$stmt = $this->db->prepare("DELETE from EJERCICIO WHERE ID_EJERCICIO=?");
		$stmt->execute(array($exercise->getId()));
	}

	public function add(Exercise $exercise){
		$stmt = $this->db->prepare("INSERT INTO EJERCICIO(NOMBRE,TIPO,IMAGEN,VIDEO) values (?,?,?,?)");
		$stmt->execute(array($exercise->getName(), $exercise->getType(), $exercise->getImage(), $exercise->getVideo()));
		return $this->db->lastInsertId();
	}

	//Devolver nombre de ejercicio dado un id
	public function findExerciseNameById($id){
		$stmt = $this->db->prepare("SELECT NOMBRE FROM EJERCICIO WHERE ID_EJERCICIO=?");
		$stmt->execute(array($id));
		$exercise = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($exercise != null) {
			return $exercise["NOMBRE"];
		} else {
			return NULL;
		}
	}

	//Devolver nombre de ejercicio y foto dado un id
	public function findPhotoById($id){
		$stmt = $this->db->prepare("SELECT IMAGEN FROM EJERCICIO WHERE ID_EJERCICIO=?");
		$stmt->execute(array($id));
		$exercise = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($exercise != null) {
			return $exercise["IMAGEN"];
		} else {
			return NULL;
		}
	}

	//Devolver tipo de ejercicio dado un id
	public function getTypeById($id){
		$stmt = $this->db->prepare("SELECT TIPO FROM EJERCICIO WHERE ID_EJERCICIO=?");
		$stmt->execute(array($id));
		$exercise = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($exercise != null) {
			return $exercise["TIPO"];
		} else {
			return NULL;
		}
	}

	//Devolver nombre de ejercicio dado un id
	public function getNameById($id){
		$stmt = $this->db->prepare("SELECT NOMBRE FROM EJERCICIO WHERE ID_EJERCICIO=?");
		$stmt->execute(array($id));
		$exercise = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($exercise != null) {
			return $exercise["NOMBRE"];
		} else {
			return NULL;
		}
	}

}
