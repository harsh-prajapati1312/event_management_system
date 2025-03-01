<?php
include('includes/checklogin.php');
include('includes/dbconnection.php');
check_login();
// Code for deleting product from cart
if(isset($_GET['delid']))
{
  $cid=intval($_GET['delid']);
 
  
  $sql="delete from emp where eid=:eid";
  $query=$dbh->prepare($sql);
  $query->bindParam(':eid',$cid,PDO::PARAM_STR);
  $query->execute();
  echo "<script>alert('Data deleted');</script>"; 
  echo "<script>window.location.href = 'manage_emp.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<?php @include("includes/head.php");?>
<body>

  <div class="container-scroller">
    
    <?php @include("includes/header.php");?>
    
    <div class="container-fluid page-body-wrapper">
      
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="modal-header">
                  <h5 class="modal-title" style="float: left;">employee register</h5>    
                  <div class="card-tools" style="float: right;">
                    <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#addsector" ><i class="fas fa-plus" ></i> Add employee
                    </button>
                  </div>    
                </div>
                
                <div class="modal fade" id="addsector">
                  <div class="modal-dialog modal-md ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Register employee</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        
                        <?php include("new_emp.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                    </div>
                    
                  </div>
                  
                </div>
                
                
                <div id="editData" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <!-- <h5 class="modal-title">Edit Emp</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button> -->
                      </div>
                      <!-- <div class="modal-body" id="info_update">
                       <?php //@include("update_emp.php");?>
                     </div> -->
                     <div class="modal-footer ">
                      
                    </div>


                    
                  </div>
                  
                </div>
                
              </div>
              
              <div class="card-body table-responsive p-3">
                <table class="table align-items-center table-flush table-hover" id="dataTableHover">
                  <thead>
                    <tr>
                     <th>No </th>
                      <th> name</th>
                      <th class="">email</th>
                      <th class="">address</th>
                      <th class="">Uplaod File</th>
                      <th class="">dept name</th>
                      <!-- <th class="text-center">Creation Date</th> -->
                      <th class="text-center" style="width: 15%;">Action</th>
                    </tr>
                  </thead>
                 
<tbody>
                    <?php
                    $sql="SELECT * from emp";
                    $query = $dbh -> prepare($sql);
                    $query->execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $cnt=1;
                    if($query->rowCount() > 0)
                    {
                      foreach($results as $row)
                      {    
                        ?>
                        <tr>
                          <td class="text-center"><?php echo htmlentities($cnt);?></td>
                          <td><?php  echo htmlentities($row->name);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->email);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->address);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->image);?></td>
                          <td class="text-center"><?php  echo htmlentities($row->dname);?></td>
                          <!-- <td class="text-center">
                            <span class=""><?php  echo htmlentities(date("d-m-Y", strtotime($row->CreationDate)));?></span>
                          </td> -->
                          <td class="text-center">
                            <!-- <a href="#"  class="btn btn-purple rounded edit_data" id="<?php //echo  ($row->eid); ?>" title="click for edit"><i class="mdi mdi-pencil-box-outline" aria-hidden="true"></i></a>
                             -->
                            <a href="manage_emp.php?delid=<?php echo ($row->eid);?>" onclick="return confirm('Do you really want to Delete ?');" class="btn btn-danger rounded"><i class="mdi mdi-delete" aria-hidden="true"></i></a>
                          </td>

                        </tr>
                        <?php 
                        $cnt=$cnt+1;
                      }
                    } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      
      <?php @include("includes/footer.php");?>
      
    </div>
    
  </div>
  
</div>

<?php @include("includes/foot.php");?>


<script type="text/javascript">
  $(document).ready(function(){
    $(document).on('click','.edit_data',function(){
      var edit_id=$(this).attr('id');
      $.ajax({
        url:"update_emp.php",
        type:"post",
        data:{edit_id:edit_id},
        success:function(data){
          $("#info_update").html(data);
          $("#editData").modal('show');
        }
      });
    });
  });
</script>

</body>
</html>
