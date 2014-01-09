<?php
class signup {
	public $flag=0;
	public $userName="";
	public $email="";
	public $passid="";
	public $cmfpassid="";
    
    /**
    * checkUniqueName()
    *
    * This function is used to check whether same user name present or not
    *                1) Accept user name 
    *               2) Check user name exist or not 
    *               3) if exist return false (0)
    *               4) if not exist return true (1)
    *
    * @param (string)
    * @return (int)
    */
	function checkUniqueName($name) {
		
		$user	= "root";
		$pass	= "tiger";

		$connection = new PDO("mysql:host=localhost;dbname=test",$user,$pass);

		$sql = 'SELECT * FROM user';
		$stmt	 = $connection->query($sql) or die("failed!");
		while($r = $stmt->fetch(PDO::FETCH_ASSOC)){
			if($name ==$r['userName']){
				return 0;
			}
		}
		return 1;
	}
    





    /**
    * updatepassword()
    *
    * This function is used to set new password 
    *                 1) Accept username and password 
    *                 2) set new password to defined username
    *                 3) if new password set return true (1)
    *                 4) if unable to set new password return false (0)
    * 
    * @param (string,string)
    * @return (int)
    */
	function updatepassword($user,$userpass) {
		$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
		$password= md5($userpass);
		echo "in update==$user<br>";
		$sql = "UPDATE user set password='$password' where userName='$user'";

		if($stmt= $connection->query($sql) or die("failed!")) {
			echo "Reset Successfully...". "<br>";
			return 1;
		} else {
			echo "Problem occurred..." . "<br>";
			return 0;
		}

	}




    
    /**
    * checkuserPass()
    * 
    * This function is used to check whether entered password is correct or not. 
    *                            1) Accept password
    *                            2) Retrive password from database for specified user 
    *                            3) Check retrived password with user entered password 
    *                            4) if password match return true (1)
    *                            5) if password not match return false (0)
    *
    * @param (string)
    * @return (int)
    */ 
	function checkuserPass($password,$userName) {
		$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
		$sql = "SELECT * FROM user where userName='$userName'";
		$stmt	 = $connection->query($sql) or die("failed!");
		$r = $stmt->fetch();
			if($password ==$r['password']) {
				return 1;
			}
		
		return 0;
	}
    

    /**
    * semdMain()
    *
    * This function is used to send email to user on Creation of new account , to send link to reset password  and to notify on successful change of password  
    *
    * @param (string,string)
    * @return ()
    */
	function sendMail($userName,$flag) {

		$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
		$sql = "SELECT emailId  FROM user where userName='$userName'";
		$stmt	 = $connection-> query ($sql) or die("failed");
		$r = $stmt->fetch();
		$emailId=$r['emailId'];
		if($flag==1) {
			$to = $emailId;
			$subject = "Password change link";
			$message = "Hello! Click on link to reset password. http://localhost/Assignment4/run/resetPassword.php?name=" .$userName ;
			$from = "nitesh.wadekar@weboniselab.com";
			$headers = "From:" . $from;
			if(mail($to,$subject,$message,$headers)) {
				echo "Mail Sent.";
			} else echo "Not sent";
		} 
		if($flag==2) {
			$to = $emailId;
			$subject = "password changed Successfully";
			$message = "Hello $userName your password changed on" .date("F j, Y, g:i a");
			$from = "nitesh.wadekar@weboniselab.com";
			$headers = "From:" . $from;
			if(mail($to,$subject,$message,$headers)) {
				echo "Mail Sent.";
			} else echo "Not sent";
			
		}
		if ($flag==3) {
			$to = $emailId;
			$subject = "Account Created Successfully";
			$message = "Hello" . " " . $userName. " welcome to weboniselab." . "http://localhost/Assignment4/run/login.php?name=". $userName . "  " . "Click above link to login.";
			$from = "nitesh.wadekar@weboniselab.com";
			$headers = "From:" . $from;
			if(mail($to,$subject,$message,$headers)) {
				echo "Mail Sent.";
			} else echo "Not sent";
		}
	}
	
    
    /**
    * storeUserDetails()
    *
    * This function is used to store user details.
    * if user details are store successfully return true (1) otherwise return false (0)
    *                          
    * @param ()
    * @return (int)
    */
	function storeUserDetails() {
		$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
		$password = md5($_POST['passid']);
		$stmt = $connection-> prepare('insert into user values(:username,:email,:pass)');
		$stmt->bindParam(':username',$_POST['userName']);
        $stmt->bindParam(':email',$_POST['email']);
		$stmt->bindParam(':pass',$password);
		$stmtOne = $connection->prepare('insert into userProfile (userId) values(:username)');
		$stmtOne->bindParam(':username',$_POST['userName']);
		if($stmt->execute()) {
		  if($stmtOne->execute()) {
			    return 1;
		    } else return 0;
		} else return 0;
	}
    
    

