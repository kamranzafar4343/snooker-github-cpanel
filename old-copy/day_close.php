<!doctype html>
<html lang="en">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

<style>
    /* media query for report totals under the table  */

    /* Only apply these styles for screen (not print) below 768px */
    @media screen and (max-width: 767px) {
        .report-totals {
            display: flex !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
            width: 100% !important;
        }

        .report-totals .col-md-3 {
            flex: 1 !important;
            min-width: 25% !important;
            padding: 0 5px !important;
        }

        .report-totals h5 {
            font-size: 11px !important;
            white-space: nowrap !important;
            margin: 5px 0 !important;
        }

        /* First column (empty one) */
        .report-totals .col-md-3:first-child {
            display: none !important;
        }

        /* Adjust spacing for better mobile view */
        .report-totals hr {
            margin: 2px 0 !important;
        }
    }
</style>


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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Day Close Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Day Close Report</li>
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
                                            <h3 class="text-center">User Day Close Report</h3>
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

                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger" id="danger-alert" style="display:none;">

                                    <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
                                </div>
                                <form action="day_close.php" method="post" enctype="multipart/form-data" id='form1'>
                                    <div class="body">

                                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="description">From Date </label>
                                                    <input type="date" class="form-control" onfocus="this.showPicker()" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if ($_POST) {
                                                                                                                                                                                                    echo $f_date;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo date('Y-m-d');
                                                                                                                                                                                                } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="description">To Date </label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" onfocus="this.showPicker()" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if ($_POST) {
                                                                                                                                                                                                    echo $t_date;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo date('Y-m-d');
                                                                                                                                                                                                } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-sm-3" style="margin-top:31px;">
                                                <button style="width:100%;" type="submit" class="btn btn-sm btn-dark" name="purchase_rep" onclick="check()" target='_blank'>Search</button>
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

                                        <div class="row clearfix" style="margin-bottom: 20px;">
                                            <div class="col-md-12">
                                                <button onclick="printReport()" class="btn btn-success float-left" style="margin-left: 10px; margin-right:10px;">
                                                    <span class="text-white"><i class="fa fa-print"></i></span>
                                                    <span class="text"> Print</span>
                                                </button>
                                                <button onclick="exportPDF()" class="btn btn-danger float-left">
                                                    <span class="text-white"><i class="fa fa-file-pdf-o"></i></span>
                                                    <span class="text"> PDF</span>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- div for print area -->
                                    <div id="printArea">
                                        <div class="row clearfix">


                                        </div>
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr class="bg-dark text-white">
                                                            <th>
                                                                <h5>User</h5>
                                                            </th>
                                                            <th>Qty</th>
                                                            <th>Sale</th>
                                                            <th>Discount</th>
                                                            <th>Sale Return</th>
                                                            <th>Net Sale</th>
                                                            <th>Cash Sale</th>
                                                            <th>Credit Sale</th>
                                                            <th>Recovery</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // $sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account  WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000')");
                                                        // $data=mysqli_fetch_assoc($sql);
                                                        // $opening_bal_cash = $data['opening_bal'];

                                                        // $sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_bal FROM tbl_trans_detail WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000') and date(created_date) <  date('$f_date')");
                                                        // $data1=mysqli_fetch_assoc($sql1);
                                                        // $cash_bal = $data1['cash_bal'];

                                                        // $opening_cash_total=round($opening_bal_cash+$cash_bal, 0);

                                                        $opening_cash_total = 0;
                                                        $sql3 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000')  and date(created_date) = '$f_date'");

                                                        $data3 = mysqli_fetch_assoc($sql3);
                                                        $cash_in_hand = $data3['cash_in_hand'];

                                                        $sql4 = mysqli_query($conn, "SELECT  SUM(opening_bal) as opening_bal FROM `tbl_account` WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000')");
                                                        $data4 = mysqli_fetch_assoc($sql4);
                                                        $opening_bal = $data4['opening_bal'];
                                                        $cash_now = round($cash_in_hand, 0);

                                                        $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as expense FROM tbl_trans_detail where Left(acode, 3) = '500' and date(created_date) between '$f_date' and '$t_date'");
                                                        $data1 = mysqli_fetch_assoc($sql1);
                                                        $today_expense = $data1['expense'];


                                                        $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as salary FROM tbl_trans_detail where Left(acode, 9)='500100400' and date(created_date) between '$f_date' and '$t_date'");
                                                        $data1 = mysqli_fetch_assoc($sql1);
                                                        $today_salary = $data1['salary'];
                                                        $query_main = mysqli_query($conn, "SELECT user_name, user_id FROM users order by user_id asc");
                                                        while ($data = mysqli_fetch_assoc($query_main)) {
                                                            $saleman_id = $data['user_id'];
                                                            $user_name = $data['user_name'];
                                                            $t_qty = 0;
                                                            $rate_t = 0;
                                                            $rate_gross = 0;
                                                            $qty_line = 0;
                                                            $amount = 0;
                                                            $total_amount = 0;
                                                            $total_gamount = 0;
                                                            $line_sale_rtn = 0;

                                                            $sql_qty_return = mysqli_query($conn, "SELECT SUM(returned_qty) as return_qty_line, SUM(return_amount) as return_amount_line FROM tbl_sale_return_detail INNER JOIN tbl_sale ON tbl_sale_return_detail.sale_id = tbl_sale.sale_id WHERE DATE(tbl_sale.created_date) between '$f_date' and '$t_date'  and tbl_sale.created_by='$saleman_id'");
                                                            $data2 = mysqli_fetch_assoc($sql_qty_return);
                                                            $return_qty_line = $data2['return_qty_line'];
                                                            $return_amount_line = $data2['return_amount_line'];


                                                            $sql = mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' and tbl_sale.created_by='$saleman_id'");
                                                            while ($value = mysqli_fetch_assoc($sql)) {
                                                                $customer_name = $value['customer_name'];
                                                                $qty = $value['qty'];
                                                                $rate = $value['rate'];



                                                                $sql_item = mysqli_query($conn, "SELECT * FROM tbl_items where item_id='$product'");
                                                                $value1 = mysqli_fetch_assoc($sql_item);
                                                                $retail = $value1['retail'];
                                                                $mini_wholesale = $value1['mini_wholesale'];
                                                                $wholesale = $value1['wholesale'];
                                                                $type_a = $value1['type_a'];
                                                                $type_b = $value1['type_b'];
                                                                $type_c = $value1['type_c'];
                                                                $qty_line += $qty;
                                                                $amount = $qty * $rate;
                                                                //$total_amount+=$amount;
                                                                $rate_gross = $qty * $retail;
                                                                $total_gamount += $rate_gross;
                                                                $line_sale_rtn = $return_qty_line * $rate;

                                                                $t_qty = $qty_line - $return_qty_line;
                                                            }
                                                            $sql_recieved = mysqli_query($conn, "SELECT SUM(discount) as discount_tot, SUM(net_amount) as total_amount FROM tbl_sale where DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' and tbl_sale.created_by='$saleman_id'");
                                                            $data1 = mysqli_fetch_assoc($sql_recieved);
                                                            $discount_tot = $data1['discount_tot'];
                                                            $total_amount = $data1['total_amount'];

                                                            $net_sale = $total_amount - $return_amount_line - $discount_tot;

                                                            //%fixed discount
                                                            // $fix_disc_total = mysqli_query($conn, "SELECT SUM(fixed_discount) as percentage_fix_discount FROM tbl_sale where DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_customer $where_created");
                                                            // $data22 = mysqli_fetch_assoc($fix_disc_total);
                                                            // $percentage_fix_discount = $data22['percentage_fix_discount'];

                                                            $sql_credit = mysqli_query($conn, "SELECT SUM(gross_amount) as credit_total FROM tbl_sale where DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' and sale_type='Credit' and tbl_sale.created_by='$saleman_id'");
                                                            $data1 = mysqli_fetch_assoc($sql_credit);
                                                            $credit_total = $data1['credit_total'];

                                                            $sql1 = mysqli_query($conn, "SELECT SUM(d_amount) as rec_bal FROM tbl_trans_detail where Left(acode, 6)='100100' and invoice_no LIKE '%CR%' and date(created_date) BETWEEN '$f_date' and '$t_date' and created_by='$saleman_id'");
                                                            $data1 = mysqli_fetch_assoc($sql1);
                                                            $rec_bal_today = $data1['rec_bal'];


                                                            $sql1 = mysqli_query($conn, "SELECT SUM(c_amount) as payable 
                            FROM tbl_trans_detail td1 
                            WHERE Left(acode, 6)='100100'                              -- Get cash account transactions
                            AND invoice_no LIKE '%CP%'                                 -- Only cash payments
                            AND date(created_date) BETWEEN '$f_date' and '$t_date'     -- Within date range
                            AND created_by='$saleman_id'                               -- By specific salesman
                            AND NOT EXISTS (                                           -- Check if there ISN'T
                                SELECT 1                                               -- a matching record
                                FROM tbl_trans_detail td2                              -- in the same table
                                WHERE td2.invoice_no = td1.invoice_no                  -- with same invoice number
                                AND LEFT(td2.acode, 3)='500'                          -- that has expense account
                                AND td2.d_amount > 0                                   -- with debit amount
                                AND td2.trans_id = td1.trans_id                        -- in same transaction
                            )");
                                                            $data1 = mysqli_fetch_assoc($sql1);
                                                            $today_payable = abs($data1['payable']);


                                                            $cash_sale = $net_sale - $credit_total;
                                                            $f_qty += $t_qty;
                                                            $f_total_amount += $total_amount;
                                                            $f_discount_tot += $discount_tot;
                                                            $f_return_amount_line += $return_amount_line;
                                                            $f_net_sale += $net_sale;
                                                            $f_cash_sale += $cash_sale;
                                                            $f_credit_total += $credit_total;
                                                            $f_rec_bal_today += $rec_bal_today;
                                                            $f_pay_bal_today += $today_payable;
                                                        ?>
                                                            <tr>
                                                                <td>
                                                                    <h5 class="m-b-0 m-t-10"><?php echo $user_name; ?></h5>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($t_qty); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($total_amount); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($discount_tot); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($return_amount_line); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($net_sale); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($cash_sale); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($credit_total); ?></h7>
                                                                </td>
                                                                <td>
                                                                    <h7 class="m-b-0 m-t-6"><?php echo number_format($rec_bal_today); ?></h7>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr class="bg-dark text-white">
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10">TOTAL</h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_qty); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_total_amount); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_discount_tot); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_return_amount_line); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_net_sale); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_cash_sale); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_credit_total); ?></h5>
                                                            </td>
                                                            <td>
                                                                <h5 class="m-b-0 m-t-10"><?php echo number_format($f_rec_bal_today); ?></h5>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        <!-- <tr>
                                                          <td><h3 class="m-b-0 m-t-10">Opening</h3></td>
                                                          <td></td>
                                                          <td><h3 class="m-b-0 m-t-10"><?php echo number_format($opening_cash_total); ?></h3></td> 
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          <td></td>
                                                          </tr> -->
                                                        <tr>

                                                            <!-- totals after table footer -->

                                                            <!-- <td>
                                                            <h3 class="m-b-0 m-t-10">Sale</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10"><?php echo number_format($f_total_amount); ?></h3>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Disount</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_discount_tot); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Sale Return</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_return_amount_line); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Net Sale</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_net_sale); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Credit Sale</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_credit_total); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Cash Sale</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_cash_sale); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Cash Recipt</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_rec_bal_today); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Cash Payment</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_pay_bal_today); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Expense</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php
                                                                                        $expense = $today_expense - $today_salary;
                                                                                        echo number_format($expense);
                                                                                        ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Salary Expense</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($today_salary); ?></h5>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h3 class="m-b-0 m-t-10">Day Close Balance</h3>
                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10"><?php
                                                                                        $DayCloseBalance = $f_cash_sale + $f_rec_bal_today - $f_pay_bal_today - $expense - $today_salary;
                                                                                        echo number_format($DayCloseBalance);
                                                                                        ?>
                                                            </h5>
                                                        </td> 
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>-->

                                                    </tbody>

                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- div end for print area -->
                                </div>

                                <!-- div start print area -->
                                <div id="printArea2">

                                    <div class="row clearfix report-totals">
                                        <div class="col-md-3 text-center">
                                        </div>
                                        <div class="col-md-3 text-left " >
                                            <h5 class="m-b-0 m-t-10 mt-4" style = "font-weight: bold; ">Report</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">SALE</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">DISCOUNT</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">SALE RETURN</h5>
                                            <hr>
                                            <!-- <h5 class="m-b-0 m-t-10">NET SALE</h5> -->
                                            <!-- <hr> -->
                                            <!-- <h5 class="m-b-0 m-t-10">Fix Discount</h5> -->
                                            <!-- <hr> -->
                                            <h5 class="m-b-0 m-t-10">CREDIT SALE</h5>
                                            <hr>
                                            
                                            <!-- <h5 class="m-b-0 m-t-10">CASH SALE</h5> -->
                                            <!-- <hr> -->

                                            <h5 class="m-b-0 m-t-10">CASH RECIEPT</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">CASH PAYMENT</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">EXPENSE</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">SALARY EXPENSE</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10">CURRENT DAY CLOSE BALANCE</h5>
                                            <hr>

                                        </div>
                                        <div class="col-md-3 text-right">
                                            <?php

                                            ?>
                                            <h5 class="m-b-0 m-t-10 mt-4" style = "font-weight: bold;">AMOUNT</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_total_amount); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_discount_tot); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_return_amount_line, 0); ?></h5>
                                            <hr>
                                            <!-- <h5 class="m-b-0 m-t-10"><?php echo number_format($f_net_sale); ?></h5> -->
                                            <!-- <hr> -->
                                            <!-- <h5 class="m-b-0 m-t-10"><?php echo number_format($percentage_fix_discount); ?></h5> -->
                                            <!-- <hr> -->
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_credit_total); ?></h5>
                                            <hr>
                                            
                                            <!-- <h5 class="m-b-0 m-t-10"><?php echo number_format($f_credit_total); ?></h5> -->
                                            <!-- <hr> -->
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_rec_bal_today); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_pay_bal_today); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php
                                                                        $expense = $today_expense - $today_salary;
                                                                        echo number_format($expense);
                                                                        ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($today_salary); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php
                                                                        $DayCloseBalance = $f_cash_sale + $f_rec_bal_today - $f_pay_bal_today - $expense - $today_salary;
                                                                        echo number_format($DayCloseBalance);
                                                                        ?></h5>
                                            <hr>
                                        </div>
                                        <div class="col-md-3 text-right">
                                            <h5 class="m-b-0 m-t-10 mt-4" style = "font-weight: bold;">Net Total</h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($f_total_amount); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c1 = $f_total_amount - $f_discount_tot); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c2 = $c1 - $f_return_amount_line); ?></h5>
                                            <hr>
                                            
                                            <!-- <h5 class="m-b-0 m-t-10" ><?php echo number_format($f_net_sale); ?></h5><hr> -->
                                            
                                            <!-- <h5 class="m-b-0 m-t-10" ><?php echo number_format($c3= $c2 - $percentage_fix_discount); ?></h5><hr> -->
                                            
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c4 = $c3 - $f_credit_total); ?></h5>
                                            <hr>
                                            
                                            <!-- <h5 class="m-b-0 m-t-10" ><?php echo number_format($cash); ?></h5><hr> -->

                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c5 = $c4 + $f_rec_bal_today); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c6 = $c5 - $f_pay_bal_today); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c7 = $c6 - $expense); ?></h5>
                                            <hr>
                                            <h5 class="m-b-0 m-t-10"><?php echo number_format($c8 = $c7 - $today_salary); ?></h5>
                                            <hr>
                                        </div>
                                    </div>

                                </div>
                                <!-- div end print area -->
                            </div>


                            <!-- <div class="row clearfix ">
                                <div class="col-md-6 ">

                                </div>

                            </div> -->
                        </div>
                    </div>
                </div>
        </div>

    </div>
    </div>


