<?php
include_once 'Pagination.class.php';
require_once 'includes/config.php';
error_reporting(0);
include "includes/session.php";
include "includes/head.php";
include "user_permission.php";


if (!isset($_SESSION['adminid'])) {
  header('Location: login.php');
}

// Add permission check
$page = 'pos_sale_list';
$sql1 = mysqli_query($conn, "SELECT page_id FROM tbl_menu where page_link='$page'");
$data = mysqli_fetch_assoc($sql1);
$page_id = $data['page_id'];

// Set permissions based on user
if ($userid == '1') {
  $P = 1;
  $U = 1;
  $D = 1;
  $W = 1;
} else {
  $query = mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
  $data = mysqli_fetch_assoc($query);
  $P = $data['P'];
  $U = $data['U'];
  $D = $data['D'];
  $W = $data['W'];
}

$baseURL = 'get_sale_data.php';
$limit = 20;
?>

<head>
    <!-- Add this line for Bootstrap Select CSS -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- Add Select2 CSS in the head section -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<style>
.col-md-2 {
    -ms-flex: 0 0 16.666667% !important;
    flex: 0 0 16.666667% !important;
    max-width: 13.666667% !important;
    padding-left: 6px !important;
    padding-right: 5px !important;
    /* max-width: 91px; */
}
</style>

