<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>My Diary || Account</title>

 <link  rel="stylesheet" href="css/bootstrap.min.css"/>
 <link  rel="stylesheet" href="css/bootstrap-theme.min.css"/>    
 <link rel="stylesheet" href="css/main.css">
 <link  rel="stylesheet" href="css/font.css">
 <link  rel="stylesheet" href="css/jquery.mCustomScrollbar.css">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"  type="text/javascript"></script>
 <script src="js/bootstrap.js" type="text/javascript"></script>
  <script src="js/jquery.js" type="text/javascript"></script>
 <?php if((@$_GET['q1']==1) || @$_GET['eeid'])echo '<script src="ckeditor/ckeditor.js" type="text/javascript"></script>';?>
 <script src="js/jquery.mCustomScrollbar.concat.min.js" type="text/javascript"></script>
 <!--alert message-->
<?php if(@$_GET['w'])
{echo'<script>alert("'.@$_GET['w'].'");</script>';}
?>
<!--alert message end-->
<script>
function validateForm() {var y = document.forms["form"]["title"].value;	if (y == null || y == "") {alert("Title must be filled out.");return false;}
}
</script>
</head>

<body>
<!--header start-->
<div class="row logo">
<div class="col-md-6">
<h1><span style="color:#FFCA82">My&nbsp;Diary</span>&nbsp;<span style="font-size:15px; color:#fff;">Soft copy of my feeling...</span></h1>

</div>
<div class="col-md-2">
</div><div class="col-md-4">
 <?php
 include_once 'dbConnection.php';
session_start();
  if(!(isset($_SESSION['email']))){
header("location:index.php");

}
else
{
$name = $_SESSION['name'];

include_once 'dbConnection.php';
echo '<span class="pull-right top" ><span class="log1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;Hello,</span> <a href="account.php?q1=2" class="log log1">'.$name.'</a>&nbsp;|&nbsp;<a href="logout.php?q=account.php" class="log"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;Signout</button></a></span>';
}?>
</div></div>
<!--header end-->

<div class="row">
<div class="menu col-md-2"><!--menu start-->
<ul>

<li>
<div class="camenu <?php if(@$_GET['q1']==1) echo 'active';?>">
<a href="account.php?q1=1"><span class="glyphicon glyphicon-pencil caf" aria-hidden="true"></span>
<span class="cas">Compose</span></a>
</div>
</li>

<li>
<div class="camenu <?php if((@$_GET['q1']==2) ) echo 'active';?>">
<a href="account.php?q1=2"><span class="glyphicon glyphicon-briefcase caf" aria-hidden="true"></span>
<span class="cas">Archive</span></a>
</div>
</li>

<li>
<div class="camenu <?php if(@$_GET['q1']==3) echo 'active';?>">
<a href="account.php?q1=3"><span class="glyphicon glyphicon-star-empty caf" aria-hidden="true"></span>
<span class="cas">Starred</span></a>
</div>
</li>

<li>
<div class="camenu <?php if((@$_GET['q1']==5))  echo 'active';?>">
<a href="account.php?q1=5"><span class="glyphicon glyphicon-share-alt caf" aria-hidden="true"></span>
<span class="cas">Shared</span></a>
</div>
</li>

<li>
<div class="camenu <?php if(@$_GET['q1']==4) echo 'active';?>">
<a href="account.php?q1=4"><span class="glyphicon glyphicon-cog caf" aria-hidden="true"></span>
<span class="cas">Activity log</span></a>
</div>
</li>

<li>
<div class="camenu">
<a href="logout.php?q=account.php"><span class="glyphicon glyphicon-log-out caf" aria-hidden="true"></span>
<span class="cas">Signout</span></a>
</div>
</li>
</ul>
</div>
<!--menu closed-->
<div class="col-md-10">
<div class="bich">
<!--content area start-->

