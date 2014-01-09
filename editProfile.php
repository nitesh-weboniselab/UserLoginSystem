
<?php
session_start();
include 'validateSignup.php';
$obj=new signup;

$r=$obj->showUserProfile($_SESSION['userName'],2);
if(isset($_POST['submit'])) {
	

	if($obj->validatename($_POST['firstName'])) {
		if($obj->validatename($_POST['lastName'])) {
			if ($_FILES["file"]["error"] > 0) {
				echo "Error : " . $_FILE["file"]["error"] . "<br>";
			} else {


				if (($_FILES["file"]["type"] == "image/gif")
					|| ($_FILES["file"]["type"] == "image/jpeg")
					|| ($_FILES["file"]["type"] == "image/jpg")
					|| ($_FILES["file"]["type"] == "image/pjpeg")
					|| ($_FILES["file"]["type"] == "image/x-png")
					|| ($_FILES["file"]["type"] == "image/png") && ($_FILE["file"]["size"]<=2097152)) {
					$tmp = $_FILES["file"]["tmp_name"];
				$dst = "/home/webonise/uploads/{$_FILES["file"]["name"]}";
                    // echo $tmp."<br>";
				echo "Destination Path : ".$dst."<br />";

				if(move_uploaded_file($_FILES["file"]["tmp_name"],$dst)) {
					echo "Success<br>";
				}

				if(!isset($_POST['gender'])) {
					echo "Must select one gender.." .  "<br>";
					
				} else {
					$pattern = '#^((0[1-9])|([1-2][0-9])|(3[0-1]))/((0[1-9])|(1[0-2]))/(200[(0-9)])$#';

					if (1 === preg_match($pattern, $_POST['DOB'])) {
						
						if($obj->storeuserProfile($_POST['firstName'],$_POST['lastName'],$_FILES["file"]["name"],$_POST['DOB'],$_POST['gender'],$_SESSION['userName'])){
							echo "Added...<br>";
							         header('Location: profile.php');
						} else echo "Some Problem occurred check database connection<br>";

					} else {
						echo "Enter valid birthdate....<br>";

					}	
				}

			} else {
				echo "Please Insert Profile Picture which is upto 2MB..!!!" . "<br>";
			}
		} 
	}

}
}
?>



<html>
<head>
	<title>Add user details</title>
	
</head>
<body bgcolor="#fffcc">
	<a href="profile.php">Profile</a>&nbsp;&nbsp;
	<a href="dashBoard.php">DASHBOARD</a>&nbsp;&nbsp;
	<a href="logout.php">Logout</a>&nbsp;&nbsp;
	<a href="about.php">ABOUT</a>&nbsp;&nbsp;<br/><br/>
	<form  name="edit" method="post" action="#" enctype="multipart/form-data">
		<table>
			First Name:<input type="text" name="firstName" value = <?php echo $r['firstName'] ?> ><br/>
			Last Name:<input type="text" name="lastName" value=<?php echo $r['lastName'];?>><br/>
			Profile Pic:<input type="file" name="file" ><?php echo $r['photo'];?><br/>
			Birth date:<input type="text" name="DOB" value=<?php echo $r['DOB'];?>><br/>
			Gender     :<input type="radio" id="male" name="gender" value="Male" <?php if($r['gender']=="Male"){echo 'checked="checked"';}?> />Male
			<input type="radio" id="female" name="gender" value="Female" <?php if($r['gender']=="Female"){echo 'checked="checked"';}?> />Female<br/>
			<input type="submit" name="submit" value="submit">
		</table>
	</form> 

</body>
</html>


