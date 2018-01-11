<?php
// file: model/UserMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class AthletesstatisticsMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function showAllDeportists($entrenador){
		$stmt = $this->db->prepare("SELECT DNI, NOMBRE, APELLIDOS FROM USUARIO WHERE DEPORTISTA_TDU=1 OR DEPORTISTA_PEF=1 ORDER BY NOMBRE ASC");
		$stmt->execute();
		$deportists_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$deportists = array();

		foreach ($deportists_db as $deportist) {
			$stmt2 = $this->db->prepare("SELECT ID_TABLA FROM ENGLOBA WHERE DNI_USUARIO=?");
			$stmt2->execute(array($deportist["DNI"]));
			$tablas_db = $stmt2->fetchAll(PDO::FETCH_ASSOC);
			
			array_push($deportists, new Athletesstatistics($deportist["DNI"], $deportist["NOMBRE"], $deportist["APELLIDOS"], null, null, null, null, null, $tablas_db, null));
		}
		
		return $deportists;
		
	}

	public function findStatistics($dni, $confirmado, $deportista, $mes, $tabla){
		$stmt = $this->db->prepare("SELECT COUNT(DISTINCT ID_ACT) FROM `ASISTE` WHERE DNI_DEP=?");
		$stmt->execute(array($dni));
		
		$asistenciaActividades_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$asistenciaActividades = $asistenciaActividades_db[0]["COUNT(DISTINCT ID_ACT)"];
		
		$stmt2 = $this->db->prepare("SELECT COUNT(DISTINCT ID_ACT) FROM `RESERVA` WHERE DNI_DEP=? OR CONFIRMADO=?");
		$stmt2->execute(array($dni, $confirmado));
		
		$matriculas_db = $stmt2->fetchAll(PDO::FETCH_ASSOC);
		$matriculas = $matriculas_db[0]["COUNT(DISTINCT ID_ACT)"];
		
		$stmt3 = $this->db->prepare("SELECT COUNT(DNI_DEP) FROM `ASISTE` WHERE DNI_DEP=?");
		$stmt3->execute(array($dni));
		
		$asistenciasTotales_db = $stmt3->fetchAll(PDO::FETCH_ASSOC); 
		$asistenciasTotales = $asistenciasTotales_db[0]["COUNT(DNI_DEP)"];
		
		$stmt3 = $this->db->prepare("SELECT COUNT(DISTINCT NOMBRE) FROM `ACTIVIDAD`");
		$stmt3->execute(array());
		
		$actividadesTotales_db = $stmt3->fetchAll(PDO::FETCH_ASSOC); 
		$actividadesTotales = $actividadesTotales_db[0]["COUNT(DISTINCT NOMBRE)"];
		
		$porcentajeMatriculas = ($matriculas/$actividadesTotales)*100;
		$porcentajeAsistencias = ($asistenciaActividades/$matriculas)*100;
		
		///////////////////////////////////////////
		//datos grafica
		
		$stmt4 = $this->db->prepare("SELECT FECHA as F, DURACION as D, ID_TABLA as T, DNI_USUARIO as U FROM SESION, ENGLOBA WHERE MONTH(FECHA) = ? AND ID_TABLA = ? AND DNI_USUARIO = ? AND ENGLOBA.ID_ENGLOBA = SESION.ID_ENGLOBA");
		$stmt4->execute(array($mes, $tabla, $dni));

		$tiempos_db = $stmt4->fetchAll(PDO::FETCH_ASSOC); 
		
		$assistances = array();
		
		array_push($assistances, new Athletesstatistics(null, null, null, $asistenciaActividades, $matriculas, $asistenciasTotales, $porcentajeMatriculas, $porcentajeAsistencias, null, $tiempos_db));

		return $assistances;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}
