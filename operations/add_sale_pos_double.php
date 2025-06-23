<?php
include "../includes/config.php";
include "../includes/session.php";

$created_by = $userid;
$sale_type = 'Credit';
$location = $userid;

$credit_customer = '100200101'; // Example customer ID, assuming you want to use the same for doubling
$credit_customer_combined = $credit_customer . ',' . $credit_customer; // Concatenate the same ID twice

// Get customer details
$sql = mysqli_query($conn, "SELECT * FROM tbl_customer WHERE customer_id='$credit_customer'");
$data = mysqli_fetch_assoc($sql);
$customer_name = $data['username'];
$customer_email = '';

$sales_men = $userid;
$ref_id = mysqli_real_escape_string($conn, $_POST['ref_id']);
$table = mysqli_real_escape_string($conn, $_POST['table_id']);

$sql = mysqli_query($conn, "UPDATE tbl_tables SET table_status='1' WHERE table_id='$table'");

// Get item amount from tbl_items
$sql = mysqli_query($conn, "SELECT * FROM tbl_items WHERE item_id='1028'");
$data = mysqli_fetch_assoc($sql);
$item_price = $data['retail'];

// Double the price
$doubled_price = $item_price * 2;

$net_amount = $doubled_price;
$tax = 0;
$gross_amount = $doubled_price;
$discount = 0;
$total_amount = $doubled_price;
$amount_recieved = 0;
$iemi = '0';

// For sale
$status = '0';

$sql = mysqli_query($conn, "SELECT branch_id, created_by FROM users WHERE user_id='$userid'");
$data = mysqli_fetch_assoc($sql);
$branch_id = $data['branch_id'];
$created = $data['created_by'];

if ($branch_id == '') {
    $parent_id = $created;
} else {
    $parent_id = $userid;
}

date_default_timezone_set("Asia/Karachi");
$invoice_date = mysqli_real_escape_string($conn, $_POST['invoice_date']);
if ($invoice_date != '') {
    $created_date = $invoice_date;
} else {
    $created_date = date("Y-m-d H:i:s");
}

// Insert sale record
$sql = mysqli_query($conn, "INSERT INTO tbl_sale (location, iemi, pos, table_id, sale_type, status, sales_men, customer_name, 
    net_amount, tax, gross_amount, fixed_discount, discount, amount_recieved, remarks, created_date, created_by, parent_id) 
    VALUES ('$location', '$iemi', '1', '$table', '$sale_type', '$status', '$sales_men', '$credit_customer_combined', 
    '$net_amount', '$tax', '$gross_amount', '0', '$discount', '$amount_recieved', '', '$created_date', 
    '$created_by', '$parent_id')");

$saleid = mysqli_insert_id($conn);

// Insert into tbl_sale_temp
$item_id = 1028;
$barcode = 1;
$pur_item_id = '1001';
$sale_rate = $doubled_price;
$amount = $doubled_price;
$qty = '1';

$query1 = mysqli_query($conn, "INSERT INTO tbl_sale_temp (ref_id, customer, sales_men, item_id, barcode, pur_item_id,  
    qty, sale_rate, amount, user_id, status) VALUES ('$ref_id', '$credit_customer_combined', '$sales_men', '$item_id', '$barcode', 
    '$pur_item_id', '$qty', '$sale_rate', '$amount', '$userid', '1')");

// Insert into tbl_sale_detail
$sql = mysqli_query($conn, "INSERT INTO tbl_sale_detail (sale_id, invoice_no, product, item_serial, pur_item_id, barcode, 
    qty, rate, amount, created_date, created_by, parent_id) 
    VALUES ('$saleid', '$ref_id', '$item_id', '$item_serial', '$pur_item_id', '$barcode', '$qty', '$sale_rate', '$amount', 
    '$created_date', '$created_by', '$parent_id')");

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////

$narration = "Total Amount Recieved Against " . $ref_id . " is " . $amount_recieved . " Total Amount was " . $total_amount .
    " on Date " . $invoice_date . " and Customer Name is " . $customer_name . "";
$v_type = 'CR';

$sql = mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status 
    ,payment_method ,created_date, created_by, parent_id) 
    VALUES ('$credit_customer_combined', '$ref_id', '$narration', '$total_amount', '$v_type', 'Completed', 'Cash', 
    '$created_date', '$userid', '$parent_id')");

$tranid = mysqli_insert_id($conn);

$cash_sale = '300100100';
$credit_sale = '300100300';
$sql = mysqli_query($conn, "SELECT user_privilege, created_by FROM users WHERE user_id='$userid'");
$data = mysqli_fetch_assoc($sql);
$user_privilege = $data['user_privilege'];
$created_by = $data['created_by'];

if ($user_privilege != 'branch' && $created_by == '1') {
    $stock_acode = '100300000';
} else {
    $stock_acode = '100900000';
}

$invoice_date = mysqli_real_escape_string($conn, $_POST['created_date']);

$remaining = $total_amount - $amount_recieved;
if ($amount_recieved != 0) {
    $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, 
        created_date, created_by, parent_id) 
        VALUES ('$tranid', '$ref_id', '$credit_sale', '$total_amount', '0.00', 'Completed', '$narration', 
        '$created_date', '$userid', '$parent_id')";

    mysqli_query($conn, $sql);
}

$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, 
    created_date, created_by, parent_id) 
    VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$total_amount', 'Completed', '$narration', 
    '$created_date', '$userid', '$parent_id')";

mysqli_query($conn, $sql);

$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, 
    created_date, created_by, parent_id) 
    VALUES ('$tranid', '$ref_id', '$credit_customer', '$remaining', '0.00', 'Completed', '$narration', 
    '$created_date', '$userid', '$parent_id')";

mysqli_query($conn, $sql);

if ($sql) {
    header("Location: ../pos.php?dinein_items=1");
    exit();
}
?>
