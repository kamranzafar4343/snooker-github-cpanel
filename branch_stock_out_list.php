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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Branch Stock Out List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Branch Stock Out</li>
                            <li class="breadcrumb-item active">Branch Stock Out List</li>
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
  
  <strong>Sorry !</strong> Stock out data is in use..
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
  
  <strong>Great !</strong> Branch stock out done.
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
  
  <strong>Great !</strong> Stock out has been Updated.
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
  
  <strong>Great !</strong> Stock out has been Deleted.
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
                            
                          <div class=" text-right">
                
                          <a href="branch_stock_out_iemi.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Stock Out (IEMI)
                            </button>
                          </a>
                          <a href="branch_stock_out.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Stock Out
                            </button>
                          </a>
                         
                        
                          
                          </div>
                          
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead>
                                      
                                        <tr>                                            
                                            <th>Pur Req #</th>
                                            <th>Invoice No</th>
                                           
                                            <th>Stock Status</th>
                                            <th>Stock Transfered</th>
                                           
                                      
                                            <th>Item Transfered</th>
                                            <th>Item Recieved</th>
                      
                                            <th>Remarks</th>
                                            
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
                                
                                    // $d_id=$_GET['d_id'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where from_location='$userid' and transfer_type='2'");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $purchase_req_id=$pdata['purchase_req_id'];
                                    $sql1 = mysqli_query($conn,"SELECT SUM(qty) as total_req FROM tbl_purchase_req_detail where purchase_req_id='$purchase_req_id' and qty_rec!=''");
                                    $reqdata = mysqli_fetch_assoc($sql1);
                                    $total_req=$reqdata['total_req'];
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['invoice_date'];
                                    $created_by=$pdata['created_by'];
                                    $invoice_no=$pdata['invoice_no'];
                                    $stock_receive_status=$pdata['stock_receive_status'];
                                    $stock_status=$pdata['stock_status'];
                                    if($stock_receive_status=='Pending')
                                    {
                                        $display="hidden";
                                    }
                                    else
                                    {
                                        $display="";
                                    }
                                    if($item_total=='')
                                        {
                                            $item_total1=$total_req;
                                            
                                        }
                                    else
                                    {
                                        $item_total1=$pdata['item_total'];
                                    }
                                    $item_total=$pdata['item_total'];
                                    $item_transfer=$pdata['item_transfer'];
                                    $item_recieved=$pdata['item_recieved'];
                                    $po_remarks=$pdata['po_remarks'];
                                     $iemi=$pdata['iemi'];
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                                   
                                    
                                   

                                    if($item_total!=$item_transfer)
                                    {
                                        $status="Partially Completed";
                                    }
                                    else if($item_total=='')
                                    {
                                         $status="Pending";
                                    }
                                    else
                                    {
                                        $status="Completed";
                                    }
                                    if($item_recieved=='0')
                                    {
                                         $rec_status="Pending";
                                    }
                                     else if($item_total!=$item_recieved)
                                    {
                                        $rec_status="Partially Completed";
                                    }
                                    
                                    else
                                    {
                                        $rec_status="Completed";
                                    }
                                    if($iemi=='0')
                                    {
                                        $color="background-color: white;";
                                    }
                                    else
                                    {
                                        $color="background-color: #abe0e3;";
                                    }
                                    if($iemi=='0' && $status=="Pending")
                                    {
                                        
                                        $href="add_purchase_req.php?purchase_req_id=".$purchase_req_id."";
                                    }
                                    else if($iemi=='1' && $status=="Pending")
                                    {
                                       
                                       $href="add_purchase_req_iemi.php?purchase_req_id=".$purchase_req_id."";
                                    }
                                    else if($iemi=='1' && $status=="Completed")
                                    {
                                       
                                       $href="req_transfer_grn_iemi.php?purchase_req_id=".$purchase_req_id."";
                                    }
                                    else if($iemi=='0' && $status=="Completed")
                                    {
                                       
                                       $href="req_transfer_grn.php?purchase_req_id=".$purchase_req_id."";
                                    }
                                    $date=date('Y-m-d');
                                    
                                    if($date > DATE($created_date) && $P!='1'){ 

                                        if($user_privilege=='superadmin')
                                        {
                                            $display="";
                                        }
                                        else
                                        {
                                            $display="";
                                        }
                                    }
                                    else
                                    {
                                     $display="";
                                    }
                                ?>
                                  
                            
                                        <tr style="<?php echo $color;?>">
                                            <td class="project-title" >
                                                <h6><?php echo $purchase_req_id;?></h6>
                                                
                                            </td>
                                            <td class="project-title" >
                                                <h6><?php echo $invoice_no;?></h6>
                                                
                                            </td>
                                          
                                            <td><span class="badge badge-success"><?php echo $status;?></span></td>
                                            
                                          
                                            <td><span class="badge badge-info"><?php echo $rec_status;?></span></td>
                               
                                            
                                            <td><?php echo $item_transfer;?></td>
                                            <td><?php echo $item_recieved;?></td>
                                            <td><?php echo $po_remarks;?></td>
                                           
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $created_date;?></td>
                                           
                                             
                                            <td class="project-actions">
                                       
                                               <!--   <?php if($U=='1'){?>
                                                <a <?php echo $display;?> href="<?php echo $href;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <?php }?> -->
                                                <a href="branch_out_invoice.php?purchase_req_id=<?php echo $purchase_req_id;?>" class="btn btn-sm btn-outline-info js-sweetalert" title="View" data-type="confirm"><i class="icon-eye"></i></a>
                                                 <?php if($D=='1'){?>
                                                    <a  <?php echo $display;?> href="operations/delete.php?branch_out_id=<?php echo $purchase_req_id;?>"  <?php echo $display;?> class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i>
                                                <?php }?>
                                                </a>
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
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
