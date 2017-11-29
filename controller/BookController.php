<?php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/I18n.php");

require_once(__DIR__."/../model/Book.php");
require_once(__DIR__."/../model/BookMapper.php");
require_once(__DIR__."/../model/UserMapper.php");
require_once(__DIR__."/../model/ActivityMapper.php");

require_once(__DIR__."/../controller/BaseController.php");


class BookController extends BaseController {


	private $bookMapper;
	private $userMapper;
	private $activityMapper;

	public function __construct() {
		parent::__construct();

		$this->bookMapper = new BookMapper();
		$this->userMapper = new UserMapper();
		$this->activityMapper = new ActivityMapper();

		$this->view->setLayout("welcome");
	}

	public function show(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show sesions requires login");
		}

		$books = $this->bookMapper->showAllBooks();

		$booksSerialize = array();

		foreach ($books as $book) {
			//Initialize params
			$book_idAct = $book->getIdAct();
			$book_idAthl = $book->getIdAthl();
			//Serialize database data
			$booksSerialize[$book_idAct."-".$book_idAthl]['idAct'] = $book->getIdAct();
			$booksSerialize[$book_idAct."-".$book_idAthl]['idAthl'] = $book->getIdAthl();
			$booksSerialize[$book_idAct."-".$book_idAthl]['dateBook'] = $book->getDateBook();
			$booksSerialize[$book_idAct."-".$book_idAthl]['hour'] = $book->getHour();
			$booksSerialize[$book_idAct."-".$book_idAthl]['confirmed'] = $book->getConfirmed();
			//Serialize relational data
			$booksSerialize[$book_idAct."-".$book_idAthl]['userName'] = $this->userMapper->getNameByDNI($book_idAthl);
			$booksSerialize[$book_idAct."-".$book_idAthl]['actName'] = $this->activityMapper->getActNameById($book_idAct);
		}

    // put the users object to the view
		$this->view->setVariable("books", $booksSerialize);

		// render the view (/view/book/show.php)
		$this->view->render("book", "show");
	}

	public function viewUser(){
		if(!isset($this->currentUser)){
			throw new Exception("Not in session. Show sesions requires login");
		}

		$dni = $this->currentUser->getUsername();

		$bookings = $this->bookMapper->findBookByIdDep($dni);

		$bookingsSerialized = array();

		foreach($bookings as $book){
			//Initialize params
			$book_idAct = $book->getIdAct();
			$book_idAthl = $book->getIdAthl();
			//Serialize database data
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['idAct'] = $book->getIdAct();
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['idAthl'] = $book->getIdAthl();
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['dateBook'] = $book->getDateBook();
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['hour'] = $book->getHour();
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['confirmed'] = $book->getConfirmed();
			//Serialize relational data
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['userName'] = $this->userMapper->getNameByDNI($book_idAthl);
			$bookingsSerialized[$book_idAct."-".$book_idAthl]['actName'] = $this->activityMapper->getActNameById($book_idAct);
		}

		// put the exercises object to the view
		$this->view->setVariable("books", $bookingsSerialized);

		// render the view (/view/book/show.php)
		$this->view->render("book", "viewUser");
	}

	public function changeConfirmedStatus(){

		$idAct = $_GET['idAct'];
		$idAthl = $_GET['idAthl'];
		$status = $_GET['status'];

		$current_book = $this->bookMapper->findBookByIds($idAct,$idAthl);


		if($current_book != null){
			$current_book->setConfirmed($status);
			$this->bookMapper->update($current_book);
		}else{
			throw new Exception("Impossible to change status because it doesn't exist the book demanded");
		}

		$this->view->redirect("book", "show");
	}

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

	public function addBook(){
		if (!isset($this->currentUser)) {
			throw new Exception("Not in session. Adding sesions requires login");
		}


		$book = new Book();

		if(isset($_POST["submit"])) { // reaching via HTTP user...

		// populate the exercise object with data form the form
		$book->setIdAct($_POST["id"]);
		$book->setIdAthl($_SESSION["id_userActual"]);
		$book->setDateBook(date("d-m-Y"));
		$book->setHour(date("H:i:s"));
		$book->setConfirmed(0);
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
