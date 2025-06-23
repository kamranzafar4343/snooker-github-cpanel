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

if($_GET){


  $item_id=mysqli_real_escape_string($conn,$_GET['item_id']);
  $return_item_id=mysqli_real_escape_string($conn,$_GET['return_item_id']);
  $loc_item_id=mysqli_real_escape_string($conn,$_GET['loc_item_id']);
  $sale_item_id=mysqli_real_escape_string($conn,$_GET['sale_item_id']);
  $sale_rtn_item_id=mysqli_real_escape_string($conn,$_GET['sale_rtn_item_id']);
  $lease_item_id=mysqli_real_escape_string($conn,$_GET['lease_item_id']);
  $req_item_id=mysqli_real_escape_string($conn,$_GET['req_item_id']);
  if($item_id)
  {
     $items=$item_id;
     $table='tbl_purchase_detail';
    
  }
  if($return_item_id)
  {
      $items=$return_item_id;
      $table='tbl_purchase_return_detail';
 
  }
  if($loc_item_id)
  {
      $items=$loc_item_id;
      $table='tbl_single_purchase_detail';
 
  }
  if($sale_item_id)
  {
      $items=$sale_item_id;
      $table='tbl_sale_detail';

  }

  if($sale_rtn_item_id)
  {
      $items=$sale_rtn_item_id;
      $table='tbl_sale_return_detail';
    
  }
  if($lease_item_id)
  {
      $items=$lease_item_id;
      $table='tbl_installment';
      
  }
  if($req_item_id)
  {
      $items=$req_item_id;
      $table='tbl_purchase_req_detail';

  }
  }

   




   ?>
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
<html lang="en" >
<link rel="icon" href="<?php echo $image;?>" type="image/x-icon">
<title><?php echo $c_name;?></title>
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
                                    <h3>Detail Report</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>
                       
              
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th>                                      
                                                            <!-- <th>P_ID</th>                                       -->
                                                            <th>Customer/Vendor Name</th>                                      
                                                      
                                                            <th>Item </th>
                                                            <th>Barcode </th>
                                                            
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th>Quantity</th>
                                                            <?php if($lease_item_id){?>
                                                            <th>Period</th>
                                                            <?php }?>
                                                            <th class="hidden-sm-down">Unit Cost</th>
                                                            <th>Total</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php
if($return_item_id)
{

   $bsql=mysqli_query($conn,"SELECT tbl_purchase_return_detail.*,tbl_purchase_return.*,tbl_items.* From tbl_purchase_return_detail inner join tbl_purchase_return on tbl_purchase_return_detail.purchase_return_id=tbl_purchase_return.purchase_return_id inner join tbl_items on tbl_purchase_return_detail.product=tbl_items.item_id where  tbl_purchase_return_detail.product='$items'  order by tbl_purchase_return_detail .created_date asc");
}
else if($item_id)
{
  $bsql=mysqli_query($conn,"SELECT tbl_purchase_detail.*,tbl_purchase.*,tbl_items.* From tbl_purchase_detail inner join tbl_purchase on tbl_purchase_detail.purchase_id=tbl_purchase.purchase_id inner join tbl_items on tbl_purchase_detail.product=tbl_items.item_id where tbl_purchase_detail.product='$items'   order by tbl_purchase.created_date asc");
}
else if($loc_item_id)
{
  $bsql=mysqli_query($conn,"SELECT tbl_single_purchase_detail.*,tbl_single_purchase.*,tbl_items.* From tbl_single_purchase_detail inner join tbl_single_purchase on tbl_single_purchase_detail.purchase_id=tbl_single_purchase.purchase_id inner join tbl_items on tbl_single_purchase_detail.product=tbl_items.item_id where tbl_single_purchase_detail.product='$items'   order by tbl_single_purchase.created_date asc");
}
else if($sale_item_id)
{
  $bsql=mysqli_query($conn,"SELECT tbl_sale_detail.*,tbl_sale.*,tbl_items.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id inner join tbl_items on tbl_sale_detail.product=tbl_items.item_id where tbl_sale_detail.product='$items'   order by tbl_sale.created_date asc");
}
else if($sale_rtn_item_id)
{
    $bsql=mysqli_query($conn,"SELECT tbl_sale_return_detail.*,tbl_sale_return.*,tbl_items.* From tbl_sale_return_detail inner join tbl_sale_return on tbl_sale_return_detail.sale_return_id=tbl_sale_return.sale_return_id inner join tbl_items on tbl_sale_return_detail.product=tbl_items.item_id where tbl_sale_return_detail.product='$items'   order by tbl_sale_return.created_date asc");
}
else if($lease_item_id)
{

  $bsql=mysqli_query($conn,"SELECT tbl_installment.*, tbl_items.* From tbl_installment inner join tbl_items on tbl_installment.item_id=tbl_items.item_id where tbl_installment.item_id='$items'   order by tbl_installment.created_date asc");
}

