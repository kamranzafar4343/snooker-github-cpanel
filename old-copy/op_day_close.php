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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a>Opening Day Close Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Opening Day Close Report</li>
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
                                            <h3 class="text-center">Opening Day Close Report</h3>


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
                                <form action="op_day_close.php" method="post" enctype="multipart/form-data" id='form1'>
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

                                <?php
                                if ($userid == 1) {
                                    $created_by = 'parent_id';
                                } else {
                                    $created_by = 'created_by';
                                }
                                ///////////////////////// opening///////////////////////////////////////

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='100700' and  " . $created_by . "='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_bank = $data['opening_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as bank_bal FROM tbl_trans_detail where Left(acode, 6)='100700' and created_date <  '$f_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $bank_bal_deb = $data1['bank_bal'];

                                $opening_bank_total = round($opening_bal_bank + $bank_bal_deb, 0);

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100100'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_cash = $data['opening_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_bal FROM tbl_trans_detail where Left(acode, 6)='100100' and created_date <  '$f_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $cash_bal = $data1['cash_bal'];

                                $opening_cash_total = round($opening_bal_cash + $cash_bal, 0);

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='300100'  and " . $created_by . "='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_cogs = $data['opening_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount) as revenue FROM tbl_trans_detail where Left(acode, 6) IN('300100') and DATE(created_date) < '$f_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $opening_revenue = $data1['revenue'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(c_amount) as return_amt FROM tbl_trans_detail where Left(acode, 9) IN('300100100') and DATE(created_date) < '$f_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $opening_return = $data1['return_amt'];

                                $opening_cog_total = round(($opening_bal_cogs + $opening_revenue) - $opening_return, 0);

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal_rec FROM tbl_account_lv2 where Left(acode, 6)='100200'  and " . $created_by . "='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_rec = $data['opening_bal_rec'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as rec_bal FROM tbl_trans_detail where Left(acode, 6)='100200' and created_date <  '$f_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $rec_bal = $data1['rec_bal'];

                                $opening_rec_total = round($opening_bal_rec + $rec_bal, 0);


                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='200200' and " . $created_by . "='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_payable = abs($data['opening_bal']);


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as payable FROM tbl_trans_detail where Left(acode, 6)='200200' and DATE(created_date) < '$f_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $open_payable = $data1['payable'];

                                $open_payable_total = abs(-$opening_bal_payable + $open_payable);


                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 3)='500' and Left(acode, 9) != '500100400' and " . $created_by . "='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_expense = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as expense FROM tbl_trans_detail where Left(acode, 3)='500' and Left(acode, 9) != '500100400' and created_date < '$f_date' and  " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $open_expense = $data1['expense'];

                                $open_expense_total = ($opening_bal_expense + $open_expense);

                                $sql = mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='500100'");
                                $data = mysqli_fetch_assoc($sql);
                                $opening_bal_salary = $data['opening_bal'];


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as salary FROM tbl_trans_detail where Left(acode, 6)='500100' and created_date < '$f_date'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $open_salary = $data1['salary'];
                                $open_salary_total = ($opening_bal_salary + $open_salary);





                                $open_liabilities = round($opening_bal_salary + $open_expense_total + $open_payable_total, 0);
                                $opening_assets = round($opening_bank_total + $opening_cash_total + $opening_cog_total + $opening_rec_total, 0);
                                $total_opening = round($opening_cog_total + $opening_cash_total, 0);
                                ///////////////////////////////////////////////////////////////////////////

                                ///////////////////////// Day Close ///////////////////////////////////////

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as bank_bal FROM tbl_trans_detail where Left(acode, 6)='100700' and created_date between '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $bank_bal_today = $data1['bank_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_bal FROM tbl_trans_detail where Left(acode, 6)='100100' and created_date between '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $cash_bal_today = $data1['cash_bal'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(gross_amount) as revenue FROM tbl_sale where  DATE(created_date)  between '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_revenue = $data1['revenue'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(gross_amount) as revenue FROM tbl_sale where sale_type='Cash' and DATE(created_date)  between '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_cash_revenue = $data1['revenue'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(gross_amount) as revenue FROM tbl_sale where sale_type='Credit' and DATE(created_date)  between '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_credit_revenue = $data1['revenue'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(c_amount) as return_amt FROM tbl_trans_detail where Left(acode, 9) IN('300100100') and DATE(created_date)  between '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_return = $data1['return_amt'];

                                $today_cog = round($today_revenue - $today_return, 0);
                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount) as rec_bal FROM tbl_trans_detail where  invoice_no LIKE '%CR%' and date(created_date) BETWEEN '$f_date' and '$t_date' and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $rec_bal_today = $data1['rec_bal'];

                                $sql1 = mysqli_query($conn, "
                                 SELECT SUM(c_amount) as payable 
                                 FROM tbl_trans_detail td1 
                                 WHERE LEFT(acode, 6)='100100' 
                                 AND invoice_no LIKE '%CP%' 
                                 AND DATE(created_date) BETWEEN '$f_date' AND '$t_date' 
                                 AND $created_by = '$userid' 
                                 AND NOT EXISTS (
                                     SELECT 1 
                                     FROM tbl_trans_detail td2 
                                     WHERE td2.invoice_no = td1.invoice_no 
                                     AND LEFT(td2.acode, 3)='500' 
                                     AND td2.d_amount > 0 
                                     AND td2.trans_id = td1.trans_id
                                 )
                             ");

                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_payable = abs($data1['payable']);


                                $sql1 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as expense FROM tbl_trans_detail where Left(acode, 3) = '500' AND LEFT(acode, 9) != '500100400' and date(created_date) between '$f_date' and '$t_date'  and  " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_expense = $data1['expense'];

                                $sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as salary FROM tbl_trans_detail where Left(acode, 9)='500100400' and date(created_date) between '$f_date' and '$t_date'  and ".$created_by."='$userid'");
                                $data1=mysqli_fetch_assoc($sql1);
                                $today_salary = $data1['salary'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(discount) as today_discount FROM tbl_sale where  date(created_date) between '$f_date' and '$t_date'  and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_discount = $data1['today_discount'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(gross_amount) as today_pur FROM tbl_purchase where  date(created_date) between '$f_date' and '$t_date'  and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_pur = $data1['today_pur'];

                                $sql1 = mysqli_query($conn, "SELECT SUM(gross_amount-amount_recieved) as today_credit FROM tbl_sale  WHERE sale_type='Credit'  and " . $created_by . "='$userid'");
                                $data1 = mysqli_fetch_assoc($sql1);
                                $today_credit = $data1['today_credit'];



                                $today_liabilities = round($today_salary + $today_expense + $today_payable, 0);
                                $today_assets = round($bank_bal_today + $cash_bal_today + $today_cog + $rec_bal_today, 0);
                                $total_today = round(($today_assets - $today_liabilities) + $total_opening, 0);

                                $recievable = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' ");
                                $recievable_opening = mysqli_query($conn, "SELECT SUM(opening_bal) as total_rec_open FROM `tbl_account_lv2` where LEFT(acode,6)='100200' ");
                                $recievable_tot = mysqli_fetch_assoc($recievable);
                                $tot_rec_before = $recievable_tot['total_rec'];

                                $rec_tot_opening = mysqli_fetch_assoc($recievable_opening);
                                $total_rec_open = $rec_tot_opening['total_rec_open'];

                                $tot_rec = round($tot_rec_before - $total_rec_open);
                                $sql3 = mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000') and " . $created_by . "='$userid'");

                                $data3 = mysqli_fetch_assoc($sql3);
                                $cash_in_hand = $data3['cash_in_hand'];

                                $sql4 = mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                                $data4 = mysqli_fetch_assoc($sql4);
                                $opening_bal = $data4['opening_bal'];

                                $sql_credit = mysqli_query($conn, "SELECT SUM(amount_recieved) as total_credit FROM tbl_sale where sale_type='Credit' and " . $created_by . "='$userid''");
                                $data5 = mysqli_fetch_assoc($sql_credit);
                                $total_credit = $data5['total_credit'];

                                $cash_now = $opening_bal + $cash_in_hand;
                                ///////////////////////////////////////////////////////////////////////////
                                
                                ?>
                                
                                <div class="row clearfix">
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
                                                        <td><h5 class="m-b-0 m-t-10">Opening Balance</h5></td>
                                                        <td><h7 class="m-b-0 m-t-6"><?php echo number_format($total_opening); ?></h7></td> 
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Sale</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_cog); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Cash Sale</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_cash_revenue); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Credit Sale</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_credit_revenue); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Discount</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_discount); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Sale Return</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_return); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Cash Reciept</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($rec_bal_today); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Cash Payment</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_payable); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Expense</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_expense); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Salary Expense</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_salary); ?></h7>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <h4 class="m-b-0 m-t-10">Day Closing Balance</h4>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($cash_now); ?></h7>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Purchasing</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($today_pur); ?></h7>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <h5 class="m-b-0 m-t-10">Total Credit</h5>
                                                        </td>
                                                        <td>
                                                            <h7 class="m-b-0 m-t-6"><?php echo number_format($tot_rec); ?></h7>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <hr>

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

                    title: '<?php echo $c_name; ?> (Opening Day Close Report)',


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


                    title: '<?php echo $c_name; ?> (Opening Day Close Report)',


                },


            ]


        });
    });
</script>


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->

</html>