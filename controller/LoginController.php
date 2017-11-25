<?php
//file: controller/LoginController.php
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../controller/BaseController.php");
require_once(__DIR__."/../model/UserMapper.php");

class LoginController extends BaseController {

	private $loginMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		//$this->loginMapper = new loginMapper();
	}

	
	public function index() {
		$this->view->render("login","login");
	}

	public function register() {

		// render the view (/view/login/register.php)
		$this->view->render("login", "register");

	}

	public function home(){
		if (isset($_SESSION["currentuser"])){
			$this->userMapper = new UserMapper();

			$_SESSION["admin"] = $this->userMapper->isAdmin();
			$_SESSION["entrenador"] = $this->userMapper->isCoach();
			$_SESSION["deportista"] = $this->userMapper->isAthlete();

			$this->view->render("login","home");
		}else{
			throw new Exception("Not in session. Show menu requires login");
		}
	}

}
