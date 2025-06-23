<?php

require_once 'includes/config.php';
error_reporting(0);
include "includes/session.php";

include "includes/head.php";
include "user_permission.php";
if (isset($_SESSION['adminid'])) {
} else {
    header('Location: login.php');
}

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
        /* .webgrid-table-hidden
{
    display: none;
}
  .debit-column {
        background-color: #FF7043; 
    }
    .credit-column {
        background-color: #1ABC9C; 
    }
    .total-column {
        background-color: #3498DB; 
    } */
    </style>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Cash Book</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Cash Book</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>
                    <?php include "includes/graph.php"; ?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">

                    <?php

                    if (isset($_GET['update']) && $_GET['update'] == 'successful') {
                    ?>
                        <div class="alert alert-success" id="success-alert">

                            <strong>Great!</strong> Cash Book Updated Succesfully.
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#success-alert").hide();

                                $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });
                            });
                        </script>

                    <?php
                    }
                    if (isset($_GET['add']) && $_GET['add'] == 'successfull') {
                    ?>
                        <div class="alert alert-success" id="success-alert">

                            <strong>Great!</strong> Cash Book Added Succesfully.
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#success-alert").hide();

                                $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });
                            });
                        </script>

                    <?php
                    }
                    if (isset($_GET['delete']) && $_GET['delete'] == 'successfull') {
                    ?>
                        <div class="alert alert-success" id="success-alert">

                            <strong>Great!</strong> Cash Book Deleted Succesfully.
                        </div>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                        <script type="text/javascript">
                            $(document).ready(function() {
                                $("#success-alert").hide();

                                $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
                                    $("#success-alert").slideUp(500);
                                });
                            });
                        </script>

                    <?php
                    }

                    if (isset($_GET['delete']) && $_GET['delete'] == 'unsuccessful') {
                    ?>
                        <div class="alert alert-danger" id="danger-alert">

                            <strong>Opps!</strong>Failed to Delete, Because Data related to Vendor Exist in Transations..!
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


                    if (isset($_GET['update']) && $_GET['update'] == 'unsuccessful') {
                    ?>
                        <div class="alert alert-danger" id="danger-alert">

                            <strong>Opps!</strong>Failed to Update.
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
                    <div class="card">
                        <div class="body">
                            <h1 class="text-center"> Cash & Bank History</h1>
                            <?php if ($c_write == '1') { ?>
                                <div class=" text-right">

                                    <a href="index.php?openModal=true">
                                        <button class="btn btn-success m-b-15" type="button">
                                            <i class="icon wb-plus" aria-hidden="true"></i> Add Record
                                        </button>
                                    </a>

                                </div>
                            <?php } ?>
                            <div class="table-responsive">



                                <table class="table table-hover table-striped m-b-0 c_list" id="customersTable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Created At</th>
                                            <th scope="col">Type</th>
                                            <th scope="col" class="debit-column">Debit Amount</th>
                                            <th scope="col" class="credit-column">Credit Amount</th>
                                            <th scope="col" class="total-column">Balance</th>
                                            <th scope="col">Created By</th>
                                            <th scope="col">Remarks</th>
                                        </tr>
                                    </thead>
                                </table>

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

    <script src="assets/vendor/sweetalert/sweetalert.min.js"></script>

    <script src="assets_light/bundles/mainscripts.bundle.js"></script>

    <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#customersTable').DataTable({
                processing: true,
                serverSide: false,
                pageLength: 500, // <--show 100 entries
                ajax: {
                    url: "get_cash_book.php",
                    type: "GET",
                    error: function(xhr, error, thrown) {
                        console.log('DataTables error:', error);
                    }
                },
                columns: [{
                        data: 'count'
                    },
                    {
                        data: 'created_at'
                    },
                    {
                        data: 'type'
                    },
                    {
                        data: 'd_amount'
                    },
                    {
                        data: 'c_amount'
                    },
                    {
                        data: 'total_amount'
                    },
                    {
                        data: 'created_by'
                    },
                    {
                        data: 'remarks'
                    }
                ],
                
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'print',
                        title: 'Cash Book',
                        text: '<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span>',
                        className: 'btn btn-success',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdf',
                        title: 'Cash Book',
                        text: '<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
                        className: 'btn btn-danger',
                        exportOptions: {
                            columns: [1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ]
            });
        });
    </script>