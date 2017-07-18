<?php
session_start();
include('head.php');
require($_SERVER['DOCUMENT_ROOT'].'/functions.php');

$name=$_POST["name"];
$email=$_POST["email"];
$pass=$_POST["pass"];

$password1=md5($pass);


	$conn=db_connect();
    $query1 = "insert into security values('$email','$password1','$name')";

if($conn->query($query1)==true)
    {
    	echo "success";


    }
    else {
    	echo "something is wrong!";
    }
    
?>