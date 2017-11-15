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

		$grupalActivities = $this->activityMapper->getGrupalActivities();
		// put the users object to the view
		$this->view->setVariable("grupalActivities", $grupalActivities);
		// render the view (/view/users/show.php)
		$this->view->render("activity", "show");
	}

}