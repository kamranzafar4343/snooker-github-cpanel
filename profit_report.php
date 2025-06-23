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
            <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> P/L Report</h2>
            <ul class="breadcrumb">
              <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>
              <li class="breadcrumb-item"> P/L Report</li>
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
        $sale_type = mysqli_real_escape_string($conn, $_POST['sale_type']);
        $user = mysqli_real_escape_string($conn, $_POST['users']);
        $customer = mysqli_real_escape_string($conn, $_POST['customer']);
      } else {
        $sale_type = 'All';
        $user = 'All';
        $customer = 'All';
        $f_date = date('Y-m-d');
        $t_date = date('Y-m-d');
        $newDate1 = date("d-m-Y", strtotime($f_date));
        $newDate2 = date("d-m-Y", strtotime($t_date));
      }
      if (isset($_GET['sale_type'])) {
        $sale_type = $_GET['sale_type'];
        $f_date = $_GET['fdate'];
        $t_date = $_GET['tdate'];
        $newDate1 = date("d-m-Y", strtotime($f_date));
        $newDate2 = date("d-m-Y", strtotime($t_date));
        $user = 'All';
        $customer = 'All';
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
                      <h3 class="text-center">Profit Report</h3>


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

                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date !
                </div>
                <form action="profit_report.php" method="post" enctype="multipart/form-data" id='form1'>
                  <div class="body">

                    <div class="row clearfix">
                      <div class="col-md-6 col-sm-12">
                        <div class="form-group">
                          <label for="description">From Date </label>
                          <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if ($f_date) {
                                                                                                                                            echo $f_date;
                                                                                                                                          } else { ?><?php echo date('Y-m-d');
                                                                                                                                                    } ?>">
                        </div>
                      </div>
                      <div class="col-md-6">
                        <label for="description">To Date </label>
                        <div class="form-group">
                          <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if ($t_date) {
                                                                                                                                            echo $t_date;
                                                                                                                                          } else { ?><?php echo date('Y-m-d');
                                                                                                                                                    } ?>">
                        </div>
                      </div>
                      <div class="col-md-2 col-sm-12" hidden>
                        <label for="description">Sale Type </label>
                        <div class="form-group">
                          <select class="form-control select_group" name="sale_type" id='sale_type'>
                            <?php if ($sale_type == 'Credit') { ?>
                              <option value="All">All</option>
                              <option value="Credit" selected="">Credit</option>
                              <option value="Cash">Cash</option>
                            <?php } else if ($sale_type == 'Cash') { ?>
                              <option value="All">All</option>
                              <option value="Credit">Credit</option>
                              <option value="Cash" selected="">Cash</option>
                            <?php } else { ?>
                              <option value="All" selected="">All</option>
                              <option value="Credit">Credit</option>
                              <option value="Cash">Cash</option>
                            <?php } ?>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12" hidden>
                        <label for="description">User </label>
                        <div class="form-group">
                          <select class="form-control users" name="users">
                            <option selected="selected" value="All">All</option>
                            <?php
                            $sql = "SELECT * FROM users where user_privilege='Operator'";
                            foreach ($conn->query($sql) as $row) {

                              if ($row['user_id'] == $user) {
                                echo "<option value=$row[user_id] selected>$row[user_name]</option>";
                              } else {
                                echo "<option value=$row[user_id]>$row[user_name]</option>";
                              }
                            }

                            echo "</select>";
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="col-md-3 col-sm-12" hidden>
                        <label for="description">Customer </label>
                        <div class="form-group">
                          <select class="form-control users" name="customer">
                            <option selected="selected" value="All">All</option>
                            <?php
                            $sql = "SELECT * FROM tbl_customer";
                            foreach ($conn->query($sql) as $row) {

                              if ($row['customer_id'] == $customer) {
                                echo "<option value=$row[customer_id] selected>$row[username] $row[mobile_no1]</option>";
                              } else {
                                echo "<option value=$row[customer_id]>$row[username] $row[mobile_no1]</option>";
                              }
                            }

                            echo "</select>";
                            ?>

                          </select>
                        </div>
                      </div>
                      <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                      </div>
                      <!--   <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="detail" onclick="check()" >Detail</button>
                                 </div> -->
                      <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                        <button style="width:100%; " type="submit" class="btn btn-sm btn-info" name="summary" onclick="check()">Summary</button>
                      </div>
                      <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                      </div>
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

                <?php
                $query = mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $user_privilege = $data['user_privilege'];
                if ($user_privilege == 'superadmin') {
                  $sqll = mysqli_query($conn, "SELECT * FROM `tbl_sale`");
                } else {
                  $sqll = mysqli_query($conn, "SELECT * FROM `tbl_sale` where created_by='$userid'");
                }

                $dataa = mysqli_fetch_assoc($sqll);
                $sale_id = $dataa['sale_id'];
                $customer_name = $dataa['customer_name'];

                ?>

                <div class="row">
                  <div class="clearfix text-right col-md-6">

                    <span>
                      <h3><b>Sale Type : </b> <?php echo $sale_type; ?></h3>
                    </span>
                  </div>
                  <div class="clearfix text-right col-md-6">

                    <span> <b>FROM DATE/TO DATE : </b> <?php echo $newDate1 . '/' . $newDate2; ?>
                    </span>
                  </div>
                </div>
                <hr>
                <div class="row clearfix">
                  <div class="col-md-12">
                    <div class="table-responsive">

                      <table id="example" class="display" style="width:100%">
                        <thead class="thead-dark">
                          <tr>
                            <th>#</th>
                            <th>Product #</th>
                            <th>Sale Quantity </th>
                            <th>Rtn Quantity </th>
                            <th>Net Quantity </th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Purchase Price</th>
                            <th>Profit</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php

                          if ($sale_type == 'Credit') {
                            $where_saletype = "and tbl_sale.sale_type='Credit'";

                            if ($user == 'All') {
                              $where_created = "";
                              $where_created_return = "";
                            } else {
                              $where_created = "and tbl_sale.created_by=" . $user . "";
                              $where_created_return = "and tbl_sale_return.created_by=" . $user . "";
                            }
                            if ($customer == 'All') {
                              $where_customer = "";
                              $where_customer_return = "";
                            } else {
                              $where_customer = "and tbl_sale.customer_name=" . $customer . "";
                              $where_customer_return = "and tbl_sale_return.customer_name=" . $customer . "";
                            }

                            $csql = mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_saletype $where_customer $where_created group by tbl_sale_detail.product order by tbl_sale.created_date asc");
                          }
                          if ($sale_type == 'Cash') {

                            $where_saletype = "and tbl_sale.sale_type='Cash'";

                            if ($user == 'All') {
                              $where_created = "";
                              $where_created_return = "";
                            } else {
                              $where_created = "and tbl_sale.created_by=" . $user . "";
                              $where_created_return = "and tbl_sale_return.sales_men=" . $user . "";
                            }
                            if ($customer == 'All') {
                              $where_customer = "";
                              $where_customer_return = "";
                            } else {
                              $where_customer = "and tbl_sale.customer_name=" . $customer . "";
                              $where_customer_return = "and tbl_sale_return.customer_name=" . $customer . "";
                            }

                            $csql = mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_saletype $where_customer $where_created group by tbl_sale_detail.product order by tbl_sale.created_date asc");
                          } else {

                            if ($user == 'All') {
                              $where_created = "";
                              $where_created_return = "";
                            } else {
                              $where_created = "and tbl_sale.created_by=" . $user . "";
                              $where_created_return = "and tbl_sale_return.sales_men=" . $user . "";
                            }
                            if ($customer == 'All') {
                              $where_customer = "";
                              $where_customer_return = "";
                            } else {
                              $where_customer = "and tbl_sale.customer_name=" . $customer . "";
                              $where_customer_return = "and tbl_sale_return.customer_name=" . $customer . "";
                            }

                            $csql = mysqli_query($conn, "SELECT tbl_sale.*,tbl_sale_detail.* From tbl_sale_detail inner join tbl_sale on tbl_sale_detail.sale_id=tbl_sale.sale_id where  DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_customer $where_created group by tbl_sale_detail.product order by tbl_sale.created_date asc");
                          }

                          $count = 0;
                          $amount = 0;
                          $qty_line = 0;
                          while ($value = mysqli_fetch_assoc($csql)) {
                            $sale_id = $value['sale_id'];
                            $product = $value['product'];
                            $rate = $value['rate'];
                            $pur_item_id = $value['pur_item_id'];

                            $sql_recieved = mysqli_query($conn, "SELECT SUM(amount_recieved) as recieved_total, SUM(net_amount) as net_amount FROM tbl_sale where DATE(tbl_sale.created_date)   between '$f_date' and '$t_date' $where_customer $where_created");
                            $data1 = mysqli_fetch_assoc($sql_recieved);
                            $recieved_total = $data1['recieved_total'];
                            $net_total = $data1['net_amount'];

                            $sql_return = mysqli_query($conn, "SELECT SUM(amount_returned) as return_totalt FROM tbl_sale_return where DATE(tbl_sale_return.created_date)   between '$f_date' and '$t_date' $where_customer_return $where_created_return");
                            $data1 = mysqli_fetch_assoc($sql_return);
                            $return_totalt = $data1['return_totalt'];


                            $sql_item = mysqli_query($conn, "SELECT * FROM tbl_items where item_id=$product");
                            $data1 = mysqli_fetch_assoc($sql_item);
                            $item = $data1['item_name'];
                            $category = $data1['category'];

                            $sql2 = mysqli_query($conn, "SELECT catagory_name FROM tbl_cat where id=$category");
                            $data1 = mysqli_fetch_assoc($sql2);
                            $catagory_name = $data1['catagory_name'];

                            $sql_qty = mysqli_query($conn, "SELECT SUM(qty) as qty_line FROM tbl_sale_detail INNER JOIN tbl_sale
ON tbl_sale_detail.sale_id = tbl_sale.sale_id WHERE DATE(tbl_sale.created_date) between '$f_date' and '$t_date' and tbl_sale_detail.product='$product' $where_created $where_customer");
                            $data1 = mysqli_fetch_assoc($sql_qty);
                            $qty_line = $data1['qty_line'];
                            $sql_qty_return = mysqli_query($conn, "SELECT SUM(returned_qty) as return_qty_line FROM tbl_sale_return_detail INNER JOIN tbl_sale ON tbl_sale_return_detail.sale_id = tbl_sale.sale_id WHERE DATE(tbl_sale.created_date) between '$f_date' and '$t_date' and tbl_sale_return_detail.product='$product'  $where_created $where_customer");
                            $data2 = mysqli_fetch_assoc($sql_qty_return);
                            $return_qty_line = $data2['return_qty_line'];
                            if ($return_qty_line == '') {
                              $return_qty_line = 0;
                            }
                            $t_qty = $qty_line - $return_qty_line;
                            $amount = $t_qty * $rate;
                            $total_amount += $amount;
                            $sql1 = mysqli_query($conn, "SELECT rate FROM tbl_purchase_detail where  qty_rec!=''  and  transfer='0' and product='$product' and  pur_item_id='$pur_item_id'");
                            $data1 = mysqli_fetch_assoc($sql1);
                            $pur_rate = round($data1['rate'] * $t_qty, 0);

                            $profit = round($amount - $pur_rate, 0);
                            $count++;

                          ?>

                            <tr>
                              <td><?php echo $count; ?></td>
                              <td><?php echo $product . " - " . $catagory_name . " " . $item; ?></td>
                              <td><?php echo $qty_line; ?></td>
                              <td><?php echo $return_qty_line; ?></td>
                              <td><?php echo $t_qty; ?></td>
                              <td><?php echo $rate; ?></td>
                              <td><?php echo $amount; ?></td>
                              <td><?php echo $pur_rate; ?></td>
                              <td><?php echo $profit; ?></td>
                            </tr>

                          <?php } ?>


                        </tbody>
                        <tfoot>
                          <tr class="bg-dark text-white">
                            <th>
                              <h5>Total</h5>
                            </th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th>
                              <h5><span class="qty_total"></span></h5>
                            </th>

                            <th></th>
                            <th>
                              <h5><span class="price_total"></span></h5>
                            </th>
                            <th>
                              <h5><span class="pur_total"></span></h5>
                            </th>

                            <th>
                              <h5><span class="profit_total"></span></h5>
                            </th>


                          </tr>
                        </tfoot>
                      </table>

                    </div>
                  </div>
                </div>
                <hr>
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
                 where Left(acode, 6)='300500' and date(created_date) between '$f_date' and '$t_date'     ");
                $result_cr1 = mysqli_fetch_assoc($sql_credit_sale1);
                $credit_sale1 = $result_cr1['credit_damount'];

                $sql_credit_sale2 = mysqli_query($conn, "SELECT SUM(c_amount) as credit_camount FROM tbl_trans_detail where
                 Left(acode, 6)='300500' and date(created_date) between '$f_date' and '$t_date'     ");
                $result_cr2 = mysqli_fetch_assoc($sql_credit_sale2);
                $credit_sale2 = $result_cr2['credit_camount'];

                $credit_sale_closing = $credit_sale1 - $credit_sale2;

                //sale return
                $sql_sale_return1 = mysqli_query($conn, "SELECT SUM(d_amount) as sale_return1 FROM tbl_trans_detail 
                where Left(acode, 6)='300600' and date(created_date) between '$f_date' and '$t_date'     ");
                $result_sr1 = mysqli_fetch_assoc($sql_sale_return1);
                $sale_return1 = $result_sr1['sale_return1'];

                $sql_sale_return2 = mysqli_query($conn, "SELECT SUM(c_amount) as sale_return2 FROM tbl_trans_detail 
                where Left(acode, 6)='300600' and date(created_date) between '$f_date' and '$t_date'     ");
                $result_sr2 = mysqli_fetch_assoc($sql_sale_return2);
                $sale_return2 = $result_sr2['sale_return2'];

                $sale_return_closing = $sale_return1 - $sale_return2;

                //net sale
                $total_sale = abs($cash_sale_closing) + abs($credit_sale_closing);
                $net_sale = abs($total_sale) - abs($sale_return_closing);

                //cogs
                $sql_cog1 = mysqli_query($conn, "SELECT SUM(d_amount) as cog1 FROM tbl_trans_detail where 
                Left(acode, 6)='300300' and date(created_date) between '$f_date' and '$t_date'     ");
                $result_cog1 = mysqli_fetch_assoc($sql_cog1);
                $cog1 = $result_cog1['cog1'];

                $sql_cog2 = mysqli_query($conn, "SELECT SUM(c_amount) as cog2 FROM tbl_trans_detail where 
                Left(acode, 6)='300300' and date(created_date) between '$f_date' and '$t_date'     ");
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

                <style>
                  #example {
                    width: 100%;
                    border-collapse: separate;
                    border-spacing: 0 8px;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                  }

                  #example thead th {
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

                <!-- Step 4: Display the tables nicely -->
                <div class="row clearfix">

                  <!-- First Column: Income Table -->
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table id="example22" class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-dark">
                          <tr>
                            <th>Account</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Cash Sales</td>
                            <td><?php echo number_format($cash_sale_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Credit Sales</td>
                            <td><?php echo number_format($credit_sale_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Sale Return</td>
                            <td><?php echo number_format($sale_return_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Net Sales</td>
                            <td><?php echo number_format($net_sale, 2); ?></td>
                          </tr>
                          <tr>
                            <td>COGS</td>
                            <td><?php echo number_format($cog_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Gross Profit</td>
                            <td><?php echo number_format($gross_profit, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Other Income</td>
                            <td><?php echo number_format($other_income_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Discount Availed</td>
                            <td><?php echo number_format($disc_avail_closing, 2); ?></td>
                          </tr>
                          <tr class="table-success">
                            <td>
                              <h6><strong>Total Income</strong></h6>
                            </td>
                            <td>
                              <h6><strong><?php echo number_format($total_income, 2); ?></strong></h6>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                  <!-- Second Column: Expenses and Profit Table -->
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table id="example44" class="table table-striped table-bordered" style="width:100%">
                        <thead class="thead-dark">
                          <tr>
                            <th>Account</th>
                            <th>Amount</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Rent</td>
                            <td><?php echo number_format($rent_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Office Expense</td>
                            <td><?php echo number_format($office_expense_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Discount Given</td>
                            <td><?php echo number_format($disc_given_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Salary Expense</td>
                            <td><?php echo number_format($salary_expense_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Fuel</td>
                            <td><?php echo number_format($fuel_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Maintenance Expenses</td>
                            <td><?php echo number_format($maintenance_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Electricity bill</td>
                            <td><?php echo number_format($ebill_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Internet bill</td>
                            <td><?php echo number_format($internet_bill_closing, 2); ?></td>
                          </tr>
                          <tr>
                            <td>Other Expenses</td>
                            <td><?php echo number_format($other_expense_closing, 2); ?></td>
                          </tr>

                          <!-- Profit Before Interest and Tax -->
                          <tr>
                            <td><strong>Profit Before Interest And Tax (PBIT)</strong></td>
                            <td>
                              <?php
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
                              echo number_format($pbit, 2);
                              ?>
                            </td>
                          </tr>

                          <tr>
                            <td>Interest</td>
                            <td><?php echo 'N/A'; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Profit Before Tax</strong></td>
                            <td><strong><?php echo number_format($pbit, 2); ?></strong></td>
                          </tr>
                          <tr>
                            <td>Tax Paid</td>
                            <td><?php echo number_format($taxpaid, 2); ?></td>
                          </tr>

                          <tr class="table-success">
                            <td>
                              <h6><strong>Net Profit</strong></h6>
                            </td>
                            <td>
                              <h6><strong><?php echo number_format($pbit - $taxpaid, 2); ?></strong></h6>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>

                </div>

      </body>
      <!-- Javascript -->
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

      <script type="text/javascript">
        function GoBackWithRefresh(event) {
          if ('referrer' in document) {
            // window.location = document.referrer;
            window.location = ('customer.php');
            /* OR */
            //location.replace(document.referrer);
          } else {
            window.location('customer.php');
            // window.history.back().back();
            // window.history.back();
          }
        }
      </script>
       <style type="text/css">
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
          $(".users").select2();
          $('#example').DataTable({
              "bPaginate": true,
              "bLengthChange": true,
              "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
              ],
              dom: 'Bfrtip',
              scrollY: true,
              scrollX: false,
              "paging": true,
              "ordering": false,
              "info": false,
              searching: true,
              "processing": true,

              buttons: [
                'pageLength',
                {
                  extend: 'pdf',
                  text: 'PDF',
                  footer: true,
                  title: '<?php echo $c_name; ?> (P/L Report for : <?php echo $sale_type; ?> Sale)',
                  orientation: 'landscape',
                  text: '<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
                  pageSize: 'LEGAL',
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
                  footer: true,
                  className: 'btn btn-success',
                  titleAttr: 'print',
                  text: '<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>',


                  title: '<?php echo $c_name; ?> (P/L Report for : <?php echo $sale_type; ?> Sale)',
                  customize: function(win) {
    // Get the extra tables
    const table1 = document.getElementById('example22')?.outerHTML || '';
    const table2 = document.getElementById('example44')?.outerHTML || '';

    // Wrap them in divs with borders
    const wrapped1 = `<div class="print-bordered">${table1}</div>`;
    const wrapped2 = `<div class="print-bordered">${table2}</div>`;

    // Append them to the print window after the main table
    $(win.document.body).append(wrapped1);
    $(win.document.body).append(wrapped2);

    // Inject border styles
    $(win.document.head).append(`
      <style>
        .print-bordered {
          border: 1px solid black;
          padding: 10px;
          margin-top: 20px;
        }
        table {
          border-collapse: collapse;
        }
        table, th, td {
          border: 1px solid #ccc;
        }
        th, td {
          padding: 4px;
        }
      </style>
    `);

    // Optional styling
    $(win.document.body).css('font-size', '10pt');
    $(win.document.body).find('table').addClass('compact').css('font-size', 'inherit');
  }
                },


              ],

              "footerCallback": function(row, data, start, end, display) {
                var api = this.api(),
                  data;

                var intVal = function(i) {
                  return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '') * 1 :
                    typeof i === 'number' ?
                    i : 0;
                };

                qtyTotal = api
                  .column(4, {
                    page: 'current'
                  })
                  .data()
                  .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                  }, 0).toFixed(0);


                netTotal = api
                  .column(6, {
                    page: 'current'
                  })
                  .data()
                  .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                  }, 0).toFixed(2);



                netpurchase = api
                  .column(7, {
                    page: 'current'
                  })
                  .data()
                  .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                  }, 0).toFixed(2);

                netprofit = api
                  .column(8, {
                    page: 'current'
                  })
                  .data()
                  .reduce(function(a, b) {
                    return intVal(a) + intVal(b);
                  }, 0).toFixed(0);


                $(".qty_total").html(qtyTotal);
                $(".price_total").html(netTotal);
                $(".pur_total").html(netpurchase);
                $(".profit_total").html(netprofit);
                //  recTotal = api
                //     .column( 6, { page: 'current'} )
                //     .data()
                //     .reduce( function (a, b) {
                //         return intVal(a) + intVal(b);
                //     }, 0 ).toFixed(2);
                // $("#total_rec").html("Rs "+recTotal);

                // var balance=(netTotal-recTotal).toFixed(2);
                // $("#balance").html("Rs "+balance);
              }

            }

          );
        });
      </script>
      <script type="text/javascript">
        function GoBackWithRefresh(event) {
          if ('referrer' in document) {
            // window.location = document.referrer;
            window.location = ('stock.php');
            /* OR */
            //location.replace(document.referrer);
          } else {
            window.location('stock.php');
            // window.history.back().back();
            // window.history.back();
          }
        }
      </script>
      <script type="text/javascript">
        function GoBackWithRefresh(event) {
          if ('referrer' in document) {
            // window.location = document.referrer;
            window.location = ('search_sale.php');
            /* OR */
            //location.replace(document.referrer);
          } else {
            window.location('search_sale.php');
            // window.history.back().back();
            // window.history.back();
          }
        }
      </script>


</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->

</html>