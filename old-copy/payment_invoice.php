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
              
              if(isset($_GET['voucher_id']))
              {

                $voucher_id=mysqli_real_escape_string($conn, $_GET['voucher_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_payment where id=$voucher_id");

                                    $pdata=mysqli_fetch_assoc($sql);
                                     $remarks=$pdata['remarks'];
                                    $total=$pdata['total'];
                                    $invoice_no=$pdata['payment_type']."_".$pdata['id'];
                                    $payment_date=$pdata['payment_date'];
                                    $payment_type=$pdata['payment_type'];
                                    
   
                        
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
                            <div class="invoice-top clearfix">
                                <div class="logo">
                                    <img src="<?php echo $image;?>" alt="user" class="img-fluid">
                                </div>
                                <div class="info">
                                    <h6><?php echo $c_name;?></h6>
                                    <p><?php echo $c_address;?></p>
                                </div>
                                <div class="title">
                                    <h4>Invoice #<?php echo $invoice_no;?></h4>
                                    <p>Created Date : <?php echo $payment_date;?></p>
                                    
                                </div>
                            </div>
                            <!-- hr>
                            <div class="invoice-mid clearfix">      
                             
                                <div class="info">
                                 
                                    <b>Name :</b> <?php echo $customername;?><br>
                                    <b>Created By :</b> <?php echo $customer_from;?><br>
                                    <b>Address :</b> <?php echo $customer_address;?> <br>
                                    <b>Phone :</b> <?php echo $customer_phone;?><br>
                                    <b>CNIC :</b> <?php echo $client_cnic;?><br>
                                </div>
                            </div> -->
                            <div class="row clearfix">
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover" style="border-collapse: collapse; border: none;"> 
                                    <thead >
                                  
                                        <tr>                                            
                                            <th>ID #</th>
                                            <th>Narration</th>
                                        
                                            <th>Payment Type</th>
                                            <th>Debit Account</th>
                                            <th>Credit Account</th>
                                            <th>Created Date</th>
                                            <th>Total Amount</th>
                                            
                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                       
                                  $sql20 = mysqli_query($conn,"SELECT * FROM tbl_payment  where id='$voucher_id'");
                                  
                            
                                    // $d_id=$_GET['d_id'];
                                
                                while($pdata = mysqli_fetch_assoc($sql20))   
                                { 
                                    $id=$pdata['id'];
                                    $remarks=$pdata['remarks'];
                                    $total=$pdata['total'];
                                    $invoice_no=$pdata['payment_type']."_".$pdata['id'];
                                    $payment_date=$pdata['payment_date'];
                                    $payment_type=$pdata['payment_type'];
                                  
                                }
                                $sql_check = mysqli_query($conn,"SELECT * FROM tbl_trans_detail  where invoice_no='$invoice_no' and d_amount='0'");
                                if(mysqli_num_rows($sql_check)>0)
                                {
                                  $table='tbl_trans_detail';
                                  $d_amount='0';
                                  $c_amount='0';
                                }
                                else
                                {
                                  $table='tbl_voucher_detail';
                                  $d_amount='0.00';
                                  $c_amount='0.00';
                                }
                                if($payment_type=='CP' || $payment_type=='BP')
                                {

                                    $sql6 = mysqli_query($conn,"SELECT * FROM ".$table."  where invoice_no='$invoice_no' and d_amount='".$d_amount."'");
                                     while($zdata = mysqli_fetch_assoc($sql6))
                                            {
 
                                                 $acode=$zdata['acode'];

                                                 $total=$zdata['c_amount'];
                                                  $narration=$zdata['narration'];
                                                $query2 = mysqli_query($conn,"SELECT aname FROM tbl_account where acode='$acode'"); 
                                                
                                                $zdata = mysqli_fetch_assoc($query2);
                                                 
                                                 $aname1=$zdata['aname'];
                                                 if($aname1=='')
                                                 {
                                                   $query3 = mysqli_query($conn,"SELECT aname FROM tbl_account_lv2 where acode='$acode'"); 
                                                 
                                                    $zdata = mysqli_fetch_assoc($query3);
                                                     
                                                     $aname1=$zdata['aname'];
                                                 }
                                            }

                                    $sql5 = mysqli_query($conn,"SELECT * FROM ".$table."  where invoice_no='$invoice_no' and c_amount='".$c_amount."'");
                                     while($zdata = mysqli_fetch_assoc($sql5))
                                    {   
                                                $trans_id=$zdata['trans_id'];
                                                $acode=$zdata['acode'];
                                                 $total=$zdata['d_amount'];
                                                $narration=$zdata['narration'];
                                                $query2 = mysqli_query($conn,"SELECT aname FROM tbl_account where acode='$acode'"); 
                                                
                                                $zdata = mysqli_fetch_assoc($query2);
                                                 
                                                 $aname=$zdata['aname'];
                                                 if($aname=='')
                                                 {
                                                   $query3 = mysqli_query($conn,"SELECT aname FROM tbl_account_lv2 where acode='$acode'"); 
                                                 
                                                    $zdata = mysqli_fetch_assoc($query3);
                                                     
                                                     $aname=$zdata['aname'];
                                                 }
                                             
                                    ?>
                                        <tr>
                                            <td class="project-title" >
                                                <h6><?php echo $trans_id;?></h6>
                                                
                                            </td>
                                            <td><?php echo $narration;?></td>
                                            <td><?php echo $payment_type;?></td>
                                            <td><?php echo $aname; ?></td>
                                            <td><?php echo $aname1; ?></td>    
                                            <td><?php echo $payment_date;?></td>
                                            
                                            <td><?php echo $total; $total_amount+=$total;?></td>
                                            
                               
                                            
                                        </tr>
                                          
                                    <?php } }else {?>
                                <?php
                                $sql5 = mysqli_query($conn,"SELECT * FROM ".$table."  where invoice_no='$invoice_no' and c_amount='".$c_amount."'");
                                     while($zdata = mysqli_fetch_assoc($sql5))
                                    {   
                             
                                                $acode=$zdata['acode'];
                                                $narration=$zdata['narration'];
                                                $query2 = mysqli_query($conn,"SELECT aname FROM tbl_account where acode='$acode'"); 
                                                
                                                $zdata = mysqli_fetch_assoc($query2);
                                                 
                                                 $aname=$zdata['aname'];
                                                 if($aname=='')
                                                 {
                                                   $query3 = mysqli_query($conn,"SELECT aname FROM tbl_account_lv2 where acode='$acode'"); 
                                                 
                                                    $zdata = mysqli_fetch_assoc($query3);
                                                     
                                                     $aname=$zdata['aname'];
                                                 }
                                    }
                                $sql6 = mysqli_query($conn,"SELECT * FROM ".$table."  where invoice_no='$invoice_no' and d_amount='".$d_amount."'");
                                     while($zdata = mysqli_fetch_assoc($sql6))
                                            {
 
                                                 $acode=$zdata['acode'];
                                                 $trans_id=$zdata['trans_id'];
                                                 $total=$zdata['c_amount'];
                                                  $narration=$zdata['narration'];
                                                $query2 = mysqli_query($conn,"SELECT aname FROM tbl_account where acode='$acode'"); 
                                                
                                                $zdata = mysqli_fetch_assoc($query2);
                                                 
                                                 $aname1=$zdata['aname'];
                                                 if($aname1=='')
                                                 {
                                                   $query3 = mysqli_query($conn,"SELECT aname FROM tbl_account_lv2 where acode='$acode'"); 
                                                 
                                                    $zdata = mysqli_fetch_assoc($query3);
                                                     
                                                     $aname1=$zdata['aname'];
                                                 }
                                             
                                        
                                ?>
                                        <tr>
                                            <td class="project-title" >
                                                <h6><?php echo $trans_id;?></h6>
                                                
                                            </td>
                                            <td><?php echo $narration;?></td>
                                            <td><?php echo $payment_type;?></td>
                                            <td><?php echo $aname; ?></td>
                                            <td><?php echo $aname1; ?></td>    
                                            <td><?php echo $payment_date;?></td>
                                            
                                            <td><?php echo $total; $total_amount+=$total;?></td>
                                            
                               
                                            
                                        </tr>
                                        <?php  } } 
                                    ?>
                                                <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                </tr>

                                                <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td class="table-success"><strong>Net Amount</strong></td>
                                                    <td class="table-success"><strong><?php echo $total_amount;?></strong></td>
                                                </tr>
                                                <tr>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td style="border: none;"></td>
                                                    <td class="table-warning"><strong>Total Amount</strong></td>
                                                    <td class="table-warning"><strong><?php echo $total_amount;?></strong></td>
                                                </tr>
                                    </tbody>
                                </table>
                                        
                                    </div>
                                </div>
            
                            </div>                                                
                            <hr>
                           <div class="row clearfix nodisplay">
                                <div class="col-md-12 text-center">
                                    <a href="add_payment.php"><button type="button"  class="btn btn-danger">Back</button></a>
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
