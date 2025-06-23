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
// print_r($_GET['u_id']);
$purchase_id = $_GET['v_id'];
$sale_id = $_GET['u_id'];
$prod_id = $_GET['prod'];
// exit();
  // echo $u_id;exit();  




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
                        $nsql=mysqli_query($conn, "SELECT created_date FROM tbl_purchase_detail ");
                        $ndata=mysqli_fetch_assoc($nsql);  // echo $data['c_phone '];exit();
                        $vsql=mysqli_query($conn, "SELECT vendor_id FROM tbl_purchase where purchase_id =$purchase_id ");
                        $vdata=mysqli_fetch_assoc($vsql);
                        $v_id = $vdata['vendor_id'];
                        // print_r($v_id);
                        $namesql=mysqli_query($conn, "SELECT username FROM tbl_vendors where vendor_id=$v_id");
                        $udata=mysqli_fetch_assoc($namesql);
                        $username = $udata['username'];
                        // print_r($username);
                        // exit();
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="logo" style='width: 7%;'>
                                    <img src="<?php echo $image; ?>"  alt="user" class="img-fluid">
                                </div>
                                <div class="info text-right col-md-6" style="margin-top: 1%;" >
                                    <h1><?php echo $c_name;?></h1>
                                    <h3>Item Sale Report</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                                   <!-- <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p> -->
                                   <!-- <h3><?php echo $username;?></h3><br><p><?php echo $ndata['created_date'];?></p> -->
                               </div> </div>
                              </div>
                       
                          
               <?php
                        // $sql=mysqli_query($conn,"SELECT tbl_vendors.username,tbl_vendors.vendor_id,tbl_purchase_detail.purchase_id,tbl_purchase_detail.product,tbl_items.item_id FROM tbl_purchase_detail inner join tbl_items on tbl_purchase_detail.product=tbl_items.item_id where purchase_id=$purchase_id");
                        // $dataa=mysqli_fetch_assoc($sql);
               // echo "string";
                        // print_r("SELECT tbl_vendors.username,tbl_vendors.vendor_id,tbl_purchase_detail.purchase_id,tbl_purchase_detail.product,tbl_items.item_id FROM tbl_purchase_detail inner join tbl_purchase_detail on tbl_purchase_detail.product=tbl_items.item_id where purchase_id=$purchase_id");
                        $vendornamee = $dataa['username'];   ?>  

                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <!-- <span > <b>VENDOR  : </b> <?php echo $username;?></span> -->
                     </div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b> DATE : </b> <?php echo $ndata['created_date']?>
                       </span>
                     </div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th>                             
                                                            <th>Item </th>
                                                            <th>Customer </th>
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th>Quantity</th>
                                                            <th class="hidden-sm-down">Unit Cost</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php


   // $bsql=mysqli_query($conn,"SELECT tbl_purchase_detail.*,tbl_items.* From tbl_purchase_detail inner join tbl_items on tbl_purchase_detail.product=tbl_items.item_id where purchase_id=$purchase_id");
   $bsql=mysqli_query($conn,"SELECT tbl_sale.*,tbl_sale_detail.*,tbl_customer.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id inner join tbl_customer on tbl_customer.customer_id=tbl_sale.customer_name where tbl_sale.sale_id=$sale_id and tbl_sale_detail.product=$prod_id");
   // print_r("SELECT tbl_sale.*,tbl_sale_detail.*,tbl_customer.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id inner join tbl_customer on tbl_customer.customer_id=tbl_sale.customer_name where tbl_sale.sale_id=$sale_id and tbl_sale_detail.product=$prod_id"  );


$count=mysqli_num_rows($bsql);

if($count=='')
{
  // print_r($bsql);
  // print_r("SELECT tbl_purchase_detail.*,tbl_items.* From tbl_purchase_detail inner join tbl_items on tbl_purchase_detail.product=tbl_items.item_id where purchase_id=$purchase_id");exit();
  header('Location: search_purchase.php?data=notfound');

}
else{
      $count=0;

while($value = mysqli_fetch_assoc($bsql))   
                                {   

                                  // print_r($value);exit();
                                    $product=$value['product'];
                                    $cat_name=$value['item_name']; 
                                    $purchase_id=$value['purchase_id']; 
                                    $vendor_id=$value['vendor_id']; 
                                    $username=$value['username']; 
                                    // echo "$cat_name $product<br>";
                                    $rate=$value['s_rate'];
                                    $qty=$value['qty'];

                                    $amount=$value['amount'];
                                    $net_amount=$value['net_amount'];
                           
                                    $gross_amount=$value['gross_amount'];

  $sql=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id='$vendor_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['username'];
                        // echo $vendorname;

  $sql2=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                        $data1=mysqli_fetch_assoc($sql2);
                        $itemname = $data1['item_name'];
                                    // print_r($purchase_id);echo "<br>";
                                    // exit();
                                    // print_r("SELECT * FROM tbl_items where item_id=$product and item_name=$cat_name");exit();

$count++;
  ?>
                                                        <tr>
                            <td><?php echo $count;?></td>
                         
                            <td><?php echo $itemname;?></td>
                            <td><?php echo $username;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $amount=$rate*$qty;  $total_amount+=$amount;?></td>
                                                        </tr>
                                                       
                                                      <?php }}?>
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
                                            <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>  
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
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('stock.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('stock.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
