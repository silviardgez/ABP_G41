<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Session.php");
require_once(__DIR__."/../model/SessionMapper.php");
require_once(__DIR__."/../model/ExerciseMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class SessionController extends BaseController {
	
	private $sessionMapper;
	private $userMapper;
	
	public function __construct() {
		parent::__construct();
		
		$this->sessionMapper = new SessionMapper();
		$this->userMapper = new UserMapper();
		
		$this->view->setLayout("welcome");
	}
	
	
	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}
		
		//Cambios a la vista de entrenador
		if($_SESSION["deportista"] && !isset($_REQUEST["entrena"])){
			$sessions = $this->sessionMapper->showAllClientSessions($_SESSION["currentuser"]);
			$tables = $this->sessionMapper->getTablesByUser($_SESSION["currentuser"]);
			$user = $this->userMapper->findUserByDNI($_SESSION["currentuser"]);
			$name = $_SESSION["currentuser"] . " - " . $user->getName() . " " . $user->getSurname();
		} else if(isset($_REQUEST["entrena"]) && $_REQUEST["entrena"] == "true" && $_SESSION["entrenador"]){
			$sessions = $this->sessionMapper->showAllSessions($_SESSION["currentuser"]);
			foreach($sessions as $currentsession){
				$user = $this->userMapper->findUserByDNI($currentsession->getDNIUser());
				$currentsession->setDNIUser($currentsession->getDNIUser() . " - " . $user->getName() . " " . $user->getSurname());
			}
		} else if($_SESSION["entrenador"] && !$_SESSION["deportista"]){
			$sessions = $this->sessionMapper->showAllSessions($_SESSION["currentuser"]);
			foreach($sessions as $currentsession){
				$user = $this->userMapper->findUserByDNI($currentsession->getDNIUser());
				$currentsession->setDNIUser($currentsession->getDNIUser() . " - " . $user->getName() . " " . $user->getSurname());
			}
		} else {
			throw new Exception("You aren't an athlete or coach. View sessions requires be athlete or coach.");
		}
		
		if(isset($_GET["back"])){
			if(isset($_GET["on"])){
				$on = true;
				$this->view->setVariable("on", $on);
			} else {
				unset($_SESSION["crono"]);
			}
		}
		
		// put the users object to the view
		$this->view->setVariable("sessions", $sessions);

		if(isset($tables)) {
			$this->view->setVariable("tables", $tables);
		}

		if(isset($name)) {
			$this->view->setVariable("name", $name);
		}
		
		//Si el crono está iniciado no se pueden ver las otras sesiones
		if(isset($_SESSION["crono"]) && !isset($_GET["back"])){
			$this->view->render("session", "crono");
		} else {
			$this->view->render("session", "show");
		}
	}
	
	public function edit(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A id is mandatory");
		}
		
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session.");
		}

		if(!$_SESSION["deportista"]){
		 	throw new Exception("You aren't an athlete. Edit a session requires be athlete");
		}
		
		$dni = $this->sessionMapper->getUserById($_REQUEST["id"]);
		if ($_SESSION["currentuser"] != $dni) {
			throw new Exception("You aren't the user" . $dni . ".");
		}
		
		$sessionId = $_REQUEST["id"];
		$session = $this->sessionMapper->getSessionById($sessionId);
		$tables = $this->sessionMapper->getTablesByUser($dni);
		
		
		if ($session == NULL) {
			throw new Exception("no such session with id: ". $sessionId);
		}
		
		if (isset($_POST["submit"])) {
			$session->setIdClientTable($_POST["table"]);
			$session->setObservations($_POST["observations"]);
			
			try {
				$this->sessionMapper->update($session);
				
				$this->view->setFlash(sprintf(i18n("Session \"%s\" successfully updated."),
						$session->getSessionId()));
				
				$this->view->redirect("session", "show");
				
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		
		$this->view->setVariable("session", $session);
		$this->view->setVariable("tables", $tables);

		$this->view->render("session", "edit");
	} 

	public function view(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A id is mandatory");
		}
		
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session.");
		}

		if(!$_SESSION["deportista"] && !$_SESSION["entrenador"]){
		 	throw new Exception("You aren't an athlete. View a session requires be athlete or coach");
		}
		
		$dni = $this->sessionMapper->getUserById($_REQUEST["id"]);
		$sessionId = $_REQUEST["id"];
		$session = $this->sessionMapper->getSessionById($sessionId);
		
		
		if ($session == NULL) {
			throw new Exception("no such session with id: ". $sessionId);
		}
		
		$this->view->setVariable("session", $session);

		$this->view->render("session", "view");
	} 
	
	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Session id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session.");
		}
		
		if(!$_SESSION["deportista"]){
		 	throw new Exception("You aren't an athlete. Deleting a session requires be athlete");
		}
		
		$dni = $this->sessionMapper->getUserById($_POST["id"]);
		if ($_SESSION["currentuser"] != $dni) {
			throw new Exception("You aren't the user" . $dni . ".");
		}
		
		$sessionId = $_REQUEST["id"];
		$session = $this->sessionMapper->getSessionById($sessionId);
		
		if ($session == NULL) {
			throw new Exception("no such session with id: " . $sessionId);
		}
		
		$this->sessionMapper->delete($session);
		
		$this->view->setFlash(sprintf(i18n("Session \"%s\" successfully deleted."), $sessionId));
		$this->view->redirect("session", "show");
	}
	
	public function add(){
		unset($_SESSION["crono"]);
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding activities requires login.");
		}
		
		if(!$_SESSION["deportista"]){
			throw new Exception("You aren't an athlete. Add a session requires be athlete");
		}
		
		$tables = $this->sessionMapper->getTablesByUser($_SESSION["currentuser"]);
		
		$session = new Session();
		
	
		if(isset($_POST["submit"])) {
			$session->setIdClientTable($_POST["table"]);
			$session->setSessionDay($_POST["day"]);
			$session->setSessionHourIni($_POST["startTime"]);
			$session->setSessionHourFin($_POST["endTime"]);
			$session->setDuration($_POST["duration"]);
			$session->setObservations($_POST["observations"]);
			
			try {
				$this->sessionMapper->add($session);
				
				$this->view->setFlash(sprintf(i18n("Session \"%s\" successfully added."), $session->getSessionId()));
				
				$this->view->redirect("session", "show");	
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		
		$this->view->setVariable("session", $session);
		$this->view->setVariable("tables", $tables);
		$this->view->render("session", "add");
	}

	public function crono(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}
		
		$_SESSION["crono"] = true;
		//Cambios a la vista de entrenador
		if(!$_SESSION["deportista"]){
			throw new Exception("You aren't an athlete. Add a session requires be athlete.");
		}

		$this->view->render("session", "crono");
	}
	
}