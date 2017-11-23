<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Activitiesstatistics.php");
require_once(__DIR__."/../model/ActivitiesstatisticsMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class ActivitiesstatisticsController extends BaseController {

	private $activitiesstatisticsMapper;

	public function __construct() {
		parent::__construct();

		$this->activitiesstatisticsMapper = new ActivitiesstatisticsMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}

		$activities = $this->activitiesstatisticsMapper->showAllActivities();

		// put the users object to the view
		$this->view->setVariable("activities", $activities);

		// render the view (/view/activitiesstatistics/show.php)
		$this->view->render("activitiesstatistics", "show");
	}

	public function view(){
		if (!isset($_GET["id_act"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Users requires login");
		}

		$id = $_GET["id_act"];
		$confirmado=1;
		$deportista=1;

		// find the User object in the database
		$statistics = $this->activitiesstatisticsMapper->findStatistics($id, $confirmado, $deportista);

		if ($statistics == NULL) {
			throw new Exception("no such activities with ID: ".$id);
		}

		// put the user object to the view
		$this->view->setVariable("statistics", $statistics);

		// render the view (/view/users/view.php)
		$this->view->render("activitiesstatistics", "view");
	}
}
