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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Out</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Stock</li>
                            <li class="breadcrumb-item active">Add Stock Out</li>
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
                do {
                $stk_unique=uniqid('STB_');
                $sql_check=mysqli_query($conn, "SELECT invoice_no FROM tbl_purchase_req WHERE invoice_no='$stk_unique'");
                } while(mysqli_num_rows($sql_check) > 0);

              if(isset($_GET['edit_id']))
              {

                $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_sale where sale_id=$edit_id");

                $data=mysqli_fetch_assoc($sql);
                        $sale_type = $data['sale_type'];
                        $customer_name = $data['customer_name'];
                    
                        $net_amount = $data['net_amount'];
                        $gross_amount = $data['gross_amount'];
                        $discount = $data['discount'];
                        $amount_recieved = $data['amount_recieved'];
                        $invoice_date = $data['created_date'];
                        $remarks = $data['remarks'];
              }

              ?>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <?php
              

              if(isset($_GET['add']) && $_GET['add']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great!</strong> Client Added Succesfully.
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
                   <form action="operations/branch_out.php" method="post" enctype="multipart/form-data">
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
                                        <select class="form-control location "  name="location">
                            
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
                                              $sql="SELECT * FROM users where user_id!='$userid' and user_privilege='branch'";
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
                                        <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id;?>">
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Transfer Date *</label>
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
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>STB #</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group"> 
                        
                                     <input type="text" name="invoice_no" required=""  readonly="" class="form-control"  value="<?php echo $stk_unique; ?>" >
                                    
                                </div>
                              </div>
                                </div>
                               <div class="col-md-6 col-sm-12" >

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Remarks *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea name="po_remarks" required=""  class="form-control"  row="1" id="po_remarks"><?php echo $po_remarks; ?></textarea>
                                </div>
                              </div>
                                </div> 
                                <div class="col-md-6 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Narration </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea  name="remarks" id="remarks" class="form-control" placeholder="Narration"  value=""><?php echo $remarks;?></textarea>
                                </div>
                              </div>
                                </div>
                                                
                            </div><br>
    

                            <div class="row clearfix" >           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:40%">Product</th>
                      <th style="width:15%">Item Serial</th>
                      <th style="width:10%">Item Barcode</th>
                      <th style="width:5%">Stock</th>
                      <th style="width:5%">Qty</th>
                      <th style="width:10%" hidden>Cash Rate</th>
                      <th style="width:20%" hidden>Installment Rate</th>
                      <th style="width:10%"><button type="button" id="add_row" class="btn btn-default"><i class="fa fa-plus"></i></button></th>
                    </tr>
                  </thead>

                   <tbody>

                    <?php
                    
                     $sql="SELECT branch_id,created_by, user_privilege  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                                $user_privilege = $data['user_privilege'];
                                               }
