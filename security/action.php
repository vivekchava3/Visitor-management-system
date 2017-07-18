<?php
session_start();
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');

$id=$_POST['lid'];
$action=$_POST['actionnumber'];
$status=$_POST['statusnumber'];

if($action=="c") //Cancelling appointment i.e deleting from logs and notifying officer
{

$conn=db_connect();
    
    /* 
    $query="SELECT * FROM log WHERE id='$id'";
    

    $resultname=$conn->query($query1);
                $row1=mysqli_fetch_assoc($resultname);
                $name=$row1["officer"];
    $queryo="SELECT * FROM Officer WHERE name='$name'";
    $resoff=conn->query($queryo);
    $row1=mysqli_fetch_assoc($resoff);
                $offemail=$row1["email"];
                $message=" Your appointment has been cancelled";
                */
    $query1="DELETE FROM log WHERE id='$id'";

    if($conn->query($query1)==true)
    {
        echo "success";
        //email function
        //mail_send($message,$off);



    }
    else {
        echo "something is wrong!";
    }
    $conn->close();

}

elseif($action=='b')//blacklisting
{
$conn=db_connect();
$query1=" SELECT * FROM log where id='$id' ";

    $resultname=$conn->query($query1);
                $row1=mysqli_fetch_assoc($resultname);
                $pic=$row1["photo"];
                $subid=uniqid();
blacklist($pic,$subid);
$query2="INSERT into blacklist values('$pic','$subid')";
$result = $conn->query($query2);

$query3="DELETE FROM log WHERE id='$id'";
$result1 = $conn->query($query3);
$conn->close();
}

elseif($action='n') // no action but changing status of the appointment to ready, ongoing,finish
{
    if($status=="r")
    {
        $conn=db_connect();
        $query1= "UPDATE log SET status='Ready' WHERE id='$id'";
        $result = $conn->query($query1);
        /*
                $query="SELECT * FROM log WHERE id='$id'";
    

                $resultname=$conn->query($query1);
                $row1=mysqli_fetch_assoc($resultname);
                $name=$row1["officer"];

                $queryo="SELECT * FROM Officer WHERE name='$name'";
    
                $resoff=conn->query($queryo);
                $row1=mysqli_fetch_assoc($resoff);
                $offemail=$row1["email"];
                $message=" Your appointment is ready. Visitor waiting at front desk.";
                mail_send($message,$off);

                */
        $conn->close();
    }
    elseif($status=="o")
    {
        $conn=db_connect();
        $query1= "UPDATE log SET status='Ongoing' WHERE id='$id'";
        $result = $conn->query($query1);

        $conn->close();

    }
    elseif($status=="f")
    {
        $conn=db_connect();
        $query1= "UPDATE log SET status='Finished' WHERE id='$id'";
        $result = $conn->query($query1);
        /*
                $query="SELECT * FROM log WHERE id='$id'";
    

                $resultname=$conn->query($query1);
                $row1=mysqli_fetch_assoc($resultname);
                $name=$row1["officer"];

                $queryo="SELECT * FROM Officer WHERE name='$name'";
    
                $resoff=conn->query($queryo);
                $row1=mysqli_fetch_assoc($resoff);
                $offemail=$row1["email"];
                $message=" Your appointment has been finished";
                mail_send($message,$off);
                */
        $conn->close();
    }
    else
    {
        //do nothing
    }
}
else 
{
    //do nothing
}




?>