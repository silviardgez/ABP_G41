<?php

require_once(__DIR__."/../core/ValidationException.php");
require_once(__DIR__."/../model/NotificationMapper.php");

class Notification{

	private $id_notification;
	private $sender;
	private $addressee;
	private $subject;
	private $message;

	public function __construct($id_notification=NULL, $sender=NULL, $addressee=NULL, $subject=NULL, $message=NULL){
		$this->id_notification = $id_notification;
		$this->sender = $sender;
		$this->addressee = $addressee;
		$this->subject = $subject;
		$this->message = $message;
	}

	//Setters
	public function setId($id_notification){
		$this->id_notification = $id_notification;
	}

	public function setSender($sender){
		$this->sender = $sender;
	}

	public function setAddressee($addressee){
		$this->addressee = $addressee;
	}

	public function setSubject($subject){
		$this->subject = $subject;
	}

	public function setMessage($message){
		$this->message = $message;
	}


	//Getters
	public function getId(){
		return $this->id_notification;
	}

	public function getSender(){
		return $this->sender;
	}

	public function getAddressee(){
		return $this->addressee;
	}

	public function getSubject(){
		return $this->subject;
	}

	public function getMessage(){
		return $this->message;
	}

}

?>