<!--compose-->
<?php if(@$_GET['q1']==1) 
{
echo '<form style="margin:25px" name="form" action="form.php?q=account.php" onSubmit="return validateForm()" method="POST">
  <div class="form-group">
    <label for="title">Write Title:</label>
    <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
  </div>
  <div class="form-group">
  <label for="editor">write your feeling :</label>
  <textarea class="form-control ckeditor" id="editor" name="text"></textarea>
  <script type="text/javascript">
       
	   CKEDITOR.replace( "editor",
    {
	    removeButtons: "Source,About",
       
	   });
 </script> 
  </div>
  <div class="form group">
   <input type="submit" value="Save" class="sub btn sub1" style="margin-left:50%;"/></div>
  </form>';

}?>
<!--compose closed-->

<!--archive start-->
<?php if(@$_GET['q1']==2) {
$email=$_SESSION["email"];
$result = mysqli_query($con,"SELECT * FROM `articles` WHERE email = '$email' ORDER BY `articles`.`date` DESC") or die('Error');
echo  '<div class="mCustomScrollbar area" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:480px; line-height:35px;padding:5px;"><table class="table table-striped">
<tr><td></td><td><b>Title</b></td><td><b>Date</b></td><td><b>Time</b></td><td><td></td></td><td></td><td></td><td></td></tr>';
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$title = $row['title'];
	$star = $row['star'];
	$id = $row['id'];
	$share = $row['share'];
	if($star==0)echo '<tr><td><a title="not starred" href="update.php?sid='.$id.'"><b><span class="glyphicon glyphicon-star" aria-hidden="true"></span></b></a></td>';
	else echo '<tr><td><a title="starred" href="update.php?sid='.$id.'"><b><span class="glyphicon glyphicon-star" style="color:orange" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Click to open article" href="account.php?aid='.$id.'">'.$title.'</a></td><td>'.$date.'</td><td>'.$time.'</td>
	<td><a title="Open Article" href="account.php?aid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	if($share==0)echo '<td><a title="share for public" href="update.php?shid='.$id.'" ><b><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></b></a></td>';
	else echo '<td><a title="shared for public" href="update.php?shid='.$id.'" ><b><span class="glyphicon glyphicon-share-alt" style="color:orange" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Edit Article" href="account.php?eeid='.$id.'"><b><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></b></a></td>
	<td><a title="Get printable view" target="_blank" href="update.php?pid='.$id.'"><b><span class="glyphicon glyphicon-print" aria-hidden="true"></span></b></a></td>
	<td><a title="Delete Article" href="update.php?did='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>

	</tr>';
}
echo '</table></div>';


}
?>
<!--archive closed-->
<!--edit article start-->
<?php if(@$_GET['eeid']) 
{
$id=@$_GET['eeid'];
$result = mysqli_query($con,"SELECT * FROM `articles` WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$article = $row['article'];
	$email = $row['email'];
	if($email==$_SESSION['email']){	

echo '<form style="margin:25px" name="form" action="form.php?q=account.php" onSubmit="return validateForm()" method="POST">
  <div class="form-group">
    <label for="title">Write Title:</label>
    <input type="text" name="title" value=" '.$title.'" class="form-control" id="title" placeholder="Enter title">
  </div>
  <div class="form-group">
  <label for="editor">write your feeling :</label>
  <textarea class="form-control ckeditor" id="editor" name="text">'.$article.'</textarea>
  <script type="text/javascript">
       
	   CKEDITOR.replace( "editor",
    {
	    removeButtons: "Source,About",
       
	   });
 </script> 
  </div>
  <div class="form group">
   <input type="submit" value="Save" class="sub btn sub1" style="margin-left:50%;"/></div>
  </form>';
$result1 = mysqli_query($con,"DELETE FROM articles WHERE id='$id' ") or die('Error');  }
}}?>



<!--edit article end-->

