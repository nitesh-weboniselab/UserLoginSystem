UserLoginSystem
===============


1) File validateSignup.php contain class signup.
   class contains following methods
   1 . checkUniqueName
   2. updatepassword
   3. checkuserPass
   4. sendMail
   5. storeUserDetails
   6. storeuserProfile
   7. showUserDetails
   8. showUserProfile
   9. validatename
   10. isEmpty
   11. validateUserName
   12. validateEmail
   13. validatePassword
   14. checkPass


2) signup.php contains code for signup page and validation of user entered data.
   when user successfully signup  an confirmation mail is send to him.

3)login.php contains code for login page and to authenticate the user.

3) profile.php contains code menu dashboard , edit , about and logout
4) dashBoard.php contains code to show user details and also allows user to change password
   after change of password it send change password mail to user.
5) editProfile.php contains code to edit user details.
6)about.php contains code to display user details and user photo

7) resetPassword.php is used when user forgot password. it contains code to reset user password.
 
 
 
 DATABASE SCHEMA :

we required two tables
1) " user "  having     userName , emailId and  password  field;
2) "userProfile " having firstName , lastName , DOB , gender ,userId and photo fields; 



create table user(userName char(100),emailId char(100),password char(100));

create table userProfile(firstName char(100), lastName char(100), DOB char(50) , gender char(10) ,userId char(100),photo char(200));
