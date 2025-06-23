<?php
include "includes/config.php";
include "includes/session.php";

// Get POST data
$sale_id = mysqli_real_escape_string($conn, $_POST['sale_id']);
$customer_name = mysqli_real_escape_string($conn, $_POST['customer_name']);

// Fetch the invoice number from tbl_sale
$sql1 = mysqli_query($conn, "SELECT invoice_no FROM tbl_sale_detail WHERE sale_id = $sale_id");
$data = mysqli_fetch_assoc($sql1);
$invoice_no = $data['invoice_no'];
$ref_id = $invoice_no;

// Fetch the old customer name
$sql2 = mysqli_query($conn, "SELECT * FROM tbl_sale WHERE sale_id = $sale_id");
$data = mysqli_fetch_assoc($sql2);
$customer_name_old = $data['customer_name'];
$created_date = $data['created_date'];
$discount = $data['discount'];
$fixed_discount = $data['fixed_discount'];

$tax = $data['tax'];

// Get user data
$sql = mysqli_query($conn, "SELECT branch_id, created_by FROM users where user_id='$userid'");
$data = mysqli_fetch_assoc($sql);
$branch_id = $data['branch_id'];
$created = $data['created_by'];
$parent_id = $branch_id == '' ? $created : $userid;

// Convert time passed in minutes
$created_dt = new DateTime($created_date); // Assuming $created_date is in 'Y-m-d H:i:s' format
$now = new DateTime();


// Calculate the difference between now and the created date
$interval = $created_dt->diff($now);

// Get the difference in minutes, accounting for hours and days
$minutesPassed = ($interval->days * 24 * 60) + ($interval->h * 60) + $interval->i;

// Multiply minutes with century price per minute
$century_price = 12;

$price = round($minutesPassed * $century_price, 2);

$gross_amount = $price;

$sale_rate_temp = 12;

// new query to update customer name and amounts
// tbl_sale
mysqli_query($conn, "UPDATE tbl_sale SET customer_name = '$customer_name', update_status = '1', net_amount = '$gross_amount', gross_amount= '$gross_amount' , created_by = '$userid' WHERE sale_id='$sale_id'");
mysqli_query($conn, "UPDATE tbl_sale_detail SET amount = '$gross_amount', rate = '$sale_rate_temp', created_by = '$userid'  WHERE invoice_no = '$invoice_no'");
mysqli_query($conn, "UPDATE tbl_sale_temp SET customer = '$customer_name',sale_rate = '$sale_rate_temp', amount = '$gross_amount' , created_by = '$userid' WHERE ref_id = '$invoice_no'");


// Delete existing transactions
mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$ref_id'");
mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$ref_id'");

// Create narration
$narration = "Total Amount Recieved Against " . $ref_id . " is" . "0" . " on Date " . $invoice_date . " and Customer Name is " . $customer_name . "";
$v_type = 'CR';

// Insert transaction
$sql = mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status, payment_method, created_date, created_by, parent_id) 
VALUES ('$credit_customer', '$ref_id', '$narration', '$gross_amount', '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
$tranid = mysqli_insert_id($conn);


// Account codes
$cash_sale = '300100000';
$credit_sale = '300500000';
$stock_acode = '100300000';
$cost_of_goods_sold = '300300000';
$cash_in_hand = '100100000';
$discount_given = '500900000';
$tax_payable = '200400000';

//we are making the entries in sale_type = 'credit'
//////////////////////tbl_transaction/////////////////////////////
//debit customer
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$customer_name', '$gross_amount',
  '0.00',  'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'debit cust')";
mysqli_query($conn, $sql);

//credit sale
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$credit_sale', '0.00', '$gross_amount',
 'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit sale')";
mysqli_query($conn, $sql);

//debit cog's
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by, parent_id, numbering) VALUES ('$tranid', '$ref_id', '$cost_of_goods_sold','0', '0.00',
 'Completed', '$narration', '$created_date', '$userid', '$parent_id', 'debit cog')";
mysqli_query($conn, $sql);

//credit stock
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '0',
 'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit stock')";
mysqli_query($conn, $sql);


//debit discount give
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
created_date, created_by, parent_id, numbering) VALUES ('$tranid', '$ref_id', '$discount_given', '0', '0.00',
'Completed', '$narration', '$created_date', '$userid', '$parent_id', 'debit cog')";
mysqli_query($conn, $sql);

//credit tax payable
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$tax_payable', '0.00', '0',
'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit stock')";
mysqli_query($conn, $sql);


echo "Customer updated successfully!";
