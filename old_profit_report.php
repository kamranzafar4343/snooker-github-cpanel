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
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Profit/Loss Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Profit/Loss Report</li>
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
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
}
else
{
    $branch='All';
    $f_date = date('Y-m-d');  
    $t_date = date('Y-m-d');
    $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));

}
  if($branch=='')

{
    $branch_name='All';

}
else
{
    $sql="SELECT user_name FROM users where user_id='$branch'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_name = $data['user_name'];
                          
                         }

}
   ?>

<body>
  <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
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
                                    <h3  class="text-center">Profit/Loss Report</h3>

                                  
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
                         <form  action="profit_report.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                             <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-4 col-sm-12">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                             
                               <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="purchase_rep" onclick="check()" target='_blank'>Search</button>
                                 </div>
                              
                                </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        


                               <div class="row">
                            <div class="clearfix text-right col-md-6" >

                            <span ><h3><?php echo $branch_name;?></h3>
                       </span></div>     
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $f_date.'/'.$t_date;?>
                       </span></div> </div> 
                            <hr>  

<?php

if($branch=='')
{

    $where_branch='';
    $stock="Left(acode, 6)='200200'";
}
else
{

    $where_branch='and parent_id="'.$branch.'"';
    if($branch=='1')
    {
        $stock="Left(acode, 9) = '100300000'";
    }
    else
    {
        $stock="Left(acode, 9) = '100900000'";
    }
}
///////////////////////// cash sales ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 9)='300100100' and opening_date < '$f_date'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_cash_sale = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(amount_recieved) as net_amount FROM tbl_sale where  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data1=mysqli_fetch_assoc($sql1);
$cash_sale = $data1['net_amount'];

$cash_sale_total=$opening_bal_cash_sale+$cash_sale;
///////////////////////////////////////////////////////////////////////////
///////////////////////// Other sales ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='300200' and opening_date < '$f_date'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_other_sale = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(d_amount) as net_amount FROM tbl_trans_detail where Left(acode, 6)='300200' and DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data1=mysqli_fetch_assoc($sql1);
$other_sale = $data1['net_amount'];

$other_sale_total=$opening_bal_other_sale+$other_sale;
///////////////////////////////////////////////////////////////////////////

///////////////////////// lease sales ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where acode='300100300' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_lease_sale = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(total_price) as lease_sale FROM tbl_installment where  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data1=mysqli_fetch_assoc($sql1);
$lease_sale = $data1['lease_sale'];

$lease_sale_total=$opening_bal_lease_sale+$lease_sale;
///////////////////////////////////////////////////////////////////////////



///////////////////////// sales return ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(amount_returned) as sale_return FROM tbl_sale_return where  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data=mysqli_fetch_assoc($sql);
$sale_return = $data['sale_return'];

///////////////////////////////////////////////////////////////////////////

//////////////////////////////// total sale //////////////////////////
$sales=($cash_sale_total+$lease_sale_total+$other_sale_total)-$sale_return;
///////////////////////////////////////////////////////////////////////


///////////////////////// Purchase ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where $stock and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_stock = $data['opening_bal'];

