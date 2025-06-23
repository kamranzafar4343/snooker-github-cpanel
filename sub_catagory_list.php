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
<?php
include "includes/loader.php";

?>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Sub Category List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Sub Category</li>
                            <li class="breadcrumb-item active">Sub Category List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                             <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='successfull'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great ! </strong> Sub Catagory Deleted Successfully.
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
              
              if(isset($_GET['insert']) && $_GET['insert']=='successfull' || isset($_GET['update']) && $_GET['update']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Sub Catagory Added Succesfully.
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

              if(isset($_GET['insert']) && $_GET['insert']=='unsuccessfull' || isset($_GET['update']) && $_GET['update']=='unsuccessfull'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Add Sub Catagory.
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
  
  <strong>Opps!</strong>Failed to Delete Sub Catagory, Because Data related to Sub Catagory Exist in Transactions..!
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
              

              if(isset($_GET['delete']) && $_GET['delete']=='successful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Sub Catagory Deleted.
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
                          <div class=" text-right">
                            
                              <a href="add_sub_catagory.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="icon wb-plus" aria-hidden="true"></i> Add Sub Category
                            </button>
                          </a>
                          
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                                    <thead>
                                        
                                        <tr>
                                            
                                            <th>Sr</th>
                                            <th>Brand Name</th>
                                            <th>Category Name</th>
                                            <th>Sub Category Name</th>
                                            <th>Created By</th>
                                            <th>Created Date</th>
                                            
                                        
                                         
                                            <?php if($c_write=='1'){?><th>Action</th><?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_sub_cat ");
                        $count=0;
                        while($data=mysqli_fetch_assoc($sql))
                        {

                        $id = $data['id'];
                        $cat_name = $data['cat_name'];
                        $brand_id = $data['brand_id'];
                        $sub_cat_name = $data['sub_cat_name'];
             
                        $created_by = $data['created_by'];
                        $created_date = $data['created_date'];
                        $newDate = date("d-m-Y", strtotime($created_date));

                        $sqla=mysqli_query($conn, "SELECT * FROM tbl_cat where id=$cat_name");
                        $dataa=mysqli_fetch_assoc($sqla);

                        $cat_name=$dataa['cat_name'];

                        $sqla=mysqli_query($conn, "SELECT * FROM tbl_catagory where id=$brand_id");
                        $dataa=mysqli_fetch_assoc($sqla);

                        $brand_name=$dataa['cat_name'];
                        
                        $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                        $count++;

                        ?>
                                        <tr>
                                            <td><span><?php echo $count;?></span></td>
                                            <td><?php echo $brand_name; ?></td>
                                            <td class=""><?php echo $cat_name;?></td>
                                            <td class=""><?php echo $sub_cat_name;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                          <?php if($c_write=='1'){?>
                                            <td>
                                                <a href="add_sub_catagory.php?edit_id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="fa fa-edit"></i></button></a>
                                                <a href="operations/delete_sub_cat.php?id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="fa fa-trash-o"></i></button></a>
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
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
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
