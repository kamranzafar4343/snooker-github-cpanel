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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Balance Sheet</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item"> Balance Sheet</li>
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
                                            <h3 class="text-center">Balance Sheet</h3>


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
                                <form action="balance_sheet.php" method="post" enctype="multipart/form-data" id='form1'>
                                    <div class="body">

                                        <div class="row clearfix">
                                            <div class="col-md-4 col-sm-12">
                                                <div class="form-group">
                                                    <label for="description">From Date </label>
                                                    <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if ($_POST) {
                                                                                                                                                                        echo $f_date;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo date('Y-m-d');
                                                                                                                                                                    } ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <label for="description">To Date </label>
                                                <div class="form-group">
                                                    <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if ($_POST) {
                                                                                                                                                                        echo $t_date;
                                                                                                                                                                    } else {
                                                                                                                                                                        echo date('Y-m-d');
                                                                                                                                                                    } ?>">
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-12" style="margin-top:35px;">
                                                <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="purchase_rep" onclick="check()" target='_blank'>Search</button>
                                            </div>
                                            <!--  <div class="col-md-2 col-sm-12" style="margin-top:35px;">
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

                                <?php
                                ///////////////////////// cash at bank///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100700' and opening_date < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_bank = $data['opening_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as bank_bal FROM tbl_trans_detail where Left(acode, 6)='100700' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $bank_bal = $data1['bank_bal'];

                                $bank_total = $opening_bal_bank + $bank_bal;
                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Accounts Rec ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100200' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_acc_rec = $data['opening_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as acc_rec_bal FROM tbl_trans_detail where Left(acode, 6)='100200' and created_date between '$f_date' and '$t_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $acc_rec_bal = $data1['acc_rec_bal'];

                                $acc_rec_total = $opening_bal_acc_rec + $acc_rec_bal;
                                ///////////////////////////////////////////////////////////////////////////


                                ///////////////////////// Cash in hand ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='300100' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_cogs = $data['opening_bal'];

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100100' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_branch = $data['opening_bal'];

                                $query = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100100' and opening_date  < '$f_date' and created_by='$userid'");
                                $data2 = mysqli_fetch_assoc($query);
                                $opening_bal_cih = $data2['opening_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM tbl_trans_detail where Left(acode, 6) IN('100100',  '300100', '300200') and created_date between '$f_date' and '$t_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $cash_in_hand = $data1['cash_in_hand'];

                                $cash_in_hand_total = $opening_bal_cih + $cash_in_hand + $opening_bal_cogs + $opening_bal_branch;
                                ///////////////////////////////////////////////////////////////////////////


                                ///////////////////////// Inventory in hand ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100300' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_stock = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as stock_in_hand FROM tbl_trans_detail where Left(acode, 6)IN('100300',  '100000') and created_date between '$f_date' and '$t_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $stock_in_hand = $data1['stock_in_hand'];

                                $stock_in_hand_total = $opening_bal_stock + $stock_in_hand;
                                $current_assests = $stock_in_hand_total + $cash_in_hand_total + $acc_rec_total + $bank_total;
                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Buildings ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100600' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_land = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as land FROM tbl_trans_detail where Left(acode, 6)='100600' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $land = $data1['land'];

                                $land_total = $opening_bal_land + $land;

                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Equipement ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100800' and opening_date  < '$f_date'  and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_equip = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as equip FROM tbl_trans_detail where Left(acode, 6)='100800' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $equip = $data1['equip'];

                                $equip_total = $opening_bal_equip + $equip;
                                $non_current_assests = $equip_total + $land_total;
                                ///////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////Assests total //////////////////////////
                                $assests = $non_current_assests + $current_assests;
                                ///////////////////////////////////////////////////////////////////////


                                ///////////////////////// Account payable ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='200200' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_payable = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as payable FROM tbl_trans_detail where Left(acode, 6)='200200' and created_date between '$f_date' and '$t_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $payable = $data1['payable'];

                                $payable_total = (-$opening_bal_payable + $payable);

                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Accrued Expense ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='500200' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_expense = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as expense FROM tbl_trans_detail where Left(acode, 6)='500200' and created_date between '$f_date' and '$t_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $expense = $data1['expense'];

                                $expense_total = ($opening_bal_expense + $expense);

                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Salary/Wages ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='500100' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_salary = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as salary FROM tbl_trans_detail where Left(acode, 6)='500100' and created_date between '$f_date' and '$t_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $salary = $data1['salary'];

                                $salary_total = ($opening_bal_salary + $salary);

                                ///////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////Liabilities total //////////////////////////
                                $liabilities = $salary_total + $expense_total + $payable_total;
                                ///////////////////////////////////////////////////////////////////////


                                ///////////////////////// Owner Contribution ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='400100' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_owner = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as contribution FROM tbl_trans_detail where Left(acode, 6)='400100' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $contribution = $data1['contribution'];

                                $owner_total = ($opening_bal_owner + $contribution);

                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Owner Draws ///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='400200' and opening_date  < '$f_date' and created_by='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_draws = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as draws FROM tbl_trans_detail where Left(acode, 6)='400200' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $draws = $data1['draws'];

                                $owner_draws_total = ($opening_bal_draws + $draws);

                                ///////////////////////////////////////////////////////////////////////////
                                ////////////////////////////////total Earning//////////////////////////
                                $earning = $assests - $liabilities;
                                ///////////////////////////////////////////////////////////////////////
                                ?>








                                <style>
                                    #example {
                                        width: 100%;
                                        border-collapse: separate;
                                        border-spacing: 0 8px;
                                        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                                    }

                                    #theadd {
                                        background-color: #2c3e50;
                                        color: white;
                                        text-align: left;
                                        padding: 12px 15px;
                                        font-size: 16px;
                                        border-radius: 8px 8px 0 0;
                                    }

                                    #example tbody tr {
                                        background-color: #f9f9f9;
                                        border-radius: 8px;
                                        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
                                        transition: background-color 0.3s;
                                    }

                                    #example tbody tr:hover {
                                        background-color: #eef2f7;
                                    }

                                    #example td {
                                        padding: 12px 15px;
                                        font-size: 15px;
                                        color: #333;
                                        border-bottom: 1px solid #e0e0e0;
                                    }

                                    #example tbody tr td:first-child {
                                        border-left: 5px solid #3498db;
                                        border-radius: 8px 0 0 8px;
                                    }

                                    #example tbody tr td:last-child {
                                        border-radius: 0 8px 8px 0;
                                        text-align: right;
                                        font-weight: 600;
                                    }
                                </style>

                                <?php


                                // Cash in hand (100100000)
                                $sql_cash_inhand_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100100000'");
                                $result_cash_inhand_op = mysqli_fetch_assoc($sql_cash_inhand_opening);
                                $cash_inhand_opening_bal = $result_cash_inhand_op['opening_bal'];

                                $sql_cash_inhand_prev = mysqli_query($conn, "SELECT SUM(d_amount- c_amount) AS total_op
                                              FROM tbl_trans_detail
                                              WHERE left(acode, 9) = '100100000'
                                              AND date(created_date) < '$f_date'
                                              ");
                                $prev_cash_inhand = mysqli_fetch_assoc($sql_cash_inhand_prev);

                                $total_op = $prev_cash_inhand['total_op'] ?? 0;
                                // $cash_inhand_prev_credit = $prev_cash_inhand['total_credit'] ?? 0;

                                $total_cash_inhand_opening = $cash_inhand_opening_bal + $total_op;

                                $sql_cash_inhand_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                                FROM tbl_trans_detail
                                                WHERE left(acode, 9) = '100100000'
                                                AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                ");
                                $result_cash_inhand_closing = mysqli_fetch_assoc($sql_cash_inhand_closing);

                                $cash_inhand_debit = $result_cash_inhand_closing['total_debit'] ?? 0;
                                $cash_inhand_credit = $result_cash_inhand_closing['total_credit'] ?? 0;

                                $total_cash_inhand = ($total_cash_inhand_opening + $cash_inhand_debit) - $cash_inhand_credit;


                                // Cash At Bank (100500000)
                                $sql_cash_at_bank_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100500000'");
                                $result_cash_at_bank_op = mysqli_fetch_assoc($sql_cash_at_bank_opening);
                                $cash_at_bank_opening_bal = $result_cash_at_bank_op['opening_bal'];

                                $sql_cash_at_bank_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                               FROM tbl_trans_detail
                                               WHERE left(acode, 9) = '100500000'
                                               AND date(created_date) < '$f_date'
                                               ");
                                $prev_cash_at_bank = mysqli_fetch_assoc($sql_cash_at_bank_prev);

                                $cash_at_bank_prev_debit = $prev_cash_at_bank['total_debit'] ?? 0;
                                $cash_at_bank_prev_credit = $prev_cash_at_bank['total_credit'] ?? 0;

                                $total_cash_at_bank_opening = $cash_at_bank_opening_bal + ($cash_at_bank_prev_debit - $cash_at_bank_prev_credit);

                                $sql_cash_at_bank_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                                 FROM tbl_trans_detail
                                                 WHERE left(acode, 9) = '100500000'
                                                 AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                 ");
                                $result_cash_at_bank_closing = mysqli_fetch_assoc($sql_cash_at_bank_closing);

                                $cash_at_bank_debit = $result_cash_at_bank_closing['total_debit'] ?? 0;
                                $cash_at_bank_credit = $result_cash_at_bank_closing['total_credit'] ?? 0;

                                $total_cash_at_bank = $total_cash_at_bank_opening + $cash_at_bank_debit - $cash_at_bank_credit;

                                // Accounts Receivable (100200000)
                                $sql_accounts_receivable_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100200000'");
                                $result_accounts_receivable_op = mysqli_fetch_assoc($sql_accounts_receivable_opening);
                                $accounts_receivable_opening_bal = $result_accounts_receivable_op['opening_bal'];

                                //fetch opening of child accounts of acc. rec.
                                $sql_accounts_receivable_opening_2 = mysqli_query($conn, "SELECT sum(opening_bal) as opening_bal2 FROM tbl_account_lv2 WHERE left(acode, 6) = '100200'");
                                $result_accounts_receivable_op_2 = mysqli_fetch_assoc($sql_accounts_receivable_opening_2);
                                $accounts_receivable_opening_bal_2 = $result_accounts_receivable_op_2['opening_bal2'];

                                $sql_accounts_receivable_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                      FROM tbl_trans_detail
                                                      WHERE left(acode, 6) = '100200'
                                                      AND date(created_date) < '$f_date'
                                                      ");
                                $prev_accounts_receivable = mysqli_fetch_assoc($sql_accounts_receivable_prev);

                                $accounts_receivable_prev_debit = $prev_accounts_receivable['total_debit'] ?? 0;
                                $accounts_receivable_prev_credit = $prev_accounts_receivable['total_credit'] ?? 0;

                                $total_accounts_receivable_opening = $accounts_receivable_opening_bal + $accounts_receivable_opening_bal_2 + ($accounts_receivable_prev_debit - $accounts_receivable_prev_credit);

                                $sql_accounts_receivable_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                                        FROM tbl_trans_detail
                                                        WHERE left(acode, 6) = '100200'
                                                        AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                        ");
                                $result_accounts_receivable_closing = mysqli_fetch_assoc($sql_accounts_receivable_closing);

                                $accounts_receivable_debit = $result_accounts_receivable_closing['total_debit'] ?? 0;
                                $accounts_receivable_credit = $result_accounts_receivable_closing['total_credit'] ?? 0;

                                $total_accounts_receivable = $total_accounts_receivable_opening + $accounts_receivable_debit - $accounts_receivable_credit;

                                // Inventory (Stock) (100300000)
                                $sql_inventory_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100300000'");
                                $result_inventory_op = mysqli_fetch_assoc($sql_inventory_opening);
                                $inventory_opening_bal = $result_inventory_op['opening_bal'];

                                $sql_inventory_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                            FROM tbl_trans_detail
                                            WHERE left(acode, 9) = '100300000'
                                            AND date(created_date) < '$f_date'
                                            ");
                                $prev_inventory = mysqli_fetch_assoc($sql_inventory_prev);

                                $inventory_prev_debit = $prev_inventory['total_debit'] ?? 0;
                                $inventory_prev_credit = $prev_inventory['total_credit'] ?? 0;

                                $total_inventory_opening = $inventory_opening_bal + ($inventory_prev_debit - $inventory_prev_credit);

                                $sql_inventory_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                               FROM tbl_trans_detail
                                               WHERE left(acode, 9) = '100300000'
                                               AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                               ");
                                $result_inventory_closing = mysqli_fetch_assoc($sql_inventory_closing);

                                $inventory_debit = $result_inventory_closing['total_debit'] ?? 0;
                                $inventory_credit = $result_inventory_closing['total_credit'] ?? 0;

                                $total_inventory = $total_inventory_opening + $inventory_debit - $inventory_credit;

                                // Furniture And Fixtures (100700000)
                                $sql_furniture_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100700000'");
                                $result_furniture_op = mysqli_fetch_assoc($sql_furniture_opening);
                                $furniture_opening_bal = $result_furniture_op['opening_bal'];

                                $sql_furniture_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                             FROM tbl_trans_detail
                                             WHERE left(acode, 9) = '100700000'
                                             AND date(created_date) < '$f_date'
                                             ");
                                $prev_furniture = mysqli_fetch_assoc($sql_furniture_prev);

                                $furniture_prev_debit = $prev_furniture['total_debit'] ?? 0;
                                $furniture_prev_credit = $prev_furniture['total_credit'] ?? 0;

                                $total_furniture_opening = $furniture_opening_bal + ($furniture_prev_debit - $furniture_prev_credit);

                                $sql_furniture_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                               FROM tbl_trans_detail
                                               WHERE left(acode, 9) = '100700000'
                                               AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                               ");
                                $result_furniture_closing = mysqli_fetch_assoc($sql_furniture_closing);

                                $furniture_debit = $result_furniture_closing['total_debit'] ?? 0;
                                $furniture_credit = $result_furniture_closing['total_credit'] ?? 0;

                                $total_furniture = $total_furniture_opening + $furniture_debit - $furniture_credit;

                                // Software (100600000)
                                $sql_software_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100600000'");
                                $result_software_op = mysqli_fetch_assoc($sql_software_opening);
                                $software_opening_bal = $result_software_op['opening_bal'];

                                $sql_software_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                            FROM tbl_trans_detail
                                            WHERE left(acode, 9) = '100600000'
                                            AND date(created_date) < '$f_date'
                                            ");
                                $prev_software = mysqli_fetch_assoc($sql_software_prev);

                                $software_prev_debit = $prev_software['total_debit'] ?? 0;
                                $software_prev_credit = $prev_software['total_credit'] ?? 0;

                                $total_software_opening = $software_opening_bal + ($software_prev_debit - $software_prev_credit);

                                $sql_software_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                              FROM tbl_trans_detail
                                              WHERE left(acode, 9) = '100600000'
                                              AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                              ");
                                $result_software_closing = mysqli_fetch_assoc($sql_software_closing);

                                $software_debit = $result_software_closing['total_debit'] ?? 0;
                                $software_credit = $result_software_closing['total_credit'] ?? 0;

                                $total_software = $total_software_opening + $software_debit - $software_credit;

                                // Office Equipments (100800000)
                                $sql_office_equipments_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100800000'");
                                $result_office_equipments_op = mysqli_fetch_assoc($sql_office_equipments_opening);
                                $office_equipments_opening_bal = $result_office_equipments_op['opening_bal'];

                                $sql_office_equipments_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                     FROM tbl_trans_detail
                                                     WHERE left(acode, 9) = '100800000'
                                                     AND date(created_date) < '$f_date'
                                                     ");
                                $prev_office_equipments = mysqli_fetch_assoc($sql_office_equipments_prev);

                                $office_equipments_prev_debit = $prev_office_equipments['total_debit'] ?? 0;
                                $office_equipments_prev_credit = $prev_office_equipments['total_credit'] ?? 0;

                                $total_office_equipments_opening = $office_equipments_opening_bal + ($office_equipments_prev_debit - $office_equipments_prev_credit);

                                $sql_office_equipments_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                                       FROM tbl_trans_detail
                                                       WHERE left(acode, 9) = '100800000'
                                                       AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                       ");
                                $result_office_equipments_closing = mysqli_fetch_assoc($sql_office_equipments_closing);

                                $office_equipments_debit = $result_office_equipments_closing['total_debit'] ?? 0;
                                $office_equipments_credit = $result_office_equipments_closing['total_credit'] ?? 0;

                                $total_office_equipments = $total_office_equipments_opening + $office_equipments_debit - $office_equipments_credit;

                                // Surveillance Equipments (100400000)
                                $sql_surveillance_equipments_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '100400000'");
                                $result_surveillance_equipments_op = mysqli_fetch_assoc($sql_surveillance_equipments_opening);
                                $surveillance_equipments_opening_bal = $result_surveillance_equipments_op['opening_bal'];

                                $sql_surveillance_equipments_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                           FROM tbl_trans_detail
                                                           WHERE left(acode, 9) = '100400000'
                                                           AND date(created_date) < '$f_date'
                                                           ");
                                $prev_surveillance_equipments = mysqli_fetch_assoc($sql_surveillance_equipments_prev);

                                $surveillance_equipments_prev_debit = $prev_surveillance_equipments['total_debit'] ?? 0;
                                $surveillance_equipments_prev_credit = $prev_surveillance_equipments['total_credit'] ?? 0;

                                $total_surveillance_equipments_opening = $surveillance_equipments_opening_bal + ($surveillance_equipments_prev_debit - $surveillance_equipments_prev_credit);

                                $sql_surveillance_equipments_closing = mysqli_query($conn, "SELECT SUM(d_amount) as total_debit, SUM(c_amount) AS total_credit
                                                              FROM tbl_trans_detail
                                                              WHERE left(acode, 9) = '100400000'
                                                              AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                              ");
                                $result_surveillance_equipments_closing = mysqli_fetch_assoc($sql_surveillance_equipments_closing);

                                $surveillance_equipments_debit = $result_surveillance_equipments_closing['total_debit'] ?? 0;
                                $surveillance_equipments_credit = $result_surveillance_equipments_closing['total_credit'] ?? 0;

                                $total_surveillance_equipments = $total_surveillance_equipments_opening + $surveillance_equipments_debit - $surveillance_equipments_credit;

                                // Accounts Payable (200200000)
                                $sql_accounts_payable_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '200200000'");
                                $result_accounts_payable_op = mysqli_fetch_assoc($sql_accounts_payable_opening);
                                $accounts_payable_opening_bal = $result_accounts_payable_op['opening_bal'];

                                //child account opening of acc. pay.
                                $sql_accounts_payable_opening_2 = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal2 FROM tbl_account_lv2 WHERE left(acode, 6) = '200200'");
                                $result_accounts_payable_op_2 = mysqli_fetch_assoc($sql_accounts_payable_opening_2);
                                $accounts_payable_opening_bal_2 = $result_accounts_payable_op_2['opening_bal2'];

                                $sql_accounts_payable_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                   FROM tbl_trans_detail
                                                   WHERE left(acode, 6) = '200200'
                                                   AND date(created_date) < '$f_date'
                                                   ");
                                $prev_accounts_payable = mysqli_fetch_assoc($sql_accounts_payable_prev);

                                $accounts_payable_prev_debit = $prev_accounts_payable['total_debit'] ?? 0;
                                $accounts_payable_prev_credit = $prev_accounts_payable['total_credit'] ?? 0;

                                $total_accounts_payable_opening = $accounts_payable_opening_bal + $accounts_payable_opening_bal_2 + ($accounts_payable_prev_debit - $accounts_payable_prev_credit);

                                $sql_accounts_payable_closing = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                     FROM tbl_trans_detail
                                                     WHERE left(acode, 6) = '200200'
                                                     AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                     ");
                                $result_accounts_payable_closing = mysqli_fetch_assoc($sql_accounts_payable_closing);

                                $accounts_payable_debit = $result_accounts_payable_closing['total_debit'] ?? 0;
                                $accounts_payable_credit = $result_accounts_payable_closing['total_credit'] ?? 0;

                                $total_accounts_payable = $total_accounts_payable_opening + $accounts_payable_debit - $accounts_payable_credit;

                                // Tax Payable (200400000)
                                $sql_tax_payable_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '200400000'");
                                $result_tax_payable_op = mysqli_fetch_assoc($sql_tax_payable_opening);
                                $tax_payable_opening_bal = $result_tax_payable_op['opening_bal'];

                                $sql_tax_payable_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                              FROM tbl_trans_detail
                                              WHERE left(acode, 9) = '200400000'
                                              AND date(created_date) < '$f_date'
                                              ");
                                $prev_tax_payable = mysqli_fetch_assoc($sql_tax_payable_prev);

                                $tax_payable_prev_debit = $prev_tax_payable['total_debit'] ?? 0;
                                $tax_payable_prev_credit = $prev_tax_payable['total_credit'] ?? 0;

                                $total_tax_payable_opening = $tax_payable_opening_bal + ($tax_payable_prev_debit - $tax_payable_prev_credit);

                                $sql_tax_payable_closing = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                FROM tbl_trans_detail
                                                WHERE left(acode, 9) = '200400000'
                                                AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                ");
                                $result_tax_payable_closing = mysqli_fetch_assoc($sql_tax_payable_closing);

                                $tax_payable_debit = $result_tax_payable_closing['total_debit'] ?? 0;
                                $tax_payable_credit = $result_tax_payable_closing['total_credit'] ?? 0;

                                $total_tax_payable = $total_tax_payable_opening + $tax_payable_debit - $tax_payable_credit;

                                // Loan Payable (200300000)
                                $sql_loan_payable_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '200300000'");
                                $result_loan_payable_op = mysqli_fetch_assoc($sql_loan_payable_opening);
                                $loan_payable_opening_bal = $result_loan_payable_op['opening_bal'];

                                $sql_loan_payable_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                               FROM tbl_trans_detail
                                               WHERE left(acode, 9) = '200300000'
                                               AND date(created_date) < '$f_date'
                                             ");
                                $prev_loan_payable = mysqli_fetch_assoc($sql_loan_payable_prev);

                                $loan_payable_prev_debit = $prev_loan_payable['total_debit'] ?? 0;
                                $loan_payable_prev_credit = $prev_loan_payable['total_credit'] ?? 0;

                                $total_loan_payable_opening = $loan_payable_opening_bal + ($loan_payable_prev_debit - $loan_payable_prev_credit);

                                $sql_loan_payable_closing = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                  FROM tbl_trans_detail
                                                  WHERE left(acode, 9) = '200300000'
                                                  AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                                ");
                                $result_loan_payable_closing = mysqli_fetch_assoc($sql_loan_payable_closing);

                                $loan_payable_debit = $result_loan_payable_closing['total_debit'] ?? 0;
                                $loan_payable_credit = $result_loan_payable_closing['total_credit'] ?? 0;

                                $total_loan_payable = $total_loan_payable_opening + $loan_payable_debit - $loan_payable_credit;

                                // Owner Capital (400100000)
                                $sql_owner_capital_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '400100000'");
                                $result_owner_capital_op = mysqli_fetch_assoc($sql_owner_capital_opening);
                                $owner_capital_opening_bal = $result_owner_capital_op['opening_bal'];

                                $sql_owner_capital_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                 FROM tbl_trans_detail
                                                 WHERE left(acode, 6) = '400100'
                                                 AND date(created_date) < '$f_date'
                                               ");
                                $prev_owner_capital = mysqli_fetch_assoc($sql_owner_capital_prev);

                                $owner_capital_prev_debit = $prev_owner_capital['total_debit'] ?? 0;
                                $owner_capital_prev_credit = $prev_owner_capital['total_credit'] ?? 0;

                                $total_owner_capital_opening = $owner_capital_opening_bal + ($owner_capital_prev_debit - $owner_capital_prev_credit);

                                $sql_owner_capital_closing = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                                   FROM tbl_trans_detail
                                                   WHERE left(acode, 6) = '400100'
                                                   AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                            ");
                                $result_owner_capital_closing = mysqli_fetch_assoc($sql_owner_capital_closing);

                                $owner_capital_debit = $result_owner_capital_closing['total_debit'] ?? 0;
                                $owner_capital_credit = $result_owner_capital_closing['total_credit'] ?? 0;

                                $total_owner_capital = $total_owner_capital_opening + $owner_capital_debit - $owner_capital_credit;

                                // Drawings (400200000)
                                $sql_drawings_opening = mysqli_query($conn, "SELECT opening_bal FROM tbl_account WHERE left(acode, 9) = '400200000'");
                                $result_drawings_op = mysqli_fetch_assoc($sql_drawings_opening);
                                $drawings_opening_bal = $result_drawings_op['opening_bal'];

                                $sql_drawings_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                           FROM tbl_trans_detail
                                           WHERE left(acode, 9) = '400200000'
                                           AND date(created_date) < '$f_date'
                                           ");
                                $prev_drawings = mysqli_fetch_assoc($sql_drawings_prev);

                                $drawings_prev_debit = $prev_drawings['total_debit'] ?? 0;
                                $drawings_prev_credit = $prev_drawings['total_credit'] ?? 0;

                                $total_drawings_opening = $drawings_opening_bal + ($drawings_prev_debit - $drawings_prev_credit);

                                $sql_drawings_closing = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                                              FROM tbl_trans_detail
                                              WHERE left(acode, 9) = '400200000'
                                              AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                                              ");
                                $result_drawings_closing = mysqli_fetch_assoc($sql_drawings_closing);

                                $drawings_debit = $result_drawings_closing['total_debit'] ?? 0;
                                $drawings_credit = $result_drawings_closing['total_credit'] ?? 0;

                                $total_drawings = $total_drawings_opening + $drawings_debit - $drawings_credit;

                                ?>


                                <!-- for fetching retained amount(code copied from trial balance report) -->
                                <?php
                                $total_debit = 0;
                                $total_credit = 0;
                                $total_closing = 0;
                                // $user_id = 1;

                                // Fetch all accounts
                                $sql_accounts = mysqli_query($conn, "
                            SELECT LEFT(acode, 6) AS acode, aname, atype, opening_bal 
                            FROM tbl_account 
                            WHERE acode NOT IN ('400400000', '5001000000')
                        ");
                                $accounts = [];

                                while ($row = mysqli_fetch_assoc($sql_accounts)) {
                                    $acode = $row['acode'];
                                    $aname = $row['aname'];
                                    $atype = $row['atype'];
                                    $opening_bal = $row['opening_bal'] ?? 0;

                                    $acode_prefix = substr($acode, 0, 6);

                                    //if an account has subchild in the tbl_acc_lev2
                                    $check_subchild = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal_acc2 FROM tbl_account_lv2 WHERE LEFT(acode, 6) ='$acode_prefix'");
                                    if (mysqli_num_rows($check_subchild) > 0) {
                                        $subchild = mysqli_fetch_assoc($check_subchild);
                                        $opening_acc2 = $subchild['opening_bal_acc2'];
                                    }

                                    // Current Period Debit and Credit
                                    $sql_amounts = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit 
                            FROM tbl_trans_detail 
                            WHERE Left(acode, 6) = '$acode' 
                            AND date(created_date) BETWEEN '$f_date' AND '$t_date'
                         ");
                                    $amounts = mysqli_fetch_assoc($sql_amounts);

                                    $debit = $amounts['total_debit'] ?? 0;
                                    $credit = $amounts['total_credit'] ?? 0;

                                    // Now handle opening and closing
                                    if (in_array($atype, ['1', '2', '4'])) {
                                        // Asset, Liability, Capital: Calculate previous balance
                                        $sql_prev = mysqli_query($conn, "SELECT SUM(d_amount) AS total_debit, SUM(c_amount) AS total_credit
                            FROM tbl_trans_detail 
                            WHERE left(acode, 6) = '$acode' 
                            AND date(created_date) < '$f_date' 
                          ");
                                        $prev = mysqli_fetch_assoc($sql_prev);

                                        $prev_debit = $prev['total_debit'] ?? 0;
                                        $prev_credit = $prev['total_credit'] ?? 0;

                                        //in this case debit and credit are 
                                        //     $debit = $prev_debit;
                                        // $credit = $prev_credit;

                                        $previous_balance = $prev_debit - $prev_credit;

                                        // FINAL Opening
                                        $final_opening = $opening_bal + $previous_balance + $opening_acc2;

                                        // Closing for Asset/Liability/Capital
                                        $closing = ($final_opening + $debit) - $credit;

                                        $opening = $final_opening; // Save for display

                                    } elseif (in_array($atype, ['3', '5'])) {
                                        // Income and Expense: no opening
                                        $opening = 0;
                                        $closing = $debit - $credit;
                                    } else {
                                        $opening = 0;
                                        $closing = 0;
                                    }

                                    // Save all into array
                                    $accounts[] = [
                                        'acode' => $acode,
                                        'aname' => $aname,
                                        'opening' => $opening,
                                        'debit' => $debit,
                                        'credit' => $credit,
                                        'closing' => $closing,
                                    ];
                                }

                                foreach ($accounts as $account):
                                    $total_opening += $account['opening'];
                                    $total_debit += $account['debit'];
                                    $total_credit += $account['credit'];
                                    $total_closing += $account['closing'];

                                endforeach;

                                ?>


                                <!-- fetch net profit(copied from profit_report.php) -->

                                <?php
                                //cash sales closing
                                $sql_cash_sale = mysqli_query($conn, "
                   SELECT SUM(d_amount) - SUM(c_amount) AS cash_closing 
                   FROM tbl_trans_detail 
                  WHERE LEFT(acode, 6)='300100' 
                  AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
                 
                  ");
                                $result_cash_sale = mysqli_fetch_assoc($sql_cash_sale);
                                $cash_sale_closing = $result_cash_sale['cash_closing'] ?? 0;

                                //credit sales 
                                $sql_credit_sale1 = mysqli_query($conn, "SELECT SUM(d_amount) as credit_damount FROM tbl_trans_detail
                 where Left(acode, 6)='300500' and date(created_date) between '$f_date' and '$t_date' ");
                                $result_cr1 = mysqli_fetch_assoc($sql_credit_sale1);
                                $credit_sale1 = $result_cr1['credit_damount'];

                                $sql_credit_sale2 = mysqli_query($conn, "SELECT SUM(c_amount) as credit_camount FROM tbl_trans_detail where
                 Left(acode, 6)='300500' and date(created_date) between '$f_date' and '$t_date' ");
                                $result_cr2 = mysqli_fetch_assoc($sql_credit_sale2);
                                $credit_sale2 = $result_cr2['credit_camount'];

                                $credit_sale_closing = $credit_sale1 - $credit_sale2;

                                //sale return
                                $sql_sale_return1 = mysqli_query($conn, "SELECT SUM(d_amount) as sale_return1 FROM tbl_trans_detail 
                where Left(acode, 6)='300600' and date(created_date) between '$f_date' and '$t_date'");
                                $result_sr1 = mysqli_fetch_assoc($sql_sale_return1);
                                $sale_return1 = $result_sr1['sale_return1'];

                                $sql_sale_return2 = mysqli_query($conn, "SELECT SUM(c_amount) as sale_return2 FROM tbl_trans_detail 
                where Left(acode, 6)='300600' and date(created_date) between '$f_date' and '$t_date' a");
                                $result_sr2 = mysqli_fetch_assoc($sql_sale_return2);
                                $sale_return2 = $result_sr2['sale_return2'];

                                $sale_return_closing = $sale_return1 - $sale_return2;

                                //net sale
                                $total_sale = abs($cash_sale_closing) + abs($credit_sale_closing);
                                $net_sale = abs($total_sale) - abs($sale_return_closing);

                                //cogs
                                $sql_cog1 = mysqli_query($conn, "SELECT SUM(d_amount) as cog1 FROM tbl_trans_detail where 
                Left(acode, 6)='300300' and date(created_date) between '$f_date' and '$t_date'");
                                $result_cog1 = mysqli_fetch_assoc($sql_cog1);
                                $cog1 = $result_cog1['cog1'];

                                $sql_cog2 = mysqli_query($conn, "SELECT SUM(c_amount) as cog2 FROM tbl_trans_detail where 
                Left(acode, 6)='300300' and date(created_date) between '$f_date' and '$t_date'");
                                $result_cog2 = mysqli_fetch_assoc($sql_cog2);
                                $cog2 = $result_cog2['cog2'];

                                $cog_closing = $cog1 - $cog2;

                                //gross profit
                                $gross_profit = abs($net_sale) - abs($cog_closing);


                                //other income
                                $sql_other_income = mysqli_query($conn, "
                  SELECT SUM(d_amount) - SUM(c_amount) AS other_income 
                  FROM tbl_trans_detail 
                  WHERE LEFT(acode, 6)='300400' 
                  AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
              
                  ");
                                $result_other_income = mysqli_fetch_assoc($sql_other_income);
                                $other_income_closing = $result_other_income['other_income'] ?? 0;
                                $other_income_closing = abs($other_income_closing);



                                //disc avail
                                $sql_disc_avail = mysqli_query($conn, "
                  SELECT SUM(d_amount) - SUM(c_amount) AS disc_avail 
                  FROM tbl_trans_detail 
                  WHERE LEFT(acode, 6)='300200' 
                  AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
                 
                  ");
                                $result_disc_avail = mysqli_fetch_assoc($sql_disc_avail);
                                $disc_avail_closing = $result_disc_avail['disc_avail'] ?? 0;
                                $disc_avail_closing = abs($disc_avail_closing);

                                //total income
                                $total_income = abs($gross_profit) + abs($other_income_closing) + abs($disc_avail_closing);

                                //rent
                                $sql_rent = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS rent 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500100' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
                
                ");
                                $result_rent = mysqli_fetch_assoc($sql_rent);
                                $rent_closing = $result_rent['rent'] ?? 0;
                                $rent_closing = abs($rent_closing);

                                //office expense
                                $sql_office_expense = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS office_expense 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500700' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
            
                ");
                                $result_office_expense = mysqli_fetch_assoc($sql_office_expense);
                                $office_expense_closing = $result_office_expense['office_expense'] ?? 0;
                                $office_expense_closing = abs($office_expense_closing);

                                //discount given
                                $sql_disc_given = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS discount_given 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500900' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
              
                ");
                                $result_disc_given = mysqli_fetch_assoc($sql_disc_given);
                                $disc_given_closing = $result_disc_given['discount_given'] ?? 0;
                                $disc_given_closing = abs($disc_given_closing);


                                //salary expense
                                $sql_salary_expense = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS salary_expense 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500800' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
         
                ");
                                $result_salary_expense = mysqli_fetch_assoc($sql_salary_expense);
                                $salary_expense_closing = $result_salary_expense['salary_expense'] ?? 0;
                                $salary_expense_closing = abs($salary_expense_closing);

                                //fuel
                                $sql_fuel = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS fuel 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500200' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
               
                ");
                                $result_fuel = mysqli_fetch_assoc($sql_fuel);
                                $fuel_closing = $result_fuel['fuel'] ?? 0;
                                $fuel_closing = abs($fuel_closing);

                                //maintenance
                                $sql_maintenance = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS maintenance 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500400' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
                
                ");
                                $result_maintenance = mysqli_fetch_assoc($sql_maintenance);
                                $maintenance_closing = $result_maintenance['maintenance'] ?? 0;
                                $maintenance_closing = abs($maintenance_closing);

                                //electric bill
                                $sql_ebill = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS ebill 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500500' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
               
                ");
                                $result_ebill = mysqli_fetch_assoc($sql_ebill);
                                $ebill_closing = $result_ebill['ebill'] ?? 0;
                                $ebill_closing = abs($ebill_closing);

                                //internet and tv
                                $sql_internet_bill = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS internet_and_bill 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500600' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
               
                ");
                                $result_internet_bill = mysqli_fetch_assoc($sql_internet_bill);
                                $internet_bill_closing = $result_internet_bill['internet_and_bill'] ?? 0;
                                $internet_bill_closing = abs($internet_bill_closing);

                                //other expense
                                $sql_other_expense = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS other_expense 
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 6)='500300' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
              
                ");
                                $result_other_expense = mysqli_fetch_assoc($sql_other_expense);
                                $other_expense_closing = $result_other_expense['other_expense'] ?? 0;
                                $other_expense_closing = abs($other_expense_closing);

                                //tax payable
                                $sql_taxpaid = mysqli_query($conn, "
                SELECT SUM(d_amount) - SUM(c_amount) AS taxpaid
                FROM tbl_trans_detail 
                WHERE LEFT(acode, 10)='5001000000' 
                AND date(created_date) BETWEEN '$f_date' AND '$t_date' 
                
                ");
                                $result_taxpaid = mysqli_fetch_assoc($sql_taxpaid);
                                $taxpaid = $result_taxpaid['taxpaid'] ?? 0;
                                $taxpaid = abs($taxpaid);
                                ?>

                                <!-- Step 4: Display it on the page -->
                                <div class="row clearfix">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-bordered table-striped" style="width:100%">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Assets</th>
                                                        <th>Amount</th>
                                                        <th>Liabilities and Equity</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Row 1 -->
                                                    <tr>
                                                        <td><strong>Current Assets</strong></td>
                                                        <td></td>
                                                        <td><strong>Current Liabilities</strong></td>
                                                        <td></td>
                                                    </tr>

                                                    <!-- Row 2 -->
                                                    <tr>
                                                        <td>Cash In Hand (100100000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_cash_inhand, 2); ?></span></td>
                                                        <td>Accounts Payable (200200000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_accounts_payable, 2); ?></span></td>
                                                    </tr>

                                                    <!-- Row 3 -->
                                                    <tr>
                                                        <td>Cash At Bank (100500000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_cash_at_bank, 2); ?></span></td>
                                                        <td>Tax Payable (200400000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_tax_payable, 2); ?></span></td>
                                                    </tr>

                                                    <!-- Row 4 -->
                                                    <tr>
                                                        <td>Accounts Receivable (100200000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_accounts_receivable, 2); ?></span></td>
                                                        <td><strong>Total Current Liabilities</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                $sum_current_liabilities = ($total_accounts_payable) + ($total_tax_payable);
                                                                echo number_format($sum_current_liabilities, 2);
                                                                ?>
                                                            </span></td>
                                                    </tr>

                                                    <!-- Row 5 -->
                                                    <tr>
                                                        <td>Inventory (Stock) (100300000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_inventory, 2); ?></span></td>
                                                        <td><strong>Non-Current Liabilities</strong></td>
                                                        <td></td>
                                                    </tr>

                                                    <!-- Row 6 -->
                                                    <tr>
                                                        <td><strong>Total Current Assets</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                $sum_current_assets = $total_cash_inhand + $total_cash_at_bank + $total_accounts_receivable + $total_inventory;
                                                                echo number_format($sum_current_assets, 2);
                                                                ?>
                                                            </span></td>
                                                        <td>Loan Payable (200300000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_loan_payable, 2); ?></span></td>
                                                    </tr>

                                                    <!-- Row 7 -->
                                                    <tr>
                                                        <td><strong>Non-Current Assets</strong></td>
                                                        <td></td>
                                                        <td><strong>Total Non-Current Liabilities</strong></td>
                                                        <td><span class="text-center"><?php echo number_format($total_loan_payable, 2); ?></span></td>
                                                    </tr>

                                                    <!-- Row 8 -->
                                                    <tr>
                                                        <td>Furniture And Fixtures (100700000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_furniture); ?></span></td>
                                                        <td><strong>Total Liabilities</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                $sum_liability = $sum_current_liabilities + $total_loan_payable;
                                                                echo number_format($sum_liability, 2);
                                                                ?>
                                                            </span></td>
                                                    </tr>

                                                    <!-- Row 9 -->
                                                    <tr>
                                                        <td>Software (100600000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_software); ?></span></td>
                                                        <td><strong>Equity</strong></td>
                                                        <td></td>
                                                    </tr>

                                                    <!-- Row 10 -->
                                                    <tr>
                                                        <td>Office Equipments (100900000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_office_equipments, 2); ?></span></td>
                                                        <td>Owner Equity (400100000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_owner_capital, 2); ?></span></td>
                                                    </tr>

                                                    <!-- Row 11 -->
                                                    <tr>
                                                        <td>Surveillance Equipments (100400000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_surveillance_equipments, 2); ?></span></td>
                                                        <td>Drawings (400200000)</td>
                                                        <td><span class="text-center"><?php echo number_format($total_drawings, 2); ?></span></td>
                                                    </tr>

                                                    <!-- Row 12 -->
                                                    <tr>
                                                        <td><strong>Total Non-Current Assets</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                $sum_non_current_assets = $total_furniture + $total_software + $total_office_equipments + $total_surveillance_equipments;
                                                                echo number_format($sum_non_current_assets, 2);
                                                                ?>
                                                            </span></td>
                                                        <td>Net-Profit Loss</td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                //calculate pbit
                                                                $pbit = $total_income - (
                                                                    $rent_closing +
                                                                    $office_expense_closing +
                                                                    $disc_given_closing +
                                                                    $salary_expense_closing +
                                                                    $fuel_closing +
                                                                    $maintenance_closing +
                                                                    $ebill_closing +
                                                                    $internet_bill_closing +
                                                                    $other_expense_closing
                                                                );

                                                                $net_profit = $pbit - $taxpaid;

                                                                $net_profit = $net_profit * -1;

                                                                echo number_format($net_profit, 2);

                                                                ?>
                                                            </span></td>
                                                    </tr>


                                                    <!-- Row 13 -->
                                                    <tr>
                                                        <td><strong></strong></td>
                                                        <td><span>
                                                                <?php
                                                                // $total_equity = $total_owner_capital + $total_drawings + $total_net_profit_loss;
                                                                // echo number_format($total_equity, 2);
                                                                ?>
                                                            </span></td>

                                                        <td><strong>Retained earnings</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                if ($total_closing > 0) {
                                                                    $ret_earning = $total_closing;

                                                                    $formatted =  number_format($ret_earning, 2);
                                                                    echo $formatted;
                                                                } elseif ($total_closing < 0) {
                                                                    $ret_earning = $total_closing;

                                                                    $formatted =  number_format($ret_earning, 2);
                                                                    echo $formatted;
                                                                }
                                                                ?>
                                                            </span></td>

                                                    </tr>

                                                    <!-- Row 14 -->
                                                    <tr>
                                                        <td><strong>Total Assets</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                $sum_assets = $sum_current_assets + $sum_non_current_assets;
                                                                echo number_format($sum_assets, 2);
                                                                ?>
                                                            </span></td>
                                                        <td><strong>Total Equity</strong></td>
                                                        <td><span class="text-center">
                                                                <?php
                                                                $total_equity = $total_owner_capital + $total_drawings + $net_profit - $ret_earning;
                                                                echo number_format($total_equity, 2);
                                                                ?>
                                                            </span></td>
                                                    </tr>


                                                    <!-- Final Row -->
                                                    <tr class="table-success">
                                                        <td></td>
                                                        <td></td>
                                                        <td>
                                                            <h4><strong>Total Liabilities and Equity</strong></h4>
                                                        </td>
                                                        <td>
                                                            <h6><span class="text-center"><?php echo number_format($sum_liability + $total_equity, 2); ?></span></h6>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>





                                <!--<div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                                   
                                                            <th>Account</th>
                                                            <th>Amount</th>   
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Currrent Assets</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>

                                                            <td><h6 class="m-b-0 m-t-10">Cash at bank</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($bank_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Accounts Receivable</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($acc_rec_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Cash in hand</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($cash_in_hand_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Inventory On Hand</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right"><?php echo round($stock_in_hand_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Security Deposits </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right">0.00</h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Stores and Spares</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6 text-right">0.00</h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Current Assets </b></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($current_assests); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Non Currrent Assets</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Building and Land</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($land_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Equipments</h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($equip_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Assets Non Current Assets</b></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($non_current_assests); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Assets </b></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($assests); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Liabilities</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Current Liabilities </b></h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Account payable </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($payable_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Accrued Expense </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($expense_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Custom duty, cess and others </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6">0.00</h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10">Employee's Salaries </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($salary_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Current Liabilities</b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($liabilities); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Equity</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Owner's Capital</b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($owner_total); ?></h7></td>
                                                        </tr>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Owner's Draw</b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($owner_draws_total); ?></h7></td>
                                                        </tr>
                                                        <?php

                                                        $bsql = mysqli_query($conn, "SELECT * FROM `tbl_account` where LEFT(acode,6) between '40020000' and '500000000' and created_date between '$f_date' and '$t_date' ");
                                                        while ($value = mysqli_fetch_assoc($bsql)) {
                                                            $aname = $value['aname'];
                                                            $acode = $value['acode'];


                                                            $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where acode='$acode' and opening_date < '$f_date'  and created_by='$userid'");
                                                            $data = mysqli_fetch_assoc($sql);
                                                            $opening_bal_shareholder = $data['opening_bal'];


                                                            $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as shareholder FROM tbl_trans_detail where acode='$acode' and created_date between '$f_date' and '$t_date' and created_by='$userid'");
                                                            $data1 = mysqli_fetch_assoc($sql1);
                                                            $shareholder = $data1['shareholder'];

                                                            $shareholder_total = ($opening_bal_shareholder + $shareholder);
                                                        ?>
                                                         <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b><?php echo $aname; ?></b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($shareholder_total); ?></h7></td>
                                                        </tr>
                                                        <?php }
                                                        ?>
                                                        <tr>
                                                            <td><h6 class="m-b-0 m-t-10"><b>Total Earning</b> </h6></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo round($earning); ?></h7></td>
                                                        </tr>
                                                         <tr>
                                                            <td><h4 class="m-b-0 m-t-10"><b>Total Equity</b> </h4></td>
                                                            <td><h4 class="m-b-0 m-t-6"><?php echo round($assests); ?></h4></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>-->
                                <hr>
                                <!--  <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">
                                  
                                                                                   
                                            <h3 class="m-b-0 m-t-10">AMT ( <?php $net_amount = $total_damount - $total_camount;
                                                                            echo $net_amount; ?> )</h3>
                                        </div>                                    
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                            
                                        </div>
                                    </div>  -->
                            </div>

                        </div>


                        <div class="row clearfix ">
                            <div class="col-md-6 ">

                            </div>

                        </div>
                    </div>
                </div>
        </div>
    </div>

    </div>
    </div>



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
<style type="text/css">Add commentMore actions
    .data-table-container {
        padding: 10px;
        border: 2px solid black;
    }

    table.dataTable {
        border-collapse: collapse !important;
        width: 100%;
    }

    table.dataTable th,
    table.dataTable td {
        border: 1px solid black !important;
        padding: 6px;
        text-align: left;
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
            searching: true,
            buttons: [{
                    extend: 'pdfHtml5',
                    text: '<?php echo $c_name; ?>',

                    title: '<?php echo $c_name; ?> (Balance Sheet)',


                    text: '<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',

                    className: 'btn btn-danger',

                    customize: function(doc) {
                        doc.content[1].table.widths =
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
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


                    title: '<?php echo $c_name; ?> (Balance Sheet)',


                },


            ]


        });
    });
</script>


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->

</html>