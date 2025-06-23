<?php 
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
session_start();
if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}?>
 <?php 
    
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  // $vendors=mysqli_real_escape_string($conn,$_POST['vendors']);
  $cat=mysqli_real_escape_string($conn,$_POST['cat']);
  $items=mysqli_real_escape_string($conn,$_POST['items']);
  $sub_cat=mysqli_real_escape_string($conn,$_POST['sub_cat']);
  $brand=mysqli_real_escape_string($conn,$_POST['brand']);
   $newsql=mysqli_query($conn, "SELECT item_id,item_name FROM tbl_items where id='$items'");
                        $datas=mysqli_fetch_assoc($newsql);
                        $item_code = $datas['item_id'];
                        $item_name = $datas['item_name'];
  $purchase_sql =    mysqli_query($conn, "SELECT SUM(qty_rec) as sum FROM tbl_purchase_detail where product='$item_code'");                    
                        $purchase=mysqli_fetch_assoc($purchase_sql);
                        $total_purchase_quanty = $purchase['sum'];
 $sale_sql =    mysqli_query($conn, "SELECT SUM(qty) as sum FROM tbl_sale_detail where product='$item_code'");                    
                        $sale=mysqli_fetch_assoc($sale_sql);
                        $total_sale_quanty = $sale['sum'];
 // $no_purchase_sql =    mysqli_query($conn, "SELECT SUM(qty_rec) as sum FROM tbl_purchase_detail where product='$item_code'");                    
                        $purchase=mysqli_fetch_assoc($purchase_sql);
                        $purchase_total = $purchase['sum'];
  $brandsql=mysqli_query($conn, "SELECT cat_name FROM tbl_catagory where id='$brand'");
                        $branddate=mysqli_fetch_assoc($brandsql);
                        // $item_code = $datas['item_id'];
                        $brand_name = $branddate['cat_name'];
  $catsql=mysqli_query($conn, "SELECT cat_name FROM tbl_cat where brand_id='$brand'");
                        $catdate=mysqli_fetch_assoc($catsql);
                        // $item_code = $datas['item_id'];
                        $cat_name = $catdate['cat_name'];
$sub_catsql=mysqli_query($conn, "SELECT sub_cat_name FROM tbl_sub_cat where id='$sub_cat'");
                        $sub_catdate=mysqli_fetch_assoc($sub_catsql);
                        // $item_code = $datas['item_id'];
                        $sub_cat_name = $sub_catdate['sub_cat_name'];

                        $stock =  $total_purchase_quanty-$total_sale_quanty;
                        // print_r($item_code);exit();
  // echo $vendors;exit();



   ?>

<html lang="en" >
<link rel="icon" href="favicon.ico" type="image/x-icon"><!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<body >

            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                        // echo $data['c_phone '];exit();
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="logo" style='width: 7%;'>
                                    <img src="<?php echo $image; ?>"  alt="user" class="img-fluid">
                                </div>
                                <div class="info text-right col-md-6" style="margin-top: 1%;" >
                                    <h1><?php echo $c_name;?></h1>
                                    <h3>Purchase Report</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>
                       
                          
               <?php
                            if($vendors=='All'){
                              $vendornamee="All";
                            }else{
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id=$vendors");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $vendornamee = $dataa['username']; }  ?>  

                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <!-- <span > <b>VENDOR  : </b> <?php echo $vendornamee;?> -->
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $f_date.'/'.$t_date;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <!-- <th>#</th>                                       -->
                                                            <th>P_ID</th>                                      
                                                            <th>Item Name</th>                                      
                                                            <th>Brand Name</th>                                      
                                                            <th>Category Name </th>                                      
                                                            <th>Sub Category Name</th>                                      
                                                                          
                                                            <th style="text-align: right;">Sold </th>
                                                            <th style="text-align: right;">Purchased </th>
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th style="text-align: right;">Stock</th>
                                                            <!-- <th class="hidden-sm-down">Unit Cost</th>
                                                            <th>Total</th>
                                                            <th>Date</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  

                                                        <tr>
                           <!--  <td><?php echo $count;?></td> -->
                            <td><?php echo $item_code;?></td>
                            <td><?php echo $item_name;?></td>
                            <td><?php echo $brand_name;?></td>
                            <td><?php echo $cat_name;?></td>
                            <td><?php echo $sub_cat_name;?></td>
                            <td style="text-align: right;"><?php echo $total_sale_quanty;?></td>
                            <td style="text-align: right;"><?php echo $total_purchase_quanty;?></td>
                            <td style="text-align: right;"><?php echo $stock;?></td>
                                                        </tr>
                                                       
                                                     
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <p class="m-b-0"><b>Sub-total:</b> <?php echo $total_amount; ?></p>
                                            <p class="m-b-0">Discout: <?php echo $discount; ?>%</p>
                                                                                   
                                            <h3 class="m-b-0 m-t-10">NET AMT - <?php $net_amount=$total_amount-$discount; echo $net_amount; ?></h3>
                                        </div>                                    
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                            
                                        </div>
                                    </div>                                    
                                </div>  
                        
                            </div>   
                                            
                          
                            <div class="row clearfix ">
                                <div class="col-md-6 ">
                               
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    
</body>
<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
