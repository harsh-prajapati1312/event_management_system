<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
   //

    // Process the data (example: save it to a database)
    // In this example, we just echo the input data back
    //echo "Input data received: " . $inputData;

    if (isset($_REQUEST['sendotp'])) {
        $otp = random_int(111111, 999999);
        $_SESSION['TOotp']=$otp;
        //$TOotp = $otp;
        $subject = "OTP";
        $msg = <<<EOT
<div style="font-family: Helvetica,Arial,sans-serif;min-width:1000px;overflow:auto;line-height:2">
  <div style="margin:50px auto;width:70%;padding:20px 0">
    <div style="border-bottom:1px solid #eee">
      <a href="" style="font-size:1.4em;color: #00466a;text-decoration:none;font-weight:600">UKHAY Event Management</a>
    </div>
    <p style="font-size:1.1em">Hi,</p>
    <p>Thank you for choosing UKHAY Event Management. Use the following OTP to complete your Sign Up procedures. OTP is valid for 5 minutes</p>
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
        $_SESSION['TOMAIL']=$toMail;
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
} else {
    // If not a POST request, return an error
    echo "Error: Invalid request";
}
?>