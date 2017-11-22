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
			throw new Exception("Not in session. Show users requires login");
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

		if($this->userMapper->findType() == "deportista"){
			throw new Exception("You aren't an admin or a coach. View an user requires be admin or coach");
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
			if(isset($_POST["administrador"]) && $_POST["administrador"] == "1"){
				$user->setAdmin(1);
			}
			if(isset($_POST["deportista"]) && $_POST["deportista"] == "1"){
				$user->setDeportist(1);
			}
			if(isset($_POST["entrenador"]) && $_POST["entrenador"] == "1"){
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
	}

	public function recover(){

		$user = new User();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the user object with data form the form
			$user->setUsername($_POST["dni"]);
			$user->setEmail($_POST["email"]);

			try {
				// validate user object
				$user->ValidRecover($_POST["dni"], $_POST["email"]); // if it fails, ValidationException

				//send email to the user
				$this->sendEmail($user);

				$this->view->setFlash(sprintf(i18n("An email was sent to \"%s\"."),$user ->getEmail()));

				$this->view->redirect("login", "index");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the user object visible to the view
		$this->view->setVariable("user", $user);
		// render the view (/view/login/recover.php)
		$this->view->render("login", "recover");
	}

	public function sendEmail(User $user){
		require_once(__DIR__."/../PHPMailer_5.2.4/class.phpmailer.php");

		//Receive all the parameters of the form
		$para = $user->getEmail();
		$asunto = "Recuperación de Contraseña//Password Recovery";
		$mensaje = "Puede recuperar su contraseña haciendo click en el siguiente enlace:\nYou can retrieve your password by clicking on the following link:\n\nhttp://localhost/abp/index.php?controller=users&action=newpass";

		//This block is important
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = "ssl";
		$mail->Host = "smtp.gmail.com";
		$mail->Port = 465;
		// Activate condification utf-8
		$mail->CharSet = 'UTF-8';

		//Our account
		$mail->Username ='bsbasports@gmail.com';
		$mail->Password = 'asignaturaabp'; //Su password

		//Add recipient
		$mail->AddAddress($para);
		$mail->Subject = $asunto;
		$mail->Body = $mensaje;
		//To attach file
		//$mail->AddAttachment($archivo['tmp_name'], $archivo['name']);
		$mail->MsgHTML($mensaje);

		//Send email
		$mail->Send();

	}

	public function newpass(){
		$user = new User();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			$dni = $_POST["dni"];
			$pass = $_POST["pass"];

			try {
				$user->setUsername($dni);
				$user->setPass($pass);
				// validate user object
				$user->ValidRecoverPass($dni, $pass, $_POST["rpass"]); // if it fails, ValidationException

				$user2 = $this->userMapper->findUserByDNI($dni);
				
				//save the user object into the database
				$user2->setPass(md5($pass));
				$this->userMapper->update($user2);

				$this->view->setFlash(sprintf(i18n("User \"%s\" successfully updated."),$user2 ->getName()));

				$this->view->redirect("login", "index");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the user object visible to the view
		//$this->view->setVariable("user", $user);
		// render the view (/view/login/recover.php)
		$this->view->render("login", "newpassword");
	}
}
