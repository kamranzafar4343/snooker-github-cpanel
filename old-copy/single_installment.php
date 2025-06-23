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
  


  $month=mysqli_real_escape_string($conn,$_POST['month']);
  $zero=mysqli_real_escape_string($conn,$_POST['zero']);
  
  if($month =='01'){
    $month_name='January';
  }if($month =='02'){
    $month_name='Feburary';
  }if($month =='03'){
    $month_name='March';
  }if($month =='04'){
    $month_name='April';
  }if($month =='05'){
    $month_name='May';
  }if($month =='06'){
    $month_name='June';
  }if($month =='07'){
    $month_name='July';
  }if($month =='08'){
    $month_name='August';
  }if($month =='09'){
    $month_name='September';
  }if($month =='10'){
    $month_name='October';
  }if($month =='11'){
    $month_name='November';
  }if($month =='12'){
    $month_name='December';
  }
   $year =mysqli_real_escape_string($conn,$_POST['year']);
   $date_for = date(''.$year.'-'.$month.'-01');

  // $new_date = date("Y-".$month."-01",strtotime($date."+".$month." month"));

  $salesman1=mysqli_real_escape_string($conn,$_POST['salesman']);

  if($month=="All")
  {
    $where_date="";
    
  }else 
  {
    $where_date = "and MONTH(created_date)='$month' and YEAR(created_date)='$year'";
    
  }
  // $cat=mysqli_real_escape_string($conn,$_POST['cat']);
  // $items=mysqli_real_escape_string($conn,$_POST['items']); 
  ?>
<html lang="en" >
<link rel="icon" href="favicon.ico" type="image/x-icon"><!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<body >

            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                          <!-- <div class="text-center">
                          <h1>SALE REPORT</h1>
                          </div> -->
                          <hr>
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
                            if($salesman1=='All'){
                              $vendornamee="All";
                            }else{
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_salesmen where  s_id=$salesman1");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $vendornamee = $dataa['username'];
                        
                        if(!$vendornamee){
                          $vendornamee='All';
                        }
                         }  ?>  

                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <span > <b>AVO  : </b> <?php if($vendorname==''){echo $vendornamee;} else {echo $vendornamee;}?>
                        
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FOR MONTH : </b> <?php echo $month_name;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th> 
                                                            <th>Date</th>          
                                                            <th>AVO Now</th>
                                                            <th>Customer</th>
                                                            <th>Gurantor1</th>
                                                            <th>Gurantor2</th>
                                                            <th>Gurantor3</th>
                                                            <th>Gurantor4</th>
                                                            <th class="text-right">Amount</th>
                                                       
                                                            <th class="text-right">Amount Paid</th>
                                                            <th class="text-right">Total Installments</th>
                                                            <th class="text-right">Paid Installments</th>
                                                            <th class="hidden-sm-down text-right">Total Recovery</th>
                                                            <th class="hidden-sm-down text-right">Recoverd</th>
                                                            <th class="text-right">Pending</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

// print_r($salesman1);
  if($vendornamee=="All")
  {

    $where="";
    $date = "where created_date BETWEEN '$f_date' AND '$t_date' ";
  }else 
  {
    $where = "where avo='$salesman1'";
    $where_old = "where old_avo='$salesman1'";
    $date = "and created_date BETWEEN '$f_date' AND '$t_date' ";
  }

$query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where");
                                }
                                else
                                {
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where and created_by='$userid' ");
                                  
                                }
  

$check=mysqli_num_rows($bsql);

 if($check==0){

                               if($user_privilege=='superadmin')
                                {
                                 
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where_old");
                                }
                                else
                                {
                                  
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where_old and created_by='$userid' ");
                                  
                                }

  //header("Location: search_installment.php?data=notfound");
  $check2=mysqli_num_rows($bsql);   

  if($check2==0)
  {
    ?>
    <script>
  window.location.replace("search_installment.php?data=notfound");
   
</script>
  <?php }
 }
       

 $count = 0;

