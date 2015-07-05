<?php
include_once 'dbConnection.php';
session_start();
//starred--
if(@$_GET['sid']) {
$id=@$_GET['sid'];
$result = mysqli_query($con,"SELECT star FROM articles WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$star = $row['star'];
if($star==0)
{
$q3=mysqli_query($con,"UPDATE articles SET star=1 WHERE id='$id' ") or die ('Error');
}
else
{
$q3=mysqli_query($con,"UPDATE articles SET star=0 WHERE id='$id' ") or die ('Error');
}
}
header("location:account.php?q1=2");
}

//get printable view
if(@$_GET['pid']) {
$id=@$_GET['pid'];
$result = mysqli_query($con,"SELECT * FROM articles WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$article = $row['article'];
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
echo '<h2 style="text-align:center"><b>'.$title.'</b></h1><br />';
echo '<span style="margin-left:50px;margin-right:50px;line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>'.$date.'</span><br />';
echo '<span style="margin-left:50px;margin-right:50px;line-height:35px;padding:5px;">-&nbsp;<b>Time:</b>'.$time.'</span><br />'; 
echo '<div style="margin-left:50px;margin-right:50px;line-height:35px;padding:5px; font-size:20px;">'.$article.'</div>';}
}

//delete article start
if(@$_GET['did']) {
$id=@$_GET['did'];
$result1 = mysqli_query($con,"SELECT * FROM articles WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result1)) {
	$email	 = $row['email'];
if($email==$_SESSION['email'] || (isset($_SESSION['key']) )){	
$result = mysqli_query($con,"DELETE FROM articles WHERE id='$id' ") or die('Error');
header("location:account.php?q1=2");
}else{
header("location:invalid.php");}
}
}

//share for people
if(@$_GET['shid']) {
$id=@$_GET['shid'];
$result = mysqli_query($con,"SELECT * FROM articles WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$share	 = $row['share'];
	$email	 = $row['email'];
if($email==$_SESSION['email']){	
if($share==0)
{
$q3=mysqli_query($con,"UPDATE articles SET share=1 WHERE id='$id' ") or die ('Error');
}
else
{
$q3=mysqli_query($con,"UPDATE articles SET share=0 WHERE id='$id' ") or die ('Error');
}}else{
header("location:invalid.php");}

}
header("location:account.php?q1=2");
}

//delete feedback
if(isset($_SESSION['key'])){
if(@$_GET['fdid'] && $_SESSION['key']=='sunny7785068889') {
$id=@$_GET['fdid'];
$result = mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
header("location:adminpanel.php?q=3");
}else
{echo'<h1><span style="color:red;text-decoration:blink;">Access Denied !!<span><br />Do not dare do hack!!</h1>';}
}
//delete user
if(isset($_SESSION['key'])){
if(@$_GET['demail'] && $_SESSION['key']=='sunny7785068889') {
$demail=@$_GET['demail'];
$result = mysqli_query($con,"DELETE FROM user WHERE email='$demail' ") or die('Error');
header("location:adminpanel.php?q=1");
}else
{header("location:invalid.php");}
}
?>
