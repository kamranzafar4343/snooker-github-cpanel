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

  $f_date =mysqli_real_escape_string($conn,$_GET['fdate']);
  $t_date=mysqli_real_escape_string($conn,$_GET['tdate']);
  $vendors=mysqli_real_escape_string($conn,$_GET['u_id']);




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

                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$vendors");
                        $dataa=mysqli_fetch_assoc($sqll);
                        // print_r($dataa);
                        $vendornamee = $dataa['username']; }  ?>  

                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <span > <b>Customer  : </b> <?php echo $vendornamee;?>
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $f_date.'/'.$t_date;?>
                       </span></div> </div> 
                            <hr>  
                                      <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                             
                                                <table class="table table-hover">
                                           
                                                    <thead >
                                                      <tr>
                                                      <th colspan="7" class="text-center"><h5>SALE'S RECORD </h5> </th>
                                                        </tr>
                                                        <tr class="thead-dark">
                                                    
                                                            <th style="width: 10%;">Trans #</th>                                      
                                                            <!-- <th>P_ID</th>                                       -->
                                                            <th>Item </th>
                                                            <th>Customer</th>                                      
                                                      
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th>Quantity</th>
                                                            <th class="hidden-sm-down">Unit Cost</th>
                                                            <th>Total</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

   $bsql1=mysqli_query($conn,"SELECT tbl_customer.*, tbl_sale.* From tbl_customer inner join tbl_sale on tbl_customer.customer_id=tbl_sale.customer_name  where  tbl_sale.created_date between '$f_date' and '$t_date' and tbl_sale.customer_name='$vendors'  order by tbl_sale.created_date asc");

$count1=mysqli_num_rows($bsql1);

if($count1=='')
{
  //header('Location: customer.php?data=notfound');

}
else{
      $count=0;

while($value = mysqli_fetch_assoc($bsql1))   
                                {   

                                  // print_r($value);
                                    
                                     
                                    $sale_id=$value['sale_id']; 
                                    $customer_id=$value['customer_id']; 
                                    // echo "$cat_name $product<br>";
                                    

                                    

  $sql1=mysqli_query($conn, "SELECT * FROM tbl_sale_detail where sale_id='$sale_id'");
                        $data=mysqli_fetch_assoc($sql1);
                        $rate=$data['rate'];
                        $product=$data['product'];
                        $qty=$data['qty'];
                        $amount=$data['amount'];
                        $net_amount=$data['net_amount'];
                           
                        $gross_amount=$data['gross_amount'];
                        $created_date=$data['created_date'];


  $sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id='$customer_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['username'];
                        // echo $vendorname;exit();

  $sql2=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                        $data1=mysqli_fetch_assoc($sql2);
                        $itemname = $data1['item_name'];
 $count++;
  ?>
                                                        <tr>
                           
                            <td><?php echo "Sale_".$sale_id;?></td>
                         
                            <td><?php echo $itemname;?></td>
                            <td><?php echo $vendorname;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $amount;  $total_amount+=$amount;?></td>
                            <td><?php echo $created_date;?></td>
                                                        </tr>
                                                       
                                                      <?php }}?>
                                                    </tbody>
                                                
                                                <br><br>
<!-- //////////////////////////////////////////////////////////////// Sale Return /////////////////////////////////////////////////////////////////////////// -->
                                                <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                              
                                                    <thead >
                                                        <tr>
                                                      <th colspan="7" class="text-center"><h5>SALE'S RETURN RECORD </h5> </th>
                                                        </tr>
                                                        <tr class="thead-dark">
                                                            <th style="width: 10%;">Trans #</th>                                      
                                                            <!-- <th>P_ID</th>                                       -->
                                                            <th>Item </th>
                                                            <th>Customer</th>                                      
                                                      
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th>Quantity</th>
                                                            <th class="hidden-sm-down">Unit Cost</th>
                                                            <th>Total</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

   $bsql2=mysqli_query($conn,"SELECT tbl_customer.*, tbl_sale_return.* From tbl_customer inner join tbl_sale_return on tbl_customer.customer_id=tbl_sale_return.customer_name  where  tbl_sale_return.created_date between '$f_date' and '$t_date' and tbl_sale_return.customer_name='$vendors'   order by tbl_sale_return.created_date asc");

$count2=mysqli_num_rows($bsql2);

