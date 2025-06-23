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
                $sql=mysqli_query($conn, "SELECT sale_per FROM tbl_company");
      $row1 = mysqli_fetch_array($sql);
      $sale_per = $row1['sale_per'];
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
                   <form action="operations/add_local_sale.php" method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="body">
                            <div class="row clearfix"> 
                              <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Location *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   <input type="hidden" name="iemi" value="1">
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
                                  
                                       <label>Invoice Date *</label>
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
                                  
                                       <label>Payment Method *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control show-tick" required id="sale_type" name="sale_type" onchange="get_details()">
                                            <?php
                                            if($sale_type=='Cash')
                                            {
                                            echo "<option value=Cash selected>Cash</option>"; 
                                            }
                                            // if($sale_type=='Credit')
                                            // {
                                            // echo "<option value=Credit selected>Credit</option>"; 
                                            // }
                                            ?>
                                           
                                            <option value="Cash">Cash</option>
                                           <!--  <option value="Credit">Credit</option> -->
                                    <!--         <option value="Installment">Installment</option> -->
                                            
                                        </select>
                                        <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
                                </div>
                              </div>
                                </div> 
                                 <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Sale's Man *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <select class="form-control location"   required  name="sales_men" id="sales_men" name="location">
                            
                                           <?php
                                           $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege=='superadmin' || $user_privilege=='branch')
                                {
                                 
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$userid' and designation LIKE '%Salesman%'";
                                }
                                else
                                {
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$created_by' and designation LIKE '%Salesman%'";
                                }
                                             
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$vendor)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[user_name] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        
                                </div>
                              </div>
                                </div> 

                                
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                       <a href="add_clients.php?sale_type=8">
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   
                                
                                       <label>Customer Name *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                      <select class="form-control customer"  name="credit_customer" id="credit" onchange="get_customer_detail()">
                                        <option selected="selected" value="">Choose one</option>
                                          <?php

                                         $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                               
                                if($user_privilege!='branch' && $created_by=='1')
                                {
                                  
                                  $sql="SELECT * FROM tbl_customer where blacklist='0'";
                                }
                                else
                                {
                                  $sql="SELECT * FROM tbl_customer where  parent_id='$userid'  and blacklist='0'";
                                }
                                             
                                            foreach ($conn->query($sql) as $row){
                                           
                                             $address=$row['address'];
                                              $mobile_no=$row['mobile_no'];
                                              $mobile_no1=$row['mobile_no1'];
                                              $client_cnic=$row['client_cnic'];
                                              $customer_by=$row['created_by'];
                                              $sql=mysqli_query($conn, "SELECT user_name FROM users where user_id='$customer_by'");
                                              $data = mysqli_fetch_array($sql);
                                                $branchname = $data['user_name'];
                                                $iden = str_split($branchname);
                                                $iden3 = str_split($branchname,3);
                                                $iden2=end($iden3);
                                                $iden1=$iden[0];
                                               
                                            if($row['customer_id']==$customer_name)
                                            {
                                            echo "<option value=$row[customer_id] selected>$row[username] ($branchname) ($iden1$iden2"._."$row[seprate_customer_id]) ($row[mobile_no1]) ($row[client_cnic])</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[customer_id]>$row[username] ($branchname) ($iden1$iden2"._."$row[seprate_customer_id]) ($row[mobile_no1]) ($row[client_cnic])</option>"; 
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
                                <div class="col-md-4 col-sm-12" hidden="">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Email </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="email" readonly="" id="client_email" class="form-control" placeholder="Client Email"  value="">

                                </div>
                              </div>
                                </div>
                                <div class="col-md-8 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Client Address</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="client_address" readonly="" id="client_address" class="form-control" placeholder="Client Address"  value="">
                                        <input type="hidden" name="sale_perc" readonly="" id="sale_perc" class="form-control" placeholder="Client Email"  value="<?php echo $sale_per;?>">
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
                                </div>
                              </div>
                                </div>
                                                
                            </div><br>
    

                            <div class="row clearfix" >           
                              <table class="table table-bordered" id="product_info_table">
                  <thead style="background-color: orange;">
                    <tr>
                      <th style="width:40%">Product</th>
                      <th style="width:15%">Product IEMI</th>
                      <th style="width:10%" hidden>Item Barcode</th>
                      <th style="width:5%">Stock</th>
                      <th style="width:5%">Qty</th>
                      <th style="width:10%">Rate</th>
                      <th style="width:20%">Amount</th>
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
if($user_privilege!='branch'  && $created_by=='1')
                                {
                                
                    $item_query="SELECT * FROM tbl_single_purchase_detail INNER JOIN tbl_items ON tbl_single_purchase_detail.product = tbl_items.item_id  
                    WHERE
item_serial NOT IN (SELECT 
        tbl_sale_detail.item_serial
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_sale_detail  ON tbl_single_purchase_detail.item_serial = tbl_sale_detail.item_serial where tbl_sale_detail.local='1')
 AND item_serial NOT IN (SELECT  
        tbl_installment.item_serial
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_installment  ON tbl_single_purchase_detail.item_serial = tbl_installment.item_serial where tbl_installment.local='1')
   
   AND item_serial NOT IN (SELECT 
        tbl_purchase_return_detail.item_serial
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_single_purchase_detail.item_serial = tbl_purchase_return_detail.item_serial )
  AND tbl_single_purchase_detail.qty!='' and tbl_single_purchase_detail.iemi='1' and tbl_single_purchase_detail.parent_id='$created_by'"; 


                     
                         $return_query="SELECT * FROM tbl_single_purchase_detail INNER JOIN tbl_items ON tbl_single_purchase_detail.product = tbl_items.item_id   WHERE
                                  item_serial IN (SELECT 
                                    tbl_sale_return_detail.item_serial
                                 FROM
                                    tbl_single_purchase_detail
                                        INNER JOIN
                                  tbl_sale_return_detail  ON tbl_single_purchase_detail.item_serial = tbl_sale_return_detail.item_serial where tbl_sale_return_detail.sold='0' and tbl_sale_return_detail.returned='1' and tbl_sale_return_detail.iemi='1') and tbl_single_purchase_detail.parent_id='$created_by'";
}
else
{

$item_query="SELECT * FROM tbl_single_purchase_detail INNER JOIN tbl_items ON tbl_single_purchase_detail.product = tbl_items.item_id  
                    WHERE
 item_serial NOT IN (SELECT 
        tbl_sale_detail.item_serial
    FROM
        tbl_single_purchase_detail
            INNER JOIN 
        tbl_sale_detail  ON tbl_single_purchase_detail.item_serial = tbl_sale_detail.item_serial where tbl_sale_detail.local='1'  )
 AND item_serial NOT IN (SELECT  
        tbl_installment.item_serial
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_installment  ON tbl_single_purchase_detail.item_serial = tbl_installment.item_serial where tbl_installment.local='1' )
  AND item_serial NOT IN (SELECT 
        tbl_purchase_return_detail.item_serial
    FROM
        tbl_single_purchase_detail
            INNER JOIN
        tbl_purchase_return_detail  ON tbl_single_purchase_detail.item_serial = tbl_purchase_return_detail.item_serial  )
  AND tbl_single_purchase_detail.qty!='' and tbl_single_purchase_detail.iemi='1'  and tbl_single_purchase_detail.created_by='$userid'"; 


                     
                         $return_query="SELECT * FROM tbl_single_purchase_detail INNER JOIN tbl_items ON tbl_single_purchase_detail.product = tbl_items.item_id   WHERE
                                  item_serial IN (SELECT 
                                    tbl_sale_return_detail.item_serial
                                 FROM
                                    tbl_single_purchase_detail
                                        INNER JOIN
                                  tbl_sale_return_detail  ON tbl_single_purchase_detail.item_serial = tbl_sale_return_detail.item_serial where tbl_sale_return_detail.sold='0' and tbl_sale_return_detail.returned='1' and tbl_sale_return_detail.iemi='1') and tbl_single_purchase_detail.created_by='$userid'";

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
                        $barcode = $data['barcode'];
                        
               

              
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
if($row['item_id']==$product && $row['barcode']==$barcode && $row['item_serial']==$item_serial){

echo "<option value=$row[item_id]"." $row[barcode] "." $row[item_serial] selected>$brand_name $row[item_name] "." $row[barcode] "." $row[item_serial]</option>"; 

}

}

 echo "</select>";
 ?>
</select>

                       
                        </td>
                         <td><input type="text" name="item_serial[]" id="item_serial_<?php echo $i;?>"  class="form-control calculate" readonly  value="<?php echo $item_serial;?>"></td>
                          <td hidden><input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control calculate" readonly  value="<?php echo $barcode;?>"></td>
                        <td><input type="text" name="stock_qty[]" id="stock_qty_<?php echo $i;?>"  class="form-control calculate" readonly onkeyup="getTotal(<?php echo $i;?>)" value=""></td>
                        <td><input type="text" name="qty[]" id="qty_<?php echo $i;?>" class="form-control calculate" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $qty;?>"></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>" class="form-control calculate" required tabindex="-1" readonly autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" value="<?php echo $rate;?>">

                          
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
                                        <option selected="selected">Choose one</option>
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
echo "<option value=$row[item_id]".",$row[barcode]".",$row[item_serial]> $brand_name $row[item_name] $barcode $item_serial</option>"; 
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
echo "<option value=$row1[item_id]".",$row1[barcode]".",$row1[item_serial]> $brand_name $row1[item_name] $barcode1 $item_serial1</option>"; 

}


 echo "</select>";

 ?>
</select> 

                       
                        </td>
                        <td><input type="text" name="item_serial[]" id="item_serial_<?php echo $i;?>"  class="form-control calculate" readonly></td>
                        <td hidden=""><input type="text" name="barcode[]" id="barcode_<?php echo $i;?>"  class="form-control calculate" readonly ></td>
                        <td><input type="text" name="stock_qty[]" id="stock_qty_<?php echo $i;?>"  class="form-control calculate" readonly onkeyup="getTotal(<?php echo $i;?>)" ></td>
                        <td><input type="text" name="qty[]" readonly id="qty_<?php echo $i;?>"  class="form-control calculate" onchange="getTotal(<?php echo $i;?>)" ></td>
                        <td>
                          <input type="text" name="rate[]" id="rate_<?php echo $i;?>"  tabindex="-1" class="form-control calculate" readonly  required  autocomplete="off" onkeyup="getTotal(<?php echo $i;?>)" >
                          
                        </td>
                        <td>
                          <input type="text" name="amount[]" id="amount_<?php echo $i;?>" tabindex="-1" class="form-control"  autocomplete="off" readonly="" >
                          
                        </td>

                        <td><button type="button" class="btn btn-default" onclick="removeRow('<?php echo $i;?>')"><i class="fa fa-close"></i></button></td>
                     </tr>
                   <?php }?>
                   </tbody>
                </table>
                
              
              

                


           
        
                <div class="col-md-12 col-xs-12 pull pull-right" id="creditpayment">

                  <div class="form-group">
                    <label for="gross_amount" class="col-sm-5 control-label">Gross Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="gross_amount" tabindex="-1" name="gross_amount" readonly="" autocomplete="off" value="<?php echo $gross_amount;?>">
                      
                    </div>
                  </div>
       
                  <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Discount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="discount" name="discount" placeholder="Discount" onkeyup="subAmount()" autocomplete="off" value="<?php echo $discount;?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="net_amount" class="col-sm-5 control-label">Net Amount</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control" id="net_amount" tabindex="-1" name="net_amount" readonly=""  autocomplete="off" value="<?php echo $net_amount;?>">
                    </div>
                  </div>
                  <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Amount Recieved</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" id="amount_recieved" name="amount_recieved" placeholder="Amount Recieved" onkeyup="subAmount()" autocomplete="off" value="<?php echo $amount_recieved;?>">
                    </div>
                  </div>
                 <!--  <div class="form-group" id="discount1">
                    <label for="discount" class="col-sm-5 control-label">Amount Remaining</label>
                    <div class="col-sm-7">
                      <input type="text" class="form-control calculate" tabindex="-1" id="amount_remaining" name="amount_remaining"  autocomplete="off" readonly="" value="<?php echo $amount_remaining;?>">
                    </div>
                  </div> -->

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

  var sale_type=$('#sale_type').val();


 if(sale_type=='Cash')
 {

    var amount_recieved=parseFloat($('#amount_recieved').val());
    var net_amount=parseFloat($('#net_amount').val());

if(net_amount=='' || net_amount=='0' || isNAN(net_amount))
{
  alert('Opps! Please add atleast one item..!');
return false;
}
    if(amount_recieved<net_amount)
      {
        alert('Opps! Amount Recieved must be equal or greater to Total amount..!');
          $('#amount_recieved').val('');
          $('#amount_recieved').focus();

      return false;
      }
 }
