<!doctype html>
<html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";

session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>

<body class="theme-orange">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

<!-- Page Loader -->
<?php
include "includes/loader.php";

?>
<!-- Overlay For Sidebars -->
   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Trial Balance</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Trial Balance</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php 
if($_POST)
{
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
}
else
{
  $f_date = date('Y-m-d');  
  $t_date = date('Y-m-d');
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  
}
 ?>

<body>
   <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: 30px;">
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

                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1 class="text-center"><?php echo $c_name;?></h1>
                                    <h3  class="text-center">Trial Balance</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix text-center col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger"   id="danger-alert" style="display:none;">
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
                                </div>
                         <form  action="trail_balance_sum.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-4">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                               <div class="col-md-4 col-sm-12" style="margin-top:35px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="purchase_rep" onclick="check()" target='_blank'>Search</button>
                                 </div>
                                 <!-- <div class="col-md-2 col-sm-12" style="margin-top:35px;">
                                        <a href="index.php"><button style="width:100%; " type="button" class="btn btn-sm btn-danger">Back</button></a>
                                 </div> -->
                                </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                    

                               <div class="row">
                                   
                            <div class="clearfix text-right col-md-12" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  

<?php
///////////////////////// cash at bank///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100700' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_bank = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as bank_bal FROM tbl_trans_detail where Left(acode, 6)='100700' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
$data1=mysqli_fetch_assoc($sql1);
$bank_bal_deb = $data1['bank_bal'];

$bank_total=$opening_bal_bank+$bank_bal_deb;
///////////////////////////////////////////////////////////////////////////

///////////////////////// Accounts Rec ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100200' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_acc_rec = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as acc_rec_bal FROM tbl_trans_detail where Left(acode, 6)='100200' and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$acc_rec_bal = $data1['acc_rec_bal'];

$acc_rec_total=$opening_bal_acc_rec+$acc_rec_bal;
///////////////////////////////////////////////////////////////////////////


///////////////////////// Cash in hand ///////////////////////////////////////



$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100100' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_branch = $data['opening_bal'];

