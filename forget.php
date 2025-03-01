<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>UKHY - Forgot Password</title>


    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">


    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head> -->
<?php
include('smtp/PHPMailerAutoload.php');
include_once "conn.php";
$conn = connection();

function smtp_mailer($to, $subject, $msg)
{
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = 'tls';
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->IsHTML(true);
    $mail->CharSet = 'UTF-8';
    //$mail->SMTPDebug = 2; 
    $mail->Username = "prajapatiharsh1312@gmail.com";
    $mail->Password = "bpom jcxi kuno ikwh";
    $mail->SetFrom("email");
    $mail->Subject = $subject;
    $mail->Body = $msg;
    $mail->AddAddress($to);
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => false
        )
    );
    if (!$mail->Send()) {
        echo $mail->ErrorInfo;
    } else {
        return 'Sent';
    }
}
?>
<?php
$TOMAIL="";
$TOotp="";
if (isset($_REQUEST['sendotp'])) {
    $otp = random_int(111111, 999999);
    $TOotp=$otp;
    $subject = "OTP";
    $msg = <<<EOT
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">UKHAY Event Management</a>
    </div>
    <p style="font-size:1.1em">Hi,</p>
    <p>Thank you for choosing UKHAY Event Management. Use the following OTP to complete your forget password  procedures. OTP is valid for 5 minutes</p>
    <h2 style="background: #00466a;margin: 0 auto;width: max-content;padding: 0 10px;color: #fff;border-radius: 4px;">$otp</h2>
    <p style="font-size:0.9em;">Regards,<br />UKHAY Event Management</p>
    <hr style="border:none;border-top:1px solid #eee" />
    <div style="float:right;padding:8px 0;color:#aaa;font-size:0.8em;line-height:1;font-weight:300">
      <p>UKHAY Event Management</p>
      <p>Vivekanad collage,Surat</p>
      
    </div>
  </div>
</div>
EOT;



$toMail = $_REQUEST["email"];
$TOMAIL=$toMail;
    echo "<script>var a=document.getElementById('exampleInputEmail').value; a='" . $toMail . "';</script>";

    if (smtp_mailer($toMail, $subject, $msg) != 'Sent') {
        echo "<script>alert('Something want wrong!')<script>";
    } else {
        $conn = connection();
        $sql = "UPDATE signup SET otp = ? WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $otp, $toMail);
        $stmt->execute();
        $conn->close();
    }
   

}
function search_client($email)
{
    $conn = connection();
    $sql = "select email from signup where  email ='$email' ";
    $result = $conn->query($sql);


    $conn->close();
    return $result;
}
if (isset($_POST["btnreset"])) {

    $email =$_REQUEST['temail'];
    // echo "<script>alert('".$email."')</script>";
    $result = search_client($email);

    if ($result->num_rows > 0) {
        $conn = connection();
        $otp = $_POST['dotp'];
        $sql = "SELECT otp FROM signup WHERE otp = ? AND email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $otp, $email);
        $stmt->execute();
        $result1 = $stmt->get_result();

        if ($result1->num_rows > 0) {
            $password = $_POST["password"];
            $conpassword = $_POST['conpass'];

            if ($password == $conpassword) {
                // Hash the password before storing
                //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $sql = "UPDATE signup SET password = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ss", $password, $email);
                $stmt->execute();
                echo "<script>alert('Password reset successfully.')</script>";
                $sql = "UPDATE signup SET OTP = ? WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $o=0;
                $stmt->bind_param("ss", $o, $email);
                $stmt->execute();
            } else {
                echo "<script>alert('Confirm password does not match.')</script>";
            }
        } else {
            echo "<script>alert('Invalid OTP.')</script>";
        }
        $conn->close();
    } else {
        echo "<script>alert('Please Sign up first.')</script>";
    }
}


//echo smtp_mailer('to_email','Subject','html');
?>

<body class="bg-gradient-primary">

    <div class="container"> 

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0"> 
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-password-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-2">Forgot Your Password?</h1>
                                        <p class="mb-4">We get it, stuff happens. Just enter your email address below
                                            and we'll send you a link to reset your password!</p>
                                    </div>
                                    <form method="post" class="user">
                                        <div class="form-group">
                                            <input type="email" name="email" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address...">

                                        </div>
                                        <div class="form-group">
                                            <button name="sendotp" class="btn btn-primary btn-user btn-block">Send OTP</button>
                                            <input type="text" name="otp" class="form-control form-control-user"
                                                id="exampleInputOpt" aria-describedby="emailHelp" placeholder="OTP">
                                    </form>
                                </div>

                                <form class="user" method="post">
                                <div class="form-group">
                                            <input type="hidden" name="temail" class="form-control form-control-user"
                                                value="<?php echo $TOMAIL; ?>">

                                        </div> <div class="form-group">
                                            <input type="hidden" name="dotp" class="form-control form-control-user"
                                                value="<?php echo $TOotp; ?>">

                                        </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="" aria-describedby="emailHelp"
                                            placeholder="Enter Your Password...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="conpass" class="form-control form-control-user"
                                            id="" aria-describedby="emailHelp"
                                            placeholder="Enter Your  confirm Password...">
                                    </div>
                                    <button name="btnreset" class="btn btn-primary btn-user btn-block">
                                        Reset Password
                                    </button>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="sign.php">Create an Account!</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="loginn.php">Already have an account? Login!</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
<?php

?>