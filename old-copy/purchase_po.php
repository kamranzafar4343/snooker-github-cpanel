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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Purchase With PO</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Purchase</li>
                            <li class="breadcrumb-item active">Add Purchase With PO</li>
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
            
              if(isset($_GET['edit_id']))
              {

                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_purchase where purchase_id=$edit_id");

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
    
  $query = "SELECT purchase_id FROM `tbl_purchase` order by purchase_id DESC LIMIT 1";
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
  
                    <strong>Sorry !</strong> Barcode Already Added.
                  </div>
                   <form action="operations/add_purchase.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 
                              <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Receiving Location*</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                    <input type="hidden" name="iemi" value="0">
                                    <div class="form-group">        
                                        <select class="form-control location"  name="location">
                            
                                           <?php
                                           $sql="SELECT created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by=$data['created_by'];
                                               
                                         
                                               }
                                            $sql="SELECT * FROM users where user_id='$created_by'"; 
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
                                      <a href="add_vendors.php?add_type=2">
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   
                                     
                                       <label>Vendors *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control vendor"  name="vendor">
                                        <option selected="selected" value="">Choose one</option>
                                           <?php
                                            $sql="SELECT * FROM tbl_vendors where created_by='$created_by'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['vendor_id']==$vendor)
                                            {
                                            echo "<option value=$row[vendor_id] selected>$row[username] $row[mobile_no]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[vendor_id]>$row[username] $row[mobile_no]</option>"; 
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
                                        <input type="text" name="invoice_no" required=""  class="form-control" placeholder="Invoice No" value="<?php if($invoice_no){echo $invoice_no;}else{?>Invoice <?php echo $purchase_id;} ?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Invoice Date *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="date" name="invoice_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php if($invoice_date){echo $invoice_date;}else{?><?php echo $date;} ?>" >
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
                      <th style="width:30%">Product</th>
                      <th style="width:30%">Barcode</th>
                      <th style="width:10%">Qty</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:10%" hidden>Sale Rate</th>
                      <th style="width:20%">Amount</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                     <?php
              
          if($edit_id!='')
          {


                $lsql=mysqli_query($conn, "SELECT * FROM tbl_purchase_detail where purchase_id=$edit_id");
                $i=0;
                while($data=mysqli_fetch_assoc($lsql))
                {
                        $i++;
                        $qty = $data['qty'];
                        $rate = $data['rate'];
                        $amount = $data['amount'];
                        $product = $data['product'];
                        $barcode = $data['barcode'];
                        $sale_rate = $data['sale_rate'];
               

              
              ?>
                     <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group product" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)">
                                                            <option value="">Choose Product</option>
                                                                <?php

                                        $sql="SELECT * FROM tbl_items"; 
                                            foreach ($conn->query($sql) as $row){
                                                $category=$row['category'];
                                                 $sql2=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
                                                $value2 = mysqli_fetch_assoc($sql2);
                                                $catagory_name=$value2['catagory_name'];
                                           
                                            if($row['item_id']==$product){

                                            echo "<option value=$row[item_id] selected>$catagory_name "." $row[item_name] "." $row[barcode]</option>"; 

                                            }else{

                                            echo "<option value=$row[item_id]>$catagory_name "." $row[item_name] "." $row[barcode]</option>"; 

                                            }

                                            }
                                            
                                             echo "</select>";
 ?>
</select>

                       
                        </td>
                        <td><input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control calculate" required onkeyup="chkbar(<?php echo $i;?>)" value="<?php echo $barcode;?>"></td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>" class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)"  value="<?php echo $qty;?>"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>" class="form-control "  required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" onkeypress="return isNumberKey(this, event);" value="<?php echo $rate;?>">

                          
                        </td>
                        <td hidden="">
                          <input type="text" name="sale_rate[]" id="sale_rate_<?php echo $i;?>" class="form-control" onkeypress="return isNumberKey(this, event);"  required  autocomplete="off" value="<?php echo $sale_rate;?>">

                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" class="form-control"  autocomplete="off" readonly="" value="<?php echo $amount;?>">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php } }else { $i=1;?>
                       <tr id="row_<?php echo $i;?>">
                       <td>
                            <select class="form-control product" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)">
                                <option value="">Choose Product</option>
                            <?php
                                $sql="SELECT * FROM tbl_items"; 
                                            foreach ($conn->query($sql) as $row){
                                                 $category=$row['category'];
                                                 $sql2=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
                                                $value2 = mysqli_fetch_assoc($sql2);
                                                $catagory_name=$value2['catagory_name'];
                                            if($row['item_id']==$product){

                                            echo "<option value=$row[item_id] selected>$catagory_name "." $row[item_name]"." $row[barcode] </option>"; 

                                            }else{

                                            echo "<option value=$row[item_id]>$catagory_name "." $row[item_name] "." $row[barcode]</option>"; 

                                            }

                                            }
                                            
                                             echo "</select>";
                                             ?>
                                            </select>

                       
                        </td>
                        <td><input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control calculate" required onkeyup="chkbar(<?php echo $i;?>)" ></td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>"  class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" ></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>"  class="form-control"  required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" onkeypress="return isNumberKey(this, event);">
                          
                        </td>
                        <td hidden>
                          <input type="text" name="sale_rate[]" id="sale_rate_<?php echo $i;?>"  class="form-control"  required  autocomplete="off" onkeypress="return isNumberKey(this, event);">
                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" class="form-control"  autocomplete="off" >
                          
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
   function isNumberKey(txt, evt) {
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if (charCode == 46) {
        //Check if the text already contains the . character
        if (txt.value.indexOf('.') === -1) {
          return true;
        } else {
          return false;
        }
      } else {
        if (charCode > 31 &&
          (charCode < 48 || charCode > 57))
          return false;
      }
      return true;
    }
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
 
 });

});
</script> 
<script type="text/javascript">
  $( document ).on( 'keydown', function ( e ) {
      if ( e.keyCode === 13 ) { //DELETE key code
           e.preventDefault();
        }
        if ( e.keyCode === 27 ) { //DELETE key code
          $("#add_row").click();
            var tableProductLength = $("#product_info_table tbody tr").length;  
          for(x = 0; x < tableProductLength; x++) {
              var tr = $("#product_info_table tbody tr")[x];
              var count = $(tr).attr('id');

              count = count.substring(4);
              
            } // /for
          
            $("#product_"+count).select2('focus');
              $("#product_"+count).select2('open');
          
        }
    });

  $(document).ready(function() {
    $(".vendor").select2();
    $(".select_group").select2();
     $(".product").select2();



    $("#add_row").unbind('click').bind('click', function() {
       
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required onchange="get_price('+row_id+')"><option value="">Choose Product</option><?php
                                $sql="SELECT * FROM tbl_items"; 
                                            foreach ($conn->query($sql) as $row){
                                                $brand_id=$row['brand_id'];
                                                $item_id=$row['item_id'];
                                                $item_name=$row['item_name'];
                                               $category=$row['category'];
                                                 $sql2=mysqli_query($conn,"SELECT catagory_name from tbl_cat where id='$category'");
                                                $value2 = mysqli_fetch_assoc($sql2);
                                                $catagory_name=$value2['catagory_name'];
                                            if($row[item_id]==$product){

                                            echo "<option value=$row[item_id] selected>$catagory_name "." $item_name "." $row[barcode]</option>"; 

                                            }else{

                                            echo "<option value=$row[item_id]>$catagory_name "." $item_name "." $row[barcode]</option>";  

                                            }

                                            }
                                            
                                             echo "</select>";
                                             ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="barcode[]" id="barcode_'+row_id+'" class="form-control" onchange="chkbar('+row_id+')"></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'"  class="form-control" onkeyup="getTotal('+row_id+')" onkeypress="return isNumberKey(this, event);"></td>'+
                    '<td hidden><input type="text" name="sale_rate[]" id="sale_rate_'+row_id+'"  class="form-control" onkeypress="return isNumberKey(this, event);"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" ></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    var total=$("#amount_"+count_table_tbody_tr).val();
                    if(total=='' || total=='0.00' || isNaN(total))
                    {
                      alert("Opps  Qty or Price missing..");
                      $("#qty_"+count_table_tbody_tr).focus();
                      return false;
                    }
                    else{
                       var tableProductLength = $("#product_info_table tbody tr").length;
                      
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
                      //$("#product_info_table tbody tr:last").remove();
                      $("#product_info_table tbody tr#row_"+tableProductLength).remove();
                       return false;
                    }
                    else
                    {
                      $("#product_info_table tbody tr:last").after(html);  
                    }
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
      if(qty=='' || isNaN(qty) || qty=='0')
      {
        $("#qty_"+row).val('1');
      }
      else{
        qty=$("#qty_"+row).val();
      }
      
      var total = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());

      total = total.toFixed(2);
      $("#amount_"+row).val(total);
     
      
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
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
  $("#barcode_"+count).val('');

$.ajax({
      method: "POST",
      url: "operations/pur_po_price.php",
      data: {itemid:itemid},
      dataType: 'json',                 
      })
.done(function(response){

        var len = response.length;
          for( var i = 0; i<len; i++){
              var barcode = response[i]['barcode'];
              var rate = response[i]['rate'];
              var sale_rate = response[i]['sale_rate'];
           $("#barcode_"+count).val(barcode);
           $("#rate_"+count).val(rate);
           $("#sale_rate_"+count).val(sale_rate);
           $("#qty_"+count).val('1');
          
           $("#amount_"+count).val(rate);
           
            }
          subAmount();
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
</script>
</body>

</html>
