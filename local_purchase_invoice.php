<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";



session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}



?>
<?php
              
              if(isset($_GET['purchase_id']))
              {

                $purchase_id=mysqli_real_escape_string($conn, $_GET['purchase_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_single_purchase where purchase_id=$purchase_id");

                $data=mysqli_fetch_assoc($sql);
                        $id = $data['purchase_id'];
                      
                        $vendor_id = $data['vendor_id'];
                      
                        $net_amount = $data['net_amount'];
                        $gross_amount = $data['gross_amount'];
                        $discount = $data['discount'];
                        $created_date = $data['created_date'];
                        $amount_recieved = $data['amount_payed'];
                        $created_by = $data['created_by'];

                        $query1 = mysqli_query($conn,"SELECT * FROM tbl_vendors where vendor_id=$vendor_id"); 
                       
                                   
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername=$cdata['username'];
                                   $customer_address=$cdata['address'];
                                   $customer_phone=$cdata['email'];
                        $query = mysqli_query($conn,"SELECT user_name,created_by FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                  
                                   $created_by=$zdata['created_by'];

                        $query2 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query2) ;
                                   $branch_name=$zdata['user_name'];
                        
              }
              ?>
<html lang="en" >

<link rel="icon" href="favicon.ico" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<!-- <body onload="window.print();"> -->
 <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                 
                        ?>
            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                            <div class="invoice-top clearfix">
                                <div class="logo">
                                    <img src="<?php echo $image;?>" alt="user" class="img-fluid">
                                </div>
                                <div class="info">
                                    <h6><?php echo $c_name;?></h6>
                                    <p><?php echo $c_address;?></p>
                                </div>
                                <div class="title">
                                    <h4>Invoice #<?php echo $id;?></h4>
                                    <p>Created Date : <?php echo $created_date;?></p>
                                    <p>Created By : <?php echo $user_name;?></p>
                                    <p>Branch : <?php echo $branch_name;?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="invoice-mid clearfix">      
                             
                                <div class="info">
                                 
                                    <b>Name :</b> <?php echo $customername;?><br>
                                    <b>Address :</b> <?php echo $customer_address;?> <br />
                                    <b>Phone :</b> <?php echo $customer_phone;?>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-warning">
                                                <tr>
                                                    <th>Product</th>
                                                    <th>Model</th>
                                                    <th>Item Serial</th>
                                                    <th>Item Barcode</th>
                                                     <th>Brand Name</th>
                                                    <th>Qty</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                              <?php
              
            
                $lsql=mysqli_query($conn, "SELECT * FROM tbl_single_purchase_detail where purchase_id=$purchase_id");

                while ($data=mysqli_fetch_assoc($lsql)) {
                        $product = $data['product'];
                        $qty = $data['qty'];
                        $rate = $data['rate'];
                        $amount = $data['amount'];
                        $item_serial = $data['item_serial'];
                        $barcode = $data['barcode'];

                        $asql=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                                
                                $data=mysqli_fetch_assoc($asql);
                                $productname = $data['item_name'];
                                $item_model = $data['item_model'];
                                $brand_id = $data['brand_id'];
                                
                                 $asql=mysqli_query($conn, "SELECT * FROM tbl_catagory where id=$brand_id");
                                
                                $data=mysqli_fetch_assoc($asql);
                                $cat_name = $data['cat_name'];

                        
              
              ?> 
                                                <tr>
                                                   
                              <td><?php echo $productname;?></td>
                              <td><?php echo $item_model;?></td>
                               <td><?php echo $item_serial;?></td>
                              <td><?php echo $barcode;?></td>
                             <td><?php echo $cat_name;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $amount;?></td>
                        </tr>
                                               
                                            <?php }?>
                                              
                                               <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                </tr>

                                                <tr style="margin-top: 2px;">
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td class="table-info"><strong>Gross Amount</strong></td>
                                                    <td class="table-info"><strong><?php echo $gross_amount;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td class="table-danger"><strong>Discount</strong></td>
                                                    <td class="table-danger"><strong><?php echo $discount;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td class="table-success"><strong>Net Amount</strong></td>
                                                    <td class="table-success"><strong><?php echo $net_amount;?></strong></td>
                                                </tr>
                                                 <?php if($amount_recieved){?>
                                                <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td class="table-warning"><strong>Amount Payed</strong></td>
                                                    <td class="table-warning"><strong><?php echo $amount_recieved;?></strong></td>
                                                </tr>
                                                  <?php }?>
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>
            
                            </div>                            
                            <hr>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Purchased Items Conditions.</p>
                                </div>
                                
                            </div>
                            <div class="row clearfix nodisplay">
                                <div class="col-md-12 text-center">
                                    <!-- <a href="purchase_list.php"><button type="button"  class="btn btn-danger">Back</button></a> -->
                                    <button class="btn btn-info" id="printPageButton" onClick="window.print();">Print</button>
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
