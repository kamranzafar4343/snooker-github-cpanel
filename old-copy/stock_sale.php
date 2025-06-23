<?php 
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
session_start();
if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}?>
 <?php    
 // if($_POST){
  // print_r($_POST);
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
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

   ?>

<html lang="en" >
<link rel="icon" href="favicon.ico" type="image/x-icon"><!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">

<body >

            <div class="row clearfix" >
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                        // echo $data['c_phone '];exit();
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="logo" style='width: 7%;'>
                                    <img src="<?php echo $image; ?>"  alt="user" class="img-fluid">
                                </div>
                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1><?php echo $c_name;?></h1>
                                    <h3>Stock Report</h3>
                                    <h5>Location : (<?php echo $branch_name;?>)</h5>
                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>
                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $f_date.'/'.$t_date;?>
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
                                                            <th>Sale Items</th>
                                                            <th>Lease Items</th>                                      
                                                            <th>Sale Items Return</th>                                      
                                                      
                                                            <th>PO Items</th>
                                                            <th>Loc Purchase Items</th>
                                                            <th>Purchased Req Items</th>
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
if($brand)
{
    if($brand == "All"){

    $where_brand="";
  }
  else{
      $where_brand="and tbl_items.brand_id='$brand'";
  }
}
if($cat)
  {
    if($cat == "All"){
    $where_cat="";
  }
  else{
      $where_cat="and tbl_items.sub_category='$cat'";

  }
}
if($items)
{
  if($items=="All")
  {
     
    $where_items="";

  }
  else
  {
    
    $where_items="where tbl_items.item_id='$items'";
   
    // print_r($where_items);
  }

}



$bsql=mysqli_query($conn,"SELECT * FROM tbl_items   $where_items  $where_brand $where_cat");
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

                                $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and parent_id='$created_by'  and transfer='0'";
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
                            <td><?php if($sold_qty){$total_sold_qty+=$sold_qty; echo $sold_qty;}else{echo 0;}?></td>
                            <td><?php if($lease_qty){$lease_qty_total+=$lease_qty; echo $lease_qty;}else{echo 0;}?></td>
                            <td><?php if($sale_returned_qty){$sale_returned_qty_total+=$sale_returned_qty; echo $sale_returned_qty;}else{echo 0;}?></td>
                            <td><?php if($pur_qty){$purchase_qty_total+=$pur_qty; echo $pur_qty;}else{echo 0;}?></td>
                            <td><?php if($loc_pur_qty){$loc_pur_qty_total+=$loc_pur_qty; echo $loc_pur_qty;}else{echo 0;}?></td>
                            
                            <td><?php if($tran_qty){$tran_qty_total+=$tran_qty; echo $tran_qty;}else{echo 0;}?></td>
                            <td><?php if($pur_returned_qty){$pur_returned_qty_total+=$pur_returned_qty; echo $pur_returned_qty;}else{echo 0;}?></td>
                            <td><?php $total_qty_total+=$total_qty; echo $total_qty;?></td>
                
                                                        </tr>

                                                       
                                                      <?php } } else{?>
                                                        <tr>
                  
                            <td><?php echo $itemid;?></td>
                   
                            <td><?php echo $brand_name.' '.$cat_name ;?></td>
                            <td><?php if($sold_qty){$total_sold_qty+=$sold_qty; echo $sold_qty;}else{echo 0;}?></td>
                            <td><?php if($lease_qty){$lease_qty_total+=$lease_qty; echo $lease_qty;}else{echo 0;}?></td>
                            <td><?php if($sale_returned_qty){$sale_returned_qty_total+=$sale_returned_qty; echo $sale_returned_qty;}else{echo 0;}?></td>
                            <td><?php if($pur_qty){$purchase_qty_total+=$pur_qty; echo $pur_qty;}else{echo 0;}?></td>
                            <td><?php if($loc_pur_qty){$loc_pur_qty_total+=$loc_pur_qty; echo $loc_pur_qty;}else{echo 0;}?></td>
                            
                            <td><?php if($tran_qty){$tran_qty_total+=$tran_qty; echo $tran_qty;}else{echo 0;}?></td>
                            <td><?php if($pur_returned_qty){$pur_returned_qty_total+=$pur_returned_qty; echo $pur_returned_qty;}else{echo 0;}?></td>
                            <td><?php $total_qty_total+=$total_qty; echo $total_qty;?></td>
                
                                                        </tr>

                                                      <?php }


                                                  } }?>
                            <tr style="font-weight: 50px; color: white;" class="bg-success">
                  
                            <td><h5>Total</h5></td>
                   
                            <td></td>
                            <td><?php if($total_sold_qty){echo $total_sold_qty;}else{echo 0;}?></td>
                            <td><?php if($lease_qty_total){echo $lease_qty_total;}else{echo 0;}?></td>
                            <td><?php if($sale_returned_qty_total){echo $sale_returned_qty_total;}else{echo 0;}?></td>
                            <td><?php if($purchase_qty_total){echo $purchase_qty_total;}else{echo 0;}?></td>
                            <td><?php if($loc_pur_qty_total){echo $loc_pur_qty_total;}else{echo 0;}?></td>
                            
                            <td><?php if($tran_qty_total){echo $tran_qty_total;}else{echo 0;}?></td>
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
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                      <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>      
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


    
</body>
<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>






</body>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('customer.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('customer.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
<style type="text/css">
  .data-table-container {
  padding: 10px;
}

.dt-buttons .btn {
  margin-right: 3px;
}

</style>
<script type="text/javascript">
$(document).ready(function() {
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: false,
      buttons: [
        {
          extend: 'pdfHtml5',
          text: 'Alkareem',
           title: 'Alkareem (Stock Report for Location : <?php echo $branch_name;?>)',
           
          
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          
          className: 'btn btn-danger',
          
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
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: 'Alkareem (Stock Report for Location : <?php echo $branch_name;?>)',

          
        },


      ]


    });
} );
</script>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('stock.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('stock.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
