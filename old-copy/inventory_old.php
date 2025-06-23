<!doctype html>
<html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";
include_once 'Pagination.class.php'; 
session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
$baseURL = 'get_inventory_data.php'; 
$limit = 10; 
?>

<body class="theme-orange">

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Inventory Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Inventory Report</li>
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


                         <form  action="inventory.php" id="form1"method="post" enctype="multipart/form-data">
                        <div class="body">
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                     
<div class="row clearfix">
                                    <div class="col-md-2 text-right" >
                                         <label for="description">Location </label>
                                    </div>
                              <div class="col-md-5">

                                    <div class="form-group">
                                <select class="form-control mb-3 show-tick" name="branch" >

                                  <?php
                                  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
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
                                <div class="col-md-5">
                                  <div style="margin-right: 40%;" class="text-center">
                                        <button  type="submit" class="btn btn-primary" name="purchase_rep" target='_blank'>Search</button>
                                    </div>
                                </div>
                            </div>
                   
                               
                          
                    </form>
                    </div>
                    <hr>
                      <div class="card">
                        <div class="body">
                          <div class="row clearfix">
                          
                         <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example" class="display" style="width:100%">
                                    
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Item#</th>                                                        
                                                            <th>Name</th>
                                              
                                                            <th class="text-right">Stock</th>
                                                            <th class="text-right">Status</th>
                                                            <th class="text-right">Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
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

  
                                                      if($items!='')
                                                            {

                                                              if($items=="All")
                                                              {
                                                                 
                                                                $where_items="";

                                                              }
                                                              else
                                                              {
                                                                
                                                                $where_items='where c.item_id="'.$items.'"';
                                                               
                                                               
                                                                 
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
                                                                   
                                                        $bsql=mysqli_query($conn,"SELECT item_id, item_name, item_model, brand_id
                                                          FROM tbl_items AS c
                                                             LEFT JOIN
                                                             tbl_purchase_detail AS o
                                                             ON c.item_id = o.product
                                                             $where_items group by c.item_id");
                                                      
                                                     
                                                        $datafound=mysqli_num_rows($bsql);

                                                            $tot_items=0;
                                                            $count=0;
                                                      while($value = mysqli_fetch_assoc($bsql))   
                                                            {   
                                        
                                                                $itemid=$value['item_id']; 
                                                                $itemidmodel=$value['item_id']; 
                                                                $item_name=$value['item_name']; 
                                                                $item_model=$value['item_model'];
                                                                $brand_id=$value['brand_id'];

                                                                $sql2=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
                                                                $value2 = mysqli_fetch_assoc($sql2);
                                                                $brand_name=$value2['cat_name'];
                                                                ///////////////////////////////////////////////////// 
                                                                // and created_date='$date'
                                                                //Purchase  ////////////////////////////////////////////////////

                                                                $pur_query=mysqli_query($conn,"SELECT rate, SUM(qty_rec) as pur_items FROM tbl_purchase_detail where product='$itemid' $where_created");
                                                                $pur_query_value = mysqli_fetch_assoc($pur_query);
                                                                $pur_rate=$pur_query_value['rate']; 
                                                                $pur_items=$pur_query_value['pur_items']; 

                                                                ///////////////////////////////////////////////////// Purchase Return  /////////////////////////////////////////////
                                                                $pur_rtn_query=mysqli_query($conn,"SELECT rate, SUM(return_qty) as pur_return_items  FROM tbl_purchase_return_detail as pur_return_items where product='$itemid' $where_created");
                                                                $pur_rtn_query_value = mysqli_fetch_assoc($pur_rtn_query);
                                                                $pur_rtn_rate=$pur_rtn_query_value['rate']; 
                                                                $pur_return_items=$pur_rtn_query_value['pur_return_items'];

                                                                 /////////////////////////////////////////////////////  

                                                                ///////////////////////////////////////////////////// Sale  /////////////////////////////////////////////////////////////
                                                                $sale_query=mysqli_query($conn,"SELECT rate, SUM(qty) as sale_items FROM tbl_sale_detail  where product='$itemid' $where_created");
                                                                $sale_query_value = mysqli_fetch_assoc($sale_query);
                                                                $sale_rate=$sale_query_value['rate']; 
                                                                $sale_items=$sale_query_value['sale_items'];

                                                                ///////////////////////////////////////////////////// Sale Return /////////////////////////////////////////////
                                                                $sale_rtn_query=mysqli_query($conn,"SELECT rate, SUM(returned_qty) as sale_return_items FROM tbl_sale_return_detail  where product='$itemid' $where_created");
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
                                                                $purchase_req_query=mysqli_query($conn,"SELECT rate, SUM(qty_rec) as purchase_req_items FROM tbl_purchase_req_detail where product='$itemid' and trans_parent_id='$userid'");
                                                                $purchase_req_query_value = mysqli_fetch_assoc($purchase_req_query);
                                                                $purchase_req_rate=$purchase_req_query_value['rate']; 
                                                                $purchase_req_items=$purchase_req_query_value['purchase_req_items'];

                                                                /////////////////////////////////////////////////////////

                                                                ///////////////////////////////////////////////////// Local Purchase  /////////////////////////////////////////////
                                                                $purchase_loc_query=mysqli_query($conn,"SELECT rate, SUM(qty_rec) as loc_items FROM tbl_single_purchase_detail where product='$itemid' $where_created");
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
                                                                $stock=$pur-$sale;   

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
                                                                                $tot_items += $total_qty;
                                                                               }
                                                                               else
                                                                               {

                                                                                $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and parent_id='$created_by'  and transfer='0'";
                                                                                $result2 = mysqli_query($conn,$query2);
                                                                                       while($row2 = mysqli_fetch_array($result2) ){
                                                                                        $tran_qty = $row2['tran_qty'];


                                                                                     }

                                                                                $total_qty=($pur-$sale)+$tran_qty;
                                                                                $tot_items += $total_qty;
                                                                               }
                                                                  }
                                                                  else
                                                                  {

                                                                 $query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and transfer='0' and recieved='1'";
                                                                                $result2 = mysqli_query($conn,$query2);
                                                                                       while($row2 = mysqli_fetch_array($result2) ){
                                                                                        $tran_qty = $row2['tran_qty'];


                                                                                     }
                                                                               
                                                                                $total_qty=($pur-$sale);
                                                                                $tot_items += $total_qty;
                                                                                
                                                                  }  
                                                                
                                                                  if($total_qty!='0')
                                                                  {

                                                                ?>
                                                                <input type="hidden" name="created_by" id="created_by" value="<?php echo $created_by;?>">
                                                        <tr>
                                                            <td><?php echo $itemid; $item_in_stock=$itemid;

                                                             
                                                            
                                                            ?></td>
                                                            <td ><?php echo $brand_name.' '.$item_name;?></td>
                                                            <td class="text-right"><?php echo $total_qty;?></td>
                                                            <td class="text-right"><span class="badge badge-success">Available</span></td>  
                                                            <td class="text-right"><button type="button" class="btn btn-info text-white "  onclick="get_details(<?php echo $itemidmodel;?>, <?php echo $branch;?>);">Details</button></td>
                                                        </tr>
                                                          
                                                          
                                                        <?php }  else{
                                                          
                                                          $bsql2=mysqli_query($conn, "SELECT * FROM tbl_items WHERE item_id='$itemid'");
                                                           while($value = mysqli_fetch_assoc($bsql2))   
                                                            {   
                                        
                                                                $itemid=$value['item_id']; 
                                                                $item_name=$value['item_name']; 
                                                                $itemidmodel=$value['item_id']; 
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $itemid?></td>

                                                            <td ><?php echo $brand_name.' '.$item_name;?></td>
                                                            <td class="text-right">0</td>
                                                            <td class="text-right"><span class="badge badge-danger">Empty</span></td>
                                                            <td class="text-right"><button  type="button" class="btn btn-danger text-white " onclick="get_details(<?php echo $itemidmodel;?>, <?php echo $branch;?>);">Detail</button></td>
                                                        </tr>
                                                    <?php }

                                                        }} ?>
                                                        
                                                   
                                                       
                                                         
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
<button hidden="" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" id="open_model">Item Detail</button>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="padding: 10px;">
        <table class="table table-striped" id="item_detail">
        </table>
        <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<button hidden=""  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="edit_model">
   modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Update Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="operations/update_req_price.php" method="post" enctype="multipart/form-data">
            <div class="row clearfix"> 
                <div class='col-md-12 col-sm-4'>
                    <div class="form-group">        
                        <input type="text" name="purchase_req_rate" id="purchase_req_rate" required="" class="form-control" placeholder="" value="">
                         <input type="hidden" name="item_id" id="item_id" required="" class="form-control" placeholder="" value="">
                    </div>
                </div>
            </div>
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" id="update_price">Save changes</button>
      </div>
  </form>
    </div>
  </div>
</div>
    
</div>


<!-- Javascript -->
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


 <script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>
<script type="text/javascript">
$(document).ready(function() {
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   true,
      "order": [[ 3, "asc" ]],
      
      "info":     false,
      searching: true,
      buttons: [
        {
          extend: 'pdfHtml5',
          text: '<?php echo $c_name;?>',
           title: '<?php echo $c_name;?> (Inventory Report for Location : <?php echo $branch_name;?>)',
           
          
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

          
          title: '<?php echo $c_name;?> (Inventory Report for Location : <?php echo $branch_name;?>)',

          
        },


      ]


    });
} );
</script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
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
</script>

<script type="text/javascript">

    function get_details(itemid, branchid)
 {
if(isNaN(branchid) || branchid=='')
{
  
  var branchid=0;
}
var dataString = 'itemid='+ itemid + '&branchid=' + branchid;

    $.ajax({

type: "POST",
url: "operations/get_details_model.php",
data: dataString,

success: function(responce){

  $("#open_model").click();
  $("#item_detail").empty();
  $("#item_detail").html(responce);
}
});

}

 function update_price(itemid, purchase_req_rate)
 {
    $("#edit_model").click();
    $("#purchase_req_rate").focus();
    $("#purchase_req_rate").val(purchase_req_rate);
    $("#item_id").val(itemid);

    }
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
