<!doctype html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";

session_start();

if (isset($_SESSION['adminid'])) {
} else {
    header('Location: login.php');
}
?>

<body class="theme-orange">

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

    <!-- Page Loader -->
    <?php
    include "includes/loader.php";

    ?>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i
                                    class="fa fa-arrow-left"></i></a>Cash Flow Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Cash Flow Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>
                    <?php include "includes/graph.php"; ?>
                </div>
            </div>
            <?php
            if ($_POST) {
                $f_date = mysqli_real_escape_string($conn, $_POST['f_date']);
                $t_date = mysqli_real_escape_string($conn, $_POST['t_date']);
                $newDate1 = date("d-m-Y", strtotime($f_date));
                $newDate2 = date("d-m-Y", strtotime($t_date));
            } else {
                $f_date = date('Y-m-d');
                $t_date = date('Y-m-d');
                $newDate1 = date("d-m-Y", strtotime($f_date));
                $newDate2 = date("d-m-Y", strtotime($t_date));
            }
            ?>

            <body>
                <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: 30px;">
                    <div class="col-lg-12 col-md-12">
                        <div class="card invoice1">
                            <div class="body">
                                <?php
                                error_reporting(0);
                                $sql = mysqli_query($conn, "SELECT * FROM tbl_company ");
                                $data = mysqli_fetch_assoc($sql);
                                $c_name = $data['c_name'];
                                $c_address = $data['c_address'];
                                $c_phone = $data['c_phone'];
                                $c_mobile = $data['c_mobile'];
                                $image = $data['user_profile'];

                                ?>
                                <div class="row">
                                    <div class="invoice-top clearfix col-md-12">

                                        <div class="info text-center col-md-12" style="margin-top: 1%;">
                                            <h1 class="text-center"><?php echo $c_name; ?></h1>
                                            <h3 class="text-center">Cash Flow Report</h3>


                                        </div>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="clearfix text-center col-md-12">
                                        <div class="info text-center col-md-12">
                                            <p>(<?php echo $c_address; ?>)<br><?php echo $c_phone; ?></p>
                                        </div>
                                    </div>
                                </div>

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js">
                                </script>
                                <div class="alert alert-danger" id="danger-alert" style="display:none;">

                                    <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
                                </div>
                                <form action="cash_flow_report.php" method="post" enctype="multipart/form-data"
                                    id='form1'>
                                    <div class="body">

                                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="description">From Date </label>
                                                    <input type="date" class="form-control" name="f_date" id="f_date"
                                                        placeholder="Item Name *" required=""
                                                        value="<?php if ($_POST) {
                                                                                                                                                                        echo $f_date;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo date('Y-m-d');
                                                                                                                                                                    } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="description">To Date </label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" id="t_date" name="t_date"
                                                        placeholder="Item Name *" required=""
                                                        value="<?php if ($_POST) {
                                                                                                                                                                        echo $t_date;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo date('Y-m-d');
                                                                                                                                                                    } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12" style="margin-top:35px;">
                                                <button style="width:100%; " type="submit" class="btn btn-sm btn-dark"
                                                    name="purchase_rep" onclick="check()"
                                                    target='_blank'>Search</button>
                                            </div>
                                            <!-- <div class="col-md-2 col-sm-12" style="margin-top:35px;">
                                        <a href="index.php"><button style="width:100%; " type="button" class="btn btn-sm btn-danger">Back</button></a>
                                 </div> -->
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
                     padding-left: calc(var(--bs-gutter-x) * 0.5);">
                    <div class="col-lg-12 col-md-12">
                        <div class="card invoice1">
                            <div class="body">


                                <div class="row">

                                    <div class="clearfix text-right col-md-12">

                                        <span> <b>FROM DATE/TO DATE : </b> <?php echo $newDate1 . '/' . $newDate2; ?>
                                        </span>
                                    </div>
                                </div>
                                <hr>

                                <style>
                                #example {
                                    width: 100%;
                                    border-collapse: collapse;
                                    font-family: Arial, sans-serif;
                                    background-color: #f9f9f9;
                                    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                                    border-radius: 10px;
                                    overflow: hidden;
                                }

                                #example thead {
                                    background-color: #343a40;
                                    color: white;
                                    text-align: left;
                                }

                                #example th {
                                    padding: 12px 15px;
                                    font-size: 1.1em;
                                }

                                #example tbody tr {
                                    border-bottom: 1px solid #ddd;
                                }

                                #example tbody td {
                                    padding: 12px 15px;
                                    font-size: 1em;
                                    color: #555;
                                }

                                #example tbody tr:nth-child(even) {
                                    background-color: #f2f2f2;
                                }

                                #example tbody tr:hover {
                                    background-color: #e9ecef;
                                }

                                #example td h5,
                                #example td h6,
                                #example td h7 {
                                    margin: 0;
                                    padding: 0;
                                    font-size: 1em;
                                    color: #333;
                                }

                                #example td:last-child {
                                    text-align: center;
                                }

                                @media screen and (max-width: 600px) {
                                    #example {
                                        width: 100%;
                                        font-size: 0.9em;
                                    }

                                    #example td,
                                    #example th {
                                        padding: 8px 10px;
                                    }
                                }
                                </style>

                            </div>



                            <?php
                            $total_debit = 0;
                            $total_credit = 0;
                            $total_closing = 0;
                            // $user_id = 1;

                            // Fetch all accounts
                            $sql_accounts = mysqli_query($conn, "
                            SELECT LEFT(acode, 6) AS acode, aname, atype, opening_bal 
                            FROM tbl_account 
                            WHERE acode IN ('300100000', '300500000', '300400000', '100200000', '100500000', '500100000', '500200000', '500300000','500400000','500500000','500600000','500700000','500800000','500900000','5001000000')
                        ");
                            $accounts = [];

                            while ($row = mysqli_fetch_assoc($sql_accounts)) {
                                $acode = $row['acode'];
                                $aname = $row['aname'];
                                $atype = $row['atype'];
                                $opening_bal = $row['opening_bal'] ?? 0;

                                $acode_prefix = substr($acode, 0, 6);

                                // Current Period Debit and Credit
                                $sql_amounts = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit 
                            FROM tbl_trans_detail 
                            WHERE Left(acode, 6) = '$acode' 
                            AND date(created_date) BETWEEN '$f_date' AND '$t_date'");
                                $amounts = mysqli_fetch_assoc($sql_amounts);

                                $debit = $amounts['total_debit'] ?? 0;
                                $credit = $amounts['total_credit'] ?? 0;

                              // Now handle opening and closing
                              // Asset, revenue (formulae: opening+credit - debit)
                              if (in_array($atype, ['3'])) {

                                // Closing for Asset/revenue
                                $closing = ($credit) - $debit;

                            }

                            // expense
                           // (formulae: opening+debit - credit)
                             elseif (in_array($atype, ['1','5'])) {
                               
                                // Closing for expense
                                $closing = ($debit) - $credit;

                               
                            } else {
                                $opening = 0;
                                $closing = 0;
                            }
                                
                                // Save all into array
                                $accounts[] = [
                                    'acode' => $acode,
                                    'aname' => $aname,
                                    
                                    'debit' => $debit,
                                    'credit' => $credit,
                                    'closing' => $closing,
                                ];
                            }
                         
                           
                         
                  
                            //payable
                         $payable1 = mysqli_query($conn, "SELECT SUM(d_amount) as total_pay FROM `tbl_trans_detail` where LEFT(acode,6)='200200' and date(created_date) BETWEEN '$f_date' AND '$t_date'");
                            $payableR = mysqli_fetch_assoc($payable1);
                            $payable = $payableR['total_pay'] ?? 0;

                            $payable = round(($payable), 2);

                            //purchase
                        $sql_pur = mysqli_query($conn, "SELECT SUM(gross_amount) as purchase FROM tbl_purchase where date(created_date) BETWEEN '$f_date' AND '$t_date'");
                            $R_pur = mysqli_fetch_assoc($sql_pur);
                            $purchase = $R_pur['purchase'] ?? 0;

                        $purchase = round(($purchase), 2);

                            //total paid to vendor
                            $total_paid_to_vendor = round(($payable - $purchase), 2);
                            
                            ?>
                            <!-- Step 4: Display it on the page -->
                            <div class="row clearfix">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table id="example" class="display table table-bordered table-striped"
                                            style="width:100%">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Account</th>
                                                    <!-- <th>Opening Balance</th>
                                                    <th>Debit</th>
                                                    <th>Credit</th> -->
                                                    <th>Closing Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($accounts as $account):
                                                    
                                                    if (in_array($account['acode'], ['300100', '300500', '300400'])) {
                                                        $total_closing += $account['closing'];
                                                    }
                                                    else {
                                                        $total_closing -= $account['closing'];
                                                    }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-b-0 m-t-10 text-center">
                                                            <?php echo $account['aname']; ?></h6>
                                                    </td>

                                                    <td><span
                                                            class="m-b-0 m-t-6 text-right"><?php echo number_format($account['closing'], 2); ?></span>
                                                    </td>
                                                </tr>
                                                <?php endforeach; ?>

                                                <?php 
                                                
                                                ?>
                                                <tr>
                                                    <td>
                                                        <h6 class="m-b-0 m-t-10 text-center">
                                                            <?php echo 'Total Paid to Vendor'; ?></h6>
                                                    </td>
                                                    <td><span
                                                            class="m-b-0 m-t-6 text-right"><?php echo $total_paid_to_vendor; ?></span>
                                                    </td>

                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h6 class="m-b-0 m-t-10 text-center"><?php echo 'Purchases'; ?>
                                                        </h6>
                                                    </td>
                                                    <td><span
                                                            class="m-b-0 m-t-6 text-right"><?php echo $purchase; ?></span>
                                                    </td>

                                                </tr>



                                                <tr class="table-success">
                                                    <td>
                                                        <h4 class="m-b-0 m-t-10" style="text-align: center">
                                                            <b>Totals</b></h4>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-b-0 m-t-6"><?php 

                                                        $sql_prev_cash = mysqli_query($conn, "SELECT SUM(d_amount - c_amount) as prev_cash FROM tbl_trans_detail WHERE LEFT(acode, 9) in ('100100000') and date(created_date) < '$f_date'"); 
                                                        $fetch_cash = mysqli_fetch_assoc($sql_prev_cash);
                                                        $prev_cash_in_hand = $fetch_cash['prev_cash'] ?? 0;

                                                        $totals1 = $total_closing - $purchase - $total_paid_to_vendor;

                                                        $totals = $totals1 + $prev_cash_in_hand;
                                                        echo number_format(($totals), 2);
                                                        ?></h6>
                                                    </td>
                                                </tr>
                                                <tr class="table-info">
                                                    <td>
                                                        <h4 class="m-b-0 m-t-10" style="text-align: center"><b>Previous
                                                                Cash in hand</b></h4>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-b-0 m-t-6">
                                                            <?php echo number_format(($prev_cash_in_hand), 2); ?></h6>
                                                    </td>
                                                </tr>
                                                <tr class="table-secondary">
                                                    <td>
                                                        <h4 class="m-b-0 m-t-10" style="text-align: center"><b>Current
                                                                Cash in hand</b></h4>
                                                    </td>
                                                    <td>
                                                        <h6 class="m-b-0 m-t-6">
                                                            <?php echo number_format(($totals - $prev_cash_in_hand), 2); ?>
                                                        </h6>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- Add custom styles to enhance table design -->
                            <style>
                            .table thead th {
                                background-color: #343a40;
                                color: white;
                                text-align: center;
                                padding: 15px;
                            }

                            .table tbody td {
                                text-align: right;
                                vertical-align: middle;
                                padding: 12px;
                            }

                            .table-bordered td,
                            .table-bordered th {
                                border: 1px solid #dee2e6;
                            }

                            .table-striped tbody tr:nth-of-type(odd) {
                                background-color: #f8f9fa;
                            }

                            .table-info {
                                background-color: #d1ecf1;
                            }

                            .table-success {
                                background-color: #d4edda;
                            }

                            .table-hover tbody tr:hover {
                                background-color: #e9ecef;
                            }

                            .m-b-0,
                            .m-t-6 {
                                margin-bottom: 0;
                                margin-top: 6px;
                            }

                            .m-t-10 {
                                margin-top: 10px;
                            }
                            </style>



            </body>
            <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

            <script src="assets_light/bundles/libscripts.bundle.js"></script>
            <script src="assets_light/bundles/vendorscripts.bundle.js"></script>
            <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
            <script src="assets_light/bundles/mainscripts.bundle.js"></script>

            <script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
            <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
            <link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
            <script src="assets/select2/dist/js/select2.min.js"></script>

            <style type="text/css">
            .data-table-container {
                padding: 10px;
            }

            .dt-buttons .btn {
                margin-right: 3px;
            }
            </style>
            <script type="text/javascript">
            $(document).ready(function() {
                $('#example').DataTable({
                    dom: 'Bfrtip',
                    scrollY: true,
                    scrollX: false,
                    "paging": false,
                    "ordering": false,
                    "info": false,
                    searching: false,
                    buttons: [{
                            extend: 'pdfHtml5',
                            text: '<?php echo $c_name; ?>',

                            title: '<?php echo $c_name; ?> (Cash Flow Report)',


                            text: '<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',

                            className: 'btn btn-danger',

                            customize: function(doc) {
                                doc.content[1].table.widths =
                                    Array(doc.content[1].table.body[0].length + 1).join('*')
                                    .split('');
                                doc.styles.tableHeader = {

                                    alignment: 'left'
                                }
                            }

                        },
                        {
                            extend: 'print',
                            className: 'btn btn-success',
                            titleAttr: 'print',
                            text: '<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>',


                            title: '<?php echo $c_name; ?> (Cash Flow Report)',


                        },


                    ]


                });
            });
            </script>


            <!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->

</html>