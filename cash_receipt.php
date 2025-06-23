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
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Alkareem"></div>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Cash Receipt</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Cash Receipt</li>
                            <li class="breadcrumb-item active">Add Cash Receipt</li>
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
<!--             <?php
              
              if(isset($_GET['Installment']) && $_GET['Installment']=='completed' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Installment's are already Completed.
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
    <?php
              } ?> -->
<?php
              
              if(isset($_GET['edit_id']))
              {

                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_payment where id=$edit_id");

                $data=mysqli_fetch_assoc($sql);
                        $location = $data['location'];
                  
                        $total = $data['total'];
                        $payment_date = $data['payment_date'];
                        $remarks = $data['remarks'];
              }

               $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 6) IN('300100','100100')");

                $data3=mysqli_fetch_assoc($sql3);
                        $cash_in_hand = $data3['cash_in_hand'];
                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                $data4=mysqli_fetch_assoc($sql4);
                        $opening_bal = $data4['opening_bal'];
              ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <form action="operations/cash_receipt.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 
                              <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Location *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control location"  name="location">
                            
                                           <?php
                                            $sql="SELECT * FROM users where user_id='$userid'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$location)
                                            {
                                            echo "<option value=$row[user_id] selected>$row[user_name]</option>"; 
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

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Payment Date *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="date" name="payment_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php echo $payment_date; ?>">
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                        <input type="hidden" name="total" id="total" value="<?php echo $total;?>">
                                </div>
                              </div>
                                </div>

                                 <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Cash in Hand *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="cash_in_hand" id="cash_in_hand" required="" readonly="" class="form-control" placeholder="Cash in Hand"  value="<?php echo $cash_in_hand+$opening_bal; ?>">
                            
                                </div>
                              </div>
                                </div>  

                                <div class="col-md-8 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Remarks </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea  name="remarks" id="remarks" class="form-control" placeholder="Remarks"  value=""><?php echo $remarks;?></textarea>
                                </div>
                              </div>
                                </div>
                                                
                            </div><br>
    

                            <div class="row clearfix" >           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:30%">Account</th>
                      <th style="width:50%">Narration</th>
                      <th style="width:20%">Amount</th>
 
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php
              $acc_query="SELECT * FROM `tbl_account_lv2` WHERE LEFT(acode, 6) IN('100200', '100700', '400100')";
          if($edit_id!='')
          {


                $lsql=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where invoice_no='Cash_Receipt_".$edit_id."' and d_amount='0'");
                $i=0;
                while($data=mysqli_fetch_assoc($lsql))
                {
                        $i++;
                   
                        $c_amount = $data['c_amount'];
                        $narration = $data['narration'];
                        $acode = $data['acode'];
               

              
              ?>
                     <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group" data-row-id="row_<?php echo $i;?>" id="account_<?php echo $i;?>" name="account[]" style="width:100%;"  required>
                                        <option >Choose one</option>
                                        <?php



foreach ($conn->query($acc_query) as $row){

if($row['acode']==$acode){

echo "<option value=$row[acode] selected>$row[aname]</option>"; 

}else{

echo "<option value=$row[acode]>$row[aname]</option>"; 

}

}

 echo "</select>";
 ?>
</select>

                       
                        </td>
                        <td><input type="text" name="narration[]" id="narration_<?php echo $i;?>" class="form-control "  value="<?php echo $narration;?>"></td>
                        <td>
                          <input type="text" name="debit[]" id="debit_<?php echo $i;?>" class="form-control calculate" required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $c_amount;?>">

                          
                        </td>
                   
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php } }else { $i=1;?>
                       <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group" data-row-id="row_<?php echo $i;?>" id="account_<?php echo $i;?>" name="account[]" style="width:100%;"  required>
                                        <option selected="selected" value="">Choose one</option>
                                       <?php

                                        


foreach ($conn->query($acc_query) as $row){

if($row['acode']==$account){

echo "<option value=$row[acode] selected>$row[aname]</option>"; 

}else{

echo "<option value=$row[acode]>$row[aname]</option>"; 

}

}

 echo "</select>";

 ?>
</select>

                       
                        </td>
                        <td><input type="text" name="narration[]" id="narration_<?php echo $i;?>"  class="form-control" required></td>
                        <td><input type="text" name="debit[]" id="debit_<?php echo $i;?>"  class="form-control calculate" required autocomplete="off" onchange="getTotal(<?php echo $i;?>)" ></td>
                      
                        

                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php }?>
                   </tbody>
                </table>
                
    
                </div>

                 <div class="col-sm-12 text-center">
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
    this.value = this.value.replace(/\D/g, '1');
  }
});
</script>

<script type="text/javascript">

get_details();
 function get_details()
 {
  var sale_type=$('#sale_type').val();
  if(sale_type=='Cash' || sale_type=='Credit')
  {
    $('#customer').show();
    $("#Installment").hide();
    $("#product_info_table").show();
    $("#creditpayment").show();
    $("#Installmentdetail").hide();
    $(".Installmentproduct").hide();
  }
 
    if(sale_type=='Installment')
  {

   window.location.assign("Installment.php")


  }

 }

</script>

