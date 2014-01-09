<html>
<head>
	<title>Resetpassword Form</title>
</head>
<body bgcolor="#fffccc">
	<h1>Resetpassword</h1>
	<form method="post" action="#">
		Password:<input type="password" name="userpass" /><br/>
		Confirm password :<input type="password" name="cmfuserpass"></br>
		<input type="submit" name="submit" value="Reset">
	</form>
</body>
</html>		

<?php
include 'validateSignup.php';
session_start();
$obj= new signup;
$user=$_GET['name'];
echo "USER NAME == $user<br>";
if(isset($_POST['submit'])){
if($_POST['userpass'] == $_POST['cmfuserpass']) {
	if ($obj->validatePassword($_POST['userpass' ])) {
		$userpass=$_POST['userpass'];
		if($obj->updatepassword($user,$userpass)) {
			$obj->sendMail($user,2);
			echo '<br><a href=login.php>signin</a>';
		}

	} 
	
} else echo "Enter same password for Confirm password"."<br>";
}

?>
