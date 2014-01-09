<html>
<head>
	<title>Profile</title>
</head>
<body bgcolor="#fffcc">
<?php
session_start();
echo '<a href=dashBoard.php>DASHBOARD</a>'. "     ";
echo '<a href=logout.php>LOGOUT</a>'. "     ";
echo '<a href=editProfile.php>EDIT</a>'. "     ";
echo '<a href=about.php>ABOUT</a>'. "     ";
echo "<br><br>Welcome  " .$_SESSION['userName']; 





?>
<img src="upload/image-explosion-colors-background-beautiful-263613.jpg" width=200>
</body>
</html>