<html>
<head>
	<title>User Registration</title>
</head>
<body>
	<h1 align="center">Registration Form</h1>
	<form name="registration" method="post" action="#" >
		<table   bgcolor="#ffcccc" width="800" align="center">
			<tr>
				<td>User Name:*</td>
				<td><input type="text" id="userName" name="userName" value='<?php echo $_POST['userName'];?>' size="50" /></td>
			</tr>
			<tr>
				<td>Email:*</td>
				<td><input type="text" id="email" name="email"  value='<?php echo $_POST['email'];?>' size="50" /></td>
			</tr>
			<tr>
				<td>Password:*</td>
				<td><input type="password" id="passid" name="passid" value='<?php echo $_POST['passid'];?>'size="12" /></td>
			</tr>
			<tr>
				<td>Confirm Password:*</td>
				<td><input type="password" id="confpassid" name="confpassid" value='<?php echo $_POST['confpassid'];?>'size="12" /></td>
			</tr>
			<tr>
				<td><input type="checkbox" name="terms" value="accept" <?php if (($_POST['terms']) == 'accept') {echo 'checked="checked"';} ?></td>
				<td><a href="terms.php">*Terms and conditions</td> 
			</tr>
			<tr>
				<td align="center"><input type="submit" name="submit" value="Submit" /></td>
			</tr>
		</table>	
		
	</form>                                                    
</body>
</html>


<?php
include 'validateSignup.php';
session_start();
if(isset($_POST['submit'])) {
	$obj = new signup;
	if ($obj->isEmpty()) {
		if($obj->validateUserName()) {
			if($obj->checkUniqueName($_POST['userName'])) {


				if($obj->validateEmail()) {
					$pass=$_POST['passid'];
					if($obj->validatePassword($pass)) {
						if($obj->checkPass()) {
							if($obj->storeUserDetails()) {
								echo "Registration Done...." ."<br>";
								$obj->sendMail($_POST['userName'],3);
								echo "<a href=home.php>HOME</a>";
							} else "Some Technical problem occurred...." ."<br>";
						}
					}
				}
			} else {
				echo "User name already exist. Enter another name" . "<br>";

			}
		}
	}
}
?>  