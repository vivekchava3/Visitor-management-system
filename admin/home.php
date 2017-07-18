<?php 
include('head.php');
session_start();
if( !isset($_SESSION['cur_admin_email']) ) {
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
 	<h4>WELCOME</h4>
 <div class="row">
 	<a href="log.php" class="waves-effect waves-light btn">Logs</a>
</div>

<div class="row">
	<a href="security_manage.php" class="waves-effect waves-light btn"> Manage security </a>
</div>

<div class="row">
	<a href="officer_manage.php" class="waves-effect waves-light btn">Manage officers</a>
</div>

<div class="row">
	 <a href="insights.php" class="waves-effect waves-light btn">View Insights</a>
</div>

<div class="row">
	<a href="manual_blacklist.php" class="waves-effect waves-light btn">Add blacklist Pictures</a>
</div>

<div class="row">
	<a href="report.php" class="waves-effect waves-light btn">logs report</a>
</div>
 
 
 <div class="row">

 <a href="logout.php" class="waves-effect waves-light btn">Logout</a>
 </div>
 
 


 </div>
 </body>
</html>