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
<?php
include "includes/loader.php";

?>

   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Purchase Return List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Purchase Return</li>
                            <li class="breadcrumb-item active">Purchase Return List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                         <?php
              
              if(isset($_GET['added']) && $_GET['added']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Purchase Return has been Added.
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
  
  <strong>Great !</strong> Purchase Return has been Updated.
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
                         if(isset($_GET['delete']) && $_GET['delete']=='successful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Purchase Return has been Deleted.
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
                             <?php if($W=='1'){?>
                          <div class=" text-right">
                              <a href="purchase_return.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add/Edit Purchase Return
                            </button>
                          </a>

                          
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead >
                                  
                                        <tr>                                            
                                            <th >Invoice #</th>
                                            <th>Vendor Name</th>
                                            <th>Payment Method</th>
                                           
                                            <th>Net Amount</th>
                                      
                                             <th>Amount Recieved</th>
                                            <th>Created by</th>
                                            <th>Created Date</th>
                                            <?php if($p_write=='1'){?>
                                            <th>Action</th>
                                             <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                $count=0;
                                
                                    // $d_id=$_GET['d_id'];
                                $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_return where return_type='PO_purchase' and created_by='$userid' order by purchase_return_id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $purchase_return_id=$pdata['purchase_return_id'];
                                    $vendor_id=$pdata['vendor_id'];
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $payment_method=$pdata['payment_method'];
                                    $amount_received = $pdata['amount_received'];
                                    $purchase_id = $pdata['purchase_id'];
                                    
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_vendors where vendor_id='$vendor_id'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $vendor_name=$cdata['username'];
                                  
                                ?>
                                        <tr>
                                            <td class="project-title" >
                                                <h6><?php echo $purchase_return_id;?></h6>
                                                
                                            </td>
                                            <td><?php echo $vendor_name;?></td>
                                            <td><?php echo $payment_method;?></td>
                                            <td><?php echo $net_amount;?></td>
                                          
                                             <td><?php echo $amount_received;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                        
                                            <td class="project-actions">
                                                <!-- <a href="sale_invoice.php?sale_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                                <a href="add_sale.php?edit_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a> -->
                                                <?php if($D=='1'){?>
                                                <a href="operations/delete.php?purchase_return_id=<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
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
        "order": [[ 6, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
