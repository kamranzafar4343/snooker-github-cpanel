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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Users</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Users</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>     
                    <?php include "includes/graph.php";?>       
                    
                </div>
            </div>

            <div class="row clearfix">
                 <?php
              

              if(isset($_GET['exist']) && $_GET['exist']=='true' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry!</strong> Email already Exists. Please Register with different email.
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
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                            <?php
                            $edit_id=$_GET['edit_id'];
                           
                            $customer_edit = mysqli_query($conn,"SELECT * FROM tbl_vendors where v_id='$edit_id'   ");
                                $row = mysqli_fetch_assoc($customer_edit);   
                               
                                    $email=$row['email'];
                                    $username=$row['username'];
                                 
                                    $mobile_no=$row['mobile_no'];
                                    $user_profile=$row['user_profile'];
                                    $address=$row['address'];




                                    

                            ?>
                       <form class="form-auth-small" action="operations/insert.php" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Name</label>
                                    <input type="text" name='user_name' class="form-control" id="user_name"  placeholder="Name" required="">
                                </div>
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Role</label>
                                    <select name='user_privilege' class="form-control" id="user_privilege" required="">
                                       <option>Operator</option> 
                                       <option>Manager</option> 
                                    </select>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" name='email' class="form-control" id="signin-email"  placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" name='password' class="form-control" id="signin-password"  placeholder="Password" required="">
                                </div>
                             
                                 <div class='text-center' style="padding: 10px;">
                            <button type="submit" id='submit' name="signup" class="btn btn-primary">Submit</button>
                            <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
                     

                            </div>

                              
                                
                            </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
  <script>      


function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
</script> 
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