$query=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100100' and opening_date < '$f_date' and created_by='$userid'");
$data2=mysqli_fetch_assoc($query);
$opening_bal_cih = $data2['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM tbl_trans_detail where Left(acode, 6) ='100100' and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$cash_in_hand = $data1['cash_in_hand'];

$cash_in_hand_total=$opening_bal_cih+$cash_in_hand+$opening_bal_branch;
/////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////Revenue/////////////////////////////////////
$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='300100' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_cogs = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as revenue FROM tbl_trans_detail where Left(acode, 6) IN('300100', '300200') and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$revenue = $data1['revenue'];

$total_cogs=$opening_bal_cogs+$revenue;
////////////////////////////////////////////////////////////////////////////////////////////

///////////////////////// Inventory in hand ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100300' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_stock = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as stock_in_hand FROM tbl_trans_detail where Left(acode, 6)IN('100300',  '100000') and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$stock_in_hand = $data1['stock_in_hand'];

$stock_in_hand_total=$opening_bal_stock+$stock_in_hand;
$current_assests=$stock_in_hand_total+$cash_in_hand_total+$acc_rec_total+$bank_total;
///////////////////////////////////////////////////////////////////////////

///////////////////////// Buildings ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100600' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_land = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as land FROM tbl_trans_detail where Left(acode, 6)='100600' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
$data1=mysqli_fetch_assoc($sql1);
$land = $data1['land'];

$land_total=$opening_bal_land+$land;

///////////////////////////////////////////////////////////////////////////

///////////////////////// Equipement ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100800' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_equip = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as equip FROM tbl_trans_detail where Left(acode, 6)='100800' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
$data1=mysqli_fetch_assoc($sql1);
$equip = $data1['equip'];

$equip_total=$opening_bal_equip+$equip;
$non_current_assests=$equip_total+$land_total;
///////////////////////////////////////////////////////////////////////////
////////////////////////////////Assests total //////////////////////////
$assests=$non_current_assests+$current_assests;
/////////////////////////////////////////////////////////////////////


///////////////////////// Account payable ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='200200' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_payable = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as payable FROM tbl_trans_detail where Left(acode, 6)='200200' and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$payable = $data1['payable'];

$payable_total=(-$opening_bal_payable+$payable);

///////////////////////////////////////////////////////////////////////////

///////////////////////// Accrued Expense ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='500200' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_expense = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as expense FROM tbl_trans_detail where Left(acode, 6)='500200' and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$expense = $data1['expense'];

$expense_total=($opening_bal_expense+$expense);

///////////////////////////////////////////////////////////////////////////

///////////////////////// Salary/Wages ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='500100' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_salary = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as salary FROM tbl_trans_detail where Left(acode, 6)='500100' and created_date between '$f_date' and '$t_date'");
$data1=mysqli_fetch_assoc($sql1);
$salary = $data1['salary'];

$salary_total=($opening_bal_salary+$salary);

///////////////////////////////////////////////////////////////////////////
////////////////////////////////Liabilities total //////////////////////////
$liabilities=$salary_total+$expense_total+$payable_total;
///////////////////////////////////////////////////////////////////////


///////////////////////// Owner Contribution ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='400100' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_owner = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as contribution FROM tbl_trans_detail where Left(acode, 6)='400100' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
$data1=mysqli_fetch_assoc($sql1);
$contribution = $data1['contribution'];

$owner_total=($opening_bal_owner+$contribution);

///////////////////////////////////////////////////////////////////////////

///////////////////////// Owner Draws ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='400200' and opening_date < '$f_date'  and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_draws = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as draws FROM tbl_trans_detail where Left(acode, 6)='400200' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
$data1=mysqli_fetch_assoc($sql1);
$draws = $data1['draws'];

$owner_draws_total=($opening_bal_draws+$draws);

///////////////////////////////////////////////////////////////////////////
////////////////////////////////total Earning//////////////////////////
$earning=$assests-$liabilities;
///////////////////////////////////////////////////////////////////////
?>














                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                                   
                                                            <th>Account</th>
                                                            <th>Debit</th>   
                                                            <th>Credit</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Currrent Assets</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>

                                                            <td><h6 class="m-b-0 m-t-10">Cash at bank</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($bank_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Accounts Receivable</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($acc_rec_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Cash in hand</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($cash_in_hand_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Inventory On Hand</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($stock_in_hand_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Cost of Good Sold</h6></td>
                                                            
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($total_cogs);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                     
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Building and Land</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($land_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Equipments</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($equip_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo 0.00;?></h7></td>
                                                        </tr> 
                                                    
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Account payable </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo 0.00;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo abs($payable_total);?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Accrued Expense </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo 0.00;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo abs($expense_total);?></h7></td>
                                                        </tr>
                                                  
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Employee's Salaries </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($salary_total);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo 0.00;?></h7></td>
                                                        </tr>
                                                    
                                                      
                                                        <?php

                                                            $bsql=mysqli_query($conn,"SELECT * FROM `tbl_account` where LEFT(acode,6) between '40020000' and '500000000' and created_date between '$f_date' and '$t_date' ");
                                                            while($value = mysqli_fetch_assoc($bsql))   
                                                        {
                                                            $aname=$value['aname'];
                                                            $acode=$value['acode'];


$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where acode='$acode' and opening_date between '$f_date' and '$t_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_shareholder += $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as shareholder FROM tbl_trans_detail where acode='$acode' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
$data1=mysqli_fetch_assoc($sql1);
$shareholder += $data1['shareholder'];
}
$shareholder_total=($opening_bal_shareholder+$shareholder+$owner_total-$owner_draws_total);
$total_d_Amount=$salary_total+$equip_total+$land_total+$total_cogs+$stock_in_hand_total+$cash_in_hand_total+$bank_total;
$total_c_Amount=abs($payable_total)+$expense_total+$shareholder_total;
                                                            ?>
                                                         <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Common Stock</b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo 0.00;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($shareholder_total);?></h7></td>
                                                        </tr>
                                                        <?php 

                                                        
                                                        ?>
                                                         <tr>
                                                            <td><h4 class="m-b-0 m-t-10"><b>Totals</b> </h4></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($total_d_Amount);?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($total_c_Amount);?></h7></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                   <!--  <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">
                                  
                                                                                   
                                            <h3 class="m-b-0 m-t-10">AMT ( <?php $net_amount=$total_damount-$total_camount; echo $net_amount; ?> )</h3>
                                        </div>                                    
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                            
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

</div>
</div>

    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>

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
          extend: 'pdfHtml5',
          text: '<?php echo $c_name;?>',
           
           title: '<?php echo $c_name;?> (Balance Sheet)',
           
          
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          
          className: 'btn btn-danger',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      }
        
        },
        {
          extend: 'print',
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: '<?php echo $c_name;?> (Balance Sheet)',

          
        },


      ]


    });
} );
</script>


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
