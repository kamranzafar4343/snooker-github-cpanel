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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Create New Sale</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Sale</li>
                            <li class="breadcrumb-item active">Add Sale</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <?php
             
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
              } ?>
              <?php
              
                         if(isset($_GET['notes']) && $_GET['notes']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Notese has been Added.
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
              }
              ?>
              <?php
               if(isset($_GET['editid']))
              {
                $edit_id=$_GET['editid'];
                $sql = mysqli_query($conn,"SELECT * FROM tbl_installment_payment where payment_id='$edit_id'");  
                while($pdata = mysqli_fetch_assoc($sql))   
                { 
                $customer=$pdata['customer'];
                $plan_id=$pdata['plan_id'];
                $installment_number=$pdata['installment_number'];
                $avo=$pdata['avo'];
                $mo=$pdata['mo'];
                $sales_men=$pdata['sales_men'];
                $per_month_payment=$pdata['per_month_amount'];
                $invoice_date=$pdata['created_date'];
                $sql = mysqli_query($conn,"SELECT * FROM tbl_installment where plan_id='$plan_id'");  
                $vdata = mysqli_fetch_assoc($sql);
                $item_id=$pdata['item_id'];
                }
              }



              ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                   <form action="operations/installment_edit.php" method="post" enctype="multipart/form-data">
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

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Process Date *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="date" name="invoice_date" required=""  class="form-control" placeholder="Manual Invoice Date"  value="<?php echo $invoice_date; ?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Payment Method *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control show-tick" required id="sale_type" name="sale_type" onchange="get_details()">
                                       
                                            <option value="InstallmentPayment" selected="">Installment Payment</option>
                                        </select>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                </div>
                              </div>
                                </div> 
                                 <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Customer </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class=" form-control Installment_id"  id="Installment_id" name='customer'>
                                   
                                      <?php
                                           $sql="SELECT customer_id,username  FROM tbl_customer where customer_id='$customer'";
                                           
                                            foreach ($conn->query($sql) as $row){
                                            
                                            echo "<option value=$row[customer_id] selected>$row[username]</option>"; 
                                          
                                            }

                                             echo "</select>";
                                             ?>
                                        
                                    </select>
                                    <input type="hidden" name="plan_id" id="plan_id" value="<?php echo $plan_id;?>">
                                </div>
                              </div>
                                </div>
                                  <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client CNIC </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="client_cnic" readonly="" id="client_cnic" class="form-control" placeholder="Client CNIC"  value="">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Mobile </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="mobile_no1" readonly="" id="client_mobile_no" class="form-control" placeholder="Client Mobile"  value="">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Email </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="email" readonly="" id="client_email" class="form-control" placeholder="Client Email"  value="">
                                </div>
                              </div>
                                </div>
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Address</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="client_address" readonly="" id="client_address" class="form-control" placeholder="Client Address"  value="">
                                </div>
                              </div>
                                </div>
                               <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Sales Man</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class=" form-control"  id="sales_men" name='sales_men'>
                                      <option value="">-- Choose one --</option>
                                        
                                    </select>
                               
                                </div>
                              </div>
                                </div>
                                 <div class="col-md-3 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>MO</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class=" form-control mo"  id="mo" name='mo'>
                                      <option value="">-- Choose one --</option>
                                        
                                    </select>
                               
                                </div>
                              </div>
                                </div>
                                 <div class="col-md-3 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>AVO</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group"> 
                               
                                  <input type="hidden" name="avo_per_amt" id="avo_per_amt"  class="form-control">    
                                      
                                        <select class=" form-control avo"  id="avo" name='avo'>
                                      <option value="">-- Choose one --</option>
                                        
                                    </select>
                               
                                </div>
                              </div>
                                </div>
                            
                         
                             
                                <div class="col-md-3 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Product </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control" id="product_name" name="product_name" >
                                           
                                            <option value="">-- Choose one --</option>
                                            <?php
                                           $sql="SELECT item_id,item_name  FROM tbl_items where item_id='$item_id'";
                                           
                                            foreach ($conn->query($sql) as $row){
                                            
                                            echo "<option value=$row[item_id] selected>$row[item_name]</option>"; 
                                          
                                            }

                                             echo "</select>";
                                             ?>
                                        </select>
                                </div>
                              </div>
                                </div>
                                   <div class='col-md-3 col-sm-12 Installmentproduct'>
                                    <div class='col-md-12 col-sm-12 text-left'>
                                  <label>For Month</label>
                                </div>
                                <div class='col-md-12 col-sm-12' >
                                    <div class="form-group">
                                        <select class="form-control" id="installment_month" name="installment_month" onchange="get_installment_price()" style="width:100%;">
                                          <?php
                                           
                                           
                                            for ($month = 1; $month <= 12; $month++) {
                                            if($month==$installment_number)
                                            {
                                            echo "<option value=$month selected>$month month</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$month>$month month</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                    
                                             ?>
                                            
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
                                 <div class="col-md-4 col-sm-12">
                                  <div class='col-md-8 col-sm-4' style="padding-top: 19%;padding-bottom: 2px;">
                                  
                                      </div>
                                      <div class='col-md-12 col-sm-4'>

                              </div>
                                </div>
                                                
                            </div><br>
    

                            <div class="row clearfix" >           

                

                  <div class="col-md-6 col-xs-12 pull pull-right" style="display: none" id="Installmentdetail">
         
             
                  <div class="form-group">

                    <label for="per_month_payment" class="col-sm-5 control-label">Installment Payment </label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control"  name="per_month_payment" id="per_month_payment"  autocomplete="off" value="<?php echo $per_month_payment;?>" >
                      <input type="hidden" name="one_month_payment" id="one_month_payment">
                      <input type="hidden" name="per_payment" id="per_payment" value="<?php echo $per_month_payment;?>" >
                    </div>
                    <label for="per_month_payment" class="col-sm-5 control-label">Payment Pending</label>
                    <div class="col-sm-7">

                      <input type="text" class="form-control" readonly="" id="remaining" value="<?php echo $remaining;?>" >
                  
                    </div>
                  </div>
                
                 

                </div>
                 <div class="col-sm-12">
                                    <div class="mt-4">
    
                                        <button type="submit" class="btn btn-primary submit">Update</button>

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
  if(sale_type=='InstallmentPayment')
  {
    var payment_id=<?php echo $edit_id;?>;

    $.ajax({
                  method: "POST",
                  url: "operations/edit_installment.php",
                  data: {payment_id:payment_id},
                  dataType: 'json',
                                
                })
                .done(function(response){

                   
                   var len = response.length;
              
                    $("#customer").hide();
                    $("#Installment").show();
                    $("#product_info_table").hide();
                    $("#creditpayment").hide();
                    $("#Installmentdetail").show();
                    $(".Installmentproduct").show();
                   
                    
                       $("#Installment_id").empty();
                       $("#sales_men").empty();
                       $("#avo").empty();
                       $("#mo").empty();
                        for( var i = 0; i<len; i++){
                            var customer_id = response[i]['customer_id'];
                            var username = response[i]['username'];
                            var salesman_id = response[i]['salesman_id'];
                            var salesman = response[i]['salesman'];
                            var avo_id = response[i]['avo_id'];
                            var avoname = response[i]['avoname'];
                            var mo_id = response[i]['mo_id'];
                            var moname = response[i]['moname'];
                        
                            

                            $("#Installment_id").append("<option value='"+customer_id+"'>"+username+"</option>");
                            $("#sales_men").append("<option value='"+salesman_id+"'>"+salesman+"</option>");
                            $("#avo").append("<option value='"+avo_id+"'>"+avoname+"</option>");
                            $("#mo").append("<option value='"+mo_id+"'>"+moname+"</option>");

                        }
           
               getprice();
                });
                
  }
 }
      //       function getproduct(){

    
   
      //   var Installment_id=$("#Installment_id").val();
    

      // $.ajax({
      //             method: "POST",
      //             url: "operations/get_installmentprice.php",
      //             data: {Installment_id:Installment_id},
      //             dataType: 'json',                 
      //           })
      //           .done(function(response){
      //              var len = response.length;

      //               $("#product_name").empty();
      //                $("#Installment_detail").show();
      //                     for( var i = 0; i<len; i++){
      //                       var id = response[i]['item_id'];
      //                       var item_serial = response[i]['item_serial'];
      //                       var barcode = response[i]['barcode'];
      //                       var item_name = response[i]['item_name'];
      //                       var plan_id = response[i]['plan_id'];
      //                       var sale_price = response[i]['sale_price'];

      //                       $("#plan_id").val(plan_id);
      //                       $("#total_amount").val(sale_price);
      //                       $("#product_name").append("<option value='"+id+"'>"+item_name+ ' (' + barcode + ')' + ' (' + item_serial + ')'+"</option>");

      //                   }
      //      getprice();

                    
      //           });

      //   }
</script>

<script type="text/javascript">
                    function getprice(){

    
  
        var product_name=$("#product_name").val();
        var Installment_id=$("#Installment_id").val();

      $.ajax({
                  method: "POST",
                  url: "operations/get_edit_installment_detail.php",
                  data: {product_name:product_name, Installment_id:Installment_id},
                  dataType: 'json',                
                })
                .done(function(response){

                  var len = response.length;

                          for( var i = 0; i<len; i++){
                            var plan_id = response[i]['plan_id'];
                            var per_month_amount = response[i]['per_month_amount'];
                            var avo_per_amt = response[i]['avo_per_amt'];
                            var remaining = response[i]['remaining'];
                          
                            $("#remaining").val(remaining);
                            $("#avo_per_amt").val(avo_per_amt);
                            $("#plan_id").val(plan_id);
                           // $("#per_month_payment").val(per_month_amount);
                            $("#one_month_payment").val(per_month_amount);
                         

                        }
                
                });

        }




</script>

<script type="text/javascript">
$(function() {
$(".submit").click(function() {


 var sale_type=$('#sale_type').val();
if(sale_type=='InstallmentPayment')
 {
  var remaining=$('#remaining').val();
var per_month_payment=$('#per_month_payment').val();
var per_month_payment1=Math.round(per_month_payment);

if(Number(per_month_payment1)>Number(remaining))
{
  alert('Opps! Amount Recieved must not be greater than Total amount..!');
    $('#amount_recieved').val('');
    $('#amount_recieved').focus();

return false;
}
  

 }




 });
});
</script> 
<script type="text/javascript">
  
  $(document).ready(function() {
    $(".select_group").select2();
    $("#credit").select2();
    $("#avo").select2();
    $("#mo").select2();
    $("#sales_men").select2();
    $("#Installment_id").select2();
    $("#product_name").select2();
    

    $("#add_row").unbind('click').bind('click', function() {
       
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
  
    var gross_amount=$('#gross_amount').val();
  if(gross_amount=='' || gross_amount=='0.00' || isNaN(gross_amount))
  {
    alert('Opps! Product or Qty Missing..!');
    
    $('.select_group').select2('focus');
$('.select_group').select2('open');
return false;
    
  }

            
              // console.log(reponse.x);
               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control select_group product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required onchange="get_price('+row_id+')"><option selected="selected">Choose one</option><?php $sql="SELECT item_name,id,item_model  FROM tbl_items"; 
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
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'" required class="form-control" onkeyup="getTotal('+row_id+') onclick="select()""></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'" tabindex="-1" class="form-control" readonly onkeyup="getTotal('+row_id+')" ></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" readonly tabindex="-1"></td>'+
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

    // sub total
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
url: "operations/get_price.php",
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

         function get_customer_detail(){

    var customer_id = $('#Installment_id').val();

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
