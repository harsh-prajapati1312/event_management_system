<?php
include_once "conn.php";
$conn=connection();
if (isset($_GET['dl'])) {
    $decryptedID = base64_decode($_GET["dl"]);

    // Your SQL query to delete the item from the database
    $q="update tblbooking set Status='Deleted' where ID='$decryptedID'";
// echo $sql;
    if ($conn->query($q) === TRUE) {
        // Deletion successful
        echo "<script>alert('Booking deleted successfully')</script>";
        header('location: myad.php');
        exit();
    } 
    
} else {
    // If no item_id is provided in the URL parameters
    
    echo "<script>alert('Invalid request. Booking ID is missing.')</script>";
}
?>
