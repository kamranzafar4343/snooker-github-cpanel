<?php 
// Include pagination library file 
include_once 'Pagination.class.php'; 
 
// Include database configuration file 
require_once 'includes/config.php'; 
 error_reporting(0);
include "includes/session.php";

include "includes/head.php";
include "user_permission.php";
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
<style type="text/css">
  .webgrid-table-hidden
{
    display: none;
}
</style>
 <?php 
 if($_POST)
{
  
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $cat=$_POST['cat'];
  if($cat=='All')
      {
        $where_cat="";
      }
      else
      {
        $where_cat="where tbl_items.brand_id=".$cat."";

      }
}
else
{
  $f_date = date('Y-m-d');  
  $t_date = date('Y-m-d');
  $where_cat="";
}
?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
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
                <div class="col-lg-12">
                    
                    <div class="card">
                      <div class="body">
                         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger"   id="danger-alert" style="display:none;">
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date !
                                </div>
                         <form  action="new_stock_report.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if($f_date){echo $f_date;}else{?><?php echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-3">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if($t_date){echo $t_date;}else{?><?php echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <label for="description">Company </label>
                                    <div class="form-group">
                                    <select class="form-control users"  name="cat">
                                        <option selected="selected" value="All">All</option>
                                           <?php
                                            $sql="SELECT * FROM tbl_catagory"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['id']==$cat)
                                            {
                                            echo "<option value=$row[id] selected>$row[cat_name]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[id]>$row[cat_name]</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        </div>
                                </div>
                                 <div class="col-md-2 col-sm-12">
                                    <label for="description">Stock Zero </label>
                                    <div class="form-group">
                                    <select class="form-control users"  name="stock">
                                      
                                        <?php if($_POST['stock']=='zero'){?>
                                        <option  value="All">All</option>
                                        <option  value="zero" selected>No Zero</option>
                                        <?php }else{?>
                                        <option  value="All" selected>All</option>
                                        <option  value="zero">No Zero</option>
                                        <?php }?>
                                        
                                        </select>
                                        </div>
                                </div>
                               
                               <div class="col-md-1 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="detail" onclick="check()" >Detail</button>
                                 </div>
                                
                                </div>
                    </form>
                <div class="table-responsive">


        
        <table class="table table-hover table-striped m-b-0 c_list" id="customersTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Code</th>
                <th scope="col">Name</th>
                <th scope="col">Opening Stock</th>  
                <th scope="col">Amount</th>  
                <th scope="col">Purchase Stock</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Stock</th>
                <th scope="col">Amount</th>
                <th scope="col">Sale Stock</th> 
                <th scope="col">Amount</th>
                <th scope="col">Sale Return Stock</th> 
                <th scope="col">Amount</th>
                <th scope="col">Available Stock</th>    
                <th scope="col">Amount</th>                                                 
      
            </tr>
        </thead>
        <tbody>
           <?php
           $stock_check=$_POST['stock']; 
           
           $sql = "SELECT * FROM tbl_items $where_cat";
$result = mysqli_query($conn, $sql);
$count=0;
while($data = mysqli_fetch_assoc($result)) {
$count++;
                        $id = $data['item_id'];
                        $retail = $data['retail'];
                        $purchase = $data['purchase'];
                        $gramage = $data['gramage'];
                        $item_name = $data['item_name'];
                        $barcode = $data['barcode'];
                        $category = $data['category'];
                        $created_date = $data['created_date'];
                        $branch=1;
                        $itemidmodel=$id;
                        $sql2=mysqli_query($conn, "SELECT catagory_name FROM tbl_cat WHERE id='$category'");
                        $data1= mysqli_fetch_assoc($sql2);
                        $catagory_name = $data1['catagory_name'];
                    /////////////////////////////////////////////////////////
                     $pur_qty_op=0;
                      $pur_rtn_qty_op=0;
                      $sold_qty_op=0;
                      $sale_returned_qty_op=0;  
                $sql0 = "SELECT  SUM(return_qty) as pur_rtn_qty FROM tbl_purchase_return_detail where product='$id' and date(created_date)<'$f_date'";
                  $result1 = mysqli_query($conn,$sql0);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_rtn_qty_op = $row1['pur_rtn_qty'];
                     }
                     if($pur_rtn_qty_op=='')
                     {
                       $pur_rtn_qty_op=0;
                     }
                $sql1 = "SELECT  SUM(qty_rec) as pur_qty FROM tbl_purchase_detail where product='$id'  and date(created_date)<'$f_date'";
                  $result1 = mysqli_query($conn,$sql1);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_qty_op = $row1['pur_qty'];

                     }
                     if($pur_qty_op=='')
                     {
                       $pur_qty_op=0;
                     }

                    $sql2 = "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$id'  and date(created_date)<'$f_date'";
                                      

                      $result1 = mysqli_query($conn,$sql2);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $sold_qty_op = $row1['sold_qty'];


                     }
                     if($sold_qty_op=='')
                     {
                       $sold_qty_op=0;
                     }
                

                    $sql3 = "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$id'  and date(created_date)<'$f_date'";
                        $result3 = mysqli_query($conn,$sql3);
                               while($row3 = mysqli_fetch_array($result3) ){
                                 $sale_returned_qty_op = $row3['sale_returned_qty'];


                             }
                        if($sale_returned_qty_op=='')
                     {
                       $sale_returned_qty_op=0;
                     }
                
                    $stock_qty_op=round(($pur_qty_op-$pur_rtn_qty_op)-($sold_qty_op-$sale_returned_qty_op), 0);
                    if($stock_qty_op=='')
                     {
                       $stock_qty_op=0;
                     }
                    $stock_op_amount= round($stock_qty_op*$purchase, 0);

                      //////////////////////////////////////////////////////////////////////
                      $pur_qty=0;
                      $pur_rtn_qty=0;
                      $sold_qty=0;
                      $sale_returned_qty=0;  
                $sql0 = "SELECT  SUM(return_qty) as pur_rtn_qty FROM tbl_purchase_return_detail where product='$id'  and date(created_date) between '$f_date' and '$t_date'";
                  $result1 = mysqli_query($conn,$sql0);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_rtn_qty = $row1['pur_rtn_qty'];
                     }
                     if($pur_rtn_qty=='')
                     {
                       $pur_rtn_qty=0;
                     }
                $sql1 = "SELECT  SUM(qty_rec) as pur_qty FROM tbl_purchase_detail where product='$id'  and date(created_date) between '$f_date' and '$t_date'";
                  $result1 = mysqli_query($conn,$sql1);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $pur_qty = $row1['pur_qty'];

                     }
                     if($pur_qty=='')
                     {
                       $pur_qty=0;
                     }

                    $sql2 = "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$id'  and date(created_date) between '$f_date' and '$t_date'";
                                      

                      $result1 = mysqli_query($conn,$sql2);
                       while($row1 = mysqli_fetch_array($result1) ){
                        $sold_qty = $row1['sold_qty'];


                     }
                     if($sold_qty=='')
                     {
                       $sold_qty=0;
                     }
                
                     $sold_amount=round($sold_qty*$retail, 0);
                    $sql3 = "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$id'  and date(created_date) between '$f_date' and '$t_date'";
                        $result3 = mysqli_query($conn,$sql3);
                               while($row3 = mysqli_fetch_array($result3) ){
                                 $sale_returned_qty = $row3['sale_returned_qty'];


                             }
                        if($sale_returned_qty=='')
                     {
                       $sale_returned_qty=0;
                     }
                    $sold_rtn_amount=round($sale_returned_qty*$retail, 0);
                    $stock_qty=round(($pur_qty-$pur_rtn_qty)-($sold_qty-$sale_returned_qty), 0); 
                    if($stock_qty=='')
                     {
                       $stock_qty=0;
                     }
                    $purchase_tot=round($pur_qty-$pur_rtn_qty);
                    if($purchase_tot=='')
                     {
                       $purchase_tot=0;
                     }
                    $stock_now=round($stock_qty_op+$purchase_tot-($sold_qty-$sale_returned_qty),0);
                    $stock_now_amount=round($stock_now*$purchase, 0);
                    $purchase_amount=round($purchase_tot*$purchase, 0);
                    $item_name= $catagory_name." ".$data['item_name'];
                    $stock_t=round($stock_qty_op+$purchase_tot,0);
                    $stock_t_am=round($stock_op_amount+$purchase_amount,0);

