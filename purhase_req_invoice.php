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
              
              if(isset($_GET['purchase_req_id']))
              {

                $purchase_req_id=mysqli_real_escape_string($conn, $_GET['purchase_req_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$purchase_req_id");

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
 <style type="text/css">
     .card-header
     {
        border-bottom: 1px solid black !important;
     }
     @media print {
  .nodisplay {
    display: none;
  }
}
 </style>
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
                                    <h4>Req Invoice # <?php echo $purchase_req_id;?></h4>
                                    <p>Created Date : <?php echo $created_date;?></p>
                                    </div>
                            </div>
                            <hr>
                            <div class="invoice-mid clearfix">      
                             
                                    
                                    <h5>Receiving Location : <?php echo $user_name;?></h5>
                                    <h5>From Location : <?php echo $branch_name;?></h5>
                                
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-warning">
                                                <tr>
                                                    <th>Brand Name</th>
                                                    <th>Product</th>
                                                    
                                                    <th>Item Serial</th>
                                                    
                                                     
                                                    <th>Qty Requested</th>
                                                    <th>Qty Transfered</th>
                                                    <th>Qty Recieved</th>
                                                    <th>Rate</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                              <?php
              
            
                $lsql=mysqli_query($conn, "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$purchase_req_id and qty_rec!=''  order by product");
               if(mysqli_num_rows($lsql)==0)
                {
                    $lsql=mysqli_query($conn, "SELECT * FROM tbl_purchase_req_detail where purchase_req_id=$purchase_req_id   order by product");
                }
                while ($data=mysqli_fetch_assoc($lsql)) {
                        $product = $data['product'];
                       
                        $qty_rec = $data['qty_rec'];
                        if($qty_rec!='')
                        {
                            $qty = 1;
                        }
                        else
                        {
                             $qty = $data['qty'];
                        }
                        $rate = $data['rate'];
                        $amount = $data['amount'];
                        $item_serial = $data['item_serial'];
                        $barcode = $data['barcode'];
                        $recieved = $data['recieved'];
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
                               <td><?php echo $cat_name;?></td>                    
                              <td><?php echo $productname;?></td>
                              
                              <td><?php echo $item_serial;?></td>
                              
                             
                            <td><?php echo $qty;?></td>
                            <td><?php echo $qty_rec;?></td>
                            <td><?php echo $recieved;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php $total_amount=$total_amount+$amount; echo $amount;?></td>
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
                                                    <td class="table-info"><strong><?php echo $total_amount;?></strong></td>
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
                                                    <td class="table-success"><strong><?php echo $total_amount;?></strong></td>
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
                                    <p>Purchased Req Item's.</p>
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
