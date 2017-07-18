<?php
session_start();
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');

$email=$_POST['remail'];



$conn=db_connect();
    $query1="DELETE FROM Officer WHERE email='$email'";

    if($conn->query($query1)==true)
    {
    	echo "success";


    }
    else {
    	echo "something is wrong!";
    }
    //$conn->close();







?>