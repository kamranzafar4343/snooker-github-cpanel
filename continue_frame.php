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
$sql2 = mysqli_query($conn, "SELECT customer_name, fixed_discount, table_id, total_tax FROM tbl_sale WHERE sale_id = $sale_id");
$data = mysqli_fetch_assoc($sql2);
$customer_name_old = $data['customer_name'];
$fixed_discount = $data['fixed_discount'];
$table = $data['table_id'];

// $discount = $data['discount'];
$total_disc = ($fixed_discount) ?? 0;

$total_tax = $data['total_tax'] ?? 0;

//////////////////////////////////update items of customer on the base of customer type/////////////////////////////////////////////////////////////

//fetch type of the customer
$sql4 = mysqli_query($conn, "SELECT customer_type FROM tbl_customer WHERE customer_id = '$customer_name'");
$data = mysqli_fetch_assoc($sql4);
$customer_type = $data['customer_type'];

//fetch item details from tbl_sale_detail
$sql3 = mysqli_query($conn, "SELECT qty, product FROM tbl_sale_detail WHERE sale_id = $sale_id");

while ($row = mysqli_fetch_assoc($sql3)) {
    $item_id = $row['product'];
    $qty = $row['qty'];

    // fetch different item prices
    $sql5 = mysqli_query($conn, "SELECT * FROM tbl_items WHERE item_id = $item_id");
    $sql5_result = mysqli_fetch_assoc($sql5);
    $purchase = $sql5_result['purchase'] ?? 0;
    $retail = $sql5_result['retail'];
    $mini_wholesale = $sql5_result['mini_wholesale'];
    $wholesale = $sql5_result['wholesale'];
    $type_a = $sql5_result['type_a'];
    $type_b = $sql5_result['type_b'];
    $type_c = $sql5_result['type_c'];

    //Assuming prices according to customer type
    // 0 is retail, 1 is retail, 2 is mini_wholesale, 3 is wholesale, 4 is type_a, 5 is type_b, 6 is type_c(tbl_client_type)
    if ($customer_type == 0) {
        $rate = $retail;
        $total_price = $retail * $qty;
    }
    if ($customer_type == 1) {
        $rate = $retail;
        $total_price = $retail * $qty;
    } elseif ($customer_type == 2) {
        $rate = $mini_wholesale;
        $total_price = $mini_wholesale * $qty;

        //in a case where mini_wholesale is 0, fallback to retail price
        if ($mini_wholesale == 0) {
            $rate = $retail;
            $total_price = $retail * $qty;
        }
    } elseif ($customer_type == 3) {
        $rate = $wholesale;
        $total_price = $wholesale * $qty;

        //in a case where wholesale is 0, fallback to retail price
        if ($wholesale == 0) {
            $rate = $retail;
            $total_price = $retail * $qty;
        }
    } elseif ($customer_type == 4) {
        $rate = $type_a;
        $total_price = $type_a * $qty;

        //fallback to retail price
        if ($type_a == 0) {
            $rate = $retail;
            $total_price = $retail * $qty;
        }
    } elseif ($customer_type == 5) {
        $rate = $type_b;
        $total_price = $type_b * $qty;

        // fallback to retail price
        if ($type_b == 0) {
            $rate = $retail;
            $total_price = $retail * $qty;
        }
    } elseif ($customer_type == 6) {
        $rate = $type_c;
        $total_price = $type_c * $qty;

        // fallback to retail price
        if ($type_c == 0) {
            $rate = $retail;
            $total_price = $retail * $qty;
        }
    }

    //declare var's
    $total_amount = 0;
    $total_purchase = 0;


    // update tbl_sale_detail
    mysqli_query($conn, "UPDATE tbl_sale_detail SET rate = '$rate', amount = '$total_price' , created_by = '$userid' WHERE sale_id = '$sale_id' AND product = '$item_id'");

    //calculate purchase price of the item
    $purchase_price = $purchase * $qty;

    //calulate total purchase of all items
    $total_purchase += $purchase_price;
}

