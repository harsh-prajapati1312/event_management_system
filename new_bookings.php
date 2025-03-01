<?php
session_start();
error_reporting(0);
include_once "conn.php";
include_once "filter.php";
if (!isset($_SESSION['Uname'])) {
  echo "<script>alert('Login Or SignUp is Required For Booking..');</script>";
  header("location:loginn.php");

}

$ofname = $email = $contact = $eventdate = $est = $eetime = $address = $info = $eventtypes = $eventservice = "";
if (isset($_GET['id'])) {
  $encryptedID = $_GET['id'];
  $decryptedID = base64_decode(urldecode(hex2bin($encryptedID)));



  $conn = connection();
  $q = "select * from tblbooking as b where  b.ID='$decryptedID'  ";
  $result = $conn->query($q);
  //echo "<script>alert('" . $decryptedID . "');</script>";
  while ($row = $result->fetch_assoc()) {
    $ofname = sanitizeAndFilterXSS($row['Name']);
    $email = sanitizeAndFilterXSS($row['Email']);
    $contact = sanitizeAndFilterXSS($row['MobileNumber']);
    $eventdate = sanitizeAndFilterXSS($row['EventDate']);
    $eventtypes = sanitizeAndFilterXSS($row['EventType']);
    // $eventservice = $row['ServiceID'];
    $_SESSION['bid'] = sanitizeAndFilterXSS($row['BookingID']);
    $str=sanitizeAndFilterXSS($row['ServiceID']);
    $est = sanitizeAndFilterXSS($row['EventStartingtime']);
    $eetime = sanitizeAndFilterXSS($row['EventEndingtime']);
    $address = sanitizeAndFilterXSS($row['VenueAddress']);
    $info = sanitizeAndFilterXSS($row['AdditionalInformation']);
    $_SESSION['cartArray'] = array();
    $numbers = explode(",", $str);
    foreach ($numbers as $number) {
      // Assuming you want to cast the string to an integer and then do something
      addToCart($number);
  }
  }
}

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ukhy_db');
// Establish database connection.
try {
  $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
  exit("Error: " . $e->getMessage());
}


