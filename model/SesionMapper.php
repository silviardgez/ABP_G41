<?php
// file: model/SesionMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class SesionMapper{
  private $db;

  public function __construct(){
    $this->db = PDOConnection::getInstance();
  }


  public function showAllSesions(){
    $stmt = $this->db->prepare("SELECT * FROM SESION");
    $stmt->execute();
    $sesions_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sesions = array();
    //var_dump($sesions_db)

    foreach ($sesions_db as $sesion) {
      array_push($sesions, new Sesion($sesion["ID_SESION"], $sesion["FECHA"], $sesion["HORA"], $sesion["OBSERVACIONES"]));
    }
    return $sesions;

  }

  public function findSesionById($id){
    $stmt = $this->db->prepare("SELECT * FROM SESION WHERE ID_SESION=?");
    $stmt->execute(array($id));
    $sesion = $stmt->fetch(PDO::FETCH_ASSOC);

    if($sesion != null){
      return new Sesion(
        $sesion["ID_SESION"],
        $sesion["FECHA"],
        $sesion["HORA"],
        $sesion["OBSERVACIONES"]);
    }else{
      return NULL;
    }
  }

  public function update(Sesion $sesion){
    $stmt = $this->db->prepare("UPDATE SESION set FECHA=?, HORA=?, OBSERVACIONES=? where ID_SESION=?");
		$stmt->execute(array($sesion->getDateSesion(), $sesion->getHour(), $sesion->getObservation(), $sesion->getIdSesion()));
	}

  public function delete($sesion){
		$stmt = $this->db->prepare("DELETE from SESION WHERE ID_SESION=?");
		$stmt->execute(array($sesion->getIdSesion()));
	}

  public function add(Sesion $sesion){
   $stmt = $this->db->prepare("INSERT INTO SESION(OBSERVACIONES,FECHA,HORA) values (?,?,?)");
   $stmt->execute(array($sesion->getObservation(), $sesion->getDateSesion(), $sesion->getHour()));
   return $this->db->lastInsertId();
 }
}
 ?>
