<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";

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

<div id="wrapper">

    <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Vendors</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Vendors</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                            <?php
              
              if(isset($_GET['update']) && $_GET['update']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Vendor Updated Succesfully.
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
              }?>
              <?php
            if(isset($_GET['add_type']))
            {
                $add_from=$_GET['add_type'];
            }
            else
            {
                $add_from=0;
            }
            ?>
                            <?php

                            $edit_id=$_GET['edit_id'];
                           
                            $customer_edit = mysqli_query($conn,"SELECT * FROM tbl_vendors where vendor_id='$edit_id'   ");
                                $row = mysqli_fetch_assoc($customer_edit);   
                               
                                    $email=$row['email'];
                                    $username=$row['username'];
                                 
                                    $mobile_no=$row['mobile_no'];
                                    $user_profile=$row['user_profile'];
                                    $address=$row['address'];
                                    

                            ?>
                                <form action="operations/profile_update.php" method="post"  enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group">                                   
                                        <input type="text" name="username" required=""  class="form-control" placeholder="Username *" value="<?php echo $username; ?>">
                                        <input type="hidden" name="add_from" required=""  class="form-control" placeholder="Client Name *" value="<?php echo $add_from; ?>">
                                    </div>
                                </div>
                              <!--  -->
                                <div class="col-md-4 col-sm-12" hidden>
                                    <div class="form-group">
                                        <input type="text" name="email"  class="form-control" placeholder="Email ID *" value="<?php echo $email; ?>">
                                    </div>
                                </div>    
                        
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="mobile_no" required="" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12"  class="form-control" placeholder="Mobile No" value="<?php echo $mobile_no; ?>">
                                    </div>
                                </div>
                                 

                                                
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                              <div class="input-group">
                                                 <?php
                                              if($edit_id!="") {
                                                if($user_profile=='')
                                                    {
                                                        $user_profile='assets/images/userdefault.jpg';
                                                    }
                                                    else
                                                    {
                                                        $user_profile=$user_profile;
                                                    }
                                                ?>
                                                    <img style="width: 50px;height: 50px;" src="<?php echo $user_profile; ?>">
                                                <?php } ?>
                                                    <input type="file" class="form-control"   name="user_profile" >
                                                </div>
                                    
                                    </div>
                                </div>
                                   
                                <div class="col-md-7 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="address" class="form-control" placeholder="Address" value="<?php echo $address; ?>">
                                         <input type="hidden" name="edit_id" class="form-control"  value="<?php echo $edit_id; ?>">
                                    </div>

                                </div>

                                 
                                 
                                               
                            </div>

                            <button type="submit" name="addvendors" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>

                        </div>
                        </form> 

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

   </script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script>
function goBack() {
  window.history.back();
}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
