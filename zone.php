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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Zone</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Zone</li>
                            <li class="breadcrumb-item active">Add Zone</li>
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
                $sql=mysqli_query($conn, "SELECT * FROM tbl_zone where zone_id='$edit_id'");
                $data=mysqli_fetch_assoc($sql);
                        $zone_name = $data['zone_name'];
   
              }
              ?>

                         <form  action="operations/insert.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-md-2 col-sm-12">
                                    
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="zone_name" placeholder="Zone Name *" required="" value="<?php echo $zone_name;?>">
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $edit_id; ?>">
                                    </div>
                                </div>
                            
                                
                       
                            </div>
                         </div>
                          <div class="row clearfix">
                            <div class="col-md-4 col-sm-12">
                                    
                            </div>
                            <div class="col-md-4 col-sm-12">
                               <button type="submit" class="btn btn-primary text-center" name="add_zone">Add</button>
                            <button type="button"  class="btn btn-danger text-center" onclick="GoBackWithRefresh();return false;">Back</button>     
                            </div>
                            
                        </div>
                        <br>
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
