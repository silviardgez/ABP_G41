<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Book.php");
require_once(__DIR__."/../model/BookMapper.php");
require_once(__DIR__."/../model/UserMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class BookController extends BaseController {


	private $bookMapper;
	private $userMapper;

	public function __construct() {
		parent::__construct();

		$this->bookMapper = new BookMapper();
		$this->userMapper = new UserMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show sesions requires login");
		}

		$users = $this->userMapper->showAllUsers();



    // put the users object to the view
		$this->view->setVariable("users", $users);

		// render the view (/view/book/show.php)
		$this->view->render("book", "show");
	}
  public function viewUser(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show sesions requires login");
		}

		$bookings = $this->bookMapper->showAllBooks();

		// put the exercises object to the view
		$this->view->setVariable("bookings", $bookings);



		// render the view (/view/book/show.php)
		$this->view->render("book", "viewUser");
	}
/*
	public function edit(){
		if (!isset($_REQUEST["id"])) {
			throw new Exception("A sesion id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Editing bookings requires login");
		}

		if($this->userMapper->findType() != "deportista"){
			throw new Exception("You aren't an athlete. Editing a sesion requires be athlete");
		}

		// Get the Exercise object from the database
		$sesionid = $_REQUEST["id"];
		$sesion = $this->sesionMapper->findSesionById($sesionid);

		if ($sesion == NULL) {
			throw new Exception("No such sesion with id: ".$sesionid);
		}

		if (isset($_POST["submit"])) {
      //If the observation does not change, it is not overwritten
			if($_POST["observation"] != "") $sesion->setObservation($_POST["observation"]);
			//If the dateSEsion does not change, it is not overwritten
			if($_POST["dateSesion"] != "") $sesion->setDay($_POST["dateSesion"]);
			//If the hour does not change, it is not overwritten
			if($_POST["hour"] != "") $sesion->setHour($_POST["hour"]);


			try {

				//validate exercise object
				$sesion->checkIsValidForUpdate(); // if it fails, ValidationException

				$this->sesionMapper->update($sesion);

				$this->view->setFlash(sprintf(i18n("Sesion \"%s\" successfully updated."),$sesion ->getIdSesion()));

				$this->view->redirect("sesion", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}
		$this->view->setVariable("sesion", $sesion);

		$this->view->render("sesion", "edit");
	}


	public function delete(){
		if (!isset($_POST["id"])) {
			throw new Exception("Id is mandatory");
		}
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Deleting bookings requires login");
		}
		if($this->userMapper->findType() != "deportista" ){
			throw new Exception("You aren't an athlete. Deleting an exercise requires be athlete");
		}


		$bookidact = $_REQUEST["id"];
		$book = $this->bookMapper->findBookByIdActById($bookidact);

		if ($book == NULL) {
			throw new Exception("no such bookin with id activity: ".$bookidact);
		}

		$this->bookMapper->delete($book);

		$this->view->setFlash(sprintf(i18n("Booking \"%s\" successfully deleted."),$book ->getIdAct()));

		$this->view->redirect("book", "show");
	}
*/
	public function view(){
		if (!isset($_GET["id"])) {
			throw new Exception("Id is mandatory");
		}

		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. View sesion requires login");
		}

		$bookid = $_GET["id"];

		// find the Exercise object in the database
		$book = $this->bookMapper->findBookByIdDep($bookid);

		if ($sesion == NULL) {
			throw new Exception("no such sesion with id: ".$sesionid);
		}

		// put the exercise object to the view
		$this->view->setVariable("book", $book);

		// render the view (/view/book/view.php)
		$this->view->render("book", "view");
	}

	public function add(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding sesions requires login");
		}


		$book = new Book();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

			// populate the exercise object with data form the form
      $book->setDateBook($_POST["date"]);
      $book->setDateBook($_POST["date"]);
      $book->setDateBook($_POST["date"]);
			$book->setHour($_POST["hour"]);
      $book->setConfirmed($_POST["confirmed"]);
			try {

				$this->view->setFlash(sprintf(i18n("Booking \"%s\" successfully added."),$book ->getIdAct()));

				$this->view->redirect("book", "show");

			}catch(ValidationException $ex) {
				// Get the errors array inside the exepction...
				$errors = $ex->getErrors();
				// And put it to the view as "errors" variable
				$this->view->setVariable("errors", $errors);
			}
		}

		// Put the exercise object visible to the view
		$this->view->setVariable("book", $book);
		// render the view (/view/exercises/add.php)
		$this->view->render("book", "add");
	}

  }
