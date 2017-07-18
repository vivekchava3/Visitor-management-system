<?php 
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
session_start();


 if ( !isset($_SESSION['cur_admin_email'])) {
  header("Location:index.php");
  exit;
}



?>

 <div class="container">
 	<h2>Logs</h2>
  <a href="home.php" class="waves-effect waves-light btn">Back to Home</a>
 	</hr>
 	<table class="responsive-table">
 		<thead>
 			<tr>
 				<th>Name</th>
 				<th>Picture</th>
 				<th>Start Time</th>
 				<th>End Time</th>
 				<th>Officer</th>
        <th>Status</th>
 				<th>Change Status</th>
 				<th>Action</th>
 				<th></th>
 		    </tr>
 		</thead>
 		<tbody>
 			<?php
 			$conn=db_connect();
    	$query=" SELECT * FROM log ";

    	$result=$conn->query($query);
    	//$numrows=$result->num_rows;

 			while ($row = mysqli_fetch_assoc($result)) {
 				$email=$row["email"];
 				$start=$row["start"];
 				$end=$row["end"];
 				$picture=$row["photo"];
 				$officer=$row["officer"];
 				$ds=$row["status"];
 				//$action="action";
 				//$go="done";
        $id=$row["id"];
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

 				echo "<td><div class='input-field col s6'>
    <select id='status$id'>
      <option value=''>Select</option>
      <option value='r'>Ready</option>
      <option value='o'>Ongoing</option>
      <option value='f'>Finished</option>
    </select>
    </div></td>";
 				echo "<td><div class='input-field col s6'>
    <select id='action$id'>
      <option value='n'>Select</option>
      <option value='c'>Cancel</option>
      <option value='b'>Blacklist</option>
    </select>
    </div></td>";
 				echo "<td><a href='' class='waves-effect waves-light btn' id=$id>Apply</a></td>";
 				echo "</tr>";
    
}


 			?>
 		</tbody>
 	</table>
 </div>	



 


<style>
img 
{
    image-orientation: from-image;
}
</style>
<script type="text/javascript">

$(document).ready(function() {
    $('select').material_select();
  });
 
 $(function(){
    $('a').click(function(event){
        var id = $(this).attr('id');

        var sid='status'+id;
        var aid='action'+id;
        var status=document.getElementById(sid).value;
        var action=document.getElementById(aid).value;
        //alert(id);
        //alert(sid);
        //alert(aid);
                
        $.ajax({

                                      url       :'action.php',
                                      type      :'POST',
                                      async     : false,
                                      data      :{
                                            
                                            lid:id,
                                            actionnumber:action,
                                            statusnumber:status



                                      },

                                      success   :function(result){
                                                
                                                //alert(result);
                                                location.reload();
                                                //alert(id);
                                                //alert(status);
                                                //alert(action);
                                                


                                      }


                                    });
        });
        
});

 
 
</script>