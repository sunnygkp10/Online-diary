<?php
session_start();
if(isset($_SESSION["email"])){
header("location:invalid.php");
exit();}
include_once 'dbConnection.php';
$ref=@$_GET['q'];
$email = $_POST['email'];
$password = $_POST['password'];

$email = stripslashes($email);
$email = addslashes($email);
$password = stripslashes($password); 
$password = addslashes($password);
$password=md5($password); 
$result = mysqli_query($con,"SELECT name FROM user WHERE email = '$email' and password = '$password'") or die('Error');
$count=mysqli_num_rows($result);
if($count==1){
while($row = mysqli_fetch_array($result)) {
	$name = $row['name'];
}
$_SESSION["name"] = $name;
$_SESSION["email"] = $email;
$date=date("Y-m-d");
$time=date("h:i:sa");
$ip=$_SERVER['REMOTE_ADDR'];
$q2=mysqli_query($con,"INSERT INTO log VALUES  ('$email', '$date' , '$time' , '$ip')") or die ('Error');
header("location:account.php?q1=1");
}
else
header("location:$ref?w=Wrong Username or Password");


?>