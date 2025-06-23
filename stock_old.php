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
<!-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Stock Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
<?php
              

              if(isset($_GET['data']) && $_GET['data']=='notfound'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry ! </strong>No Record Found !.
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
 // if($_POST){
  // print_r($_POST);
if($_POST)
{
 $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  $brand=mysqli_real_escape_string($conn,$_POST['brand']);
  $cat=mysqli_real_escape_string($conn,$_POST['cat']);
  $items=mysqli_real_escape_string($conn,$_POST['items']);
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
  $zero=mysqli_real_escape_string($conn,$_POST['zero']);

  if($branch=='')
{
    $branch_name='All';

}
else
{
    $sql="SELECT user_name FROM users where user_id='$branch'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_name = $data['user_name'];
                          
                         }

}
}
else
{
    
    $cat = "All";
    $items = "All";
    $brand ="All";
    $branch=$userid;
    $branch_name='All';
    $f_date = date('Y-m-d');  
    $t_date = date('Y-m-d');
    $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));
    $zero='1';


}

   ?>

                         <form  action="stock.php" id="form1"method="post" enctype="multipart/form-data">
                        <div class="body">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <div class="alert alert-danger"   id="danger-alert1" style="display:none;">
  
  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
</div>
                            <div class="row clearfix">
                                
                              <div class="col-md-3 col-sm-12">
                                 <label   for="description">From Date </label>
                                    <div class="form-group">
                                  
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                           
                                  
                              <div class="col-md-3 col-sm-12">
                                <label   for="description">To Date </label>
                                    <div class="form-group">
                                <input type="date" class="form-control" name="t_date" id="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                            
                              <div class="col-md-3 col-sm-12">
                                <label for="description">Location </label>
                                    <div class="form-group">
                                <select class="form-control mb-3 show-tick select_group" name="branch" >

                                  <?php
                                           $sql="SELECT branch_id,created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                               }
                                            if($branch_id=='')
                                            {
                                              $sql="SELECT * FROM users where user_privilege='superadmin' or user_privilege='branch'"; 
                                              ?>
                                              <option value="">All</option>
                                              <?php
                                            }
                                            else
                                            {
                                              $sql="SELECT * FROM users where user_id='$userid'";
                                            }
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$branch)
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
                                    </div>
                                </div>
                
                                  <div class="col-md-3 col-sm-12">
                                     <label for="description">Brand </label>
                                    <div class="form-group">
                                      
                                                                            <select class="form-control select_group" name="brand" id="brand_id" onchange="getcat()" >
                                        <option selected="selected" value="All">All Brands</option>
                                        <?php

                                        $sql="SELECT cat_name,id  FROM tbl_catagory"; 


                                        foreach ($conn->query($sql) as $row){


                                             if($row['id']==$brand)
                                                    {
                                                    echo "<option value=$row[id] selected>$row[cat_name]</option>"; 
                                                    }
                                                    else
                                                    {
                                                    echo "<option value=$row[id]>$row[cat_name] </option>"; 
                                                    }
                                        
                                        }

                                         echo "</select>";
                                         ?>
