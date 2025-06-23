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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New JV Voucher</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">JV Voucher</li>
                            <li class="breadcrumb-item active">Add JV Voucher</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <div class="alert alert-danger" id="no-balance1" style="display: none;">
  
              <strong>Sorry !</strong> Current account balance is Zero.
            </div>
            <div class="alert alert-danger" id="no-balance" style="display: none;">
  
              <strong>Sorry !</strong> Current account balance is less Debit Amount.
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
              
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '300200100', '100100000') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];
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

                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300','300200100',  '$branch_id') and parent_id='$parent_id'");

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
                   <form action="operations/add_jv.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                             <?php
              
              if(isset($_GET['added']) && $_GET['added']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> voucher has been Added.
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
              }?>
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
                                        <select class="form-control location"  name="voucher_type" id="voucher_type" onchange="get_balance();">
                               
                                          <option value="JV">JV</option>
                                 
                                        </select>
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
    

                            <div class="row clearfix" style="overflow-x: scroll;">           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:30%">Account</th>
                      <th style="width:10%">Balance</th>
                      <th style="width:40%">Narration</th>
                      <th style="width:10%">Debit</th>
                      <th style="width:10%" hidden="">Credit</th>
                      <th style="width:10%">Action</th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php
              $acc_query="SELECT acode,aname FROM tbl_account_lv2 ";
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
                         <td><input type="text" name="balance[]" id="balance_<?php echo $i;?>" class="form-control "  value="<?php echo $balance;?>" readonly tabindex="-1"></td>
                        <td><input type="text" name="narration[]" id="narration_<?php echo $i;?>" class="form-control "  value="<?php echo $narration;?>"></td>
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

                        <td><input type="text" name="debit[]" id="debit_<?php echo $i;?>"  class="form-control calculate" required autocomplete="off" onkeyup="change_credit();" ></td>
                        <td hidden><input type="text" name="credit[]" id="credit_<?php echo $i;?>" readonly="" value="0" class="form-control calculate" required autocomplete="off" onchange="getTotal(<?php echo $i;?>)" ></td>
                        

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
                        </form>
                    </div>
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">

                        <div class="body">
                             <div class="row text-center">
                                <h5 class="text-center">Invalid Vouchers</h5>
                            </div>
                            <div class="row clearfix" style="overflow: scroll;">           
                              <table class="table table-bordered" id="product_info_table">
                                  <thead class="bg-secondary">
                                    <tr>
                                      <th style="width:10%">#</th>
                                      <th style="width:30%">Account</th>
                                      <th style="width:40%">Narration</th>
                                      <th style="width:10%">Amount</th>
                                      <th style="width:10%">Date</th>
                                      <th style="width:10%">Status</th>
                                      <th style="width:10%">Action</th>
                                    </tr>
                                  </thead>

                                    <tbody>
                                        <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_jv  where created_by='$userid' and vou_status='Invalid' order by jv_id desc");
                                        while($pdata = mysqli_fetch_assoc($sql))   
                                        { 
                                            $id=$pdata['jv_id'];
                                            $debit=$pdata['debit'];
                                            $narration=$pdata['narration'];
                                            $vou_status=$pdata['vou_status'];
                                            $created_date=$pdata['created_date'];
                                            $acc_id=$pdata['acc_id'];
                                                  
                                                $query2 = mysqli_query($conn,"SELECT aname FROM tbl_account where acode='$acc_id'"); 
                                                
                                                $zdata = mysqli_fetch_assoc($query2);
                                                 
                                                 $aname=$zdata['aname'];
                                                 if($aname=='')
                                                 {
                                                   $query3 = mysqli_query($conn,"SELECT aname FROM tbl_account_lv2 where acode='$acc_id'"); 
                                                 
                                                    $zdata = mysqli_fetch_assoc($query3);
                                                     
                                                     $aname=$zdata['aname'];
                                                 }
                                        $count++;
                                        ?>
                                        <tr>
                                            <td class="project-title" >
                                                <h6><?php echo $count;?></h6>
                                                
                                            </td>
                                            <td><?php echo $aname;?></td>
                                            <td><?php echo $narration;?></td>
                                            <td><?php echo $debit;?></td>
                                            <td><?php echo $created_date;?></td>
                                            <td><span class="badge badge-danger"><?php echo $vou_status;?></span></td>
                                            <td><a  href="add_invalid_jv.php?jv_id=<?php echo $id;?>" class="btn btn-sm btn-outline-primary" title="Complete">Complete</a></td>
                                        <tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

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
$(function() {
$(".submit").click(function() {

 var tableProductLength = $("#product_info_table tbody tr").length;
    var totaldAmount = 0;
    var totalcAmount = 0;
    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);

      totaldAmount = Number(totaldAmount) + Number($("#debit_"+count).val());
      totalcAmount = Number(totalcAmount) + Number($("#credit_"+count).val());
    } 
    var balance=$("#balance_"+count).val();
    var debit=$("#debit_"+count).val();
$('#total').val(totaldAmount);

// if(balance<=0)
// {
//   $("#no-balance1").show();
//     //$("#no-balance").hide();

//     $("#no-balance1").fadeTo(4000, 500).slideUp(500, function() {
//       $("#no-balance1").slideUp(500);
//     });
//     return false;

// }

// if(Number(balance)<Number(debit))
// {
//     $("#no-balance").show();
//     //$("#no-balance").hide();

//     $("#no-balance").fadeTo(4000, 500).slideUp(500, function() {
//       $("#no-balance").slideUp(500);
//     });
//     return false;
  
// }

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
                    '<select class="form-control select_group acc"  data-row-id="row_1" id="account_'+row_id+'" name="account[]" style="width:100%;"  required onchange="get_balance('+row_id+')"><option selected="selected" >Choose one</option><?php  
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
                     '<td><input type="text" name="balance[]" id="balance_'+row_id+'" required readonly tabindex="-1" class="form-control" ></td>'+
                    '<td><input type="text" name="narration[]" id="narration_'+row_id+'" required class="form-control"></td>'+
                    '<td><input type="number" name="debit[]" id="debit_'+row_id+'" readonly="" required  class="form-control" value="0"></td>'+
                    '<td><input type="number" name="credit[]" id="credit_'+row_id+'" required  onkeyup="change_debit();" class="form-control"></td>'+
                    '<td><button type="button" class="btn btn-default" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    
                    var tableProductLength = $("#product_info_table tbody tr").length;

                    var account=$("#account_"+count_table_tbody_tr).val();
     
                    var debit=$("#debit_"+count_table_tbody_tr).val();
                   
                    if(count_table_tbody_tr>=2)
                    {

                      alert("Please Make sure not to add more then two rows..!")
                      return false;
                    }

                  
                
                    if(account=='')
                    {
                      alert("Opps!  Please Select Account..");
                       $("#account_"+count_table_tbody_tr).select2('focus');
                      $("#account_"+count_table_tbody_tr).select2('open');
                     
                      return false;
                    }
               
                  

                    else{

                      $("#product_info_table tbody tr:last").after(html);  
                      var debit=$("#debit_"+count_table_tbody_tr).val();
                     
                      $("#credit_2").val(debit);
                  
                    }
                
              }
              else {

                  
                $("#product_info_table tbody").html(html);

              }

              $(".acc").select2();

          

      return false;
    });

  }); // /document
function get_balance()
{

var tableProductLength = $("#product_info_table tbody tr").length;
                      
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
                      $("#product_info_table tbody tr#row_"+tableProductLength).remove();
                       return false;
                    }
get_balance_1();
get_balance_2();
}

  function get_balance_1() {
    var account=$("#account_1").val();

  $.ajax({
                url: "operations/get_balance.php",
                type: "POST",
                data: {
                    account : account
                },
                
                success: function(dataResult){
                    
                    $("#balance_1").val('');
                    $("#balance_1").val(dataResult);                     
                }
            });

  }
  function get_balance_2() {
           var account=$("#account_2").val();

  $.ajax({
                url: "operations/get_balance.php",
                type: "POST",
                data: {
                    account : account
                },
                
                success: function(dataResult1){
                    
                    $("#balance_2").val('');
                    $("#balance_2").val(dataResult1);                     
                }
            });

  }



  function change_debit() {
        var credit=$("#credit_2").val();
        $("#debit_1").val(credit);

  }
  function change_credit() {
       var debit=$("#debit_1").val();
        $("#credit_2").val(debit);

  }

  function removeRow(tr_id)
  {
    $("#product_info_table tbody tr#row_"+tr_id).remove();
    subAmount();
  }


</script>
</body>

</html>
