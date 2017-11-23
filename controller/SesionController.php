<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Sesion.php");
require_once(__DIR__."/../model/SesionMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class SesionController extends BaseController {


	private $sesionMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->sesionMapper = new SesionMapper();
		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show sesions requires login");
		}

		$sesions = $this->sesionMapper->showAllSesions();


		// put the exercises object to the view
		$this->view->setVariable("sesions", $sesions);
    $this->view->setVariable("user",  $this->currentUser);


		// render the view (/view/exercises/show.php)
		$this->view->render("sesion", "show");
	}

	public function edit(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A sesion id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing sesion requires login");
		}

		if($this->userMapper->findType() != "deportista"){
			throw new Exception("You aren't an athlete. Editing a sesion requires be athlete");
		}

		// Get the Exercise object from the database
		$sesionid = $_REQUEST["id"];
		$sesion = $this->sesionMapper->findSesionById($sesionid);

		if ($sesion == NULL) {
			throw new Exception("No such sesion with id: ".$sesionid);
		}

		if (isset($_POST["submit"])) {
      //If the observation does not change, it is not overwritten
			if($_POST["observation"] != "") $sesion->setObservation($_POST["observation"]);
			//If the dateSEsion does not change, it is not overwritten
			if($_POST["dateSesion"] != "") $sesion->setDay($_POST["dateSesion"]);
			//If the hour does not change, it is not overwritten
			if($_POST["hour"] != "") $sesion->setHour($_POST["hour"]);


			try {

				//validate exercise object
				$sesion->checkIsValidForUpdate(); // if it fails, ValidationException

				$this->sesionMapper->update($sesion);

				$this->view->setFlash(sprintf(i18n("Sesion \"%s\" successfully updated."),$sesion ->getIdSesion()));

				$this->view->redirect("sesion", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setVariable("sesion", $sesion);

		$this->view->render("sesion", "edit");
	}

	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting sesions requires login");
		}
		if($this->userMapper->findType() != "deportista" ){
			throw new Exception("You aren't an athlete. Deleting an exercise requires be athlete");
		}


		$sesionid = $_REQUEST["id"];
		$sesion = $this->sesionMapper->findSesionById($sesionid);

		if ($sesion == NULL) {
			throw new Exception("no such sesion with id: ".$sesionid);
		}

		$this->sesionMapper->delete($sesion);

		$this->view->setFlash(sprintf(i18n("Session \"%s\" successfully deleted."),$sesion ->getIdSesion()));

		$this->view->redirect("sesion", "show");
	}

	public function view(){
		if (!isset($_GET["id"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View sesion requires login");
		}

		$sesionid = $_GET["id"];

		// find the Exercise object in the database
		$sesion = $this->sesionMapper->findSesionById($sesionid);

		if ($sesion == NULL) {
			throw new Exception("no such sesion with id: ".$sesionid);
		}

		// put the exercise object to the view
		$this->view->setVariable("sesion", $sesion);

		// render the view (/view/sesion/view.php)
		$this->view->render("sesion", "view");
	}

	public function add(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding sesions requires login");
		}

		if($this->userMapper->findType() != "deportista"){
			throw new Exception("You aren't an athlete. Adding a sesion requires be athlete");
		}

		$sesion = new Sesion();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the exercise object with data form the form
      $sesion->setObservation($_POST["observation"]);
			$sesion->setDay($_POST["dateSesion"]);
			$sesion->setHour($_POST["hour"]);
			try {
				// validate exercise object
				$sesion->ValidSesion(); //if it fails, ValidationException

				//save the exercise object into the database
				$id = $this->sesionMapper->add($sesion);

				$this->view->setFlash(sprintf(i18n("sesion \"%s\" successfully added."),$sesion ->getIdSesion()));

				$this->view->redirect("sesion", "view", "id=".$id);

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the exercise object visible to the view
		$this->view->setVariable("sesion", $sesion);
		// render the view (/view/exercises/add.php)
		$this->view->render("sesion", "add");
	}

  }
