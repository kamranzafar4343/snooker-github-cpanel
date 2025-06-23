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

session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Sale Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Sale Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php 
 if($_POST)
{
  
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  $sale_type=mysqli_real_escape_string($conn,$_POST['sale_type']);
  $user=mysqli_real_escape_string($conn,$_POST['users']);
  $customer=mysqli_real_escape_string($conn,$_POST['customer']);

  
}
else
{
  $sale_type = 'All';
  $user = 'All';
  $customer='All';
  $f_date = date('Y-m-d');  
  $t_date = date('Y-m-d');
  $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));
}
  if(isset($_GET['sale_type']))
  {
    $sale_type=$_GET['sale_type'];
    $f_date=$_GET['fdate'];
    $t_date=$_GET['tdate'];
    $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));
    $user = 'All';
    $customer='All';

  }
?>

<body>
   <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: 30px;">
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
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1 class="text-center"><?php echo $c_name;?></h1>
                                    <h3  class="text-center">Profit Report</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix text-center col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger"   id="danger-alert" style="display:none;">
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date !
                                </div>
                         <form  action="profit_report.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if($f_date){echo $f_date;}else{?><?php echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-6">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if($t_date){echo $t_date;}else{?><?php echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12" hidden>
                                    <label for="description">Sale Type </label>
                                    <div class="form-group">
                                    <select class="form-control select_group" name="sale_type" id='sale_type' >
                                      <?php if($sale_type=='Credit'){?>
                                        <option value="All">All</option>
                                        <option value="Credit" selected="">Credit</option>
                                        <option value="Cash">Cash</option>
                                      <?php }else if($sale_type=='Cash'){?>
                                        <option value="All">All</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Cash" selected="">Cash</option>
                                      <?php }else{?>
                                        <option value="All" selected="">All</option>
                                        <option value="Credit">Credit</option>
                                        <option value="Cash" >Cash</option>
                                      <?php }?>
                                    </select>
                                        </div>
                                </div>
                                <div class="col-md-3 col-sm-12" hidden>
                                    <label for="description">User </label>
                                    <div class="form-group">
                                    <select class="form-control users"  name="users">
                                        <option selected="selected" value="All">All</option>
                                           <?php
                                            $sql="SELECT * FROM users where user_privilege='Operator'"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$user)
                                            {
                                            echo "<option value=$row[user_id] selected>$row[user_name]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[user_id]>$row[user_name]</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        </div>
                                </div>
                                <div class="col-md-3 col-sm-12" hidden>
                                    <label for="description">Customer </label>
                                    <div class="form-group">
                                    <select class="form-control users"  name="customer">
                                        <option selected="selected" value="All">All</option>
                                           <?php
                                            $sql="SELECT * FROM tbl_customer"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['customer_id']==$customer)
                                            {
                                            echo "<option value=$row[customer_id] selected>$row[username] $row[mobile_no1]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[customer_id]>$row[username] $row[mobile_no1]</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        </div>
                                </div>
                                 <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                                 </div>
                             <!--   <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="detail" onclick="check()" >Detail</button>
                                 </div> -->
                                  <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-info" name="summary" onclick="check()">Summary</button>
                                 </div>
                                 <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                                 </div>
                                </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                         
               <?php
                        $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $sqll=mysqli_query($conn, "SELECT * FROM `tbl_sale`");
                                }
                                else
                                {
                                  $sqll=mysqli_query($conn, "SELECT * FROM `tbl_sale` where created_by='$userid'");
                                 
                                }  
                        
                        $dataa=mysqli_fetch_assoc($sqll);
                        $sale_id = $dataa['sale_id']; 
                        $customer_name = $dataa['customer_name']; 

                          ?>  

                               <div class="row">
                                   <div class="clearfix text-right col-md-6" >

                            <span > <h3><b>Sale Type  : </b> <?php echo $sale_type;?></h3>
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">

   <table id="example" class="display" style="width:100%">
        <thead class="thead-dark">
            <tr>
              <th>#</th> 
              <th>Product #</th>                          
              <th>Sale Quantity </th>
              <th>Rtn Quantity </th>
              <th>Net Quantity </th>
              <th>Price</th>
              <th>Total</th>
              <th>Purchase Price</th>
              <th>Profit</th>
            </tr>
         </thead>
         <tbody>
