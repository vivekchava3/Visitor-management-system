<?php 
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
session_start();
if( !isset($_SESSION['cur_admin_email']) ) {
  header("Location: index.php");
  exit;
}
$conn=db_connect();
$query1="SELECT * FROM log";
$r=$conn->query($query1);
$tl=$r->num_rows;
$query2="SELECT * FROM visitor";
$r1=$conn->query($query2);
$tv=$r1->num_rows;
$query3="SELECT * FROM Officer";
$r2=$conn->query($query3);
$to=$r2->num_rows;
$query4="SELECT * FROM security";
$r3=$conn->query($query4);
$ts=$r3->num_rows;
$query5="SELECT * FROM blacklist";
$r4=$conn->query($query5);
$tb=$r4->num_rows;
?>
<html>

<body>
	<div class="container">
	

		<h4>Insights</h4>
			<div class="row">
		<a href="home.php" class="waves-effect waves-light btn">Back to Home</a>
	</div>
		
		<div class="row">
			<?php echo "Total number of appointments:".$tl; ?>
		</div>
		<div class="row">
			<?php echo "Total number of visitors:".$tv; ?>
		</div>
		<div class="row">
			<?php echo "Total number of Officers:".$to; ?>

		</div>
		<div class="row">
			<?php echo "Total number of Security offciers:".$ts; ?>

		</div>
		<div class="row">
			<?php echo "Total number of blacklisted people:".$tb; ?>
		</div>
		
		
		
		
		
	

	</div>

</body>

</html>