<?php 
include('head.php');
require('functions.php');

$pic=$_GET['pic'];
$start=$_GET['start'];
$end=$_GET['end'];
$name=$_GET['name'];
$officer=$_GET['officer']


?>

<div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Visitor Card ID: </span>
              <img src=<?php echo "$pic";?> height="150" width="100">
              <p>    Name : <?php echo $name;?> </p>
              <p>    Officer Name : <?php echo $officer;?></p>
              </div>
              
            <div class="card-content white-text">
              <p>    Start Time :<?php echo $start;?> </p>
              <p>    End time : <?php echo $end;?></p>
            </div>
              
            </div>
          </div>
        </div>
      </div>
<button id="printbtn"class="waves-effect waves-light btn" onClick="window.print()">Print ID Card</button>
<a href="logout.php" class="waves-effect waves-light btn" id ="logbtn"> Logout </a>
            

            <style>
            img {
    float: left;
    margin: 0px 15px 0px 0px;
    
    
}
@media print {
    #printbtn {
        display :  none;
    }
    #logbtn
    {
      display: none;
    }
}
            </style>