<html>
<head>
	<title>DASHBOARD</title>
</head>
<body bgcolor="#fffcc">
    <a href="profile.php">Profile</a>&nbsp;&nbsp;
    <a href="logout.php">Logout</a>&nbsp;&nbsp;
    <a href="editProfile.php">EDIT</a>&nbsp;&nbsp;
    <a href="about.php">ABOUT</a>&nbsp;&nbsp;<br/>
</body>
</html>

<?php
session_start();
include 'validateSignup.php';
echo exec("whoami");
$obj=new signup;
$obj->showUserDetails($_SESSION['userName']);
echo '<a href=changePassword.php>Change Password</a><br>';

?>