if($stock_check=='zero' && $stock_now!='0')
{ 

?>
            <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $data['item_id'];?></td>
                <td><?php echo $item_name;?></td>
                <td><?php echo $stock_qty_op;?></td>
                <td><?php echo $stock_op_amount;?></td>
                <td><?php echo $purchase_tot;?></td>
                <td><?php echo $purchase_amount;?></td>
                <td><?php echo $stock_t;?></td>
                <td><?php echo $stock_t_am;?></td>
                <td><?php echo $sold_qty;?></td>
                <td><?php echo $sold_amount;?></td>
                <td><?php echo $sale_returned_qty;?></td>
                <td><?php echo $sold_rtn_amount;?></td>
                <td><?php echo $stock_now;?></td>
                <td><?php echo $stock_now_amount;?></td>
            </tr>
        <?php }else if($stock_check=='All'){

        ?>
         <tr>
                <td><?php echo $count;?></td>
                <td><?php echo $data['item_id'];?></td>
                <td><?php echo $item_name;?></td>
                <td><?php echo $stock_qty_op;?></td>
                <td><?php echo $stock_op_amount;?></td>
                <td><?php echo $purchase_tot;?></td>
                <td><?php echo $purchase_amount;?></td>
                <td><?php echo $stock_t;?></td>
                <td><?php echo $stock_t_am;?></td>
                <td><?php echo $sold_qty;?></td>
                <td><?php echo $sold_amount;?></td>
                <td><?php echo $sale_returned_qty;?></td>
                <td><?php echo $sold_rtn_amount;?></td>
                <td><?php echo $stock_now;?></td>
                <td><?php echo $stock_now_amount;?></td>
            </tr>
        
       <?php } }?>
        </tbody>
            
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td class="stock_qty_op_t"></td>
                <td class="stock_op_amount_t"></td>
                <td class="purchase_tot_t"></td>
                <td class="purchase_amount_t"></td>
                <td class="stock_tot"></td>
                <td class="stock_tot_am"></td>
                <td class="sold_tot"></td>
                <td class="sold_amt_tot"></td>
                <td class="sold_rtn_tot"></td>
                <td class="sold_rtn_amt_tot"></td>
                <td class="stock_now_tot"></td>
                <td class="stock_now_amt_tot"></td>
            </tr>
        </tfoot>
      </table>
       
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
<style>
@media print {
    table {
        border-collapse: collapse !important;
        width: 100%;
    }
    table th, table td {
        border: 1px solid #000 !important;
        padding: 0px;
        font-size: 11px;
    }
}
</style>

