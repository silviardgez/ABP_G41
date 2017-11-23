<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/BookMapper.php");

class Book{

  private $id_act;
  private $id_athl;
  private $dateBook;
  private $hour;
  private $confirmed;


  public function __construct($id_act=NULL, $id_athl=NULL,$dateBook=NULL,$hour=NULL,$confirmed=NULL){
    $this->id_act = $id_act;
    $this->id_athl = $id_athl;
    $this->dateBook = $dateBook;
    $this->hour = $hour;
    $this->confirmed = $confirmed;

  }
  public function setIdAct($id_act){
    $this->id_act = $id_act;
  }
  public function setIdAthl($id_athl){
    $this->id_athl = $id_athl;
  }
  public function setDateBook($dateBook){
		$this->dateBook = $dateBook;
	}

  public function setConfirmed($confirmed){
		$this->confirmed= $confirmed;
	}
  public function setHour($hour){
		$this->hour = $hour;
	}


  public function getIdAct(){
		return $this->id_act;
	}

  public function getIdAthl(){
		return $this->id_athl;
	}

  public function getDateBook(){
    return $this->dateBook;
  }

  public function getHour(){
		return $this->hour;
	}

  public function getConfirmed(){
    return $this->confirmed;
  }
}


?>
