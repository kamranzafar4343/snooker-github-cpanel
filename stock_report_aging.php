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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Report With Aging</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Stock Report With Aging</li>
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
                                    <h3  class="text-center">Stock Report With Aging</h3>

                                  
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
                         <form  action="stock_report_aging.php" method="post" enctype="multipart/form-data" id='form1'>
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
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        


                               <div class="row">
                            <div class="clearfix text-right col-md-6" >

                            
                       </span></div>     
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                    <table id="example" class="display" style="width:100%">
                                           
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>PR TYPE</th>                            
                                            <th>PR IN</th>
                                        
                                            <th>Product Serial/IEMI</th>
                                            <th>Purchase Date</th>
                                            <th>Transfer Date</th>
                                            <th>Days</th> 
                                            <th>Stock Status</th>                                                                  
                                            <th>Branch</th>                                      
                                        </tr>
                                    </thead>
                                    
                                    <tbody id="stock">
                                      <?php
                                     

                                       
                                        $sqluser="SELECT branch_id,created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sqluser);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                               }
                                            if($branch_id!='')
                                            {
                                              $where_branch='and tbl_purchase_req_detail.parent_id="'.$userid.'"';
                                            
                                            }
                                            else if($userid='1')
                                            {
                                              $where_branch='';
                                              ;
                                            }
                                      $sql=mysqli_query($conn,"SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id WHERE tbl_purchase_req_detail.recieved='1' and Date(tbl_purchase_req_detail.created_date) BETWEEN '$f_date' and '$t_date' $where_branch");
                                        while($row = mysqli_fetch_assoc($sql))
                                        {
                                        $parent_id=$row['parent_id'];
                                        $id = $row['item_id'];
                                        $brand_id = $row['brand_id'];
                                        $category = $row['category'];
                                        $purchase_req_id = $row['purchase_req_id'];
                                        $item_serial = $row['item_serial'];
                                        $pur_item_id = $row['pur_item_id'];
                                        $barcode = $row['barcode'];
                                        $cash_price_sql=mysqli_query($conn,"SELECT amount from tbl_sale_detail where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
                                            $cash_price_sql_val = mysqli_fetch_assoc($cash_price_sql);
                                            $amount=$cash_price_sql_val['amount'];
                                            if($amount=='')
                                            {
                                                $inst_price_sql=mysqli_query($conn,"SELECT total_price from tbl_installment where parent_id='$parent_id' and (item_serial='$item_serial' OR barcode='$barcode' OR pur_item_id='$pur_item_id')");
                                                $inst_price_sql_val = mysqli_fetch_assoc($inst_price_sql);
                                                $amount=$inst_price_sql_val['total_price'];
                                            }
                                            if($amount=='')
                                            {
                                                $amount=0;
                                            }

                                          if($amount=='0')
                                          {

                                            $stock='<span class="badge badge-success">In Stock</span>';
                                          }
                                          else
                                          {

                                            $stock='<span class="badge badge-danger">Sold</span>';
                                          
                                          }
                                        if($barcode=='')
                                            {
                                                $barcode='';
                                               
                                            }
                                            if($pur_item_id=='')
                                            {
                                                $pur_item_id='';
                                                
                                            }
                                            if($item_serial=='')
                                            {
                                                $item_serial='';
                                               
                                            }
            
                                        $sql1=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                        $value2 = mysqli_fetch_assoc($sql1);
                                        $brand_name=$value2['cat_name'];

                                        $sql2=mysqli_query($conn,"SELECT cat_name from tbl_cat where id='$category'");
                                        $value2 = mysqli_fetch_assoc($sql2);
                                        $catagory_name=$value2['cat_name'];

                                        $item_name = $brand_name. " " .$row['item_name'];

                                        $sql3=mysqli_query($conn,"SELECT user_name from users where user_id='$parent_id'");
                                        $value3 = mysqli_fetch_assoc($sql3);
                                        $user_name=$value3['user_name'];

                                        $sql4=mysqli_query($conn,"SELECT transfer_type, stock_tranfer_date from tbl_purchase_req where purchase_req_id='$purchase_req_id'");
                                        $value4 = mysqli_fetch_assoc($sql4);
                                        $transfer_type=$value4['transfer_type'];
                                        $req_created_date = $value4['stock_tranfer_date'];
                                        $time1 = new DateTime($req_created_date);
                                        $req_date = $time1->format('Y-m-d');
                                        $newDate = date("d-m-Y", strtotime($req_date));

                                        $sqlpr=mysqli_query($conn,"SELECT created_date from tbl_purchase_detail where product='$id' AND transfer='1' AND (pur_item_id='$pur_item_id' OR item_serial='$item_serial')");
                                        $valuesqlpr = mysqli_fetch_assoc($sqlpr);
                                        $pur_created_date=$valuesqlpr['created_date'];
                                        $newDate3 = date("d-m-Y", strtotime($pur_created_date));
                                        $time = new DateTime($pur_created_date);

                                        $pur_date = $time->format('Y-m-d');
                                         $date1 = date_create($pur_date);
                                        $date2 = date_create($req_date);
                                        $diff1 = date_diff($date1,$date2);
                                        $daysdiff = $diff1->format("%R%a");
                                        $daysdiff = abs($daysdiff);
                                        $dateDifference = date_diff($date1, $date2)->format('%y years, %m months and %d days');

                                        
                                        if($transfer_type=='1')
                                            {
                                                $pr_type='<span class="badge badge-info"><b>Direct Transfer</b></span>';  
                                            }
                                        else
                                        {
                                            $pr_type='<span class="badge badge-info"><b>Req Transfer</b></span>';
                                        }

                                      ?>  
                                                        <tr>
                                                            <td><?php echo $item_name;?></td>
                                                            <td><?php echo $pr_type;?></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $purchase_req_id;?></h7></td>
                                                          
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $item_serial." ".$pur_item_id." ".$barcode;?></h7></td>
                                                          
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $newDate3;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $newDate;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $daysdiff;;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $stock;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $user_name;?></h7></td>
                                                            
                                                        </tr>
                                                    <?php }?>
                                    </tbody>
                                </table>
                                            </div>
                                        </div>
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

          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
    
      "info":     false,
      searching: true,
      buttons: [
        
          {
          extend: 'pdf',
          text: 'PDF',
          title: '<?php echo $c_name;?> (Stock Report Aging Wise)',
          orientation: 'landscape',
          text:'<span class="text-default"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
          className: 'btn btn-sm btn-outline-dark',
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
          className: 'btn btn-sm btn-outline-dark',
          titleAttr: 'print',
          text:'<span class="text-default"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: '<?php echo $c_name;?> (Stock Report Aging Wise)',

          
        },


      ],
"order": [[ 2, "desc" ]]

    });
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
