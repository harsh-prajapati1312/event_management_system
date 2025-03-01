
<?php 
 
 unset($_SESSION['Uname']);

 // Destroy the session
 session_destroy();

 // Redirect to the login page
 header("location:./loginn.php");
 exit();
?>