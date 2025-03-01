<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
   $event=ucfirst(strtolower($_POST['event']));
   $sql="select * from tbleventtype where EventType like '%$event%'";
   $conn=new mysqli("localhost","root","","ukhy_db");
   $re=$conn->query($sql);
   if($re->num_rows==0)
   {
    $sql="insert into tbleventtype(EventType)values(:event)";
  $query=$dbh->prepare($sql);
   $query->bindParam(':event',$event,PDO::PARAM_STR);
  $query->execute();
  $LastInsertId=$dbh->lastInsertId();
  if ($LastInsertId>0) {
    echo '<script>alert("Event has been added.")</script>';
  }
  else
  {
   echo '<script>alert("Something Went Wrong. Please try again")</script>';
 }

   }else
   {
    echo '<script>alert("Event is already exist")</script>';
   }
  
}
?>
<div class="card-body">
  <h4 class="card-title">Add Event Form </h4>
  <form class="forms-sample" method="post">
    <div class="form-group">
      <label for="exampleInputName1">Event Type</label>
      <input type="text" name="event" class="form-control" id="event" placeholder="Event Type" required>
    </div>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Submit</button>
  </form>
</div>