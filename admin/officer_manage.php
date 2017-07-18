<?php 
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
session_start();
if( !isset($_SESSION['cur_admin_email']) ) {
  header("Location: index.php");
  exit;
}

?>

<html>

<body>
	<div class="container">
		<h4>Manage Officers</h4>
		<a href="home.php" class="waves-effect waves-light btn">Back to Home</a>
		</hr>
		<table class="responive-table">
			<thead>
				<tr>
					<th>Officer Name</th>
					<th>Officer Email</th>
          <th>Contact</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$conn=db_connect();
    	$query=" SELECT * FROM Officer ";

    	$result=$conn->query($query);


 			while ($row = mysqli_fetch_assoc($result)) {
 				$email=$row["email"];
 				$name=$row["name"];
        $contact=$row["Contact"];
 				echo "<tr>";
 				echo "<td>{$name}</td>";
 				echo "<td>{$email}</td>";
        echo "<td>{$contact}</td>";

 				echo"</tr>";
 			}
    	?>
    </tbody>

		</table>
	<h4>Add or Remove Officer</h4>
	<input type="text" placeholder="Enter Email" name="email" id="email">
	<input type="text" placeholder="Enter Name" name="Name" id="name">
<input type="text" placeholder="Enter Contact" name="contact" id="contact">
<a href="" id="add" class="waves-effect waves-light btn">Add</a>
<input type="text" placeholder="Enter Email" name="email" id="remail">
<a href="" id="remove" class="waves-effect waves-light btn">Remove</a>


	</div>

</body>

</html>
<script type="text/javascript">

 
 $(function(){
    $("#add").click(function(event){
        

            var name=document.getElementById("name").value;
        		var email=document.getElementById("email").value;
        		var contact=document.getElementById("contact").value;
        
                
        $.ajax({

                                      url       :'officer_add.php',
                                      type      :'POST',
                                      async     :false,
                                      data      :{
                                            
                                            name:name,
                                            email:email,
                                            contact:contact



                                      },

                                      success   :function(result){
                                                
                                                
                                                location.reload();
                                                alert("success");
                                                
                                      }


                                    });
        });



$("#remove").click(function(event){
        

            
            var remail=document.getElementById("remail").value;
            
        
                
        $.ajax({

                                      url       :'officer_rem.php',
                                      type      :'POST',
                                      async     :false,
                                      data      :{
                                            
                                            
                                            remail:remail
                                            



                                      },

                                      success   :function(result){
                                                
                                                
                                                location.reload();
                                                alert("success");
                                                
                                      }


                                    });
        });
        
});

 
 
</script>