if($count2=='')
{
  //header('Location: customer.php?data=notfound');

}
else{
      $count=0;

while($value = mysqli_fetch_assoc($bsql2))   
                                {   

                                  // print_r($value);
                                    
                                     
                                    $sale_return_id=$value['sale_return_id']; 
                                    $customer_id=$value['customer_id']; 
                                    // echo "$cat_name $product<br>";
                                    

                                    

  $sql1=mysqli_query($conn, "SELECT * FROM tbl_sale_return_detail where sale_return_id='$sale_return_id'");
                        $data=mysqli_fetch_assoc($sql1);
                        $rate=$data['rate'];
                        $product=$data['product'];
                        $qty=$data['qty'];
                        $amount=$data['amount'];
                        $net_amount=$data['net_amount'];
                           
                        $gross_amount=$data['gross_amount'];
                        $created_date=$data['created_date'];


  $sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id='$customer_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['username'];
                        // echo $vendorname;exit();

  $sql2=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                        $data1=mysqli_fetch_assoc($sql2);
                        $itemname = $data1['item_name'];
 $count++;
  ?>
                                                        <tr>
                           
                            <td><?php echo "Sale_Return_".$sale_id;?></td>
                         
                            <td><?php echo $itemname;?></td>
                            <td><?php echo $vendorname;?></td>
                            <td><?php echo $qty;?></td>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $amount;  $total_amount+=$amount;?></td>
                            <td><?php echo $created_date;?></td>
                                                        </tr>
                                                       
                                                      <?php }}?>
                                                    </tbody>
                                                
                                                <br><br>
                                                <!-- //////////////////////////////////////////////////////////////// Installment /////////////////////////////////////////////////////////////////////////// -->
                                                <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                            
                                              
                                                    <thead>
                                                      <tr>
                                                      <th colspan="7" class="text-center"><h5>INSTALLMENT RECORD </h5> </th>
                                                        </tr>
                                                        <tr  class="thead-dark">
                                                            <th style="width: 10%;">Trans #</th>                                      
                                                            <!-- <th>P_ID</th>                                       -->
                                                            <th>Item </th>
                                                            <th>Customer</th>                                      
                                                      
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th>Total Recieved</th>
                                                            <th class="hidden-sm-down">Total Cost</th>

                                                            <th>AVO</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

   $bsql3=mysqli_query($conn,"SELECT tbl_customer.*, tbl_installment.* From tbl_customer inner join tbl_installment on tbl_customer.customer_id=tbl_installment.customer  where  tbl_installment.created_date between '$f_date' and '$t_date' and tbl_installment.customer='$vendors'  order by tbl_installment.created_date asc");

$count3=mysqli_num_rows($bsql3);

if($count3=='')
{
  //header('Location: customer.php?data=notfound');

}
else{
      $count=0;

while($value = mysqli_fetch_assoc($bsql3))   
                                {   

                                  // print_r($value);
                                    
                                     
                                    $plan_id=$value['plan_id']; 
                                    $customer_id=$value['customer']; 
                                    $product=$value['item_id'];
                                    $down_payment=$value['down_payment'];
                                    $total_price=$value['total_price'];
                                    $amount_recived=$value['amount_recieved'];
                                    $avo=$value['avo'];
                                    $created_date=$value['created_date'];
                                    

  $sql=mysqli_query($conn, "SELECT * FROM tbl_salesmen where s_id='$avo'");
                        $data=mysqli_fetch_assoc($sql);
                        $avoname = $data['username'];

  $sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id='$customer_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['username'];
                        // echo $vendorname;exit();

  $sql2=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                        $data1=mysqli_fetch_assoc($sql2);
                        $itemname = $data1['item_name'];
 $count++;
  ?>
                                                        <tr>
                           
                            <td><a href="single_sale.php?sale_type=Credit&customer_id=<?php echo $customer_id ?>&fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>" target="_blank"><?php echo "Installment_".$plan_id;?></a></td>
                         
                            <td><?php echo $itemname;?></td>
                            <td><?php echo $vendorname;?></td>
                            <td><?php if($amount_recived){echo $amount_recived;}else{ echo 0;}?></td>
                            <td><?php echo $total_price;?></td>
                            <td><?php echo $avoname;?></td>
                            <td><?php echo $created_date;?></td>
                                                        </tr>
                                                       
                                                      <?php }}

if($count1=='0' && $count2=='0' && $count3=='0')
{?>
<script>
  window.location.replace("customer.php?data=notfound");
   
</script>

<?php }
                                                      ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                  <!--   <div class="row clearfix">
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
                                    </div>  -->                                   
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
        window.location = ('customer.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('customer.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
