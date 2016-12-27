<?php
    $rowModified = $_POST["rowToModify"];
    $taskFile = fopen("taskFile.txt", "r");
    $rows = file("taskFile.txt");
    echo
         "<form method='post' action='index.php' style='display:inline-block'>
            <input type='text' name='newRow' value='$rows[$rowModified]' size='100'>
            <input type='hidden' name='rowModified' value='$rowModified'>
            <input type='submit' name='submit' value='Invia'>
          </form>";
?>
