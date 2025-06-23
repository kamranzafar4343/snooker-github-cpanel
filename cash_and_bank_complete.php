<?php
include "includes/config.php";
include "includes/session.php";

if(isset($_POST['payment'])) {

    if(empty($_POST['sale_id'])) {
        die("Sale ID is missing!");
        exit;
    }    

    $sale_id = $_POST['sale_id'];

    $cash_amount = $_POST['cash_amount'];
    $bank_amount = $_POST['bank_amount'];
   $cashPlusBankAmount = $cash_amount + $bank_amount;

    $sql_main = mysqli_query($conn, "SELECT * FROM tbl_sale WHERE sale_id='$sale_id'");
    $main_data = mysqli_fetch_assoc($sql_main);

    $created_date = $main_data['created_date'];
    $invoice_date = $main_data['created_date'];
    $sale_type = $main_data['sale_type'];

    $game_type = $main_data['game_type'];

    $gross_amount = $main_data['gross_amount'];
    $amount_recieved = $main_data['gross_amount'];

    // check
    if($cashPlusBankAmount != $gross_amount) {
        echo '<script>
         alert("Error: Cash and Bank amount does not match with original price of product!"); 
         window.location.href = "pos_sale_list.php";
         </script>';
        exit;
    }

    $credit_customer = $main_data['customer_name'];
    $sql = mysqli_query($conn, "SELECT branch_id, created_by FROM users WHERE user_id='$userid'");
    $data = mysqli_fetch_assoc($sql);
    $branch_id = $data['branch_id'];
    $created_by = $data['created_by'];

    if ($branch_id == '') {
        $parent_id = $created_by;
    } else {
        $parent_id = $userid;
    }

    $sql = mysqli_query($conn, "SELECT * FROM tbl_customer WHERE customer_id=$credit_customer");
    $data = mysqli_fetch_assoc($sql);
    $customer_name = $data['username'];
    $customer_address = $data['address_current'];
    $customer_phone = $data['mobile_no1'];
    $customer_cnic = $data['client_cnic'];

    $sql_detail = mysqli_query($conn, "SELECT * FROM tbl_sale_detail WHERE sale_id='$sale_id'");
    $detail_data = mysqli_fetch_assoc($sql_detail);
    $ref_id = $detail_data['invoice_no'];

    $narration = "Total Amount Recieved Against " . $ref_id . " is " . $amount_recieved . " on Date " . $invoice_date . " and Customer Name is " . $customer_name . "";
    $v_type = 'CR';

    //completed at timestamp
    $completed_at = date("Y-m-d H:i:s"); // format: 2025-04-15 16:25:00

    // update into tbl_trans
    $sql = mysqli_query($conn, "Update tbl_trans SET narration = '$narration'  , created_by = '$userid' WHERE invoice_no = '$ref_id'");

    //fetch trans_id to insert in tbl_trans_detail
    $sql_trans_id = mysqli_query($conn, "SELECT trans_id FROM tbl_trans where invoice_no='$ref_id'");
    $sql_trans_id_result = mysqli_fetch_assoc($sql_trans_id);
    $tranid = $sql_trans_id_result['trans_id'];

    // Update tbl_sale
    $sql_sale = mysqli_query($conn, "UPDATE tbl_sale SET status='1', sale_type = 'Cash and Bank - split',  sale_status = 'Completed', net_amount = '$gross_amount', gross_amount= '$gross_amount', amount_recieved='$gross_amount', completed_at = '$completed_at' , created_by = '$userid', payment_type = 'bank' WHERE sale_id='$sale_id'");

    if (!$sql_sale) {
        die("Error: " . mysqli_error($conn));
    }

    $cash_sale = '300100000';
    $credit_sale = '300500000';
    $stock_acode = '100300000';
    $cost_of_goods_sold = '300300000';
    $cash_in_hand = '100100000';

    $sql_check = mysqli_query($conn, "SELECT * FROM tbl_trans_detail where invoice_no = '$ref_id'");
    $count_data = mysqli_num_rows($sql_check);
    if ($count_data < 8) {

        if($cash_amount > 0) {
        //Cash part
        $sql1 = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, payment_type,
        bill_status, narration, created_date, created_by, parent_id, numbering) 

        VALUES ('$tranid', '$ref_id', '$cash_in_hand',  '$cash_amount', '0.00', 'cash','Completed',
        '$narration', '$completed_at', '$userid', '$parent_id' , 'debit cash in hand - split')");

        
        $sql2 = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, payment_type,
         bill_status, narration, created_date, created_by, parent_id, numbering) 

         VALUES ('$tranid', '$ref_id', '$credit_customer', '0.00', '$cash_amount', 'cash','Completed', 
         '$narration', '$completed_at', '$userid', '$parent_id' , 'credit customer - split')");

//then update there invoices also
$sql5 = mysqli_query($conn, "Update tbl_trans_detail SET narration = '$narration' WHERE invoice_no = '$ref_id'");
        }

        if($bank_amount > 0) {
            // Insert
        //Bank part
        $sql3 = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, payment_type,
       bill_status, narration, created_date, created_by, parent_id, numbering) 
       
               VALUES ('$tranid', '$ref_id', '$cash_in_hand',  '$bank_amount', '0.00', 'bank','Completed',
               '$narration', '$completed_at', '$userid', '$parent_id' , 'debit cash in hand - split')");

        $sql4 = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, payment_type,
        bill_status, narration, created_date, created_by, parent_id, numbering) 

                VALUES ('$tranid', '$ref_id', '$credit_customer', '0.00', '$bank_amount', 'bank','Completed', 
                '$narration', '$completed_at', '$userid', '$parent_id' , 'credit customer - split')");


        //then update there invoices also
        $sql5 = mysqli_query($conn, "Update tbl_trans_detail SET narration = '$narration' WHERE invoice_no = '$ref_id'");
        }
    } else {
        header('Location: pos_sale_list.php');
        exit();
    }

    // Redirect to pos_sale_list.php after successful insert
    if ($sql1 && $sql2 && $sql3 && $sql4 && $sql5) {
        header('Location: pos_sale_list.php?completed=done');
    }
}