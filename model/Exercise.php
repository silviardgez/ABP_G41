<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/ExerciseMapper.php");

class Exercise{

	private $id_exercise;
	private $name;
	private $type;
	private $desciption;
	private $image;
	private $video;

	public function __construct($id_exercise=NULL, $name=NULL, $type=NULL, $description=NULL, $image=NULL, $video=NULL){
		$this->id_exercise = $id_exercise;
		$this->type = $type;
		$this->name = $name;
		$this->description = $description;
		$this->image = $image;
		$this->video = $video;
	}

	//Setters
	public function setId($id_exercise){
		$this->id_exercise = $id_exercise;
	}

	public function setDescription($description){
		$this->description = $description;
	}

	public function setImage($image){
		$this->image = $image;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function setType($type){
		$this->type = $type;
	}

	public function setVideo($video){
		$this->video = $video;
	}

	//Validations for add exercises
	public function ValidRegister(){
		$errors = array();
		if (strlen($this->name) < 5 ) {
			$errors["name"] = "Name must be at least 5 characters length";
		}
		if (strlen($this->description) > 255 ) {
			$errors["description"] = "The description must have less than 256 characters";
		}
		if (sizeof($errors)>0){
			throw new ValidationException($errors, "Exercise is not valid");
		}
	}

	//Getters
	public function getId(){
		return $this->id_exercise;
	}

	public function getDescription(){
		return $this->description;
	}

	public function getType(){
		return $this->type;
	}

	public function getName(){
		return $this->name;
	}

	public function getImage(){
		return $this->image;
	}

	public function getVideo(){
		return $this->video;
	}

	//Update Validate
	public function checkIsValidForUpdate() {
		$errors = array();

		if (!isset($this->name)) {
			$errors["name"] = "Name is mandatory";
		}
		if (!isset($this->id_exercise)) {
			$errors["id"] = "Id is mandatory";
		}
	}

}

?>