    /**
    * storeuserProfile()
    *
    * This function is used to store user profile details.
    * if user profile details are store successfully return true (1) otherwise return false (0)
    *
    * @param (string,string,string,string,string,string)
    * @return (int)
    */
    function storeuserProfile($firstName,$lastName,$file_name,$DOB,$gender,$userId) {
    	$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
    	$sql = "UPDATE userProfile set firstName='$firstName' ,lastName='$lastName' , DOB='$DOB' , gender='$gender' , photo='$file_name'  where userId='$userId'";
    	if($stmt= $connection->query($sql) or die("failed!")) {
			return 1;
		} else {
			return 0;
		}
    	
    }

    /**
    * showUserDetails()
    *
    * This function is used for display user details and user profile details when user click on dashboard.
    *
    * @param (string)
    *
    *
    */

	function showUserDetails($userName) {
		$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
		$sql = "SELECT * FROM user where userName='$userName'";
		$stmt	 = $connection->query($sql) or die("failed!");
		$r = $stmt->fetch();
		echo "Username: " .$r['userName'] . "<br>" ;
		echo "Email ID: " .$r['emailId'] . "<br>" ;
		$sql1 = "SELECT * FROM userProfile where userId='$userName'";
		$stmt= $connection->query($sql1) or die("failed!");
		$r1 = $stmt->fetch();
		echo "Firstname: " .$r1['firstName'] . "<br>" ;
		echo "Lastname: " .$r1['lastName'] . "<br>" ;
		echo "Birthdate: " .$r1['DOB'] . "<br>" ;
		echo "Gender: " .$r1['gender'] . "<br>" ;
		
	}
    


    /**
    * showUserProfile()
    *
    * This function is used for display user profile details when user click on about.
    *
    * @param (string)
    *
    *
    */

	function showUserProfile($userId,$flag) {
         
		$connection = new PDO ('mysql:host=localhost;dbname=test', 'root','tiger');
		$sql = "SELECT * FROM userProfile where userId='$userId'";
		$stmt	 = $connection->query($sql) or die("failed!");
         
		$r = $stmt->fetch();
        
		if($flag==2) return $r;
		echo "Firstname: " .$r['firstName'] . "<br>" ;
		echo "Lastname: " .$r['lastName'] . "<br>" ;
		echo "Birthdate: " .$r['DOB'] . "<br>" ;
		echo "Gender: " .$r['gender'] . "<br>" ;

	}
    

    /**
    * validatename()
    *
    * This function is used to check enter user name is valid  or not.
    * if entered user name is valid return true (1) otherwise return false (0)
    * 
    * @param (string)
    * @return (int)
    */

	function validatename($usename) {
		/*if(empty($username)) {
			echo "Enter Name nitesh<br>";
			return 0;
		} else {*/
			if(!eregi("^[A-Za-z]+$",$_POST['firstName'])) {
				echo "Name contain only characters<br>";
				return 0;
			} else return 1;
		//}
	}

