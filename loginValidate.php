<?php
include 'validateSignup.php';

$obj=new signup;
if (isset($_POST['login'])) {
	if (isset($_COOKIE['username'])) {
		header('Location: profile.php');
	}
}
$Name = $_POST['userName'];
$password = $_POST['passid'];
$passid=md5($password);


if(!($obj->checkUniqueName($Name))) {
	if($obj->checkuserPass($passid)) {
		session_start();
		$_SESSION['userid']="$Name";
		$_SESSION['password']="$passid";
		if(isset($_POST['remember'])) {
			setcookie("username",$Name);
		}
		header('Location: profile.php');
	} else echo "invalid password.." ."<br>";
} else echo "invalid User name.." . "<br>";
?>
