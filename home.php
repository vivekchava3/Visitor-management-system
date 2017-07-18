<?php 
include('head.php');
session_start();
if( !isset($_SESSION['cur_user']) ) {
  header("Location: index.php");
  exit;
}

?>
<html>
 <head>
  <title>Welcome</title>
 </head>
 <body>
 <div class="container">
 	<h4>Welcome, You are now Logged in.</h4>
 	<div class="row">
 <a href="book.php" class="waves-effect waves-light btn">BOOK Appointment</a>
 </div>
 <div class="row">
 <a href="logout.php" class="waves-effect waves-light btn"> Logout </a>
 </div>
 </div>
 </body>
</html>