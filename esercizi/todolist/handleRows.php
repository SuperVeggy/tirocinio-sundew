<?php
    $rowModified = $_POST["rowToModify"];
    echo "<form method='post' action='index.php'>
            <input type='text' name='newRow' placeholder='Inserisci qui le tue modifiche' size='100'>
            <input type='hidden' name='rowModified' value='$rowModified'>
            <input type='submit' name='submit' value='Invia'>
          </form>";
?>
