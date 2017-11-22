<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Training.php");
require_once(__DIR__."/../model/TrainingMapper.php");
require_once(__DIR__."/../model/ExerciseMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class TrainingController extends BaseController {

	private $trainingMapper;
	private $exerciseMapper;

	public function __construct() {
		parent::__construct();

		$this->trainingMapper = new TrainingMapper();
		$this->exerciseMapper = new ExerciseMapper();

		$this->view->setLayout("welcome");
	}


	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}

		$grupalTrainings_db = $this->trainingMapper->getTrainings();
		$cardio = array();
		$muscular = array();
		$est = array();
		
		//Creamos 3 array con el nombre y el entrenamiento, para cada tipo
		foreach ($grupalTrainings_db as $training) {
			$exerciseId = $training->getExerciseId();
			$exerciseType = $this->exerciseMapper->getTypeById($exerciseId);
			$exerciseName = $this->exerciseMapper->findExerciseNameById($exerciseId);

			if($exerciseType == "CARDIO") {
				array_push($cardio, array($exerciseName, $training, $exerciseId));
			} else if ($exerciseType == "MUSCULAR") {
				array_push($muscular, array($exerciseName, $training, $exerciseId));
			} else {
				array_push($est, array($exerciseName, $training, $exerciseId));
			}
			
		}

		$grupalTrainings = array($cardio, $muscular, $est);

		// put the users object to the view
		$this->view->setVariable("grupalTrainings", $grupalTrainings);

		// render the view (/view/users/show.php)
		$this->view->render("training", "show");
	}


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

		// Get the User object from the database
		$trainingId = $_REQUEST["id"];
		$training = $this->trainingMapper->getTrainingById($trainingId);

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

				$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully updated."), $training->getTrainingId() . " " 							. $this->exerciseMapper->findExerciseNameById($training->getTrainingId())));

				$this->view->redirect("training", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setVariable("training", $training);

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
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}*/

		$trainingId = $_REQUEST["id"];
		$training = $this->trainingMapper->getTrainingById($trainingId);

		if ($training == NULL) {
			throw new Exception("no such training with id: ". $trainingId);
		}

		$this->trainingMapper->delete($training);

		$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully deleted."), $trainingId));
		$this->view->redirect("training", "show");
	}

}