<?php
// file: model/activityMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class ActivityMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

	//Busca una actividad por nombre
	public function getActivitiesByName($name){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD WHERE NOMBRE=?");
		$stmt->execute(array($name));
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, new Activity($activity["ID_ACT"], $activity["NOMBRE"], $activity["TIPO"], $activity["DIA"], $activity["HORA_INI"], $activity["HORA_FIN"], $activity["COLOR"], $activity["DNI_ENTR"]));
		}

		return $grupalActivities;
	}

	//Busca una actividad por id
	public function getActivityById($id){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD WHERE ID_ACT=?");
		$stmt->execute(array($id));
		$activity = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if($activity != null) {
			return new Activity($activity["ID_ACT"], $activity["NOMBRE"], $activity["TIPO"], $activity["DIA"], $activity["HORA_INI"], $activity["HORA_FIN"], $activity["COLOR"], $activity["DNI_ENTR"]);
		} else {
			return NULL;
		}
	}

	//Devuelve los nombres de todas las actividades grupales
	public function getGrupalActivitiesName(){
		$stmt = $this->db->prepare("SELECT NOMBRE FROM ACTIVIDAD where TIPO='GRUPAL' GROUP BY 1");
		$stmt->execute();
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, $activity["NOMBRE"]);
		}

		return $grupalActivities;
	}
	

	//Devuelve todas las actividades grupales 
	public function getGrupalActivities($weekDay){
		$stmt = $this->db->prepare("SELECT *, (hour(HORA_FIN) - hour(HORA_INI)) + (minute(HORA_FIN) - minute(HORA_INI))/60 AS 'DURACION' FROM ACTIVIDAD where TIPO='GRUPAL' && DIA = ? ORDER BY HORA_INI");
		$stmt->execute(array($weekDay));
		$grupalActivities_db = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$grupalActivities = array();

		foreach ($grupalActivities_db as $activity) {
			array_push($grupalActivities, new Activity($activity["ID_ACT"], $activity["NOMBRE"], $activity["TIPO"], $activity["DIA"], $activity["HORA_INI"], $activity["HORA_FIN"], $activity["COLOR"], $activity["DNI_ENTR"], $activity["DURACION"]));
		}

		return $grupalActivities;
	}

	public function delete($activityName){
		$stmt = $this->db->prepare("DELETE from ACTIVIDAD WHERE NOMBRE=?");
		$stmt->execute(array($activityName));
	}

	public function deleteCurrent(Activity $activity){
		$stmt = $this->db->prepare("DELETE from ACTIVIDAD WHERE ID_ACT=?");
		$stmt->execute(array($activity->getActivityId()));
	}

	//Actualizar datos en común de las actividades
	public function update(Activity $activity){
		$stmt = $this->db->prepare("UPDATE ACTIVIDAD SET `NOMBRE`=?,`COLOR`=? WHERE ID_ACT=?");
		$stmt->execute(array($activity->getActivityName(), $activity->getColor(), $activity->getActivityId()));
	}

	//Actualizar datos en común de las actividades
	public function updateCurrent(Activity $activity){
		$stmt = $this->db->prepare("UPDATE ACTIVIDAD SET `NOMBRE`=?,`TIPO`=?,`DIA`=?,`HORA_INI`=?,`HORA_FIN`=?,`COLOR`=?,`DNI_ENTR`=? WHERE ID_ACT=?");
		$stmt->execute(array($activity->getActivityName(), $activity->getType(), $activity->getDay(), $activity->getStartTime(), $activity->getEndTime(), $activity->getColor(), $activity->getMonitor(), $activity->getActivityId()));
	}

	public function add(Activity $activity){
		$stmt = $this->db->prepare("INSERT INTO ACTIVIDAD(NOMBRE,DIA,HORA_INI,HORA_FIN,COLOR,DNI_ENTR) values (?,?,?,?,?,?)");
		$stmt->execute(array($activity->getActivityName(), $activity->getDay(), $activity->getStartTime(), $activity->getEndTime(), $activity->getColor(), $activity->getMonitor()));
		return $this->db->lastInsertId();
	}
	
	//Devuelve todas las actividades
	public function selectAllActivities(){
		$stmt = $this->db->prepare("SELECT * FROM ACTIVIDAD");
		$stmt->execute();

		$activities = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $activities;
	}

	//Devuelve los emails de los usuarios anotados en una actividad
	public function selectEmail($id_act){
		$stmt = $this->db->prepare("SELECT EMAIL FROM USUARIO, RESERVA WHERE USUARIO.DNI=RESERVA.DNI_DEP AND ID_ACT=?");
		$stmt->execute(array($id_act));

		$email_bd = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$resul = "";

		foreach ($email_bd as $email) {
			if ($email === end($email_bd)) {
				$resul .= $email["EMAIL"];
			}else{
				$resul .= $email["EMAIL"] . ", ";
			}
		}

		return $resul;
	}
}
