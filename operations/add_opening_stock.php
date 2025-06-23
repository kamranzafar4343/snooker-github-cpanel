<?php
include "../includes/session.php";
include "../includes/config.php";
$item_id = mysqli_real_escape_string($conn, $_POST['product']);
$sale_rate = mysqli_real_escape_string($conn, $_POST['sale_rate']);
$rate = mysqli_real_escape_string($conn, $_POST['purchase_rate']);
$barcode = mysqli_real_escape_string($conn, $_POST['barcode']);
$qty = mysqli_real_escape_string($conn, $_POST['opening_qty']);
$amount=$rate*$qty;
date_default_timezone_set("Asia/Karachi");
$created_date=date("Y-m-d h:i:s");
$narration="Opening Stock(".$qty.") of item barcode ".$barcode." added, Transaction Date was ".$created_date."";
$v_type='SP';
$invoice_no='Opening_stock#'.$item_id;
$stock_acode='100300100';
$net_amount=$rate*$qty;
			
                $sql=mysqli_query($conn, "INSERT INTO tbl_purchase(location, iemi, vendor_id, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount,bill_status,payment_status,  created_by, parent_id) VALUES ('1', '0', '$stock_acode', '$invoice_no', '$created_date', '', '$net_amount', '$net_amount', '0','Completed','Completed', '1', '1')");

				$sql=mysqli_query($conn, "INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, rate, sale_rate, amount, created_date, created_by, parent_id, iemi) VALUES ('1', '$invoice_no','$item_id', '', '1001','$barcode', '$qty', '$qty', '$rate', '$sale_rate', '$amount', '$created_date', '1','1', '0')");

 				$sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by,parent_id) VALUES ('$stock_acode', '$invoice_no', '$narration', '$net_amount',  '$v_type', 'Completed', '$created_date', '1','1')");
                $tran_id = mysqli_insert_id($conn); 

                $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode','$net_amount', '0.00','Completed', '$narration', '$created_date', '1','1')";
                    mysqli_query($conn, $sql);

                $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode', '0.00', '$net_amount', 'Completed', '$narration', '$created_date', '1','1')";
                    mysqli_query($conn, $sql);
if($sql){
		header('Location: ../item_price.php?updated=done');
	}
	else
	{
		header('Location: ../item_price.php?updated=fail');
	}
?>