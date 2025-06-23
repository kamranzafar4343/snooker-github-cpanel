<!doctype html>
<html lang="en">

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Expense List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Expense</li>
                            <li class="breadcrumb-item active">Expense List</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                                                  <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Expense Added Succesfully.
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
              
              if(isset($_GET['update']) && $_GET['update']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Expense Updated Succesfully.
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
  
  <strong>Opps!</strong>Failed to Add Item.
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

              if(isset($_GET['delete']) && $_GET['delete']=='successfull'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great ! </strong>Expense Deleted Successfully.
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
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                                    <thead >
                                      
                                      <?php if($c_write=='1'){?>
                                        <tr>
                                            <th colspan="8" class="text-right"><a href="add_expense.php"><button type="button" class="btn btn-success">Add New</button></a></th>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            
                                            <th>Sr</th>
                                            <th>Expense</th>
                                        
                                         <?php if($c_write=='1'){?>
                                            <th>Action</th>
                                              <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_expense ");
                        $count=0;
                        while($data=mysqli_fetch_assoc($sql))
                        {

                        $id = $data['id'];
                        $expense = $data['expense'];
                        $count++;

                      

                        ?>
                                        <tr>
                                            <td><span><?php echo $count;?></span></td>
                                            <td><span><?php echo $expense;?></span></td>
                                           <?php if($c_write=='1'){?>
                                            <td>
                                                <a href="add_expense.php?edit_id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="operations/delete_expense.php?id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="fa fa-trash-o"></i></button></a>
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
