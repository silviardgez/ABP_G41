<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/ActivityMapper.php");

class Activity {

	private $activityName;
	private $type;
	private $startTime;
	private $endTime;

	public function __construct($activityName=NULL, $type=NULL, $startTime=NULL, $endTime=NULL){
		$this->activityName = $activityName;
		$this->type = $type;
		$this->startTime = $startTime;
		$this->endTime = $endTime;
	}

	public function setActivityName($activityName){
		$this->activityName = $activityName;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setStartTime($startTime){
		$this->startTime = $startTime;
	}

	public function setEndTime($endTime){
		$this->endTime = $endTime;
	}

	public function getActivityName(){
		return $this->activityName;
	}

	public function getType(){
		return $this->type;
	}

	public function getStartTime(){
		return $this->startTime;
	}

	public function getEndTime(){
		return $this->endTime;
	}
	
}

?>