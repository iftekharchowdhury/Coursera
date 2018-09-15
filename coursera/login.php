<?php
require_once "pdo.php";

session_start();
//Cancel redirect to index.php
if (isset($_POST['cancel']) ) {
  header("location: index.php");
  return;
}
//My Stored password that must match
$salt = 'XyZzy12*_';
$stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';

if ( isset($_POST['login']) && isset($_POST['pass']) ) {
  if ( strlen($_POST['email']) < 1 || strlen($_POST['pass']) < 1 ) {
      $_SESSION['error'] = "Email and password are required";
      header('location: login.php');
      return;
  } elseif (strpos($_POST['email'], "@") === False  ) {
    $_SESSION['error'] = "Email must have an at-sign (@)";
    header('location: login.php');
    return;
  } else { $check = hash('md5', $salt.$_POST['pass']);
    if ($check == $stored_hash) {
      $_SESSION['name'] = $_POST['email'];
      error_log("Login success ".$_POST['email']);
      header('Location: view.php');
      return;
    } else {
      $_SESSION['error'] = "Incorrect password";
      error_log("Login fail ".$_POST['who']." $check");
      header('location: login.php');
      return;
    }
  }
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title>Jandre</title>
   </head>
   <body style="font-family:sans-serif;">
     <h1>Please Log In</h1>
     <pre style="color:red"><?php
      if (isset ($_SESSION['error'])) {
        echo(htmlentities($_SESSION['error']));
        unset($_SESSION['error']);
      }
      ?>
    </pre>
       <form method="post">
         <p style="padding:0em"><label for="login">Email</label>
         <input type="text" name="email" id="login"/><br></p>
         <p style="border-width:0"><label for="password">Password</lable>
         <input type="password" name="pass" id="password"/><br></p>
         <input type="submit" name="login" value="Log In">
         <input type="submit" name="cancel" value="Cancel">
   </body>
 </html>
