<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Session.php");
require_once(__DIR__."/../model/SessionMapper.php");
require_once(__DIR__."/../model/ExerciseMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class SessionController extends BaseController {
	
	private $sessionMapper;
	
	public function __construct() {
		parent::__construct();
		
		$this->sessionMapper = new SessionMapper();
		
		$this->view->setLayout("welcome");
	}
	
	
	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}
		
		$personalSessions = NULL;
		
		if($_SESSION["entrenador"]) {
			$sessions = $this->sessionMapper->showAllSesions();
			if($_SESSION["deportista"]) {
				$personalSessions = $this->sessionMapper->showAllClientSesions($_SESSION["currentuser"]);
			}
		} else if($_SESSION["deportista"]){
			$sessions = $this->sessionMapper->showAllClientSesions($_SESSION["currentuser"]);
		} else {
			throw new Exception("You aren't an athlete or coach. View sessions requires be athlete or coach.");
		}
		
		
		// put the users object to the view
		$this->view->setVariable("sessions", $sessions);
		$this->view->setVariable("personalSessions", $personalSessions);
		
		// render the view (/view/users/show.php)
		$this->view->render("session", "show");
	}
	
	/*
	public function edit(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A id is mandatory");
		}
		
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing training requires login");
		}
		
		/*if($this->userMapper->findType() != "admin" || $this->userMapper->findType() != "entrenador"){
		 throw new Exception("You aren't an admin or coach. Editing a training requires be admin or coach.");
		 }*/
		
		/*// Get the User object from the database
		$trainingId = $_REQUEST["id"];
		$training = $this->trainingMapper->getTrainingById($trainingId);
		$exerciseId = $training->getExerciseId();
		$exerciseName = $this->exerciseMapper->findExerciseNameById($exerciseId);
		$exerciseType = $this->exerciseMapper->getTypeById($exerciseId);
		
		if ($training == NULL) {
			throw new Exception("no such training with id: ". $trainingId);
		}
		
		if (isset($_POST["submit"])) {
			$training->setExerciseId($_POST["exerciseId"]);
			$training->setRepeats($_POST["repeats"]);
			$training->setTime($_POST["time"]);
			
			try {
				//validate user object
				//$training->checkIsValidForUpdate(); // if it fails, ValidationException
				
				$this->trainingMapper->update($training);
				
				$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully updated."),
						$training->getTrainingId() . " " . $this->exerciseMapper->findExerciseNameById($training->getExerciseId())));
				
				$this->view->redirect("training", "show");
				
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setVariable("training", $training);
		$this->view->setVariable("exerciseName", $exerciseName);
		$this->view->setVariable("exerciseType", $exerciseType);
		$this->view->render("training", "edit");
	}
	
	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Training id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting training requires login");
		}
		
		/*if($this->userMapper->findType() != "admin"){
		 throw new Exception("You aren't an admin. Deleting an training requires be admin");
		 }*/
		
		/*$trainingId = $_REQUEST["id"];
		$training = $this->trainingMapper->getTrainingById($trainingId);
		
		if ($training == NULL) {
			throw new Exception("no such training with id: ". $trainingId);
		}
		
		$this->trainingMapper->delete($training);
		
		$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully deleted."), $trainingId));
		$this->view->redirect("training", "show");
	}
	
	public function add(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding activities requires login.");
		}
		
		/*if($this->userMapper->findType() != "admin" && $this->userMapper->findType() != "entrenador"){
		 throw new Exception("You aren't an admin or a coach. Adding an exercise requires be admin or coach");
		 }*/
		
		/*$training = new Training();
		
		$cardio = $this->exerciseMapper->getCardioExercises();
		$muscular = $this->exerciseMapper->getMuscularExercises();
		$est = $this->exerciseMapper->getEstExercises();
		
		$exercises = array($cardio,$muscular,$est);
		
		if(isset($_POST["submit"])) {
			
			$training->setExerciseId($_POST["exerciseId"]);
			$training->setRepeats($_POST["repeats"]);
			$training->setTime($_POST["time"]);
			
			try {
				//save the exercise object into the database
				$this->trainingMapper->add($training);
				
				$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully added."), $training->getTrainingId()));
				
				$this->view->redirect("training", "show");
				
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		
		$this->view->setVariable("training", $training);
		$this->view->setVariable("exercises", $exercises);
		$this->view->render("training", "add");
	} */
	
}