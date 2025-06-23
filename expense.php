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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Expenses</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Accounts</li>
                            <li class="breadcrumb-item active">Expenses</li>
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
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom">
                                    <thead>
                                        <tr>
                                            <th>Item</th>
                                            <th>Order by</th>
                                            <th>From</th>
                                            <th>Date</th>
                                            <th>Paid By</th>                                            
                                            <th>Status</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>HP Computer</td>
                                            <td>Marshall Nichols</td>
                                            <td>Amazon</td>
                                            <td>07 March, 2018</td>
                                            <td><img src="../assets/images/paypal.png" class="rounded width45" alt="paypal"></td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>$205</td>
                                        </tr>
                                        <tr>
                                            <td>MacBook Pro</td>
                                            <td>Debra Stewart</td>
                                            <td>Amazon</td>
                                            <td>17 Jun, 2018</td>
                                            <td><img src="../assets/images/mastercard.png" class="rounded width45" alt="paypal"></td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                            <td>$800</td>
                                        </tr>
                                        <tr>
                                            <td>Dell Monitor 22 inch</td>
                                            <td>Ava Alexander</td>
                                            <td>Flipkart India</td>
                                            <td>21 Jun, 2018</td>
                                            <td><img src="../assets/images/mastercard.png" class="rounded width45" alt="paypal"></td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                            <td>$205</td>
                                        </tr>
                                        <tr>
                                            <td>Zebronics Desktop</td>
                                            <td>Marshall Nichols</td>
                                            <td>ebay UK</td>
                                            <td>22 July, 2018</td>
                                            <td><img src="../assets/images/paypal.png" class="rounded width45" alt="paypal"></td>
                                            <td><span class="badge badge-warning">Pending</span></td>
                                            <td>$355</td>
                                        </tr>
                                        <tr>
                                            <td>Logitech USB Mouse, Keyboard</td>
                                            <td>Marshall Nichols</td>
                                            <td>Amazon</td>
                                            <td>28 July, 2018</td>
                                            <td><img src="../assets/images/paypal.png" class="rounded width45" alt="paypal"></td>
                                            <td><span class="badge badge-success">Approved</span></td>
                                            <td>$40</td>
                                        </tr>
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
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/acc-expenses.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
