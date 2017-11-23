<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

//require_once(__DIR__."/../model/Notification.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class NotificationsController extends BaseController {

	
	private $activityMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->activityMapper = new ActivityMapper();
		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show notifications requires login");
		}

		$activities = $this->activityMapper->selectAllActivities();
		$users = $this->userMapper->showAllUsers();

		$this->view->setVariable("activities", $activities);
		$this->view->setVariable("users", $users);

		// render the view (/view/notifications/show.php)
		$this->view->render("notifications", "show");
	}

	//manda un email a un usuario en concreto
	public function add(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show notifications requires login");
		}

		if($this->userMapper->findType() != "admin" && $this->userMapper->findType() != "entrenador"){
			throw new Exception("You aren't an admin or a coach. Adding an notification requires be admin or coach");
		}

		$dni = $_REQUEST["dni"];
		$email = $_REQUEST["email"];


		if(isset($_POST["submit"])) { // reaching via HTTP notification...

			$subject = $_REQUEST["subject"];
			$message = $_REQUEST["message"];



			$this->sendEmail($email, $subject, $message);

			$this->view->setFlash(sprintf(i18n("An email was sent.")));

			$this->view->redirect("notifications", "show");


		}

		$this->view->setVariable("dni", $dni);
		$this->view->setVariable("email", $email);
		// render the view (/view/notifications/add.php)
		$this->view->render("notifications", "add");
	}

	//manda un email a todos los usuarios que estan inscritos en una clase
	public function addGroup(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show notifications requires login");
		}

		if($this->userMapper->findType() != "admin" && $this->userMapper->findType() != "entrenador"){
			throw new Exception("You aren't an admin or a coach. Adding an notification requires be admin or coach");
		}

		$id = $_REQUEST["id"];

		if(isset($_POST["submit"])){

			$subject = $_REQUEST["subject"];
			$message = $_REQUEST["message"];

			$email = $this->activityMapper->selectEmail($id);

			$this->sendEmail($email, $subject, $message);

			$this->view->setFlash(sprintf(i18n("An email was sent.")));

			$this->view->redirect("notifications", "show");
		}

		$this->view->setVariable("id",$id);

		// render the view (/view/notifications/addGroup.php)
		$this->view->render("notifications", "addGroup");
	}


	public function sendEmail($email,$subject,$message){
		require_once(__DIR__."/../PHPMailer_5.2.4/class.phpmailer.php");

		//Receive all the parameters of the form
		$para = $email;
		$asunto = $subject;
		$mensaje = $message;

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

}
