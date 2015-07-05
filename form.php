<?php
session_start();
include_once 'dbConnection.php';
$title = $_POST['title'];
$text = $_POST['text'];
$id=uniqid();
$email=$_SESSION["email"];
$date=date("Y-m-d");
$time=date("h:i:sa");
$star=0;
$share=0;
$nick=0;
$q=mysqli_query($con,"INSERT INTO articles VALUES  ('$email', '$id' , '$date' , '$time' , '$text', '$title' , '$star', '$share', '$nick')")or die ("Error");
header("location:account.php?q1=2");
?>