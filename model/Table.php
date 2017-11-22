<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/TableMapper.php");

class Table {

	private $tableId;
	private $type;
	private $trainingId;

	public function __construct($tableId=NULL, $type=NULL, $trainingId=NULL,){
		$this->tableId = $tableId;
		$this->type = $type;
		$this->trainingId = $trainingId;
	}

	public function setTableId($tableId){
		$this->tableId = $tableId;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setTrainingId($trainingId){
		$this->trainingId = $trainingId;
	}

	public function getTableId(){
		return $this->tableId;
	}

	public function getType(){
		return $this->type;
	}

	public function getTrainingId(){
		return $this->trainingId;
	}
	
}

?>