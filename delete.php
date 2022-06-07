<?php
require_once './config/db-config.php';


if (isset($_POST['id'])) {
  $App->deleteNote($_POST['id']);
}
