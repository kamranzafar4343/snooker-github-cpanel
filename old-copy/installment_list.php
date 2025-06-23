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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Installments</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Installments</li>
                            <li class="breadcrumb-item active">Installment List</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Installment List</h2>
                            
                        </div>
                        <div class="body">
                            <?php if($c_write=='1'){?>
                                        <tr>
                                            <th colspan="8" class="text-right"><a href="installment.php"><button type="button" class="btn  btn-simple btn-md btn-success btn-info">Add Installments</button></a></th>
                                           
                                        </tr>
                                        <?php }?>
                            <button type="button" class="btn  btn-simple btn-sm btn-default btn-filter active" data-target="all">Total</button>
                            <button type="button" class="btn  btn-simple btn-sm btn-success btn-filter " data-target="approved">Completed</button>
                        
                            <button type="button" class="btn  btn-simple btn-sm btn-info btn-filter" data-target="pending">Pending</button>
                            
                            <div class="body project_report">

                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                <thead > 
                                            
                                            <th>Customer Name</th>
                                            <th>Item Name</th>
                                            <th>Total Amount</th>
                                            <th>Installment Period</th>
                                            <th>Installment Cleared</th>
                                            
                                            <th>Collected by</th>
                                            <th>Created Date</th>  
                                            <th>Status</th> 
                                            <th>Action</th> 
                                    </thead>                            
                                    <tbody>
                                        <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_installment where installment_status='Completed' order by plan_id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $plan_id=$pdata['plan_id'];
                                    $customer=$pdata['customer'];
                                    $total_price=$pdata['total_price'];
                                    $down_payment=$pdata['down_payment'];
                                    $created_date=$pdata['created_date'];
                                    $created_by=$pdata['created_by'];
                                    $item_id=$pdata['item_id'];
                                    $installment_status=$pdata['installment_status'];
                                    $period=$pdata['period'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_customer where c_id='$customer'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername1=$cdata['username'];

                                   $query2 = mysqli_query($conn,"SELECT COUNT(payment_id) FROM tbl_installment_payment where plan_id='$plan_id'"); 
                          
                                   $fdata = mysqli_fetch_assoc($query2) ;
                                   $payments=$fdata['COUNT(payment_id)'];

                                   $query3 = mysqli_query($conn,"SELECT item_name FROM tbl_items where id='$item_id'"); 
                          
                                   $idata = mysqli_fetch_assoc($query3) ;
                                   $item_name=$idata['item_name'];
                                   
                                  
                                ?>
                                        <tr data-status="approved">
                                            
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $item_name;?></td>
                                            <td><?php echo $total_price;?></td>
                                            <td><?php echo $period;?></td>
                                            <td><?php echo $payments;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Collected by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $created_date;?></td>
                                            <td><span class="badge badge-success">Completed</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                                <a href="installment_detail.php?planid=<?php echo $plan_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                                <a href="add_sale.php?edit_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?sale_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                        <?php }?>
                                          <?php
                                        $count=0;
                                        $sql = mysqli_query($conn,"SELECT * FROM tbl_installment where installment_status='Pending' order by plan_id asc");
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $plan_id=$pdata['plan_id'];
                                    $customer=$pdata['customer'];
                                    $total_price=$pdata['total_price'];
                                    $down_payment=$pdata['down_payment'];
                                    $created_date=$pdata['created_date'];
                                    $created_by=$pdata['created_by'];
                                    $installment_status=$pdata['installment_status'];
                                    $period=$pdata['period'];
                                    $item_id=$pdata['item_id'];
                                
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_customer where c_id='$customer'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername1=$cdata['username'];

                                   $query2 = mysqli_query($conn,"SELECT COUNT(payment_id) FROM tbl_installment_payment where plan_id='$plan_id'"); 
                          
                                   $fdata = mysqli_fetch_assoc($query2) ;
                                   $payments=$fdata['COUNT(payment_id)'];
                                   
                                   $query3 = mysqli_query($conn,"SELECT item_name FROM tbl_items where id='$item_id'"); 
                          
                                   $idata = mysqli_fetch_assoc($query3) ;
                                   $item_name=$idata['item_name'];
                                  
                                ?>
                                        <tr data-status="pending">
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $item_name;?></td>
                                            <td><?php echo $total_price;?></td>
                                            <td><?php echo $period;?></td>
                                            <td><?php echo $payments;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php echo $user_profile;?>" data-toggle="tooltip" data-placement="top" title="Collected by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $created_date;?></td>
                                            <td><span class="badge badge-danger">Pending</span></td>
                                            <?php if($c_write=='1'){?>
                                            <td class="project-actions">
                                                <a href="installment_detail.php?planid=<?php echo $plan_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                                <a href="add_sale.php?edit_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <a href="operations/delete.php?sale_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="icon-trash"></i></a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                         <?php }?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                            <div class="col-sm-12">
                                    <div class="mt-4">
                                        <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>

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
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script>
    $(document).ready(function () {
        $('.star').on('click', function () {
            $(this).toggleClass('star-checked');
        });

        $('.ckbox label').on('click', function () {
            $(this).parents('tr').toggleClass('selected');
        });

        $('.btn-filter').on('click', function () {
            var $target = $(this).data('target');
            if ($target != 'all') {
                $('.table tr').css('display', 'none');
                $('.table tr[data-status="' + $target + '"]').fadeIn('slow');
            } else {
                $('.table tr').css('display', 'none').fadeIn('slow');
            }
        });
    });
</script>
<script>
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
</script> 
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/table-filter.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:49 GMT -->
</html>
