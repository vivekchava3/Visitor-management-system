<?php
session_start();
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');

$name=$_POST["name"];
$email=$_POST["email"];
$cont=$_POST["contact"];



	$conn=db_connect();
    $query1 = "insert into Officer values('$email','$name','$cont')";

if($conn->query($query1)==true)
    {
    	echo "success";


    }
    else {
    	echo "something is wrong!";
    }
    
?>