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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Company</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Company</li>
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
                $sql=mysqli_query($conn, "SELECT * FROM tbl_catagory where id=$edit_id");
                $data=mysqli_fetch_assoc($sql);
                        $cat_name = $data['cat_name'];
                        $cat_image = $data['cat_image'];
                        $transfer_perc = $data['transfer_perc'];
              }
              ?>
                         <form  action="operations/insert.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="cat_name" id= "cat_name" placeholder="Company Name *" required="" value="<?php echo $cat_name;?>">
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $edit_id; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12" hidden>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="transfer_perc" placeholder="Transfer %" value="<?php echo $transfer_perc; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="cat_image">
                                    </div>
                                </div>
                                <?php if($cat_image !='') {?>
                                <div class="col-md-2 col-sm-12">
                                    <p>Current Image is</p>
                                    <div class="profile-image"> <img src="<?php echo $cat_image; ?>" class="square-circle" alt=""> </div>
                                </div>     
                                <?php }?>
                       
                            </div>
                            <button type="submit" class="btn btn-primary" name="add_catagory">Add</button>
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
$("#cat_name").keypress(function(event) {
    var character = String.fromCharCode(event.keyCode);
    return isValid(character);     
});

function isValid(str) {
    return !/[~`!@#$%\^&*()+=\-\[\]\\';,/{}|\\":<>\?]/g.test(str);
}
</script> 
</body>
</html>
