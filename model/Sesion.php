<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/SesionMapper.php");

class Sesion{

  private $observation;
  private $dateSesion;
  private $hour;
  private $id_sesion;

  public function __construct($id_sesion=NULL, $dateSesion=NULL,$hour=NULL,$observation=NULL){
    $this->observation = $observation;
    $this->dateSesion = $dateSesion;
    $this->hour = $hour;
    $this->id_sesion = $id_sesion;

  }
  public function setObservation($observation){
		$this->observation = $observation;
	}

  public function setDay($dateSesion){
		$this->dateSesion= $dateSesion;
	}
  public function setHour($hour){
		$this->hour = $hour;
	}

//Validation for add Sesions
  public function ValidSesion(){
    $errors= array();
    $this->SesionMapper = new SesionMapper();
    if(strlen($this->observation) > 255 ){
      $errors["Observation"] = "Observation must be less than 255 characters length.";
    }if(sizeof($errors)>0){
      throw new ValidationException($errors, "Sesion is not valid");
    }
  }


  public function getObservation(){
		return $this->observation;
	}

  public function getDateSesion(){
		return $this->dateSesion;
	}

  public function getHour(){
		return $this->hour;
	}

  public function getIdSesion(){
    return $this->id_sesion;
  }
}


?>
