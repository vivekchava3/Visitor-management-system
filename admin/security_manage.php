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
		<h4>Manage Security</h4>
		<a href="home.php" class="waves-effect waves-light btn">Back to Home</a>
		</hr>
		<table class="responive-table">
			<thead>
				<tr>
					<th>User Name</th>
					<th>Security Name</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$conn=db_connect();
    	$query=" SELECT * FROM security ";

    	$result=$conn->query($query);


 			while ($row = mysqli_fetch_assoc($result)) {
 				$email=$row["email"];
 				$name=$row["Name"];
 				echo "<tr>";
 				echo "<td>{$email}</td>";
 				echo "<td>{$name}</td>";
 				echo"</tr>";
 			}
    	?>
    </tbody>

		</table>
	<h4>Add or Remove Security</h4>
	<input type="text" placeholder="Enter Email" name="email" id="email" class="validate" >
	<input type="text" placeholder="Enter Name" name="Name" id="name" >
<input type="text" placeholder="Enter password" name="password" id="password">
<a href="" id="add" class="waves-effect waves-light btn">Add</a>
<input type="text" placeholder="Enter Email" name="remail" id="remail" class="validate">
<a href="" id="remove" class="waves-effect waves-light btn">Remove</a>


	</div>

</body>

</html>
<script type="text/javascript">

 
 $(function(){
    $("#add").click(function(event){
        

            var name=document.getElementById("name").value;
        		var email=document.getElementById("email").value;
        		var password=document.getElementById("password").value;
        
                
        $.ajax({

                                      url       :'security_add.php',
                                      type      :'POST',
                                      async     :false,
                                      data      :{
                                            
                                            name:name,
                                            email:email,
                                            pass:password



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

                                      url       :'security_rem.php',
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