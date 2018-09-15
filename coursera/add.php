<?php
session_start();
require_once "pdo.php";
//Check if $_SESSION['name'] is set.
if ( ! isset($_SESSION['name']) ) {
    die('Not logged in');
}
//go to logout if cancel buttom is pressed
if (isset($_POST['cancel'])) {
  header('location: view.php');
  return;
}
//Add conditions
if (isset($_POST['Add']) && isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage'])) {
  if (!is_numeric($_POST['year']) || !is_numeric($_POST['mileage'])) {
    $_SESSION['fail'] = "Mileage and year must be numeric";
    header('location: add.php');
    return;
  } elseif (strlen($_POST['make']) < 1 ) {
    $_SESSION['fail'] = "Make is required";
    header('location: add.php');
    return;
  } else {
    $stmt = $pdo->prepare("INSERT INTO autos (make, year, mileage) VALUES ( :mk, :yr, :mi)");
    $stmt->execute(array(
        ':mk' => $_POST['make'],
        ':yr' => $_POST['year'],
        ':mi' => $_POST['mileage'])
    );
    $_SESSION['success'] = "Record inserted";
    header('location: view.php');
    return;
  }
}
 ?>
<html>
 <head>
   <title>Jandre</title>
 </head>
 <body>
 <h1>Tracking Autos for <?php echo(htmlentities($_SESSION['name'])); ?></h1>
 <p style="color:green">
   <?php if (isset($_SESSION['fail'])) {
     echo(htmlentities($_SESSION['fail']));
     unset($_SESSION['fail']);
   }
   ?>
 </p>
 <form method="post">
   <p>Make:<input type="text" name="make" ><br></p>
   <p>Year:<input type="text" name="year"><br></p>
   <p>Mileage:<input type="text" name="mileage"><br></p>
   <input type="submit" name="Add" value="Add"/>
   <input type="submit" name="cancel" value="Cancel"/>
 </form>
 </body>
</html>


























































