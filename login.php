<html>
<head>
	<title>Login</title>
	<?php
	if (isset($_COOKIE['username'])) {
		//if(!isset($_SESSION['userName'])) // if user is not able to login againf remove this commit
			//$_SESSION['userName']=$_POST['userName'];
			header('Location: profile.php');
	}
	?>
</head>
<body bgcolor="#ffcccc"> <a href=home.php>HOME</a>
	<h1>Login</h1> 
	<form  method="post" action="#" >
		Username:
		<input type="text" name="userName"  value='<?php echo $_SESSION['userName'];?>'/>
		Password:
		<input type="password" name="passid" id="passid"/><br/>
		<input type="checkbox" name="remember" value="yes" >Remember me
		<input type="submit" name="login" id="login" value="LOGIN">
	</form>
	<a href="forgotPassword.php">Forgot Password</a>
</body>
</html>

<?php
session_start();
include 'validateSignup.php';

if(isset($_POST['login'])) { 
	if (empty($_POST['userName'])) {
		echo "Enter User Name<br>";
	} else {
		if (empty($_POST['passid'])) {
			echo "Enter Password<br>"; 
		} else {

			$obj=new signup;
			/*if (isset($_POST['login'])) {
				if (isset($_COOKIE['username'])) {

					$_SESSION['userName']=$_POST['userName'];
					header('Location: profile.php');
				}
			}*/
			$Name = $_POST['userName'];
			$password = $_POST['passid'];
			$passid=md5($password);

			//if(isset($_POST['login'])) {
				if(!($obj->checkUniqueName($Name))) {
					if($obj->checkuserPass($passid,$Name)) {
						
						if(isset($_POST['remember'])) {
							setcookie("username",$Name);
						}

						$_SESSION['userName']=$_POST['userName'];
						$_SESSION['userid']="$Name";
						$_SESSION['password']="$passid";
						header('Location: profile.php');
					} else echo "invalid password.." ."<br>";
				} else echo "invalid User name.." . "<br>";
			//}
		}
	}
}
?>
