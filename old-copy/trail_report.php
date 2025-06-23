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
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="logo" style='width: 7%;'>
                                    <img src="<?php echo $image; ?>"  alt="user" class="img-fluid">
                                </div>
                                <div class="info text-right col-md-6" style="margin-top: 1%;" >
                                    <h1><?php echo $c_name;?></h1>
                                    <h3>General Ledger</h3>

                                  
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
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_vendors where v_id=$vendors");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $vendornamee = $dataa['username']; }  ?>  

                               <div class="row">
                                   
                            <div class="clearfix text-right col-md-12" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $f_date.'/'.$t_date;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                            <th>Trans #</th>          
                                                            <th>Account</th>
                                                            <th>Narration</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

 $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $bsql=mysqli_query($conn,"SELECT left(acode,6),d_amount,c_amount,acode,trans_id,narration FROM tbl_trans_detail where created_date between '$f_date' and '$t_date' order by trans_id asc");
                                }
                                else
                                {
                                    $bsql=mysqli_query($conn,"SELECT left(acode,6),d_amount,c_amount,acode,trans_id,narration FROM tbl_trans_detail where created_date between '$f_date' and '$t_date' and parent_id='$userid' order by trans_id asc");

                                  
                                }
  
 

      $count=0;

while($value = mysqli_fetch_assoc($bsql))   
                                { 


                                    $acode=$value['left(acode,6)'];
                                    $d_amount=$value['d_amount']; 
                                    $trans_id=$value['trans_id'];
                                    $c_amount=$value['c_amount'];
                                    $narration=$value['narration'];
                                    $acode1=$value['acode'];
                                    

                        $sql=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode");
                        $data=mysqli_fetch_assoc($sql);
                        $aname = $data['aname'];
                        
                       
                        $sql1=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where acode=$acode1");
                        $data=mysqli_fetch_assoc($sql1);
                        $aname1 = $data['aname'];

                        

$count++;
  ?>
                                                        <tr>
                            <td><?php echo $trans_id;?></td>
                            <td><?php echo $aname; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                            <td><?php echo $narration;?></td>
                            <td><?php echo $d_amount; $total_damount+=$d_amount;?></td>
                            
                            <td><?php echo $c_amount; $total_camount+=$c_amount;?></td>
                            
                                                        </tr>
                                                       
                                                      <?php } ?>
                                                      <tr>
                            <td></td>
                            <td></td>

                            <td><h4 class="m-b-0 m-t-10">Total</h4></td>
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_damount;?></h4></td>
                            <td><h4 class="m-b-0 m-t-10"><?php echo $total_camount;?></h4></td>
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
                                  
                                                                                   
                                            <h3 class="m-b-0 m-t-10">AMT ( <?php $net_amount=$total_damount-$total_camount; echo $net_amount; ?> )</h3>
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
