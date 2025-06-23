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
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>

   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Direct Transfer List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Direct Transfer</li>
                            <li class="breadcrumb-item active">Direct Transfer List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                      <?php
              
              if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Purchase Req data is in use..
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
                        
              
              if(isset($_GET['added']) && $_GET['added']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Direct transfer Items has been Added.
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
  
  <strong>Great !</strong> Direct transfer has been Updated.
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
  
  <strong>Great !</strong> Direct transfer has been Deleted.
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

                         if(isset($_GET['stock']) && $_GET['stock']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Items transfered Successful.
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
                $page_name=basename($_SERVER['PHP_SELF']);
                $base_page_name=explode('.', $page_name);
                $page=$base_page_name[0];
               
                $sql1=mysqli_query($conn,"SELECT page_id  FROM tbl_menu where page_link='$page'");
                $data = mysqli_fetch_assoc($sql1);
                $page_id=$data['page_id'];
                
                $query=mysqli_query($conn,"SELECT P, U, D, W  FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $P=$data['P'];
                $U=$data['U'];
                $D=$data['D'];
                $W=$data['W'];
                if($userid=='1')
                {
                    $P=1;
                    $U=1;
                    $D=1;
                    $W=1;
                }

              ?>
                        <div class="body project_report">
                          <br>
                            <?php if($W=='1'){?>
                          <div class=" text-right">
                          <a href="add_items_iemi.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Items (IEMI)
                            </button>
                          </a>
                          <a href="add_transfer_items_gen.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Items
                            </button>
                          </a>
                          <a href="add_direct_transfer_iemi.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Direct Transfer (IEMI)
                            </button>
                          </a>
                          <a href="add_direct_transfer_gen.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Direct Transfer
                            </button>
                          </a>
                        
                          
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                 <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead>
                                      
                                        <tr>                                            
                                            <th>Pur Req #</th>
                                            <th>Invoice No</th>
                                           
                                            <th>Stock Status</th>
                                            <th>From Location</th>
                                            <th>To Location</th>
                                            <th>Net Amount</th>
                                            <th>Total Item</th>
                                            <th>Item Transfered</th>
                                            <th>Item Recieved</th>
                                            <th>Remarks</th>
                                            
                                            <th>Created by</th>
                                            <th>Created Date</th>
                                   
                                            
                                            <th>Action</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                $count=0;
                                
                                    // $d_id=$_GET['d_id'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where transfer_type='1'");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $purchase_req_id=$pdata['purchase_req_id'];
                                    
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y H:i a", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $invoice_no=$pdata['invoice_no'];
                                    $item_total=$pdata['item_total'];
                                    $item_transfer=$pdata['item_transfer'];
                                    $stock_status=$pdata['stock_status'];
                                    $from_location=$pdata['from_location'];
                                    $item_transfer=$pdata['item_transfer'];
                                    $location=$pdata['location'];
                                    $iemi=$pdata['iemi'];
                                    $po_remarks=$pdata['po_remarks'];
                                    $item_recieved=$pdata['item_recieved'];
                                    $count++;
                                    if($iemi=='0')
                                    {
                                        $color="background-color: white;";
                                        $href="add_local_sale.php";
                                    }
                                    else if($iemi=='1')
                                    {
                                       $color="background-color: #abe0e3;";
                                       $href="add_local_sale_iemi.php";
                                    }
                                    $query1 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$from_location"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query1) ;
                                   $from_location_name=$zdata['user_name'];

                                   $query2 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$location"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query2) ;
                                   $to_location_name=$zdata['user_name'];
            
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];

                                  
                                ?>
                                        <tr style="<?php echo $color;?>">
                                            <td class="project-title" >
                                                <h6><?php echo $purchase_req_id;?></h6>
                                                
                                            </td>
                                            <td class="project-title" >
                                                <h6><?php echo $invoice_no;?></h6>
                                                
                                            </td>
                                          
                                            <td><span class="badge badge-success"><?php echo $stock_status;?></span></td>
                                            <td><?php echo $from_location_name;?></td>
                                            <td><?php echo $to_location_name;?></td>
                                            <td><?php echo $net_amount;?></td>
                                            <td><?php echo $item_total;?></td>
                                            <td><?php echo $item_transfer;?></td>
                                            <td><?php echo $item_recieved;?></td>
                                            <td><?php echo $po_remarks;?></td>
                                           
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                           
                                            <td class="project-actions">
                                              
                                                <a href="purhase_req_invoice.php?purchase_req_id=<?php echo $purchase_req_id;?>" class="btn btn-sm btn-outline-info js-sweetalert" title="View" data-type="confirm"><i class="icon-eye"></i></a>
                                                <?php if($D=='1'){?>
                                                <a href="operations/delete.php?direct_transfer_id=<?php echo $purchase_req_id;?>"  <?php echo $display;?> class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                                <?php }?>
                                            </td>
                                        
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

<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="assets_light/js/pages/ui/dialogs.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 11, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
