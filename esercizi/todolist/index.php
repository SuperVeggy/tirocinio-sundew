<?php
  if (isset($_POST["rowToDelete"])) {
    $rowNumber = $_POST["rowToDelete"];
    $rows = file("taskFile.txt");
    array_splice($rows, $rowNumber, 1);
    file_put_contents("taskFile.txt", $rows);
  }

  if (isset($_POST["newRow"])) {
    $rowNumber = $_POST["rowModified"];
    $rows = file("taskFile.txt");
    array_splice($rows, $rowNumber, 1, $_POST["newRow"]);
    file_put_contents("taskFile.txt", $rows);
  }

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
          $n = 0;
          $rows = file("taskFile.txt");
          for ($row = 0; $row < count($rows); $row++) {
            echo "<li style='margin-bottom:10px'>"
                   . $rows[$row]
                     . "<form method='post' style='display:inline-block; margin-left:10px'>
                          <input type='hidden' name='rowToDelete' value='$n'>
                          <input type='submit' name='submit' value='Cancella' style='margin-right:10px'>
                        </form>
                        <form method='post' action='handleRows.php' style='display:inline-block'>
                          <input type='hidden' name='rowToModify' value='$n'>
                          <input type='submit' name='submit' value='Modifica'>
                        </form>
                 </li>";
            $n += 1;
          }
          fclose("taskFile.txt");
        ?>
      </ul>
    </div>
    <form method="post">
      <label for="taskName">Quale task vorresti aggiungere?</label>
      <input type="text" name="taskName" placeholder="Assegna un nome al task da aggiungere" size="50">
      <input type="submit" name="submit" value="Invia">
    </form>
  </body>
</html>
