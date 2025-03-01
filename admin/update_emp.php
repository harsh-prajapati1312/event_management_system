<?php
session_start();

include('includes/dbconnection.php');
function removeImgPath($string)
{
  return str_replace("../", "", $string);
}
if (isset($_REQUEST['submit'])) {
  $eid = $_SESSION['edid'];
  $cname = $_REQUEST['name'];
  $cemail = $_REQUEST['email'];
  $caddress = $_REQUEST['address'];
  $cdept= $_REQUEST['dname'];



  $targetDirectory = "../img/";
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
      $sql = "UPDATE emp SET name = :cname, email = :cemail, address = :caddress, image = :cimagepath ,dept=:dname WHERE eid = :eid";
      $query = $dbh->prepare($sql);
      $query->bindParam(':eid', $eid, PDO::PARAM_STR);
      $query->bindParam('cname', $cname, PDO::PARAM_STR);
      $query->bindParam(':cemail', $cemail, PDO::PARAM_STR);
      $query->bindParam(':caddress', $caddress, PDO::PARAM_STR);
      $query->bindParam(':cimagepath', $targetFile, PDO::PARAM_STR);
      $query->bindParam(':cdept', $cdept, PDO::PARAM_STR);
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
    $eid = $_POST['edit_id'];
    $sql = "SELECT * from  emp where emp.eid=:eid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':eid', $eid, PDO::PARAM_STR);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    $cnt = 1;
    if ($query->rowCount() > 0) {
      foreach ($results as $row) {
        $_SESSION['edid'] = $row->eid;
        $odname = $row->dname;
        ?>
        <div class="form-group">
          <label for="exampleInputName1"> Name</label>
          <input type="text" name="name" class="form-control" id="name" value="<?php echo $row->name; ?>" required>
        </div>
        <div class="form-group">

          <label for="exampleFormControlFile1">Upload File</label>
          <input type="file" value="<?php $tmp = removeImgPath($row->image);
          echo $tmp ?>" class="form-control-file"
            id="exampleFormControlFile1" name="fileToUpload">
        </div>
        <div class="form-group">
          <label for="exampleInputName1"> Email</label>
          <input type="text" name="email" class="form-control" id="email" value="<?php echo $row->email; ?>" required>
        </div>
        <div class="form-group">
          <label for="exampleTextarea1">Address</label>
          <textarea class="form-control" name="address" id="address" rows="4" style="line-height: 30px;"
            required><?php echo $row->address; ?></textarea>
        </div>

        
        <div class="col-md-12">
          <div class="form-group">
            <label class="label" for="subject">Type of dept:</label>
            <select type="text" class="form-control select" name="dname" id="depttype">
              <option value="" ><?php echo $row->dname ?></option>
              <?php
              include('conn.php');
              $conn = connection();
              $dname = "";
              $sql2 = "SELECT * FROM tbldept ";
              // $sql3="select * from "

              $result = $conn->query($sql2);



              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  ?>
                  <option value="<?php echo ($row['dname']); ?>">
                    <?php if ($row['dname'] == $dname) {
                      echo 'selected';
                    } ?>
                    <?php echo $row['dname']; ?>


                  </option>
                <?php }
              } ?>
            </select>
            <!-- <label id="depttypeerr" style="color:red;">*dept type is missing*</label> -->
          </div>
        </div>

        <?php
        $cnt = $cnt + 1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  </form>
</div>