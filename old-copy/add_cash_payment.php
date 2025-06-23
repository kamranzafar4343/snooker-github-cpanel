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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Account Voucher</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Account Voucher</li>
                            <li class="breadcrumb-item active">Add Account Voucher</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <div class="alert alert-danger" id="no-balance" style="display: none;">
  
              <strong>Sorry !</strong> Current account balance is less than amount.
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
                $sql=mysqli_query($conn, "SELECT * FROM tbl_payment where id=$edit_id");

                $data=mysqli_fetch_assoc($sql);
                        $location = $data['location'];
                  
                        $total = $data['total'];
                        $payment_date = $data['payment_date'];
                        $remarks = $data['remarks'];
              }

                $sql="SELECT branch_id,user_privilege,created_by  FROM users where user_id='$userid'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $privilige = $data['user_privilege'];
                          $created_by = $data['created_by'];
                          $branch_id = $data['branch_id'];
                         }
               $sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }

                if($privilige!='branch' && $created_by=='1')
                {
                  
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '100100000') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $recievable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' ");
                  $recievable_tot=mysqli_fetch_assoc($recievable);
                  $tot_rec=abs($recievable_tot['total_rec']);

                  $cash_now=round($opening_bal+$cash_in_hand, 0);
                }

                else
                {
                  if($branch_id=='')
                  {
                    $sql="SELECT branch_id FROM users where user_id='$created_by'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_id = $data['branch_id'];
                          
                         }

                  }
                  
             
                  $sql7=mysqli_query($conn, "SELECT SUM(total_amount) as cash_transfer FROM `tbl_trans` WHERE account_id='$branch_id'");

                  $data7=mysqli_fetch_assoc($sql7);
                  $cash_transfer = $data7['cash_transfer'];
                
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300','300200100', '$branch_id') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand']+$cash_transfer;

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account_lv2` WHERE acode='$branch_id'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];
                }
                
                

                $sql6=mysqli_query($conn, "SELECT  SUM(opening_bal) as opening_bal  FROM `tbl_account_lv2` WHERE LEFT(acode, 6) IN ('100700')");

                $data6=mysqli_fetch_assoc($sql6);
                $opening_bal_bank = $data6['opening_bal'];

                $sql5=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_at_bank FROM `tbl_trans_detail` WHERE LEFT(acode, 6) IN ('100700')");

                $data5=mysqli_fetch_assoc($sql5);
                $cash_at_bank = $data5['cash_at_bank'];
              ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <form action="operations/add_cash_payment.php" method="post" enctype="multipart/form-data">
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
                                  
                                       <label>Voucher Date *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">  
                                        <?php if($userid=='1'){?> 
                                     <input type="date" name="payment_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php if($payment_date){echo $payment_date;}else{?><?php echo $date;} ?>" >
                                    <?php }
                                    else if($P=='1' && $userid!='1')
                                   {?>      
                                        <input type="date" name="payment_date" id="process_date"   class="form-control" placeholder="Manual Invoice Date"  value="<?php if($payment_date){echo $payment_date;}else{?><?php echo $date;} ?>" >
                                    <?php }else {?>
                                        <input type="date" name="process_date" id="process_date"   class="form-control" placeholder="Manual Invoice Date"  value="<?php if($payment_date){echo $payment_date;}else{?><?php echo $date;} ?>" min="<?php echo date('Y-m-d'); ?>">
                                    <?php }?>       
                                       
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                        <input type="hidden" name="total" id="total" value="<?php echo $total;?>">
                                </div>
                              </div>
                                </div>
                                 <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Voucher Type *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control location"  name="voucher_type" id="voucher_type" onchange="get_balance1();">
                                          <option value="" selected="">Choose one</option>
                                          <option value="CP">Cash Payment</option>
                                          <option value="CR">Cash Receipt</option>
                                          <option value="BP">Bank Payment</option>
                                          <option value="BR">Bank Receipt</option>
                                        </select>
                                </div>
                              </div>
                                </div> 
                                 <div class="col-md-4 col-sm-12" style="display: none;" id="cash">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Cash in Hand *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="cash_in_hand" id="cash_in_hand" required="" readonly="" class="form-control" placeholder="Cash in Hand"  value="<?php echo round($cash_now); ?>">
                            
                                </div>
                              </div>
                                </div>  
                                 
                                <div class="col-md-4 col-sm-12" style="display: none" id="bank_name">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Bank Name *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                       <select class="form-control"  name="bank_id" id="bank_id" onchange="get_bank_balance();">
                                   
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
                                </div>   
                                <div class="col-md-4 col-sm-12" style="display: none" id="bank">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Cash at Bank *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="cash_at_bank" id="cash_bank" required="" readonly="" class="form-control" placeholder="Cash at Bank"  value="<?php echo round($cash_at_bank+$opening_bal_bank); ?>">
                            
                                </div>
                              </div>
                                </div>
                                 <div class="col-md-4 col-sm-12" style="display: none" id="check">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Check No *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                       <input type="text" class="form-control" id="check_no" name="check_no"  placeholder="Check No" autocomplete="off" value="<?php echo $check_no;?>">
                            
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
                      <th style="width:15%">Balance</th>
                      <th style="width:40%">Narration</th>
                      <th style="width:15%">Amount</th>
 
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php
              $acc_query="SELECT acode,aname FROM tbl_account where acode not in ('200200000', '100200000') UNION SELECT acode,aname FROM tbl_account_lv2";
          if($edit_id!='')
          {


                $lsql=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where invoice_no='Cash_Payment_".$edit_id."' and c_amount='0'");
                $i=0;
                while($data=mysqli_fetch_assoc($lsql))
                {
                        $i++;
                   
                        $d_amount = $data['d_amount'];
                        $narration = $data['narration'];
                        $acode = $data['acode'];
               

              
              ?>
                     <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group acc" data-row-id="row_<?php echo $i;?>" id="account_<?php echo $i;?>" name="account[]" style="width:100%;"  required onchange="get_balance(<?php echo $i;?>);">
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
                        <td><input type="text" name="balance[]" id="balance_<?php echo $i;?>" class="form-control"  value="<?php echo $balance;?>" readonly tabindex="-1"></td>
                        <td><input type="text" name="narration[]" id="narration_<?php echo $i;?>" class="form-control"  value="<?php echo $narration;?>"></td>
                        <td>
                          <input type="text" name="debit[]" id="debit_<?php echo $i;?>" class="form-control calculate" required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $d_amount;?>">

                          
                        </td>
                   
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php } }else { $i=1;?>
                       <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control select_group acc" data-row-id="row_<?php echo $i;?>" id="account_<?php echo $i;?>" name="account[]" style="width:100%;"  required onchange="get_balance(<?php echo $i;?>);">
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
                        <td><input type="text" name="balance[]" id="balance_<?php echo $i;?>" class="form-control "  readonly tabindex="-1"></td>
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
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

get_balance1();
 function get_balance1()
 {
  var voucher_type=$('#voucher_type').val();
  if(voucher_type=='CP' || voucher_type=='CR')
  {
    $('#cash').show();
    $("#bank").hide();
    $("#bank_name").hide();
    $("#check").hide();
  }
 else if(voucher_type=='BP' || voucher_type=='BR')
 {
    $('#cash').hide();
    $("#bank").show();
    $("#bank_name").show();
    $("#check").show();
 }
 else
 {
    $('#cash').hide();
    $("#bank").hide();
    $("#bank_name").hide();
    $("#check").hide();
 }

 }

</script>

<script type="text/javascript">
    get_bank_balance();
  function get_bank_balance()
 {
  var bank_id=$("#bank_id").val();

  var dataString = 'bank_id='+ bank_id;

    $.ajax({
type: "POST",
url: "operations/get_bank_balance.php",
data: dataString,

success: function(responce){
  $("#cash_bank").val('');
  $("#cash_bank").val(responce);

}
});

}


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

var voucher_type=$('#voucher_type').val();
if(voucher_type=='CP' )
  {
var cash_in_hand=$("#cash_in_hand").val();

if(Number(totalSubAmount)>Number(cash_in_hand))
{
  alert('Please Enter Amount Less than Cash in hand..');
  return false;
}
}
  if(voucher_type=='BP')
  {
var cash_at_bank=$("#cash_bank").val();

if(Number(totalSubAmount)>Number(cash_at_bank))
{
  alert('Please Enter Amount Less than Cash at bank..');
  return false;
}
// var check_no=$("#check_no").val();
// if(check_no=='' || check_no==0 || isNaN(check_no))
// {
//   alert('Please Enter Check No..');
//   return false;
// }
}
$("#total").val(totalSubAmount);


 });
});
</script> 
<script type="text/javascript">
  
  $(document).ready(function() {
    $(".acc").select2();



    $("#add_row").unbind('click').bind('click', function() {
       
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
  

               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group acc"  data-row-id="row_1" id="account_'+row_id+'" name="account[]" style="width:100%;"  required onchange="get_balance('+row_id+')"><option selected="selected">Choose one</option><?php  
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
                    '<td><input type="text" name="balance[]" id="balance_'+row_id+'" required readonly tabindex="-1" class="form-control" ></td>'+
                    '</td>'+ 
                    '<td><input type="text" name="narration[]" id="narration_'+row_id+'" required class="form-control" ></td>'+
                    '<td><input type="number" name="debit[]" id="debit_'+row_id+'" required  onchange="getTotal('+row_id+')" class="form-control"></td>'+
                    
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    var tableProductLength = $("#product_info_table tbody tr").length;
                    var account=$("#account_"+count_table_tbody_tr).val();
                    var debit=$("#debit_"+count_table_tbody_tr).val();

                  
                    
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
                      
                    else
                    {
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
 
function get_balance(row = null)
{


                      
                        var errorCounterDupInput = 0;
                        var product_ids = [];
                        $(".acc").each(function (i, el1) {

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

                      alert('Account Already Added..!');
                      //$("#product_info_table tbody tr:last").remove();
                      $("#product_info_table tbody tr#row_"+row).remove();
                       return false;
                    }


var account=$("#account_"+row).val();

  $.ajax({
                url: "operations/get_balance.php",
                type: "POST",
                data: {
                    account : account
                },
                
                success: function(dataResult){
                  
                    $("#balance_"+row).val(dataResult);                     
                }
            });

}
  function getTotal(row = null) {

    if(row) {
        var voucher_type=$('#voucher_type').val();
        var debit=$("#debit_"+row).val();
        var balance=$("#balance_"+row).val();
       
        // if(voucher_type=='CR' || voucher_type=='BR')
        //  {
        //     if(Number(balance)<Number(debit))
        //     {
        //         $("#no-balance").show();
        //         $("#no-balance").fadeTo(4000, 500).slideUp(500, function() {
        //           $("#no-balance").slideUp(500);
        //         });
        //         $("#debit_"+row).val('');
        //         return false;
        //     }
        //  }

    } else {
      alert('no row !! please refresh the page');
    }
  }


  function subAmount() {




  } 

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }




</script>
</body>

</html>
