<?php
session_start();

include('includes/dbconnection.php');
function removeImgPath($string)
{
  return str_replace("../", "", $string);
}
if (isset($_REQUEST['submit'])) {
  $gid = $_SESSION['edit_id'];




  $targetDirectory = "../img/gallery/";
  $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if ($check !== false) {
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
  if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
  ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFile)) {
      echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";

      // Update database
      $sql = "UPDATE tblgallery SET gimgpath = :imagepath  WHERE gid = :gid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':gid', $gid, PDO::PARAM_STR);
      
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
  <h4 class="card-title">Update Emp Form </h4>
  <form class="forms-sample" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <?php
    $gid = $_POST['edit_id'];
    $sql = "SELECT * from  tblgallery where tblgallery.gid=:gid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':gid', $gid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $row) {
        $_SESSION['edit_id'] = $row->gid;
        ?>
        <div class="form-group">

          <label for="exampleFormControlFile1">Upload File</label>
          <input type="file" value="<?php $tmp = removeImgPath($row->gimgpath);
          echo $tmp ?>" class="form-control-file" id="exampleFormControlFile1" name="fileToUpload">
        </div>



        <?php
        $cnt = $cnt + 1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  </form>
</div>