<body class="theme-orange">
    <?php include "includes/loader.php"; ?>
    <?php

  include "includes/navbar.php";
  include "includes/sidebar.php";
  ?>

    <div id="main-content">
        <div class="container-fluid">
            <!-- Header section -->
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth">
                                <i class="fa fa-arrow-left"></i></a> Sales List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Sales</li>
                            <li class="breadcrumb-item active">Sales List</li>
                        </ul>
                    </div>
                    <?php include "includes/graph.php"; ?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <?php
            // Success Messages
            if (isset($_GET['added']) && $_GET['added'] == 'done') {
              echo '<div class="alert alert-success" id="success-alert">
                                    <strong>Success!</strong> Sale has been Added.
                                </div>';
            }
            if (isset($_GET['updated']) && $_GET['updated'] == 'done') {
              echo '<div class="alert alert-success" id="success-alert">
                                    <strong>Success!</strong> Sale has been Updated.
                                </div>';
            }
            if (isset($_GET['delete']) && $_GET['delete'] == 'done') {
              echo '<div class="alert alert-danger" id="success-alert">
                                    <strong>Success!</strong> Sale has been Deleted.
                                </div>';
            }
            if (isset($_GET['edit_customer']) && $_GET['edit_customer'] == 'done') {
              echo '<div class="alert alert-success" id="success-alert">
                                    <strong>Success!</strong> Customer Changed.
                                </div>';
            }
            if (isset($_GET['completed']) && $_GET['completed'] == 'done') {
              echo '<div class="alert alert-success" id="success-alert">
                                    <strong>Success!</strong> Sale Completed Successfully.
                                </div>';
            }
            ?>
                        <div class="body">
                            <!-- Search Filters -->
                            <div class="row mb-0">
                                <div class="col-md-12">
                                    <form id="searchForm">
                                        <div class="row clearfix">
                                            <!-- Date Range -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>From Date</label>
                                                    <input type="date" class="form-control" id="f_date" name="f_date">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>To Date</label>
                                                    <input type="date" class="form-control" id="t_date" name="t_date">
                                                </div>
                                            </div>

                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Table</label>
                                                    <select class="selectpicker form-control" data-live-search="true"
                                                        data-size="13" id="table_id" name="table_id">
                                                        <option value="">All Tables</option>
                                                        <?php
                            $table_query = mysqli_query($conn, "SELECT DISTINCT 
                                t.table_id, t.table_name 
                                FROM tbl_tables t 
                                LEFT JOIN tbl_sale s ON t.table_id = s.table_id 
                                ORDER BY t.table_name");
                            while ($table = mysqli_fetch_assoc($table_query)) {
                              echo "<option value='" . $table['table_id'] . "' 
                    data-tokens='" . $table['table_name'] . "'>"
                                . $table['table_name'] . "</option>";
                            }
                            ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Created By Dropdown -->
                                            <!-- only show to admin -->
                                            <?php if ($userid == '1') { ?>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Created By</label>
                                                    <select class="form-control" id="created_by" name="created_by">
                                                        <option value="">All Users</option>
                                                        <?php
                              $user_query = mysqli_query($conn, "SELECT DISTINCT u.user_id, u.user_name 
                                                            FROM users u 
                                                            INNER JOIN tbl_sale s ON u.user_id = s.created_by 
                                                            ORDER BY u.user_name");
                              while ($user = mysqli_fetch_assoc($user_query)) {
                                echo "<option value='" . $user['user_id'] . "'>" . $user['user_name'] . "</option>";
                              }
                              ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <?php } ?>
                                            <!-- Status Dropdown -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Status</label>
                                                    <select class="form-control" id="status" name="status">
                                                        <option value="0">Pending</option>
                                                        <option value="1">Completed</option>
                                                        <option value="all">All Status</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Customer Dropdown -->
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label>Customer</label>
                                                    <select class="selectpicker form-control" data-live-search="true"
                                                        id="customer" name="customer_id">
                                                        <option value="">All Customers</option>
                                                        <?php
                            $customer_query = mysqli_query($conn, "SELECT customer_id, username, mobile_no1 
                                     FROM tbl_customer 
                                     ORDER BY username ASC");
                            while ($customer = mysqli_fetch_assoc($customer_query)) {
                              echo "<option value='" . $customer['customer_id'] . "'>"
                                . $customer['username'] . " - " . $customer['mobile_no1'] . "</option>";
                            }
                            ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- Search Button -->
                                            <div class="col-md-2">
                                                <div class="form-group" style="margin-top: 28px;">
                                                    <button type="button" class="btn btn-primary"
                                                        onclick="searchFilter(0)">
                                                        Search
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <div class="form-group"
                                                    style="margin-top: 25px; margin-left: 150px; margin-right: 5px;">
                                                    <button id="bulkComplete" class="btn btn-success"
                                                        onclick="completeSelected()">
                                                        <i class="icon-check"></i> Cash
                                                    </button>
                                                    <button id="bulkComplete" class="btn btn-warning"
                                                        onclick="completeBankSelected()">
                                                        <i class="icon-check"></i> Bank
                                                    </button>

                                                    <a href='javascript:void(0);'
                                                        class='btn btn-danger open-payment-modal' title='Payment'
                                                        data-toggle='modal' onclick="openMultiPaymentModal()"
                                                        data-target='#choose_payment_multi'> Payment </a>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>

                            <!-- Add this class to remove space -->
                            <div class="search-panel mt-0">
                                <div class="form-row align-items-end">
                                    <div class="form-group col-md-1 mb-0">
                                        <label class="small mb-1">Records</label>
                                        <select class="form-control form-control-sm" onchange="pageFilter();"
                                            id="pageFilter">
                                            <option>20</option>
                                            <option>40</option>
                                            <option>60</option>
                                            <option>80</option>
                                            <option>100</option>
                                            <option>200</option>
                                            <option>500</option>
                                            <option>1000</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-7 mb-0">
                                    </div>
                                    <div class="form-group col-md-4 mb-0">
                                        <label class="small mb-1">Search</label>
                                        <input type="text" class="form-control form-control-sm" id="keywords"
                                            placeholder="Type keywords..." onkeyup="searchFilter();">
                                    </div>
                                </div>
                            </div>

                            <!-- Data Container -->
                            <div class="table-responsive" id="dataContainer">
                                <!-- Data will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Edit Modal -->
    <div class="modal fade" id="customerEditModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-xl">
            <div class="modal-content" style="padding: 10px;">
                <div class="modal-body" id="customer_detail">
                    <!-- Customer edit form will be loaded here -->
                    <button type="button" class="btn btn-primary">Add Customer</button>
                </div>
            </div>
        </div>
    </div>



    <!-- Include your scripts -->
    <script src="assets_light/bundles/libscripts.bundle.js"></script>
    <script src="assets_light/bundles/vendorscripts.bundle.js"></script>
    <script src="assets_light/bundles/datatablescripts.bundle.js"></script>
    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="assets_light/bundles/mainscripts.bundle.js"></script>

    <!-- Bootstrap Select -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Add Select2 JS before closing body tag -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
    $(document).ready(function() {
        $('.selectpicker').selectpicker();
        searchFilter(0);

        // Alert auto-hide
        $("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
            $("#success-alert").slideUp(500);
        });

        $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
            $("#danger-alert").slideUp(500);
        });

        // Function to initialize Select2
        function initializeSelect2() {
            $(".customer_details").select2({
                placeholder: "Search for a customer...",
                allowClear: true,
                width: "100%",
                minimumInputLength: 1,
                dropdownParent: $(
                    "#customerEditModal") // This ensures dropdown shows correctly in modal
            });
        }

        // Initialize Select2 when modal is shown
        $('#customerEditModal').on('shown.bs.modal', function() {
            initializeSelect2();
        });

        // When modal is hidden (closed)
        $('#customerEditModal').on('hidden.bs.modal', function() {
            // Show the existing loader
            $("#loading").show();

            // Reload page after a brief delay
            setTimeout(function() {
                location.reload();
            }, 500); // Half second delay to ensure loader is visible
        });
    });

    // Customer details function
    function get_details(sale_id, customer_id) {
        var dataString = 'sale_id=' + sale_id + '&customer_id=' + customer_id;

        $.ajax({
            type: "POST",
            url: "operations/get_details_customer.php",
            data: dataString,
            success: function(response) {
                $("#customer_detail").html(response);
                $("#customerEditModal").modal('show');
            }
        });
    }

    function searchFilter(page_num) {
        page_num = page_num ? page_num : 0;
        var limit = $('#pageFilter').val();
        var keywords = $('#keywords').val();

        $.ajax({
            type: 'POST',
            url: 'get_sale_data.php',
            data: {
                page: page_num,
                limit: limit,
                keywords: keywords,
                f_date: $('#f_date').val(),
                t_date: $('#t_date').val(),
                created_by: $('#created_by').val(),
                status: $('#status').val(),
                saleid: $('#saleid').val(),
                customer_id: $('#customer').val(),
                table_id: $('#table_id').val(),
                game_type: $('#game_type').val(),
                U: '<?php echo $U; ?>',
                D: '<?php echo $D; ?>'
            },
            beforeSend: function() {
                $('#dataContainer').html('<div class="loading">Loading...</div>');
            },
            success: function(html) {
                $('#dataContainer').html(html);
                // Execute any scripts that were loaded
                var scripts = $('#dataContainer script');
                if (scripts.length > 0) {
                    scripts.each(function() {
                        $.globalEval($(this).text());
                    });
                }
            }
        });
    }

    function pageFilter() {
        searchFilter(0); // Reset to first page when changing page size
    }
    </script>

    <style>
    @media (min-width: 768px) {
        .col-md-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
            /* padding-bottom: 0px; */
            max-height: 86px !important;
        }
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
        margin: 0 2px;
    }


    .loading {
        text-align: center;
        padding: 20px;
    }

    #success-alert {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
    }

    .bootstrap-select .dropdown-menu {
        max-height: 200px !important;
        max-width: 300px !important;
    }

    .bootstrap-select .dropdown-menu .inner {
        max-height: 150px !important;
    }

    .search-panel {
        background: transparent;
        padding: 0;
        box-shadow: none;
        margin-top: -80px;
    }

    .search-panel .form-control {
        height: 31px;
        border-radius: 4px;
    }

    .search-panel label {
        color: #495057;
    }

    #keywords {
        height: 35px;
    }

    #pageFilter {
        height: 35px;
    }
    </style>
</body>

</html>