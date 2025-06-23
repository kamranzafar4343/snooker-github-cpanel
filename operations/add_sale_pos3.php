<?php
include "../includes/config.php";
include "../includes/session.php";

$ref_id = mysqli_real_escape_string($conn, $_POST['ref_id']);
$table = mysqli_real_escape_string($conn, $_POST['table_id']);
$userid = mysqli_real_escape_string($conn, $_POST['userid']);

$created_by = $userid;
$sale_type = 'Credit';

$location = $userid;

$credit_customer = '100200101';   //customer id from db

$sql = mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$credit_customer");
$data = mysqli_fetch_assoc($sql);
$customer_name = $data['username'];
$customer_address = $data['address_current'];
$customer_phone = $data['mobile_no1'];
$customer_cnic = $data['client_cnic'];

$customer_email = '';

$sales_men = $userid;



$sql = mysqli_query($conn, "UPDATE tbl_tables SET table_status='1' where table_id='$table'");

// check if ref # is already used
$dup_invoice_check = mysqli_query($conn, "SELECT 1 FROM tbl_sale_detail WHERE invoice_no='$ref_id' LIMIT 1");
if (mysqli_num_rows($dup_invoice_check) > 0) {

    //we will make a new ref # and we assign to will use that ref #
    $new_ref_id = 'S' . rand(1000000000, 9999999999);

    //assign new ref # to the sale
    $ref_id = $new_ref_id;
}
//get item amount from tbl_items for frame item
$sql = mysqli_query($conn, "SELECT * FROM tbl_items where item_id='1028'");
$data = mysqli_fetch_assoc($sql);
$item_price = $data['retail'];

$net_amount = 0;
$tax = 0;
$gross_amount = 0;
$discount = 0;
$total_amount = 0;
$amount_recieved = 0;



$iemi = '0';

//for sale
$status = '0';

$sql = mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
$data = mysqli_fetch_assoc($sql);
$branch_id = $data['branch_id'];
$created = $data['created_by'];
if ($branch_id == '') {
    $parent_id = $created;
} else {
    $parent_id = $userid;
}
date_default_timezone_set("Asia/Karachi");

$invoice_date = date('Y-m-d H:i:s');
$created_date = date('Y-m-d H:i:s');


if ($invoice_date != '') {
    $created_date = $invoice_date;
} else {
    $created_date;
}



$sql = mysqli_query($conn, "INSERT INTO tbl_sale(location ,iemi, pos, table_id, sale_type, status, sales_men, customer_name, 
    customer_address, customer_phone, customer_cnic, customer_email, net_amount, tax, gross_amount, fixed_discount, discount, 
    amount_recieved, remarks,  created_date, created_by, parent_id, game_type) VALUES ('$location','$iemi', '1', '$table', '$sale_type', 
    '$status', '$sales_men', '$credit_customer', '$customer_address', '$customer_phone', '$customer_cnic', '$customer_email', 
    '$net_amount', '$tax', '$gross_amount', '0', '$discount', '$amount_recieved', '', '$created_date', 
    '$created_by', '$parent_id', 'century')");

$saleid = mysqli_insert_id($conn);

$item_id = 1028;
$barcode = 1;

$pur_item_id = '1001';

$sale_rate = $item_price;
$amount = $item_price;
$qty = '1';

$query1 = mysqli_query($conn, "INSERT INTO tbl_sale_temp (ref_id, customer, sales_men, item_id, barcode,  pur_item_id,  
        qty, sale_rate, amount, user_id, status) VALUES ('$ref_id', '$credit_customer', '$sales_men', '$item_id', '$barcode', 
        '$pur_item_id', '$qty',  '$sale_rate',  '$amount', '$userid', '1')");

$sql = mysqli_query($conn, "INSERT INTO tbl_sale_detail (sale_id, invoice_no, product, item_serial, pur_item_id, barcode, 
        qty, rate, amount, created_date, created_by, parent_id) VALUES ('$saleid', '$ref_id', '$item_id', '$item_serial', 
        '$pur_item_id','$barcode', '$qty',  '$sale_rate',  '$amount', '$created_date', '$created_by', '$parent_id')");

////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////

$narration = "Total Amount Recieved Against " . $ref_id . " is " . $amount_recieved . " Total Amount was " . $total_amount .
    " on Date " . $invoice_date . " and Customer Name is " . $customer_name . "";
$v_type = 'CR';


$sql = mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status 
    ,payment_method ,created_date, created_by,parent_id) VALUES ('$credit_customer', '$ref_id', '$narration', '$total_amount',
    '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");

$tranid = mysqli_insert_id($conn);


$cash_sale = '300100000';
$credit_sale = '300500000';
$stock_acode = '100300000';
$cost_of_goods_sold = '300300000';
$cash_in_hand = '100100000';
$discount_given = '500900000';
$tax_payable = '200400000';

$sql = mysqli_query($conn, "SELECT user_privilege, created_by FROM users where user_id='$userid'");
$data = mysqli_fetch_assoc($sql);
$user_privilege = $data['user_privilege'];
$created_by = $data['created_by'];
if ($user_privilege != 'branch' && $created_by == '1') {
    $stock_acode = '100300000';
} else {
    $stock_acode = '100900000';
}

// $invoice_date = date("Y-m-d H:i:s");


$remaining = $total_amount - $amount_recieved;
if ($amount_recieved != 0) {

    $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
            created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$credit_sale','$total_amount', '0.00','Completed',
             '$narration', '$created_date', '$userid', '$parent_id')";

    mysqli_query($conn, $sql);
}


//debit customer
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
            created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$credit_customer', '$remaining',
             '0.00',  'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'debit cust')";
mysqli_query($conn, $sql);

//credit sale
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
            created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$credit_sale', '0.00', '$total_amount',
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
 created_date, created_by, parent_id, numbering) VALUES ('$tranid', '$ref_id', '$discount_given','$discount', '0.00',
 'Completed', '$narration', '$created_date', '$userid', '$parent_id', 'debit disc')";
mysqli_query($conn, $sql);

//credit tax payable
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$tax_payable', '0.00', '0',
 'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit tax pay')";
mysqli_query($conn, $sql);

if ($sql) {
    header("Location:../sale_pos_kod2.php?sale_id=$saleid");
    exit();
}
