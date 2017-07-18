<?php 
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
session_start();
if( !isset($_SESSION['cur_admin_email']) ) {
  header("Location: index.php");
  exit;
}
if (!isset($_POST['submit'])){

?>
<html>
<body>
	<div class="container">
		<h4>Upload Blacklist Picture</h4>
		<div class="row">
		 <form action="<?php $_PHP_SELF ?>" method="post" class="col s12" enctype="multipart/form-data">
		 <div class="row">
          Please Upload your Image : <br>

          <input type="file" name="file" id="file" size="80" accept="image/*" capture="camera" />

        </div>
        <div class="row">
          <input name="submit" type="submit" value="submit" class="btn"/>
        </div>

		</div>
		<a href="home.php" class="waves-effect waves-light btn">Back to Home</a>
		</hr>
		

	</div>

</body>

</html>
<?php
} 


else {

  //image file upload 
  $file_result = "";

  if($_FILES["file"]["error"]>0){
    $file_result .= "No file uploaded or Invalid file";
    $file_result .= "Error code: ".$_FILES["file"]["error"]."<br>";
  }else{
    $file_result .=
    "Upload: ".$_FILES["file"]["name"]."<br>".
    "Type: ".$_FILES["file"]["type"]."<br>".
    "Size: ".($_FILES["file"]["size"]/1024)." Kb<br>".
    "Temp file: ".$_FILES["file"]["tmp_name"]."<br>";
    $filename = date("Y-m-d").time().".jpg";
    $filename = str_replace("-","",$filename);
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'].'/pic/'.$filename);
    $file_result .="File uploaded successfully";
  }

  $path="http://vms.esy.es/pic/".$filename;
  $subid=uniqid();
  blacklist($path,$subid);
   $conn=db_connect();
   $query2="INSERT into blacklist values('$path','$subid')";
$result = $conn->query($query2);
$conn->close();
if($result)
{
	echo "<p>Blacklist success <a href='manual_blacklist.php'>GO BACK</a></p>";

}
}

