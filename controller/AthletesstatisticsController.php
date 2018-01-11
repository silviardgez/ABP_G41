<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Athletesstatistics.php");
require_once(__DIR__."/../model/AthletesstatisticsMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class AthletesstatisticsController extends BaseController {

	private $athletesstatisticsMapper;

	public function __construct() {
		parent::__construct();

		$this->athletesstatisticsMapper = new AthletesstatisticsMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show users requires login");
		}
		

		$deportists = $this->athletesstatisticsMapper->showAllDeportists($this->currentUser->getUsername());

		// put the users object to the view
		$this->view->setVariable("deportists", $deportists);

		// render the view (/view/activitiesstatistics/show.php)
		$this->view->render("athletesstatistics", "show");
	}

	public function view(){
		if (!isset($_GET["dni"])) {
			throw new Exception("Dni is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Users requires login");
		}

		$dni = $_GET["dni"];
		$mes = $_POST["mes"];
		if (!isset($_POST["tabla"])) {
			$tabla = 0;
		}else{
			$tabla = $_POST["tabla"];
		}
		$confirmado=1;
		$deportista=1;

		//echo $mes." ".$tabla." ".$dni;
		
		// find the User object in the database
		$statistics = $this->athletesstatisticsMapper->findStatistics($dni, $confirmado, $deportista, $mes, $tabla);

		if ($statistics == NULL) {
			throw new Exception("no such activities with ID: ".$id);
		}

		// put the user object to the view
		$this->view->setVariable("statistics", $statistics);

		// render the view (/view/users/view.php)
		$this->view->render("athletesstatistics", "view");
	}
}