</select>
                                    </div>
                                </div>
                                  <div class="col-md-3 col-sm-12">
                                    <label for="description">Category </label>
                                    <div class="form-group">
                                        <select class="form-control select_group" name="cat" id="cat_id" onchange="getitem()" >
                                      <option value="All" selected="selected">All Category</option> 
                                       <!--  <option selected="selected">Choose one</option> -->
                                        <?php

                                        $sql="SELECT cat_name,id  FROM tbl_cat"; 


                                        foreach ($conn->query($sql) as $row){
                                            if($row['id']==$cat)
                                                    {
                                                    echo "<option value=$row[id] selected>$row[cat_name]</option>"; 
                                                    }
                                                    else
                                                    {
                                                    echo "<option value=$row[id]>$row[cat_name] </option>"; 
                                                    }
                                   
                                        }

                                         echo "</select>";
                                         ?>
                                        </select>
                                    </div>
                                </div>
                                
                             <div class="col-md-3 col-sm-12">
                                  <label>Items</label>
                                    <div class="form-group">        
                                <select class=" form-control select_group"  id="item_id" name='items' >
                                      <option value="All">All Items</option>
                                        
                                    </select>
                                </div>
                                </div>
                                
                                    <div class="col-md-2 col-sm-12" style="margin-top:35px; ">
                                    <label>No Zero Value</label>
                                    <label class="fancy-checkbox" style="margin-left:15px; ">
                                               <!--  <input type="hidden" name="W[]" value="0" /> -->
                                           
                                                <input class="checkbox-tick" name="zero" type="checkbox" value="1">
                                                
                                                <span ></span>
                                            </label>
                                </div>
                                
                                
                                
                          <div class="col-md-3 col-sm-12" style="margin-top:25px; ">
                            <button style="width:100%; " type="submit" class="btn btn-secondary" name="purchase_rep" target='_blank'>Search</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>

                 <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                       
                               <div class="row clearfix">
                                   <div class="clearfix text-left col-md-9" >
                                    <span>
                                        <a href="stock_single.php" target="_blank">
                                            <button  class="btn btn-sm btn-outline-dark mb-3" type="button">
                                                <i class="fa fa-search" aria-hidden="true"></i> <b>Stock Tracking</b>
                                            </button>
                                        </a>
                                        <a href="stock_itemwise.php" target="_blank">
                                            <button  class="btn btn-sm btn-outline-dark mb-3" type="button">
                                                <i class="fa fa-search" aria-hidden="true"></i> <b>Stock Report IEMI/Serial Wise</b>
                                            </button>
                                        </a>
                                        <a href="stock_sale_wise.php" target="_blank">
                                            <button  class="btn btn-sm btn-outline-dark mb-3" type="button">
                                                <i class="fa fa-search" aria-hidden="true"></i> <b>Stock Report Sale Wise</b>
                                            </button>
                                        </a>
                                        <a href="stock_sale_profit.php" target="_blank">
                                            <button  class="btn btn-sm btn-outline-dark mb-3" type="button">
                                                <i class="fa fa-search" aria-hidden="true"></i> <b>Stock Report Profit Wise</b>
                                            </button>
                                        </a>
                                        <a href="stock_report_aging.php" target="_blank">
                                            <button  class="btn btn-sm btn-outline-dark mb-3" type="button">
                                                <i class="fa fa-search" aria-hidden="true"></i> <b>Stock Report Aging Wise</b>
                                            </button>
                                        </a>
                                     </span>
                                 </div> 
                            <div clas="clearfix text-right col-md-3" >
                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Item id#</th> 
                                                                                           
                                                            <th>Item</th>                                      
                                                            <th>Barcode</th>
                                                            <th>Sale Items</th>                                      
                                                            <th>Sale Items Return</th>                                      
                                                      
                                                            <th>Purchase Items</th>
                                                       <!--      <th>Loc Purchase Items</th>
                                                            <th>Purchased Req Items</th> -->
                                                            <th>Purchased Items Return</th>
                                                           <!--  <th class="hidden-sm-down">Description</th> -->
                                                            <th>Stock</th>
                                                            <!-- <th class="hidden-sm-down">Sale Price</th> -->
                                                            <!-- <th>Purchase Price</th> -->
                                                            <!-- <th>Total</th> -->
                                                            <!-- <th>Date</th> -->
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

if($brand == "All" && $cat == "All" && $items=="All"){

    $where_brand="";
    $where_cat="";
    $where_items="";
  }
  else if($brand != "All" && $cat == "All" && $items=="All")
  {
      $where_brand="where tbl_items.brand_id='$brand'";
      $where_cat="";
      $where_items="";
  }
  else if($brand != "All" && $cat != "All" && $items=="All")
  {
      $where_brand="where tbl_items.brand_id='$brand'";
      $where_cat="and tbl_items.category='$cat'";
      $where_items="";
  }
  else if($brand != "All" && $cat != "All" && $items!="All")
  {
      $where_brand="where tbl_items.brand_id='$brand'";
      $where_cat="and tbl_items.category='$cat'";
       $where_items="and tbl_items.item_id='$items'";
  }