    /**
    * isEmpty()
    *
    * This function is used to check whether field is empty or not
    * if the field is empty show error message and return false (0)
    * if  mandatory fields are not empty then it return true (1)
    * 
    * @return (int) 
    */

	function isEmpty() {

		if(empty($_POST['userName'])) {
			$nameErr = "missing user name" .  "<br>";
			echo "$nameErr";
			$flag=1;
		} 
		if(empty($_POST['email'])) {
			$emailErr= "missing email" .  "<br>";
			echo "$emailErr";
			$flag=1;
		} 

		if(empty($_POST['passid'])) {
			echo $passidErr= "missing password" .  "<br>";
			$flag=1;
		} 
		if(empty($_POST['confpassid'])) {
			echo $passidErr= " missing Confirm password" .  "<br>";
			$flag=1;
		} else {
			$cmfpassid =($_POST['passid']);
		}  
		if(!isset($_POST['terms'])) {
			echo $genderErr = "Must have to accept Terms and conditions.." .  "<br>";
			$flag=1;
		}  
		if($flag==1) {
			return 0;
		} else return 1;
	}
    

    /**
    * validateUserName()
    * 
    * This function is used to validate username (username must contain alphanumaric and special character. 
    * if username is valid then retuen true (1) otherwise false (0)
    * 
    * @return (int)
    */
	function validateUserName() {
		if(!preg_match("/(?=.*[a-z])(?=.*\d.)/", $_POST['userName'])) {
			echo "<br>"  .$errors[] = 'invalid  user name. user name must be alphanumaric and contains all special character' . "<br>";
			$flag=1;
		} else {
			$userName = $_POST['userName'];
			
		}
		if($flag==1) {
			return 0;
		} else return 1;
	}	
    
    /**
    * validateEmail()
    * 
    * This function is used to validate user email id
    * if user email id is valid then retuen true (1) otherwise false (0)
    *
    * @return (int)
    */

	function validateEmail() {
		if(!eregi('^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$',$_POST['email'])) {
			echo "<br>"  .$errors[] = ' invalid email address' . "<br>";
			$flag=1;
		} else $email=$_POST['email'];
		if($flag==1) {
			return 0;
		} else return 1;
	}			
    

    /**
    * validatePassword()
    * 
    * This function is used to validate user password (password must contain upper and lower charater , special character and length should in five to tweleve)
    * if user password is valid then retuen true (1) otherwise false (0)
    *
    * @return (int)
    */

	function validatePassword($password) {
		$length=strlen($_POST['passid']);
		$passcheck=0;
		if(!preg_match("/(?=.*[A-Z])(?=.*[a-z])(?=.*\d.)/", $password)) {
			echo "invalid Password... password must contain atleast one upper and lower case character and one number" . "<br>";
			$passcheck=1;
			$flag=1;
		}
		if(!preg_match("/(?=.*[,\;\?\!])/",$password)) {
			echo "invalid Password...password must contain atleast one special character (,\;\?\!) " . "<br>";
			$passcheck=1;
			$flag=1;
		}
		if (strlen($password)<5 || strlen($password)>12) {
			echo "LENGTH==" .strlen($password);
			echo "invalid Password ....minimum password length is 5 and max length is 12" . "<br>";
			$passcheck=1;
			$flag=1;
		}
		if($passcheck==0) {
			$passid=$_POST['passid'];
			return 1;
		} else return 0;
	}
    

    /**
    * checkPass()
    *
    * This function is used to compare whteher the entered password and confirm password fields are same or not.
    * if both passwords match then return true (1) otherwise return false (0)
    *
    * @return (int)
    *
    */

	function checkPass() {
		if($_POST['passid'] == $_POST['confpassid']) {
			return 1;
		} else {
			echo "Please enter same password in confirm password ....". "<br>";
			return 0;
		}
	}
}
?>