<?php

if($sale_type=='Credit')
  {  
      $where_saletype="and tbl_sale.sale_type='Credit'";

      if($user=='All')
      {
        $where_created="";
        $where_created_return="";
      }
      else
      {
        $where_created="and tbl_sale.created_by=".$user."";
        $where_created_return="and tbl_sale_return.created_by=".$user."";
      }
      if($customer=='All')
      {
        $where_customer="";
        $where_customer_return="";
      }
      else
      {
        $where_customer="and tbl_sale.customer_name=".$customer."";
        $where_customer_return="and tbl_sale_return.customer_name=".$customer."";

      }
    

    $csql=mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_saletype $where_customer $where_created group by tbl_sale_detail.product order by tbl_sale.created_date asc");

}
if($sale_type=='Cash')
  {  

      $where_saletype="and tbl_sale.sale_type='Cash'";

      if($user=='All')
      {
        $where_created="";
        $where_created_return="";
      }
      else
      {
        $where_created="and tbl_sale.created_by=".$user."";
        $where_created_return="and tbl_sale_return.sales_men=".$user."";
      }
      if($customer=='All')
      {
        $where_customer="";
        $where_customer_return="";
      }
      else
      {
        $where_customer="and tbl_sale.customer_name=".$customer."";
        $where_customer_return="and tbl_sale_return.customer_name=".$customer."";

      }

      $csql=mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_saletype $where_customer $where_created group by tbl_sale_detail.product order by tbl_sale.created_date asc");
  
    


}
else{

  if($user=='All')
      {
        $where_created="";
        $where_created_return="";
      }
      else
      {
        $where_created="and tbl_sale.created_by=".$user."";
        $where_created_return="and tbl_sale_return.sales_men=".$user."";
      }
      if($customer=='All')
      {
        $where_customer="";
        $where_customer_return="";
      }
      else
      {
        $where_customer="and tbl_sale.customer_name=".$customer."";
        $where_customer_return="and tbl_sale_return.customer_name=".$customer."";

      }

      $csql=mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_customer $where_created group by tbl_sale_detail.product order by tbl_sale.created_date asc");
}

