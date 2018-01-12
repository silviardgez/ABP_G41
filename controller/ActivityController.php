<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activity.php");
require_once(__DIR__."/../model/ActivityMapper.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/BookMapper.php");
require_once(__DIR__."/../model/Book.php");

require_once(__DIR__."/../controller/BaseController.php");


class ActivityController extends BaseController {

	private $activityMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->activityMapper = new ActivityMapper();
		$this->userMapper = new UserMapper();
		$this->bookMapper = new BookMapper();

		$this->view->setLayout("welcome");
	}


	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}
		$grupalActivitiesName = $this->activityMapper->getGrupalActivitiesName();
		$grupalActivitiesMonday = $this->activityMapper->getGrupalActivities("MONDAY");
		$grupalActivitiesTuesday = $this->activityMapper->getGrupalActivities("TUESDAY");
		$grupalActivitiesWednesday = $this->activityMapper->getGrupalActivities("WEDNESDAY");
		$grupalActivitiesThursday = $this->activityMapper->getGrupalActivities("THURSDAY");
		$grupalActivitiesFriday = $this->activityMapper->getGrupalActivities("FRIDAY");
		$grupalActivitiesSaturday = $this->activityMapper->getGrupalActivities("SATURDAY");
		$grupalActivitiesSunday = $this->activityMapper->getGrupalActivities("SUNDAY");
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

		if(!$_SESSION["admin"] && !$_SESSION["entrenador"]){
			throw new Exception("You aren't an admin or coach. Delete an activity requires be admin or coach.");
		}

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

		if(!$_SESSION["admin"] && !$_SESSION["entrenador"]){
			throw new Exception("You aren't an admin or coach. Delete an activity requires be admin or coach.");
		}

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

		if(!$_SESSION["admin"] && !$_SESSION["entrenador"]){
			throw new Exception("You aren't an admin or coach. Edit an activity requires be admin or coach.");
		}

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

			$tmp = stripslashes($activities);
			$tmp = urldecode($tmp);
			$tmp = unserialize($tmp);

			foreach ($tmp as $activity) {
				$activity->setActivityName($_POST["name"]);
				$activity->setColor($_POST["color"]);
				try {

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

		$booking = $this->bookMapper->findBook($activityId, $this->currentUser->getUsername());
		$spaces = $this->bookMapper->availableSpaces($activityId);
		$monitors = $this->userMapper->getCoaches();
		$entrenador = $_SESSION["entrenador"];

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

		$this->view->setVariable("booking", $booking);
		$this->view->setVariable("spaces", $spaces);
		$this->view->setVariable("activity", $activity);
		$this->view->setVariable("monitors", $monitors);
		$this->view->setVariable("entrenador", $entrenador);

		$this->view->render("activity", "editcurrent");
	}

	public function add(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding activities requires login.");
		}

		if(!$_SESSION["admin"] && !$_SESSION["entrenador"]){
			throw new Exception("You aren't an admin or coach. Add an activity requires be admin or coach.");
		}

		$activity = new Activity();

		if(isset($_GET["name"])){
			$activityName = $_GET["name"];
		} else {
			$activityName = "";
		}

		$monitors = $this->userMapper->getCoaches();
		$aulas = $this->activityMapper->getAulas();

		if(isset($_POST["submit"])) {

			$activity->setActivityName($_POST["name"]);
			$activity->setStartTime($_POST["startTime"]);
			$activity->setEndTime($_POST["endTime"]);
			$activity->setDay($_POST["day"]);
			$activity->setMonitor($_POST["monitor"]);
			$activity->setColor($_POST["color"]);
			$activity->setAula($_POST["aula"]);

			try {
				//save the exercise object into the database
				$this->activityMapper->add($activity);

				$this->view->setFlash(sprintf(i18n("Activity \"%s\" successfully added."),$activity ->getActivityName()));

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
		$this->view->setVariable("aulas", $aulas);
		$this->view->setVariable("activityName", $activityName);
		$this->view->render("activity", "add");
	}

}