$count=mysqli_num_rows($bsql);
// print_r($count);

if($count=='')
{
  // print_r('as');
  header('Location: inventory.php?data=notfound');

}
else{
      $count=0;

                                  // print_r(mysqli_fetch_array($bsql));
while($value = mysqli_fetch_assoc($bsql))   
                                {   

                                    $product=$value['product'];
                                    $barcode=$value['barcode'];
                                    $brand_id=$value['brand_id'];
                                    $bsql2=mysqli_query($conn,"SELECT cat_name From tbl_catagory where id='$brand_id'");
                                 
                                    $value1 = mysqli_fetch_assoc($bsql2);
                                    $brand_name=$value1['cat_name'];
                                    
                                    $period=$value1['period'];
                                    $cat_name=$value['item_name']; 
                                    $purchase_id=$value['purchase_id']; 
                                    $vendor_id=$value['vendor_id'];
                                    $item_serial=$value['item_serial'];
                                    $customer_id=$value['customer_name']; 
                                    if($customer_id==''){
                                    $customer_id=$value['customer'];
                                    } 
                                    
                                    
                                    // echo "$cat_name $product<br>";
                                    $rate=$value['rate'];
                                    if($rate=='')
                                    {
                                      $rate=$value['total_price'];
                                    }
                                    $qty=$value['qty'];
                                    $amount=$value['amount'];
                                    if($qty=='' && $lease_item_id)
                                    {
                                        $qty=1;
                                        $amount=$rate;
                                    }
                                    
                                    $net_amount=$value['net_amount'];
                           
                                    $gross_amount=$value['gross_amount'];
                                    $date=$value['created_date'];
if($sale_item_id || $sale_rtn_item_id || $lease_item_id)
{
  $sql=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where acode='$customer_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['aname'];
}
else
{
  $sql=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id='$vendor_id'");
                        $data=mysqli_fetch_assoc($sql);
                        $vendorname = $data['username'];
}
  
                        // echo $vendorname;exit();

  $sql2=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$items");
                        $data1=mysqli_fetch_assoc($sql2);
                        $itemname = $data1['item_name'];
 $count++;
  ?>
                                                        <tr>
                            <!-- <td><?php echo $count;?></td> -->
                            <td><?php echo $count;?></td>
                            <td><?php echo $vendorname;?></td>
                            <td><?php echo $brand_name." ".$itemname;?></td>
                            <td><?php echo $barcode;?></td>
                            <td><?php echo $qty;?></td>
                            <?php if($lease_item_id){?>
                             <td><?php echo $period;?></td>
                            <?php }?>
                            <td><?php echo $rate;?></td>
                            <td><?php echo $amount;  $total_amount+=$amount;?></td>
                            
                                                        </tr>
                                                       
                                                      <?php }}?>
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
                                            <p class="m-b-0"><b>Sub-total:</b> <?php echo $total_amount; ?></p>
                                           
                                                                                   
                                            <h3 class="m-b-0 m-t-10">NET AMT - <?php $net_amount=$total_amount-$discount; echo $net_amount; ?></h3>
                                        </div>                                    
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                            <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>
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
      "ordering": false,
      "info":     false,
      searching: false,
      buttons: [
        {
          extend: 'pdfHtml5',
          text: 'Alkareem',
           title: 'Alkareem (PO Report)',
           
          
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

          
          title: 'Alkareem (PO Report)',

          
        },


      ]


    });
} );
</script>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('search_purchase.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('search_purchase.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