<script type="text/javascript">
$(function() {
$(".submit").click(function() {

 var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totalSubAmount = Number(totalSubAmount) + Number($("#debit_"+count).val());
    } // /for

    totalSubAmount = totalSubAmount.toFixed(2);


// var cash_in_hand=$("#cash_in_hand").val();

// if(Number(totalSubAmount)>Number(cash_in_hand))
// {
//   alert('Please Enter Amount Less than Cash in hand..');
//   return false;
// }

$("#total").val(totalSubAmount);


 });
});
</script> 
<script type="text/javascript">
  
  $(document).ready(function() {
    $(".select_group").select2();



    $("#add_row").unbind('click').bind('click', function() {
       
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
  

               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group acc"  data-row-id="row_1" id="account_'+row_id+'" name="account[]" style="width:100%;"  required><option selected="selected">Choose one</option><?php  
foreach ($conn->query($acc_query) as $row){

if($row['acode']==$account){

echo "<option value=$row[acode] selected>$row[aname]</option>"; 

}else{

echo "<option value=$row[acode]>$row[aname]</option>"; 

}

}

 echo "</select>";
 ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td><input type="text" name="narration[]" id="narration_'+row_id+'" required class="form-control"></td>'+
                    '<td><input type="number" name="debit[]" id="debit_'+row_id+'" required  onchange="getTotal('+row_id+')" class="form-control"></td>'+
                    
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    var tableProductLength = $("#product_info_table tbody tr").length;
                    var account=$("#account_"+count_table_tbody_tr).val();
                    var debit=$("#debit_"+count_table_tbody_tr).val();
//                      var old=tableProductLength-1;
                     
//                      var old_account=$("#account_"+old).val();
// alert(old_account);
//                     var a=0;
//                     $(".acc").each(function() {
//                         if($(this).val()==old_account){
                          
//                           alert($(this).val());
//                           alert("Account already added...!");
//                           a=1;
//                             if(a==1){
//                               $("#product_info_table tbody tr#row_"+tableProductLength).remove();
                             
//                                 return false;
//                               }
//                      }
//                     });

                  
                
                    if(account=='')
                    {
                      alert("Opps!  Please Select Account..");
                       $("#account_"+count_table_tbody_tr).select2('focus');
                      $("#account_"+count_table_tbody_tr).select2('open');
                     
                      return false;
                    }
                    else if (debit=='' || debit=='0')
                    {
                      alert("Opps!  Please Enter Amount..");
                      $("#debit_"+count_table_tbody_tr).focus();
                      return false;
                    }
                  

                    else{

                      $("#product_info_table tbody tr:last").after(html);  
                    }
                
              }
              else {
                $("#product_info_table tbody").html(html);
              }

              $(".acc").select2();

      

      return false;
    });

  }); // /document

  // function getTotal(row = null) {

  //   if(row) {

  //       var qty=$("#qty_"+row).val();
  //        var stock_qty=$("#stock_qty_"+row).val();

  //     // if(qty=='' || isNaN(qty) || qty=='0')
  //     // {
  //     //   $("#qty_"+row).val('1');
  //     // }
  //     // else{
  //     //   qty=$("#qty_"+row).val();
  //     // }
      
  //     if(Number(qty)>Number(stock_qty))
  //     {
  //       alert("Quantity must be equal or less than stock qty..!");
  //       $("#qty_"+row).val('1');
  //       $("#qty_"+row).focus();
  //     }
  //     var total = Number($("#rate_"+row).val()) * Number($("#qty_"+row).val());

  //     total = total.toFixed(2);
  //     $("#amount_"+row).val(total);
     
      
  //     subAmount();

  //   } else {
  //     alert('no row !! please refresh the page');
  //   }
  // }


  // function subAmount() {




  // } 

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
url: "operations/get_price.php",
data: dataString,

success: function(responce){

 $rate=$("#rate_"+count).val(responce);
  $qty=$("#qty_"+count).val('1');

 var total = Number($("#rate_"+count).val()) * Number($("#qty_"+count).val());

      total = total.toFixed(2);
      
 $("#amount_"+count).val(total);
 subAmount();
 get_stock_qty()
}
});

}

  function get_stock_qty(count = null)
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
url: "operations/get_stock_qty.php",
data: dataString,

success: function(responce){
if(responce=='0')
{
  alert('Stock is Empty..!');
   $("#product_info_table tbody tr#row_"+count).remove();
  subAmount();
}
else
{
  $("#stock_qty_"+count).val(responce);
}
}
});

}
    
function get_installment_price(){

  var installment_month=$("#installment_month").val();
  var per_month_payment=$("#one_month_payment").val();

  if(installment_month>1)
  {
   
    var per_month_payment_total = Number(installment_month) * Number(per_month_payment);

      per_month_payment_total = per_month_payment_total.toFixed(2);
      $("#per_month_payment").val(per_month_payment_total);
  }
  else
  {
    $("#per_month_payment").val(per_month_payment);
  }
}

get_customer_detail();
         function get_customer_detail(){

    var customer_id = $('.customer').val();

      $.ajax({
                  method: "POST",
                  url: "operations/get_customer_detail.php",
                  data: {customer_id:customer_id},
                  dataType: 'json',                 
                })
                .done(function(response){

                   var len = response.length;

                     $("#client_cnic").empty();
                     $("#client_mobile_no").empty();
                     $("#client_email").empty();
                     $("#client_address").empty();
                        for( var i = 0; i<len; i++){
                            var client_cnic = response[i]['client_cnic'];
                            var client_mobile_no = response[i]['mobile_no1'];
                            var client_email = response[i]['email'];
                            var client_address = response[i]['address_permanent'];

                          $("#client_cnic").val(client_cnic);
                          $("#client_mobile_no").val(client_mobile_no);
                          $("#client_email").val(client_email);
                           $("#client_address").val(client_address);

                        }

                    
                });


}
</script>
</body>

</html>
