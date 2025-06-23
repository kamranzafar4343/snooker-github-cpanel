<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
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

<div id="wrapper">

    <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
<?php
$planid=mysqli_real_escape_string($conn, $_GET['plan_id']);
                $sql=mysqli_query($conn, "SELECT * FROM tbl_installment where plan_id=$planid");

                $data=mysqli_fetch_assoc($sql);
                        $id = $data['plan_id'];
                        $customer = $data['customer'];
                        $cat_id = $data['cat_id'];
                        $item_id = $data['item_id'];
                        $total_price = $data['total_price'];
                        $amount_recieved = $data['amount_recieved'];
                        $down_payment = $data['down_payment'];
                        $created_by = $data['created_by'];

                        $installment_status = $data['installment_status'];
                       
                        $local = $data['local'];
                        $iemi = $data['iemi'];
                        $period = $data['period'];
                        
                        $x=$period;
                        $per_month_amount = $data['per_month_amount'];
                        $created_date = $data['created_date'];
                        $created_by = $data['created_by'];
                        $avo = $data['avo'];
                        $mo = $data['mo'];
                        $bm = $data['bm'];
                        $sale_men = $data['sales_men'];

                        $gran1_name=$data['gran1_name'];
                        $gran1_fname=$data['gran1_fname'];
                        $gran1_mobile_no=$data['gran1_mobile_no'];
                        $gran1_mobile_no=$data['gran1_mobile_no'];
                        $gran1_client_cnic=$data['gran1_client_cnic'];
                        $gran1_relation=$data['gran1_relation'];
                        $gran1_occup=$data['gran1_occup'];
                        $gran1_address=$data['gran1_address'];
                        $gran1_office=$data['gran1_office'];
                        $gran1_office_no=$data['gran1_office_no'];
                        
                        $gran2_name=$data['gran2_name'];
                        $gran2_fname=$data['gran2_fname'];
                        $gran2_mobile_no=$data['gran2_mobile_no'];
                        $gran2_client_cnic=$data['gran2_client_cnic'];
                        $gran2_relation=$data['gran2_relation'];
                        $gran2_occup=$data['gran2_occup'];
                        $gran2_address=$data['gran2_address'];
                        $gran2_office=$data['gran2_office'];
                        $gran2_office_no=$data['gran2_office_no'];

                        $gran3_name=$data['gran3_name'];
                        $gran3_fname=$data['gran3_fname'];
                        $gran3_mobile_no=$data['gran3_mobile_no'];
                        $gran3_client_cnic=$data['gran3_client_cnic'];
                        $gran3_relation=$data['gran3_relation'];
                        $gran3_occup=$data['gran3_occup'];
                        $gran3_address=$data['gran3_address'];
                        $gran3_office=$data['gran3_office'];

                        $gran4_name=$data['gran4_name'];
                        $gran4_fname=$data['gran4_fname'];
                        $gran4_mobile_no=$data['gran4_mobile_no'];
                        $gran4_client_cnic=$data['gran4_client_cnic'];
                        $gran4_relation=$data['gran4_relation'];
                        $gran4_occup=$data['gran4_occup'];
                        $gran4_address=$data['gran4_address'];
                        $gran4_office=$data['gran4_office'];
                        $created_by = $data['created_by'];


