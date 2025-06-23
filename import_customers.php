<!doctype html>
<html lang="en">


<?php

error_reporting(0);
ini_set('max_execution_time', 300);
use Phppot\DataSource;
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";


require_once 'operations/DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
set_time_limit(100000000);
session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}


if (isset($_POST["import"])) {
    
    $fileName = $_FILES["file"]["tmp_name"];
    $amount=0;
    $net_amount=0;
    $seprate_customer_id=6001;
    $code=103;
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $date=date('Y-m-d');
            $parent_id='1';
            $username = "";
            if (isset($column[0])) {
                $username = mysqli_real_escape_string($conn, $column[0]);
            }
            $mobile_no1 = "";
            if (isset($column[1])) {
                $mobile_no1 = '0'.$column[1];

            }
            $customer_type = "";
            if (isset($column[2])) {
                 $customer_type = $column[2];
            }
            $balance = "";
            if (isset($column[3])) {
                $balance = $column[3];
            }
          
            
            $address_1 = "";
            if (isset($column[4])) {
                $address_1 = mysqli_real_escape_string($conn, $column[4]);   
            }
            $address = "";
            if (isset($column[5])) {
                $address = mysqli_real_escape_string($conn, $column[5]);   
            }
            $address_current=$address_1." ".$address;
            $acc_rec='100200';
            
            ++$code;
            
            $seprate_customer_id++;
            
            $customer_id=$acc_rec.$code;
            
            $sql=mysqli_query($conn, "INSERT INTO tbl_customer(customer_id, seprate_customer_id, username, mobile_no1, address_current, customer_type, created_by, parent_id,  created_date) VALUES('$customer_id', '$seprate_customer_id', '$username', '$mobile_no1', '$address_current', '$customer_type', '$parent_id','$parent_id','$date')");

            $sql=mysqli_query($conn, "INSERT INTO tbl_account_lv2( parent_code, sub_child1, acode, aname, opening_bal, created_date,created_by) VALUES('100000000', '100200000', '$customer_id', '$username', '$balance', '$date', '$parent_id')");

           

            if ($sql) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
               
                
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
    
}
?>
<style type="text/css">
    #response {
    padding: 10px;
    margin-bottom: 10px;
    border-radius: 2px;
    display: none;
}

.success {
    background: #c7efd9;
    border: #bbe2cd 1px solid;
}

.error {
    background: #fbcfcf;
    border: #f3c6c7 1px solid;
}

div#response.display-block {
    display: block;
}
</style>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Import Items</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Import </li>
                            <li class="breadcrumb-item active">Import Items</li>
                        </ul>
                    </div>            
                      <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div id="response"
                        class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>">
                        <?php if(!empty($message)) { echo $message; } ?>
                        </div>
        
                         <form class="form-horizontal" action="" method="post" name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                       
                                    </div>  
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="file" name="file" id="file" accept=".csv">
                                    </div>  
                                </div>
                              
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        
                                        <button type="submit" d="submit" name="import" class="btn btn-primary">Import</button>
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

</body>
</html>