if (isset($_POST['submit']) || isset($_POST['btnupdate'])) {
  // Assuming you have a PDO connection already established as $dbh

  // Validate and sanitize user inputs
  $bid = isset($_POST['servicetype']) ? sanitizeAndFilterXSS($_POST['servicetype']) : '';
  $name = isset($_POST['name']) ? sanitizeAndFilterXSS($_POST['name']) : '';
  $mobnum = isset($_POST['contact']) ? sanitizeAndFilterXSS($_POST['contact']) : '';
  $email = isset($_POST['email']) ? sanitizeAndFilterXSS($_POST['email']) : '';
  $edate = isset($_POST['eventdate']) ? sanitizeAndFilterXSS($_POST['eventdate']) : '';
  $est = isset($_POST['est']) ? sanitizeAndFilterXSS($_POST['est']) : '';
  $eetime = isset($_POST['eetime']) ? sanitizeAndFilterXSS($_POST['eetime']) : '';
  $vaddress = isset($_POST['address']) ? sanitizeAndFilterXSS($_POST['address']) : '';
  $eventtype = isset($_POST['eventtype']) ? sanitizeAndFilterXSS($_POST['eventtype']) : '';
  $addinfo = isset($_POST['info']) ? sanitizeAndFilterXSS($_POST['info']) : '';

  $bookingid = mt_rand(100000000, 999999999);
  $_SESSION['bid'] = $bookingid;

  try {
    if (isset($_POST['btnupdate'])) {
      $sql = "UPDATE tblbooking SET BookingID = :bookingid, Name = :name, MobileNumber = :mobnum, Email = :email, EventDate = :edate, EventStartingtime = :est, EventEndingtime = :eetime, VenueAddress = :vaddress, EventType = :eventtype, AdditionalInformation = :addinfo WHERE ID = :id";

      $encryptedID = isset($_GET['id']) ? $_GET['id'] : '';
      $decryptedID = base64_decode(urldecode(hex2bin($encryptedID)));
      $query = $dbh->prepare($sql);
      $query->bindParam(':id', $decryptedID, PDO::PARAM_STR);
    } else {
      $sql = "INSERT INTO tblbooking(BookingID,  Name, MobileNumber, Email, EventDate, EventStartingtime, EventEndingtime, VenueAddress, EventType, AdditionalInformation) VALUES(:bookingid,  :name, :mobnum, :email, :edate, :est, :eetime, :vaddress, :eventtype, :addinfo)";
      $query = $dbh->prepare($sql);
    }

    $query->bindParam(':bookingid', $bookingid, PDO::PARAM_STR);

    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':mobnum', $mobnum, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':edate', $edate, PDO::PARAM_STR);
    $query->bindParam(':est', $est, PDO::PARAM_STR);
    $query->bindParam(':eetime', $eetime, PDO::PARAM_STR);
    $query->bindParam(':vaddress', $vaddress, PDO::PARAM_STR);
    $query->bindParam(':eventtype', $eventtype, PDO::PARAM_STR);
    $query->bindParam(':addinfo', $addinfo, PDO::PARAM_STR);

    $query->execute();
    $LastInsertId = $dbh->lastInsertId();

    if ($LastInsertId > 0) {
      if (isset($_POST['btnupdate'])) {
        echo '<script>alert("Booking updated And Request Has Been added.")</script>';
      } else {
        echo "<script>alert('Booking Request Has Been added.')</script>";
      }

      header("Location: new_bookings.php");
      exit();
    } else {
      echo '<script>alert("Record are updated!")</script>';
    }
  } catch (PDOException $e) {
    // Handle database errors here
    echo '<script>alert("Database Error: ' . $e->getMessage() . '")</script>';
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="css\styleofnew_booking.css">

</head>
<script>
  $(document).ready(function () {
    $("#fnameerr").hide();
    $("#emailerr").hide();
    $("#contacterr").hide();
    $("#dateerr").hide();
    $("#timeerr").hide();
    $("#time2err").hide();
    $("#addresserr").hide();
    $("#eventtypeerr").hide();
    $("#infoerr").hide();
    function vaildfname() {
      fnamevar = true;
      var varuname = $("#fname").val();
      if (varuname.length == "") {
        $("#fnameerr").show();
        fnamevar = false;
        return false;

      }
      else if (varuname.length < 10 || varuname.length > 20) {
        $("#fnameerr").show();
        $("#fnameerr").html("*Fullname length must be 10 to 20 *");
        fnamevar = false;
        return false;

      }
      else {
        $("#fnameerr").hide();
        fnamevar = true;
        return true;
      }
    }
    $("#fname").keyup(function () {
      vaildfname();
    });
    function vaildemail() {
      emailerr = true;
      var varemail = $("#email").val();

      var regex = /^([a-zA-Z0-9\d\.]+)\@([a-zA-Z0-9\d\-]+)\.([a-zA-Z]{2,8})$/;
      if (varemail.length == "") {
        $("#emailerr").show();
        emailerr = false;
        return false;
      }
      if (!regex.test(varemail)) {
        $("#emailerr").show();
        $("#emailerr").html("*Enter vaild Email address*");
        emailerr = false;
        return false;
      }
      else {
        $("#emailerr").hide();
        emailerr = true;
        return true;
      }
    }
    $("#email").keyup(function () {
      vaildemail();
    });

    function vaildcontact() {
      contactvar = true;
      var varpass = $("#contact").val();
      if (varpass.length == "") {
        $("#contacterr").show();
        contactvar = false;
        return false;

      }
      else if (varpass.length != 10) {
        $("#contacterr").show();
        $("#contacterr").html("*contact number length must be 10*");
        contactvar = false;
        return false;

      }
      else {
        $("#contacterr").hide();
        contactvar = true;
        return true;
      }
    }
    $("#contact").keyup(function () {
      vaildcontact();
    });
    $("#eventdate").on("input", function () {
      datevar = true;
      var selectedDate = new Date($(this).val());
      var currentDate = new Date();
      if (selectedDate < currentDate) {
        $("#dateerr").text("Please select a future date").show();
        datevar = false;
      } else {
        $("#dateerr").hide();
        datevar = true;
      }
    });
    $("#time, #time2, #address").on("input", function () {
      validateInputs();
    });

    function validateInputs() {
      var time = $("#time").val();
      var time2 = $("#time2").val();
      var address = $("#address").val();
      timeAndaddressvar = true;
      // Reset error messages
      $("#timeerr, #time2err, #addresserr").hide();

      // Validate Event Starting Time
      if (time.trim() === "") {
        $("#timeerr").show();
        timeAndaddressvar = false;
      }

      // Validate Event Finish Time
      if (time2.trim() === "") {
        $("#time2err").show();
        timeAndaddressvar = false;
      }

      // Validate that Event Starting Time is before Event Finish Time
      if (time.trim() !== "" && time2.trim() !== "") {
        var startTime = new Date("2000-01-01 " + time);
        var endTime = new Date("2000-01-01 " + time2);
        if (startTime >= endTime) {
          $("#time2err").text("Finish time must be after start time").show();
          timeAndaddressvar = false;
        }
      }

      // Validate Venue Address
      if (address.trim() === "") {
        $("#addresserr").show();
        timeAndaddressvar = false;
      } else {
        // Validate that address contains only digits and alphabets
        var regex = /^[a-zA-Z0-9\s]+$/;
        if (!regex.test(address)) {
          $("#addresserr").text("Address can only contain digits and alphabets").show();
          timeAndaddressvar = false;
        } else {
          timeAndaddressvar = true;
        }
      }
    }
    $("#eventtype").on("change", function () {
      validateEventType();
    });

    function validateEventType() {
      var eventType = $("#eventtype").val();
      eventtypevar = true;
      // Reset error message
      $("#eventtypeerr").hide();

      // Validate Event Type
      if (eventType.trim() === "") {
        $("#eventtypeerr").show();
        eventtypevar = false;

      }
    }
    $("#info").on("input", function () {
      validateInfo();
    });

    function validateInfo() {
      var info = $("#info").val();
      infovar = true;
      // Reset error message
      $("#infoerr").hide();

      // Validate Info
      if (info.trim() === "") {
        $("#infoerr").show();
        infovar = false;
      } else {
        // Validate that info contains only alphabets and digits
        var regex = /^[a-zA-Z0-9\s]+$/;
        if (!regex.test(info)) {
          $("#infoerr").text("Info can only contain alphabets and digits").show();
          infovar = false;
        }
      }
    }
    $("#btnsubmit").click(function () {
      vaildfname();
      vaildemail();
      vaildcontact();
      validateInputs();
      validateEventType();
      validateInfo();
      if (fnamevar == true && emailerr == true && contactvar == true && timeAndaddressvar == true && eventtypevar == true && infovar == true) {
        return true;
      }
      else {
        return false;
      }
    });

  });
</script>
<?php
if (!isset($_SESSION['cartArray'])) {
  $_SESSION['cartArray'] = array();
}

function addToCart($id)
{
  // Validate if $id is an integer
  if (filter_var($id, FILTER_VALIDATE_INT)) {
    // Check if cartArray exists in session
    if (isset($_SESSION['cartArray'])) {
      // Loop through cartArray to check if the item already exists
      foreach ($_SESSION['cartArray'] as $item) {
        // If the item ID matches, do not add it again and display a message
        if ($item['ID'] == $id) {
          //echo "<script>alert('This item is already in your cart.')</script>";
          return; // Exit the function
        }
      }
    }

    // Connect to your database (replace host, username, password, and dbname with your actual database credentials)
    $conn = new mysqli("localhost", "root", "", "ukhy_db");

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // Prepare a SQL statement to fetch the service details based on ID
    $stmt = $conn->prepare("SELECT ID, ServiceName, ServicePrice FROM tblservice WHERE ID = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check if there is a row returned
    if ($result->num_rows > 0) {
      // Fetch the row
      $row = $result->fetch_assoc();
      // Append the row to the cartArray stored in session
      $_SESSION['cartArray'][] = $row;
      //echo "<script>alert('Service added to cart successfully.')</script>";
    } else {
          echo "<script>alert('Invalid ID.')</script>";
    }

    // Close statement and database connection
    $stmt->close();
    $conn->close();
  } else {
    echo "<script>alert('Invalid ID.')</script>";
  }
}
if (isset($_REQUEST['tblSubmit'])) {
  $total = 0;
  if (isset($_SESSION['cartArray']) && is_array($_SESSION['cartArray'])) {
    // Retrieve cartArray from session
    $cartArray = $_SESSION['cartArray'];

    // Initialize an empty string to store the IDs
    $idsString = "";

    // Get the total count of elements in the cartArray
    $totalElements = count($cartArray);

    // Loop through each element of the array
    foreach ($cartArray as $index => $item) {
      // Get the ID of the current element
      $id = $item['ID'];
      $total += $item['ServicePrice'];
      // Append the ID to the string
      $idsString .= $id;

      // Add a comma if it's not the last element
      if ($index < $totalElements - 1) {
        $idsString .= ",";
      }
    }

    // Assuming $conn is a valid mysqli connection
    $semail = $_SESSION['Uname'];
    $bid = $_SESSION['bid'];
    $conn = connection();

    // Prepare the SQL statement with placeholders
    $stmt = $conn->prepare("UPDATE tblbooking SET ServiceID = ?, Total_amount = ? WHERE Email = ? AND BookingID = ?");

    // Bind parameters to the placeholders (s = string, i = integer)
// Assuming $idsString is a string and $total is a numeric value that can be treated as a string in the query
// Adjust the binding types ('s', 'i', etc.) according to your actual data types
    $stmt->bind_param('ssss', $idsString, $total, $semail, $bid);

    // Execute the prepared statement
    if ($stmt->execute()) {
      // Check for success if needed
      echo "<script>alert('Record updated successfully')</script>";
    } else {
      // Error handling
      echo "<script>alert('Error: " . $stmt->error."')</script>";
    }

    // Close statement
    $stmt->close();

  } else {
    echo "<script>alert('No cart items available.')</script>";
  }
}





if (isset($_GET['cart'])) {
  // Decode the base64 encoded string
  $id = base64_decode(urldecode(hex2bin($_GET['cart'])));

  // Call the addToCart function with the decoded ID
  addToCart($id);
  unset($_GET['cart']);
}
// Function to display cart items in a table
function displayCart()
{
  // Retrieve cartArray from session
  $cartArray = isset($_SESSION['cartArray']) ? $_SESSION['cartArray'] : array();
  if (!empty($_SESSION['cartArray'])) {
    echo '<form method="post"><table class="table table-bordered">';
    echo '<thead class="thead-dark"><tr><th scope="col">Sr. No</th><th scope="col">Service Name</th><th scope="col">Price</th><th scope="col">Action</th></tr></thead>';

    $totalPrice = 0;
    $serial = 1;
    foreach ($cartArray as $index => $item) {
      echo '<tr>';
      echo '<td>' . $serial . '</td>';
      echo '<td>' . $item['ServiceName'] . '</td>';
      echo '<td>' . $item['ServicePrice'] . '</td>';
      echo '<td><form method="post"><input type="hidden" name="removeIndex" value="' . $index . '"><button type="submit" class="btn btn-danger">Remove</button></form></td>'; // Use a form to submit the index to remove
      echo '</tr>';
      $serial++;

      // Accumulate total price
      $totalPrice += $item['ServicePrice'];
    }

    // Display total price row
    echo '<tr><td colspan="2"></td><td>Total Price:</td><td>' . $totalPrice . '</td></tr>';

    // Add buttons for clearing all items and checkout
    echo '<tr><td colspan="4"><form method="post"><button type="submit" name="clearCart" class="btn btn-secondary">Clear All</button> <button type="submit" name="tblSubmit" class="btn btn-success">Submit</button></form></td></tr>';
    echo '</table></form';
  }
}

if (isset($_POST['clearCart'])) {
  // Clear cartArray in session
  $_SESSION['cartArray'] = array();
}
if (isset($_POST['removeIndex'])) {
  $removeIndex = $_POST['removeIndex'];

  // Retrieve cartArray from session
  $cartArray = isset($_SESSION['cartArray']) ? $_SESSION['cartArray'] : array();

  // Remove the item at the specified index
  unset($cartArray[$removeIndex]);

  // Update cartArray in session
  $_SESSION['cartArray'] = array_values($cartArray); // Reset array keys after removal
}
?>

<body>




  <style>
    /* Global Styles */
    .modal-content {
      padding: 0px 80px 0px 70px;
    }

    .form-control {
      width: 500px;
    }

    .select {
      width: 524px;
    }

    .card-root {
      width: 380px;
    }
  </style>

  <body>

    <div id="AddData4" class="modal fade">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">

            <form method="POST" id="contactForm" name="contactForm" class="contactForm">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="label" for="name">Full Name</label>
                    <input type="text" id="fname" class="form-control" value="<?php echo htmlentities($ofname); ?>"
                      name="name" id="name" placeholder="Name">
                    <label id="fnameerr" style="color:red;">*Full Name is missing*</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="label" for="email">Email Address</label>
                    <input type="email" class="form-control" value="<?php echo htmlentities($email); ?>" name="email"
                      id="email" id="email" placeholder="Email">
                    <label id="emailerr" style="color:red;">*email is missing*</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="label" for="name">Contact No</label>
                    <input type="text" class="form-control" value="<?php echo htmlentities($contact); ?>" name="contact"
                      id="contact" placeholder="Contact" id="contact">
                    <label id="contacterr" style="color:red;">*Username is missing*</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="label" for="email">Event Date</label>
                    <input type="date" pattern="\d{4}-\d{2}-\d{2}" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+11 months')); ?>"  class="form-control" value="<?php echo htmlentities($eventdate); ?>"
                      name="eventdate" id="eventdate" id="date" placeholder="">
                    <label id="dateerr" style="color:red;">*date is missing*</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="label" for="name">Event Starting Time</label>
                    <input type="time" class="form-control" id="time" value="<?php echo htmlentities($est); ?>"
                      name="est">
                    <label id="timeerr" style="color:red;">*time is missing*</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="label" for="email">Event Finish Time</label>
                    <input type="time" id="time2" class="form-control" value="<?php echo htmlentities($eetime); ?>"
                      name="eetime">
                    <label id="time2err" style="color:red;">*Time is missing*</label>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="label" for="#">Venue Address</label>
                    <textarea name="address" class="form-control" id="address" cols="30" rows="4"
                      placeholder=""><?php echo htmlentities($address); ?></textarea>
                  </div>
                  <label id="addresserr" style="color:red;">*address is missing*</label>
                </div>
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="label" for="subject">Type of Event:</label>
                    <select type="text" class="form-control select" name="eventtype" id="eventtype">
                      <option value="">Choose Event Type</option>
                      <?php
                      $sql2 = "SELECT * FROM tbleventtype ";
                      $conn = connection();
                      $result = $conn->query($sql2);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          ?>
                          <option value="<?php echo htmlentities($row['EventType']); ?>" <?php if ($row['EventType'] == $eventtypes) {
                               echo 'selected';
                             } ?>>
                            <?php echo htmlentities($row['EventType']); ?>
                          </option>
                        <?php }
                      } ?>
                    </select>
                    <label id="eventtypeerr" style="color:red;">*event type is missing*</label>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="form-group">
                    <label class="label" for="#">Additional Information</label>
                    <textarea name="info" class="form-control" id="info" cols="30" rows="4"
                      placeholder=""><?php echo htmlentities($info); ?></textarea>
                    <label id="infoerr" style="color:red;">*info is missing*</label>
                  </div>
                </div>
                <div class="d-grid gap-2">
                  <div class="form-group">
                    <?php
                    if (isset($_GET['id'])) {
                      ?>
                      <button type="submit" value="Update Details" name="btnupdate" class="btn btn-success">Update
                        Details</button>
                      <?php
                    } else {
                      ?>
                      <button type="submit" value="Book" id="btnsubmit" name="submit"
                        class="btn btn-block btn-info">Book</button>
                      <?php
                    }
                    ?>

                  </div>
                </div>
              </div>
            </form>



          </div>

        </div>

      </div>





    </div>
    </div>
    </div>
    </div>




    </div>


    <div class="cart-new">
      <div class="col-md-12">
        <div class="form-group">
          <label class="label" for="subject">Type of Service:</label>
        </div>
        <!-- <option value="">Choose Service Type</option> -->
        <div class="card-root">
          <div class="card-main slideshow-container">
            <?php
            $sql2 = "SELECT * FROM tblservice ";
            $conn = connection();
            $result = $conn->query($sql2);
            $cont = 0;

            function removeImgPath($string)
            {
              return str_replace("../", "", $string);
            }
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $cont++;
                ?>
                <div class="card ">
                  <img src="<?php echo removeImgPath($row['SerImgPath']); ?>" />
                  <h2>
                    <?php echo $row['ServiceName']; ?>
                  </h2>
                  <p>
                    <?php echo $row['SerDes']; ?>
                  </p>
                  <label>₹
                    <?php echo $row['ServicePrice']; ?>
                  </label>
                  <a href="new_bookings.php?cart=<?php echo bin2hex(urlencode(base64_encode($row['ID']))); ?>"><button
                      type="add" class="button-hover-addcart button"><span>Add Service</span><i
                        class="fa fa-shopping-cart"></i></button>
                  </a>
                </div>




                <!-- </option> -->
              <?php }
            } ?>
            <a class="prev" onclick="plusSlides(-1)">❮</a>
            <a class="next" onclick="plusSlides(1)">❯</a>
          </div>
          <div class="dot-container">

            <?php
            for ($i = 1; $i <= $cont; $i++) {
              ?>
              <span class="dot" onclick="currentSlide(<?php echo $i; ?>)"></span>
              <?php
            }

            ?>
          </div>

          <script>
            var slideIndex = 1;
            showSlides(slideIndex);

            function plusSlides(n) {
              showSlides(slideIndex += n);
            }

            function currentSlide(n) {
              showSlides(slideIndex = n);
            }

            function showSlides(n) {
              var i;
              var slides = document.getElementsByClassName("card");
              var dots = document.getElementsByClassName("dot");
              if (n > slides.length) { slideIndex = 1 }
              if (n < 1) { slideIndex = slides.length }
              for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
              }
              for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
              }
              slides[slideIndex - 1].style.display = "block";
              dots[slideIndex - 1].className += " active";
            }
          </script>

        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <?php

    displayCart(); ?>
    </div>
    </div>
    </div>

  </body>



</html>