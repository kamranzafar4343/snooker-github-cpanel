<!doctype html>
<html lang="en">


<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";


session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>
<body class="theme-orange">

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Local Purchase</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Purchase</li>
                            <li class="breadcrumb-item active">Add Local Purchase</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <?php
              

              if(isset($_GET['add']) && $_GET['add']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great!</strong> Vendor Added Succesfully.
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
    <?php }?>
<?php
             $page_name=basename($_SERVER['HTTP_REFERER']);
            $base_page_name=explode('.', $page_name);
            $page=$base_page_name[0];
            $sql1=mysqli_query($conn,"SELECT parent_id  FROM tbl_menu where page_link='$page'");
                $data = mysqli_fetch_assoc($sql1);
                $page_id=$data['parent_id']; 

                 $query=mysqli_query($conn,"SELECT P, U, D, W  FROM tbl_permission where parent_page_id='$page_id' and user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $P=$data['P']; 
              if(isset($_GET['edit_id']))
              {

                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_single_purchase where purchase_id=$edit_id");

                $data=mysqli_fetch_assoc($sql);
                        
                        $vendor = $data['vendor_id'];
                        $net_amount = $data['net_amount'];
                        $gross_amount = $data['gross_amount'];
                        $discount = $data['discount'];
                        
                        $invoice_no = $data['invoice_no'];
                        $invoice_date = $data['invoice_date'];
                        $po_remarks = $data['po_remarks'];

              }

              $purchase_id='';
    
  $query = "SELECT purchase_id FROM `tbl_single_purchase` order by purchase_id DESC LIMIT 1";
  $result = mysqli_query($conn,$query);
  while($row = mysqli_fetch_array($result) ){
          $purchase = $row['purchase_id'];
      ++$purchase;

          }
  if(mysqli_num_rows($result)>0)
  {
      $purchase_id=$purchase;    
  }
  else
  {  
    $purchase_id='1';
  }

              ?>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <div class="alert alert-danger" id="barcode-alert" style="display: none;">
  
              <strong>Ooops!</strong> Barcode Already Exist.
            </div>
            <div class="alert alert-danger" id="product-alert" style="display: none;">
  
              <strong>Ooops!</strong> Product Serial Already Exist.
            </div>
                   <form action="operations/add_single_purchase.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                             <div class="row clearfix"> 
                              <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Receiving Location*</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   <input type="hidden" name="iemi" value="1">
                                    <div class="form-group">        
                                        <select class="form-control location"  name="location">
                            
                                          <?php
                                           $sql="SELECT branch_id,created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                               }
                                            if($branch_id=='')
                                            {
                                              $sql="SELECT * FROM users where user_id='$created_by'"; 
                                            }
                                            else
                                            {
                                              $sql="SELECT * FROM users where user_id='$userid'";
                                            }
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$vendor)
                                            {
                                            echo "<option value=$row[user_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[user_id]>$row[user_name] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                </div>
                              </div>
                                </div>  
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                      <a href="add_vendors.php?add_type=4">
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   
                                     
                                       <label>Vendors *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control vendor"  name="vendor">
                                        <option selected="selected" value="">Choose one</option>
                                           <?php
                                         
                                               $sql="SELECT * FROM tbl_vendors where created_by='$userid'"; 
                                           
                                           
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['vendor_id']==$vendor)
                                            {
                                            echo "<option value=$row[vendor_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[vendor_id]>$row[username] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                      
                                </div>
                              </div>
                                </div>  
                                 <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Invoice No *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="invoice_no" required=""   class="form-control" placeholder="Invoice No" value="<?php if($invoice_no){echo $invoice_no;}else{?>Loca PO <?php echo $purchase_id;} ?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Invoice Date *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <?php if($userid=='1'){?> 
                                     <input type="date" name="invoice_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php if($invoice_date){echo $invoice_date;}else{?><?php echo $date;} ?>" >
                                    <?php }
                                    else if($P=='1' && $userid!='1'){?>      
                                        <input type="date" name="invoice_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php if($invoice_date){echo $invoice_date;}else{?><?php echo $date;} ?>" >
                                    <?php }else {?>
                                        <input type="date" name="invoice_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php if($invoice_date){echo $invoice_date;}else{?><?php echo $date;} ?>" min="<?php echo date('Y-m-d'); ?>">
                                    <?php }?>
                                </div>
                              </div>
                                </div> 

                                <div class="col-md-8 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Remarks *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea name="po_remarks"  class="form-control"  row="1"><?php echo $po_remarks; ?></textarea>.
                                </div>
                              </div>
                                </div> 

                            </div><br>
                      

                            <div class="row clearfix">           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:40%">Product</th>
                      <th style="width:10%" hidden>Product Serial</th>
                      <th style="width:10%" hidden>Product Barcode</th>
                     
                      <th style="width:10%">Qty</th>
                      <th style="width:10%">Rate</th>
                      
                      <th style="width:20%">Amount</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                     <?php
              
          if($edit_id!='')
          {


                $lsql=mysqli_query($conn, "SELECT * FROM tbl_single_purchase_detail where purchase_id=$edit_id");
                $i=0;
                while($data=mysqli_fetch_assoc($lsql))
                {
                        $i++;
                        $qty = $data['qty'];
                        $rate = $data['rate'];
                        $amount = $data['amount'];
                        $product = $data['product'];
                        $qty_rec = $data['qty_rec'];
                        $barcode = $data['barcode'];
                        $item_serial = $data['item_serial'];
              

              
              ?>
                     <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group product" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)"><option value="">Choose Product</option>
                                        
                                                                <?php

                                        $sql="SELECT * FROM tbl_items WHERE category NOT IN (SELECT id FROM `tbl_cat` where cat_name Like '%Mobile%')"; 


foreach ($conn->query($sql) as $row){
$brand_id=$row['brand_id'];
$sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
if($row['item_id']==$product){

echo "<option value=$row[item_id] selected>$brand_name  $row[item_name]</option>"; 

}else{

echo "<option value=$row[item_id]>$brand_name $row[item_name]</option>"; 

}

}

 echo "</select>";
 ?>
</select>

                       
                        </td>
                         
                          <td hidden><input type="text" name="item_serial[]" id="item_serial_<?php echo $i;?>" class="form-control"  value="<?php echo $item_serial;?>"></td>
                       <td hidden>
                          <input type="text" name="barcode[]" id="barcode_<?php echo $i;?>" class="form-control"  autocomplete="off"    value="<?php echo $barcode;?>">

                          
                        </td>
                  
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>" class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $qty;?>"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>" class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $rate;?>">

                          
                        </td>
                       
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" class="form-control"  autocomplete="off" readonly="" value="<?php echo $amount;?>">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php } }else { $i=1;?>
                       <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group product" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)"><option value="">Choose Product</option>
                                      
                                                               <?php
                                                                    $sql="SELECT * FROM tbl_local_purchase WHERE iemi='1' and status='0'"; 
                                                                        foreach ($conn->query($sql) as $row){

                                                                        $item_id=$row['product'];
                                                                        $pur_req_id=$row['pur_req_id'];
                                                                         $sql3=mysqli_query($conn,"SELECT * from tbl_items where item_id='$item_id'");
                                                                            $value3 = mysqli_fetch_assoc($sql3);
                                                                            $item_name=$value3['item_name'];
                                                                            $brand_id=$value3['brand_id'];
                                                                        $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                                                            $value2 = mysqli_fetch_assoc($sql2);
                                                                            $brand_name=$value2['cat_name'];
                                                                        if($row['item_id']==$product){

                                                                        echo "<option value=$row[product],$row[pur_req_id]>$brand_name "."  $item_name </option>"; 

                                                                        }else{

                                                                        echo "<option value=$row[product],$row[pur_req_id]>$brand_name "."  $item_name</option>"; 

                                                                        }

                                                                        }
                                                                        
                                                                         echo "</select>";
                                                                    ?>
                                                                </select>

                       
                        </td>
                        
                        <td hidden=""><input type="text" name="item_serial[]" id="item_serial_<?php echo $i;?>"  class="form-control item_serial"   autocomplete="off" onchange="chkprodser(<?php echo $i;?>)"></td>
                        <td hidden>
                          <input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control barcode"    autocomplete="off" onchange="chkbar(<?php echo $i;?>)">
                          
                        </td>
                        <td><input type="text" tabindex="-1" name="qty[]" id="qty_<?php echo $i;?>"  class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" value="1">
                        <input type="hidden" tabindex="-1" name="qty_allowed[]" id="qty_allowed_<?php echo $i;?>"  class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" ><input type="hidden" tabindex="-1" name="pur_req_id[]" id="pur_req_id_<?php echo $i;?>"  class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" ></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>"  class="form-control calculate"  required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" >
                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" tabindex="-1" id="amount_<?php echo $i;?>" class="form-control"  autocomplete="off" readonly="" >
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php }?>
                   </tbody>
                </table>

                <div class="col-md-6 col-xs-12 pull pull-right">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" readonly="" autocomplete="off" value="<?php echo $gross_amount;?>">
                      
                    </div>
                  </div>
       
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off" value="<?php echo $discount;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" readonly=""  autocomplete="off" value="<?php echo $net_amount;?>">
                    </div>
                  </div>
               

                </div>
       
                 <div class="col-sm-12">
                                    <div class="mt-4">
    
                                        <button type="submit" class="btn btn-primary submit">Create</button>

                                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                                        <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>

                                    </div>
                                </div>


                           
                                                           </div>

                        </div>

                    </div>
                  </form>
                  <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
                          <div class="modal-dialog modal-lg" role="document">
                            <form  action="operations/profile_update.php" method="post" enctype="multipart/form-data">
                              <div class="modal-content">
                                  <div class="modal-header">
                                      <h4 class="title" id="largeModalLabel">Add Vendors</h4>
                                  </div>
                                  <div class="modal-body"> 
                                    <div class="row clearfix ">
                               
                                <div class="col-md-12 col-sm-12">
                                    <label>Vendors Name *</label>
                                    <div class="form-group">
                                        <input type="text" name="username" required=""  class="form-control" placeholder="Username *">
                                    
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label>Vendors Email *</label>
                                    <div class="form-group">
                                        <input type="text" name="email" required=""  class="form-control" placeholder="Email ID *">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label>Vendors Mobile *</label>
                                    <div class="form-group">
                                         <input type="text" name="mobile_no" required=""  class="form-control" placeholder="Mobile No">
                                        
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label>Vendors Address *</label>
                                    <div class="form-group">
                                        <input type="text" name="address" required="" class="form-control" placeholder="Address">
                           
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-12">
                                    <label>Vendors Profile *</label>
                                    <div class="form-group">
                                        
                                        <input type="file" class="form-control"   name="user_profile" >
                                    </div>
                                </div>

           
                       
                            </div>
                                  </div>
                                  <div class="modal-footer">
                                      <button type="submit" class="btn btn-primary" name="add_vendors">SAVE CHANGES</button>
                                      <button type="button" class="btn btn-danger" data-dismiss="modal">CLOSE</button>
                                  </div>
                              </div>
                                 </form>
                          </div>
                      </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Javascript -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script><!-- bootstrap datepicker Plugin Js --> 
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/dropify/js/dropify.min.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets/vendor/summernote/dist/summernote.js"></script>
<script src="assets_light/js/pages/forms/dropify.js"></script>

<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
<script>
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
</script> 

<script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>

<script type="text/javascript">


$(function() {
$(".submit").click(function() {

  var vendor=$('.vendor').val();
  if(vendor=='')
  {
    alert('Please Select Vendor..!');
    $('.vendor').select2('focus');
    $('.vendor').select2('open');
    return false;
  }
  var gross_amount=$('#gross_amount').val();
  if(gross_amount=='' || gross_amount=='0.00' || isNaN(gross_amount))
  {
    alert('Opps! Product or Qty Missing..!');
    
    $('.select_group').select2('focus');
    
return false;
    
  }
  var amount_payed=parseFloat($('#amount_payed').val());
var net_amount=parseFloat($('#net_amount').val());


if(amount_payed>net_amount)
{
  alert('Opps! Amount Recieved must not be greater than Total amount..!');
    $('#amount_payed').val('');
    $('#amount_payed').focus();

return false;
}

var errorCounterDupInput = 0;
    var product_ids = [];
    $(".item_serial").each(function (i, el1) {

        var current_val = $(el1).val();
        
        if (current_val != "") {
            if(product_ids.indexOf(current_val) === -1){
                product_ids.push(current_val);
            } else {
                errorCounterDupInput++;
            }
        }
    });

if(errorCounterDupInput==1)
{
  alert('Please Make Sure to Enter Unique item Serial');
   return false;
}


var errorCounterDupInput1 = 0;
    var product_bar = [];
    $(".barcode").each(function (i, el1) {

        var current_val1 = $(el1).val();
        
        if (current_val1 != "") {
            if(product_bar.indexOf(current_val1) === -1){
                product_bar.push(current_val1);
            } else {
                errorCounterDupInput1++;
            }
        }
    });

if(errorCounterDupInput1==1)
{
  alert('Please Make Sure to Enter Unique item Barcode');
   return false;
}
 
 });

});
</script> 
<script type="text/javascript">
  

  $(document).ready(function() {
    $(".vendor").select2();
    $(".select_group").select2();



    $("#add_row").unbind('click').bind('click', function() {
       
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required onchange="get_price('+row_id+')"><option value="">Choose Product</option><?php
                                                                    $sql="SELECT * FROM tbl_local_purchase WHERE iemi='1' and status='0'"; 
                                                                        foreach ($conn->query($sql) as $row){

                                                                        $item_id=$row['product'];
                                                                        $pur_req_id=$row['pur_req_id'];
                                                                         $sql3=mysqli_query($conn,"SELECT * from tbl_items where item_id='$item_id'");
                                                                            $value3 = mysqli_fetch_assoc($sql3);
                                                                            $item_name=$value3['item_name'];
                                                                            $brand_id=$value3['brand_id'];
                                                                        $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                                                            $value2 = mysqli_fetch_assoc($sql2);
                                                                            $brand_name=$value2['cat_name'];
                                                                        if($row['item_id']==$product){

                                                                        echo "<option value=$row[product],$row[pur_req_id]>$brand_name "."  $item_name </option>"; 

                                                                        }else{

                                                                        echo "<option value=$row[product],$row[pur_req_id]>$brand_name "."  $item_name</option>"; 

                                                                        }

                                                                        }
                                                                        
                                                                         echo "</select>";
                                                                    ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td hidden><input type="number" name="item_serial[]" id="item_serial_'+row_id+'" class="form-control item_serial" autocomplete="off" onchange="chkprodser('+row_id+')"></td>'+
                    '<td hidden><input type="number" name="barcode[]" id="barcode_'+row_id+'" class="form-control barcode" autocomplete="off" onchange="chkbar('+row_id+')"></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" value="1"><input type="hidden" name="qty_allowed[]" id="qty_allowed_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"><input type="hidden" name="pur_req_id[]" id="pur_req_id_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')" ></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'"  required class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" readonly></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    
                    var qty_allowed=$("#qty_allowed_"+count_table_tbody_tr).val();
                    if(qty_allowed=='')
                    {
                      alert("Opps  Product is missing..");
                      $("#qty_"+count_table_tbody_tr).focus();
                      return false;
                    }
                    var total=$("#amount_"+count_table_tbody_tr).val();
                    if(total=='' || total=='0.00' || isNaN(total))
                    {
                      alert("Opps  Qty or Price missing..");
                      $("#qty_"+count_table_tbody_tr).focus();
                      return false;
                    }
                    else{
                      $("#product_info_table tbody tr:last").after(html);  
                    }
                   
                
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".product").select2();

      

      return false;
    });

  }); // /document

  function getTotal(row = null) {

    if(row) {

      var qty=$("#qty_"+row).val();
      var qty_allowed=$("#qty_allowed_"+row).val();
      if(qty=='' || isNaN(qty) || qty=='0')
      {
        $("#qty_"+row).val('1');
      }
      else{
        qty=$("#qty_"+row).val();
      }
       if(qty>qty_allowed)
       {
        alert('Only '+qty_allowed+' qty of product allowed..!')
        $("#qty_"+row).val(qty_allowed);
       }
      var total = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());

      total = total.toFixed(2);
      $("#amount_"+row).val(total);
     
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }

  function check_catagory(row = null) {

    if(row) {

      var product=$("#product_"+row).val();
      
        

        var dataString = 'product='+ product;

          $.ajax({
      type: "POST",
      url: "operations/check_catagory.php",
      data: dataString,

      success: function(responce){
     
        if(responce=='6')
        {
          
          
          $("#item_serial_"+row).prop('required',true);
        }
        else
        {
         
  
          $("#item_serial_"+row).prop('required',false);
        }
      }
      });

    } else {
      alert('no row !! please refresh the page');
    }
  }

