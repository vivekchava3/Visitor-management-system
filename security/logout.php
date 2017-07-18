<?php
 session_start();
 if (!isset($_SESSION['cur_security_email'])) {
 
  header("Location: index.php");
}
 
 else if(isset($_SESSION['cur_security_email'])!="") {
 
  header("Location: home.php");
 
 }
 
  //unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
  ?>