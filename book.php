
<?php
include('head.php');
require 'functions.php';

session_start();

if( !isset($_SESSION['cur_user']) ) {
  header("Location: index.php");
  exit;
}

if (!isset($_POST['submit'])){


  ?>

  <div class="container">
    <h4>Enter your Details</h4>
    <div class="row">
      <form action="<?php $_PHP_SELF ?>" method="post" class="col s12" enctype="multipart/form-data">
        
        <div class="row">
          
          <div class="input-field col s6">
            <?php 
            $conn=db_connect();
            $query="SELECT name FROM Officer";
            $result=$conn->query($query);
            $select='<select name="Officer_Name" id="off"> <option value="" disabled selected>Choose your option</option>';
            
            while ($row = mysqli_fetch_assoc($result)) {

              $select.='<option value="'.$row['name'].'">'.$row['name'].'</option>';

            }
            $select.='</select>';
            echo $select;

            $conn->close();


            ?>
            <label>Select Officer</label>

            


            
          </div>

        </div>

        <div class="row">
          <div class="input-field col s6">
            <input name ="Purpose" id="purpose" type="text" class="validate" required="" aria-required="true">
            <label for="purpose">Purpose</label>
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <label for="starttime">Start time</label>
            <input name ="st" id="starttime" class="timepicker" type="time" required="" aria-required="true">
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <label for="endtime">End time</label>
            <input name ="en" id="endtime" class="timepicker" type="time" required="" aria-required="true">
          </div>
        </div>


        <div class="row">
          Please Upload your Image : <br>

          <input type="file" name="file" id="file" size="80" accept="image/*" capture="camera" required="" aria-required="true"/>

        </div>

        <div class="row">
          <input name="submit" type="submit" value="submit" class="btn"/>
        </div>




      </form>
    </div>
  </div>

  <?php
} 


else {



  require_once('functions.php');

  $status='none';
  $name = $_SESSION['cur_user'];
  $email   = $_SESSION['cur_user_email'];
  $officer       = $_POST['Officer_Name'];
  $purpose    = $_POST['Purpose'];
  $sttime      = $_POST['st'];
  $etime    = $_POST['en'];

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
    move_uploaded_file($_FILES["file"]["tmp_name"],"pic/".$filename);
    $file_result .="File uploaded successfully";
  }

  $path="http://vms.esy.es/pic/".$filename;
  
  $conn=db_connect();

  $now=date("Y-m-d");
  $s=$now." ".$sttime.":00";
  $e=$now." ".$etime.":00";



// add officer
  $query= "SELECT * FROM log where start between '$s' and '$e' AND officer='$officer' UNION SELECT * FROM log where end between '$s' and '$e' AND officer='$officer' UNION SELECT * FROM log where '$s' between start and end AND officer='$officer' UNION SELECT * FROM log where '$e' between start and end AND officer='$officer'";
  $res=$conn->query($query);
  $n=$res->num_rows;

  if ($n!=0){
    echo "slot time already booked.";
    exit;
  }


  $query1="SELECT * FROM blacklist";
  $result=$conn->query($query1);

  while ($row = mysqli_fetch_assoc($result)) {
    $face_detect = face_detect($path,$row["id"]);
    $obj = json_decode($face_detect,true);
    $confidence = $obj["images"][0]["transaction"]["confidence"];

    if ($confidence>0.6){
     echo "<p>You are Blacklisted, Please contact administrator. <a href='http://vms.esy.es/home.php'> Click here </a>to go back</p>";
     exit;
   };               
 };

 $query2 = "insert into log(start,end,officer,status,purpose,email,photo) values('$s','$e','$officer','$status','$purpose','$email','$path')";

 $result2 = $conn->query($query2);

 if($result2)
 {
  echo "<p>Appointment successful</p>";

    #redirect to successfull page for printing
  header("Location: http://vms.esy.es/print.php?name=$name&start=$s&end=$e&pic=$path&officer=$officer");
 };

}
?>

<script>
  $('.timepicker').pickatime({
    default: 'now',
      twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
      donetext: 'OK',
      autoclose: false,
    vibrate: true // vibrate the device when dragging clock hand
  });

  $(document).ready(function() {
    $('select').material_select();

    // for HTML5 "required" attribute
    $("select[required]").css({
      display: "inline",
      height: 0,
      padding: 0,
      width: 0
    });
  });
</script>