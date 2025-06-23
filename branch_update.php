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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Brand</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Brand</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                   <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
     
              <?php
            
              if(isset($_GET['edit_id']))
              {
                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM users where user_id=$edit_id");
                $data=mysqli_fetch_assoc($sql);
                        $name = $data['user_name'];
                        $user_email = $data['user_email'];
                        $user_address = $data['user_address'];
                        $contact_no = $data['contact_no'];
                        $user_phone = $data['user_phone'];
                        $branch_id = $data['branch_id'];

              }
              ?>
                         <form  action="operations/update_branch.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" placeholder="Branch Name *" required="" value="<?php echo $name;?>">
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $edit_id; ?>">
                                        <input type="hidden" class="form-control" name="branch_id" value="<?php echo $branch_id; ?>">
                                    </div>
                                </div>

                                 <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="email" class="form-control" name="user_email" placeholder="Email *" required="" value="<?php echo $user_email;?>">
                                       
                                    </div>
                                </div>
                                 <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user_address" placeholder="Address *" required="" value="<?php echo $user_address;?>">
                                  
                                    </div>
                                </div>
                                 <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="contact_no" placeholder="Contact No *"  value="<?php echo $contact_no;?>">
                                        
                                    </div>
                                </div>
                                 <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="user_phone" placeholder="User Phone *" value="<?php echo $user_phone;?>">
                                        
                                    </div>
                                </div>
                            
                                
                               
                       
                            </div>
                            <button type="submit" class="btn btn-primary" name="update_branch">Update</button>
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
</html>
