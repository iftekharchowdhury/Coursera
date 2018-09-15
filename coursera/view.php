<?php
//password = php123
require_once "pdo.php";
session_start();
//Check if user name is set in $_SESSION
if ( ! isset($_SESSION['name']) ) {
    die('Not logged in');
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Jandre</title>
  </head>
  <body>
    <h1>Tracking Autos for <?php echo(htmlentities($_SESSION['name'])); ?></h1>
    <?php if ( isset($_SESSION['success']) ) {
        echo('<p style="color: green;">'.htmlentities($_SESSION['success'])."</p>\n");
        unset($_SESSION['success']);
    } ?>
    <h2>Automobiles</h2>
    <?php
    $stmt = $pdo->query('SELECT year, make, mileage FROM autos');
    echo '<table >'."\n";
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<tr><td><b>";
    echo ($row['year']);
    echo "</td><td>";
    echo ($row['make']);
    echo "</td><td>".'/';
    echo ($row['mileage']);
    echo "</td></tr></b>";
  }
    ?>
    <p><a href="add.php">Add New</a> | <a href="logout.php">Logout</a>
  </body>
</html>
