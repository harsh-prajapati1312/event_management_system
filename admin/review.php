<?php
include('includes/checklogin.php');
check_login();
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
                  <h5 class="modal-title" style="float: left;">feedback review</h5>
                </div>

                
              
              <!-- <div id="editData4" class="modal fade">
                <div class="modal-dialog modal-xl">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">View feedback reviews</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body" id="info_update4">-->
                     
                   <!-- </div> 
                   <div class="modal-footer ">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  </div>
                  
                </div>
                
              </div>
              
            </div>
             -->
          <div class="table-responsive p-3">
            <table class="table align-items-center table-flush table-hover" id="dataTableHover">
              <thead>
                <tr>
                 <th class="text-center"></th>
                 <th>fid</th>
                 <th class="d-none d-sm-table-cell">your name</th>
                 <th class="d-none d-sm-table-cell">Email</th>
                 <th class="d-none d-sm-table-cell">subject</th>
                 <th class="d-none d-sm-table-cell">message</th>
                 <!-- <th class=" Text-center" style="width: 15%;">Action</th> -->
               </tr>
             </thead>
           
<tbody>
               <?php
               $sql="SELECT * from tblfeedback ";
               $query = $dbh -> prepare($sql);
               $query->execute();
               $results=$query->fetchAll(PDO::FETCH_OBJ);

               $cnt=1;
               if($query->rowCount() > 0)
               {
                foreach($results as $row)
                  {               ?>
                    <tr>
                      <td class="text-center"><?php echo htmlentities($cnt);?></td>
                      <td class="font-w600"><?php  echo htmlentities($row->fid);?></td>
                      <td class="font-w600"><?php  echo htmlentities($row->name);?></td>
                      <td class="font-w600"><?php  echo htmlentities($row->email);?></td>
                      <td class="font-w600"><?php  echo htmlentities($row->subject);?></td>
                      <td class="font-w600"><?php  echo htmlentities($row->message);?></td>
                      
                      <!-- <td class=" text-center"><a href="#"  class=" edit_data4 rounded btn btn-info" id="<?php echo  ($row->ID); ?>" title="click to edit"><i class="mdi mdi-eye" aria-hidden="true"></i></a>
                        <a href="invoice_generating.php?invid=<?php echo htmlentities ($row->ID);?>" class="btn btn-primary rounded"><i class="mdi mdi-printer" aria-hidden="true"></i></a>
                      </td> -->
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


</body>

</html>