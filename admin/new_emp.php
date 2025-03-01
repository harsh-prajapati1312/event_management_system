<?php
session_start();

include('includes/dbconnection.php');
if(isset($_POST['submit2'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $add = $_POST['address'];
    $dname = $_POST['dname'];
    // File Upload
    $targetDirectory = "../img/"; // Directory where you want to store uploaded files
    $targetFile = $targetDirectory . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));


    
    // Check if image file is a actual image or fake image
    if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
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
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    // Insert into database
    $sql = "INSERT INTO emp (name, email, address, image,dname) VALUES (:name, :email, :address, :imagepath,:dname)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':name', $name, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':address', $add, PDO::PARAM_STR);
    $query->bindParam(':imagepath', $targetFile, PDO::PARAM_STR); // Assuming you store the file path in the database
    $query->bindParam(':dname', $dname, PDO::PARAM_STR); 
    $query->execute();
    $LastInsertId = $dbh->lastInsertId();
    if ($LastInsertId > 0) {
        echo '<script>alert("Emp has been added.")</script>';
    } else {
        echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}
?>

<div class="card-body">
  <h4 class="card-title">Add employee Form </h4>
  <form class="forms-sample" method="post"  enctype="multipart/form-data">

  
    <div class="form-group">
      <label for="exampleInputName1"> Name </label>
      <input type="text" name="name" class="form-control" id="name" placeholder=" Name" required>
    </div>
    <div class="form-group">
      <label for="exampleInputName1">email</label>
      <input type="text" name="email" class="form-control" id="email" placeholder="email" required>
    </div>
    <div class="form-group">
      <label for="exampleTextarea1">address</label>
      <textarea class="form-control" name="address" id="address" rows="4" required></textarea>
    </div>
    <div class="form-group">
    <label for="exampleFormControlFile1">Upload File</label>
    <input type="file" class="form-control-file" id="exampleFormControlFile1" name="fileToUpload">
  </div>
  
  <div class="col-md-12">
                  <div class="form-group">
                    <label class="label" for="subject">Type of dept:</label>
                    <select type="text" class="form-control select" name="dname" id="depttype">
                      <option value="">Choose dept Type</option>
                      <?php
                      include('conn.php');
                      $sql2 = "SELECT * FROM tbldept ";
                      $conn = connection();
                      $result = $conn->query($sql2);
                      if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                          ?>
                          <option value="<?php echo htmlentities($row['dname']); ?>" <?php if ($row['dname'] == $eventtypes) {
                               echo 'selected';
                             } ?>>
                            <?php echo htmlentities($row['dname']); ?>
                          </option>
                        <?php }
                      } ?>
                    </select>
                    <!-- <label id="depttypeerr" style="color:red;">*dept type is missing*</label> -->
                  </div>
                </div>

    <button type="submit" name="submit2" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>