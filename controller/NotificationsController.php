<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Notification.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/NotificationMapper.php");
require_once(__DIR__."/../controller/BaseController.php");


class NotificationsController extends BaseController {


	private $activityMapper;
	private $userMapper;
	private $notificationMapper;

	public function __construct() {
		parent::__construct();

		$this->activityMapper = new ActivityMapper();
		$this->userMapper = new UserMapper();
		$this->notificationMapper = new NotificationMapper();

		$this->view->setLayout("welcome");
	}

	public function view(){
		if (!isset($_GET["id"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Notifications requires login");
		}

		$notificationid = $_GET["id"];

		// find the Notification object in the database
		$notification = $this->notificationMapper->findNotificationById($notificationid);

		if ($notification == NULL) {
			throw new Exception("no such exercise with id: ".$exerciseid);
		}
		if($this->currentUser->getUsername() != $notification->getAddressee()){
			throw new Exception("The user is not the addressee of the email");
		}

		// put the notification object to the view
		$this->view->setVariable("notification", $notification);

		// render the view (/view/notifications/view.php)
		$this->view->render("notifications", "view");
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

		$notification = new Notification();

		if(isset($_POST["submit"])) { // reaching via HTTP notification...

			$subject = $_REQUEST["subject"];
			$message = $_REQUEST["message"];

			$notification->setSubject($_REQUEST["subject"]);
			$notification->setMessage($_REQUEST["message"]);
			$notification->setAddressee($dni);
			if($this->currentUser->getEmail()!=null){
				$notification->setSender($this->currentUser->getEmail());
			}else{
				$notification->setSender("bsbasports@gmail.com");
			}


			$this->sendEmail($email, $subject, $message);
			$this->notificationMapper->add($notification);

			$this->view->setFlash(sprintf(i18n("An email was sent.")));

			$this->view->redirect("notifications", "show");


		}

		$this->view->setVariable("dni", $dni);
		$this->view->setVariable("email", $email);
		// render the view (/view/notifications/add.php)
		$this->view->render("notifications", "add");
	}

	public function inbox(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show notifications requires login");
		}

		$emails = $this->notificationMapper->selectAllNotifications($this->currentUser);

		$this->view->setVariable("emails", $emails);

		// render the view (/view/notifications/inbox.php)
		$this->view->render("notifications", "inbox");
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

	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting exercises requires login");
		}

		$notificationid = $_REQUEST["id"];
		$notification = $this->notificationMapper->findNotificationById($notificationid);

		if ($notification == NULL) {
			throw new Exception("no such notification with id: ".$notificationid);
		}
		if($this->currentUser->getUsername() != $notification->getAddressee()){
			throw new Exception("The user is not the addressee of the email");
		}

		$this->notificationMapper->delete($notification);

		$this->view->setFlash(sprintf(i18n("Notification \"%s\" successfully deleted."),$notification ->getSubject()));

		$this->view->redirect("notifications", "inbox");
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
