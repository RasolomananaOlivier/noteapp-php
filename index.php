<?php
require_once './config/db-config.php';
require_once './delete.php';

$currentNote = [
  'note_id' => '',
  'note_name' => '',
  'note_description' => ''
];
if (isset($_GET['id'])) {
  $currentNote = $App->getNoteById($_GET['id']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./styles/global.css">
  <title>Note app</title>
</head>

<body>
  <main>
    <form action="/noteapp/add.php" method="post" class="form">
      <input hidden name='id' value="<?= $currentNote['note_id'] ?>" />
      <div class="form-control-container">
        <label for="name">Name</label>
        <input id='name' type="text" class="input input1" placeholder="your note name" name='name' value="<?= $currentNote['note_name'] ?>" />
      </div>
      <div class="form-control-container">
        <label for="description">Description</label>
        <textarea id="description" class="input" cols="40" rows="6" placeholder="you note description" name="description">
          <?= $currentNote['note_description'] ?>
        </textarea>
      </div>
      <button class="button">
        <?php if (isset($_GET['id'])) : ?>
          Update note
        <?php else : ?>
          Add note
        <?php endif ?>
      </button>

    </form>

    <div>
      <?php
      $allnotes = $App->getNotes();

      foreach ($allnotes as $key) : ?>
        <div class="container">
          <a href="?id=<?= $key['note_id'] ?>">
            <h1> <?= $key['note_name'] ?> </h1>
          </a>

          <p> <?= $key['note_description'] ?> </p>
          <form action="delete.php" method="POST">
            <input hidden name='id' value="<?= $key['note_id'] ?>" />
            <button>Delete</button>
          </form>
        </div>
      <?php endforeach ?>
    </div>
  </main>

</body>

</html>