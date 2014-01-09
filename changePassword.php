<html>
<head>
	<title>Change Password</title>
</head>
<body bgcolor="#fffccc">
	<form method="post" action="#">
		<a href="profile.php">Profile</a>&nbsp;&nbsp;
		<a href="dashBoard.php">DASHBOARD</a>&nbsp;&nbsp;
		<a href="logout.php">Logout</a>&nbsp;&nbsp;
		<a href="about.php">ABOUT</a>&nbsp;&nbsp;<br/><br/>
		old password<br/><input type="password" name="oldPass"><br/>
		new password<br/><input type="password" name="newPass"><br/>
		confirm pass<br/><input type="password" name="cmfnewPass"><br/>
		<input type="submit" name="submit" value="submit">
	</form>
	<a href="profile.php"><button>Cancle</button></a>
</body>
</html>

<?php
session_start();
include 'validateSignup.php';
$obj=new signup;
if(isset($_POST['submit'])) {
	
    $passid=md5($_POST['oldPass']);
	//if(empty($_POST['oldPass']) || empty($_POST['newPass']) || empty($_POST['cmfnewPass'])) {
		if($obj->checkuserPass($passid,$_SESSION['userName'])) {
			if($_POST['newPass'] == $_POST['cmfnewPass']) {
				$obj->updatepassword($_SESSION['userName'],$_POST['newPass']);
				$obj->sendMail($_SESSION['userName'],2);
				header('Location: dashBoard.php');
			} echo "Confirm password not match</br>";
		} echo "old password not match<br>";
	//} echo "<br>All fields are manditory<br>";
}
?>