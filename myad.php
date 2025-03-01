<?php

session_start(); 
include "conn.php";


if (isset($_GET['dl'])) {
    $decryptedID = htmlspecialchars($_GET['dl']); // Ensure proper handling of user input

    // Escape PHP and enter JavaScript block
    echo "<script>";
?>
    let a = confirm('Are you sure you want to delete?');
    if (a) {
        window.location.href = 'delete.php?dl=<?php echo $decryptedID; ?>';
        alert('Your Booking is deleted');
    } else {
        alert('Deletion canceled');
    }
<?php
    echo "</script>";
}
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
    $sql = "INSERT INTO pay (booking_Id, amount, payment_status, payment_id, added_on) VALUES ('$name', '$amount', '$payment_status', '$payment_id', NOW()); ";
    $sql1="UPDATE tblbooking SET is_paid=1 where BookingID='$name'";
    if ($conn->query($sql) === TRUE &&  $conn->query($sql1) === TRUE) {
        echo "<script>alert('Record inserted successfully')</script>";
        header("location:myad.php");
        exit();
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <title>My Booking</title>

    <style>
        body {
            background-image: url("img/bg.jpg");
            background-repeat: no-repeat;
            background-size: cover;
        }

        .img-new {

            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .back {
            position: fixed;
            left: 100;
            top: 100;
            /* You can adjust the top value if you want to change its vertical position */
            width: 10px;
        }

        .back img {
            width: 65px;

        }
    </style>
</head>

<body>
    <div class="container">

        <?php
        // Connect to the database
        $conn = mysqli_connect("localhost", "root", "", "ukhy_db");
        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $email = $_SESSION['Uname'];
        // Retrieve booking details from the database
        #$sql = "SELECT * FROM tblbooking where Email='$email' and Status != 'Deleted'";
        $sql = "SELECT * FROM tblbooking where Email='$email' ";
        $result = mysqli_query($conn, $sql);

        // Display each booking detail in a table row
        if (mysqli_num_rows($result) > 0) {
            ?>
            <div class="container mt-4">
                <h1 class="my-4">Booking Details</h1>
                <a href="http://localhost/event_project1/" class="back" style="margin: 13px 50px 50px 1300px; width: 80px"><img src="img/back.png"></a>
              
                        <?php 
                        while($row=$result->fetch_assoc())
                        {
                        ?>
                        <form id="paymentForm" method="POST" action="">
                <table  border="1"class="table align-items-center table-flush table-bordered">
                    <thead>
                        <tr >
                            <th scope="col">Your Booking ID</th>
                          
                    
                           <?php
                            echo "<td scope='row'>
                            <input type='hidden' name='name' id='name' value=". $row["BookingID"] ." />" . $row["BookingID"] . "</td>";
                       ?>
                            <th>Service Name</th>
                            <?php
                            echo "<td>" . $row["ServiceID"] . "</td>";
                            ?>
                            </tr>
                   
                        <tr>
                            <th>Full Name</th>
                           
                            <?php
                            echo "<td>
                            " . $row["Name"] . "</td>";
                            ?>
                            <th>Mobile Number</th>
                            <?php
                            echo "<td>" . $row["MobileNumber"] . "</td>";
                            ?>
                            </tr>
                          <tr>
                            <th>Email</th>
                            <?php
                            echo "<td>" . $row["Email"] . "</td>";
                            ?>
                            <th>Event Date</th>
                            <?php
                            echo "<td>" . $row["EventDate"] . "</td>";
                            ?>
                            </tr>
                            <tr>
                            <th>Event Starting Time</th>
                            <?php
                            echo "<td>" . $row["EventStartingtime"] . "</td>";
                            ?>
                            <th>Event Ending Time</th>
                            <?php
                            echo "<td>" . $row["EventEndingtime"] . "</td>";
                            ?>
                          </tr>
                            <tr>
        
                            <th>Venue Address</th>
                            <?php
                            echo "<td>" . $row["VenueAddress"] . "</td>";
                            ?>
                            <th>Event Type</th>
                            <?php
                            echo "<td>" . $row["EventType"] . "</td>";
                            ?>
                            </tr>
        
                            <tr>

                            <th>Additional Information</th>
                            <?php
                            echo "<td>" . $row["AdditionalInformation"] . "</td>";
                            ?>
                            <th>Booking Date</th>
                            <?php
                            echo "<td>" . $row["BookingDate"] . "</td>";
                            ?>
                            </tr>
                            
                            <tr>
                            <th>Remark</th>
                            <?php
                            echo "<td>" . $row["Remark"] . "</td>";
                            ?>
                            <th>Status</th>

                           <?php
                            $val=false;
                            $is_paid=false;
                            if( $row["is_paid"]==1)
                            {
                                $is_paid=true;
                            }
                            if( $row["Status"]=="")
                            {
                                echo "<td>" . "Pending". "</td>";
                               
                            }
                            else if( $row["Status"]=="Approved"){
                                    $val=true;
                                    echo "<td>" .  $row["Status"]. "</td>";
                            }
                            else
                            {
                                echo "<td>" .  $row["Status"]. "</td>";
                            }
                            ?>
                        </tr>
                            <tr>                    
                            <th>Total Amount</th>
                            <?php
                            echo "<td><input type='hidden' name='amt' id='amt' value='".$row['Total_amount'] ."'/>" . $row["Total_amount"] . "</td>";
                            ?>
                                <th>Paid</th>
                                <?php
                                if($is_paid){
                                    echo "<td>Payment is Success</td>";
                                }else
                                {
                                    echo "<td>Payment is Pending</td>";
                                }
                            
                            if(!$is_paid)
                            {
                                ?>
                                 <tr>
                            <th>Edit</th>
                          
                            <?php
                            $encryptedID = bin2hex(urlencode(base64_encode($row["ID"])));
                            echo "<td><a href='new_bookings.php?id=". $encryptedID . "' class='btn btn-primary'>Edit</a></td>";
                ?>
                            
                             <th>Delete</th>
                  <?php         
                            echo "<td><a href='myad.php?dl=" . $encryptedID . "' class='btn btn-danger'>Delete</a></td>";
                    ?>   </tr> <tr>
                            <th>payment</th>
                      <?php     
                            if($val)
                            {

                                echo "<td>
                                <input type='hidden' name='razorpay_payment_id' id='razorpay_payment_id'/><input type='button' name='btn' id='btn' class='btn btn-success' value='Pay Now'/></td>";
                            }
                            else{

                                echo "<td></td>";
                            }}
                            ?>
                            </tr>
                            
                            </tr>
                            </thead>
                            
                            </table>
                            </form>
                            <?php
                        }
                        
                    
                    ?>
                    
                  
            </div>
                    
            <?php
        }
        else {
            ?>
            <a href="http://localhost/event_project1/" class="back" style="margin: 0px 0px 0px 800px; width: 80px; z-index: 1;"><img src="img/back.png"></a>
            <div class='img-new'>
            <img  src="img\\back2.jpg" >
            </div>
            <?php
        }

        // Close the database connection
        mysqli_close($conn);
        ?>


</body>
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

</html>
<?php
?>
