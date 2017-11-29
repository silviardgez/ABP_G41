<?php
// file: model/BookMapper.php

require_once(__DIR__."/../core/PDOConnection.php");

class BookMapper{
  private $db;

  public function __construct(){
    $this->db = PDOConnection::getInstance();
  }


  public function showAllBooks(){
    $stmt = $this->db->prepare("SELECT * FROM RESERVA");
    $stmt->execute();
    $books_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $books = array();
    //var_dump($books_db)

    foreach ($books_db as $book) {
      array_push($books, new Book($book["ID_ACT"], $book["DNI_DEP"], $book["FECHA"], $book["HORA"], $book["CONFIRMADO"]));
    }
    return $books;

  }

  public function findBookByIdAct($id){
    $stmt = $this->db->prepare("SELECT * FROM RESERVA WHERE ID_ACT=?");
    $stmt->execute(array($id));
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if($book != null){
      return new Book(
        $book["ID_ACT"],
        $book["DNI_DEP"],
        $book["FECHA"],
        $book["HORA"],
        $book["CONFIRMADO"]);
    }else{
      return NULL;
    }
  }

  public function findBookByIdDep($id){
    $stmt = $this->db->prepare("SELECT * FROM RESERVA WHERE DNI_DEP=?");
    $stmt->execute(array($id));
    $books_db = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $books = array();

    foreach ($books_db as $book) {
      array_push($books, new Book($book["ID_ACT"], $book["DNI_DEP"], $book["FECHA"], $book["HORA"], $book["CONFIRMADO"]));
    }
    return $books;
  }

  public function findBookByIds($idAct, $idAthl){
    $stmt = $this->db->prepare("SELECT * FROM RESERVA WHERE DNI_DEP=? AND ID_ACT=?");
    $stmt->execute([$idAthl,$idAct]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if($book != null){
      return new Book(
        $book["ID_ACT"],
        $book["DNI_DEP"],
        $book["FECHA"],
        $book["HORA"],
        $book["CONFIRMADO"]);
    }else{
      return NULL;
    }
  }

  public function update(Book $book){
    $stmt = $this->db->prepare("UPDATE RESERVA set FECHA=?, HORA=?, CONFIRMADO=? where ID_ACT=? AND DNI_DEP=?");
		$stmt->execute([$book->getDateBook(), $book->getHour(), $book->getConfirmed(), $book->getIdAct(), $book->getIdAthl()]);
	}


  public function delete($book){
		$stmt = $this->db->prepare("DELETE from RESERVA WHERE ID_ACT=?");
		$stmt->execute(array($book->getIdAct()));
	}


  public function add(Sesion $sesion){
   $stmt = $this->db->prepare("INSERT INTO RESERVA(ID_ACT,DNI_DEP,FECHA,HORA,CONFIRMADO) values (?,?,?,?,?)");
   $stmt->execute(array($book->getIdAct(), $book->getIdAthl(), $book->getDateBook(), $book->getHour(), $book->getConfirmed()));
   return $this->db->lastInsertId();
 }
}
 ?>
