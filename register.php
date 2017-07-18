<?php
include('head.php');

if (!isset($_POST['submit'])){
?>
<div class="container">
  <h4>Enter your Details to register as a Visitor.</h4>
<div class="row">
    <form action="<?php $_PHP_SELF ?>" method="post" class="col s12">
      <div class="row">
        <div class="input-field col s6">
          <input name ="name" id="name" type="text" class="validate" required="" aria-required="true">
          <label for="name">Name</label>
        </div>
        
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name ="contact" id="contact" type="text" class="validate" required="" aria-required="true">
          <label for="contact">Contact</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name ="password" id="password" type="password" class="validate" required="" aria-required="true">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name ="email" id="email" type="email" class="validate" required="" aria-required="true">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input name ="company" id="company" type="text" class="validate" required="" aria-required="true">
          <label for="company">Company</label>
        </div>
      </div>
      
         
    
        <div class="row">
          <input name="submit" type="submit" value="submit" class="btn">
          </div>
       
      

      
    </form>
  </div>
</div>

<?php
} 


else {

  require_once('functions.php');
  $conn=db_connect();

    $password   = $_POST['password'];
    $name       = $_POST['name'];
    $contact    = $_POST['contact'];
    $email      = $_POST['email'];
    $company    = $_POST['company'];

    
   
    //echo $name;
    $query1 = " SELECT * FROM visitor WHERE email='$email'";
        
        $result=$conn->query($query1);
        
        if($result->num_rows == 1)
        {
          echo "Error:Email already in use";
          return;
        }

      else{
        //$hash = md5( rand(0,1000) );
        $password1=md5($password);
        $query1 = "insert into visitor values('$name','$contact','$company','$email','$password1')";

$result = $conn->query($query1);

if($result)
{
  echo "<p>Registration successful  <a href='http://www.vms.esy.es/login.php'> Click here </a> to login and book appointment</p>";
}


      }

 


}
?>