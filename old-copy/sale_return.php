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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Sale Return</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Sale</li>
                            <li class="breadcrumb-item active">Add Sale Return</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
<?php
            $page_name=basename($_SERVER['HTTP_REFERER']);
            $base_page_name=explode('.', $page_name);
            $page=$base_page_name[0];
            $sql1=mysqli_query($conn,"SELECT page_id  FROM tbl_menu where page_link='$page'");
                $data = mysqli_fetch_assoc($sql1);
                $page_id=$data['page_id']; 

                 $query=mysqli_query($conn,"SELECT P, U, D, W  FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $P=$data['P'];
              
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
              if(isset($_GET['sale_id']))
              {
                $sale_id=$_GET['sale_id'];
                $sql=mysqli_query($conn, "SELECT customer_name FROM tbl_sale where sale_id=$sale_id");
                $data=mysqli_fetch_assoc($sql);
                $customer_name=$data['customer_name'];
                $sql2=mysqli_query($conn,"SELECT username,client_cnic from tbl_customer where customer_id='$customer_name'");
                $value2 = mysqli_fetch_assoc($sql2);
                $username=$value2['username'];
                $usercnic=$value2['client_cnic'];
                $sql1=mysqli_query($conn,  "SELECT * FROM tbl_sale_detail where sale_id='$sale_id'"); 
                $data = mysqli_fetch_assoc($sql1);
                $sale_id=$data['sale_id'];
                $invoice=$data['invoice_no'];
              }
              ?>
            <div class="row clearfix">
              
                <div class="col-lg-12 col-md-12 col-sm-12">
                  <div class="alert alert-custom alert-danger" role="alert" id="success-alert4" style="display: none;">
                    <div class="alert-text"> <strong>Sorry ! </strong>No sale was found against this invoice no !</div>
                  </div>
                   <form action="operations/sale_return.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 
                              <div class="col-md-3 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Receiving Location*</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   <input type="hidden" name="iemi" value="0">
                                    <div class="form-group">        
                                        <select class="form-control location"  name="location">
                            
                                           <?php
                                            $sql="SELECT * FROM users where user_id='$userid'"; 
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
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Bill # *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">  
                                    <?php
                                      if($edit_id)
                                      {?>
                                      <input type="text" class="form-control po" required="" readonly="" class="form-control"  value="<?php echo $edit_id; ?>">
                                      <?php }else{ 
                                      ?>
                                      <input type="hidden" class="form-control bill_no" name="bill_no" required="" readonly="" class="form-control"  value="<?php echo $sale_id; ?>">
                                      <input type="text" class="form-control invoice_no" name="invoice_no" class="form-control"  value="<?php echo $invoice; ?>" onchange="get_bill();">
                                       <?php }?>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
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
                                     <input type="date" name="process_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php if($date){echo $date;}else{?><?php echo $date;} ?>" >
                                    <?php }   
                                    else if($P=='1' && $userid!='1'){?>      
                                        <input type="date" name="process_date" id="process_date"   class="form-control" placeholder="Manual Invoice Date"  value="<?php if($date){echo $date;}else{?><?php echo $date;} ?>" >
                                    <?php }else {?>
                                        <input type="date" name="process_date" id="process_date"   class="form-control" placeholder="Manual Invoice Date"  value="<?php if($date){echo $date;}else{?><?php echo $date;} ?>" min="<?php echo date('Y-m-d'); ?>">
                                    <?php }?>   
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Payment Method *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">   
                                     <input type="text" name="sale_type"  id="sale_type" required="" readonly="" class="form-control" value="Cash">     
                           
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                </div>
                              </div>
                                </div> 
                                 <div class="col-md-4 col-sm-12" hidden>
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Sale's Man *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                     <input type="hidden"  name="sales_men_id" id="sales_men_id" required="" readonly="" class="form-control" >
                                        <input type="text"   id="sales_man" required="" readonly="" class="form-control" >
                                        
                                </div>
                              </div>
                                </div> 

                                
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                       <!-- <a href="add_clients.php" >
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>    -->
                                
                                       <label>Customer Name *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                      <input type="hidden"  name="customer" id="customer" required="" readonly="" class="form-control" >
                                        <input type="text"   id="customer_name" required="" readonly="" class="form-control" >
                                </div>
                              </div>
                                </div>
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client CNIC </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="customer_cnic" readonly="" id="customer_cnic" class="form-control" placeholder="Client CNIC"  value="">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Mobile </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="customer_phone" readonly="" id="customer_phone" class="form-control" placeholder="Client Mobile"  value="">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12" hidden>

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Email </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="customer_email" readonly="" id="customer_email" class="form-control" placeholder="Client Email"  value="">
                                </div>
                              </div>
                                </div>
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Address</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="customer_address" readonly="" id="customer_address" class="form-control" placeholder="Client Address"  value="">
                                </div>
                              </div>
                                </div>
                                <div class="col-md-8 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Narration </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea  name="remarks" id="remarks" class="form-control" placeholder="Narration"  value=""><?php echo $remarks;?></textarea>
                                        <input type="hidden"  id="return_items" required="" readonly="" class="form-control" >
                                </div>
                              </div>
                                </div>

                            </div><br>
                      

                            <div class="row clearfix">           
                              <table class="table table-bordered" id="product_info_table">
                 <thead style="background-color: orange;">
                    <tr>
                      <th style="width:30%">Product</th>
                      
                      <th style="width:20%"> Item Barcode</th>
                      <th style="width:10%">Return Qty</th>
                      <th style="width:10%"> Qty</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:10%">Amount</th>
                      <th style="width:10%">Return Amount</th>
                    </tr>
                  </thead>
                  <tbody id="target-content">
                    
                  </tbody>
  
                </table>

               

                 <div class="col-md-6 col-xs-12 pull pull-right" id="creditpayment">

                 <!--  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" tabindex="-1" name="gross_amount" readonly="" autocomplete="off" value="">
                      
                    </div>
                  </div> -->
       
              <!--     <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off" value="<?php echo $discount;?>">
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" tabindex="-1" name="net_amount" readonly=""  autocomplete="off" value="<?php echo $net_amount;?>">
                    </div>
                  </div>
                  <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Amount Recieved</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="amount_recieved" name="amount_recieved" readonly="" placeholder="Amount Recieved" onkeyup="subAmount()" autocomplete="off" value="<?php echo $amount_recieved;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="amount_payed" class="col-sm-5 control-label">Amount Payed</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control"  id="amount_payed" name="amount_payed"  autocomplete="off" value="<?php echo $amount_payed;?>">
                      
                    </div>


                </div>
                 

                </div>
       
                 <div class="col-sm-12">
                                    <div class="mt-4">
    
                                        <button type="submit" class="btn btn-primary submit">Create</button>

                                     
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
function  get_bill()
{
  var invoice=$('.invoice_no').val();
  
   $.ajax({
                url: "operations/sale_return_billno.php",
                type: "POST",
                data: {
                    invoice : invoice
                },
                
                success: function(dataResult){
             
                  if(dataResult=='')
                  {
                    $("#target-content").html('');
                    $("#success-alert4").show();
                    $("#success-alert4").fadeTo(4000, 200).slideUp(200, function() {
                    $("#success-alert4").slideUp(200);
                    });
                  }
                  else
                  {
                     $('.bill_no').val(dataResult);
                     get_detail();
                  }
                }
            });
}

  get_detail();
