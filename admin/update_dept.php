<?php
session_start();

include('includes/dbconnection.php');

if(isset($_REQUEST['submit'])) 
{
    $did = $_SESSION['edid'];
    $dname = $_REQUEST['dname'];
    

  

  
          // Update database
          $sql = "UPDATE tbldept SET dname = :dname  WHERE did = :did";
          $query = $dbh->prepare($sql);
          $query->bindParam(':did', $did, PDO::PARAM_STR);
          $query->bindParam('dname', $dname, PDO::PARAM_STR);
          
          if ($query->execute())
           {
              echo '<script>alert("dept has been updated.")</script>';
          } else 
          {
              echo '<script>alert("Update failed! Please try again later.")</script>';
          }

      } 
     
    

?>
<div class="card-body">
  <h4 class="card-title">Update Emp Form </h4>
  <form class="forms-sample" method="POST" enctype="multipart/form-data" class="form-horizontal">
    <?php
    $did=$_POST['edit_id'];
    $sql="SELECT * from  tbldept where tbldept.did=:did";
    $query = $dbh -> prepare($sql);
    $query-> bindParam(':did', $did, PDO::PARAM_STR);
    $query->execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    $cnt=1;
    if($query->rowCount() > 0)
    {
      foreach($results as $row)
      { 
        $_SESSION['edid']=$row->did;
        ?>        
       <div class="form-group">
    <label for="exampleInputName1"> Name</label>
    <input type="text" name="dname" class="form-control" id="dname" value="<?php echo $row->dname;?>" required>
</div>



        <?php
        $cnt=$cnt+1;
      }
    } ?>
    <button type="submit" name="submit" class="btn btn-primary btn-fw mr-2">Update</button>
    <button type="button" class="btn btn-success" data-dismiss="modal">Cancel</button>
  </form>
</div>