$bsql=mysqli_query($conn,"SELECT * FROM tbl_items   $where_brand $where_cat $where_items");
  $datafound=mysqli_num_rows($bsql);

if($datafound=='0')
{?>
<script>
  window.location.replace("stock.php?data=notfound");
   
</script>

<?php }
else{
      $count=0;

                                  // print_r(mysqli_fetch_array($bsql));
while($value = mysqli_fetch_assoc($bsql))   
                                {   
                                  // print_r($value);
                                    $product=$value['product'];
                                    $cat_name=$value['item_name']; 
                                    $itemid=$value['item_id']; 
                                    $item_serial=$value['item_serial'];
                                    $barcode=$value['barcode'];
                                    $purchase_id=$value['purchase_id']; 
                                    $sale_id=$value['sale_id']; 
                                    $vendor_id=$value['vendor_id']; 
                                    $product_id=$value['product']; 
                                    // echo $product_id;
                                    $rate=$value['rate'];
                                    $qty=$value['qty'];
                                    $qty_rec=$value['qty_rec'];
                                    $s_rate=$value['s_amount'];

                                    $p_rate=$value['rate'];
                                    $amount=$value['amount'];
                                    $net_amount=$value['net_amount'];
                           
                                    $gross_amount=$value['gross_amount'];
                                    $date=$value['payment_date'];
                                    $brand_id=$value['brand_id'];

                                                                $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                                                $value2 = mysqli_fetch_assoc($sql2);
                                                                $brand_name=$value2['cat_name'];
                                if($branch=='')
                                      {

                                          $where_branch='';
                                        
                                      }
                                      else
                                      {

                                          $where_branch='where user_id="'.$branch.'"';
                                         ;

                                      }
                                      
                                $sql=mysqli_query($conn, "SELECT user_privilege,created_by,user_id FROM users  $where_branch");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                $user_id=$data['user_id'];
                                
                               if($user_privilege=='branch')
                               {
                                $created_by=$user_id;
                               }
                               else
                               {
                                $created_by=$created_by;
                               }

                               if($branch=='')
                                      {

                                          $where_created='';
                                      }
                                      else
                                      {
                                          $where_created=' and parent_id="'.$created_by.'"';

                                      }

              $query = "SELECT sum(qty_rec) as pur_qty FROM tbl_purchase_detail where product = '$itemid' $where_created";

                                  $result = mysqli_query($conn,$query);
                       while($row = mysqli_fetch_array($result) ){
                        $pur_qty = $row['pur_qty'];


                     }
                   
                $query1 = "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$itemid' $where_created";
                                  

                  $result1 = mysqli_query($conn,$query1);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $sold_qty = $row1['sold_qty'];


                     }

                

                $query3 = "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$itemid' $where_created";
                  $result3 = mysqli_query($conn,$query3);
                         while($row3 = mysqli_fetch_array($result3) ){
                           $sale_returned_qty = $row3['sale_returned_qty'];


                       }

                $query4 = "SELECT count(return_qty) as pur_returned_qty FROM tbl_purchase_return_detail where product = '$itemid' $where_created";
                  $result4 = mysqli_query($conn,$query4);
                         while($row4 = mysqli_fetch_array($result4) ){
                          $pur_returned_qty = $row4['pur_returned_qty'];


                       }

                $query5 = "SELECT count(plan_id) as lease_qty FROM tbl_installment where item_id = '$itemid' $where_created";
                  $result5 = mysqli_query($conn,$query5);
                         while($row5 = mysqli_fetch_array($result5) ){
                          $lease_qty = $row5['lease_qty'];


                       }
                $query6 = "SELECT sum(qty_rec) as loc_pur_qty FROM tbl_single_purchase_detail where product = '$itemid' $where_created";

                                  $result6 = mysqli_query($conn,$query6);
                       while($row6 = mysqli_fetch_array($result6) ){
                        $loc_pur_qty = $row6['loc_pur_qty'];


                     }

                  


                  $pur_qty_total=($pur_qty+$loc_pur_qty)-$pur_returned_qty;
                  $sold_qty_total=($sold_qty+$lease_qty)-$sale_returned_qty;
                  if($branch!='')
                  {
                    if($user_privilege!='branch')
                               {

                                $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and trans_parent_id='$created_by'";
                  $result2 = mysqli_query($conn,$query2);
                         while($row2 = mysqli_fetch_array($result2) ){
                          $tran_qty = $row2['tran_qty'];


                       }
                                $total_qty=($pur_qty_total-$sold_qty_total)-$tran_qty;
                               }
                               else
                               {

                                $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and parent_id='$created_by'  and transfer='0' and recieved='1'";
                  $result2 = mysqli_query($conn,$query2);
                         while($row2 = mysqli_fetch_array($result2) ){
                          $tran_qty = $row2['tran_qty'];


                       }
                                $total_qty=($pur_qty_total-$sold_qty_total)+$tran_qty;
                               }
                  }
                  else
                  {
                 
                    $total_qty=($pur_qty_total-$sold_qty_total);
                  }
                
                  
 $count++;
 if($zero=='1'){
    
    if($total_qty!='0'){
  ?>
                                                        <tr>
                  
                            <td><?php echo $itemid;;?></td>
                   
                            <td><?php echo $brand_name.' '.$cat_name ;?></td>
                            <td><?php echo $barcode;?></td>
                            <td><?php if($sold_qty){$total_sold_qty+=$sold_qty; echo $sold_qty;}else{echo 0;}?></td>
                            <!-- <td><?php if($lease_qty){$lease_qty_total+=$lease_qty; echo $lease_qty;}else{echo 0;}?></td> -->
                            <td><?php if($sale_returned_qty){$sale_returned_qty_total+=$sale_returned_qty; echo $sale_returned_qty;}else{echo 0;}?></td>
                            <td><?php if($pur_qty){$purchase_qty_total+=$pur_qty; echo $pur_qty;}else{echo 0;}?></td>
                            <!-- <td><?php if($loc_pur_qty){$loc_pur_qty_total+=$loc_pur_qty; echo $loc_pur_qty;}else{echo 0;}?></td>
                            
                            <td><?php if($tran_qty){$tran_qty_total+=$tran_qty; echo $tran_qty;}else{echo 0;}?></td> -->
                            <td><?php if($pur_returned_qty){$pur_returned_qty_total+=$pur_returned_qty; echo $pur_returned_qty;}else{echo 0;}?></td>
                            <td><?php $total_qty_total+=$total_qty; echo $total_qty;?></td>
                
                                                        </tr>

                                                       
                                                      <?php } } else{?>
                                                        <tr>
                  
                            <td><?php echo $itemid;?></td>
                   
                            <td><?php echo $brand_name.' '.$cat_name ;?></td>
                            <td><?php echo $barcode;?></td>
                            <td><?php if($sold_qty){$total_sold_qty+=$sold_qty; echo $sold_qty;}else{echo 0;}?></td>
                            <!-- <td><?php if($lease_qty){$lease_qty_total+=$lease_qty; echo $lease_qty;}else{echo 0;}?></td> -->
                            <td><?php if($sale_returned_qty){$sale_returned_qty_total+=$sale_returned_qty; echo $sale_returned_qty;}else{echo 0;}?></td>
                            <td><?php if($pur_qty){$purchase_qty_total+=$pur_qty; echo $pur_qty;}else{echo 0;}?></td>
                            <!-- <td><?php if($loc_pur_qty){$loc_pur_qty_total+=$loc_pur_qty; echo $loc_pur_qty;}else{echo 0;}?></td>
                            
                            <td><?php if($tran_qty){$tran_qty_total+=$tran_qty; echo $tran_qty;}else{echo 0;}?></td> -->
                            <td><?php if($pur_returned_qty){$pur_returned_qty_total+=$pur_returned_qty; echo $pur_returned_qty;}else{echo 0;}?></td>
                            <td><?php $total_qty_total+=$total_qty; echo $total_qty;?></td>
                
                                                        </tr>

                                                      <?php }


                                                  } }?>
                            <tr style="font-weight: 50px; color: white;" class="bg-secondary">
                  
                            <td><h5>Total</h5></td>
                   
                            <td></td>
                            <td></td>
                            <td><?php if($total_sold_qty){echo $total_sold_qty;}else{echo 0;}?></td>
                            <!-- <td><?php if($lease_qty_total){echo $lease_qty_total;}else{echo 0;}?></td> -->
                            <td><?php if($sale_returned_qty_total){echo $sale_returned_qty_total;}else{echo 0;}?></td>
                            <td><?php if($purchase_qty_total){echo $purchase_qty_total;}else{echo 0;}?></td>
                            <!-- <td><?php if($loc_pur_qty_total){echo $loc_pur_qty_total;}else{echo 0;}?></td>
                            
                            <td><?php if($tran_qty_total){echo $tran_qty_total;}else{echo 0;}?></td> -->
                            <td><?php if($pur_returned_qty_total){echo $pur_returned_qty_total;}else{echo 0;}?></td>
                            <td><?php echo $total_qty_total;?></td>
                
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">
                                            <!-- <p class="m-b-0"><b>Sub-total:</b> <?php echo $total_amount; ?></p> -->
                                            <!-- <p class="m-b-0">Discout: <?php echo $discount; ?>%</p> -->
                                                                                   
                                            <h3 class="m-b-0 m-t-10">NET Stock - <?php echo $total_qty_total; ?></h3>
                                        </div>                                    
                                        
                                    </div>                                    
                                </div>  
                        
                            </div>   
                                            
                          
                          <div class="row clearfix ">
                                <div class="col-md-6 ">
                               
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>

