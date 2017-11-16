<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Exercise.php");
require_once(__DIR__."/../model/ExerciseMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ExercisesController extends BaseController {

	
	private $exerciseMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->exerciseMapper = new ExerciseMapper();
		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show exercises requires login");
		}

		$exercises = $this->exerciseMapper->showAllExercises();

		// put the exercises object to the view
		$this->view->setVariable("exercises", $exercises);

		// render the view (/view/exercises/show.php)
		$this->view->render("exercises", "show");
	}

	public function edit(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("An exercise id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing exercise requires login");
		}

		if($this->userMapper->findType() != "admin" && $this->userMapper->findType() != "entrenador"){
			throw new Exception("You aren't an admin or a coach. Editing an exercise requires be admin or coach");
		}

		// Get the Exercise object from the database
		$exerciseid = $_REQUEST["id"];
		$exercise = $this->exerciseMapper->findExerciseById($exerciseid);

		if ($exercise == NULL) {
			throw new Exception("no such exercise with id: ".$exerciseid);
		}

		if (isset($_POST["submit"])) { 
			$exercise->setName($_POST["nombre"]);
			//If the image does not change, it is not overwritten
			if($_POST["imagen"] != "") $exercise->setImage($_POST["imagen"]);
			//If the video does not change, it is not overwritten
			if($_POST["video"] != "") $exercise->setVideo($_POST["video"]);
			$exercise->setType($_POST["tipo"]);

			try {

				//validate exercise object
				$exercise->checkIsValidForUpdate(); // if it fails, ValidationException

				$this->exerciseMapper->update($exercise);

				$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully updated."),$exercise ->getName()));

				$this->view->redirect("exercises", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setVariable("exercise", $exercise);

		$this->view->render("exercises", "edit");
	}

	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting exercises requires login");
		}
		if($this->userMapper->findType() != "admin" && $this->userMapper->findType() != "entrenador"){
			throw new Exception("You aren't an admin or a coach. Deleting an exercise requires be admin or coach");
		}

		
		$exerciseid = $_REQUEST["id"];
		$exercise = $this->exerciseMapper->findExerciseById($exerciseid);

		if ($exercise == NULL) {
			throw new Exception("no such exercise with id: ".$exerciseid);
		}

		$this->exerciseMapper->delete($exercise);

		$this->view->setFlash(sprintf(i18n("Exercise \"%s\" successfully deleted."),$exercise ->getName()));

		$this->view->redirect("exercises", "show");
	}

	public function view(){
		if (!isset($_GET["id"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Exercises requires login");
		}

		$exerciseid = $_GET["id"];

		// find the Exercise object in the database
		$exercise = $this->exerciseMapper->findExerciseById($exerciseid);

		if ($exercise == NULL) {
			throw new Exception("no such exercise with id: ".$exerciseid);
		}

		// put the exercise object to the view
		$this->view->setVariable("exercise", $exercise);

		// render the view (/view/exercises/view.php)
		$this->view->render("exercises", "view");
	}

	public function add(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding exercises requires login");
		}

		if($this->userMapper->findType() != "admin" && $this->userMapper->findType() != "entrenador"){
			throw new Exception("You aren't an admin or a coach. Adding an exercise requires be admin or coach");
		}

		$exercise = new Exercise();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the exercise object with data form the form
			$exercise->setName($_POST["name"]);
			$exercise->setType($_POST["type"]);
			$exercise->setImage($_POST["image"]);
			$exercise->setVideo($_POST["video"]);

			try {
				// validate exercise object
				$exercise->ValidRegister(); //if it fails, ValidationException

				//save the exercise object into the database
				$this->exerciseMapper->add($exercise);

				$this->view->setFlash(sprintf(i18n("exercise \"%s\" successfully added."),$exercise ->getName()));

				$this->view->redirect("exercises", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the exercise object visible to the view
		$this->view->setVariable("exercise", $exercise);
		// render the view (/view/exercises/add.php)
		$this->view->render("exercises", "add");
	}


}
