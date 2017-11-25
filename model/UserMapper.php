<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class UserMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}
	
	public function isValidUser($username, $pass) {
		$stmt = $this->db->prepare("SELECT count(DNI) FROM USUARIO where DNI=? and CONTRASEÑA=?");
		$stmt->execute(array($username, md5($pass)));

		if ($stmt->fetchColumn() > 0) {
			return true;
		}
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

	public function showAllUsers(){
		$stmt = $this->db->prepare("SELECT * FROM USUARIO");
		$stmt->execute();
		$users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$user = array();
		//var_dump($users_db);

		foreach ($users_db as $users) {
			array_push($user, new User($users["DNI"], $users["CONTRASEÑA"], $users["NOMBRE"], $users["APELLIDOS"], $users["EMAIL"], $users["FECHA_NAC"], $users["ADMIN"], $users["ENTRENADOR"], $users["DEPORTISTA"]));
		}

		return $user;

	}

	public function findUserByDNI($dni){
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($dni));
		$stmt2 = $this->db->prepare("SELECT * FROM TLF_USUARIO WHERE DNI=?");
		$stmt2->execute(array($dni));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		$tlf = $stmt2->fetch(PDO::FETCH_ASSOC);
		
		if($user != null) {
			return new User(
				$user["DNI"],
				$user["CONTRASEÑA"],
				$user["NOMBRE"],
				$user["APELLIDOS"],
				$user["EMAIL"],
				$user["FECHA_NAC"],
				$user["ADMIN"],
				$user["ENTRENADOR"],
				$user["DEPORTISTA"],
				$tlf["TELEFONO"]);
		} else {
			return NULL;
		}
	}

	public function is_valid_DNI($dni){
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($dni));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);

		if(empty($user)){
			return true;
		}
		return false;
	}

	public function add($user){
		$stmt = $this->db->prepare("INSERT INTO USUARIO(DNI,CONTRASEÑA,NOMBRE,APELLIDOS,EMAIL,FECHA_NAC,ADMIN,ENTRENADOR,DEPORTISTA) values (?,?,?,?,?,?,?,?,?)");
		$stmt->execute(array($user->getUsername(), md5($user->getPass()), $user->getName(), $user->getSurname(), $user->getEmail(), $user->getDateBorn(), $user->getAdmin(), $user->getCoach(), $user->getDeportist()));
		$stmt2 = $this->db->prepare("INSERT INTO TLF_USUARIO(DNI,TELEFONO) values (?,?)");
		$stmt2->execute(array($user->getUsername(), $user->getTlf()));
		return $this->db->lastInsertId();
	}

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
	}

	//Devolver nombre de usuario dado un dni
	public function getNameByDNI($dni){
		$stmt = $this->db->prepare("SELECT NOMBRE, APELLIDOS FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($dni));
		$user = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($user != null) {
			return $user["NOMBRE"] . " ". $user["APELLIDOS"];
		} else {
			return NULL;
		}
	}

	//Devolver todos los nombres de los entrenadores
	public function getCoaches(){
		$stmt = $this->db->prepare("SELECT DNI, NOMBRE, APELLIDOS FROM USUARIO WHERE ENTRENADOR=1");
		$stmt->execute();
		$users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$coaches = array();

		foreach ($users_db as $user) {
			$coaches[$user["DNI"]] = $user["NOMBRE"] . " ". $user["APELLIDOS"];
		}

		return $coaches;
	}

	//Comprueba si es admin
	public function isAdmin(){
		$user = $_SESSION["currentuser"]; 
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($user));
		$array = $stmt->fetch(PDO::FETCH_ASSOC);

		if($array["ADMIN"] == 1) {
			return true;
		} else {
			return false;
		}
	}

	//Comprueba si es deportista
	public function isAthlete(){
		$user = $_SESSION["currentuser"]; 
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($user));
		$array = $stmt->fetch(PDO::FETCH_ASSOC);

		if($array["DEPORTISTA"] == 1) {
			return true;
		} else {
			return false;
		}
	}

	//Comprueba si es deportista
	public function isCoach(){
		$user = $_SESSION["currentuser"]; 
		$stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE DNI=?");
		$stmt->execute(array($user));
		$array = $stmt->fetch(PDO::FETCH_ASSOC);

		if($array["ENTRENADOR"] == 1) {
			return true;
		} else {
			return false;
		}
	}
}
