<!-- <html>
    <head>
        <style>
            /* Select the image by its tag */
.img1 {
  /* Add a border */
  border: 2px solid #ccc;
  /* Add some padding */
  padding: 5px;
  /* Add rounded corners */
  border-radius: 8px;
  /* Add a box shadow */
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  /* Add a maximum width */
  max-width: 100%;
  /* Center the image horizontally */
  display: block;
  margin: 0 auto;
  height:700px;
}
.back1 {
    position: fixed;
    left: 0;
    top: 0; /* You can adjust the top value if you want to change its vertical position */
    width: 10px;
}
.back1 img{
    width:65px;

}

/* Add a hover effect */
img:hover {
  /* Scale the image slightly */
  transform: scale(1.05);
}


            </style>
</head>
    <body>
    
    <div class="container">
        <a href="http://localhost/event_project1/" class="back1"><img src="img\back.png"></a>


        
        <img src="img\\payment.jpeg" class="img1">
    </div>
    
    
   

    
</body>
</html> -->


<?php
session_start();
$conn = new mysqli("localhost", "root", "", "ukhy_db");
if (!$conn) {
    die("DataBase Not Found");
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['razorpay_payment_id'])) {
    $name = $_POST['name'];
    $amount = $_POST['amt']; // Corrected from $_POST['amount']
    $payment_id = $_POST['razorpay_payment_id'];
    $payment_status = 'success'; // Assuming payment is successful, you might need to verify this from Razorpay's response

    // Insert data into pay table
    $sql = "INSERT INTO pay (name, amount, payment_status, payment_id, added_on) VALUES ('$name', '$amount', '$payment_status', '$payment_id', NOW())";
    if ($conn->query($sql) === TRUE) {
        echo "Record inserted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Razorpay Payment</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>

<form id="paymentForm" method="POST" action="">
    <input type="text" name="name" id="name" /><br/><br/>
    <input type="text" name="amt" id="amt"/><br/><br/>
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id"/>
    <input type="button" name="btn" id="btn" value="Pay Now"/>
    </form>

<script>
$(document).ready(function(){
    $('#btn').on('click', function(){
        payNow();
    });
});

function payNow(){
    var name = $('#name').val();
    var amount = $('#amt').val();

    var options = {
        "key": "rzp_test_3Mx8RnccXcc1fj", // Replace with your Razorpay API key
        "amount": amount * 100, // amount in paise (multiply by 100 as amount is in rupees)
        "currency": "INR",
        "name": "ukhy event management",
        "description": "Payment for your product",
        "image": "https://example.com/your_logo.png",
        "handler": function (response){
            $('#razorpay_payment_id').val(response.razorpay_payment_id);
            $('#paymentForm').submit(); // Submit the form after getting payment ID
        },
        "prefill": {
            "name": name,
            "email": "example@example.com",
            "contact": "9999999999"
        },
        "notes": {
            "address": "Razorpay Corporate Office"
        },
        "theme": {
            "color": "#3399cc"
        }
    };

    var rzp = new Razorpay(options);
    rzp.open();
}
</script>

</body>
</html>