<?php
		include_once "conn.php";

		$conn=connection();
       
       $welcome="";
		     
		$error="";
		$username="";
		$name="";
		$email="";
		$contact="";
		$password="";
		$confirmPassword="";
		
		
		$usernameError="";
		$nameError="";
	    $emailError="";
		$contactError="";
		$passwordError="";
		$confirmPasswordError="";
		$passwordMismatchError="";
		$resultMessage = "";
		$resultMessagee = "";

		$isValid = true;

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

			$name=sanitizeAndFilterXSS($_REQUEST['name']);
			$username=sanitizeAndFilterXSS($_REQUEST['txtusername']);
            $email=sanitizeAndFilterXSS($_REQUEST['txtemail']);
			$contact = sanitizeAndFilterXSS($_POST['txtcontact']);
			$password=sanitizeAndFilterXSS($_REQUEST['txtpassword']);
			$confirmPassword=sanitizeAndFilterXSS($_REQUEST['txtconfirmpassword']);
			

			if ($_REQUEST['txtusername'] == "") {
				$usernameError = "Username is required.";
				$isValid = false;
			}
						
			function validateName($name) {
				// The regular expression allows only alphabets (both lowercase and uppercase)
				$pattern = '/^[a-zA-Z]+$/';
				return preg_match($pattern, $name);
			}

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$name = $_POST["name"];

				if (validateName($name)) {
					$resultMessage = "";
				} else {
					$resultMessage = "(Please enter only alphabets)";
					$isValid = false;
				}
			}
		   
			if ($_REQUEST['name'] == "") {
				$nameError = "Firstname is required.";
				$isValid = false;
			}

			
						

		


			if ($_REQUEST['txtemail'] == "") {
				$emailError = " Email is required.";
				$isValid = false;
			}
			




									
			
			// Check if the phone number is empty
			if (empty($contact)) {
				$contactError = "Phone number is required.";
				$isValid = false;
			} else {
				// The HTML pattern attribute enforces the length and numeric characters, so no additional checks are needed here.
			}
		
			if ($_REQUEST['txtpassword'] == "") {
				$passwordError = "Password is required.";
				$isValid = false;
			}
			
			if ($_REQUEST['txtconfirmpassword'] == "") {
				$confirmPasswordError = "Confirm password is required.";
				$isValid = false;
			}

			if ( $_REQUEST['txtpassword'] !==  $_REQUEST['txtconfirmpassword']) {
				$passwordMismatchError = "Password and Confirm password is not match.";
				$isValid = false;
			}
			
			if($isValid == true){
				$conn=connection();
				$username=$_REQUEST['txtusername'];
                $password=md5($password);
				$sql1="select * from signup where username='$username'";
				$result=$conn->query($sql1);
				if($result->num_rows>0)
				{
					?>
    <script> alert("Username is not Unique. Please choose anothor.")</script>
    <?php 
					
				}
				else{
					$sql="insert into signup values('$name','$username','$email',0,'$contact','$password')";
				
				$conn->query($sql);
            $conn->close();
            ?>
            <script>alert("SignUp Successfully")</script>
           
            <?php
           
            header("localtion:loginn.php");
				}
				
			}
			// else
			// {
			//     echo "<script>alert('confirm password is not match')</script>";
			// }
		}


	?>

<html>

<head>
<title>Login V1</title>
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
<!--===============================================================================================-->
</head>
</head>

<body>
    <div class="container-fluid">
        <div class="content" style="margin-left:25%; ">
            
        </div>

        <div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="img\Event.png" alt="IMG">
				</div>
  

                  
                

            
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section"></h2>
                </div>
            </div>
            <div class="row justify-content-center ">
                <!-- <div class="col-md-6 col-lg-4"> -->
                    <!-- <div class="login-wrap p-0"> -->
                        <!-- <h3 class="mb-4 text-center"></h3> -->
                        <form class="login100-form validate-form form2" method="POST">
                            <span class="login100-form-title">
                                <h4 class="signup_font animate__animated animate__fadeInDown"> SIGN UP </h4>
                            </span>

                            <div class="wrap-input100 validate-input"
                                data-validate="Valid Username is required: ex@abc.xyz">
                                <input class="input100 animate__animated animate__fadeIn" type="text" name="txtusername"
                                    placeholder="Username">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <span style="color:red;">
                                <?php echo $usernameError ?>
                            </span>

                            <div class="wrap-input100 validate-input"
                                data-validate="Valid Firstname is required: ex@abc.xyz">
                                <input class="input100 animate__animated animate__fadeIn" type="text" id="name"
                                    name="name" placeholder="Firstname">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                </span>
                            </div>
                            <span style="color:red;">
                                <?php echo $nameError ?>
                            </span>
                            <span style="color:red;">
                                <?php echo$resultMessage ?>
                            </span>




                            <div class="wrap-input100 validate-input"
                                data-validate="Valid email is required: ex@abc.xyz">
                                <input class="input100 animate__animated animate__fadeIn" type="email" name="txtemail"
                                    placeholder="Email">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-envelope" aria-hidden="true"></i>
                                </span>
                            </div>
                            <span style="color:red">
                                <?php echo $emailError ?>
                            </span>


                            <div class="wrap-input100 validate-input"
                                data-validate="Valid phone number is required: 1234567890">
                                <input class="input100 animate__animated animate__fadeIn" type="text" name="txtcontact"
                                    pattern="[0-9]{10}" title="Enter a 10-digit phone number" placeholder="Phone No"
                                    maxlength="10">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-phone" aria-hidden="true"></i>
                                </span>
                            </div>

                            <span style="color:red;">
                                <?php echo $contactError ?>
                            </span>




                            <div class="wrap-input100 validate-input" data-validate="Password is required">
                                <input class="input100 animate__animated animate__fadeIn" input id="password-field"
                                    type="password" name="txtpassword" placeholder="Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>

                                </span>

                            </div> <span style="color:red">
                                <?php echo $passwordError ?>
                            </span>


                            <div class="wrap-input100 validate-input" data-validate="Confirm is required">
                                <input class="input100 animate__animated animate__fadeIn" input id="passwordd-field"
                                    type="password" name="txtconfirmpassword" placeholder="Confirm Password">
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
                                    <i class="fa fa-lock" aria-hidden="true"></i>

                                </span>
                                

                            </div>

                            <span style="color:red">
                                <?php echo $confirmPasswordError ?>
                            </span>
                            <span style="color:red">
                                <?php echo $passwordMismatchError ?>
                            </span>

                            <div class="text-center p-t-136">
						<a class="txt2" href="loginn.php">
							Already  your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>

                            <div class="container-login100-form-btn">
                            <a class="txt2" href="loginn.php">
                                <button class="login100-form-btn" name="btnlogin" > 
                                    Signup
                                </button>
                                
                            </div>

                            <div class="text-center p-t-12">
                            </div>
                            
                       
                        </form>
                    <!-- </div> -->
                <!-- </div> -->
            </div>
        </div>  </div>
    </div>

    </section>
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>


                    <?php
                    // Display errors if any
                    if (!empty($errors)) {
                        echo '<div style="color: red; margin-top: 0px;">';
                        foreach ($errors as $error) {
                            echo $error . '<br>';
                        }
                        echo '</div>';
                    }
                    ?>
                
            </center>
        </div>

    </div>
</body>

</html>