while($value1 = mysqli_fetch_assoc($bsql))   
                                { 
                                  $plan_id=$value1['plan_id'];
                                  $installment_status=$value1['installment_status'];
                                  $amount_recieved=$value1['amount_recieved'];
                                  $inst_created_date=$value1['created_date'];
                             
                                  
                                  // $itemsql1=mysqli_query($conn,"SELECT SUM(per_month_amount) as sum, COUNT(payment_id) as paid, plan_id,created_date from tbl_installment_payment $where $where_date  and plan_id='$plan_id'");
                               
                                  //  $value = mysqli_fetch_assoc($itemsql1);  
                                 
                                  // $created_date=$value1['created_date'];
                                 
                                   
                                 $itemsql2=mysqli_query($conn,"SELECT SUM(installment_number) as paid,SUM(per_month_amount) as sum from tbl_installment_payment where plan_id='$plan_id'");
                                   $value2 = mysqli_fetch_assoc($itemsql2);  
                                  $paid = $value2['paid'];
                                 
                                  $created_date1=$value1['created_date'];
                                  $total = round($value1['per_month_amount'],0);
                                  $date = date($inst_created_date);
                                    $date_check = date('Y-m-23', strtotime($date)); 

                                    if($date_check<=$date)
                                    {

                                        $created_date = date("Y-m-01",strtotime($date."+1 month"));
                                    }
                                    else
                                    {
                                        //$new_date = date('Y-m-01',strtotime($new_date." +$y month"));
                                     $created_date = date('Y-m-01', strtotime($date));

                                    }
                                    
                                          // print_r($date); 
                                  $a=-1;
                                  
                                  for ($y = 1; $y <= $paid; $y++) {
                                  $a++;
                                  $needed = date('Y-m-01',strtotime($created_date." +$a month"));
                                 
                                  if($date_for==$needed)
                                  {
                                    //echo $date_for;

                                    $remain = 0;
                                  }
                                 
                                 
                                  }
                                  if($remain=='0')
                                  {
                                    $remain = 0;
                                     $installment = round($total,0);
                                   
                                  }
                                  else
                                  {
                                    $remain = round($total - $installment, 0);
                                     $installment = round($value['sum'],0);
                                  }
                                  $period = $value1['period'];
                                  $gran1_name = $value1['gran1_name'];
                                  $gran1_mobile_no = $value1['gran1_mobile_no'];
                                  $gran2_name = $value1['gran2_name'];
                                  $gran2_mobile_no = $value1['gran2_mobile_no'];
                                  $gran3_name = $value1['gran3_name'];
                                  $gran3_mobile_no = $value1['gran3_mobile_no'];
                                  $gran4_name = $value1['gran4_name'];
                                  $gran4_mobile_no = $value1['gran4_mobile_no'];
                                  $customer = $value1['customer'];
                                  $down_payment = $value1['down_payment'];
                                  $installment1+=$installment;
                                  $inst_month = date("m",strtotime($inst_created_date));
                                  $inst_year = date("Y",strtotime($inst_created_date));
                                
                                  if($month < $inst_month && $year<=$inst_year)
                                  {
                                     ?>
                                      <script>
                                    window.location.replace("search_installment.php?data=notfound");
                                     
                                  </script>
                                  <?php
                                    
                                  }
                                  
                                  
                                  $avo = $value1['avo'];
                                  $total_price = $value1['total_price'];  
                                  $query=mysqli_query($conn, "SELECT * FROM tbl_salesmen where  s_id=$avo");
                        $data4=mysqli_fetch_assoc($query);
                        $salesman_name = $data4['username'];
                         $query1=mysqli_query($conn, "SELECT * FROM tbl_customer where  customer_id=$customer");
                        $data3=mysqli_fetch_assoc($query1);
                        $customer_name = $data3['username']; 
                        $mobile_no1 = $data3['mobile_no1'];  
$count++;

if($zero==''){
if($remain=='0'){
  ?>
                                                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $created_date;?></td>
                            <td><?php echo $salesman_name;?></td>
                            <td><?php echo $customer_name." <br> ".$mobile_no1 ;?></td>
                            <td><?php echo $gran1_name." <br> ".$gran1_mobile_no ;?></td>
                            <td><?php echo $gran2_name." <br> ".$gran2_mobile_no ;?></td>
                            <td><?php echo $gran3_name." <br> ".$gran3_mobile_no ;?></td>
                            <td><?php echo $gran4_name." <br> ".$gran4_mobile_no ;?></td>
                            <td class="text-right"><?php echo $total_price;?></td>
                  
                            <td class="text-right"><?php if($amount_recieved){echo $amount_recieved+$down_payment;}else{ echo 0;}?></td>
                            <td class="text-right"><?php echo $period;?></td>
                            <td class="text-right"><?php echo $paid;?></td>
                            <?php if($installment_status=='Pending'){?>
                              <td class="text-right"><?php echo abs($total);?></td>
                            <td class="text-right"><?php if($installment){echo $installment;}else{ echo 0;}?></td>
                            <td class="text-right"><?php echo $remain;?></td>
                            <?php }?>
                            <?php if($installment_status=='Completed'){?>
                              <td class="text-right"><?php echo abs($total);?></td>
                            <td class="text-right"><?php echo $installment;?></td>
                            <td class="text-right"><?php echo 0;?></td>
                            <?php }?>
                            <!-- <td><?php echo $amount;  $total_amount+=$amount;?></td> -->
                                                        </tr>
                                                      <?php }}

else{

  ?>
<tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $created_date;?></td>
                            <td><?php echo $salesman_name;?></td>
                            <td><?php echo $customer_name." <br> ".$mobile_no1 ;?></td>
                            <td><?php echo $gran1_name." <br> ".$gran1_mobile_no ;?></td>
                            <td><?php echo $gran2_name." <br> ".$gran2_mobile_no ;?></td>
                            <td><?php echo $gran3_name." <br> ".$gran3_mobile_no ;?></td>
                            <td><?php echo $gran4_name." <br> ".$gran4_mobile_no ;?></td>
                            <td class="text-right"><?php echo $total_price;?></td>
                  
                            <td class="text-right"><?php if($amount_recieved){echo $amount_recieved+$down_payment;}else{ echo 0;}?></td>
                            <td class="text-right"><?php echo $period;?></td>
                            <td class="text-right"><?php echo $paid;?></td>
                            <?php if($installment_status=='Pending'){?>
                              <td class="text-right"><?php echo abs($total);?></td>
                            <td class="text-right"><?php if($installment){echo $installment;}else{ echo 0;}?></td>
                            <td class="text-right"><?php echo $remain;?></td>
                            <?php }?>
                            <?php if($installment_status=='Completed'){?>
                              <td class="text-right"><?php echo abs($total);?></td>
                            <td class="text-right"><?php echo $installment;?></td>
                            <td class="text-right"><?php echo 0;?></td>
                            <?php }?>
                            <!-- <td><?php echo $amount;  $total_amount+=$amount;?></td> -->
                                                        </tr>
<?php }
}?>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
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
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>






</body>
<style type="text/css">
  .data-table-container {
  padding: 10px;
}

.dt-buttons .btn {
  margin-right: 3px;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: false,
      buttons: [
        {
          extend: 'pdf',
          text: 'PDF',
          title: 'Alkareem (Recovery)',
          orientation: 'landscape',
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
          className: 'btn btn-danger'
        },
        {
          extend: 'print',
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: 'Alkareem (Recovery)',

          
        },


      ]


    });
} );
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
