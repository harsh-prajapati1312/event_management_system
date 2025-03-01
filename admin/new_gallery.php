<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');

// Check if the form was submitted
if(isset($_POST['submit2'])) { // Assuming 'submit2' is the name of your submit button

    // File Upload settings
    $targetDirectory = "../img/gallery/"; // Directory to store the uploaded files
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) { // This might not be necessary if you're using 'submit2' to check form submission
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "<script>alert('File is an image - " . $check["mime"] . ".');</script>";
            $uploadOk = 1;
        } else {
            echo "<script>alert('File is not an image.');</script>";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($targetFile)) {
        echo "<script>alert('Sorry, file already exists.');</script>";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) { // 500 KB size limit
        echo "<script>alert('Sorry, your file is too large.');</script>";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.');</script>";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
            echo "<script>alert('The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.');</script>";
            // Insert into database
            $sql = "INSERT INTO tblgallery (gimgpath) VALUES (:imgpath)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':imgpath', $targetFile, PDO::PARAM_STR);
            if($query->execute()) {
                echo '<script>alert("Image has been added.");</script>';
            } else {
                echo '<script>alert("Something Went Wrong. Please try again");</script>';
            }
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }
}


?>
<div class="card-body">
  <h4 class="card-title">Add gallery Form </h4>
  <form class="forms-sample" method="post" enctype="multipart/form-data">
   
    <div class="form-group">
    <label for="exampleFormControlFile1">Upload File</label>
    <input type="file" class="form-control-file"  id="exampleFormControlFile1" name="fileToUpload">
  </div>
   
    <button type="submit" name="submit2" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>