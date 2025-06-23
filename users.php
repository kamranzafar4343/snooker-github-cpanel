
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/app-users.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
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
<div id="wrapper">

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Users</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i>  Home</a></li>
                            <li class="breadcrumb-item active">Users</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">

                    <div class="card">
                        <?php
              
              if(isset($_GET['update']) && $_GET['update']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Profile Updated Succesfully.
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

              if(isset($_GET['update']) && $_GET['update']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Update.
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
              

              if(isset($_GET['delete']) && $_GET['delete']=='successful' ){
                  ?>
                              <div class="alert alert-success" id="success-alert">
  
  <strong>Success!</strong> User Deleted Succesfully.
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
              ?>
              <?php
              
              

              if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful' ){
                  ?>
                              <div class="alert alert-danger" id="success-alert">
  
  <strong>Sorry !</strong> User cannot be deleted because it contain data.
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
              ?>
                        <div class="body project_report">
                              <?php if($s_write=='1'){?>
                          <div class=" text-right">
                              <a href="add_users.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Users
                            </button>
                          </a>

                          
                          </div>
                          <?php }?>
                       
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0">
                                    <thead>
                                        <tr>                                        
                                            <th>Name</th>
                                            <th>Profile</th>
                                            <th></th>
                                            <th>Role</th>
                                            <th>Created Date</th>
                                             <?php
                                            if($a_write=='1')
                                            {?>
                                            <th>Action</th>
                                        <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                        $sql=mysqli_query($conn, "SELECT * FROM users ORDER BY COALESCE(user_id, created_by), created_by");                        
                        $count=0;
                     
                                                while($data=mysqli_fetch_assoc($sql))
                                                {
                                                    $user_id = $data['user_id'];
                                                    $username = $data['user_name'];
                                                    $image = $data['user_profile'];
                                                    $user_email = $data['user_email'];
                                                    $user_country = $data['user_country'];
                                                    $user_state = $data['user_state'];
                                                    $user_city = $data['user_city'];
                                                    $user_address = $data['user_address'];
                                                    $user_phone = $data['user_phone'];
                                                    $user_birthday = $data['user_birthday'];
                                                    $user_gender = $data['user_gender'];
                                                    $user_password = $data['user_password'];
                                                    $user_privilege = $data['user_privilege'];
                                                    $created_date = $data['created_date'];
                                                    $newDate = date("d-m-Y", strtotime($created_date));
                                                     $sql1=mysqli_query($conn, "SELECT * FROM tbl_permission   where user_id='$user_id'");
                                                      $datafound=mysqli_num_rows($sql1);
                                                    $count++;
                                                ?>
                                        <tr>
                                            <td>
                                                <?php echo $count;?>
                                            </td>
                                            <td class="width45">
                                                <img src="<?php if($image!=''){ echo $image;}else{?> assets/images/userdefault.jpg<?php }?>" class="rounded-circle width35" alt="">
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?php echo $username;?></h6>
                                                <span><?php echo $user_email;?></span>
                                            </td>
                                            <td><span class="badge badge-danger"><?php echo $user_privilege;?></span></td>

                                            <td><?php echo $newDate;?></td>
                                              <?php
                                            if($a_write=='1')
                                            {
                                            if($user_privilege=='superadmin'){?>
                                             <td>
                                                <a href="profile.php"><button type="button" class="btn btn-sm btn-outline-secondary " title="View">View</button></a>
                                                 
                                            </td>
                                        <?php } else{?>
                                            <td>
                                              <a href="user_profile.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-sm btn-outline-secondary " title="Add">View / Add</button></a>
                                              
                                                 <a href="operations/delete.php?user_id=<?php echo $user_id;?>"><button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="fa fa-trash-o"></i></button></a>
                                            </td>
                                        <?php } }?>
                                            <td>
                                                
                                            </td>
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
<script type="text/javascript">
    $('.add_user').click(function(){
    var id=$(this).data('id');
 
    $('#model1').show();
})
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/app-users.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
