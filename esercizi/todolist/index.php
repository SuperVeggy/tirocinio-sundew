<?php
  if (isset($_POST["taskName"])) {
    $taskFile = fopen("taskFile.txt", "a");
    fwrite($taskFile, $_POST["taskName"] . "\n");
    fclose($taskFile);
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>To Do List</title>
  </head>
  <body>
    <div>
      <ul>
        <?php
          $taskFile = fopen("taskFile.txt", "r");
          while (!feof($taskFile)) {
            echo "<li>" . fgets($taskFile) . "</li>";
          }
        ?>
      </ul>
    </div>
    <form method="post">
      <label for="taskName">Quale task vorresti aggiungere?</label>
      <input type="text" name="taskName" placeholder="Assegna un nome al task da aggiungere" size="50"><br>
      <label for="taskDescription">Descrivi l'obbiettivo del task:</label>
      <input type="text" name="taskDescription" placeholder="Assegna una descrizione al task" size="100"><br>
      <input type="submit" name="submit" value="Invia">
    </form>

  </body>
</html>