// now fetch from tbl_sale_detail to get the total amount of sale
$sql6 = mysqli_query($conn, "SELECT SUM(amount) as total_amount FROM tbl_sale_detail WHERE sale_id = $sale_id");
$data = mysqli_fetch_assoc($sql6);
$total_amount = $data['total_amount'] ?? 0;

// update sale tbl
mysqli_query($conn, "UPDATE tbl_sale SET customer_name = '$customer_name',net_amount= '$total_amount', gross_amount='$total_amount', update_status = '1'  , created_by = '$userid' WHERE sale_id = $sale_id");

// update tbl_sale_temp
mysqli_query($conn, "UPDATE tbl_sale_temp SET customer = '$customer_name'  , created_by = '$userid' WHERE ref_id = '$invoice_no'");


// Delete existing transactions
mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$ref_id'");
mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$ref_id'");


// Create narration
$narration = "Total Amount Recieved Against " . $ref_id . " is" . "$total_amount" . " on Date " . $created_date . " and Customer Name is " . $customer_name . "";
$v_type = 'CR';

//fetch date from tbl_trans
$sql66 = mysqli_query($conn, "SELECT created_date FROM tbl_sale WHERE sale_id = '$sale_id'");
$data66 = mysqli_fetch_assoc($sql66);
$created_date = $data66['created_date'] ?? date('Y-m-d H:i:s');


// Insert transaction
$sql = mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status, payment_method, created_date, created_by, parent_id) 
    VALUES ('$customer_name', '$ref_id', '$narration', '$total_amount', '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
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
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$customer_name', '$total_amount',
  '0.00',  'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'debit cust')";
mysqli_query($conn, $sql);

//credit sale
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$credit_sale', '0.00', '$total_amount',
 'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit sale')";
mysqli_query($conn, $sql);

//debit cog's
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by, parent_id, numbering) VALUES ('$tranid', '$ref_id', '$cost_of_goods_sold','$purchase_price', '0.00',
 'Completed', '$narration', '$created_date', '$userid', '$parent_id', 'debit cog')";
mysqli_query($conn, $sql);

//credit stock
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
 created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$purchase_price',
 'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit stock')";
mysqli_query($conn, $sql);


//debit discount give
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
    created_date, created_by, parent_id, numbering) VALUES ('$tranid', '$ref_id', '$discount_given', '0', '$total_disc',
    'Completed', '$narration', '$created_date', '$userid', '$parent_id', 'debit disc')";
mysqli_query($conn, $sql);

//credit tax payable
$sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, 
    created_date, created_by,parent_id, numbering) VALUES ('$tranid', '$ref_id', '$tax_payable', '$total_tax', '0',
    'Completed','$narration', '$created_date', '$userid', '$parent_id' , 'credit tax')";
mysqli_query($conn, $sql);

if($sql){
    $created_by = $userid;
$sale_type = 'Credit';

$location = $userid;

$credit_customer = '100200101';

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

do {
    $ref_id = 'S' . rand(1000000000, 9999999999);
    $dup_invoice_check = mysqli_query($conn, "SELECT 1 FROM tbl_sale_detail WHERE invoice_no='$ref_id' LIMIT 1");
} while (mysqli_num_rows($dup_invoice_check) > 0);


//get item amount from tbl_items for frame item
$sql = mysqli_query($conn, "SELECT * FROM tbl_items where item_id='1028'");
$data = mysqli_fetch_assoc($sql);
$item_price = $data['retail'];


$net_amount = $item_price;
$tax = 0;
$gross_amount = $item_price;
$discount = 0;
$total_amount = $item_price;
$amount_recieved = 0;

$total_discount = (float)$discount;

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
    '$created_by', '$parent_id', 'frame')");

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

$invoice_date = mysqli_real_escape_string($conn, $_POST['created_date']);


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

}
?>
