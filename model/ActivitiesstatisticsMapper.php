<?php
// file: model/ActivitiesstatisticsMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class ActivitiesstatisticsMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	public function showAllActivities(){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD");
		$stmt->execute();
		$activities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$activities = array();

		foreach ($activities_db as $activity) {
			array_push($activities, new Activitiesstatistics($activity["NOMBRE"], $activity["ID_ACT"], $activity["DIA"], $activity["HORA_INI"], null, null, null, null, null, null));
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
		
		$stmt3 = $this->db->prepare("SELECT COUNT(DISTINCT DNI_DEP) FROM `ASISTE` WHERE ID_ACT=?");
		$stmt3->execute(array($id));
		
		$asistentes_db = $stmt3->fetchAll(PDO::FETCH_ASSOC); 
		$asistentes = $asistentes_db[0]["COUNT(DISTINCT DNI_DEP)"];
		
		$porcentajeMatriculados = ($matriculados/$deportistas)*100;
		$porcentajeAsistentes = ($asistentes/$matriculados)*100;
		
		//sacamos el año actual
		$stmt17 = $this->db->prepare("SELECT YEAR(FECHA) FROM asiste WHERE FECHA = (SELECT MAX(FECHA) FROM ASISTE)");
		$stmt17->execute(array());
		
		$anoActual_db = $stmt17->fetchAll(PDO::FETCH_ASSOC); 
		$anoActual = $anoActual_db[0]["YEAR(FECHA)"];
		
		
		//enero
		$stmt4 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '1' AND YEAR(FECHA) = ?");
		$stmt4->execute(array($id, $anoActual));
		
		$asistentesEnero_db = $stmt4->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesEnero = $asistentesEnero_db[0]["COUNT(*)"];
		
		//febrero
		$stmt5 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '2' AND YEAR(FECHA) = ?");
		$stmt5->execute(array($id, $anoActual));
		
		$asistentesFebrero_db = $stmt5->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesFebrero = $asistentesFebrero_db[0]["COUNT(*)"];
		
		//marzo
		$stmt6 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '3' AND YEAR(FECHA) = ?");
		$stmt6->execute(array($id, $anoActual));
		
		$asistentesMarzo_db = $stmt6->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesMarzo = $asistentesMarzo_db[0]["COUNT(*)"];
		
		//abril
		$stmt7 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '4' AND YEAR(FECHA) = ?");
		$stmt7->execute(array($id, $anoActual));
		
		$asistentesAbril_db = $stmt7->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesAbril = $asistentesAbril_db[0]["COUNT(*)"];
		
		//mayo
		$stmt8 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '5' AND YEAR(FECHA) = ?");
		$stmt8->execute(array($id, $anoActual));
		
		$asistentesMayo_db = $stmt8->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesMayo = $asistentesMayo_db[0]["COUNT(*)"];
		
		//junio
		$stmt9 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '6' AND YEAR(FECHA) = ?");
		$stmt9->execute(array($id, $anoActual));
		
		$asistentesJunio_db = $stmt9->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesJunio = $asistentesJunio_db[0]["COUNT(*)"];
		
		//julio
		$stmt10 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '7' AND YEAR(FECHA) = ?");
		$stmt10->execute(array($id, $anoActual));
		
		$asistentesJulio_db = $stmt10->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesJulio = $asistentesJulio_db[0]["COUNT(*)"];
		
		//agosto
		$stmt11 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '8' AND YEAR(FECHA) = ?");
		$stmt11->execute(array($id, $anoActual));
		
		$asistentesAgosto_db = $stmt11->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesAgosto = $asistentesAgosto_db[0]["COUNT(*)"];
		
		//septiembre
		$stmt12 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '9' AND YEAR(FECHA) = ?");
		$stmt12->execute(array($id, $anoActual));
		
		$asistentesSeptiembre_db = $stmt12->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesSeptiembre = $asistentesSeptiembre_db[0]["COUNT(*)"];
		
		//octubre
		$stmt13 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '10' AND YEAR(FECHA) = ?");
		$stmt13->execute(array($id, $anoActual));
		
		$asistentesOctubre_db = $stmt13->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesOctubre = $asistentesOctubre_db[0]["COUNT(*)"];
		
		//noviembre
		$stmt14 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '11' AND YEAR(FECHA) = ?");
		$stmt14->execute(array($id, $anoActual));
		
		$asistentesNoviembre_db = $stmt14->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesNoviembre = $asistentesNoviembre_db[0]["COUNT(*)"];
		
		//diciembre
		$stmt15 = $this->db->prepare("SELECT COUNT(*) FROM `asiste` WHERE ID_ACT=? AND MONTH(FECHA) = '12' AND YEAR(FECHA) = ?");
		$stmt15->execute(array($id, $anoActual));
		
		$asistentesDiciembre_db = $stmt15->fetchAll(PDO::FETCH_ASSOC); 
		$asistentesDiciembre = $asistentesDiciembre_db[0]["COUNT(*)"];
		
		//total
		$arrayAsistentesAño = array($asistentesEnero, $asistentesFebrero, $asistentesMarzo, $asistentesAbril, 
									$asistentesMayo, $asistentesJunio, $asistentesJulio, $asistentesAgosto, 
									$asistentesSeptiembre, $asistentesOctubre, $asistentesNoviembre, $asistentesDiciembre);
		
		
		$assistances = array();
		
		array_push($assistances, new Activitiesstatistics(null, null, null, null, $porcentajeMatriculados, $matriculados, $deportistas, $asistentes, $porcentajeAsistentes, $arrayAsistentesAño));

		return $assistances;
	}
}
?>