</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

</script>

<script>
    function printReport() {
        var tableContent = document.getElementById('example').outerHTML;
        var totalsContent = document.getElementById('printArea2').innerHTML;

        var printWindow = window.open('', '_blank');
        printWindow.document.write(`
        <html>
        <head>
            <title>Print Report</title>
            <style>
                body { 
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 20px;
                }
                .report-container { 
                    width: 100%;
                }
                .header { 
                    text-align: center; 
                    margin-bottom: 20px;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-bottom: 20px;
                    font-size: 12px;
                }
                table th, table td {
                    padding: 6px;
                    text-align: left;
                }
                table th {
                    background-color: #f4f4f4;
                }

                /* Force single line layout */
                .row.clearfix {
                    display: flex !important;
                    flex-direction: row !important;
                    width: 100% !important;
                    margin: 0 !important;
                    padding: 0 !important;
                }
                .col-md-3 {
                    flex: 1 !important;
                    width: 33.33% !important;
                    float: none !important;
                    page-break-inside: avoid !important;
                }
                .col-md-3 h5 {
                    margin: 5px 0 !important;
                    font-size: 12px !important;
                    white-space: nowrap !important;
                }
                hr {
                    margin: 2px 0 !important;
                }
            </style>
        </head>
        <body>
            <div class="report-container">
                <div class="header">
                    <h2><?php echo $c_name; ?></h2>
                    <h3>User Day Close Report</h3>
                    <p>From Date/To Date: <?php echo $newDate1 . '/' . $newDate2; ?></p>
                    <p>Printed on: <?php echo date('d-m-Y H:i:A'); ?></p>
                </div>
                
                ${tableContent}
                ${totalsContent}
            </div>
        </body>
        </html>
    `);

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    }
</script>

