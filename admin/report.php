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
<div class="container">
    <h4>Enter Start and End times to Generate Report</h4>

    <div class="row">
      <form action="<?php $_PHP_SELF ?>" method="post" class="col s12" enctype="multipart/form-data">

         <div class="row">
          <div class="input-field col s6">
            
            Start date: 
            <input name ="std" id="startdate" type="date">
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <label for="starttime">Start time</label>
            <input name ="stt" id="starttime" class="timepicker" type="time">
          </div>
        </div>
         <div class="row">
          <div class="input-field col s6">
            
            End date: 
            <input name ="end" id="enddate" type="date">
          </div>
        </div>

        <div class="row">
          <div class="input-field col s6">
            <label for="endtime">End time</label>
            <input name ="ent" id="endtime" class="timepicker" type="time">
          </div>
        </div>
        

        <div class="row">
          <input name="submit" type="submit" value="submit" class="btn"/>
        </div>
    </form>
</div>
</div>



<?php
}
else 
{
 ?>

  <div class="container">
  <h2>Logs</h2>
 <table class="responsive-table">
    <thead>
      <tr>
        <th>Name</th>
        <th>Picture</th>
        <th>Start Time</th>
        <th>End Time</th>
        <th>Officer</th>
        <th>Status</th>
        </tr>
    </thead>
    <tbody> 
      
<?php 

$std=$_POST["std"];
$end=$_POST["end"];
$stt=$_POST["stt"];
$ent=$_POST["ent"];
$s=$std." ".$stt.":00";
$e=$end." ".$ett.":00";

$conn=db_connect();
$query= "SELECT * FROM log where start between '$s' and '$e' UNION SELECT * FROM log where end between '$s' and '$e' UNION SELECT * FROM log where '$s' between start and end UNION SELECT * FROM log where '$e' between start and end";
  $res=$conn->query($query);
  while ($row = mysqli_fetch_assoc($res)) {
    $email=$row["email"];
        $start=$row["start"];
        $end=$row["end"];
        $picture=$row["photo"];
        $officer=$row["officer"];
        $ds=$row["status"];
        $query1=" SELECT * FROM visitor where email='$email' ";

    $resultname=$conn->query($query1);
        $row1=mysqli_fetch_assoc($resultname);
        $name=$row1["Name"];

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td><a href='$picture' target='_blank'><img src='$picture' height='100' width='100'></a></td>";
        echo "<td>{$start}</td>";
        echo "<td>{$end}</td>";
        echo "<td>{$officer}</td>";
        echo "<td>{$ds}</td>";
        echo "</tr>";
}
echo "<button id='printbtn' class='waves-effect waves-light btn' onClick='window.print()'>Generate Report</button>";
}


?>
</tbody>
</table>
<a href="home.php" class="waves-effect waves-light btn" id="homebtn">Back to Home</a>
  
</div>



<script>
  $('.timepicker').pickatime({
    default: 'now',
      twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
      donetext: 'OK',
      autoclose: false,
    vibrate: true // vibrate the device when dragging clock hand
  });

</script>
<style>
@media print {
    #printbtn {
        display :  none;
    }
    #homebtn {
        display :  none;
    }}
</style>