?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Edit Installment</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Edit Installment</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                    
                                <form action="operations/edit_insta.php" method="post"  enctype="multipart/form-data">
                            <div class="row clearfix">
                               <div class="col-md-4 col-sm-12">
                                <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 4px;">
                                       <label>Location *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   <input type="hidden" name="plan_id" value="<?php echo $planid;?>">
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

                                       <label>Process Date</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="date" name="process_date" id="process_date" required=""  class="form-control" placeholder="Down Payment" value="<?php echo $created_date;?>">
                                </div>
                              </div>
                                </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                       <a href="add_clients.php" >
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   
                                
                                       <label>Customer Name*</label>
                                      </div>
                                 
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                <select class=" form-control customer" disabled="" id="customer" name='customer' style="width: 100%;" onchange="get_customer_detail()">
                                    <option selected value="">Select Customer</option>
                                   
                                   <?php

                                         $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                               
                                if($user_privilege!='branch')
                                {
                                  
                                  $sql="SELECT * FROM tbl_customer where parent_id='$created_by' and blacklist='0'";
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
                                            if($row['customer_id']==$customer)
                                            {
                                            echo "<option value=$row[customer_id] selected>$row[username] ($row[mobile_no1]) ($row[client_cnic])</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[customer_id]>$row[username] ($row[mobile_no1]) ($row[client_cnic])</option>"; 
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
                                  
                                       <label>Installment Period</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group"> 
                                    <select class="form-control select2"   disabled required  name="period" id="period" onchange="get_per()">
                            
                                           <?php
                                            $sql="SELECT * FROM tbl_period "; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['months']==$period)
                                            {
                                            echo "<option value=$row[months] selected>$row[months] months</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[months]>$row[months] months </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>  
                                        <input type="hidden" name="percentage" readonly="" id="percentage" class="form-control" >     
                                       
                                </div>
                              </div>
                                </div>
                                    <div class="col-md-4 col-sm-12">
                                      <div class='col-md-8 col-sm-4' style="padding-bottom: 7px;">
                                       <a href="add_item.php" >
                                          <button type="button" class="btn btn-success text-right" ><i class="fa fa-plus"></i></button>
                                      </a>   
                                
                                       <label>Item Name *</label>
                                      </div>

                                       <div class='col-md-12 col-sm-4'>
                                    <div class="form-group">   
                                        <select class=" form-control " disabled="" id="item_id" name='item_id' onchange="getprice()" style="width: 100%;">
                                       
                                      <?php
                                            $sql="SELECT * FROM tbl_items INNER JOIN tbl_installment ON tbl_items.item_id = tbl_installment.item_id where tbl_installment.item_id='$item_id';"; 
                                            foreach ($conn->query($sql) as $row){
                                              $brand_id=$row['brand_id'];
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
                                            if($row['item_id']==$item_id)
                                            {
                                            echo "<option value=$row[item_id]".",$row[barcode]".",$row[item_serial]".",$row[pur_item_id]>$brand_name $row[item_name] $row[barcode] $row[item_serial] $row[pur_item_id]</option>"; 
                                            }
                                            
                                            }

                                             echo "</select>";
                                             ?>
                                    </select>
                                      
                                </div>
                              </div>
                                </div>
                                <?php 
                                $query1 = mysqli_query($conn, "SELECT mo_perc, avo_perc FROM tbl_company");

                                $row1 = mysqli_fetch_array($query1);
                                  $mo_perc = $row1['mo_perc'];
                                  $avo_perc = $row1['avo_perc'];
                                  ?>
                                 <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Item Barcode</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" readonly name="barcode" id="barcode"  class="form-control" placeholder="Barcode">
                                       
                                </div>
                              </div>
                                </div>
                                 <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Item IEMI</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" readonly name="item_serial" id="item_serial"  class="form-control" placeholder="Item Serial">
                                        <input type="hidden" readonly name="pur_item_id" id="pur_item_id"  class="form-control" placeholder="Item Serial">
                                       
                                </div>
                              </div>
                                </div>
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Item Price</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="total_price" readonly="" id="total_price"  class="form-control" placeholder="Total Payment">
                                       
                                </div>
                              </div>
                                </div>
                                   <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Item Stock</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="item_stock" id="item_stock"  class="form-control"  readonly="" placeholder="Item Stock">
                                </div>
                              </div>
                                </div>
                                <div class="col-md-4 col-sm-12" hidden="">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>First Installment *</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="down_payment" id="down_payment" required=""  class="form-control" placeholder="First Installment *" value="0">
                                </div>
                              </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Salesman</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                       <select class="form-control select2"   required  name="sales_men" id="sales_men" name="location">
                            
                                           <?php
                                            $sql="SELECT * FROM tbl_salesmen where  designation
                                            Like '%Salesman%'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$sale_men)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] </option>"; 
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
                                  
                                       <label>MO</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group"> 
                                    <input type="hidden" name="mo_per_amt" id="mo_per_amt"  class="form-control">    
                                    <input type="hidden" name="mo_perc" id="mo_perc"  class="form-control" value="<?php echo $mo_perc;?>"> 
                                        
                                       <select class="form-control "   required  name="mo" id="mo">
                            
                                           <?php
                                            $sql="SELECT * FROM tbl_salesmen where  designation
                                            Like '%MO%'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$mo)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] </option>"; 
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
                                  
                                       <label>AVO</label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">
                                    <input type="hidden" name="avo_per_amt" id="avo_per_amt"  class="form-control">    
                                    <input type="hidden" name="avo_perc" id="avo_perc"  class="form-control" value="<?php echo $avo_perc;?>">       
                                       <select class="form-control select2"   required  name="avo" id="avo">
                            
                                           <?php
                                            $sql="SELECT * FROM tbl_salesmen where  designation Like '%AVO%'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$avo)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] </option>"; 
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
                                       <label>Approvel Manager </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                         <select class="form-control select2"   required  name="bm" id="bm">
                            
                                           <?php
                                            $sql="SELECT * FROM tbl_salesmen where  designation
                                            Like '%BM%'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$bm)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] </option>"; 
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
                                  
                                       <label>Form Fee </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <input type="text" name="form_fee" id="form_fee" class="form-control"   value="200" required="">
                                </div>
                              </div>
                                </div>
                                    <div class="col-md-10 col-sm-12">

                                     <div class='col-md-8 col-sm-4' style="padding-top: 9px;padding-bottom: 2px;">
                                  
                                       <label>Remarks </label>
                                      </div>
                                      <div class='col-md-12 col-sm-4'>
                                   
                                    <div class="form-group">        
                                        <textarea  name="remarks" id="remarks" class="form-control" placeholder="Remarks"  value=""><?php echo $remarks;?></textarea>
                                </div>
                              </div>
                                </div>
                                 <div class="col-md-3 col-sm-6">
                                  <div class="card bg-info text-white text-center mb-3">
                                   
                                    <div class="card-header"><h4>Guarantor 1</h4></div>
                                    <div class="col-md-12 col-sm-12">
                                    <div class="form-group">        
                                     <input type="text" name="gran1_name" required=""  class="form-control" placeholder="Guarantor Name * " value="<?php echo $gran1_name; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran1_fname" required=""  class="form-control" placeholder="Guarantor Father Name *" value="<?php echo $gran1_fname; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" class="form-control"  name="gran1_mobile_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran1_mobile_no; ?>">
                                  </div>
                                  </div>

                                  <div class="col-md-12 col-sm-12">

                                  <div class="form-group">

                                     <input type="text" class="form-control"  name="gran1_office_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran1_office_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text"  name="gran1_client_cnic" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"   required="" value="<?php echo $gran1_client_cnic; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran1_relation"  required=""   class="form-control" placeholder="Guarantor Relation * " value="<?php echo $gran1_relation; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran1_occup" required=""   class="form-control" placeholder="Guarantor Occupation * " value="<?php echo $gran1_relation; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran1_address" required=""   class="form-control" placeholder="Guarantor Address * " value="<?php echo $gran1_address; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran1_office" required=""   class="form-control" placeholder="Guarantor Office Address * " value="<?php echo $gran1_office; ?>"> 
                                  </div>
                                  </div>
                                  </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                                  <div class="card bg-info text-white text-center mb-3">
                                   
                                    <div class="card-header"><h4>Guarantor 2</h4></div>
                                    <div class="col-md-12 col-sm-12">
                                    <div class="form-group">        
                                     <input type="text" name="gran2_name" required="" class="form-control" placeholder="Guarantor Name * " value="<?php echo $gran2_name; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran2_fname" required=""  class="form-control" placeholder="Guarantor Father Name *" value="<?php echo $gran2_fname; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" class="form-control"  name="gran2_mobile_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran2_mobile_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">

                                  <div class="form-group">

                                     <input type="text" class="form-control"  name="gran2_office_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran2_office_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text"  name="gran2_client_cnic" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"   required="" value="<?php echo $gran2_client_cnic; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran2_relation"  required=""   class="form-control" placeholder="Guarantor Relation * " value="<?php echo $gran2_relation; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran2_occup" required=""   class="form-control" placeholder="Guarantor Occupation * " value="<?php echo $gran2_occup; ?>"> 
                                  </div>
                                  </div>
                                   <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran2_address" required=""   class="form-control" placeholder="Guarantor Address * " value="<?php echo $gran2_address; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran2_office" required=""   class="form-control" placeholder="Guarantor Office Address * " value="<?php echo $gran2_office; ?>"> 
                                  </div>
                                  </div>
                                  </div>
                                </div>
                                  <div class="col-md-3 col-sm-6">
                                  <div class="card bg-info text-white text-center mb-3">
                                   
                                    <div class="card-header"><h4>Guarantor 3</h4></div>
                                    <div class="col-md-12 col-sm-12">
                                    <div class="form-group">        
                                     <input type="text" name="gran3_name" class="form-control" placeholder="Guarantor Name * " value="<?php echo $gran3_name; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran3_fname" class="form-control" placeholder="Guarantor Father Name *" value="<?php echo $gran3_fname; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" class="form-control"  name="gran3_mobile_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran3_mobile_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">

                                  <div class="form-group">

                                     <input type="text" class="form-control"  name="gran3_office_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran3_office_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text"  name="gran3_client_cnic" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"   value="<?php echo $gran3_client_cnic; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran3_relation"   class="form-control" placeholder="Guarantor Relation * " value="<?php echo $gran3_relation; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran3_occup" class="form-control" placeholder="Guarantor Occupation * " value="<?php echo $gran3_occup; ?>"> 
                                  </div>
                                  </div>
                                   <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran3_address"    class="form-control" placeholder="Guarantor Address * " value="<?php echo $gran3_address; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran3_office"   class="form-control" placeholder="Guarantor Office Address * " value="<?php echo $gran3_office; ?>"> 
                                  </div>
                                  </div>
                                  </div>
                                </div>
                                 <div class="col-md-3 col-sm-6">
                                  <div class="card bg-info text-white text-center mb-3">
                                   
                                    <div class="card-header"><h4>Guarantor 4</h4></div>
                                    <div class="col-md-12 col-sm-12">
                                    <div class="form-group">        
                                     <input type="text" name="gran4_name"  class="form-control" placeholder="Guarantor Name * " value="<?php echo $gran4_name; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran4_fname"  class="form-control" placeholder="Guarantor Father Name *" value="<?php echo $gran4_fname; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" class="form-control"  name="gran4_mobile_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran4_mobile_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">

                                  <div class="form-group">

                                     <input type="text" class="form-control"  name="gran4_office_no" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $gran4_office_no; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text"  name="gran4_client_cnic" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"    value="<?php echo $gran4_client_cnic; ?>">
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran4_relation"  class="form-control" placeholder="Guarantor Relation * " value="<?php echo $gran4_relation; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran4_occup"   class="form-control" placeholder="Guarantor Occupation * " value="<?php echo $gran4_occup; ?>"> 
                                  </div>
                                  </div>
                                   <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran4_address"   class="form-control" placeholder="Guarantor Address * " value="<?php echo $gran4_address; ?>"> 
                                  </div>
                                  </div>
                                  <div class="col-md-12 col-sm-12">
                                  <div class="form-group">        
                                     <input type="text" name="gran4_office"    class="form-control" placeholder="Guarantor Office Address * " value="<?php echo $gran4_office; ?>"> 
                                  </div>
                                  </div>
                                  </div>
                                </div>
                                  </div>
          

                                  </div>


          

                                 
                                 
                                               
                          
                           
                            <div class='text-center' style="padding: 10px;">
                            <button type="submit" id='submit' name="plan" class="btn btn-primary">Create Plan</button>
                             <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>

                            </div>

                        </div>
                        </form> 

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

   </script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>

