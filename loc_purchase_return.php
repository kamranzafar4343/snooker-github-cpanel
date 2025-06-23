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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Purchase Return</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Purchase</li>
                            <li class="breadcrumb-item active">Add Purchase Return</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
<?php
              
              if(isset($_GET['edit_id']))
              {

                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_purchase where purchase_id=$edit_id");

                $data=mysqli_fetch_assoc($sql);
                        
                        $vendor = $data['vendor_id'];
                        $purchase_id = $data['purchase_id'];
                        $item_recieved = $data['item_recieved'];
                        $sql="SELECT username, vendor_id  FROM tbl_vendors where vendor_id='$vendor'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          $vendor_name=$data['username'];
                          $vendor=$data['vendor_id'];
                   
                         }
               

              }
    
              ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                   <div class="alert alert-danger" id="product-alert" style="display: none;">
  
              <strong>Sorry !</strong> Item with same Barcode and Serial already Sold.
            </div>
         
                   <form action="operations/loc_purchase_return.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 
                              <div class="col-md-3 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Receiving Location*</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
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
                                 <div class="col-md-3 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Select PO *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">  
                                    <?php
                                      if($edit_id)
                                      {?>
                                      <input type="text" class="form-control po" required="" readonly="" class="form-control"  value="<?php echo $edit_id; ?>">
                                      <?php }else{ 
                                      ?>
                                        <select class="form-control po"  name="po" onchange="get_detail();" >
                                          <option selected="" value="">-- Chose One --</option>
                                           <?php
                                            $sql="SELECT * FROM tbl_single_purchase where payment_status='Completed' and bill_status='Completed' and created_by='$userid'"; 
                                            foreach ($conn->query($sql) as $row){
                                               $invoice=$row[invoice_no];
                                               $vendor_id=$row[vendor_id];
                                              $sql2=mysqli_query($conn,"SELECT username from tbl_vendors where vendor_id='$vendor_id'");
                                                $value2 = mysqli_fetch_assoc($sql2);
                                                $username=$value2['username'];
                                            if($row['purchase_id']==$purchase_id)
                                            {
                                            echo "<option value=$row[purchase_id] selected>$row[purchase_id] - $username - $invoice - $row[created_date]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[purchase_id]>$row[purchase_id] - $username - $invoice - $row[created_date] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                     <?php }?>      
                                        
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-3 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                       <!-- <a href="#largeModal" data-toggle="modal" data-target="#largeModal">
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   --> 
                                
                                       <label>Vendors *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">      
                                  
                                        <input type="hidden"  name="vendor" id="vendor" required="" readonly="" class="form-control" >
                                        <input type="text"   id="vendor_name" required="" readonly="" class="form-control" >
                              
                                      
                                </div>
                              </div>
                                </div>  
                                 <div class="col-md-3 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Invoice No *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="invoice_no" id="invoice_no" required="" readonly=""  class="form-control" placeholder="Invoice No" value="<?php echo $invoice_no;?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Order Date *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="date" name="invoice_date" id="invoice_date" required="" readonly="" class="form-control" placeholder="Manual Invoice Date"  value="<?php echo $invoice_date; ?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12" hidden="">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Total *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="item_total" id="item_total" required="" readonly=""  class="form-control" placeholder="Total *"  value="<?php echo $total_qty; ?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12" hidden="">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Recieved *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="item_returned" id="item_returned" required=""  class="form-control" placeholder="Recieved *"  value="<?php echo $item_returned; ?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-8 col-sm-12" >

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Remarks *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea name="po_remarks" required=""  readonly="" class="form-control"  row="1" id="po_remarks"><?php echo $po_remarks; ?></textarea>
                                </div>
                              </div>
                                </div> 

                            </div><br>
                      

                            <div class="row clearfix">           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:30%">Product</th>
                      
                      <th style="width:15%">Product Serial / IEMI</th>
                      <th style="width:10%">Product Barcode</th>
                      <th style="width:10%">Rtn Qty</th>
                      <th style="width:5%">Qty</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:10%">Amount</th>
                      <th style="width:20%">Returned Amount</th>
                    </tr>
                  </thead>
                  <tbody id="target-content">
                    
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
                      <input type="text" class="form-control calculate" id="discount" name="discount" placeholder="Discount"  onkeyup="subAmount()" autocomplete="off" value="">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" autocomplete="off" readonly="" value="<?php echo $net_amount;?>">
                    </div>
                  </div>
                     <div class="form-group" >
                    <label for="discount" class="col-sm-5 control-label">Amount Payed</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" tabindex="-1" id="amount_payed" name="amount_payed" placeholder="Amount Returned" onkeyup="subAmount()" readonly="" autocomplete="off" value="<?php echo $amount_payed;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="payment_method" class="col-sm-5 control-label">Payment Method</label>
                    <div class="col-sm-7">
                      <select class="form-control" name="payment_method" id="payment_method" onchange="get_bank();"> 
                        <option selected="" value="">-- Chose One --</option>
                        <option>Cash Payment</option>
                        <option>Bank Payment</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group" id="bank_id_field" style="display: none;">
                    <label for="bank_id" class="col-sm-5 control-label">Bank Name</label>
                    <div class="col-sm-7">
                     <select class="form-control"  name="bank_id" id="bank_id">
                                          <option selected="" value="">-- Chose One --</option>
                                           <?php
                                            $sql="SELECT * FROM `tbl_account_lv2` where left(acode, 6)='100700'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['acode']==$bank_id)
                                            {
                                            echo "<option value=$row[acode] selected>$row[aname]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[acode]>$row[aname] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                    </div>
                  </div>
                  <div class="form-group" id="check_no_field" style="display: none;">
                    <label for="check_no" class="col-sm-5 control-label">Check No</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="check_no" name="check_no" placeholder="Check No" autocomplete="off" value="<?php echo $check_no;?>">
                    </div>
                  </div>
                    <div class="form-group" id="discount1">
                    <label for="amount_received" class="col-sm-5 control-label">Amount Recieved</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate"  id="amount_received" name="amount_received" required="" placeholder="Amount Recieved" onkeyup="subAmount()" autocomplete="off" value="<?php echo $amount_received;?>">
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

</script> 
<script type="text/javascript">

  function get_bank()
  {
    var payment_method=$('#payment_method').val();

    if(payment_method=='Bank Payment')
    {
      $('#check_no_field').show();
      $('#bank_id_field').show();

    }
    else
    {
      $('#check_no_field').hide();
      $('#bank_id_field').hide();
    }
  }
</script>
<script type="text/javascript">
  
  get_detail();
function get_detail()
{
var po=$('.po').val();
$.ajax({
                                  method: "POST",
                                  url: "operations/get_loc_pur_detail.php",
                                  data: {po:po},
                                  dataType: 'json',                 
                                })
                                .done(function(response){
                       
                                   var len = response.length;

                           //           $("#cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var purchase_id = response[i]['purchase_id'];
                                            var invoice_date = response[i]['invoice_date'];
                                            var po_remarks = response[i]['po_remarks'];
                                            var vendor_id = response[i]['vendor_id'];
                                            var net_amount = response[i]['net_amount'];
                                            var amount_payed = response[i]['amount_payed'];
                                            
                                            var gross_amount = response[i]['gross_amount'];
                                            var amount_remaining = response[i]['amount_remaining'];
                                            var discount = response[i]['discount'];
                                            var item_total = response[i]['qty'];
                                            // var qty_rec = response[i]['qty_rec'];
                                            var vendor_name = response[i]['username'];
                                            var payment_method = response[i]['payment_method'];
                                            var bank_id = response[i]['bank_id'];
                                            var check_no = response[i]['check_no'];

                                        
                                            
                                            $("#invoice_no").val("Invoice " +purchase_id);
                                            $("#vendor").val(vendor_id);
                                            $("#vendor_name").val(vendor_name);
                                            $("#po_remarks").val(po_remarks);
                                            $("#invoice_date").val(invoice_date);
                                            $("#net_amount").val(net_amount);
                                            $("#amount_payed").val(amount_payed);
                                            $("#gross_amount").val(gross_amount);
                                            $("#amount_remaining").val(amount_remaining);
                                            $("#discount").val(discount);
                                            $("#item_total").val(item_total);
                                            // $("#item_recieved").val(qty_rec);
                                            $("#payment_method").val(payment_method);
                                            $("#check_no").val(check_no);
                                            $("#bank_id").val(bank_id);


                                        }
                            getitem();
                              get_bank();
                                    
                                })
}
function getitem()
{
var po=$('.po').val();

  $.ajax({
                url: "operations/loc_purchase_return_item.php",
                type: "POST",
                data: {
                    po : po
                },
                
                success: function(dataResult){
         
                    $("#target-content").html(dataResult);
                    // $(".page-item").removeClass("active");
                    // $("#"+select_id).addClass("active");
                     subAmount(); 
                }
            });

}
</script>
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

  var po=$('.po').val();
  if(po=='')
  {
    alert('Please Select PO #..!');
    $('.po').select2('focus');
    $('.po').select2('open');
    return false;
  }
  var gross_amount=$('#gross_amount').val();
  if(gross_amount=='' || gross_amount=='0.00' || isNaN(gross_amount))
  {
    alert('Opps! Product or Qty Missing..!');
    
    $('.select_group').select2('focus');
    
return false;
    
  }
  var amount_received=parseFloat($('#amount_received').val());
var net_amount=parseFloat($('#net_amount').val());


if(Number(amount_received)> Number(net_amount))
{
  alert('Opps! Amount Recieved must not be greater than Total amount..!');
    $('#amount_payed').val('');
    $('#amount_payed').focus();

return false;
}
var item_returned=parseFloat($('#item_returned').val());
var item_total=parseFloat($('#item_total').val());
 if(item_returned>item_total)
{
  alert('Opps! Returned must not be greater than Total..!');
    $('#item_returned').val('');
    $('#item_returned').focus();

return false;
}
if(item_returned==0 || item_returned=='' || isNaN(item_returned))
{
  alert('Opps! Please Add Atleast One Returned Item..!');
  return false;
}
var payment_method=$('#payment_method').val();
    if(payment_method=='Bank Payment')
    {
      var check_no=$('#check_no').val();
      var bank_id=$('#bank_id').val();

      if(check_no=='' || bank_id=='')
      {
        alert('Opps! Bank Detail or Check No is Missing..!');
        $('#check_no').focus();
      }
    }
    else if(payment_method=='Cash Payment')
    {

      var amount_payed=parseFloat($('#amount_payed').val());
      
      if(amount_payed=='' || isNaN(amount_payed))
      {                   
        alert('Opps! Amount Payed must not be empty..!');
        $('#amount_payed').focus();
      }
    }
 });

});
</script> 
<script type="text/javascript">
  

  $(document).ready(function() {
    $(".po").select2();
    $(".select_group").select2();



    $("#add_row").unbind('click').bind('click', function() {
       
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;

            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required ><?php $sql="SELECT item_id,item_name, item_model FROM tbl_items";
foreach ($conn->query($sql) as $row){

if($row['item_id']==$product){

echo "<option value=$row[item_id] selected>$row[item_name] "." $row[item_model]</option>"; 

}else{

echo "<option value=$row[item_id]>$row[item_name] "." $row[item_model]</option>"; 

}

}

 echo "</select>";
 ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'"  class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" readonly></td>'+
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

      var return_qty=$("#return_qty_"+row).val();
      var product=$("#product_"+row).val();
      var item_serial=$("#item_serial_"+row).val();
      var barcode=$("#barcode_"+row).val();
      
      var qty=$("#qty_"+row).val();
      var amount=$("#amount_"+row).val();
      var total = Number($("#rate_"+row).val()) * Number($("#return_qty_"+row).val());

      total = total.toFixed(2);
      $("#return_amount_"+row).val(total);
      if(Number(return_qty) > Number(qty))
      {
        alert('Sorry !! Please Enter Qty less than Purchase Qty');
        $("#return_qty_"+row).val(qty);
        $("#return_amount_"+row).val(amount);
        subAmount();
        return false;
        
      }

  $.ajax({                      
                                  method: "POST",
                                  url: "operations/chk_sold_item.php",
                                  data: {item_serial:item_serial, barcode:barcode, product:product},
                                  dataType: 'json',
                                  encode: true,                 
                                })
                                .done(function(data){
                        
                                   if(data=="already"){
                                          $("#product-alert").hide();

                                            $("#product-alert").fadeTo(4000, 500).slideUp(500, function() {
                                              $("#product-alert").slideUp(500);
                                            });
                                            $("#product_info_table tbody tr#row_"+row).remove();
                                            subAmount();
                                         
                                           
                                        }

                                    
                                })
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }


  function subAmount() {


    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalRtnQty = 0;
    var totalRtnamount = 0;
 var discount = $("#discount").val();
   
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
      totalRtnQty = Number(totalRtnQty) + Number($("#return_qty_"+count).val());
      totalRtnamount = Number(totalRtnamount) + Number($("#return_amount_"+count).val());
      $("#item_returned").val(totalRtnQty);
      $("#amount_received").val(totalRtnamount);

    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
   $("#amount_received").val(totalRtnamount);
   
     $("#gross_amount").val(totalSubAmount);

     $("#item_returned").val(totalRtnQty);
   



    if(discount) {
      var grandTotal = Number(totalSubAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
       $("#amount_received").val(totalRtnamount);
      
    } else {
      $("#net_amount").val(totalSubAmount);
      $("#amount_received").val(totalRtnamount);
    
      
    }  

    //   if(amount_payed) {
    //     if(grandTotal)
    //     {
    //       var reamining = Number(grandTotal) - Number(amount_payed);
    //   reamining = reamining.toFixed(2);

    //   $("#amount_remaining").val(reamining);
    //     }
    //   else{

    //     var reamining = Number(totalSubAmount) - Number(amount_payed);
    //   reamining = reamining.toFixed(2);
    //   $("#amount_remaining").val(reamining);
    //   }
      
      
    // } else {
    //   $("#amount_remaining").val(grandTotal);
    
      
    // } 

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
     

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      } 

  var itemid=$("#product_"+count).val();

  var dataString = 'itemid='+ itemid;

    $.ajax({
type: "POST",
url: "operations/get_pur_price.php",
data: dataString,

success: function(responce){
  
 $rate=$("#rate_"+count).val(responce);
$qty=$("#qty_"+count).val('1');

 var total = Number($("#rate_"+count).val()) * Number($("#qty_"+count).val());

      total = total.toFixed(2);
      
 $("#amount_"+count).val(total);
 subAmount();
}
});

}
</script>
</body>

</html>
