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
              
              if(isset($_GET['sale_id']))
              {

                $sale_id=mysqli_real_escape_string($conn, $_GET['sale_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_sale where sale_id=$sale_id");

                $data=mysqli_fetch_assoc($sql);
                        $id = $data['sale_id'];
                        $sale_type = $data['sale_type'];
                        $customer_name = $data['customer_name'];
                        $customer_address = $data['customer_address'];
                        $customer_phone = $data['customer_phone'];
                        $net_amount = $data['net_amount'];
                        $gross_amount = $data['gross_amount'];
                        $discount = $data['discount'];
                        $created_date = $data['created_date'];
                        
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

<body onload="window.print();">

            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                            <div class="invoice-top clearfix">
                                <div class="logo">
                                    <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-blak.svg" alt="user" class="img-fluid">
                                </div>
                                <div class="info">
                                    <h6>Alkareem.</h6>
                                    <p>Cantt.<br>Peshawar , Pakistan</p>
                                </div>
                                <div class="title">
                                    <h4>Invoice #<?php echo $id;?></h4>
                                    <p><?php echo $created_date;?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="invoice-mid clearfix">      
                             
                                <div class="info">
                                 
                                    <b>SALE TYPE : </b> <?php echo $sale_type;?><br>
                                    <b>Name :</b> <?php echo $customer_name;?><br>
                                    <b>Address :</b> <?php echo $customer_address;?> <br />
                                    <b>Phone :</b> <?php echo $customer_phone;?>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-success">
                                                <tr>
                                                    <th>Product name</th>
                                                    <th>Qty</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                      <?php
              
            
                $lsql=mysqli_query($conn, "SELECT * FROM tbl_sale_detail where sale_id=$sale_id");

                while ($data=mysqli_fetch_assoc($lsql)) {
                        $product = $data['product'];
                        $qty = $data['qty'];
                        $rate = $data['rate'];
                        $amount = $data['amount'];

                        
              
              ?> 
                                                <tr>
                                                   
                            <td><?php 
                                $asql=mysqli_query($conn, "SELECT * FROM tbl_items where id=$product");
                                
                                $data=mysqli_fetch_assoc($asql);
                                $productname = $data['item_name'];
                             echo $productname;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $amount;?></td>
                        </tr>
                                               
                                            <?php }?>
                                              
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Gross Amount</strong></td>
                                                    <td><strong><?php echo $gross_amount;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Discount</strong></td>
                                                    <td><strong><?php echo $discount;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td><strong>Net Amount</strong></td>
                                                    <td><strong><?php echo $net_amount;?></strong></td>
                                                </tr>
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>
            
                            </div>                            
                            <hr>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Sale Items can only be returend in given period of time.</p>
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