</div>
</div>

    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    $(".select_group").select2();
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: true,
      "paging":   true,
      "ordering": true,
      "info":     false,
      "orderClasses": false, 
      searching: true,
      buttons: [
        
          {
          extend: 'pdf',
          text: 'PDF',
          title: '<?php echo $c_name;?> (Stock Report)',
          orientation: 'landscape',
          text:'<span class="text-default"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
          className: 'btn btn-sm btn-outline-dark',
          customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      }  
        },
        {
          extend: 'print',
          className: 'btn btn-sm btn-outline-dark',
          titleAttr: 'print',
          text:'<span class="text-default"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: '<?php echo $c_name;?> (Stock Report)',

          
        },


      ]


    });
} );
</script>
<script type="text/javascript">
  $("#danger-alert1").hide();
  $("#form1").submit(function(e){
     var from = $("#f_date").val();
var to = $("#t_date").val();

if(Date.parse(from) > Date.parse(to)){
   e.preventDefault();
   // alert("Invalid Date Range");
     

    $("#danger-alert1").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert1").slideUp(500);
    });
  
   $("$f_date").focus();
    // return false;
    }
});
  getcat();
            function getcat(){

    var cat_id = $('#brand_id').val();
if(cat_id!='All')
{
      $.ajax({
                  method: "POST",
                  url: "operations/get_cat.php",
                  data: {cat_id:cat_id},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;
                   
                 
                     $("#cat_id").empty();
                     $("#cat_id").append("<option value='All'>All Item</option>");
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var item_name = response[i]['cat_name'];
                            // alert(id);
                            $("#cat_id").append("<option value='"+id+"'>"+item_name+"</option>");

                        }
                        getitem();
                });

}
else
{
    $("#cat_id").empty();
    $("#cat_id").append("<option value='All'>All Item</option>");
}
                


} 

      function getitem(){

    var cat_id = $('#cat_id').val();
 if(cat_id!='All')
{
      $.ajax({
                  method: "POST",
                  url: "operations/get_items.php",
                  data: {cat_id:cat_id},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;

                     $("#item_id").empty();
                     $("#item_id").append("<option value='All'>All Item</option>")
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var item_name = response[i]['item_name'];

                            $("#item_id").append("<option value='"+id+"'>"+item_name+"</option>");

                        }
           
                    
                });
}
else
{
    $("#item_id").empty();
    $("#item_id").append("<option value='All'>All Item</option>")

}


}
 
</script>


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
