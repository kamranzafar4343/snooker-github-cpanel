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
   $baseURL = 'get_sale_data.php'; 
   $limit = 20; 
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
  #data tr {
  display: none;
}
</style>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Sales List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Sales</li>
                            <li class="breadcrumb-item active">Sales List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                          <?php
              
              if(isset($_GET['added']) && $_GET['added']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Sale has been Added.
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
                         if(isset($_GET['updated']) && $_GET['updated']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Sale has been Updated.
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
                         if(isset($_GET['delete']) && $_GET['delete']=='done' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Sale has been Deleted.
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
              
                         if(isset($_GET['edit_customer']) && $_GET['edit_customer']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Customer Changed.
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
              
                         if(isset($_GET['completed']) && $_GET['completed']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Sale Completed Successfully.
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
                        <div class="body">
<div class="search-panel">
    <div class="form-row">
      <div class="form-group col-md-1">
            <select class="form-control" onchange="pageFilter();" id="pageFilter">
              <option>20</option>
              <option>40</option>
              <option>60</option>
              <option>80</option>
              <option>100</option>
              <option>200</option>
            </select>
        </div>
      <div class="form-group col-md-7">
      </div>
        <div class="form-group col-md-4">

            <input type="text" class="form-control" id="keywords" placeholder="Type keywords..." onkeyup="searchFilter();">
        </div>
        
       
    </div>
</div>
<div class="datalist-wrapper">
    <!-- Loading overlay -->
    
    
    <!-- Data list container -->
    <div id="dataContainer" style="overflow-y: auto;">
        <table class="table table-striped" >
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col" >Invoice #</th>
                <th scope="col" >Customer Name</th>
                <th scope="col" >Net Amount</th>
                <th scope="col" >Amount Recieved</th>
                <th scope="col" >Created Date</th>
                <th scope="col" >Status</th>
                <?php if($s_write=='1'){?>
                <th>Action</th>
                <?php }?>
             
            </tr>
        </thead>
        <tbody>
            <?php 

       
      // Count of all records 
      $query   = $conn->query("SELECT COUNT(*) as rowNum FROM tbl_sale"); 
      $result  = $query->fetch_assoc(); 
      $rowCount= $result['rowNum']; 
       
      // Initialize pagination class 
      $pagConfig = array( 
          'baseURL' => $baseURL, 
          'totalRows' => $rowCount, 
          'perPage' => $limit, 
          'contentDiv' => 'dataContainer', 
          'link_func' => 'searchFilter' 
      ); 
      $pagination =  new Pagination($pagConfig); 
       
      // Fetch records based on the limit

      $query_main = $conn->query("SELECT users.user_name, tbl_sale_detail.invoice_no, tbl_sale.*  FROM tbl_sale INNER JOIN users ON tbl_sale.created_by = users.user_id INNER JOIN tbl_sale_detail ON tbl_sale.sale_id = tbl_sale_detail.sale_id group by tbl_sale.sale_id ORDER BY tbl_sale.sale_id DESC LIMIT $limit"); 
      $net_amount_tot=0;
      $amount_recieved_tot=0;
            if($query_main->num_rows > 0){ 
              $count=0; 

                while($data = $query_main->fetch_assoc()){ 
                  $count++;
                        $sale_id=$data['sale_id'];
                        $customer_id=$data['customer_name'];
                        $query=mysqli_query($conn,"SELECT username FROM tbl_customer where customer_id='$customer_id'");
                        $data_customer = mysqli_fetch_assoc($query);
                        $customer_name=$data_customer['username'];
                        $table_id=$data['table_id'];
                        $sale_status=$data['sale_status'];
                        $sale_invoice = $data['invoice_no'];
                        $invoice_no = $data['invoice_no'];
                        //$customer_name = $data['username'];
                        $created_by = $data['user_name'];
                        $created_date = $data['created_date'];
                         $status=$data['status'];
                        if($status=='0')
                        {
                          $status='Pending';
                          $color="#bfbfbf";
                        }
                        else
                        {
                          $status='Completed';
                          $color="";
                        }
                        $date=date('Y-m-d');
                        $invoice_date=date("Y-m-d", strtotime($created_date));
                        $newDate = date("d-m-Y H:i", strtotime($created_date));
                        $net_amount = $data['gross_amount'];
                        $tax = $data['tax'];
                        $discount = $data['discount'];
                        $amount_recieved = $data['amount_recieved'];
                      
                                       
                                                        
    $big_invoice="<a  href='pos_sale_invoice.php?sale_id=".$sale_id."' class='btn btn-sm btn-outline-primary' title='Print'><i class='icon-printer'></i></a>"; 

    $small_invoice="<a  href='sale_pos_invoice.php?sale_id=".$sale_id."' class='btn btn-sm btn-outline-primary' title='Print'><i class='icon-eye'></i></a>";
    $customer_balance="<a  href='get_customer_balance.php?customer=".$customer_id."' target='_blank' class='btn btn-sm btn-outline-danger' title='Balance'>Balance</a>";
    $edit_customer='';
    

if($sale_status!='Completed'){
    $freeable='<a href="pos.php?free_id='.$sale_id.'&ref_id='.$sale_invoice.'" class="btn btn-sm btn-outline-success" title="Free Table">Free Table</a>';
    $completeButton = "<a href='complete.php?sale_id=".$sale_id."' class='btn btn-sm btn-outline-success'><i class='icon-pencil'></i> Complete</a>";
    $edit_customer='<a href="#"  class="btn btn-info px-2 font-weight-light" title="Edit details" onclick="get_details('.$sale_id.', '.$customer_id.');">Edit Customer</a>';
}
else
{
  $freeable='<a href="#" class="btn btn-sm btn-outline-success" title="Completed">Completed</a>';
  $completeButton ="";
}
    if($U=='1'){
    $updateButton = "<a href='pos.php?edit_id=".$sale_id."&ref_id=".$sale_invoice."' class='btn btn-sm btn-outline-success'><i class='icon-pencil'></i></a>";

    $returnButton ="<a href='sale_return.php?sale_id=".$sale_id."' class='btn btn-sm btn-outline-info'>Sale Return</a>";

    }
    if($D=='1'){
     $deleteButton ="<a href='operations/delete.php?pos_sale_id=".$sale_id."&ref_id=".$sale_invoice."' class='btn btn-sm btn-outline-danger deleteUser'><i class='icon-trash'></i></a>";
    }
    $action = $big_invoice." ".$small_invoice." ".$updateButton." ".$deleteButton." ".$returnButton." ".$completeButton." ".$edit_customer." ".$customer_balance;
    $net_amount_tot+=$data['net_amount'];
    $amount_recieved_tot+=$data['amount_recieved'];
            ?>
                <tr style="background-color: <?php echo $color;?>">
                    <th scope="row"><?php echo $count; ?></th>
                    <td style="font-size: 12px;"><?php echo $invoice_no;?></td>
                    <td style="font-size: 12px;"><span><?php echo $customer_name;?></span></td>
                    <td style="font-size: 12px;"><?php echo $net_amount;?></td>
                    <td style="font-size: 12px;"><?php echo $amount_recieved;?></td>
                    <td style="font-size: 12px;"><?php echo $newDate;?></td>
                    <td style="font-size: 12px;"><?php echo $status;?></td>
                    <td style="font-size: 12px;"><?php echo $action;?></td>
                </tr>
            <?php } 
            }else{ 
                echo '<tr><td colspan="6">No records found...</td></tr>'; 
            } 
            ?>
        </tbody>
        <tfoot class="bg-dark text-white">
          <tr>
            <th>Total</th>
            <th></th>
            <th></th>
            <th><?php echo $net_amount_tot;?></th>
            <th><?php echo $amount_recieved_tot;?></th>
            <th></th>
            <th></th>
            <th></th>
          </tr>
        </tfoot>
        </table>
        
        <!-- Display pagination links -->
        <?php echo $pagination->createLinks(); ?>
    </div>
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
        <div class="modal-body" id="customer_detail">
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

<script>
function searchFilter(page_num) {
    page_num = page_num?page_num:0;
    var limit=$('#pageFilter').val();
    var keywords = $('#keywords').val();
    var filterBy = $('#filterBy').val();
    $.ajax({
        type: 'POST',
        url: 'get_sale_data.php',
        data:'page='+page_num+'&limit='+limit+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainer').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
function pageFilter() {
    var limit=$('#pageFilter').val();
    var page_num = page_num?page_num:0;
    var keywords = $('#keywords').val();
    var filterBy = $('#filterBy').val();
    $.ajax({
        type: 'POST',
        url: 'get_sale_data.php',
        data:'page='+page_num+'&limit='+limit+'&keywords='+keywords,
        beforeSend: function () {
            $('.loading-overlay').show();
        },
        success: function (html) {
            $('#dataContainer').html(html);
            $('.loading-overlay').fadeOut("slow");
        }
    });
}
</script>
    <script type="text/javascript">

    function get_details(sale_id, customer_id)
 {

var dataString = 'sale_id='+ sale_id + '&customer_id=' + customer_id;;

    $.ajax({

type: "POST",
url: "operations/get_details_customer.php",
data: dataString,

success: function(responce){

  $("#open_model").click();
  $("#customer_detail").empty();
  $("#customer_detail").html(responce);

   $('.customer_details').select2({
        dropdownParent: $('#myModal')
    });

  
}
});

}
</script>
