<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class UsersController extends BaseController {

	
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}

	public function login() {
		if (isset($_POST["username"])){ 

			if ($this->userMapper->isValidUser($_POST["username"], $_POST["passwd"])) {

				$_SESSION["currentuser"]=$_POST["username"];

				$this->view->redirect("login", "home");

			}else{
				$errors = array();
				$errors["general"] = "Username is not valid";
				$this->view->setVariable("errors", $errors);
			}
		}

		// render the view (/view/login/login.php)
		$this->view->render("login", "login");
	}

	public function logout() {
		session_destroy();

		$this->view->redirect("login", "index");

	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Editing posts requires login");
		}

		if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. See all users requires be admin");
		}

		$users = $this->userMapper->showAllUsers();

		// put the users object to the view
		$this->view->setVariable("users", $users);

		// render the view (/view/users/show.php)
		$this->view->render("users", "show");
	}

	public function view(){
		if (!isset($_GET["dni"])) {
			throw new Exception("DNI is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Users requires login");
		}

		if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. View an user requires be admin");
		}

		$dni = $_GET["dni"];

		// find the User object in the database
		$user = $this->userMapper->findUserByDNI($dni);

		if ($user == NULL) {
			throw new Exception("no such user with DNI: ".$dni);
		}

		// put the user object to the view
		$this->view->setVariable("user", $user);

		// render the view (/view/users/view.php)
		$this->view->render("users", "view");
	}

	public function add(){
		
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding users requires login");
		}

		if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Adding an user requires be admin");
		}

		$user = new User();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the user object with data form the form
			$user->setName($_POST["nombre"]);
			$user->setSurname($_POST["apellidos"]);
			$user->setDateBorn($_POST["fechaNac"]);
			$user->setEmail($_POST["email"]);
			$user->setTlf($_POST["tel"]);
			$user->setUsername($_POST["dni"]);
			$user->setPass($_POST["pass"]);
			if($_POST["type"] == "administrador"){
				$user->setAdmin(1);
			}else if($_POST["type"] == "deportista"){
				$user->setDeportist(1);
			}else{
				$user->setCoach(1);
			}

			try {
				// validate user object
				$user->ValidRegister($_POST["rpass"]); // if it fails, ValidationException

				//save the user object into the database
				$this->userMapper->add($user);

				$this->view->setFlash(sprintf(i18n("user \"%s\" successfully added."),$user ->getUsername()));

				$this->view->redirect("users", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the user object visible to the view
		$this->view->setVariable("user", $user);
		// render the view (/view/users/add.php)
		$this->view->render("users", "add");
	}

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
			if($_POST["type"] == "administrador"){
				$user->setAdmin(1);
			}else if($_POST["type"] == "deportista"){
				$user->setDeportist(1);
			}else{
				$user->setCoach(1);
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
}
