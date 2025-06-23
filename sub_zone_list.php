<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:02 GMT -->
<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";

session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>
<body class="theme-orange">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>

<!-- Overlay For Sidebars -->

   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Brand List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Brand</li>
                            <li class="breadcrumb-item active">Brand List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                             <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='done'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great ! </strong>Sub Zone Deleted Successfully.
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              } ?>
                                    <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successful' || isset($_GET['update']) && $_GET['update']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Sub Zone Added Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }

              if(isset($_GET['insert']) && $_GET['insert']=='unsuccessful' || isset($_GET['update']) && $_GET['update']=='unsuccessful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Add Sub  Zone.
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }
             ?>
             <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong> Failed to Delete Sub Zone, Because Data related to Sub Zon Exist in Customers..!
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }
             ?>
                        <div class="body">
                            <?php if($c_write=='1'){?>
                              <div class="text-right">
                              <a href="subzone.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                 <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Sub Zone
                            </button>
                          </a>
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                                    <thead>
                                      
                                        <tr>
                                            
                                            <th>Sr</th>
                                       
                                            <th>Zone Name</th>
                                            <th>Sub Zone Name</th>
                                            <th>Created Date</th>
                                         
                                            <?php if($c_write=='1'){?><th>Action</th><?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_zone where parent_zone_id!=0 ");
                        $count=0;
                        while($data=mysqli_fetch_assoc($sql))
                        {

                        $id = $data['zone_id'];
                        $sub_zone_name = $data['zone_name'];
                        
                        $parent_zone_id = $data['parent_zone_id'];
                        $created_date = $data['created_date'];
                        $newDate = date("d-m-Y", strtotime($created_date));
                        $count++;
                         $sql1=mysqli_query($conn, "SELECT * FROM tbl_zone where zone_id='$parent_zone_id'");
                         $data=mysqli_fetch_assoc($sql1);
                         $zone_name = $data['zone_name'];

                        ?>
                                        <tr>
                                            <td><span><?php echo $count;?></span></td>
                                          
                                            
                                            <td><span><?php echo $zone_name;?></span></td>
                                            <td><span><?php echo $sub_zone_name;?></span></td>
                                            <td><span><?php echo $newDate;?></span></td>
                                          <?php if($c_write=='1'){?>
                                            <td>
                                                <a href="subzone.php?edit_id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="operations/delete.php?sub_zone_id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="fa fa-trash-o"></i></button></a>
                                            </td>
                                            <?php }?>
                                        </tr>
<?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
