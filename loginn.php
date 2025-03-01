<?php
include_once "crud.php";
$emailerr = "";
$passworderr = "";
$welcome="";
if (!isset($_SESSION['login_attempts'])) {
	$_SESSION['login_attempts'] = 0;
}
$max_attemp=3;
session_start(); 
function sanitizeAndFilterXSS($data) {
    // Remove potential script tags
    $data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $data);
    
    // Remove potential on* attributes
    $data = preg_replace('/\bon\w+\s*=\s*".*?"/i', '', $data);
    
    // Remove potential JavaScript events
    $data = preg_replace('/\b(?:on(?:click|dblclick|mousedown|mouseup|mouseover|mousemove|mouseout|keypress|keydown|keyup|focus|blur|change|select|submit|reset))\s*=\s*".*?"/i', '', $data);
    
    // Remove potential HTML attributes like "javascript:"
    $data = preg_replace('/\b(?:javascript|vbscript)\b\s*:/i', '', $data);
    
    // Remove any HTML tags except for the allowed tags
    $allowedTags = '<b><strong><i><em><ul><ol><li><a>';
    $data = strip_tags($data, $allowedTags);

    // Convert special characters to HTML entities
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    return $data;
}

if(isset($_REQUEST['btnlogin']))
{		
    $email=sanitizeAndFilterXSS($_REQUEST['txtemail']);
    $password=$_REQUEST['txtpassword'];			
	 
	if ($_SESSION['login_attempts'] >= $max_attemp) {
		echo "<script>alert('You have exceeded the maximum number of login attempts. Please try again later.')</script>";
		sleep(30);
		$max_attemp++; // Wait for 30 seconds before allowing the next attempt
	}

	// Increment login attempt counter
	$_SESSION['login_attempts']++;
    if ($_REQUEST['txtemail'] == "") {
        $emailerr = "Email is required";
    }
    if ($_REQUEST['txtpassword'] == "") {
        $passworderr = " Password is required";
    }

    // $Username=$_REQUEST['txtusername'];
    $password=md5(sanitizeAndFilterXSS($_REQUEST['txtpassword']));
    $result1=search_emp($email,$password);
if($result1->num_rows>0)
while($row=$result1->fetch_assoc())
{
        if ($email==$row['email'] && $password==$row['password'])
        {
            
                if($email=="admin@gmail.com"&&$password=="admin")
                {
                    header("Location:/event_project1/admin/");


                }
                else 
                {
                    $_SESSION['Uname'] = $row['email'] ;
             
                    header("Location: index.php");	

                }
                   
                        //echo "<script>alert('session is start   ')</script>";
               
        }
        else
        {

            $welcome="Wrong email & password";
        }
}

else
{
    $welcome="Wrong email & password";
}
   
   

}



?>















<!doctype html>
<html lang="en">
  <head>
  	<title>Login </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="css/stylel.css">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	</head>
	<body class="img js-fullheight" style="background-image: url(images/bg.jpg);">
	<section class="ftco-section">
		       
	<div class="limiter">
	
		<div class="container-login100">
		<div class="wrap-login100">
		<div class="login100-pic js-tilt" data-tilt>
					<img src="img\Event.png" alt="IMG">
				</div>
				

			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section"></h2>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center"></h3>
		      	<form class="login100-form validate-form" method="post">
					<span class="login100-form-title">
						<h4>	LOGIN </h4>
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" placeholder="email"  name="txtemail">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-user" aria-hidden="true"></i>
						</span>
					</div> <span  style="color:red;"><?php echo $emailerr ; ?></span>
               
				
						<div class="wrap-input100 validate-input" data-validate = "Password is required">
						<input class="input100" input id="password-field" type="password"  placeholder="Password" name="txtpassword">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
						
					</div> <span  style="color:red;"><?php echo $passworderr ; ?></span>
               
				
					<div class="container-login100-form-btn">
					<span  style="color:red;"><?php echo $welcome ; ?></span>
               
						<button class="login100-form-btn" name="btnlogin">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
					</div>
					<div class="w-50 text-md-right">
						<a href="f.php" style="color: #fff">Forgot Password</a>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="forget.php" id="fp">
							Username / Password?
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="signup.php">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"  name="btnsignup"></i>
						</a>
					</div>

							</form>
	          </div>
				</div>
			</div>
		</div>
		</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>

	</body>
</html>