$count=0;
$amount=0;
$qty_line=0;
while($value = mysqli_fetch_assoc($csql))   
      { 
        $sale_id=$value['sale_id'];
        $product=$value['product'];
        $rate=$value['rate'];
        $pur_item_id=$value['pur_item_id'];  

 $sql_recieved=mysqli_query($conn, "SELECT SUM(amount_recieved) as recieved_total, SUM(net_amount) as net_amount FROM tbl_sale where DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_customer $where_created");
                        $data1=mysqli_fetch_assoc($sql_recieved);
                        $recieved_total=$data1['recieved_total'];
                        $net_total=$data1['net_amount'];
       
$sql_return=mysqli_query($conn, "SELECT SUM(amount_returned) as return_totalt FROM tbl_sale_return where DATE(tbl_sale_return.created_date)   between '$f_date' and '$t_date' $where_customer_return $where_created_return");
                        $data1=mysqli_fetch_assoc($sql_return);
                        $return_totalt=$data1['return_totalt'];


 $sql_item=mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                        $data1=mysqli_fetch_assoc($sql_item);
                        $item=$data1['item_name']; 
                        $category=$data1['category']; 
  
  $sql2=mysqli_query($conn, "SELECT catagory_name FROM tbl_cat where id=$category");
                        $data1=mysqli_fetch_assoc($sql2);
                        $catagory_name = $data1['catagory_name'];
                      
$sql_qty=mysqli_query($conn, "SELECT SUM(qty) as qty_line FROM tbl_sale_detail INNER JOIN tbl_sale
ON tbl_sale_detail.sale_id = tbl_sale.sale_id WHERE DATE(tbl_sale.created_date) between '$f_date' and '$t_date' and tbl_sale_detail.product='$product' $where_created $where_customer");
                        $data1=mysqli_fetch_assoc($sql_qty);
                        $qty_line =$data1['qty_line'];
$sql_qty_return=mysqli_query($conn, "SELECT SUM(returned_qty) as return_qty_line FROM tbl_sale_return_detail INNER JOIN tbl_sale ON tbl_sale_return_detail.sale_id = tbl_sale.sale_id WHERE DATE(tbl_sale.created_date) between '$f_date' and '$t_date' and tbl_sale_return_detail.product='$product'  $where_created $where_customer");
                        $data2=mysqli_fetch_assoc($sql_qty_return);
                        $return_qty_line =$data2['return_qty_line'];
                        if($return_qty_line=='')
                        {
                          $return_qty_line=0;
                        }
                        $t_qty=$qty_line-$return_qty_line;
                        $amount=$t_qty*$rate;
                        $total_amount+=$amount;
$sql1=mysqli_query($conn, "SELECT rate FROM tbl_purchase_detail where  qty_rec!=''  and  transfer='0' and product='$product' and  pur_item_id='$pur_item_id'");
$data1=mysqli_fetch_assoc($sql1);
$pur_rate = round($data1['rate']*$t_qty, 0);

$profit=round($amount-$pur_rate, 0);                       
        $count++;
                        
?>  
<tr>
  <td><?php echo $count;?></td>
  <td><?php echo $product." - ".$catagory_name." ".$item;?></td>
  <td><?php echo $qty_line;?></td>
  <td><?php echo $return_qty_line;?></td>
  <td><?php echo $t_qty;?></td>
  <td><?php echo $rate;?></td>
  <td><?php echo $amount;?></td>
  <td><?php echo $pur_rate;?></td>
  <td><?php echo $profit;?></td>
</tr>

<?php } ?>

   
         </tbody>
          <tfoot>
                                      <tr class="bg-dark text-white">
                                        <th><h5>Total</h5></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h5><span class="qty_total"></span></h5></th>
                                        
                                        <th></th>
                                         <th><h5><span class="price_total"></span></h5></th>
                                          <th><h5><span class="pur_total"></span></h5></th>

                                        <th><h5><span class="profit_total"></span></h5></th>
                                        
                                        
                                      </tr>
                                    </tfoot>
       </table>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">                                    
                                             <h3 class="m-b-0 m-t-10" >Total Qty (<span class="qty_total"></span>)</h3>
                                             <h5 class="m-b-0 m-t-10">Net Total (<span><?php echo number_format($net_total);?></span>)</h5>
                                             <h5 class="m-b-0 m-t-10" >Total Recieved (<span><?php echo number_format($recieved_total);?></span>)</h5>
                                             <h5 class="m-b-0 m-t-10" >Total Returned (<span><?php echo number_format($return_totalt);?></span>)</h5>
                                             <h3 class="m-b-0 m-t-10" >Total Sale (<span><?php echo number_format($recieved_total-$return_totalt);?></span>)</h3>
                                             <h3 class="m-b-0 m-t-10" >Total Profit (<span class="profit_total"></span>)</h3>
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
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>

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
  $(".users").select2();
          $('#example').DataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   true,
      "ordering": false,
      "info":     false,
      searching: true,
      "processing": true,
      
      buttons: [
        'pageLength',
          {
          extend: 'pdf',
          text: 'PDF',
          footer: true,
          title: '<?php echo $c_name;?> (Sale Report for : <?php echo $sale_type;?> Sale)',
          orientation: 'landscape',
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
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
          footer: true,
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: '<?php echo $c_name;?> (Sale Report for : <?php echo $sale_type;?> Sale)',

          
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

            qtyTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
            

            netTotal = api
                .column( 6, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);
            
       

            netpurchase = api
                .column( 7, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

             netprofit = api
                .column( 8, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
            
          
            $(".qty_total").html(qtyTotal);
            $(".price_total").html(netTotal);
            $(".pur_total").html(netpurchase);
            $(".profit_total").html(netprofit);
            //  recTotal = api
            //     .column( 6, { page: 'current'} )
            //     .data()
            //     .reduce( function (a, b) {
            //         return intVal(a) + intVal(b);
            //     }, 0 ).toFixed(2);
            // $("#total_rec").html("Rs "+recTotal);

            // var balance=(netTotal-recTotal).toFixed(2);
            // $("#balance").html("Rs "+balance);
        } 
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
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('search_sale.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('search_sale.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>


</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
