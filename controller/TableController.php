<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");
require_once(__DIR__."/../model/ExerciseMapper.php");
require_once(__DIR__."/../model/TrainingMapper.php");
require_once(__DIR__."/../model/Training.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/User.php");


require_once(__DIR__."/../controller/BaseController.php");


class TableController extends BaseController {

	private $trainingMapper;
	private $exerciseMapper;
	private $tableMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->tableMapper = new TableMapper();
		$this->exerciseMapper = new ExerciseMapper();
		$this->trainingMapper = new TrainingMapper();
		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}


	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}

		$tables_id = $this->tableMapper->getIdTablesWithExercises();
		
		$tables = array();
		
		//Clasificamos según el tipo de tabla
		foreach ($tables_id as $id) {
			$tables_db = $this->tableMapper->getTables($id);
			$cardio = array();
			$muscular = array();
			$est = array();

			foreach ($tables_db as $table) {
				$training = $this->trainingMapper->getTrainingById($table->getTrainingId());
				$exerciseId = $training->getExerciseId();
				$repeats = $training->getRepeats();
				$time = $training->getTime();
				$exerciseType = $this->exerciseMapper->getTypeById($exerciseId);
				$exercisePhoto = $this->exerciseMapper->findPhotoById($exerciseId);
				$exerciseName = $this->exerciseMapper->getNameById($exerciseId);
				if($exerciseType == "CARDIO"){
					array_push($cardio, array($exerciseId, $exercisePhoto, $exerciseName, $exerciseType, $repeats, $time));
				} elseif ($exerciseType == "MUSCULAR") {
					array_push($muscular, array($exerciseId, $exercisePhoto, $exerciseName, $exerciseType, $repeats, $time));
				} elseif ($exerciseType == "ESTIRAMIENTO") {
					array_push($est, array($exerciseId, $exercisePhoto, $exerciseName, $exerciseType, $repeats, $time));
				}
			}

			array_push($tables, array($cardio,$muscular,$est));

		}

		// put the users object to the view
		$this->view->setVariable("tables", $tables);
		$this->view->setVariable("tables_id", $tables_id);
		$this->view->render("table", "show");
	}
	
	//Enseña los usuarios asignados a una tabla
	public function showusers(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}
		
		$tableId = $_REQUEST["id"];
		$users = $this->userMapper->showUsers($tableId);
		
		// put the users object to the view
		$this->view->setVariable("users", $users);
		$this->view->setVariable("tableId", $tableId);

		$this->view->render("table", "showusers");
	}


	//Elimina todas las actividades con el mismo nombre
	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Table id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Delete a table requires login");
		}

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}*/

		$tableId = $_REQUEST["id"];
		$table = $this->tableMapper->getTableById($tableId);

		if ($table == NULL) {
			throw new Exception("no such table with id: ". $tableId);
		}

		$this->tableMapper->delete($tableId);

		$this->view->setFlash(sprintf(i18n("Tabla \"%s\" successfully deleted."), $tableId));
		$this->view->redirect("table", "show");
	}
	
	//Elimina todas las actividades con el mismo nombre
	public function deleteuser(){
		if (!isset($_POST["id"])) {
			throw new Exception("DNI is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Delete a table requires login");
		}
		
		/*if($this->userMapper->findType() != "admin"){
		 throw new Exception("You aren't an admin. Deleting an user requires be admin");
		 }*/
		
		$tableId = $_REQUEST["idtable"];
		$dni = $_REQUEST["id"];
		
		
		$this->tableMapper->deleteUserFromTable($tableId, $dni);
		
		$this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted to table \"%s\."), $tableId, $dni));
		$this->view->redirect("table", "showusers", "id=$tableId");
	}

	public function deletecurrent(){
		if (!isset($_POST["id"])) {
			throw new Exception("Table id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Delete a table requires login");
		}

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}*/

		$trainingId = $_REQUEST["id"];
		$tableId = $_REQUEST["idtable"];
		$table = $this->tableMapper->getTableById($tableId);

		if ($table == NULL) {
			throw new Exception("no such table with id: ". $tableId);
		}
		
		$this->tableMapper->deletecurrent($tableId, $trainingId);

		$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully deleted."), $trainingId));
		$this->view->redirect("table", "edit", "id=$tableId");
	}

	public function edit(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A table id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}

		// Get the User object from the database
		$tableId = $_REQUEST["id"];
		$table = $this->tableMapper->getTableById($tableId);

		if ($table == NULL) {
			throw new Exception("no such table with id: ". $activityId);
		}

		$trainings_db = $this->tableMapper->getTables($tableId);
		$trainings = array();

		foreach ($trainings_db as $table) {
			$training = $this->trainingMapper->getTrainingById($table->getTrainingId());
			array_push($trainings, array($training->getTrainingId(), $this->exerciseMapper->getNameById($training->getExerciseId()), $training->getRepeats(), $training->getTime()));
		}
		
		$totalTrainings_db = $this->tableMapper->getTrainings($tableId);
		$totalTrainings = array();
		
		foreach($totalTrainings_db as $training) {
		$exerciseId = $training->getExerciseId();
		$totalTrainings[$training->getTrainingId()] = $this->exerciseMapper->getNameById($exerciseId) . " (" . $training->getRepeats() . ", " . substr($training->getTime(), 3) .")";
		}

		if (isset($_POST["submit"])) { 
			$table->setType($_POST["type"]);

			try {

				$this->tableMapper->update($table);

				$this->view->setFlash(sprintf(i18n("Table \"%s\" successfully updated."), $table->getTableId()));

				$this->view->redirect("table", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("table", $table);
		$this->view->setVariable("trainings", $trainings);
		$this->view->setVariable("totaltrainings", $totalTrainings);
		$this->view->render("table", "edit");
	}

	public function add(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}
		$table = new Table();

		if (isset($_POST["submit"])) { 
			$table->setType($_POST["type"]);

			try {

				$this->tableMapper->add($table);

				$this->view->setFlash(sprintf(i18n("Table \"%s\" successfully added."), $table->getTableId()));

				$this->view->redirect("table", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("table", $table);

		$this->view->render("table", "add");
	}
	
	public function addtraining(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}
		
		if (isset($_POST["addtraining"])) {
			$training = $_REQUEST["training"];
			$tableId = $_REQUEST["idtable"];
			try {
				
				$this->tableMapper->addTraining($training, $tableId);
				
				$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully added."), $training));
				
				$this->view->redirect("table", "edit", "id=$tableId");
				
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
	}
	
	public function adduser(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A table id is mandatory");
		}
		
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}
		
		$table = $_REQUEST["id"];
		$athletes = $this->userMapper->getAthletesWithoutTable($table);
		
		if (isset($_POST["submit"])) {
			$user = $_REQUEST["athlete"];
			$table = $_REQUEST["id"];
			
			try {
							
				$this->tableMapper->addUser($table, $user);
				
				$this->view->setFlash(sprintf(i18n("User \"%s\" successfully added to table \"%s\"."), $user, $table));
				
				$this->view->redirect("table", "show");
				
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		
		$this->view->setVariable("athletes", $athletes);
		$this->view->setVariable("table", $table);
		$this->view->render("table", "adduser");
	}

}