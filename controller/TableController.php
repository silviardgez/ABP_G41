<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Table.php");
require_once(__DIR__."/../model/TableMapper.php");
require_once(__DIR__."/../model/ExerciseMapper.php");
require_once(__DIR__."/../model/TrainingMapper.php");
require_once(__DIR__."/../model/Training.php");


require_once(__DIR__."/../controller/BaseController.php");


class TableController extends BaseController {

	private $trainingMapper;
	private $exerciseMapper;
	private $tableMapper;

	public function __construct() {
		parent::__construct();

		$this->tableMapper = new TableMapper();
		$this->exerciseMapper = new ExerciseMapper();
		$this->trainingMapper = new TrainingMapper();

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


	//Elimina todas las actividades con el mismo nombre
	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Table id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting activity requires login");
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

	public function deletecurrent(){
		if (!isset($_POST["id"])) {
			throw new Exception("Table id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting activity requires login");
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

		$this->view->setFlash(sprintf(i18n("Training \"%s\" successfully deleted."), $tableId));
		//$this->view->redirect("table", "edit");
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

}