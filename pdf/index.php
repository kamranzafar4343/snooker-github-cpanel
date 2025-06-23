<!doctype html>
<html lang="en">
<head>
<title>How to generate PDF in PHP dynamically by using TCPDF</title>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<meta name="viewport" content="width=device-width" />
<!-- *Note: You must have internet connection on your laptop or pc other wise below code is not working -->
<!-- Add icon library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- bootstrap css and js -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"/>
<!-- JS for jQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-lg-12" align="center">
			<br>
			<h5 align="center">How to generate PDF in PHP dynamically by using TCPDF</h5>
			<br>
			<table class="table table-striped">
			<thead>
			  <tr>  
			  	<th>Account</th>
                <th>Amount</th>
             </tr>
			</thead>
			<tbody>
			<?php                
			include "../includes/config.php"; 
			$f_date=date('Y-m-d');
			$t_date=date('Y-m-d');
			////////////////////////////////////////////// Opening ///////////////////////////////////////////////////
			$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account_lv2 where Left(acode, 6)='300100'");
			$data=mysqli_fetch_assoc($sql);
			$opening_bal_cogs = $data['opening_bal'];

			$sql1=mysqli_query($conn, "SELECT SUM(d_amount) as revenue FROM tbl_trans_detail where Left(acode, 6) IN('300100') and DATE(created_date) < '$f_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$opening_revenue = $data1['revenue'];

			$sql1=mysqli_query($conn, "SELECT SUM(c_amount) as return_amt FROM tbl_trans_detail where Left(acode, 9) IN('300100100') and DATE(created_date) < '$f_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$opening_return = $data1['return_amt'];

			$sql=mysqli_query($conn, "SELECT SUM(opening_bal) as opening_bal FROM tbl_account where Left(acode, 6)='100100'");
			$data=mysqli_fetch_assoc($sql);
			$opening_bal_cash = $data['opening_bal'];

			$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_bal FROM tbl_trans_detail where Left(acode, 6)='100100' and created_date <  '$f_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$cash_bal = $data1['cash_bal'];

			$opening_cash_total=round($opening_bal_cash+$cash_bal, 0);

			$opening_cog_total=round(($opening_bal_cogs+$opening_revenue)-$opening_return, 0);
			$total_opening=round($opening_cog_total+$opening_cash_total,0);
			//////////////////////////////////////////////////////////////////////////////////////////////////////

			////////////////////////////////////////////// Day Close ///////////////////////////////////////////////////

			$sql1=mysqli_query($conn, "SELECT SUM(net_amount) as revenue FROM tbl_sale where  DATE(created_date)  between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_revenue = $data1['revenue'];

			$sql1=mysqli_query($conn, "SELECT SUM(amount_recieved) as revenue FROM tbl_sale where sale_type='Cash' and DATE(created_date)  between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_cash_revenue = $data1['revenue'];

			$sql1=mysqli_query($conn, "SELECT SUM(gross_amount) as revenue FROM tbl_sale where sale_type='Credit' and DATE(created_date)  between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_credit_revenue = $data1['revenue'];

			$sql_return=mysqli_query($conn, "SELECT  SUM(tbl_sale_return.amount_returned) as return_total, tbl_sale.created_date  FROM tbl_sale INNER JOIN tbl_sale_return ON tbl_sale.sale_id = tbl_sale_return.sale_id where DATE(tbl_sale.created_date)   between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql_return);
			$return_total=$data1['return_total'];

			$sql1=mysqli_query($conn, "SELECT SUM(c_amount) as return_amt FROM tbl_trans_detail where Left(acode, 9) IN('300100100') and DATE(created_date)  between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_return = $data1['return_amt'];

			$today_cog=round($today_revenue,0);
			$sql1=mysqli_query($conn, "SELECT SUM(discount) as today_discount FROM tbl_sale where  date(created_date) between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_discount = $data1['today_discount'];

			$sql1=mysqli_query($conn, "SELECT SUM(gross_amount) as today_pur FROM tbl_purchase where  date(created_date) between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_pur = $data1['today_pur'];

			$sql1=mysqli_query($conn, "SELECT SUM(gross_amount-amount_recieved) as today_credit FROM tbl_sale  WHERE sale_type='Credit'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_credit = $data1['today_credit'];

			$sql1=mysqli_query($conn, "SELECT SUM(d_amount) as rec_bal FROM tbl_trans_detail where Left(acode, 6)='100100' and invoice_no LIKE '%CR%' and date(created_date) BETWEEN '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$rec_bal_today = $data1['rec_bal'];

			$sql1=mysqli_query($conn, "SELECT SUM(c_amount) as payable FROM tbl_trans_detail where Left(acode, 6)='100100' and invoice_no LIKE '%CP%' and date(created_date) BETWEEN '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_payable = abs($data1['payable']);

			$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as expense FROM tbl_trans_detail where Left(acode, 6) IN ('500200', '500100') and date(created_date) between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_expense = $data1['expense'];

			$sql1=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as salary FROM tbl_trans_detail where Left(acode, 9)='500100400' and date(created_date) between '$f_date' and '$t_date'");
			$data1=mysqli_fetch_assoc($sql1);
			$today_salary = $data1['salary'];

			$sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000')");
			$data3=mysqli_fetch_assoc($sql3);
            $cash_in_hand = $data3['cash_in_hand'];

            $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");
			$data4=mysqli_fetch_assoc($sql4);
            $opening_bal = $data4['opening_bal'];

			$cash_now=$opening_bal+$cash_in_hand;

			$recievable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' ");
			$recievable_opening=mysqli_query($conn, "SELECT SUM(opening_bal) as total_rec_open FROM `tbl_account_lv2` where LEFT(acode,6)='100200' ");
			$recievable_tot=mysqli_fetch_assoc($recievable);
            $tot_rec_before=$recievable_tot['total_rec'];

            $rec_tot_opening=mysqli_fetch_assoc($recievable_opening);
            $total_rec_open=$rec_tot_opening['total_rec_open'];
			$tot_rec=round($tot_rec_before-$total_rec_open);

			
					?>
														<tr>
                                                            <td><h5 class="m-b-0 m-t-10">Opening Balance</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($total_opening);?></h7></td> 
                                                        </tr>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Sale</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_cog);?></h7></td> 
                                                        </tr>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Sale Return</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($return_total);?></h7></td> 
                                                        </tr>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Discount</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_discount);?></h7></td> 
                                                        </tr>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Cash Sale</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_cash_revenue);?></h7></td> 
                                                        </tr>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Credit Sale</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_credit_revenue);?></h7></td> 
                                                        </tr>
                                                        
                                                       
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Cash Receipt</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($rec_bal_today);?></h7></td> 
                                                        </tr>
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Cash Payment</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_payable);?></h7></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Expense</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_expense);?></h7></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Salary Expense</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_salary);?></h7></td> 
                                                        </tr>
                                                        <tr>
                                                            <td><h4 class="m-b-0 m-t-10">Day Closing Balance</h4></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($cash_now);?></h7></td> 
                                                        </tr>
                                                  
                                                   
                                                         <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Purchasing</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($today_pur);?></h7></td>
                                                   
                                                        </tr>
                                                        <tr>
                                                            <td><h5 class="m-b-0 m-t-10">Total Credit</h5></td>
                                                            <td><h7 class="m-b-0 m-t-6"><?php echo number_format($tot_rec);?></h7></td>
                                                   
                                                        </tr>
                                                        <tr>
                                                            <td>
                                                            	<a href="pdf_maker.php?ACTION=VIEW" class="btn btn-success"><i class="fa fa-file-pdf-o"></i> View PDF</a> &nbsp;&nbsp; 
														 		<a href="pdf_maker.php?MST_ID=<?php echo $data_row['MST_ID']; ?>&ACTION=DOWNLOAD" class="btn btn-danger"><i class="fa fa-download"></i> Download PDF</a>
																&nbsp;&nbsp; 
														 		<a href="pdf_maker.php?MST_ID=<?php echo $data_row['MST_ID']; ?>&ACTION=UPLOAD" class="btn btn-warning"><i class="fa fa-upload"></i> Upload PDF</a>
														 		&nbsp;&nbsp; 
														 		
                                                            </td>
                                                            <td><a href="pdf_maker.php?MST_ID=<?php echo $data_row['MST_ID']; ?>&ACTION=EMAIL" class="btn btn-info"><i class="fa fa-envelope"></i> Email PDF</a></td>
                                                   
                                                        </tr>
                                                   
			</tbody>
			</table>
		</div>
	</div>
</div>
</body>
</html> 