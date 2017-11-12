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
		$stmt = $this->db->query("SELECT * FROM USUARIO WHERE DNI='".$user."'");
		//$stmt->execute(array($user));
		$array = $stmt->fetch(PDO::FETCH_ASSOC);

		if($array["ADMIN"] == 1) {
			return "admin";
		} else if($array["ENTRENADOR"] == 1){
			return "entrenador";
		}else{
			return "deportista";
		}
	}
}