<!--starred start-->
<?php if(@$_GET['q1']==3) {
$email=$_SESSION["email"];
$result = mysqli_query($con,"SELECT * FROM `articles` WHERE email = '$email' ORDER BY `articles`.`date` DESC") or die('Error');
echo  '<div class="mCustomScrollbar area" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:480px; line-height:35px;padding:5px;"><table class="table table-striped">
<tr><td></td><td><b>Title</b></td><td><b>Date</b></td><td><b>Time</b></td><td></td><td></td><td></td><td></td><td></td></tr>';
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$title = $row['title'];
	$star = $row['star'];
	$id = $row['id'];
	$share = $row['share'];
	if($star==1){echo '<tr><td><a title="starred" href="update.php?sid='.$id.'"><b><span class="glyphicon glyphicon-star" style="color:orange" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Click to open article" href="account.php?aid='.$id.'">'.$title.'</a></td><td>'.$date.'</td><td>'.$time.'</td>
	<td><a title="Open Article" href="account.php?aid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	if($share==0)echo '<td><a title="share for public" href="update.php?shid='.$id.'" ><b><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span></b></a></td>';
	else echo '<td><a title="shared for public" href="update.php?shid='.$id.'" ><b><span class="glyphicon glyphicon-share-alt" style="color:orange" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Edit Article" href="update.php?eid='.$id.'"><b><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></b></a></td>
	<td><a title="Get printable view" target="_blank" href="update.php?pid='.$id.'"><b><span class="glyphicon glyphicon-print" aria-hidden="true"></span></b></a></td>
	<td><a title="Delete Article" href="update.php?did='.$id.'"><b><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></b></a></td>

	</tr>';
}}
echo '</table></div>';


}
?>
<!--starred closed-->
<!--activity log-->
<?php if(@$_GET['q1']==4) {
$email=$_SESSION["email"];
$result = mysqli_query($con,"SELECT date,time,ip FROM log WHERE email = '$email' ORDER BY `log`.`date` DESC") or die('Error');
echo  '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:480px; line-height:35px;padding:5px;"><table class="table table-striped">
<tr><th><b>Date</b></th><td><b>Time</b></td><td><b>IP Address</b></td></tr>';
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$ip = $row['ip'];
	echo '<tr><td>'.$date.'</td><td>'.$time.'</td><td>'.$ip.'</td></tr>';
}
echo '</table></div>';
}?>
<!--activity log end-->

