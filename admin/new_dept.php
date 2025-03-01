<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit2']))
{
  $dname=$_POST['dname'];
 
  $sql="insert into tbldept(dName)values(:dname)";
  $query=$dbh->prepare($sql);
  $query->bindParam(':dname',$dname,PDO::PARAM_STR);
  
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("deptartment has been added.")</script>';
  }
  else
  {
   echo '<script>alert("Something Went Wrong. Please try again")</script>';
 }
}


?>
<div class="card-body">
  <h4 class="card-title">Add Dept Form </h4>
  <form class="forms-sample" method="post">
    <div class="form-group">
      <label for="exampleInputName1"> Name</label>
      <input type="text" name="dname" class="form-control" id="name" placeholder="dept Name" required>
    </div>
   
    <button type="submit" name="submit2" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>