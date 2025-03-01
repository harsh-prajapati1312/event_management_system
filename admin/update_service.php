<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
function removeImgPath($string) {
  return str_replace("../", "", $string);
}
if(isset($_POST['submit'])) {
  $eid = $_SESSION['edid'];
  $servicename = $_POST['servicename'];
  $servicedes = $_POST['servicedes'];
  $price = $_POST['price'];

  // File Upload

  $targetDirectory = "../img/";
  $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
  } else {
      echo "File is not an image.";
      $uploadOk = 0;
  }

  // Check if file already exists
  if (file_exists($targetFile)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["fileToUpload"]["size"] > 500000) {
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
  }

  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
  }
  
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
      if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
          echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";

          // Update database
          $sql = "UPDATE tblservice SET ServiceName = :servicename, SerDes = :servicedes, ServicePrice = :price, SerImgPath = :imagepath WHERE ID = :eid";
          $query = $dbh->prepare($sql);
          $query->bindParam(':eid', $eid, PDO::PARAM_STR);
          $query->bindParam(':servicename', $servicename, PDO::PARAM_STR);
          $query->bindParam(':servicedes', $servicedes, PDO::PARAM_STR);
          $query->bindParam(':price', $price, PDO::PARAM_STR);
          $query->bindParam(':imagepath', $targetFile, PDO::PARAM_STR);
          if ($query->execute()) {
              echo '<script>alert("Service has been updated.")</script>';
          } else {
              echo '<script>alert("Update failed! Please try again later.")</script>';
          }
      } else {
          echo "Sorry, there was an error uploading your file.";
      }
  }
}
?>
<div class="card-body">
  <h4 class="card-title">Update Service Form </h4>
  <form class="forms-sample" method="post" enctype="multipart/form-data" class="form-horizontal">
    <?php
    $eid=$_POST['edit_id'];
    $sql="SELECT * from  tblservice where tblservice.ID=:eid";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
      foreach($results as $row)
      { 
        $_SESSION['edid']=$row->ID;
        ?>        
       <div class="form-group">
    <label for="exampleInputName1">Service Name</label>
    <input type="text" name="servicename" class="form-control" id="servicename" value="<?php echo $row->ServiceName;?>" required>
</div>
<div class="form-group">
    <label for="exampleFormControlFile1">Upload File</label>
    <input type="file" value="<?php $tmp =removeImgPath($row->SerImgPath); echo $tmp  ?>" class="form-control-file" id="exampleFormControlFile1" name="fileToUpload">
</div>
<div class="form-group">
    <label for="exampleInputName1">Service Price</label>
    <input type="text" name="price" class="form-control" id="price" value="<?php echo $row->ServicePrice;?>" required>
</div>
<div class="form-group">
    <label for="exampleTextarea1">Service Description</label>
    <textarea class="form-control" name="servicedes" id="servicedes" rows="4" style="line-height: 30px;" required><?php echo $row->SerDes;?></textarea>
</div>


        <?php
        $cnt=$cnt+1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  </form>
</div>