<script>
    function exportPDF() {
        // Get the elements
        const element = document.getElementById('example');
        const totals = document.getElementById('printArea2');

        // Create PDF
        window.jsPDF = window.jspdf.jsPDF;
        var doc = new jsPDF('l', 'pt', 'legal');

        // Add title and header info
        doc.setFontSize(16);
        doc.text('<?php echo $c_name; ?>', doc.internal.pageSize.width / 2, 30, {
            align: 'center'
        });
        doc.setFontSize(14);
        doc.text('User Day Close Report', doc.internal.pageSize.width / 2, 50, {
            align: 'center'
        });
        doc.setFontSize(12);
        doc.text('From Date/To Date: <?php echo $newDate1 . '/' . $newDate2; ?>', doc.internal.pageSize.width / 2, 70, {
            align: 'center'
        });
        doc.text('Downloaded on: <?php echo date('d-m-Y H:i:A'); ?>', doc.internal.pageSize.width / 2, 90, {
            align: 'center'
        });

        // Convert to PDF
        html2canvas(element).then(canvas => {
            const imgData = canvas.toDataURL('image/png');
            const imgProps = doc.getImageProperties(imgData);
            const pdfWidth = doc.internal.pageSize.getWidth();
            const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

            doc.addImage(imgData, 'PNG', 20, 100, pdfWidth - 40, pdfHeight);

            // Add totals section
            html2canvas(totals).then(canvas2 => {
                const imgData2 = canvas2.toDataURL('image/png');
                const imgProps2 = doc.getImageProperties(imgData2);
                const pdfWidth2 = doc.internal.pageSize.getWidth();
                const pdfHeight2 = (imgProps2.height * pdfWidth2) / imgProps2.width;

                doc.addImage(imgData2, 'PNG', 20, 100 + pdfHeight + 20, pdfWidth - 40, pdfHeight2);

                // Save the PDF
                doc.save('UserDayCloseReport.pdf');
            });
        });
    }
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->

</html>