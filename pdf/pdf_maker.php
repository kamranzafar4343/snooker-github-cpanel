<?php  
error_reporting(0);              
include "../includes/config.php";  
include_once('tcpdf_6_2_13/tcpdf/tcpdf.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
$data=mysqli_fetch_assoc($sql);
$c_name = $data['c_name'];
$c_address = $data['c_address'];
$c_phone = $data['c_phone'];
$c_mobile = $data['c_mobile'];
$image1 = $data['user_profile'];
$lang=$data['lang'];
$c_email=$data['c_email'];


	//----- Code for generate pdf
	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->SetCreator(PDF_CREATOR);  
	//$pdf->SetTitle("Export HTML Table data to PDF using TCPDF in PHP");  
	$pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
	$pdf->SetDefaultMonospacedFont('helvetica');  
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
	$pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);  
	$pdf->setPrintHeader(false);  
	$pdf->setPrintFooter(false);  
	$pdf->SetAutoPageBreak(TRUE, 10);  
	$pdf->SetFont('helvetica', '', 14);  
	$pdf->AddPage(); //default A4
	//$pdf->AddPage('P','A5'); //when you require custome page size 
	
	$content = ''; 

	$content .= '
	<style type="text/css">
	body{
	font-size:12px;
	line-height:24px;
	font-family:"Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif;
	color:#000;
	}
	</style>    
	<table cellpadding="0" cellspacing="0" style="border:1px solid #ddc;width:100%;">
	<table style="width:100%;" >
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="center"><b>'.$c_name.'</b></td></tr>
	<tr><td colspan="2" align="center"><b>CONTACT: '.$c_phone.'</b></td></tr>
	<tr><td colspan="2" align="center"><b>DAY CLOSE REPORT</b></td></tr>
	<tr><td colspan="2"></td></tr>
	<tr><td></td><td align="right"><b>DATE : '.date("d-m-Y").'</b> </td></tr>
	<tr><td>&nbsp;</td><td align="right"></td></tr>
	<tr><td colspan="2" align="center"></td></tr>
	<tr class="heading" style="background:#eee;border-bottom:1px solid #ddd;font-weight:bold;">
		<td>
			ACCOUNT
		</td>
		<td align="right">
			AMOUNT
		</td>
	</tr>';
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

		$content .= '<hr>
		  		<tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Opening Balance</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($total_opening).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Sale</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_cog).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Sale Return</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($return_total).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Discount</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_discount).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Cash Sale</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_cash_revenue).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Credit Sale</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_credit_revenue).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Cash Receipt</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($rec_bal_today).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Cash Payment</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_payable).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Expense</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_expense).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Salary Expense</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_salary).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h4 class="m-b-0 m-t-10">Day Closing Balance</h4></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($cash_now).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Purchasing</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($today_pur).'</h7></td> 
               </tr><hr>
               <tr class="itemrows">
                    <td><h5 class="m-b-0 m-t-10">Total Credit</h5></td>
                    <td align="right"><h7 class="m-b-0 m-t-6">'.number_format($tot_rec).'</h7></td> 
               </tr>';

		
		$content .= '
	</table>
</table>'; 

$pdf->writeHTML($content);

$file_location = "/var/www/legends199/logix199/pdf/uploads/"; //add your full path of your server
//$file_location = "uploads/"; //for local xampp server

$datetime=date('dmY_hms');
$file_name = "INV_".$datetime.".pdf";
ob_end_clean();

$pdf->Output($file_name, 'D');
$pdf->Output('/var/www/legends199/logix199/pdf/uploads/'.$file_name, 'F');

	error_reporting(E_ALL ^ E_DEPRECATED);	

	$body='';
	$body .="<html>
	<head>
	<style type='text/css'> 
	body {
	font-family: Calibri;
	font-size:16px;
	color:#000;
	}
	</style>
	</head>
	<body>
	Dear Customer,
	<br>
	Please find attached day close report copy.
	<br>
	Thank you!
	</body>
	</html>";

	$mail = new PHPMailer(true);
	$smtp="management@logix199.com";
	$smtp_pass="Logix@199!";
	$smtp_port="465";
	$smtp_host="mail.privateemail.com";
	$user_email='haris.sultan51@gmail.com';
	$comp_name=$c_name;

	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->IsMAIL();
	$mail->IsSMTP();
	$mail->Host       = $smtp_host;                   
    $mail->SMTPAuth   = true;                       
    $mail->Username   = $smtp;           
    $mail->Password   = $smtp_pass; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465; 
    // $mail->SMTPDebug = 1; 
	$mail->Subject    = "Day Close Report ".date('Y-m-d')."";
	$mail->From = $smtp;
	$mail->FromName = $c_name;
	$mail->IsHTML(true);
	$mail->AddAddress($c_email); // To mail id
	//$mail->AddCC('info.shinerweb@gmail.com'); // Cc mail id
	//$mail->AddBCC('info.shinerweb@gmail.com'); // Bcc mail id
	
	$mail->AddAttachment($file_location.$file_name);
	$mail->MsgHTML ($body);
	$mail->WordWrap = 50;
	$mail->Send();	
	$mail->SmtpClose();
	if($mail->IsError()) {
	echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
		echo "Message sent!";					
	};

?>
