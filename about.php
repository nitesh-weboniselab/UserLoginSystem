
<html>
<head>
	<title>ABOUT</title>
</head>
<body bgcolor="#fffccc"> 

	<a href="profile.php">Profile</a>&nbsp;&nbsp;
	<a href="dashBoard.php">DASHBOARD</a>&nbsp;&nbsp;
    <a href="logout.php">Logout</a>&nbsp;&nbsp;
    <a href="editProfile.php">EDIT</a>&nbsp;&nbsp;<br/><br/>
    <table><tr><td><img src='/home/webonise/uploads/<?php echo $row['photo']?>' width=300></td></tr></table><br/>
<?php
session_start();
include 'validateSignup.php';
$userId=$_SESSION['userName'];

$obj=new signup;
$obj->showUserProfile($userId,1);
$user= new signup;
$row=$user->showUserProfile($userId,2); 
?>
</body>
</html>