var tableProductLength = $("#product_info_table tbody tr").length;
var product=$("#product_"+tableProductLength).val();

var new_qty=$("#qty_"+tableProductLength).val();

var old=tableProductLength-1;
                     
var old_product=$("#product_"+old).val();
var old_qty=$("#qty_"+old).val();


if(old_product==product)
{
alert("Item already added...!");
    var new_qty=$("#qty_"+tableProductLength).val();
    var old_qty=$("#qty_"+old).val();
    var new_amount=$("#amount_"+tableProductLength).val();
    var old_amount=$("#amount_"+old).val();
    $("#qty_"+old).val(Number(new_qty)+Number(old_qty));
    $("#amount_"+old).val(Number(new_amount)+Number(old_amount));
    $("#product_info_table tbody tr#row_"+tableProductLength).remove();
return false;
}
if(new_qty=='' || isNaN(new_qty) || new_qty==0){
  $("#product_info_table tbody tr#row_"+tableProductLength).remove();
}

 });
});
</script> 
<script type="text/javascript">
  
  $(document).ready(function() {
    $(".product").select2();
    $("#credit").select2();
    $('#net_amount').val('0.00');
    $('#gross_amount').val('0.00');
    $("#Installment_id").select2();
    $("#product_name").select2();
    $("#sales_men").select2();


    $("#add_row").unbind('click').bind('click', function() {
      
      var table = $("#product_info_table");
      var count_table_tbody_tr = $("#product_info_table tbody tr").length;
      var row_id = count_table_tbody_tr + 1;
  

               var html = '<tr id="row_'+row_id+'">'+
                   '<td>'+ 
                    '<select class="form-control product"  data-row-id="row_1" id="product_'+row_id+'" name="product[]" style="width:100%;"  required onchange="get_price('+row_id+')"><option selected="selected">Choose one</option><?php  
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
if($row['item_id']==$cat_name){

echo "<option value=$row[item_id] selected>$row[item_name] "." $row[item_model]</option>"; 

}else{

echo "<option value=$row[item_id]".",$row[barcode]".",$row[item_serial]>$brand_name $row[item_name] $barcode $item_serial</option>"; 

}

}

 echo "</select>";
 ?>'
  html += '</select>'+
                    '</td>'+ 
                    '<td><input type="number" name="item_serial[]" id="item_serial_'+row_id+'" required readonly class="form-control"></td>'+
                    '<td hidden><input type="number" name="barcode[]" id="barcode_'+row_id+'" required readonly class="form-control"></td>'+
                    '<td><input type="number" name="stock_qty[]" id="stock_qty_'+row_id+'" required readonly class="form-control"></td>'+
                    '<td><input type="number" name="qty[]" id="qty_'+row_id+'"  readonly required class="form-control" onchange="getTotal('+row_id+')"></td>'+
                    '<td><input type="text" name="rate[]" id="rate_'+row_id+'"  class="form-control" readonly   onkeyup="getTotal('+row_id+')" ></td>'+
                    '<td><input type="text" name="amount[]" id="amount_'+row_id+'" class="form-control" readonly tabindex="-1"></td>'+
                    '<td><button type="button" class="btn btn-default " id="remove_'+row_id+'" onclick="removeRow(\''+row_id+'\')"><i class="fa fa-close"></i></button></td>'+
                    '</tr>';

                if(count_table_tbody_tr >= 1) {
                    var tableProductLength = $("#product_info_table tbody tr").length;
                    var product=$("#product_"+tableProductLength).val();
                     
                     
                     
                   checkSelects();
    
                  
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

  }); // /document
 function checkSelects() 
        {
      
    var allTextBoxes = [];

    $('.product').each(function () {
        allTextBoxes.push($(this).val())
    });

    var sorted_arr = allTextBoxes.sort();

    for (var i = 0; i < allTextBoxes.length - 1; i++) {
        if (sorted_arr[i + 1] == sorted_arr[i]) {
            alert("Please enter different Item.");     
             var whichtr = $("#product_info_table tbody tr").length;
             whichtr.remove() ;    
        }

    }
   
    
                        }

  function getTotal(row = null) {

    if(row) {

        var qty=$("#qty_"+row).val();
         var stock_qty=$("#stock_qty_"+row).val();

      // if(qty=='' || isNaN(qty) || qty=='0')
      // {
      //   $("#qty_"+row).val('1');
      // }
      // else{
      //   qty=$("#qty_"+row).val();
      // }
      
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
  var type='local(iemi)';

$.ajax({
                                  method: "POST",
                                  url: "operations/get_price_cash.php",
                                  data: {itemid:itemid, type:type},
                                     dataType: 'json',              
                                })
                                .done(function(response){
                
                                   var len = response.length;

                           //           $("#cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var rate = response[i]['rate'];
                                            var barcode = response[i]['barcode'];
                                            var item_serial = response[i]['item_serial'];
                                             
                                              var sale_perc=$("#sale_perc").val();
                                              var price=(rate*sale_perc)/100;

                                             var rate=$("#rate_"+count).val(rate);
                                              var qty=$("#qty_"+count).val('1');
                                             var total = Number($("#rate_"+count).val()) * Number($("#qty_"+count).val());

                                                  total = total.toFixed(2);
                                                    
                                                    
                                             $("#amount_"+count).val(total);
                                             $("#stock_qty_"+count).val('1');
                                             $("#barcode_"+count).val(barcode);
                                             $("#item_serial_"+count).val(item_serial);
                                             subAmount();
                                             //get_stock_qty();


                                        }

                                    
                                })
}

  function get_stock_qty()
 {
    var tableProductLength = $("#product_info_table tbody tr").length;
    var totalSubAmount = 0;
     

    for(x = 0; x < tableProductLength; x++) {
      var tr = $("#product_info_table tbody tr")[x];
      var count = $(tr).attr('id');
      count = count.substring(4);
      var itemid=$("#product_"+count).val();
      } 

  

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
<script type="text/javascript">
  function fill(Value) {
   //Assigning value to "search" div in "search.php" file.
   $('#search').val(Value);
   //Hiding "display" div in "search.php" file.
   $('#display').hide();
}
$(document).ready(function() {
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
   $("#search").keyup(function() {
       //Assigning search box value to javascript variable named as "name".
       var name = $('#search').val();
       //Validating, if "name" is empty.
       if (name == "") {
           //Assigning empty value to "display" div in "search.php" file.
           $("#display").html("");
       }
       //If name is not empty.
       else {
           //AJAX is called.
           $.ajax({
               //AJAX type is "Post".
               type: "POST",
               //Data will be sent to "ajax.php".
               url: "operations/search_items.php",
               //Data, that will be sent to "ajax.php".
               data: {
                   //Assigning value of "name" into "search" variable.
                   search: name
               },
               //If result found, this funtion will be called.
               success: function(html) {
                   //Assigning result to "display" div in "search.php" file.
                   $("#display").html(html).show();
               }
           });
       }
   });
});
</script>
</body>

</html>
