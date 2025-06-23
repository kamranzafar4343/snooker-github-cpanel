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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Notification List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Notification</li>
                            <li class="breadcrumb-item active">Notification List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

                        <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="mobile-left">
                            <a class="btn btn-primary toggle-email-nav collapsed" data-toggle="collapse" href="#email-nav" role="button" aria-expanded="false" aria-controls="email-nav">
                                <span class="btn-label">
                                    <i class="la la-bars"></i>
                                </span>
                                Menu
                            </a>
                        </div>
                        <div class="mail-inbox">
                           
                            <div class="col-md-12 mail-right">
                                <div class="header d-flex align-center">
                                    <h2>Notification List</h2>
                                    <form class="ml-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Mail" aria-label="Search Mail" aria-describedby="search-mail">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="search-mail"><i class="icon-magnifier"></i></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                
                                <div class="mail-list">
                                    <ul class="list-unstyled">
                                            <?php
                                                $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                                $data = mysqli_fetch_assoc($query);
                                                $user_privilege=$data['user_privilege'];
                                                if($user_privilege=='superadmin')
                                                {
                                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req  order by purchase_req_id desc limit 5");
                                                
                                                $count=0;
                                                while($pdata = mysqli_fetch_assoc($sql))   
                                                {
                                                    $count++; 
                                                    $purchase_req_id=$pdata['purchase_req_id'];
                                                    $admin_read=$pdata['admin_read'];
                                                    $remarks=$pdata['po_remarks'];
                                                    $invoice_date=$pdata['created_date'];
                                                    if ($admin_read=='1')
                                                    {
                                                        $read="";
                                                    }
                                                    else
                                                    {
                                                        $read="unread";
                                                    }      
                                                    $location=$pdata['location'];
                                                    $bsql1=mysqli_query($conn,"SELECT * from users where user_id='$location'");
                                                    $pdata1 = mysqli_fetch_assoc($bsql1);
                                                    $branch_name=$pdata1['user_name'];


                                            ?>
                                        <li class="clearfix <?php echo $read;?>">
                                            <div class="mail-detail-right">
                                                <h6 class="sub"><a href="main_purchase_req_list.php" class="mail-detail-expand"><?php echo $branch_name;?></a> has request<span class="badge badge-danger mb-0">Purchase Req</span></h6>
                                                <p class="dep"><span class="m-r-10">[Remarks]</span><?php echo $remarks;?>.</p>
                                                <span class="time"><?php echo $invoice_date;?></span>
                                            </div>
                                            <div class="hover-action">
                                                <a class="btn btn-warning mr-2 mark_as_read" href="javascript:void(0);" data-id="<?php echo $purchase_req_id;?>">Mark as read</a>
                                                
                                            </div>
                                        </li>
                                        <?php }}
                                         else
                                            {
                                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where location='$userid' and item_transfer!='' order by purchase_req_id desc limit 5");
                                                  $count=0;
                                                while($pdata = mysqli_fetch_assoc($sql))   
                                                {
                                                    $count++; 
                                                    $purchase_req_id=$pdata['purchase_req_id'];
                                                    $branch_read=$pdata['branch_read'];
                                                    $remarks=$pdata['po_remarks'];
                                                    $invoice_date=$pdata['created_date'];
                                                    if ($branch_read=='1')
                                                    {
                                                        $read="";
                                                    }
                                                    else
                                                    {
                                                        $read="unread";
                                                    }      
                                                    $location=$pdata['from_location'];
                                                    $bsql1=mysqli_query($conn,"SELECT * from users where user_id='$location'");
                                                    $pdata1 = mysqli_fetch_assoc($bsql1);
                                                    $branch_name=$pdata1['user_name'];


                                            ?>
                                        <li class="clearfix <?php echo $read;?>">
                                            <div class="mail-detail-right">
                                                <h6 class="sub"><a href="purchase_req_list.php" class="mail-detail-expand"><?php echo $branch_name;?></a> has transferred goods against<span class="badge badge-success mb-0"> Req Invoice # <?php echo $purchase_req_id;?></span></h6>
                                                <p class="dep"><span class="m-r-10">[Remarks]</span><?php echo $remarks;?>.</p>
                                                <span class="time"><?php echo $invoice_date;?></span>
                                            </div>
                                            <div class="hover-action">
                                                 <a class="btn btn-warning mr-2 mark_as_read" href="javascript:void(0);" data-id="<?php echo $purchase_req_id;?>">Mark as read</a>
                                            </div>
                                        </li>
                                        <?php }
                                                }?>
                                       
                                        
                                    </ul>
                                </div>
                             
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
        "order": [[ 8, "desc" ]]
    } );
} );
</script>
<script type="text/javascript">
     $('.mark_as_read').on('click',(function(e) {
        
        e.preventDefault();
        var req_id = $(this).attr('data-id');
        
        $.ajax({
            url:"operations/mark_as_read.php",
            method:"POST",
            data:{req_id:req_id},
            success:function(data){
                location.reload();
            }
        });
    }));
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
