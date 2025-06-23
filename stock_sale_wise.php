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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Sale Wise Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Stock Sale Wise Report</li>
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
                                    <h3  class="text-center">Stock Sale Wise Report</h3>

                                  
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
                         <form  action="stock_sale_wise.php" method="post" enctype="multipart/form-data" id='form1'>
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
                                            <th>Sale TYPE</th>

                                            <th>PR IN</th>
                                            <th>Catagory</th>                                       
                                            <th>Company</th>
                                            <th>Product Serial / IEMI</th>
                                            <th>Purchase Pr</th>   
                                            <th>Sale Pr</th>
                                            <th>Sale ID</th>                                                                
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
                                              $where_branch='and tbl_installment.parent_id="'.$userid.'"';
                                              $where_branch1='and tbl_sale_detail.parent_id="'.$userid.'"';
                                            }
                                            else if($userid='1')
                                            {
                                              $where_branch='';
                                              $where_branch1='';
                                            }
                                         $pur_total=0;
                                        $sale_total=0;
                                        $pur_total1=0;
                                        $sale_total1=0;
                                      $sql=mysqli_query($conn,"SELECT * FROM tbl_installment INNER JOIN tbl_items ON tbl_installment.item_id = tbl_items.item_id WHERE  Date(tbl_installment.created_date) BETWEEN '$f_date' and '$t_date' $where_branch");
                                        while($row = mysqli_fetch_assoc($sql))
                                        {
                                        $parent_id=$row['parent_id'];
                                        $id = $row['item_id'];
                                        $brand_id = $row['brand_id'];
                                        $category = $row['category'];
                                        $local = $row['local'];
                                        $item_serial = $row['item_serial'];
                                        $pur_item_id = $row['pur_item_id'];
                                        $barcode = $row['barcode'];
                                        $item_serial1 = $row['item_serial'];
                                        $pur_item_id1 = $row['pur_item_id'];
                                        $barcode1 = $row['barcode'];
                                        $total_price = $row['total_price'];
                                        $plan_id = $row['plan_id'];
                                        if($barcode=='')
                                        {
                                            $barcode=0;
                                            $barcode1='';
                                        }
                                        if($pur_item_id=='')
                                        {
                                            $pur_item_id=0;
                                            $pur_item_id1='';
                                        }
                                        if($item_serial=='')
                                        {
                                            $item_serial=0;
                                            $item_serial1='';
                                        }
                                       
                                        $sqlpr=mysqli_query($conn,"SELECT purchase_req_id, rate from tbl_purchase_req_detail where product='$id' AND recieved='1' AND (pur_item_id='$pur_item_id' OR item_serial='$item_serial')");
                                        $valuesqlpr = mysqli_fetch_assoc($sqlpr);
                                        $purchase_req_id=$valuesqlpr['purchase_req_id'];
                                        $purchase_req_rate=$valuesqlpr['rate'];
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

                                        $sql4=mysqli_query($conn,"SELECT transfer_type from tbl_purchase_req where purchase_req_id='$purchase_req_id'");
                                        $value4 = mysqli_fetch_assoc($sql4);
                                        $transfer_type=$value4['transfer_type'];
                                 
                                        if($local=='1')
                                            {
                                                $sale_type='<span class="badge badge-info"><b>Installment Local</b></span>';  
                                            }
                                        else
                                        {
                                            $sale_type='<span class="badge badge-info"><b>Installment</b></span>';
                                        }
                                       
                                      ?>  
                                                        <tr>
                                                            <td><?php echo $item_name;?></td>
                                                            <td><?php echo $sale_type;?></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $purchase_req_id;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $catagory_name;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $brand_name;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $item_serial1." ".$pur_item_id1." ".$barcode1;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($purchase_req_rate); $pur_total+=$purchase_req_rate;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($total_price); $sale_total+=$total_price;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo "Installment_".$plan_id;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $user_name;?></h7></td>
                                                            
                                                        </tr>
                                                    <?php }?>
                                        <?php

                                      $sql=mysqli_query($conn,"SELECT * FROM tbl_sale_detail INNER JOIN tbl_items ON tbl_sale_detail.product = tbl_items.item_id WHERE  Date(tbl_sale_detail.created_date) BETWEEN '$f_date' and '$t_date' $where_branch1");
                                        while($row = mysqli_fetch_assoc($sql))
                                        {
                                        $parent_id=$row['parent_id'];
                                        $id = $row['item_id'];
                                        $brand_id = $row['brand_id'];
                                        $category = $row['category'];
                                        $local = $row['local'];
                                        $invoice_no = $row['invoice_no'];
                                        $sale_rate = $row['rate'];
                                        $item_serial = $row['item_serial'];
                                        $pur_item_id = $row['pur_item_id'];
                                        $barcode = $row['barcode'];
                                        $item_serial1 = $row['item_serial'];
                                        $pur_item_id1 = $row['pur_item_id'];
                                        $barcode1 = $row['barcode'];
                                        if($barcode=='')
                                        {
                                            $barcode=0;
                                            $barcode1='';
                                        }
                                        if($pur_item_id=='')
                                        {
                                            $pur_item_id=0;
                                            $pur_item_id1='';
                                        }
                                        if($item_serial=='')
                                        {
                                            $item_serial=0;
                                            $item_serial1='';
                                        }
                                        
                                        $sqlpr=mysqli_query($conn,"SELECT purchase_req_id, rate from tbl_purchase_req_detail where product='$id' AND recieved='1' AND (pur_item_id='$pur_item_id' OR item_serial='$item_serial')");
                                        $valuesqlpr = mysqli_fetch_assoc($sqlpr);
                                        $purchase_req_id=$valuesqlpr['purchase_req_id'];
                                        $purchase_req_rate=$valuesqlpr['rate'];

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

                                        $sql4=mysqli_query($conn,"SELECT transfer_type from tbl_purchase_req where purchase_req_id='$purchase_req_id'");
                                        $value4 = mysqli_fetch_assoc($sql4);
                                        $transfer_type=$value4['transfer_type'];
                                 
                                        if($local=='1')
                                            {
                                                $sale_type='<span class="badge badge-danger"><b>Cash Sale Local</b></span>';  
                                            }
                                        else
                                        {
                                            $sale_type='<span class="badge badge-danger"><b>Cash Sale</b></span>';
                                        }  
                                        
                                       
                                      ?>  
                                                       <tr>
                                                            <td><?php echo $item_name;?></td>
                                                            <td><?php echo $sale_type;?></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $purchase_req_id;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $catagory_name;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $brand_name;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $item_serial1." ".$pur_item_id1." ".$barcode1;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($purchase_req_rate); $pur_total1+=$purchase_req_rate;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($sale_rate); $sale_total1+=$sale_rate;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $invoice_no;?></h7></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo $user_name;?></h7></td>
                                                            
                                                        </tr>
                                                    <?php }?>
                                                    <tr>
                                                            <td><h5 class="m-b-0 m-t-6">Total</h5></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><h5 class="m-b-0 m-t-6"><?php echo number_format($pur_total+$pur_total1);?></h5></td>
                                                            <td><h5 class="m-b-0 m-t-6"><?php echo number_format($sale_total+$sale_total1);?></h5></td>
                                                            
                                                            <td></td>
                                                            <td></td>
                                                            
                                                        </tr>
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
          title: '<?php echo $c_name;?> (Stock Sale Wise)',
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

          
          title: '<?php echo $c_name;?> (Stock Sale Wise)',

          
        },


      ],
    "order": [[ 2, "desc" ]]

    });
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
