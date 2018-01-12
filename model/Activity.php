<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

class Activity {

	private $activityName;
	private $type;
	private $startTime;
	private $endTime;
	private $duration;
	private $day;
	private $monitor;
	private $color;
	private $activityId;
	private $aula;
	private $aulaName;

	public function __construct($activityId=NULL, $activityName=NULL, $type=NULL, $day=NULL, $startTime=NULL, $endTime=NULL, $color=NULL, $monitor=NULL, $aula=NULL, $aulaName=NULL, $duration=NULL){
		$this->activityId = $activityId;
		$this->activityName = $activityName;
		$this->type = $type;
		$this->day = $day;
		$this->startTime = $startTime;
		$this->endTime = $endTime;
		$this->duration = $duration;
		$this->color = $color;
		$this->monitor = $monitor;
		$this->aula = $aula;
		$this->aulaName = $aulaName;
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

	public function setColor($color){
		$this->color = $color;
	}

	public function setDay($day){
		$this->day = $day;
	}

	public function setMonitor($monitor){
		$this->monitor = $monitor;
	}

	public function setAula($aula){
		$this->aula = $aula;
	}

	public function setAulaName($aulaName){
		$this->aulaName = $aulaName;
	}

	public function getActivityId(){
		return $this->activityId;
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

	public function getDuration(){
		return $this->duration;
	}

	public function getColor(){
		return $this->color;
	}

	public function getDay(){
		return $this->day;
	}

	public function getMonitor(){
		return $this->monitor;
	}

	public function getAula(){
		return $this->aula;
	}

	public function getAulaName(){
		return $this->aulaName;
	}

	public function getMonitorName(){
		$userMapper = new UserMapper();
		return $userMapper->getNameByDNI($this->monitor);
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