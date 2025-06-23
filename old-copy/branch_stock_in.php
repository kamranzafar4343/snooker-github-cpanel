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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Stock In </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Stock In </li> 
                            <li class="breadcrumb-item active">Add Stock In </li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <div class="alert alert-danger" id="barcode-alert" style="display: none;">
  
              <strong>Ooops!</strong> Barcode Already Exist.
            </div>
            <div class="alert alert-danger" id="product-alert" style="display: none;">
  
              <strong>Ooops!</strong> Product Serial Already Exist.
            </div>
            <div class="alert alert-danger" id="error-alert" style="display: none;">
  
              <strong>Ooops!</strong> Form Submit Error.
            </div>

<?php
              
              if(isset($_GET['purchase_req_id']))
              {

                $edit_id=mysqli_real_escape_string($conn, $_GET['purchase_req_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_purchase_req where purchase_req_id=$edit_id");

                $data=mysqli_fetch_assoc($sql);
                        
                        $vendor = $data['vendor_id'];
                        $purchase_req_id = $data['purchase_req_id'];
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
                   <form action="operations/stock_in.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 
                              <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Location *</label>
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
                                        
                                </div>
                              </div>
                                </div>  
                                 <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Select STB *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">  
                                    <?php
                                      if($edit_id)
                                      {?>
                                      <input type="text" name="po" class="form-control po" required="" readonly="" class="form-control"  value="<?php echo $edit_id; ?>">
                                      <input type="hidden" name="edit" id="edit" value="<?php echo $edit_id; ?>">
                                      <?php }else{ 
                                      ?>
                                      <input type="hidden" name="edit" id="edit" value="">
                                        <select class="form-control po"  name="po" onchange="get_detail();" >
                                          <option selected="" value="">-- Chose One --</option>
                                           <?php
                                           
                                            $sql="SELECT * FROM tbl_purchase_req where item_total!=item_recieved and iemi='0' and transfer_type='2' and created_by='$userid'";
                                           
                                             
                                            foreach ($conn->query($sql) as $row){
                                            $location=$row['from_location'];
                                            $invoice_no=$row['invoice_no'];
                                              $query2 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$location"); 
                                   
                                               $zdata = mysqli_fetch_assoc($query2) ;
                                               $to_location_name=$zdata['user_name'];
                                            if($row['purchase_req_id']==$edit_id)
                                            {
                                            echo "<option value=$row[purchase_req_id] selected>$row[purchase_req_id]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[purchase_req_id]>$row[purchase_req_id] - $to_location_name - $row[po_remarks]  - $row[invoice_no]</option>"; 
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
                                <div class="col-md-4 col-sm-12" hidden>

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Receiving Location *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="rec_location" id="rec_location" required="" readonly=""  class="form-control" placeholder="Receiving Location" value="">
                                </div>
                              </div>
                                </div> 
                                 <div class="col-md-4 col-sm-12">

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
                                  
                                       <label>Invoice Date *</label>
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
                                        <input type="text" name="item_recieved" id="item_recieved"   class="form-control" placeholder="Recieved *"  value="<?php echo $item_recieved; ?>">
                                </div>
                              </div>
                                </div> 

             
                                <div class="col-md-4 col-sm-12" >

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
                      <th style="width:25%">Product</th>
                      <th style="width:15%">Product IEMI</th>
                      <th style="width:10%" hidden>Barcode</th>
                      <th style="width:10%">Trans Qty</th>
                      <th style="width:10%" hidden>Rec Qty</th>
                      <th style="width:10%">Qty</th>
                     
                      <th style="width:5%" hidden>Remove</th>
                    </tr>
                  </thead>
                  <tbody id="target-content">
                    
                  </tbody>
  
                </table>

                <div class="col-md-6 col-xs-12 pull pull-right" hidden="">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" name="gross_amount" readonly="" autocomplete="off" value="<?php echo $gross_amount;?>">
                      
                    </div>
                  </div>
       
                  <div class="form-group">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="discount" name="discount" placeholder="Discount" readonly="" onkeyup="subAmount()" autocomplete="off" value="<?php echo $discount;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" name="net_amount" autocomplete="off" readonly="" value="<?php echo $net_amount;?>">
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
  
  get_detail();
function get_detail()
{
var po=$('.po').val();

$.ajax({
                                  method: "POST",
                                  url: "operations/recieve_pr_items.php",
                                  data: {po:po},
                                  dataType: 'json',                 
                                })
                                .done(function(response){
                               
                                   var len = response.length;

                           //           $("#cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var purchase_req_id = response[i]['purchase_req_id'];
                                            var invoice_date = response[i]['invoice_date'];
                                            var po_remarks = response[i]['po_remarks'];
                                            var invoice_no = response[i]['invoice_no'];
                                            var net_amount = response[i]['net_amount'];
                                            var username = response[i]['username'];
                                            
                                            var gross_amount = response[i]['gross_amount'];
                                          
                                            var discount = response[i]['discount'];
                                            var item_total = response[i]['qty'];
                                                                                                                    
                                            $("#invoice_no").val(invoice_no);  
                                            $("#rec_location").val(username);                                    
                                            $("#po_remarks").val(po_remarks);
                                            $("#invoice_date").val(invoice_date);
                                            //$("#net_amount").val(net_amount);
                                           
                                            //$("#gross_amount").val(gross_amount);
                                            $("#discount").val(discount);
                                            $("#item_total").val(item_total);


                                        }
                           
                                    
                                })
                                 getitem();
                                 
}
function getitem()
{
var po=$('.po').val();
var edit=$('#edit').val();
  $.ajax({
                url: "operations/stock_in_grn.php",
                type: "POST",
                data: { 
                    po : po,
                     edit : edit
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

var amount_payed=parseFloat($('#amount_payed').val());
var net_amount=parseFloat($('#net_amount').val());
 if(net_amount==0)
{
    alert('Opps! No items found..!');
    return false;
}

var item_recieved=parseFloat($('#item_recieved').val());
var item_total=parseFloat($('#item_total').val());
 if(item_recieved>item_total)
{
  alert('Opps! Recieved must not be greater than Total..!');
    $('#item_recieved').val('');
    $('#item_recieved').focus();

return false;
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

      var qty_rec=$("#qty_rec_"+row).val();
      var qty=$("#qty_"+row).val();
      
      if(Number(qty_rec) > Number(qty))
      {
        alert('Sorry !! Please Enter Qty Less to PO Qty');
        $("#qty_rec_"+row).val(qty);
        
        return false;
        
      }
      if(qty_rec=='' || isNaN(qty_rec) || qty_rec=='0')
      {
        $("#qty_rec_"+row).val('1');
      }
      else{
        qty_rec=$("#qty_rec_"+row).val();
      }
      
      var total = Number($("#rate_"+row).val()) * Number($("#qty_rec_"+row).val());

      total = total.toFixed(2);
      $("#amount_"+row).val(total);
     
      
      subAmount();
 
        // for(x = 0; x < tableProductLength; x++) {
        //   var tot_qty=Number($("#qty_rec_"+row).val();

        // }
        // alert(tot_qty);
    } else {
      alert('no row !! please refresh the page');
    }
  }


  function subAmount() {


    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
    var totalRecQty = 0;

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#amount_"+count).val());
      totalRecQty = Number(totalRecQty) + Number($("#qty_rec_"+count).val());
      $("#item_recieved").val(totalRecQty);
     
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);
     totalRecQty = totalRecQty;
   
     $("#gross_amount").val(totalSubAmount);
     $("#item_recieved").val(totalRecQty);
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
 