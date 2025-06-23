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
    if ($_FILES["file"]["size"] > 0) {
        
        $file = fopen($fileName, "r");
        
        while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
            $created_date=date('Y-m-d');
            $created_by='1';
            $item_id = "";
            if (isset($column[0])) {
                $item_id = mysqli_real_escape_string($conn, $column[0]);
            }
            $barcode = "";
            if (isset($column[1])) {
                $barcode = $column[1];

            }
            $brand_name = "";
            if (isset($column[3])) {
                $brand_name = mysqli_real_escape_string($conn, $column[3]);

                $sql2=mysqli_query($conn,"SELECT id from tbl_catagory where cat_name LIKE '$brand_name'");

                if(mysqli_num_rows($sql2)>0)
                {
                   
                    $value2 = mysqli_fetch_assoc($sql2);
                    $brand_id=$value2['id'];
                }
                else
                {

                    $sql=mysqli_query($conn,"INSERT INTO tbl_catagory (cat_name, created_date, created_by) VALUES ('$brand_name', '$created_date', '$created_by')");
                    $brand_id=mysqli_insert_id($conn);
                   
                }
                
            }
            $item_name = "";
            if (isset($column[2])) {
                $item_name = mysqli_real_escape_string($conn, $column[2]);
                $item_name_add=explode(" ",$item_name);
                $cat_name=$item_name_add[0];
                array_shift($item_name_add);
                $item_name1=implode(" ",$item_name_add);


                $sql3=mysqli_query($conn,"SELECT id from tbl_cat where catagory_name LIKE '$cat_name'");

                if(mysqli_num_rows($sql3)>0)
                {
                    $value3 = mysqli_fetch_assoc($sql3);
                    $category_id=$value3['id'];
                }
                else
                {
                    
                    $sql=mysqli_query($conn,"INSERT INTO tbl_cat (catagory_name, brand_id, created_date, created_by) VALUES ('$cat_name', '$brand_id', '$created_date', '$created_by')");
                    $category_id=mysqli_insert_id($conn);
                }
            }
          
            
            $qty = "";
            if (isset($column[4])) {
                $qty = mysqli_real_escape_string($conn, $column[4]);
                
            }
            $purchase = "";
            if (isset($column[5])) {
                $purchase = mysqli_real_escape_string($conn, $column[5]);
                
            }
            $retail = "";
            if (isset($column[6])) {
                $retail = mysqli_real_escape_string($conn, $column[6]);
                
            }
            $amount=abs($rate*$qty);
            $net_amount+=$amount;
            $pur_item_id_start='1000';
            $purchase_id_start='1';
            $sql=mysqli_query($conn, "SELECT pur_item_id, purchase_id FROM tbl_purchase_detail  ORDER BY pur_item_id DESC");
            $data = mysqli_fetch_assoc($sql);
            $pur_item_id=$data['pur_item_id']; 
            $purchase_id=$data['purchase_id'];           
            if($pur_item_id>0)
            {
                ++$pur_item_id;  
            }
            else
            {
                
                $pur_item_id=$pur_item_id_start;
            }
            if($purchase_id>0)
            {
                ++$purchase_id;  
            }
            else
            {
                
                $purchase_id=$purchase_id_start;
            }
            

            $brand_id=$brand_id;
            $category=$category_id;

            
            $sqlInsert = "INSERT into tbl_items (item_id, item_name, barcode, brand_id, category, purchase, retail, created_date, created_by)
                   values (?,?,?,?,?,?,?,?,?)";
            $paramType = "sssiissss";
            $paramArray = array(
                $item_id,
                $item_name1,
                $barcode,
                $brand_id,
                $category,
                $purchase,
                $retail,
                $created_date,
                $created_by
            );
            $insertId = $db->insert($sqlInsert, $paramType, $paramArray);
            $sql=mysqli_query($conn, "INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, rate, sale_rate, amount, created_date, created_by, parent_id, iemi) VALUES ('1', '$invoice_no','$item_id', '', '1001','$barcode', '$qty', '$qty', '$rate', '$sale_rate', '$amount', '$created_date', '1','1', '0')");

            $sql=mysqli_query($conn, "SELECT user_id FROM users where user_privilege='branch'  ORDER BY user_id DESC");
            while($data = mysqli_fetch_assoc($sql))
            {
            $banch_id=$data['user_id'];
            $sql4=mysqli_query($conn,"INSERT INTO tbl_item_price (user_id, item_id, cash_price, installment_price, created_date) VALUES ('$banch_id', '$item_id', '$rate', '$rate', '$created_date')");
            }


            if (! empty($insertId)) {
                $type = "success";
                $message = "CSV Data Imported into the Database";
               
                
            } else {
                $type = "error";
                $message = "Problem in Importing CSV Data";
            }
        }
    }
    $invoice_no='Opening#1';
             date_default_timezone_set("Asia/Karachi");
                $created_date=date("Y-m-d h:i:s");
    $narration="Opening Stock added from import, Transaction Date was ".$created_date."";
                $v_type='SP';
                $invoice_no='Opening#1';
                $stock_acode='100300100';
                $sql=mysqli_query($conn, "INSERT INTO tbl_purchase(location, iemi, vendor_id, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount,bill_status,payment_status,  created_by, parent_id) VALUES ('1', '0', '$stock_acode', '$invoice_no', '$created_date', '', '$net_amount', '$net_amount', '0','Completed','Completed', '1', '1')");

                $sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by,parent_id) VALUES ('$stock_acode', '$invoice_no', '$narration', '',  '$v_type', 'Completed', '$created_date', '1','1')");
                $tran_id = mysqli_insert_id($conn); 
                $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode','$net_amount', '0.00','$bill_status', '$narration', '$created_date', '$userid','$parent_id')";
                    mysqli_query($conn, $sql);

                $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode', '0.00', '$net_amount', '$bill_status', '$narration', '$created_date', '$userid','$parent_id')";
                    mysqli_query($conn, $sql);
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
