<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if(isset($_POST['submit2'])) {
  $servicename = $_POST['servicename'];
  $servicedes = $_POST['servicedes'];
  $price = $_POST['price'];

  $targetDirectory = "../img/";
  $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      // File is an image
      $uploadOk = 1;
  } else {
      echo '<script>alert("File is not an image.");</script>';
      $uploadOk = 0;
  }

  if (file_exists($targetFile)) {
      echo '<script>alert("Sorry, file already exists.");</script>';
      $uploadOk = 0;
  }

  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo '<script>alert("Sorry, your file is too large.");</script>';
      $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");</script>';
      $uploadOk = 0;
  }

  if ($uploadOk == 0) {
      echo '<script>alert("Sorry, your file was not uploaded.");</script>';
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
          // File uploaded successfully
          echo '<script>alert("The file '. htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). ' has been uploaded.");</script>';

          // Insert into database
          $sql = "INSERT INTO tblservice (ServiceName,SerImgPath, SerDes, ServicePrice) VALUES (:servicename,:imagepath ,:servicedes, :price )";
          $query = $dbh->prepare($sql);
          $query->bindParam(':servicename', $servicename, PDO::PARAM_STR);
          $query->bindParam(':imagepath', $targetFile, PDO::PARAM_STR); // Assuming you store the file path in the database
          $query->bindParam(':servicedes', $servicedes, PDO::PARAM_STR);
          $query->bindParam(':price', $price, PDO::PARAM_STR);
          $query->execute();
          $LastInsertId = $dbh->lastInsertId();
          if ($LastInsertId > 0) {
              echo '<script>alert("Service has been added.");</script>';
          } else {
              echo '<script>alert("Something Went Wrong. Please try again.");</script>';
          }
      } else {
          echo '<script>alert("Sorry, there was an error uploading your file.");</script>';
      }
  }
}
?>


<div class="card-body">
  <h4 class="card-title">Add Service Form </h4>
  <form class="forms-sample" method="post" enctype="multipart/form-data">
    <div class="form-group">
      <label for="exampleInputName1">Service Name</label>
      <input type="text" name="servicename" class="form-control" id="servicename" placeholder="Service Name" required>
    </div>
    <div class="form-group">
      <label for="exampleFormControlFile1">Upload File</label>
      <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileToUpload">
    </div>
    <div class="form-group">
      <label for="exampleInputName1">Price</label>
      <input type="text" name="price" class="form-control" id="price" placeholder="Price" required>
    </div>
    <div class="form-group">
      <label for="exampleTextarea1">Service Description</label>
      <textarea class="form-control" name="servicedes" id="servicedes" rows="4" required></textarea>
    </div>
    
    <button type="submit" name="submit2" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>