function chkprodser(row = null)
{
  var i_s=$("#item_serial_"+row).val();
  var product=$("#product_"+row).val();
  $.ajax({                      
                                  method: "POST",
                                  url: "operations/chk_grn.php",
                                  data: {i_s:i_s, product:product},
                                  dataType: 'json',
                                  encode: true,                 
                                })
                                .done(function(data){
                             
                                   if(data=="already"){
                                          $("#product-alert").hide();

                                            $("#product-alert").fadeTo(4000, 500).slideUp(500, function() {
                                              $("#product-alert").slideUp(500);
                                            });
                                            $("#item_serial_"+row).val('');
                                            $("#item_serial_"+row).focus();
                                           
                                        }

                                    
                                })

}
  function chkbar(row = null)
{
  var bc=$("#barcode_"+row).val();
  var product=$("#product_"+row).val();

                       
  $.ajax({                      
                                  method: "POST",
                                  url: "operations/chk_bc.php",
                                  data: {bc:bc, product:product},
                                  dataType: 'json',
                                  encode: true,                 
                                })
                                .done(function(data){
                     
                                   if(data=="already"){
                                          $("#barcode-alert").hide();

                                            $("#barcode-alert").fadeTo(4000, 500).slideUp(500, function() {
                                              $("#barcode-alert").slideUp(500);
                                            });
                                            $("#barcode_"+row).val('');
                                            $("#barcode_"+row).focus();
                                            
                                        }

                                    
                                })

}
  function subAmount() {


    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
     

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);

     $("#gross_amount").val(totalSubAmount);
    var discount = $("#discount").val();
    var amount_payed = $("#amount_payed").val();

    
    if(discount) {
      var grandTotal = Number(totalSubAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      
    } else {
      $("#net_amount").val(totalSubAmount);
    
      
    }  

      if(amount_payed) {
        if(grandTotal)
        {
          var reamining = Number(grandTotal) - Number(amount_payed);
      reamining = reamining.toFixed(2);

      $("#amount_remaining").val(reamining);
        }
      else{

        var reamining = Number(totalSubAmount) - Number(amount_payed);
      reamining = reamining.toFixed(2);
      $("#amount_remaining").val(reamining);
      }
      
      
    } else {
      $("#amount_remaining").val(grandTotal);
    
      
    } 

  } 

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }



   function get_price(count = null)
 {
     var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var errorCounterDupInput = 0;
    var product_ids = [];
    $(".product").each(function (i, el1) {

        var current_val = $(el1).val();
        
        if (current_val != "") {
            if(product_ids.indexOf(current_val) === -1){
                product_ids.push(current_val);
            } else {
                errorCounterDupInput++;
            }
        }
    });

if(errorCounterDupInput==1)
{
  alert('Product Already Added..!');
  $("#product_info_table tbody tr#row_"+tableProductLength).remove();
   return false;
}
     

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      } 

  var itemid=$("#product_"+count).val();

                                $.ajax({                      
                                  method: "POST",
                                  url: "operations/get_qty.php",
                                  data: {itemid:itemid},
                                  dataType: 'json',
                                  encode: true,                 
                                })
                                .done(function(response){
                             
                                    var len = response.length;
                                        for( var i = 0; i<len; i++){
                                            var qty = response[i]['qty'];
                                            var pur_req_id = response[i]['pur_req_id'];
                                            $("#pur_req_id_"+count).val(pur_req_id);
                                            $("#qty_allowed_"+count).val(qty);
                                            $rate=$("#rate_"+count).val();
                                            $qty=$("#qty_"+count).val('1');
                            

                                            var total = Number($("#rate_"+count).val()) * Number($("#qty_"+count).val());

                                            total = total.toFixed(2);
                                          
                                            $("#amount_"+count).val(total);
                                            subAmount();
                                        }
                                    
                                })

}
</script>
</body>

</html>
