  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
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

  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $items=mysqli_real_escape_string($conn,$_POST['items']);
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
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

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                       <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                       
                 
                        ?>
                        
                            <div class="invoice-top clearfix col-md-12">

                                <div class="logo" style='width: 7%;'>
                                    <img src="<?php echo $image; ?>"  alt="user" class="img-fluid">
                                </div>
                                <div class="info text-center col-md-12" style="margin-top: -5%;" >
                                    <h1><?php echo $c_name;?></h1>
                                    <h3>Inventory Report</h3>
                                    <h5>Location : (<?php echo $branch_name;?>)</h5>
                                  
                                </div>

                            </div>
                              
                        <div class="header">
                       
                        <div class="body">
                            
                            <ul class="nav nav-tabs-new2">
                                <li class="nav-item inlineblock"><a class="nav-link active" data-toggle="tab" href="#details" aria-expanded="true">In Stock</a></li>                                
                                <li class="nav-item inlineblock"><a class="nav-link" data-toggle="tab" href="#history" aria-expanded="false">Out of Stock</a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane animated slideInUp active" id="details" aria-expanded="true">
                                  
                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Item#</th>                                                        
                                                            <th>Name</th>
                                                            <th class="text-right">Pur Item</th>
                                                            <th class="text-right">Pur Rate</th>
                                                            <th class="text-right">Req Item</th>
                                                            <th class="text-right">Req Rate</th>
                                                            <th class="text-right">Req Profit</th>
                                                            <th class="text-right">Loc Pur</th>
                                                            <th class="text-right">Loc Item</th>
                                                            <th class="text-right">Pur Rtn</th>
                                                            <th class="text-right">Rtn Rate</th>
                                                            <th class="text-right">Sale Item</th>
                                                            <th class="text-right">Sale Rate</th>
                                                            <th class="text-right">Lease Item</th>
                                                            <th class="text-right">Lease Rate</th>
                                                            <th class="text-right">Sale Rtn</th>
                                                            <th class="text-right">Rtn Rate</th>
                                                            <th class="text-right">Stock</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                      <?php
                                                  
                                                      if($items)
                                                            {
                                                              if($items=="All")
                                                              {
                                                                 
                                                                $where_items="";

                                                              }
                                                              else
                                                              {
                                                                
                                                                $where_pur_items='where c.item_id="'.$items.'"';
                                                               
                                                               
                                                                // print_r($where_items);
                                                              }

                                                            }
                                                            if($branch=='')
                                                              {

                                                                  $where_branch='';
                                                                
                                                              }
                                                              else
                                                              {

                                                                  $where_branch='where user_id="'.$branch.'"';
                                                             

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
                                                                   $date=date('Y-m-d');

                                                        $bsql=mysqli_query($conn,"SELECT item_id, item_name
                                                          FROM tbl_items AS c
                                                             LEFT JOIN
                                                             tbl_purchase_detail AS o
                                                             ON c.item_id = o.product
                                                             LEFT JOIN
                                                             tbl_single_purchase_detail AS s
                                                             ON c.item_id = s.product $where_items group by c.item_id");
                                                      
                                                     
                                                        $datafound=mysqli_num_rows($bsql);

                                                      
                                                            $count=0;
                                                      while($value = mysqli_fetch_assoc($bsql))   
                                                            {   
                                        
                                                                $itemid=$value['item_id']; 
                                                                $item_name=$value['item_name']; 
                                                                ///////////////////////////////////////////////////// 
                                                                // and created_date='$date'
                                                                //Purchase  ////////////////////////////////////////////////////
                                                                $pur_query=mysqli_query($conn,"SELECT rate, count(product) as pur_items FROM tbl_purchase_detail where product='$itemid' $where_created");
                                                                $pur_query_value = mysqli_fetch_assoc($pur_query);
                                                                $pur_rate=$pur_query_value['rate']; 
                                                                $pur_items=$pur_query_value['pur_items']; 

                                                                ///////////////////////////////////////////////////// Purchase Return  /////////////////////////////////////////////
                                                                $pur_rtn_query=mysqli_query($conn,"SELECT rate, count(product) as pur_return_items  FROM tbl_purchase_return_detail as pur_return_items where product='$itemid' $where_created");
                                                                $pur_rtn_query_value = mysqli_fetch_assoc($pur_rtn_query);
                                                                $pur_rtn_rate=$pur_rtn_query_value['rate']; 
                                                                $pur_return_items=$pur_rtn_query_value['pur_return_items'];

                                                                 /////////////////////////////////////////////////////  

                                                                ///////////////////////////////////////////////////// Sale  /////////////////////////////////////////////////////////////
                                                                $sale_query=mysqli_query($conn,"SELECT rate, count(product) as sale_items FROM tbl_sale_detail  where product='$itemid' $where_created");
                                                                $sale_query_value = mysqli_fetch_assoc($sale_query);
                                                                $sale_rate=$sale_query_value['rate']; 
                                                                $sale_items=$sale_query_value['sale_items'];

                                                                ///////////////////////////////////////////////////// Sale Return /////////////////////////////////////////////
                                                                $sale_rtn_query=mysqli_query($conn,"SELECT rate, count(product) as sale_return_items FROM tbl_sale_return_detail  where product='$itemid' $where_created");
                                                                $sale_rtn_query_value = mysqli_fetch_assoc($sale_rtn_query);
                                                                $sale_rtn_rate=$sale_rtn_query_value['rate']; 
                                                                $sale_rtn_items=$sale_rtn_query_value['sale_return_items'];

                                                                /////////////////////////////////////////////////////
                                                                ///////////////////////////////////////////////////// Lease  /////////////////////////////////////////////////////////////
                                                                $sale_query=mysqli_query($conn,"SELECT total_price, count(item_id) as lease_items FROM tbl_installment  where item_id='$itemid' $where_created ");
                                                                $sale_query_value = mysqli_fetch_assoc($sale_query);
                                                                $lease_rate=$sale_query_value['total_price']; 
                                                                $lease_items=$sale_query_value['lease_items'];

                                                                /////////////////////////////////////////////////////  Purchase Req /////////////////////////////////////////////
                                                                $purchase_req_query=mysqli_query($conn,"SELECT rate, count(product) as purchase_req_items FROM tbl_purchase_req_detail where product='$itemid' and trans_parent_id='$userid'");
                                                                $purchase_req_query_value = mysqli_fetch_assoc($purchase_req_query);
                                                                $purchase_req_rate=$purchase_req_query_value['rate']; 
                                                                $purchase_req_items=$purchase_req_query_value['purchase_req_items'];

                                                                /////////////////////////////////////////////////////////

                                                                ///////////////////////////////////////////////////// Local Purchase  /////////////////////////////////////////////
                                                                $purchase_loc_query=mysqli_query($conn,"SELECT rate, count(product) as loc_items FROM tbl_single_purchase_detail where product='$itemid' $where_created");
                                                                $purchase_loc_query_value = mysqli_fetch_assoc($purchase_loc_query);
                                                                $purchase_loc_rate=$purchase_loc_query_value['rate']; 
                                                                $purchase_loc_items=$purchase_loc_query_value['loc_items'];

                                                                /////////////////////////////////////////////////////////
                                                                if($branch!='' && $user_privilege=='branch')
                                                                {
                                                                  $pur_pro = '';
                                                                }
                                                                else
                                                                {
                                                                  if($purchase_req_rate=='')
                                                                  {
                                                                    $pur_pro = '';
                                                                  }
                                                                  else
                                                                  {
                                                                    $pur_pro = ($purchase_req_rate-$pur_rate);
                                                                  }
                                                                }
                                                                
                                                                $tot_pur=$pur_rate*$pur_items;
                                                                $tot_pur_rtn=$pur_rtn_rate*$pur_return_items;
                                                                $tot_pur_req=$purchase_req_rate*$purchase_req_items;
                                                                //$pur_pro =$tot_pur-$tot_pur_req;

                                                                $pur=($pur_items+$purchase_loc_items)-$pur_return_items;
                                                                $sale=($sale_items+$lease_items)-$sale_rtn_items;
                                                                $req=$purchase_req_items;
                                                                $stock=   $pur- $sale;   

                                                                 if($branch!='')
                                                                  {

                                                                    if($user_privilege!='branch')
                                                                               {

                                                                                $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and trans_parent_id='$created_by'";
                                                                  $result2 = mysqli_query($conn,$query2);
                                                                         while($row2 = mysqli_fetch_array($result2) ){
                                                                          $tran_qty = $row2['tran_qty'];


                                                                                }
                                                                                $total_qty=($pur-$sale)-$tran_qty;
                                                                               }
                                                                               else
                                                                               {

                                                                                $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and parent_id='$created_by'  and transfer='0'";
                                                                                $result2 = mysqli_query($conn,$query2);
                                                                                       while($row2 = mysqli_fetch_array($result2) ){
                                                                                        $tran_qty = $row2['tran_qty'];


                                                                                     }
                                                                                $total_qty=($pur-$sale)+$tran_qty;
                                                                               }
                                                                  }
                                                                  else
                                                                  {

                                                                 $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and transfer='0'";
                                                                                $result2 = mysqli_query($conn,$query2);
                                                                                       while($row2 = mysqli_fetch_array($result2) ){
                                                                                        $tran_qty = $row2['tran_qty'];


                                                                                     }
                                                                                $total_qty=$pur-$sale;
                                                                  }  
                                                                
                                                                  if($total_qty!='0')
                                                                  {
                                                                ?>
                                                        <tr>
                                                            <td><?php echo $itemid;?></td>
                                                            <td><?php echo $item_name;?></td>
                                                            <!-- <td class="text-right"><?php echo $pur_items;?></td> -->
                                                            <td class="text-right"><?php echo $pur_rate;?></td>
                                                            <td class="text-right"><?php echo $tran_qty;?></td>
                                                            <td class="text-right"><?php echo $purchase_req_rate;?></td>
                                                            <td class="text-right"><?php echo $pur_pro;?></td>
                                                            
                                                            <td class="text-right"><?php echo $purchase_loc_items;?></td>
                                                            <td class="text-right"><?php echo $purchase_loc_rate;?></td>
                                                            <td class="text-right"><?php echo $pur_return_items;?></td>
                                                            <td class="text-right"><?php echo $pur_rtn_rate;?></td>
                                                            <td class="text-right"><?php echo $sale_items;?></td>
                                                            <td class="text-right"><?php echo $sale_rate;?></td>
                                                            <td class="text-right"><?php echo $lease_items;?></td>
                                                            <td class="text-right"><?php echo $lease_rate;?></td>
                                                            <td class="text-right"><?php echo $sale_rtn_items;?></td>
                                                            <td class="text-right"><?php echo $sale_rtn_rate;?></td>
                                                            <td class="text-right"><?php echo $total_qty;?></td>
                                                            <td><button type="button" class="btn btn-info text-white" data-toggle="modal" data-target="#message<?php echo $itemid;?>">Details</button></td>
                                                        </tr>
                                                        <div id="message<?php echo $itemid;?>" class="modal fade" role="dialog">
                                                        <div class="modal-dialog">

                                                          <!-- Modal content-->
                                                          <div class="modal-content">
                                                            <div class="modal-header">
                                                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                              <h4 class="modal-title">Modal Header</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                              <p>Some text in the modal.</p>
                                                              <?php echo $itemid;?>
                                                            </div>
                                                            <div class="modal-footer">
                                                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                            </div>
                                                          </div>

                                                        </div>
                                                      </div>
                                                        <?php }  }?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane animated slideInUp" id="history" aria-expanded="false">
                                    <hr>
                                    <div class="mt-40"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>Item #</th>
                                                            <th>Item Name</th>
                                                            
                                                            <th>Status</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        
                                                        if($branch=='1' || $branch=='')
                                                        {
                                                     
                                                        $bsql1=mysqli_query($conn, "SELECT * FROM tbl_items WHERE
                                                              item_id NOT IN (SELECT 
                                                                      tbl_purchase_detail.product
                                                                  FROM
                                                                      tbl_items
                                                                          INNER JOIN
                                                                      tbl_purchase_detail  ON tbl_items.item_id = tbl_purchase_detail.product)
                                                                       AND item_id NOT IN (SELECT 
                                                                      tbl_single_purchase_detail.product
                                                                  FROM
                                                                      tbl_items
                                                                          INNER JOIN
                                                                      tbl_single_purchase_detail  ON tbl_items.item_id = tbl_single_purchase_detail.product)");
                                                        }
                                                        else
                                                        {
                                                
                                                           $bsql1=mysqli_query($conn,"SELECT * FROM tbl_items WHERE
                                                              item_id NOT IN (SELECT 
                                                                      tbl_purchase_req_detail.product
                                                                  FROM
                                                                      tbl_items
                                                                          INNER JOIN
                                                                      tbl_purchase_req_detail  ON tbl_items.item_id = tbl_purchase_req_detail.product where tbl_purchase_req_detail.parent_id='$created_by')
                                                                       AND item_id NOT IN (SELECT 
                                                                      tbl_single_purchase_detail.product
                                                                  FROM
                                                                      tbl_items
                                                                          INNER JOIN
                                                                      tbl_single_purchase_detail  ON tbl_items.item_id = tbl_single_purchase_detail.product where tbl_single_purchase_detail.parent_id='$created_by')"); 
                                                        }
                                                        while($value = mysqli_fetch_assoc($bsql1))   
                                                            {   
                                        
                                                                $itemid=$value['item_id']; 
                                                                $item_name=$value['item_name']; 
                                                        
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $itemid?></td>
                                                            <td><?php echo $item_name?></td>
                                                            
                                                            <td><span class="badge badge-danger">Empty</span></td>
                                                        </tr>
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
           title: 'Alkareem (Inventory Report for Location : <?php echo $branch_name;?>)',
           
          
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

          
          title: 'Alkareem (Inventory Report for Location : <?php echo $branch_name;?>)',

          
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
