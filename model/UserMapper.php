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
}