<!--article start-->
<?php if(@$_GET['aid']) {
$id=@$_GET['aid'];
$result = mysqli_query($con,"SELECT * FROM articles WHERE id='$id' ") or die('Error');
while($row = mysqli_fetch_array($result)) {
	$title = $row['title'];
	$article = $row['article'];
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$mail = $row['email'];
	$result1 = mysqli_query($con,"SELECT name FROM user WHERE email='$mail' ") or die('Error');
	while($row = mysqli_fetch_array($result1)) {
	$by = $row['name'];
}
echo '<a title="Back to Archive" href="update.php?q1=2"><b><span class="glyphicon glyphicon-level-up" aria-hidden="true"></span></b></a><h2 style="text-align:center; margin-top:-15px;font-family: "Ubuntu", sans-serif;"><b>'.$title.'</b></h1>';
 echo '<div class="mCustomScrollbar" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:450px; line-height:35px;padding:5px;"><span style="line-height:35px;padding:5px;">-&nbsp;<b>DATE:</b>&nbsp;'.$date.'</span>
<span style="line-height:35px;padding:5px;">&nbsp;<b>Time:</b>&nbsp;'.$time.'</span><span style="line-height:35px;padding:5px;">&nbsp;<b>By:</b>&nbsp;'.$by.'</span><br />'.$article.'</div>';}
}?>
<!--article closed-->

<!--shared article-->
<?php if(@$_GET['q1']==5) {
$result = mysqli_query($con,"SELECT * FROM `articles` WHERE share = 1 ORDER BY `articles`.`date` DESC") or die('Error');
echo  '<div class="mCustomScrollbar area" data-mcs-theme="dark" style="margin-left:10px;margin-right:10px; max-height:480px; line-height:35px;padding:5px;"><table class="table table-striped">
<tr><td><b>Title</b></td><td><b>Date</b></td><td><b>Time</b></td><td></td><td></td></tr>';
while($row = mysqli_fetch_array($result)) {
	$date = $row['date'];
	$date= date("d-m-Y",strtotime($date));
	$time = $row['time'];
	$title = $row['title'];
	$id = $row['id'];
	$share = $row['share'];
	if($share==1){
		echo '<td><a title="Click to open article" href="account.php?aid='.$id.'">'.$title.'</a></td><td>'.$date.'</td><td>'.$time.'</td>
	<td><a title="Open Article" href="account.php?aid='.$id.'"><b><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span></b></a></td>';
	echo '<td><a title="Get printable view" target="_blank" href="update.php?pid='.$id.'"><b><span class="glyphicon glyphicon-print" aria-hidden="true"></span></b></a></td>
	</tr>';
}}
echo '</table></div>';



}
?>
<!--shared article closed-->


<!--content area closed-->
</div>

</div>
</div><!--middle area closed-->

<!--Footer start-->
<div class="row footer">
<div class="col-md-3 box">
<a href="aboutus.php" target="_blank" >About us</a>
</div>
<div class="col-md-3 box">
<li data-toggle="modal" data-target="#login"><a href="#">Admin Login</a></li></div>
<div class="col-md-3 box">
<li data-toggle="modal" data-target="#developers"><a href="#">Developers</a></li>
</div>
<div class="col-md-3 box">
<a href="feedback.php" target="_blank">Feedback</a></div></div>
<!-- Modal For Developers-->
<div class="modal fade" id="developers">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange">Developers</span></h4>
      </div>
	  
      <div class="modal-body">
        <p>
		<div class="row">
		<div class="col-md-3">
		 <img src="img/CAM00121.jpg" width=100 height=100 alt="Sunny Prakash Tiwari" class="img-rounded">
		 </div>
		 <div class="col-md-5">
		<a href="https://www.facebook.com/sunnygkp10" style="color:#202020; font-size:18px" title="Find on Facebook">Sunny Prakash Tiwari</a>
		<h4 style="color:#202020; font-size:16px">+917785068889</h4>
		<h4><a href="mailto:chiraggoel.53784@gmail.com" style="color:#202020; font-size:16px">sunnygkp10@gmail.com</a>
		</h4></div><div class="col-md-4">
		</div></div>
		<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-5">
		<a href="https://www.facebook.com/chirag.goel.39948" style="color:#202020; font-size:18px"  title="Find on Facebook">Chirag Goel</a>
		<h4 style="color:#202020">+919634853784</h4>
		<h4><a href="mailto:chiraggoel.53784@gmail.com" style="color:#202020; font-size:16px">chiraggoel.53784@gmail.com</a></h4>
		</div>
		<div class="col-md-3">
		<img src="img/chirag.jpg" width="100" height="100" alt="Chirag Goel"  class="img-rounded">
		</div>
	 </div></p>
      </div>
    
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!--Modal for admin login-->
	 <div class="modal fade" id="login">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><span style="color:orange">LOGIN</span></h4>
      </div>
      <div class="modal-body">
<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
<form role="form" method="post" action="admin.php?q=account.php">
<div class="form-group">
<input type="text" name="uname" maxlength="20"  placeholder="Admin user id" class="form-control"/> 
</div>
<div class="form-group">
<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
</div>
<div class="form-group" align="center">
<input type="submit" name="login" value="Login" class="btn btn-primary" />
</div>
</form>
</div><div class="col-md-3"></div></div>
      </div>
      <!--<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>-->
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!--footer end-->

</body>
</html>