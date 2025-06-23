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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Purchase</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Purchase</li>
                            <li class="breadcrumb-item active">Add Purchase</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>
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
                        $amount_recieved = $data['amount_recieved'];
                        $amount_remaining = $data['amount_remaining'];

              }
              ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <form action="operations/add_purchase.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 


                                <div class="col-md-6 col-sm-12" >
                                <div class='col-md-12 col-sm-12'>
                                 <a href="add_clients.php"><button type="button" class="btn btn-success" style="height: 33px;"><i class="fa fa-plus"></i></button></a>
                                 <label>Vendors</label>
                                </div> 
                                 <div class='col-md-12 col-sm-12'>
                                    <div class="form-group">    
                                      <select class="form-control vendor"  name="vendor">
                                        <option selected="selected" value="">Choose one</option>
                                           <?php
                                            $sql="SELECT * FROM tbl_vendors"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['v_id']==$vendor)
                                            {
                                            echo "<option value=$row[v_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[v_id]>$row[username] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                    </div>
                                  </div>
                                </div>
                               
                                                             
                            </div><br>
    

                            <div class="row clearfix">           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:50%">Product</th>
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


                $lsql=mysqli_query($conn, "SELECT * FROM tbl_purchase_detail where purchase_id=$edit_id");
                $i=0;
                while($data=mysqli_fetch_assoc($lsql))
                {
                        $i++;
                        $qty = $data['qty'];
                        $rate = $data['rate'];
                        $amount = $data['amount'];
                        $product = $data['product'];
               

              
              ?>
                     <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)">
                                        <option selected="selected">Choose one</option>
                                                                <?php

                                        $sql="SELECT item_name,id,sale_price, item_model  FROM tbl_items"; 


foreach ($conn->query($sql) as $row){

if($row['id']==$product){

echo "<option value=$row[id] selected>$row[item_name] "." $row[item_model]</option>"; 

}else{

echo "<option value=$row[id]>$row[item_name] "." $row[item_model]</option>"; 

}

}

 echo "</select>";
 ?>
</select>

                       
                        </td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>" class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $qty;?>"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>" class="form-control calculate"  required readonly autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $rate;?>">

                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" class="form-control"  autocomplete="off" readonly="" value="<?php echo $amount;?>">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php } }else { $i=1;?>
                       <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)">
                                        <option selected="selected">Choose one</option>
                                                               <?php

                                        $sql="SELECT item_name,id,sale_price, item_model  FROM tbl_items"; 


foreach ($conn->query($sql) as $row){

if($row['id']==$product){

echo "<option value=$row[id] selected>$row[item_name] "." $row[item_model]</option>"; 

}else{

echo "<option value=$row[id]>$row[item_name] "." $row[item_model]</option>"; 

}

}

 echo "</select>";
 ?>
</select>

                       
                        </td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>"  class="form-control calculate" required onkeyup="getTotal(<?php echo $i;?>)" ></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>"  class="form-control calculate"  required readonly autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" >
                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" class="form-control"  autocomplete="off" readonly="" >
                          
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
                   <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Amount Recieved</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="amount_recieved" name="amount_recieved" placeholder="Amount Recieved" onkeyup="subAmount()" autocomplete="off" value="<?php echo $amount_recieved;?>">
                    </div>
                  </div>
                  <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Amount Remaining</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" tabindex="-1" id="amount_remaining" name="amount_remaining"  autocomplete="off" readonly="" value="<?php echo $amount_remaining;?>">
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
    $('.select_group').select2('open');
return false;
    
  }
  var amount_recieved=parseFloat($('#amount_recieved').val());
var net_amount=parseFloat($('#net_amount').val());


if(amount_recieved>net_amount)
{
  alert('Opps! Amount Recieved must not be greater than Total amount..!');
    $('#amount_recieved').val('');
    $('#amount_recieved').focus();

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
                    '<select class="form-control select_group product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required onchange="get_price('+row_id+')"><option selected="selected">Choose one</option><?php $sql="SELECT item_name,id,sale_price, item_model FROM tbl_items"; 
foreach ($conn->query($sql) as $row){

if($row['item_name']==$cat_name){

echo "<option value=$row[id] selected>$row[item_name] "." $row[item_model]</option>"; 

}else{

echo "<option value=$row[id]>$row[item_name] "." $row[item_model]</option>"; 

}

}

 echo "</select>";
 ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" readonly class="form-control" onkeyup="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" readonly></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                $("#product_info_table tbody tr:last").after(html);  
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
    var amount_recieved = $("#amount_recieved").val();

    
    if(discount) {
      var grandTotal = Number(totalSubAmount) - Number(discount);
      grandTotal = grandTotal.toFixed(2);
      $("#net_amount").val(grandTotal);
      
    } else {
      $("#net_amount").val(totalSubAmount);
    
      
    }  

      if(amount_recieved) {
        if(grandTotal)
        {
          var reamining = Number(grandTotal) - Number(amount_recieved);
      reamining = reamining.toFixed(2);
      $("#amount_remaining").val(reamining);
        }
      else{

        var reamining = Number(totalSubAmount) - Number(amount_recieved);
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