</body>
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
          $(function() {
  $("#customer").select2();
  $("#cat_id").select2();
  $("#item_id").select2();
  $("#customer").select2();
  $("#sales_men").select2();
  $("#mo").select2();
  $("#avo").select2();
  $("#bm").select2();
  $("#period").select2();


$("#submit").click(function() {

  var customer=$('#customer').val();
  if(customer=='')
  {
    alert('Please Select Customer..!');
    $('#customer').select2('focus');
    $('#customer').select2('open');
    return false;
  }
  var cat_id=$('#cat_id').val();
  if(cat_id=='')
  {
    alert('Please Select Catagory..!');
    $('#cat_id').select2('focus');
    $('#cat_id').select2('open');
    return false;
  }
  var item_id=$('#item_id').val();
  if(item_id=='')
  {
    alert('Please Select Item..!');
    $('#item_id').select2('focus');
    $('#item_id').select2('open');
    return false;
  }

  var total_price=$('#total_price').val();
  
  var down_payment=$('#down_payment').val();
  // if(down_payment=='' || isNaN(down_payment) )
  // {
  //   alert('Please Enter 1st Installment..!');
  //   $('#down_payment').focus();
  //   return false;
  // }
// if(Number(down_payment)>Number(total_price))
// {
//   alert('Please Enter 1st Installment Less than Actual Amount..!');
//     $('#down_payment').focus();
//     return false;
// }
    var period=$('#period').val();

  if(period=='')
  {
    alert('Please Select Tenure..!');
    $('#period').focus();
    return false;
  }
 var item_stock=$('#item_stock').val();

  if(item_stock=='' || item_stock==0)
  {
    alert('Opps! Stock is empty..!');
    $('#item_stock').focus();
    return false;
  }
 
 });
});
get_per();
            function get_per(){

    var period = $('#period').val();

      $.ajax({
                  method: "POST",
                  url: "operations/get_per.php",
                  data: {period:period},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;

                   
                        for( var i = 0; i<len; i++){
                            var percentage = response[i]['percentage'];

                            $("#percentage").val(percentage);

                        }
           getprice();
                    
                });


}
function getprice()
 {

  var itemid=$("#item_id").val();

$.ajax({
                                  method: "POST",
                                  url: "operations/get_price.php",
                                  data: {itemid:itemid},
                                  dataType: 'json',              
                                })
                                .done(function(response){
                                    if(response==null)
                                   {
                                    $("#item_stock").val('');
                                    $("#item_stock").val('0');
                                   }
                                   else
                                   {
                                    $("#item_stock").val('1');
                                   }
                                   var len = response.length;

                           //           $("#cat").empty();
                                        for( var i = 0; i<len; i++){
                                            var rate = response[i]['rate'];
                                            var barcode = response[i]['barcode'];
                                            var item_serial = response[i]['item_serial'];
                                            var pur_item_id = response[i]['pur_item_id'];
                                         
                                              var sale_perc=$("#sale_perc").val();
                                              var price=(rate*sale_perc)/100;

                                              var percentage= $("#percentage").val();
                                              var mo_perc= $("#mo_perc").val();
                                              var avo_perc= $("#avo_perc").val();
                                              
                                              var per=((Number(rate)*Number(percentage))/100);
                                              var price=Number(rate)+Number(per);
                                              var mo_perc_amt=(Number(price)*Number(mo_perc))/100;
                                              var avo_perc_amt=(Number(price)*Number(avo_perc))/100;

                                              $("#total_price").val(price);
                                              $("#pur_item_id").val(pur_item_id);
                                              $("#mo_per_amt").val(mo_perc_amt);
                                              $("#avo_per_amt").val(avo_perc_amt);
                                                  
                                             if(barcode==0)
                                             {
                                              $("#barcode").val('');
                                             }
                                             else
                                             {
                                              $("#barcode").val(barcode);
                                             }
                                             if(item_serial==0)
                                             {
                                              $("#item_serial").val('');
                                             }
                                             else
                                             {
                                              $("#item_serial").val(item_serial);
                                             }
                                             
                                             
                                             
                                         
                                             //get_stock_qty();

                                        }

                                    
                                })
}