$sql1=mysqli_query($conn, "SELECT SUM(net_amount) as net_amount FROM tbl_purchase where bill_status='Completed'  and  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data1=mysqli_fetch_assoc($sql1);
$stock_in_hand = $data1['net_amount'];

$sql1=mysqli_query($conn, "SELECT SUM(net_amount) as net_amount FROM tbl_single_purchase where bill_status='Completed' and payment_status='Completed' and  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data1=mysqli_fetch_assoc($sql1);
$stock_in_hand_local = $data1['net_amount'];


if($branch=='')
    {
        $sql1=mysqli_query($conn, "SELECT SUM(net_amount) as net_amount FROM tbl_purchase_req where stock_status='Completed' and stock_receive_status='Completed' and  DATE(created_date) between '$f_date' and '$t_date'");
        $data1=mysqli_fetch_assoc($sql1);
        $stock_req = $data1['net_amount'];
      
    }
else if($branch=='1')
    {
        $sql1=mysqli_query($conn, "SELECT SUM(net_amount) as net_amount FROM tbl_purchase_req where stock_status='Completed' and stock_receive_status='Completed' and  DATE(created_date) between '$f_date' and '$t_date'");
        $data1=mysqli_fetch_assoc($sql1);
        $stock_req = $data1['net_amount'];

        
    }
    else
    {
        $sql1=mysqli_query($conn, "SELECT SUM(net_amount) as net_amount FROM tbl_purchase_req where stock_status='Completed' and stock_receive_status='Completed' and  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
        $data1=mysqli_fetch_assoc($sql1);
        $stock_req = $data1['net_amount'];
       
    }

$stock_in_hand_total=$opening_bal_stock+$stock_in_hand+$stock_in_hand_local;


///////////////////////////////////////////////////////////////////////////


///////////////////////// purchase return ///////////////////////////////////////

$sql=mysqli_query($conn, "SELECT SUM(amount_received) as purchase_return FROM tbl_purchase_return where  DATE(created_date) between '$f_date' and '$t_date' $where_branch");
$data=mysqli_fetch_assoc($sql);
$purchase_return = $data['purchase_return'];

///////////////////////////////////////////////////////////////////////////

//////////////////////////////// total purchase //////////////////////////
if($branch=='')
    {
        $purchase=$stock_in_hand_total-$purchase_return;
      
    }
else if($branch=='1')
    {
        $purchase=$stock_in_hand_total-$purchase_return-$stock_req;

        
    }
    else
    {
        $purchase=$stock_in_hand_total-$purchase_return+$stock_req;
       
    }

///////////////////////////////////////////////////////////////////////


?>














                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                                   
                                                            <th class="text-left">Account</th>
                                                            <th class="text-left">Amount</th>   
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Sales</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>

                                                            <td><h6 class="m-b-0 m-t-10">Cash Sale</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($cash_sale_total);?></h7></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Sale Return</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($sale_return);?></h7></td>
                                                        </tr>
                                                      
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Sale </b></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($sales);?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Inventory(Purchase)</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Purchase</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($stock_in_hand_total);?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Purchase Return</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($purchase_return);?></h7></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Purchase</b></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($purchase);?></h7></td>
                                                        </tr>
                                                        
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Expenses</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                    
                                                         <?php

                                                            $bsql=mysqli_query($conn,"SELECT * FROM `tbl_account_lv2` where LEFT(acode,6) in('500200') and created_date between '$f_date' and '$t_date' ");
                                                            while($value = mysqli_fetch_assoc($bsql))   
                                                        {
                                                            $aname=$value['aname'];
                                                            $acode=$value['acode'];


$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where acode='$acode' and opening_date < '$f_date' and created_by='$userid'");
$data=mysqli_fetch_assoc($sql);
$opening_bal_other_expense = $data['opening_bal'];


$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as other_expense FROM tbl_trans_detail where acode='$acode' and created_date between '$f_date' and '$t_date' $where_branch");
$data1=mysqli_fetch_assoc($sql1);
$other_expense = $data1['other_expense'];

$other_expenser_total=($opening_bal_other_expense+$other_expense);
                                                            ?>
                                                         <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><?php echo $aname;?></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php $expense+=$other_expenser_total; echo round($other_expenser_total);?></h7></td>
                                                        </tr>
                                                        <?php }
                                                        ?>
                                                        
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Expenses</b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($expense);?></h7></td>
                                                        </tr>
                                                        
                                                         <tr>
                                                            <td><h4 class="m-b-0 m-t-10"><b>Gross Profit/Loss</b> </h4></td>
                                                            <td><h4 class="m-b-0 m-t-6"><?php $profit=$sales-($expense+$purchase); echo round($profit);?></h4></td>
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
    $(".select_group").select2();
          $('#example').DataTable({
      dom: 'Bt',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: true,
      buttons: [
        {
          extend: 'pdfHtml5',
          text: '<?php echo $c_name;?>',
           title: '<?php echo $c_name;?> (Profit/Loss Report)',
           
          
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

          
          title: '<?php echo $c_name;?> (Profit/Loss Report)',

          
        },


      ]


    });

} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
