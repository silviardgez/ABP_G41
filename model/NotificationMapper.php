<?php
// file: model/NotificationMapper.php

require_once(__DIR__."/../core/PDOConnection.php");


class NotificationMapper {

	private $db;

	public function __construct() {
		$this->db = PDOConnection::getInstance();
	}

  public function selectAllNotifications(User $user){
    $stmt = $this->db->prepare("SELECT * FROM NOTIFICACION WHERE DESTINATARIO=? ORDER BY ID_NOTIFICACION");
		$stmt->execute(array($user->getUsername()));
		$notifications_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$notification = array();

		foreach ($notifications_db as $notifications) {
			array_push($notification, new Notification($notifications["ID_NOTIFICACION"], $notifications["REMITENTE"], $notifications["DESTINATARIO"], $notifications["ASUNTO"], $notifications["MENSAJE"]));
		}

		return $notification;
  }

  public function delete($notification){
		$stmt = $this->db->prepare("DELETE from NOTIFICACION WHERE ID_NOTIFICACION=?");
		$stmt->execute(array($notification->getId()));
	}

  public function add(Notification $notification){
		$stmt = $this->db->prepare("INSERT INTO NOTIFICACION(REMITENTE,DESTINATARIO,ASUNTO,MENSAJE) values (?,?,?,?)");
		$stmt->execute(array($notification->getSender(), $notification->getAddressee(), $notification->getSubject(), $notification->getMessage()));
		return $this->db->lastInsertId();
	}

  public function findNotificationById($id){
    $stmt = $this->db->prepare("SELECT * FROM NOTIFICACION WHERE ID_NOTIFICACION=?");
		$stmt->execute(array($id));
		$notification = $stmt->fetch(PDO::FETCH_ASSOC);

		if($notification != null) {
			return new Notification(
				$notification["ID_NOTIFICACION"],
				$notification["REMITENTE"],
				$notification["DESTINATARIO"],
				$notification["ASUNTO"],
				$notification["MENSAJE"]);
		} else {
			return NULL;
		}
  }

	public function selectUsersPEF(User $user){
		$stmt = $this->db->prepare("SELECT DISTINCT DNI_USUARIO FROM ENGLOBA WHERE DNI_ENTRENADOR=?");
		$stmt->execute(array($user->getUsername()));
		$users_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

		$user = array();

		foreach ($users_db as $users) {
			array_push($user, new User($users["DNI_USUARIO"]));
		}

		return $user;
	}

}
