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
              
              if(isset($_GET['payment_id']))
              {

                $payment_id=mysqli_real_escape_string($conn, $_GET['payment_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_installment_payment where payment_id=$payment_id");

                $data=mysqli_fetch_assoc($sql);
                        $plan_id = $data['plan_id'];
                        $installment_number = $data['installment_number'];
                        $customer_name = $data['customer'];
                      
                        $per_month_amount = $data['per_month_amount'];
                  
                        $created_date = $data['created_date'];
                        $amount_recieved = $data['amount_recieved'];
                        $created_by = $data['created_by'];
                        $inst_date = $data['created_date'];
                        $remaining = $data['remaing'];
                        $prev = $data['prev_balance'];
                    
                        $avo = $data['avo'];
                    $query3=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer_name");
                $data3=mysqli_fetch_assoc($query3);
                $customer_name = $data3['username'];
                $seprate_customer_id = $data3['seprate_customer_id'];
                $customer_profile = $data3['user_profile'];
                $customer_address1 = $data3['address_permanent'];
                $customer_address2 = $data3['address_current'];
                $customer_phone2 = $data3['mobile_no2'];
                $customer_phone = $data3['mobile_no1'];
                $client_cnic = $data3['client_cnic'];
                $client_fname = $data3['client_fathername'];
                $client_occupation = $data3['client_occupation'];     
                $client_residential = $data3['client_residential'];
                $customer_by=$data3['created_by'];
                                              $sql=mysqli_query($conn, "SELECT user_name FROM users where user_id='$customer_by'");
                                              $data = mysqli_fetch_array($sql);
                                                $branchname = $data['user_name'];
                                                $iden = str_split($branchname);
                                                $iden3 = str_split($branchname,3);
                                                $iden2=end($iden3);
                                                $iden1=$iden[0];
            
                    
                    $query4=mysqli_query($conn, "SELECT user_name, user_address FROM users where user_id=$created_by");
                    $data4=mysqli_fetch_assoc($query4);
                    $created_by = $data4['user_name'];
                    $user_address = $data4['user_address'];  

                        $query2 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query2) ;
                                   $branch_name=$zdata1['user_name'];
                        $query3 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$customer_by"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query3) ;
                                   $customer_from=$zdata1['user_name'];
                         $query6=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$avo");
                            $data6=mysqli_fetch_assoc($query6);
                            $avo_name = $data6['username'];

   
                        $sql_count=mysqli_query($conn, "SELECT SUM(installment_number) as paid  FROM tbl_installment_payment where plan_id=$plan_id");

                                                $sql_count_data=mysqli_fetch_assoc($sql_count);
                                                $paid = $sql_count_data['paid'];

                        $sql_count1=mysqli_query($conn, "SELECT  per_month_amount FROM tbl_installment_payment where plan_id=$plan_id Limit 1");

                                                $sql_count_data=mysqli_fetch_assoc($sql_count1);
                                                $per_month_amount1 = $sql_count_data['per_month_amount'];


                        $lsql=mysqli_query($conn, "SELECT * FROM tbl_installment where plan_id=$plan_id");

                while ($data=mysqli_fetch_assoc($lsql)) {
                        $product = $data['item_id'];
                        $period = $data['period']-1;
                        $amount_recieved = $data['amount_recieved'];
                        $total_price = $data['total_price'];
                        $down_payment = $data['down_payment'];
                        $remarks = $data['remarks'];
                        $item_serial = $data['item_serial'];
                        $barcode = $data['barcode'];
                        $created_date1 = $data['created_date'];
                     $asql=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                                
                                $data=mysqli_fetch_assoc($asql);
                                $productname = $data['item_name'];
                                $item_model = $data['item_model'];
                                $brand_id = $data['brand_id'];
                                 $asql=mysqli_query($conn, "SELECT * FROM tbl_catagory where id=$brand_id");
                                
                                $data=mysqli_fetch_assoc($asql);
                                $cat_name = $data['cat_name'];
              }}
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
 <style type="text/css">
     .card-header
     {
        border-bottom: 1px solid black !important;
     }
     @media print {
  .nodisplay {
    display: none;
  }
  p .urdu
  {
   padding-left: 50%;
  }
  @font-face {
  font-family: "Open Sans";
  src: url("/fonts/OpenSans-Regular-webfont.woff2") format("woff2"),
       url("/fonts/OpenSans-Regular-webfont.woff") format("woff");
}
}
 </style>
 <body>
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
                            <div class="row clearfix">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-4">
                                                <div class="col-md-4">
                                                    <img src="<?php echo $image;?>" alt="user" class="img-fluid" style="max-width: 100%;">
                                                </div>
                                               
                                            </div>
                                             <div class="col-md-4 col-sm-4 text-center" style="margin-top: 30px;">
                                                    <h5>CUSTOMER INSTALLMENT PAYMENT INVOICE</h5>
                                                    <p><?php echo $created_by ." : ". $user_address;?></p>
                                     
                                                </div>
                                               <div class="col-md-4 text-right" style="margin-top: 30px;">
                                                    <p><b>Print Date : <?php echo date('d-m-Y');?></b></p>
                                                    <p><b>Print Time : <?php date_default_timezone_set("Asia/Karachi");
                                                    echo $created_date=date("h:i:s A");?></b></p>
                                                </div>
                                        </div>
                                    </div>
                              
                            </div>
                          
                            <hr>
                          
                            <div class="row clearfix" style="line-height: 13px;">
                            <div class="col-md-12 col-sm-12"  >
                                  <div class="card bg-default text-dark mb-3" >
                                    
                                   <div class="row clearfix" style="border: 1px solid black !important;">
                                    <div class="col-md-4 col-sm-12"  >
                                       
                                     <br>
                                        <p><b>Customer ID </b> :  <?php echo $iden1.$iden2."_".$seprate_customer_id;?></p>
                                        <p><b>Account ID </b> :  <?php echo $plan_id;?></p>
                                        <p><b>NAME </b> :  <?php echo $customer_name;?></p>
                                        <p><b>SO / DO / WO </b> :  <?php echo $client_fname;?></p>
                                        <p><b>Recovery Officer : </b> <?php echo $avo_name;?></p>
                                      
                                        <p><b>Total Installments : </b><?php echo $period;?></p>
                                        <p><b>Recv. Installments : </b><?php echo $paid;?></p>
                                       <!--  <p><b>CUSTOMER RESIDENCE : </b><?php echo $client_residential;?></p> -->
                                    
                                  </div>
                                    <div class="col-md-4 col-sm-12"  >
                                      
                                     <br>
                                        <p><b>Account Date  : </b> <?php echo $created_date1;?></p>
                                        <p><b>Installment Date : </b> <?php echo $inst_date;?></p>
                                        <br><br><br><br><br>
                                       <p><b>Narration  : </b> <?php echo $remarks;?></p>
                                        <p><b>Rem. Installments : </b> <?php echo $period-$paid;?></p>
                                        
                                 
                                  </div>
                                  <div class="col-md-4 col-sm-12" >
                                    <br>
                                        <p><b>Total Price : </b> <?php echo number_format($total_price);?></p>
                                        <p><b>Duration : </b><?php echo $period;?></p>
                                        <p><b>Advance : </b> <?php echo number_format($down_payment);?></p>
                                        <p><b>Pre. Balance : </b> <?php echo number_format($remaining+$per_month_amount);?></p>
                                        <p><b>Installment : </b> <?php echo number_format($per_month_amount);?></p>
                                
                                        
                                        <p><b>Remaining Balance : </b> <?php echo number_format($remaining);?></p>
                                    </div>
                                  <div class="col-md-12 col-sm-12" style="border: 1px solid black !important;">
                                    <br>
                                       <p class="text-right" style="font-size:15px;font-weight:  bold;  font-family:Nafees Nastaleeq;"><i> اہم نوٹ ! 5 سے پہلے قسط کی ادائیگی ضروری ہے۔ محکمہ کی رسید کے بغیر کوئی لین دین نہ کریں۔ رسید کے بغیر محکمہ ذمہ دار نہیں ہوگا۔</i></p>
                                    </div>
                              </div>
                                </div>
                            </div>
                            </div>
                                                
                            <!-- <hr>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <h5>Note</h5>
                                    <p>Sale Items can only be returend in given period of time.</p>
                                </div>
                                
                            </div> -->
                            <hr>
                            <div class="row clearfix nodisplay">
                                <div class="col-md-12 text-center">
                                    <a href="installment_customer.php"><button type="button"  class="btn btn-danger">Back</button></a>
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
