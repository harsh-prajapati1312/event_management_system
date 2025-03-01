<!DOCTYPE html>
<html lang="en">
<?php
 include_once 'conn.php';

 function sanitizeAndFilterXSS($data) {
    // Remove potential script tags
    $data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', '', $data);
    
    // Remove potential on* attributes
    $data = preg_replace('/\bon\w+\s*=\s*".*?"/i', '', $data);
    
    // Remove potential JavaScript events
    $data = preg_replace('/\b(?:on(?:click|dblclick|mousedown|mouseup|mouseover|mousemove|mouseout|keypress|keydown|keyup|focus|blur|change|select|submit|reset))\s*=\s*".*?"/i', '', $data);
    
    // Remove potential HTML attributes like "javascript:"
    $data = preg_replace('/\b(?:javascript|vbscript)\b\s*:/i', '', $data);
    
    // Remove any HTML tags except for the allowed tags
    $allowedTags = '<b><strong><i><em><ul><ol><li><a>';
    $data = strip_tags($data, $allowedTags);

    // Convert special characters to HTML entities
    $data = htmlspecialchars($data, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    return $data;
}

if (isset($_GET['eid'])) 
{
    include_once 'conn.php';

    $conn = connection();
    $eid = sanitizeAndFilterXSS($_GET['eid']);
    $sql = "delete from event_type where eid = '$eid'";
    $stat = $conn->query($sql);
    // echo "<script>alert('$stat'</script>";
    if ($stat == 1) {
        echo "<script>alert('Record are Deleted')</script>";
    } else {
        echo "<scriptalert('>Unexcepted Error')</script>";
    }


}
if(isset($_REQUEST["no"]))
{
    $eid=sanitizeAndFilterXSS($_REQUEST["eid"]);
    $conn=connection();
		$sql="update booking set aprove='Aprove' where booking_id=$booking_id";
		$conn->query($sql);
		$conn->close();
        echo "<script>alert('Product are Accepted!')</script>";
}
elseif(isset($_REQUEST["eid"]))
{
    $noo=sanitizeAndFilterXSS($_REQUEST["eid"]);
    $conn=connection();
		$sql="update booking set aprove='Rejected' where booking_id=$booking_id";
		$conn->query($sql);
		$conn->close();
        echo "<script>alert('Product are Rejected!')</script>";
}

 ?>
 
    
    

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>KLX</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <style>
        .row {
            display: none;
        }

        .img {
            margin: 20px 20px 20px 20px;
            border-radius: 10px;
            width: 200PX;
            height: 250px;
            object-fit: ;
        }
    </style>
</head>

<body id="page-top">


   
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="admin.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">KLX </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard   -->
            <li class="nav-item ">
                <a class="nav-link" href="admin.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item active">
                <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                    aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Components</span>
                </a>
                <div id="collapseTwo" class="collapse show" aria-labelledby="headingTwo"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Custom Components:</h6>

                        <a class="collapse-item" href="category.php">Category</a>
                        <a class="collapse-item" href="aprovement.php">Aprove AD</a>
                        <a class="collapse-item" href="delete-AD.php">Delete AD</a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            

            
           

           
          
            

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                       

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Admin</span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800">Verification Request</h1>
                    <div class="container">

                    </div>
                    <?php

                    ?>
                    <?php
                    include_once 'crud_c.php';
                    $conn = connection();
                    $sql = "select * from product_data where is_aprove=''";

                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        ?>
                        <table class="table table-hover ">
                            <tr class="thead-dark">
                                <th>no</th>
                                <!-- <th>is_aprove</th> -->
                                <th>username</th>
                                <th>img_path</th>
                                <th>title</th>
                                <th>category</th>
                                <th>Accept</th>
                                <th>Reject</th>
                            </tr>

                            <?php
                            while ($row = $result->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['item_no']; ?>
                                    </td>
                                    <!-- <td>
                                        <?php //echo $row['is_aprove']; ?>
                                    </td> -->
                                    <td>
                                        <?php echo $row['username']; ?>
                                    </td>
                                    <?php $imgpath = $row["img_path"] ?>
                                    <td><img class='img' src='<?php echo $imgpath ?>'></td>
                                    <td>
                                        <?php echo $row['title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['category']; ?>
                                    </td>
                                    <td> <a href="aprovement.php?no=<?php echo $row['item_no'];?>" class="btn btn-primary">Accept</a></td>
                                    <td> <a href="aprovement.php?no1=<?php echo $row['item_no'];?>" class="btn btn-danger">Reject</a></td>

                                </tr>
                                <?php
                            }
                            echo "</table>";
                    } else {
                        echo "<center><h4>No records found.</h4></center>";
                    }
                    ?>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>