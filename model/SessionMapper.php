<?php
require_once (__DIR__ . "/../core/PDOConnection.php");
class SessionMapper {
	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance ();
	}
	
	// Muestra todas las sesiónes
	public function showAllSessions() {
		$stmt = $this->db->prepare ( "SELECT * FROM ENGLOBA T1 JOIN SESION T2 WHERE T1.ID_ENGLOBA = T2.ID_ENGLOBA ORDER BY T2.FECHA ASC" );
		$stmt->execute ();
		$sessions_db = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
		$sessions = array ();
		
		foreach ( $sessions_db as $session ) {
			array_push ( $sessions, new Session ( $session ["ID_SESION"], $session ["FECHA"], $session ["HORA"], $session ["OBSERVACIONES"], $session ["ID_ENGLOBA"], $session ["DNI"], $session["ID_TABLA"]) );
		}
		return $sessions;
	}
	
	// Muestra todas las sesiones de un cliente
	public function showAllClientSessions($client) {
		$stmt = $this->db->prepare ("SELECT * FROM ENGLOBA T1 JOIN SESION T2 WHERE T1.ID_ENGLOBA = T2.ID_ENGLOBA AND T1.DNI = ? ORDER BY T2.FECHA ASC" );
		$stmt->execute(array($client));
		$sessions_db = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
		$sessions = array ();
		
		foreach ( $sessions_db as $session ) {
			array_push ( $sessions, new Session ($session ["ID_SESION"], $session ["FECHA"], $session ["HORA"], $session ["OBSERVACIONES"], $session ["ID_ENGLOBA"], $session ["DNI"], $session["ID_TABLA"]) );
		}
		return $sessions;
	}
	
	//Devuelve una sesión dado un id
	public function getSessionById($id) {
		$stmt = $this->db->prepare ( "SELECT * FROM SESION WHERE ID_SESION=?" );
		$stmt->execute ( array ($id) );
		$session = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		if ($session != null) {
			return new Session ($session ["ID_SESION"], $session ["FECHA"], $session ["HORA"], $session ["OBSERVACIONES"], $session ["ID_ENGLOBA"]);
		} else {
			return NULL;
		}
	}
	
	//Devuelve el dni de un cliente dado un id de sesion
	public function getUserById($idSession) {
		$stmt = $this->db->prepare ("SELECT T1.DNI FROM ENGLOBA T1 JOIN SESION T2 WHERE T1.ID_ENGLOBA = T2.ID_ENGLOBA AND T2.ID_SESION = ?" );
		$stmt->execute(array($idSession));
		
		$session = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($session != null) {
			return $session["DNI"];
		} else {
			return NULL;
		}
	}
	
	//Devuelve todas las tablas asociadas a un usuario
	public function getTablesByUser($client) {
		$stmt = $this->db->prepare ("SELECT DISTINCT ID_TABLA, ID_ENGLOBA FROM ENGLOBA WHERE DNI = ?" );
		$stmt->execute(array($client));
		$sessions_db = $stmt->fetchAll( PDO::FETCH_ASSOC );
		
		$sessions = array ();
		
		foreach ( $sessions_db as $session ) {
			$sessions[$session["ID_ENGLOBA"]] = $session["ID_TABLA"];
		}
		return $sessions;
	}
	
	//Edita una sesión
	public function update(Session $session) {
		$stmt = $this->db->prepare ("UPDATE SESION set ID_ENGLOBA=?, FECHA=?, HORA=?, OBSERVACIONES=? where ID_SESION=?");
		$stmt->execute ( array (
				$session->getIdClientTable(),
				$session->getSessionDay(),
				$session->getSessionHour(),
				$session->getObservations(),
				$session->getSessionId() 
		) );
	}
	
	//Elimina una sesión
	public function delete(Session $session) {
		$stmt = $this->db->prepare ( "DELETE FROM SESION WHERE ID_SESION=?" );
		$stmt->execute ( array ($session->getSessionId()) );
	}
	
	//Añade una sesión
	public function add(Session $session) {
		$stmt = $this->db->prepare ( "INSERT INTO SESION(ID_ENGLOBA, OBSERVACIONES,FECHA,HORA) values (?,?,?,?)" );
		echo "INSERT INTO SESION(ID_ENGLOBA, OBSERVACIONES,FECHA,HORA) values (".$session->getIdClientTable().",".$session->getObservations().",".$session->getSessionDay().",".$session->getSessionHour().")";
		$stmt->execute ( array (
				$session->getIdClientTable(),
				$session->getObservations(),
				$session->getSessionDay(),
				$session->getSessionHour()
		) );
		
		return $this->db->lastInsertId ();
	}
}
?>
