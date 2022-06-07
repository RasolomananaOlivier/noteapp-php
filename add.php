<?php
require './config/db-config.php';

$id = $_POST['id'];
if (isset($id)) {
  $App->updateNote($id, $_POST);
} else {
  if (isset($_POST['name']) && !is_null($_POST['name'])) {
    if (isset($_POST['description']) && !is_null($_POST['description'])) {
      $App->addNote($_POST['name'], $_POST['description']);
    }
  }
}