if($user_privilege!='branch' && $created_by=='1')
                            {

                    $item_query="SELECT * FROM tbl_purchase_detail INNER JOIN tbl_items ON tbl_purchase_detail.product = tbl_items.item_id  WHERE
 pur_item_id NOT IN (SELECT 
        tbl_sale_detail.pur_item_id
    FROM
        tbl_purchase_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_purchase_detail.pur_item_id = tbl_sale_detail.pur_item_id)
 AND pur_item_id NOT IN (SELECT 
        tbl_installment.pur_item_id
    FROM
        tbl_purchase_detail
            INNER JOIN
        tbl_installment  ON tbl_purchase_detail.pur_item_id = tbl_installment.pur_item_id)
   
   AND pur_item_id NOT IN (SELECT 
        tbl_purchase_return_detail.pur_item_id
    FROM
        tbl_purchase_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_purchase_detail.pur_item_id = tbl_purchase_return_detail.pur_item_id)
  AND tbl_purchase_detail.qty_rec!='' and tbl_purchase_detail.transfer='0' and tbl_purchase_detail.iemi='0' and tbl_purchase_detail.parent_id='$created_by' "; 


                     
                         $return_query="SELECT * FROM tbl_purchase_detail INNER JOIN tbl_items ON tbl_purchase_detail.product = tbl_items.item_id   WHERE
                                  pur_item_id IN (SELECT 
                                    tbl_sale_return_detail.pur_item_id
                                 FROM
                                    tbl_purchase_detail
                                        INNER JOIN
                                  tbl_sale_return_detail  ON tbl_purchase_detail.pur_item_id = tbl_sale_return_detail.pur_item_id where tbl_sale_return_detail.sold='0' and tbl_sale_return_detail.iemi='0' and tbl_sale_return_detail.returned='1' and tbl_sale_return_detail.parent_id='$created_by')";
                                }
  else
  {
    if($user_privilege=='branch')
    {
      $created_by=$userid;
    }
    else
    {
      $created_by=$created_by;
    }
                        $item_query="SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id  WHERE
pur_item_id NOT IN (SELECT 
        tbl_sale_detail.pur_item_id
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_sale_detail.pur_item_id)
 AND pur_item_id NOT IN (SELECT 
        tbl_installment.pur_item_id
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_installment  ON tbl_purchase_req_detail.pur_item_id = tbl_installment.pur_item_id)
   AND pur_item_id NOT IN (SELECT 
        tbl_purchase_return_detail.pur_item_id
    FROM
        tbl_purchase_req_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_purchase_return_detail.pur_item_id)
  AND tbl_purchase_req_detail.recieved!='0' and tbl_purchase_req_detail.transfer='0' and tbl_purchase_req_detail.iemi='0' and tbl_purchase_req_detail.parent_id='$created_by' "; 



                     
                         $return_query="SELECT * FROM tbl_purchase_req_detail INNER JOIN tbl_items ON tbl_purchase_req_detail.product = tbl_items.item_id   WHERE
                                  pur_item_id IN (SELECT 
                                    tbl_sale_return_detail.pur_item_id
                                 FROM
                                    tbl_purchase_req_detail
                                        INNER JOIN
                                  tbl_sale_return_detail  ON tbl_purchase_req_detail.pur_item_id = tbl_sale_return_detail.pur_item_id where tbl_sale_return_detail.sold='0' and tbl_sale_return_detail.returned='1' and tbl_sale_return_detail.iemi='0') and tbl_purchase_req_detail.parent_id='$created_by'";

  }

          if($edit_id!='')
          {


                $lsql=mysqli_query($conn, "SELECT * FROM tbl_sale_detail where sale_id=$edit_id");
                $i=0;
                while($data=mysqli_fetch_assoc($lsql))
                {
                        $i++;
                        $qty = $data['qty'];
                        $rate = $data['rate'];
                        $amount = $data['amount'];
                        $product = $data['product'];
                        $item_serial = $data['item_serial'];
                        $pur_item_id = $data['pur_item_id'];
                        $barcode = $data['barcode'];
                         $sql5=mysqli_query($conn, "SELECT rate FROM tbl_purchase_detail where pur_item_id='$pur_item_id' and product='$product'");
               
                        $data=mysqli_fetch_assoc($sql5);
                
                        $rate_max = $data['rate'];
                        
               

              
              ?>
                     <tr id="row_<?php echo $i;?>">
                       <td>
                                                             <select class="form-control product" readonly="" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)" >
                                        
                                        <?php

                                        
 $sql="SELECT * FROM tbl_sale_detail INNER JOIN tbl_items ON tbl_sale_detail.product = tbl_items.item_id";

foreach ($conn->query($sql) as $row){
$brand_id=$row['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
if($row['item_id']==$product  && $row['pur_item_id']==$pur_item_id){

echo "<option value=$row[item_id]".",$row[barcode]".",$row[item_serial]".",$row[pur_item_id] selected>$brand_name $row[item_name] "." $row[barcode] "." $row[item_serial] "." $row[pur_item_id]</option>"; 

}

}

 echo "</select>";
 ?>
</select>

                       
                        </td>
                         <td><input type="text" name="item_serial[]" id="item_serial_<?php echo $i;?>"  class="form-control calculate" readonly  value="<?php echo $item_serial;?>"></td>
                          <td><input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control calculate" readonly  value="<?php echo $barcode;?>"></td>
                          <td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_<?php echo $i;?>"  readonly class="form-control" value="<?php echo $pur_item_id;?>"></td>
                        <td><input type="text" name="stock_qty[]" id="stock_qty_<?php echo $i;?>"  class="form-control calculate" readonly value="<?php echo $qty;?>"></td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>" class="form-control calculate" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $qty;?>"></td>
                        <td>
                          
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>" class="form-control calculate" required autocomplete="off" onchange="check_price(<?php echo $i;?>)" value="<?php echo $rate;?>">

                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>"  class="form-control" tabindex="-1" autocomplete="off" readonly="" value="<?php echo $amount;?>">
                          
                        </td>
                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php } }else { $i=1;?>
                       <tr id="row_<?php echo $i;?>">
                       <td>
                       <select class="form-control product" data-row-id="row_<?php echo $i;?>" id="product_<?php echo $i;?>" name="product[]" style="width:100%;"  required onchange="get_price(<?php echo $i;?>)">
                                        <option selected="selected" value="">Choose one</option>
                                       <?php

                                    


foreach ($conn->query($item_query) as $row){
    $brand_id=$row['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
  if($row[barcode]!=0)
  {
    $barcode=$row[barcode];    
  }
  else
  {
    $barcode=""; 
  }
  if($row[item_serial]!=0)
  {
    $item_serial=$row[item_serial];    
  }
  else
  {
    $item_serial=""; 
  }
$item_id=$row[item_id];
echo "<option value=$row[item_id]".",$row[barcode]".",$row[item_serial]".",$row[pur_item_id]>$brand_name $row[item_name] $barcode $item_serial $row[pur_item_id]</option>"; 
}


foreach ($conn->query($return_query) as $row1){
    $brand_id=$row1['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
  if($row1[barcode]!=0)
  {
    $barcode1=$row1[barcode];    
  }
  else
  {
    $barcode1=""; 
  }
  if($row1[item_serial]!=0)
  {
    $item_serial1=$row1[item_serial];    
  }
  else
  {
    $item_serial1=""; 
  }
echo "<option value=$row1[item_id]".",$row1[barcode]".",$row1[item_serial]".",$row1[pur_item_id]>$brand_name $row1[item_name] $barcode1 $item_serial1 $row1[pur_item_id]</option>"; 

}


 echo "</select>";

 ?>
</select> 

                       
                        </td>
                        <td><input type="text" name="item_serial[]" id="item_serial_<?php echo $i;?>"  class="form-control calculate" readonly></td>
                        <td><input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control calculate" readonly ></td>
                        <td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_<?php echo $i;?>"  readonly class="form-control"></td>
                        <td><input type="text" name="stock_qty[]" id="stock_qty_<?php echo $i;?>"  class="form-control calculate" readonly onkeyup="getTotal(<?php echo $i;?>)" value=""></td>
                        <td><input type="text" name="qty[]" readonly id="qty_<?php echo $i;?>"  class="form-control calculate" ></td>
                        <td hidden>
                          
                          <input type="text" name="cash_rate[]" id="cash_rate_<?php echo $i;?>"  class="form-control calculate"  required  autocomplete="off">
                          
                        </td>
                        <td hidden>
                            <input type="text" name="inst_rate[]" id="inst_rate_<?php echo $i;?>"  class="form-control calculate"  required  autocomplete="off">
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" tabindex="-1" class="form-control"  autocomplete="off" readonly="" >
                          
                        </td>

                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php }?>
                   </tbody>
                </table>
                
              
              

                


           
        
                <div class="col-md-12 col-xs-12 pull pull-right" id="creditpayment" hidden="">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" tabindex="-1" name="gross_amount" readonly="" autocomplete="off" value="<?php echo $gross_amount;?>">
                      
                    </div>
                  </div>
       
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" tabindex="-1" name="net_amount" readonly=""  autocomplete="off" value="<?php echo $net_amount;?>">
                    </div>
                  </div>
                  
                </div>


                  <div class="col-md-6 col-xs-12 pull pull-right" style="display: none" id="Installmentdetail">
         
             
                  <div class="form-group">
                    <label for="per_month_payment" class="col-sm-5 control-label">Payment Recieved</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" readonly="" id="per_month_payment" name="per_month_payment"  autocomplete="off" value="<?php echo $per_month_payment;?>">
                      <input type="hidden" name="one_month_payment" id="one_month_payment">
                      <input type="hidden" name="total_amount" id="total_amount">
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


 });
});
</script> 
<script type="text/javascript">
  
  $(document).ready(function() {
    $(".product").select2();
    $(".location").select2();
    $("#credit").select2();
    $("#Installment_id").select2();
    $("#product_name").select2();
    $("#sales_men").select2();


    $("#add_row").unbind('click').bind('click', function() {
      
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
  

               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required onchange="get_price('+row_id+')"><option selected="selected" value="">Choose one</option><?php  
foreach ($conn->query($item_query) as $row){
    $brand_id=$row['brand_id'];
    $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
    $value2 = mysqli_fetch_assoc($sql2);
    $brand_name=$value2['cat_name'];
  if($row[barcode]!=0)
  {
    $barcode=$row[barcode];    
  }
  else
  {
    $barcode=""; 
  }
  if($row[item_serial]!=0)
  {
    $item_serial=$row[item_serial];    
  }
  else
  {
    $item_serial=""; 
  }
$item_id=$row[item_id];
echo "<option value=$row[item_id]".",$row[barcode]".",$row[item_serial]".",$row[pur_item_id]>$brand_name $row[item_name] $barcode $item_serial $row[pur_item_id]</option>"; 
}


foreach ($conn->query($return_query) as $row1){
  if($row1[barcode]!=0)
  {
    $barcode1=$row1[barcode];    
  }
  else
  {
    $barcode1=""; 
  }
  if($row1[item_serial]!=0)
  {
    $item_serial1=$row1[item_serial];    
  }
  else
  {
    $item_serial1=""; 
  }
echo "<option value=$row1[item_id]".",$row1[barcode]".",$row1[item_serial]".",$row1[pur_item_id]>$brand_name $row1[item_name] $barcode1 $item_serial1 $row1[pur_item_id]</option>"; 

}

 echo "</select>";
 ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="item_serial[]" id="item_serial_'+row_id+'" required readonly class="form-control"></td>'+
                    '<td><input type="number" name="barcode[]" id="barcode_'+row_id+'" required readonly class="form-control"></td>'+
                    '<td hidden><input type="number" name="pur_item_id[]" id="pur_item_id_'+row_id+'" required readonly class="form-control"></td>'+
                    '<td><input type="number" name="stock_qty[]" id="stock_qty_'+row_id+'" required readonly class="form-control" value=""></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'"  readonly required class="form-control" onchange="getTotal('+row_id+')"></td>'+
                    '<td hidden><input type="text" name="cash_rate[]" id="cash_rate_'+row_id+'" readonly class="form-control"></td>'+
                    '<td hidden><input type="text" name="inst_rate[]" id="inst_rate_'+row_id+'" readonly class="form-control" readonly tabindex="-1"><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" readonly tabindex="-1"></td>'+
                    '<td><button type="button" class="btn btn-default " id="remove_'+row_id+'" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    var tableProductLength = $("#product_info_table tbody tr").length;
                    var product=$("#product_"+tableProductLength).val();
                  
                var total=$("#amount_"+count_table_tbody_tr).val();
         
                    if(total=='' || total=='0.00')
                    {
                      alert("Opps!  Some information is missing..");
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

  }); 

  function getTotal(row = null) {

    if(row) {

        var qty=$("#qty_"+row).val();
         var stock_qty=$("#stock_qty_"+row).val();

      if(Number(qty)>Number(stock_qty))
      {
        alert("Quantity must be equal or less than stock qty..!");
        $("#qty_"+row).val('1');
        $("#qty_"+row).focus();
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
  var location=$(".location").val();
$.ajax({
                                  method: "POST",
                                  url: "operations/get_price_branch.php",
                                  data: {itemid:itemid, location:location},
                                   dataType: 'json',              
                                })
                                .done(function(response){
                        

                                    if(response==null)
                                   {
                                    $("#stock_qty_"+count).val('');
                                    $("#stock_qty_"+count).val('0');
                                   }
                                   else
                                   {
                                    $("#stock_qty_"+count).val('1');
                                   
                                   }
                                   var len = response.length;

                           //           $("#cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var cash_rate = response[i]['cash_price'];
                                            var inst_rate = response[i]['inst_price'];
                                            var barcode = response[i]['barcode'];
                                            var item_serial = response[i]['item_serial'];
                                            var pur_item_id = response[i]['pur_item_id'];
                                           
                               
                                             $("#qty_"+count).val(1);     
                                             $("#amount_"+count).val(inst_rate);
                                             $("#inst_rate_"+count).val(inst_rate);
                                             $("#cash_rate_"+count).val(cash_rate);
                                             $("#barcode_"+count).val(barcode);
                                             $("#pur_item_id_"+count).val(pur_item_id);
                                             $("#item_serial_"+count).val(item_serial);
                                            subAmount();
                                             get_stock_qty();


                                        }

                                    
                                })
}

  var edit_id=$("#edit_id").val();
if(edit_id!='')
{
get_stock_qty();
}
  function get_stock_qty()
 {

    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
     
    var edit_id=$("#edit_id").val();

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      var itemid=$("#product_"+count).val();
      } 
if(itemid!='')
{

  var dataString = 'itemid='+ itemid;

    $.ajax({
type: "POST",
url: "operations/get_stock_sale.php",
data: dataString,

success: function(responce){
//alert(responce);
if(responce=='0')
{


    if(edit_id=='')
    {
      alert('Stock is Empty..!');
       $("#product_info_table tbody tr#row_"+count).remove();
      subAmount();
    }
    else
    {
       alert('Stock is Empty..!');
       $("#product_info_table tbody tr#row_"+count).remove();
      subAmount();
    }
}
else
{
    if(edit_id=='')
    {
     $("#stock_qty_"+count).val(responce);
    }
    else
    {

        var qty = $("#qty_"+count).val();
       
        var stock=Number(responce)+Number(qty);
        $("#stock_qty_"+count).val(qty);
    }
}
}
});
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
