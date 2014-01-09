<html>
<head>
<title>Forgot Password</title>
</head>
<body bgcolor="#ffcccc">
	<form method="post" action="#">
		*Enter User name:
		<input type="text" name="userName" id="userName"/>
		<input type="submit" name="Submit" />
	</form>
</body>
</html>

<?php
session_start();
include 'validateSignup.php';
$_SESSION['user']= $_POST['userName'];
$obj=new signup;	
if(!($obj->checkUniqueName($_POST['userName']))) {
	$obj->sendMail($_POST['userName'],1);
	echo "link is send to set new password on registered email<br>";
}	
?>