<?php
echo "Successfully Logout";
session_destroy();
unset($_SESSION['userName']);
setcookie("username", "", time()-3600);
header('Location: login.php');
?>