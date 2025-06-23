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
 <style type="text/css">
     .card-header
     {
        border-bottom: 1px solid black !important;
     }
     @media print {
  .nodisplay {
    display: none;
  }
}
 </style>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Local Purchase List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Local Purchase</li>
                            <li class="breadcrumb-item active">Local Purchase List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                         <?php
      if(isset($_GET['edit']) && $_GET['edit']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Local Purchase Item's has been sold.
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
              if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Local Purchase Item's has been sold.
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
  
  <strong>Great !</strong> Local Purchase has been Added.
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
  
  <strong>Great !</strong> Local Purchase has been Updated.
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
  
  <strong>Great !</strong> Local Purchase has been Deleted.
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
              
                         if(isset($_GET['updated']) && $_GET['updated']=='wrong' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry  !</strong> You might have entered wrong amount or amount greater than net amount.
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
                            <a href="add_single_purchase_po.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>Local Purchase (IEMI)
                            </button>
                          </a>
                       
                          <a href="add_local_grn_iemi.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i>Local Purchase GRN (IEMI)
                            </button>
                          </a>
                          <a href="add_single_po.php">
                          <button  class="btn btn-danger m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i>Purchase Payment (IEMI)
                            </button>
                          </a>

                          <a href="add_single_pending_po_payment.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i>Pending Payment (IEMI)
                            </button>
                          </a>
                            <a href="single_purchase_po.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>Local Purchase
                            </button>
                          </a>
                          <a href="add_local_grn.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i>Local Purchase GRN
                            </button>
                          </a>
                          <a href="single_po.php">
                          <button  class="btn btn-danger m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i>Purchase Payment
                            </button>
                          </a>

                          <a href="single_pending_po_payment.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i>Pending Payment
                            </button>
                          </a>
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead>
                                      
                                        <tr>                                            
                                            <th>Local Purchase #</th>
                                            <th>Invoice No</th>
                                            <th>Customer Name</th>
                                            <th>Stock Status</th>
                                            <th>Payment Status</th>
                                            <th>Net Amount</th>
                                            
                                            <th>Discount</th>
                                            <th>Amount Payed</th>
                                            <th>Created by</th>
                                            <th>Created Date</th>
                                            <?php if($p_write=='1'){?>
                                            <th>Action</th>
                                            <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                        $page_name=basename($_SERVER['PHP_SELF']);
                                        $base_page_name=explode('.', $page_name);
                                        $page=$base_page_name[0];
                                       
                                        $sql1=mysqli_query($conn,"SELECT page_id  FROM tbl_menu where page_link='$page'");
                                        $data = mysqli_fetch_assoc($sql1);
                                        $page_id=$data['page_id'];
                              
                                        $query=mysqli_query($conn,"SELECT P  FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                                        $data = mysqli_fetch_assoc($query);
                                        $P=$data['P'];
                       
                                $count=0;
                                
                                $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                 $sql = mysqli_query($conn,"SELECT * FROM tbl_single_purchase order by purchase_id asc");
                                }
                                else
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_single_purchase where created_by='$userid' order by purchase_id asc");
                           
                                }
                                
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $purchase_id=$pdata['purchase_id'];
                                    $purchase_invoice="Local_Purchase_".$purchase_id;
                                    $vendor_id=$pdata['vendor_id'];
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $invoice_no=$pdata['invoice_no'];
                                    $amount_payed=$pdata['amount_payed'];
                                    $bill_status=$pdata['bill_status'];
                                    $payment_status=$pdata['payment_status'];
                                    $amount_recieved = $pdata['amount_recieved'];
                                    $iemi = $pdata['iemi'];
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_vendors where vendor_id=$vendor_id"); 
                                   
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername=$cdata['username'];
                                     if($iemi)
                                    {
                                        $color="background-color: #abe0e3;";
                                        $href="add_single_purchase_po.php";
                                    }
                                    else
                                    {
                                       $color="background-color: white;";
                                       $href="single_purchase_po.php";
                                    }
                                    $date=date('Y-m-d');
                            
                                    if($date > $created_date && $P!='1'){ 
                                        if($user_privilege=='superadmin')
                                        {
                                            $display="";
                                        }
                                        else
                                        {
                                            $display="hidden";
                                        }
                                    }
                                    else
                                    {
                                     $display="";
                                    }
                                ?>
                                        <tr style="<?php echo $color;?>"> 
                                            <td class="project-title" >
                                                <h6><?php echo $purchase_invoice;?></h6>
                                                
                                            </td>
                                            <td class="project-title" >
                                                <h6><?php echo $invoice_no;?></h6>
                                                
                                            </td>
                                            <td><?php echo $customername;?></td>
                                            <td><span class="badge badge-success"><?php echo $bill_status;?></span></td>
                                            <td><span class="badge badge-info"><?php echo $payment_status;?></span></td>
                                            <td><?php echo $net_amount;?></td>
                                            <td><?php echo $discount;?></td>
                                            <td><?php echo $amount_payed;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                             
                                            <td class="project-actions">
                                                <a href="local_purchase_invoice.php?purchase_id=<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                                <?php if($U=='1'){?>
                                                    <a <?php echo $display;?> href="loc_pur_invoice_list.php?purchase_id=<?php echo $purchase_id;?>&vendor_id=<?php echo $vendor_id;?>&created_at=<?php echo $created_date;?>" class="btn btn-sm btn-outline-secondary" title="Edit"><i class="icon-pencil"></i></a>
                                           
                                                <?php }?>
                                                <?php if($D=='1'){?>
                                                <a <?php echo $display;?> href="operations/delete.php?single_purchase_id=<?php  echo $purchase_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
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
        "order": [[ 9, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