function get_detail()
{
var bill_no=$('.bill_no').val();
                              $.ajax({
                                  method: "POST",
                                  url: "operations/sale_return_detail.php",
                                  data: {bill_no:bill_no},
                                  dataType: 'json',                 
                                })
                                .done(function(response){
                       
                                   var len = response.length;

                                        for( var i = 0; i<len; i++){
                                            var sale_id = response[i]['sale_id'];
                                            var created_date = response[i]['created_date'];
                                            var remarks = response[i]['remarks'];
                                            var customer_id = response[i]['customer_id'];
                                            var customer_name = response[i]['customer_name'];
                                            var customer_address = response[i]['customer_address'];
                                            var customer_phone = response[i]['customer_phone'];
                                            var customer_cnic = response[i]['customer_cnic'];
                                            var customer_email = response[i]['customer_email'];
                                            var net_amount = response[i]['net_amount'];
                                            var gross_amount = response[i]['gross_amount'];
                                            var discount = response[i]['discount'];
                                            var amount_recieved = response[i]['amount_recieved'];
                                            var sales_men_id = response[i]['sales_men_id'];
                                            var sales_man = response[i]['sales_man'];
                                            var amount_returned = response[i]['amount_returned'];
                                  
                       
                                            
                                            // $("#invoice_date").val("Invoice " +purchase_id);
                                            $("#customer").val(customer_id);
                                            $("#customer_name").val(customer_name);
                                            $("#remarks").val(remarks);
                                            $("#customer_address").val(customer_address);
                                            $("#customer_phone").val(customer_phone);
                                            $("#customer_cnic").val(customer_cnic);
                                            $("#customer_email").val(customer_email);
                                            $("#sales_men_id").val(sales_men_id);
                                            $("#sales_man").val(sales_man);
                                           
                                            $("#net_amount").val(net_amount);
                                            $("#gross_amount").val(gross_amount);
                                            $("#discount").val(discount);
                                            $("#amount_recieved").val(amount_recieved);
                                            $("#amount_payed").val(amount_returned);
                                            


                                        }
                          
                             
                                    
                                })
                                  getitem();
}
function getitem()
{
var bill_no=$('.bill_no').val();

  $.ajax({
                url: "operations/cash_return_items.php",
                type: "POST",
                data: {
                    bill_no : bill_no
                },
                
                success: function(dataResult){
         
                    $("#target-content").html(dataResult);
                    // $(".page-item").removeClass("active");
                    // $("#"+select_id).addClass("active");
                    
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

  var bill_no=$('.bill_no').val();
  if(bill_no=='')
  {
    alert('Please Select BIll #..!');
    $('.bill_no').select2('focus');
    $('.bill_no').select2('open');
    return false;
  }
  var amount_payed=$('#amount_payed').val();
  if(amount_payed=='' || amount_payed=='0.00' || isNaN(amount_payed))
  {
    alert('Opps! Return Product Qty Missing..!');
    
    
    
return false;
    
  }
  var amount_payed=parseFloat($('#amount_payed').val());
var net_amount=parseFloat($('#net_amount').val());


if(amount_payed>net_amount)
{
  alert('Opps! Amount Payed must not be greater than Total amount..!');
    $('#amount_payed').val('');
    $('#amount_payed').focus();

return false;
}
var return_items=parseFloat($('#return_items').val());

 if(return_items=='0' || isNaN(return_items))
{
  alert('Opps! Please Return Atleast One Item..!');
   

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
    $(".bill_no").select2();
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

      var qty_return=$("#return_qty_"+row).val();
      var rate=$("#rate_"+row).val();
      var amount_return= Number(qty_return) * Number(rate);

      $("#return_amount_"+row).val(amount_return);
      var qty=$("#qty_"+row).val();
      
      if(qty_return > qty)
      {
        alert('Sorry !! Please Enter Qty less than Sold Qty');
        $("#return_qty_"+row).val(qty);
        $("#return_amount_"+row).val(Number(qty) * Number(rate));
        subAmount();
        return false;
        
      }
      subAmount();

    } else {
      alert('no row !! please refresh the page');
    }
  }


  function subAmount() {


    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalRetAmount = 0;
    var totalRecQty = 0;

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());

      totalRetAmount = Number(totalRetAmount) + Number($("#return_amount_"+count).val());
      totalRecQty = Number(totalRecQty) + Number($("#return_qty_"+count).val());
      $("#amount_payed").val(totalRetAmount);
      $("#return_items").val(totalRecQty);
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
     totalRecQty = totalRecQty;
   
     $("#gross_amount").val(totalSubAmount);
     $("#return_items").val(totalRecQty);

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
