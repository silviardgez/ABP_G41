<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ActivityController extends BaseController {

	private $activityMapper;

	public function __construct() {
		parent::__construct();

		$this->activityMapper = new ActivityMapper();

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

	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("DNI is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting activity requires login");
		}

		/*if($this->userMapper->findType() != "admin"){
			throw new Exception("You aren't an admin. Deleting an user requires be admin");
		}*/
	
		$activityName = $_REQUEST["id"];
		$activity = $this->activityMapper->findActivityByName($activityName);

		if ($activity == NULL) {
			throw new Exception("no such activity with name: ". $activityName);
		}

		$this->activityMapper->delete($activity);

		$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully deleted."), $activityName));

		$this->view->redirect("activity", "show");
	}

}