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
              
              if(isset($_GET['planid']))
              {

                $planid=mysqli_real_escape_string($conn, $_GET['planid']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_installment where plan_id=$planid");

                $data=mysqli_fetch_assoc($sql);
                        $id = $data['plan_id'];
                        $customer = $data['customer'];
                        $cat_id = $data['cat_id'];
                        $item_id = $data['item_id'];
                        $total_price = $data['total_price'];
                        $down_payment = $data['down_payment'];
                        $created_by = $data['created_by'];
                        $installment_status = $data['installment_status'];
                        $remaining = $total_price-$down_payment;

                        $period = $data['period'];
                        
                        $x=$period;
                        $per_month_amount = $data['per_month_amount'];
                        $created_date = $data['created_date'];
                        $created_by = $data['created_by'];
                        $avo = $data['avo'];
                        $mo = $data['mo'];
                        $bm = $data['bm'];
                        $sale_men = $data['sales_men'];

                        $gran1_name=$data['gran1_name'];
                        $gran1_fname=$data['gran1_fname'];
                        $gran1_mobile_no=$data['gran1_mobile_no'];
                        $gran1_mobile_no=$data['gran1_mobile_no'];
                        $gran1_client_cnic=$data['gran1_client_cnic'];
                        $gran1_relation=$data['gran1_relation'];
                        $gran1_occup=$data['gran1_occup'];
                        $gran1_address=$data['gran1_address'];
                        $gran1_office=$data['gran1_office'];

                        $gran2_name=$data['gran2_name'];
                        $gran2_fname=$data['gran2_fname'];
                        $gran2_mobile_no=$data['gran2_mobile_no'];
                        $gran2_client_cnic=$data['gran2_client_cnic'];
                        $gran2_relation=$data['gran2_relation'];
                        $gran2_occup=$data['gran2_occup'];

                        $gran3_name=$data['gran3_name'];
                        $gran3_fname=$data['gran3_fname'];
                        $gran3_mobile_no=$data['gran3_mobile_no'];
                        $gran3_client_cnic=$data['gran3_client_cnic'];
                        $gran3_relation=$data['gran3_relation'];
                        $gran3_occup=$data['gran3_occup'];

                        $gran4_name=$data['gran4_name'];
                        $gran4_fname=$data['gran4_fname'];
                        $gran4_mobile_no=$data['gran4_mobile_no'];
                        $gran4_client_cnic=$data['gran4_client_cnic'];
                        $gran4_relation=$data['gran4_relation'];
                        $gran4_occup=$data['gran4_occup'];
                        $created_by = $data['created_by'];
         

                

                $query2=mysqli_query($conn, "SELECT item_name,item_model,brand_id FROM tbl_items where item_id=$item_id");
                $data2=mysqli_fetch_assoc($query2);
                $item_name = $data2['item_name'];
                $item_model = $data2['item_model'];
                $brand_id = $data2['brand_id'];

                $query1=mysqli_query($conn, "SELECT cat_name FROM tbl_catagory where id=$brand_id");
                $data1=mysqli_fetch_assoc($query1);
                $cat_name = $data1['cat_name'];

                $query3=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer");
                $data3=mysqli_fetch_assoc($query3);
                $customer_name = $data3['username'];
                $customer_address1 = $data3['address_permanent'];
                $customer_address2 = $data3['address_current'];
                $customer_phone2 = $data3['mobile_no2'];
                $customer_phone = $data3['mobile_no1'];
                $client_cnic = $data3['client_cnic'];
                $client_fname = $data3['client_fathername'];
                $client_occupation = $data3['client_occupation'];     
                $client_residential = $data3['client_residential'];
                $gender = $data3['gender'];

                $customer_by=$data3['created_by'];
                    
                    $query9= mysqli_query($conn,"SELECT user_name,created_by FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query9) ;
                                   $creator_name=$zdata['user_name'];
                                  
                                   $created=$zdata['created_by'];

                        $query10 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $branch_name=$zdata1['user_name'];
                        $query11 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$customer_by"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query11) ;
                                   $customer_from=$zdata1['user_name'];

                $query4=mysqli_query($conn, "SELECT user_name FROM users where user_id=$created_by");
                $data4=mysqli_fetch_assoc($query4);
                $created_by = $data4['user_name'];   

                $query5=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$sale_men");
                $data5=mysqli_fetch_assoc($query5);
                $sales_men = $data5['username'];   

                $query6=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$avo");
                $data6=mysqli_fetch_assoc($query6);
                $avo_name = $data6['username'];   

                $query7=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$mo");
                $data7=mysqli_fetch_assoc($query7);
                $mo_name = $data7['username'];   

                $query8=mysqli_query($conn, "SELECT username FROM tbl_salesmen where s_id=$bm");
                $data8=mysqli_fetch_assoc($query8);
                $bm_name = $data8['username'];   
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

<!-- <body onload="window.print();">
 -->
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
                                </div>
                            </div>
                            <hr>
             
<style type="text/css">


thead {display: table-row-group;}
</style>
<style>
    .page-break {
        page-break-inside: avoid !important;
    margin: 10px 0 10px 0;
    }
   
</style>


                            
            <div class="row">
            <div class="col-md-6 col-xs-6"  >
                                         <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1" style="border: 2px solid black;"  >                        
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                       <div class="title">
                                  
                                        <p ><b>CUSTOMER NAME </b> :  <?php echo $customer_name;?></p>
                                        <p><b>CUSTOMER CREATED BY</b> :  <?php echo $customer_from;?></p>
                                      
                                        <p><b>CURRENT ADDRESS : </b> <?php echo $customer_address2;?></p>
                                        <p><b>PERMANENT ADDRESS : </b> <?php echo $customer_address1;?></p>
                                        <p><b>PHONE 1: </b><?php echo $customer_phone;?></p>
                                    
                                        <p><b>CUSTOMER CNIC : </b><?php echo $client_cnic;?></p>
                                        <p><b>BRANCH : </b> <?php echo $branch_name;?></p>
                                        <p><b>MO : </b> <?php echo $mo_name;?></p>
                                        <p><b>AVO : </b> <?php echo $avo_name;?></p>
                             
                                        <p><b>PERIOD : </b> <?php echo $period;?></p>
                                        <p><b>PER MONTH PAYMENT : </b> <?php echo $per_month_amount;?></p>
                                       
                                    </div>
                                    </div>
                                </div>
            
                            </div>                            
                          
                        </div>
                    </div>
                </div>
            </div>
                            
                </div>
                
                <div class="col-md-6 col-xs-6"  >
                                         <div class="row clearfix" >
                                            <div class="col-lg-12 col-md-12">
                     <div class="card invoice1"  style="border: 2px solid black;">                        
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" >
                                            <thead class="thead-default ">
                                                <tr>
                                                   
                                                    <th>Item Name</th>

                                                    <th class="text-right">Qty</th>
                                                    <th class="text-right">Price</th>
                                                   
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <tr>
                                                    
                                                    <td><?php echo $item_name;?></td>
                                                    <td class="text-right"><?php echo 1;?></td>
                                                    <td class="text-right"><?php echo $total_price;?></td>
                                                  
                                                </tr>
                                                <tr style="border-top: 2px solid black;">
                                                    
                                                    <td><b>Total</b></td>
                                                    <td class="text-right"><?php echo 1;?></td>
                                                    <td class="text-right"><?php echo $total_price;?></td>
                                                  
                                                </tr>
                                                 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
            
                            </div>                            
                          
                        </div>
                    </div>
                    </div>
                <div class="col-lg-12 col-md-12">
                     <div class="card invoice1"  style="border: 2px solid black;">                        
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" >
                                            <thead class="thead-default ">
                                                <tr>
                                                   
                                                    <th>Voucher Type</th>

                                                    <th class="text-right">Debit</th>
                                                    <th class="text-right">Credit</th>
                                                    <th class="text-right">Balance</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                 <?php 
                                                    
                                                    $sql=mysqli_query($conn, "SELECT opening_bal,opening_date FROM tbl_account_lv2  where acode='$customer'");
                                                    $data=mysqli_fetch_assoc($sql);
                                                    $opening_bal = $data['opening_bal'];
                                                    
                                               
                                                    ?>
                                                <tr>
                                                    
                                                    <td>Opening Balance</td>
                                                    <td class="text-right"><?php echo $opening_bal;?></td>
                                                    <td class="text-right"></td>
                                                    <td class="text-right"><?php echo $opening_bal;?></td>
                                                </tr>
                                                 <?php 
                                                 $invoice='Installment_'.$id;
                                                    
                                                    $sql=mysqli_query($conn, "SELECT sum(d_amount-c_amount) as remain FROM `tbl_trans_detail` where invoice_no='$invoice' and acode='$customer'");
                                                    $data=mysqli_fetch_assoc($sql);
                                                    $remain = round($data['remain']);

                                                    $sql=mysqli_query($conn, "SELECT SUM(c_amount) as customer_remain FROM `tbl_trans_detail` where invoice_no='$invoice' and  acode='$customer'");
                                                    $data=mysqli_fetch_assoc($sql);
                                                    $customer_paid = round($data['customer_remain']);
                                                  
                                                    ?>
                                                <tr>
                                                    
                                                    <td>CUSTOMER</td>
                                                    <td class="text-right"><?php echo $customer_paid;?></td>
                                                    <td class="text-right"><?php echo $total_price;?></td>
                                                    <td class="text-right"><?php echo $customer_paid-$total_price;?></td>
                                                </tr>
                                                
                                                 <tr>
                                                    
                                                    <td>SALE</td>
                                                    <td class="text-right"><?php echo $total_price;?></td>
                                                    <td class="text-right"><?php echo $customer_paid;?></td>
                                                    <td class="text-right"><?php echo $total_price-$customer_paid;?></td>
                                                </tr>
                                              
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
            
                            </div>                            
                          
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
                            
                
          <div class="col-md-12 col-xs-12"  id="Installment_detail">
                                         <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="border: 2px solid black;">
                                            <thead class="thead-default ">
                                                <tr>
                                                    <th hidden="">Installment#</th>
                                                    <th>For Month</th>
                                                    <th>Monthly Installment</th>

                                                    <th >Created By</th>
                                                    <th >Receiving Branch</th>
                                                    <th >Status</th>
                                                    <th class="text-right">Paid Date</th>
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="Installmentdetail1">
                                            </tbody>
                                                <tbody>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
            
                            </div>                            
                          
                        </div>
                    </div>
                </div>
            </div>
                            
                </div>

                </div>
                  <div class="row clearfix">
                                <div class="col-md-12 text-center">
                                    <a href="installment_customer.php"><button type="button"  class="btn btn-danger">Back</button></a>
                                </div>
                                
                            </div>
</body>
<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
</body>
<script type="text/javascript">
    get_installmentdetail();
     function get_installmentdetail(){

        var planid=<?php echo $planid;?>;


          $.ajax({
            type: "POST",
            url:"operations/inst_invoice.php",
            data: {planid:planid},
         
           success:function(data)
           {

            $('#Installmentdetail1').html(data);
           }
          })

        }
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
