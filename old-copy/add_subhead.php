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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Sub Head</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"><a href="head_list.php">Sub Head List</a></li>
                            <li class="breadcrumb-item active">Add</li>
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
                <div class="col-12">
                    <div class="card">
     
              <?php
            
              if(isset($_GET['edit_id']))
              {
                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_account where id=$edit_id");
                $data=mysqli_fetch_assoc($sql);

                        $aname = $data['aname'];
                        $parent_code = $data['parent_code'];


              }
              ?>
                         <form  action="operations/accounts.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix ">
                                
                                <div class="col-md-6 col-sm-6">
                                    <label>Head Name *</label>
                                    <div class="form-group">
                                       <select class="form-control select_group" name="parent_code" >
                                        <option selected="selected">Choose one</option>
                                        <?php

                                        $sql="SELECT * FROM tbl_head"; 


                                        foreach ($conn->query($sql) as $row){

                                        if($row['acode']==$parent_code){

                                        echo "<option value=$row[acode] selected>$row[aname]</option>"; 

                                        }else{

                                        echo "<option value=$row[acode]>$row[aname]</option>"; 

                                        }

                                        }

                                         echo "</select>";
                                         ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <label>Sub Head Name *</label>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="aname" placeholder="Sub Head Name *" required="" value="<?php echo $aname;?>">
                                        <input type="hidden" class="form-control" name="edit_id" value="<?php echo $edit_id; ?>">
                                    </div>
                                </div>
           
                       
                            </div>
                            <div >
                            <button type="submit" class="btn btn-primary" name="add_subhead">Add</button>
                            <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
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
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
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
 $(".select_group").select2();
</script> 
</body>
</html>
