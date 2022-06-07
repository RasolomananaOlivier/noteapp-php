<?php

class Config
{
  public static $DB_DSN = 'mysql:host=localhost;dbname=noteDb';
  public static $DB_USER = 'root';
  public static  $DB_PASS = 'Olivier1654Ubuntu20.04';
  public static $DB_CONFIG = [
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
  ];
}


class Database
{
  public static function connect()
  {
    try {
      $PDO = new PDO(Config::$DB_DSN, Config::$DB_USER, Config::$DB_PASS, Config::$DB_CONFIG);

      return $PDO;
    } catch (PDOException $error) {
      echo 'Error' . $error->getMessage();
    }
  }
}

class App
{
  private $PDO;
  public function __construct()
  {
    $this->PDO = Database::connect();
  }

  public function addNote($name, $description)
  {
    try {
      $request = $this->PDO->prepare('INSERT INTO `notes`(`note_name`,`note_description`) VALUES (?, ?) ');
      $request->bindValue(1, $name);
      $request->bindValue(2, $description);
      $request->execute();
    } catch (PDOException $error) {
      echo 'Error' . $error->getMessage();
    }
  }

  public function getNotes()
  {
    try {
      $request = $this->PDO->prepare('SELECT * FROM `notes`');

      $request->execute();
      return $request->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
      echo 'Error' . $error->getMessage();
    }
  }

  public function getNoteById($id)
  {
    try {
      $statement = $this->PDO->prepare('SELECT * FROM notes WHERE note_id = :id');
      $statement->bindValue(':id', $id);
      $statement->execute();
      return $statement->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $error) {
      echo 'Error' . $error->getMessage();
    }
  }

  public function updateNote($id, $note)
  {
    try {
      $statement = $this->PDO->prepare('UPDATE notes SET note_name = :name,note_description = :desc WHERE note_id = :id');
      $statement->bindValue(':id', $id);
      $statement->bindValue(':name', $note['name']);
      $statement->bindValue(':desc', $note['description']);


      return $statement->execute();
    } catch (PDOException $error) {
      echo 'Error' . $error->getMessage();
    }
  }

  public function deleteNote($id)
  {
    try {
      $statement = $this->PDO->prepare('DELETE FROM notes WHERE note_id = :id');
      $statement->bindValue(':id', $id);


      return $statement->execute();;
    } catch (PDOException $error) {
      echo 'Error' . $error->getMessage();
    }
  }
}

$App = new App();
