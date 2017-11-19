<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class ActivitiesstatisticsMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	/*public function findType(){
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
	}*/

	public function showAllActivities(){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD");
		$stmt->execute();
		$activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$activities = array();

		foreach ($activities_db as $activity) {
			array_push($activities, new Activitiesstatistics($activity["NOMBRE"], $activity["ID_ACT"], null, null, null));
		}

		return $activities;

	}

	public function findStatistics($id, $confirmado, $deportista){
		$stmt = $this->db->prepare("SELECT COUNT(ID_ACT) FROM `RESERVA` WHERE ID_ACT=? AND CONFIRMADO=?");
		$stmt->execute(array($id, $confirmado));
		
		$matriculados_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$matriculados = $matriculados_db[0]["COUNT(ID_ACT)"];
		
		$stmt2 = $this->db->prepare("SELECT COUNT(DEPORTISTA) FROM `USUARIO` WHERE DEPORTISTA=?");
		$stmt2->execute(array($deportista));
		
		$deportistas_db = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$deportistas = $deportistas_db[0]["COUNT(DEPORTISTA)"];
		
		$porcentajeMatriculados = ($matriculados/$deportistas)*100;
		
		$assistances = array();
		
		array_push($assistances, new Activitiesstatistics(null, null, $porcentajeMatriculados, $matriculados, $deportistas));

		return $assistances;
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
