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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create BackUp</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">BackUp</li>
                            <li class="breadcrumb-item active">Create</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
             <?php
              

              if(isset($_GET['reset']) && $_GET['reset']=='done'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great!</strong> Database Reset Succesfully.
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
    <?php }?>
    <?php
        if(isset($_GET['reset']) && $_GET['reset']=='fail'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great!</strong> Database Reset Unsuccesfully.
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
    <?php }?>
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
     
                        <h3 class="card-header bg-secondary text-white">Backup</h3>
                         <form  action="operations/backup.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                
                                <div class="col-md-4 col-sm-12">
                                    
                                </div>
                              
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="create_backup">Create BackUp</button>
                                        <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
                                    </div>
                                </div>
                                

                            
                       
                            </div>
                           
                        </div>
                    </form>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
     
                        <h3 class="card-header bg-secondary text-white">Reset</h3>
                         <form  action="operations/reset.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                
                                <div class="col-md-4 col-sm-12">
                                    
                                </div>
                              
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary" name="reset_database" onclick="return confirm('Are you sure want to reset database..?');">Reset Database</button>
                                        <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
                                    </div>
                                </div>
                                

                            
                       
                            </div>
                           
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
<script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '1');
  }
});
</script>
</body>
</html>
