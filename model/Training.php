<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/TrainingMapper.php");

class Training {

	private $trainingId;
	private $exerciseId;
	private $repeats;
	private $time;

	public function __construct($trainingId=NULL, $exerciseId=NULL, $repeats=NULL, $time=NULL){
		$this->trainingId = $trainingId;
		$this->exerciseId = $exerciseId;
		$this->repeats = $repeats;
		$this->time = $time;
	}

	public function setTrainingId($trainingId){
		$this->trainingId = $trainingId;
	}

	public function setExerciseId($exerciseId){
		$this->exerciseId = $exerciseId;
	}

	public function setRepeats($repeats){
		$this->repeats = $repeats;
	}

	public function setTime($time){
		$this->time = $time;
	}

	public function getTrainingId(){
		return $this->trainingId;
	}

	public function getExerciseId(){
		return $this->exerciseId;
	}

	public function getRepeats(){
		return $this->repeats;
	}

	public function getTime(){
		return $this->time;
	}

	//Update Validate
	public function checkIsValidForUpdate() {
		$errors = array();
		
		if (!isset($this->activityName)) {
			$errors["name"] = "Name is mandatory";
		}
		
	}
	
}

?>