<script type="text/javascript">

    $(document).ready(function() {
         $(".users").select2();
        $('#customersTable').dataTable({
            dom: 'Bfrtip',
            "pageLength": 50,
             select: true, 
            lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, 'All'],
            ],
            

            

            buttons: [
            {
                extend: 'print',
                text: '<?php echo $c_name;?>',
           
                title: '<?php echo $c_name;?> (Stock List)',
                 
                
                text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>',
                
                className: 'btn btn-success',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      },
               
                exportOptions: {
                    columns: [2,3,5,7,8,9,11,13,14],
                    modifier: {
                        selected: null
                    }
                }

            },
           
            {
                extend: 'pdf',
                 text: '<?php echo $c_name;?>',
           
                title: '<?php echo $c_name;?> (Stock List)',
                 
                
                text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
                
                className: 'btn btn-danger',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      },
                exportOptions: {
                    columns: [ 1, 2, 3, 5, 7, 8, 9, 10, 11, 12, 13, 14 ],
                    modifier: {
                        selected: null
                    }
                }
            },
            
        ],
        "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            stock_qty_op_t = api
                .column( 3, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".stock_qty_op_t").html(stock_qty_op_t);

            stock_op_amount_t = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".stock_op_amount_t").html(stock_op_amount_t);

            purchase_tot_t = api
                .column( 5, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".purchase_tot_t").html(purchase_tot_t);

            purchase_amount_t = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".purchase_amount_t").html(purchase_amount_t);

            stock_tot = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".stock_tot").html(stock_tot);

             stock_tot_am = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".stock_tot_am").html(stock_tot_am);

             sold_tot = api
                .column( 9, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".sold_tot").html(sold_tot);

            sold_amt_tot = api
                .column( 10, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".sold_amt_tot").html(sold_amt_tot);

            sold_rtn_tot = api
                .column( 11, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".sold_rtn_tot").html(sold_rtn_tot);

            sold_rtn_amt_tot = api
                .column( 12, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".sold_rtn_amt_tot").html(sold_rtn_amt_tot);

            stock_now_tot = api
                .column( 13, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".stock_now_tot").html(stock_now_tot);

             stock_now_amt_tot = api
                .column( 14, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".stock_now_amt_tot").html(stock_now_amt_tot);

        } 
       
         
        });

    });
    </script>
    

