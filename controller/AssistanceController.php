<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Assistance.php");
require_once(__DIR__."/../model/AssistanceMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class AssistanceController extends BaseController {

	private $assistanceMapper;

	public function __construct() {
		parent::__construct();

		$this->assistanceMapper = new AssistanceMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show assistance requires login");
		}

		$activities = $this->assistanceMapper->showAllActivities();

		// put the users object to the view
		$this->view->setVariable("activities", $activities);

		// render the view (/view/users/show.php)
		$this->view->render("assistance", "show");
	}

	public function view(){
		if (!isset($_GET["id_act"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View Users requires login");
		}

		$id = $_GET["id_act"];

		// find the User object in the database
		$assistances = $this->assistanceMapper->findAssistance($id);

		// put the user object to the view
		$this->view->setVariable("assistances", $assistances);

		// render the view (/view/users/view.php)
		$this->view->render("assistance", "view");
	}

	public function add(){
		
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding users requires login");
		}
		
		if (!isset($_GET["id_act"])) {
			throw new Exception("Id is mandatory");
		}
		
		$confirmado = 1;
		$id = $_GET["id_act"];
		$assistants = $this->assistanceMapper->showAllAssistants($id, $confirmado);
		
		$assistance = new Assistance();
		
		$assistance->setActivityid($id);

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the user object with data form the form
			$assistance->setActivityid($id);
			$assistance->setDni($_POST["asistente"]);
			$assistance->setDateassistance($_POST["fecha"]);
			$assistance->setTime($_POST["hora"]);

			try {
				//save the user object into the database
				$this->assistanceMapper->add($assistance);

				$this->view->setFlash(sprintf(i18n("assistance \"%s\" successfully added."),$assistance ->getDni()));
				
				$this->view->redirect("assistance", "show");
			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the user object visible to the view
		$this->view->setVariable("assistance", $assistance);
		$this->view->setVariable("assistants", $assistants);
		// render the view (/view/users/add.php)
		$this->view->render("assistance", "add");
	}

	public function delete(){
		if (!isset($_POST["dni"])) {
			throw new Exception("DNI is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting user requires login");
		}
		
		$this->assistanceMapper->delete($_POST["dni"],$_POST["date"],$_POST["time"]);

		$this->view->setFlash(sprintf(i18n("Assistance successfully deleted.")));

		$this->view->redirect("assistance", "show");
	}
}
