<?php
require_once (__DIR__ . "/../core/PDOConnection.php");
class SessionMapper {
	private $db;
	public function __construct() {
		$this->db = PDOConnection::getInstance ();
	}
	
	// Muestra todas las sesiónes
	public function showAllSesions() {
		$stmt = $this->db->prepare ( "SELECT * FROM SESION" );
		$stmt->execute ();
		$sesions_db = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
		$sesions = array ();
		
		foreach ( $sesions_db as $sesion ) {
			array_push ( $sesions, new Session ( $sesion ["ID_SESION"], $sesion ["FECHA"], $sesion ["HORA"], $sesion ["OBSERVACIONES"] ) );
		}
		return $sesions;
	}
	
	// Muestra todas las sesiones de un cliente
	public function showAllClientSesions($client) {
		$stmt = $this->db->prepare ("SELECT * FROM ENGLOBA T1 JOIN SESION T2 WHERE T1.ID_ENGLOBA = T2.ID_ENGLOBA AND T1.DNI = ?" );
		$stmt->execute(array($client));
		$sessions_db = $stmt->fetchAll ( PDO::FETCH_ASSOC );
		
		$sessions = array ();
		
		foreach ( $sessions_db as $session ) {
			array_push ( $sessions, new Session ($session ["ID_SESION"], $session ["FECHA"], $session ["HORA"], $session ["OBSERVACIONES"], $session ["ID_ENGLOBA"]) );
		}
		return $sessions;
	}
	
	public function findSesionById($id) {
		$stmt = $this->db->prepare ( "SELECT * FROM SESION WHERE ID_SESION=?" );
		$stmt->execute ( array (
				$id 
		) );
		$sesion = $stmt->fetch ( PDO::FETCH_ASSOC );
		
		if ($sesion != null) {
			return new Sesion ( $sesion ["ID_SESION"], $sesion ["FECHA"], $sesion ["HORA"], $sesion ["OBSERVACIONES"] );
		} else {
			return NULL;
		}
	}
	public function update(Sesion $sesion) {
		$stmt = $this->db->prepare ( "UPDATE SESION set FECHA=?, HORA=?, OBSERVACIONES=? where ID_SESION=?" );
		$stmt->execute ( array (
				$sesion->getDateSesion (),
				$sesion->getHour (),
				$sesion->getObservation (),
				$sesion->getIdSesion () 
		) );
	}
	public function delete($sesion) {
		$stmt = $this->db->prepare ( "DELETE from SESION WHERE ID_SESION=?" );
		$stmt->execute ( array (
				$sesion->getIdSesion () 
		) );
	}
	public function add(Sesion $sesion) {
		$stmt = $this->db->prepare ( "INSERT INTO SESION(OBSERVACIONES,FECHA,HORA) values (?,?,?)" );
		$stmt->execute ( array (
				$sesion->getObservation (),
				$sesion->getDateSesion (),
				$sesion->getHour () 
		) );
		return $this->db->lastInsertId ();
	}
}
?>
