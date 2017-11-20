<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activitiesstatistics.php");
require_once(__DIR__."/../model/ActivitiesstatisticsMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ActivitiesstatisticsController extends BaseController {

	private $activitiesstatisticsMapper;

	public function __construct() {
		parent::__construct();

		$this->activitiesstatisticsMapper = new ActivitiesstatisticsMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		/*if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}*/

		/*if($this->assistanceMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. See all users requires be admin");
		}*/

		$activities = $this->activitiesstatisticsMapper->showAllActivities();

		// put the users object to the view
		$this->view->setVariable("activities", $activities);

		// render the view (/view/activitiesstatistics/show.php)
		$this->view->render("activitiesstatistics", "show");
	}

	public function view(){
		if (!isset($_GET["id_act"])) {
			throw new Exception("Id is mandatory");
		}

		/*if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Users requires login");
		}*/

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. View an user requires be admin");
		}*/

		$id = $_GET["id_act"];
		$confirmado=1;
		$deportista=1;

		// find the User object in the database
		$statistics = $this->activitiesstatisticsMapper->findStatistics($id, $confirmado, $deportista);

		if ($statistics == NULL) {
			throw new Exception("no such activities with ID: ".$id);
		}

		// put the user object to the view
		$this->view->setVariable("statistics", $statistics);

		// render the view (/view/users/view.php)
		$this->view->render("activitiesstatistics", "view");
	}
/*
	public function add(){
		
		/*if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding users requires login");
		}

		if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Adding an user requires be admin");
		}*/
/*		if (!isset($_GET["id_act"])) {
			throw new Exception("Id is mandatory");
		}
		
		$confirmado = 1;
		$id = $_GET["id_act"];
		$assistants = $this->assistanceMapper->showAllAssistants($id, $confirmado);
		
		$assistance = new Assistance();
		
		$assistance->setActivityid($id);

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the user object with data form the form
			$assistance->setActivityid($id);
			$assistance->setDni($_POST["asistente"]);
			$assistance->setDateassistance($_POST["fecha"]);
			$assistance->setTime($_POST["hora"]);

			try {
				//save the user object into the database
				$this->assistanceMapper->add($assistance);

				$this->view->setFlash(sprintf(i18n("assistance \"%s\" successfully added."),$assistance ->getDni()));
				
				//$this->view->redirect("assistance", "show");
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the user object visible to the view
		$this->view->setVariable("assistance", $assistance);
		$this->view->setVariable("assistants", $assistants);
		// render the view (/view/users/add.php)
		$this->view->render("assistance", "add");
	}
/*
	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("DNI is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting user requires login");
		}
		if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}

		
		$userdni = $_REQUEST["id"];
		$user = $this->userMapper->findUserByDNI($userdni);

		if ($user == NULL) {
			throw new Exception("no such user with DNI: ".$userdni);
		}

		$this->userMapper->delete($user);

		$this->view->setFlash(sprintf(i18n("User \"%s\" successfully deleted."),$user ->getUsername()));

		$this->view->redirect("users", "show");
	}

	public function edit(){
		if (!isset($_REQUEST["dni"])) {
			throw new Exception("A user DNI is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}

		if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Editing an user requires be admin");
		}

		// Get the User object from the database
		$userid = $_REQUEST["dni"];
		$user = $this->userMapper->findUserByDNI($userid);

		if ($user == NULL) {
			throw new Exception("no such user with DNI: ".$userid);
		}

		if (isset($_POST["submit"])) { 
			$user->setName($_POST["nombre"]);
			$user->setSurname($_POST["apellidos"]);
			$user->setDateBorn($_POST["fechaNac"]);
			$user->setEmail($_POST["email"]);
			$user->setTlf($_POST["tel"]);
			if($_POST["administrador"] == "1"){
				$user->setAdmin(1);
			}else{
				$user->setAdmin(NULL);
			}
			 if($_POST["deportista"] == "1"){
				$user->setDeportist(1);
			}else{
				$user->setDeportist(NULL);
			}
			if($_POST["entrenador"] == "1"){
				$user->setCoach(1);
			}else{
				$user->setCoach(NULL);
			}

			try {

				//validate user object
				$user->checkIsValidForUpdate(); // if it fails, ValidationException

				$this->userMapper->update($user);

				$this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user ->getUsername()));

				$this->view->redirect("users", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setVariable("user", $user);

		$this->view->render("users", "edit");
	}

	public function viewcurrent(){
		if (!isset($_GET["dni"])) {
			throw new Exception("DNI is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View User requires login");
		}

		$dni = $_GET["dni"];

		// find the User object in the database
		$user = $this->userMapper->findUserByDNI($dni);

		if ($user == NULL) {
			throw new Exception("no such user with DNI: ".$dni);
		}

		// put the user object to the view
		$this->view->setVariable("user", $user);

		// render the view (/view/users/viewcurrent.php)
		$this->view->render("users", "viewcurrent");
	}

	public function editcurrent(){
		if (!isset($_REQUEST["dni"])) {
			throw new Exception("A user DNI is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}

		// Get the User object from the database
		$userid = $_REQUEST["dni"];
		$user = $this->userMapper->findUserByDNI($userid);

		if ($user == NULL) {
			throw new Exception("no such user with DNI: ".$userid);
		}

		if (isset($_POST["newpass"])) { 
			$user->setName($_POST["nombre"]);
			$user->setSurname($_POST["apellidos"]);
			$user->setDateBorn($_POST["fechaNac"]);
			$user->setEmail($_POST["email"]);
			$user->setTlf($_POST["tel"]);

			try {

				//validate user object
				$user->checkIsValidForCurrentUpdate($_POST["pass"],$_POST["newpass"],$_POST["rpass"]); // if it fails, ValidationException

				$user->setPass(md5($_POST["newpass"]));

				$this->userMapper->update($user);

				$this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user ->getUsername()));

				$this->view->redirect("login", "home");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("user", $user);

		$this->view->render("users", "editcurrent");
	}*/
}
