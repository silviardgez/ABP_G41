<?php
//file: controller/LoginController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");

class LoginController extends BaseController {

	private $loginMapper;

	public function __construct() {
		parent::__construct();

		//$this->loginMapper = new loginMapper();
	}

	
	public function index() {
		$this->view->render("login","login");
	}

	public function home(){
		if (isset($_SESSION["currentuser"])){
			$this->view->render("login","home");
		}else{
			throw new Exception("Not in session. Show menu requires login");
		}
	}

}
