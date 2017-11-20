<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class AssistanceMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function findType(){
		$user = $_SESSION["currentuser"]; 
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($user));
		$array = $stmt->fetch(PDO::FETCH_ASSOC);

		if($array["ADMIN"] == 1) {
			return "admin";
		} else if($array["ENTRENADOR"] == 1){
			return "entrenador";
		}else{
			return "deportista";
		}
	}

	public function showAllActivities(){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD");
		$stmt->execute();
		$activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$activities = array();

		foreach ($activities_db as $activity) {
			array_push($activities, new Assistance($activity["NOMBRE"], $activity["ID_ACT"], null, null, null));
		}

		return $activities;

	}
	
	public function showAllAssistants($id, $confirmado){
		$stmt = $this->db->prepare("SELECT DNI_DEP FROM `RESERVA` WHERE ID_ACT=? AND CONFIRMADO=?");
		$stmt->execute(array($id, $confirmado));
		$assistants_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$assistants = array();

		foreach ($assistants_db as $assistant) {
			array_push($assistants, new Assistance(null, null, $assistant["DNI_DEP"], null, null));
		}

		return $assistants;

	}

	public function findAssistance($id){
		$stmt = $this->db->prepare("SELECT DNI_DEP, FECHA, HORA FROM `ASISTE` WHERE ID_ACT=? ORDER BY FECHA DESC");
		$stmt->execute(array($id));
		
		$assistances_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$assistances = array();

		foreach ($assistances_db as $assistance) {
			array_push($assistances, new Assistance(null, null, $assistance["DNI_DEP"], $assistance["FECHA"], $assistance["HORA"]));
		}

		return $assistances;
	}



	public function add($assistance){
		$stmt = $this->db->prepare("INSERT INTO ASISTE(ID_ACT, DNI_DEP, FECHA, HORA) values (?,?,?,?)");
		$stmt->execute(array($assistance->getActivityid(), $assistance->getDni(), $assistance->getDateassistance(), $assistance->getTime()));

		return $this->db->lastInsertId();
	}
/*
	public function delete(User $user){
		$stmt = $this->db->prepare("DELETE from USUARIO WHERE DNI=?");
		$stmt->execute(array($user->getUsername()));
		$stmt2 = $this->db->prepare("DELETE from TLF_USUARIO WHERE DNI=?");
		$stmt2->execute(array($user->getUsername()));
	}

	public function update(User $user){
		$stmt = $this->db->prepare("UPDATE USUARIO set DNI=?, CONTRASEÑA=?, NOMBRE=?, APELLIDOS=?, EMAIL=?, FECHA_NAC=?, ADMIN=?, ENTRENADOR=?, DEPORTISTA=? where DNI=?");
		$stmt->execute(array($user->getUsername(), $user->getPass(), $user->getName(), $user->getSurname(), $user->getEmail(), $user->getDateBorn(), $user->getAdmin(), $user->getCoach(), $user->getDeportist(), $user->getUsername()));

		$stmt2 = $this->db->prepare("UPDATE TLF_USUARIO set TELEFONO=? where DNI=?");
		$stmt2->execute(array($user->getTlf(), $user->getUsername()));
	}*/
}