//             function getprice(){

    
   
//         var itemid=$("#item_id").val();

//   var dataString = 'itemid='+ itemid;

//     $.ajax({
// type: "POST",
// url: "operations/get_price.php",
// data: dataString,

// success: function(responce){

//   var percentage= $("#percentage").val();
//   var mo_perc= $("#mo_perc").val();
//   var avo_perc= $("#avo_perc").val();
  
//   var per=((Number(responce)*Number(percentage))/100);
//   var price=Number(responce)+Number(per);
//   var mo_perc_amt=(Number(price)*Number(mo_perc))/100;
//   var avo_perc_amt=(Number(price)*Number(avo_perc))/100;

//   $("#total_price").val(price);
//   $("#mo_per_amt").val(mo_perc_amt);
//   $("#avo_per_amt").val(avo_perc_amt);
// get_stock_qty();
// }

// });
        

// }
  function get_stock_qty()
 {
var itemid=$("#item_id").val();
  

  var dataString = 'itemid='+ itemid;

    $.ajax({
type: "POST",
url: "operations/get_stock_qty.php",
data: dataString,

success: function(responce){
  
if(responce=='0')
{
  alert('Stock is Empty..!');
   $("#item_stock").val('0');

}
else
{
  $("#item_stock").val(responce);

}
}
});

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
                            
                            var client_address = response[i]['address_permanent'];

                          $("#client_cnic").val(client_cnic);
                          $("#client_mobile_no").val(client_mobile_no);
                  
                           $("#client_address").val(client_address);

                        }

                    
                });


}




</script> 
</html>
