<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ActivityController extends BaseController {

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
			throw new Exception("Not in session. Show users requires login");
		}
		$grupalActivitiesName = $this->activityMapper->getGrupalActivitiesName();
		$grupalActivitiesMonday = $this->activityMapper->getGrupalActivities("LUNES");
		$grupalActivitiesTuesday = $this->activityMapper->getGrupalActivities("MARTES");
		$grupalActivitiesWednesday = $this->activityMapper->getGrupalActivities("MIERCOLES");
		$grupalActivitiesThursday = $this->activityMapper->getGrupalActivities("JUEVES");
		$grupalActivitiesFriday = $this->activityMapper->getGrupalActivities("VIERNES");
		$grupalActivitiesSaturday = $this->activityMapper->getGrupalActivities("SABADO");
		$grupalActivitiesSunday = $this->activityMapper->getGrupalActivities("DOMINGO");
		$grupalActivities = array($grupalActivitiesMonday, $grupalActivitiesTuesday, $grupalActivitiesWednesday,
			$grupalActivitiesThursday, $grupalActivitiesFriday, $grupalActivitiesSaturday, $grupalActivitiesSunday);
		// put the users object to the view
		$this->view->setVariable("activitiesName", $grupalActivitiesName);
		$this->view->setVariable("grupalActivities", $grupalActivities);

		// render the view (/view/users/show.php)
		$this->view->render("activity", "show");
	}

	//Elimina todas las actividades con el mismo nombre
	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Activity name is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting activity requires login");
		}

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}*/

		$activityName = $_REQUEST["id"];
		$activities = $this->activityMapper->getActivitiesByName($activityName);

		if ($activities == NULL) {
			throw new Exception("no such activity with name: ". $activityName);
		}

		$this->activityMapper->delete($activityName);

		$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."), $activityName));
		$this->view->redirect("activity", "show");
	}

	//Elimina una actividad en concreto
	public function deletecurrent(){
		if (!isset($_POST["id"])) {
			throw new Exception("Activity id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting activity requires login");
		}

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}*/

		$activityId = $_REQUEST["id"];
		$activity = $this->activityMapper->getActivityById($activityId);

		if ($activity == NULL) {
			throw new Exception("no such activity with id: ". $activityId);
		}

		$this->activityMapper->deleteCurrent($activity);

		$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."), $activityId));
		$this->view->redirect("activity", "show");
	}


	public function edit(){
		if (!isset($_REQUEST["name"])) {
			throw new Exception("Activity name is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing activity requires login");
		}

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Editing an user requires be admin");
		}*/

		$activityName = $_REQUEST["name"];

		//Solo comprobamos en la primera llamada ya que el nombre es modificable
		if(!isset($_POST["submit"])){
			$activities = $this->activityMapper->getActivitiesByName($activityName);
			if ($activities == NULL) {
				throw new Exception("no such activity with name: ". $activityName);
			}
		}

		if (isset($_POST["submit"])) { 
			$activities = $_POST["activities"];
			foreach ($activities as $activity) {
				$activity->setActivityName($_POST["name"]);	
				$activity->setColor($_POST["color"]);
				try {
					$activity->checkIsValidForUpdate(); // if it fails, ValidationException
					$this->activityMapper->update($activity);

				} catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
					$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
					$this->view->setVariable("errors", $errors);
				}
			}

			$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully updated."), $activityName));
			$this->view->redirect("activity", "show");
		}

		$this->view->setVariable("activity", $activities[0]);
		$this->view->setVariable("activities", $activities);
		$this->view->render("activity", "edit");
	}

	public function editcurrent(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A activity id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing user requires login");
		}

		// Get the User object from the database
		$activityId = $_REQUEST["id"];
		$activity = $this->activityMapper->getActivityById($activityId);

		if ($activity == NULL) {
			throw new Exception("no such activity with id: ". $activityId);
		}

		$monitors = $this->userMapper->getCoaches();

		if (isset($_POST["submit"])) { 
			$activity->setStartTime($_POST["startTime"]);
			$activity->setEndTime($_POST["endTime"]);
			$activity->setDay($_POST["day"]);
			$activity->setMonitor($_POST["monitor"]);

			try {

				$this->activityMapper->updateCurrent($activity);

				$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully updated."), $activity->getActivityId(). " ". $activity->getActivityName()));

				$this->view->redirect("activity", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		$this->view->setVariable("activity", $activity);
		$this->view->setVariable("monitors", $monitors);

		$this->view->render("activity", "editcurrent");
	}

	public function showcurrent(){
		if (!isset($_GET["id"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Activity requires login.");
		}

		$activityId = $_GET["id"];

		// find the User object in the database
		$activity = $this->activityMapper->getActivityById($activityId);

		if ($activity == NULL) {
			throw new Exception("no such activity with id: ".$activityId);
		}

		// put the user object to the view
		$this->view->setVariable("activity", $activity);

		$this->view->render("activity", "showcurrent");
	}

}