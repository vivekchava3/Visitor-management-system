<html>
<head>
 <?php
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');
session_start();


 if ( isset($_SESSION['cur_admin_email'])!="" ) {
  header("Location:home.php");
  exit;
}
if( isset($_POST['submit']) ) {
    $email=$_POST['email'];
    $password=$_POST['password'];
    $conn=db_connect();
    $query1=" SELECT * FROM admin WHERE email='$email'";

    $result=$conn->query($query1);

    if($result)
      {
        if($result->num_rows==0)
          {
            echo('Not Registered ');
            return false;
          }
      else
      {
        $row=mysqli_fetch_assoc($result);
        if(strcmp(md5($password),$row['password'])==0)
            {
              session_start();
                    $_SESSION['cur_admin_email']=$row['email'];
                    
                    header("Location: home.php");
                  }
                
                else
            {
                echo md5($password);
                echo 'Invalid password';
            }
}
}
}
 ?>

<link rel="stylesheet" type="text/css" href="../css/login.css">

</head>

<body>
  <div class="section"></div>
  <main>
    <center>
      

      <h5 class="indigo-text">Admin Login</h5>
      <div class="section"></div>

      <div class="container">
        <div class="z-depth-1 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

          <form action="#" class="col s12" method="post">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='email' name='email' id='email' required="" aria-required="true"/>
                <label for='email'>Email</label>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input class='validate' type='password' name='password' id='password' required="" aria-required="true"/>
                <label for='password'>Password</label>
              </div>
              <label style='float: right;'>
                                <b>Enter your Details</b>
                            </label>
            </div>

            <br />
            <center>
              <div class='row'>
                <button type='submit' name='submit' class='col s12 btn btn-large waves-effect teal lighten-2'>Login</button>
              </div>
            </center>
          </form>
        </div>
      </div>
      
    </center>

    <div class="section"></div>
    <div class="section"></div>
  </main>

 
</body>
</html>