e grades after you submit them.

Automobiles CRUD Database

In this assignment you will expand a web based application to Create, Read, Update, and Delete (C.R.U.D.) data in a MySQL database. All interactions will follow the POST-Redirect and Flash Message patterns where appropriate. All generated HTML must be properly protected using htmlentities().
       
Code: Source code of index.php (click to view)
Code: Source code of edit.php (click to view)
×
Source code of edit.php
<?php
require_once "pdo.php";
session_start();

if ( isset($_POST['Save']) ) {
      header('Location: index.php');
      return;
    }

if ( isset($_SESSION["success"]) ) {
  echo('<p style="color:green">'.htmlentities($_SESSION["success"])."</p>\n");
  unset($_SESSION["success"]);
  }
if ( isset($_SESSION['error']) ) {
  echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
  unset($_SESSION['error']);
  }



//checks to see if Make is populated
if ( isset($_POST['make']) && isset($_POST['year']) && isset($_POST['mileage']) && isset($_POST['model']))
{ //data validation
  if ( strlen($_POST['make']) < 1 || strlen($_POST['year']) < 1 || strlen($_POST['mileage']) < 1 || strlen($_POST['model']) < 1) //check to see if field is blank
      {
      $_SESSION['error'] = "All fields are required";
      header("Location: edit.php?autos_id=".$_REQUEST['id']);
      error_log("All fields are required");
      return;
      } else {
              //checks to see if year and mileage are numeric.  if true, insert record.
              if (!is_numeric($_POST['year']))
              {
                $_SESSION['error'] = "Year must be integer";
                header("Location: edit.php?autos_id=".$_REQUEST['id']);
                error_log("Year must be integer ");
                return;
              } else {
                if (!is_numeric($_POST['mileage']))
                {
                $_SESSION['error'] = "Mileage must be integer";
                header("Location: edit.php?autos_id=".$_REQUEST['id']);
                error_log("Mileage must be integer ");
                return;
                } else {
                        $sql = "UPDATE autos SET make = :make, model = :model,
                        year = :year, mileage = :mileage
                        WHERE auto_id = :auto_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(array(
                        ':make' => $_POST['make'],
                        ':model' => $_POST['model'],
                        ':year' => $_POST['year'],
                        ':mileage' => $_POST['mileage'],
                        ':auto_id' => $_POST['auto_id']));
                        $_SESSION['success'] = 'Record edited';
                        header( 'Location: index.php' ) ;
                        error_log("Record updated");
                        return;

                      }
            }
          }
}

// Guardian: Make sure that user_id is present
if ( ! isset($_GET['auto_id']) ) {
  $_SESSION['error'] = "Missing auto_id";
  header('Location: index.php');
  error_log("Missing auto_id");
  return;
}

$stmt = $pdo->prepare("SELECT * FROM autos where auto_id = :xyz");
$stmt->execute(array(":xyz" => $_GET['auto_id']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);
if ( $row === false ) {
    $_SESSION['error'] = 'Bad value for auto_id';
    error_log("Bad value for auto_id");
    header( 'Location: index.php' ) ;
    return;
}

// Flash pattern
if ( isset($_SESSION['error']) ) {
    echo '<p style="color:red">'.$_SESSION['error']."</p>\n";
    unset($_SESSION['error']);
}

$m = htmlentities($row['make']);
$mo = htmlentities($row['model']);
$y = htmlentities($row['year']);
$mi = htmlentities($row['mileage']);
$auto_id = $row['auto_id'];

?>



<p>Edit Auto</p>
<form method="post">
<p>Make:
<input type="text" name="make" value="<?= $m ?>"></p>
<p>Model:
<input type="text" name="model" value="<?= $mo ?>"></p>
<p>Year:
<input type="text" name="year" value="<?= $y ?>"></p>
<p>Mileage:
<input type="text" name="mileage" value="<?= $mi ?>"></p>
<input type="hidden" name="auto_id" value="<?= $auto_id ?>">
<p><input type="submit" value="Save"/>
<a href="index.php">Cancel</a></p>
</form>
