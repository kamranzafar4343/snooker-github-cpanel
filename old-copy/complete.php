<?php
include "includes/config.php";
include "includes/session.php";

// Check if we're handling multiple sale IDs
if(isset($_POST['sale_ids'])) {
    $sale_ids = json_decode($_POST['sale_ids']);
    $success = true;

    foreach($sale_ids as $sale_id) {
        // Get sale data
        $sql_main = mysqli_query($conn,"SELECT * FROM tbl_sale where sale_id='$sale_id'");
        $main_data = mysqli_fetch_assoc($sql_main);
        $gross_amount = $main_data['gross_amount'];
        $sale_type = $main_data['sale_type'];
        $amount_recieved = $main_data['gross_amount'];
        $created_date = $main_data['created_date'];
        $invoice_date = $main_data['created_date'];
        $credit_customer = $main_data['customer_name'];

        // Get user data
        $sql = mysqli_query($conn, "SELECT branch_id, created_by FROM users where user_id='$userid'");
        $data = mysqli_fetch_assoc($sql);
        $branch_id = $data['branch_id'];
        $created = $data['created_by'];
        $parent_id = $branch_id == '' ? $created : $userid;

        // Get customer data
        $sql = mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$credit_customer");
        $data = mysqli_fetch_assoc($sql);
        $customer_name = $data['username'];
        $customer_address = $data['address_current'];
        $customer_phone = $data['mobile_no1'];
        $customer_cnic = $data['client_cnic'];

        // Get sale detail
        $sql_detail = mysqli_query($conn,"SELECT * FROM tbl_sale_detail where sale_id='$sale_id'");
        $detail_data = mysqli_fetch_assoc($sql_detail);
        $ref_id = $detail_data['invoice_no'];

        // Delete existing transactions
        mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$ref_id'");
        mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$ref_id'");

        // Create narration
        $narration = "Total Amount Recieved Against ".$ref_id." is ".$amount_recieved." on Date ".$invoice_date." and Customer Name is ".$customer_name."";
        $v_type = 'CR';

        // Insert transaction
        $sql = mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status, payment_method, created_date, created_by, parent_id) 
                VALUES ('$credit_customer', '$ref_id', '$narration', '$amount_recieved', '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
        $tranid = mysqli_insert_id($conn);

        // Update sale status
        $sql = mysqli_query($conn, "Update tbl_sale set status='1', sale_status='Completed', amount_recieved='$gross_amount' where sale_id='$sale_id'");

        // Account codes
        $cash_sale = '300100100';
        $credit_sale = '300100300';
        $stock_acode = '100300000';

        // Insert transaction details
        $sql = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) 
                VALUES ('$tranid', '$ref_id', '$cash_sale','$amount_recieved', '0.00','Completed', '$narration', '$created_date', '$userid', '$parent_id')");

        $sql = mysqli_query($conn, "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) 
                VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$amount_recieved','Completed','$narration', '$created_date', '$userid', '$parent_id')");

        if(!$sql) {
            $success = false;
            break;
        }
    }

    // Return response for AJAX request
    if($success) {
        echo "success";
    } else {
        http_response_code(500);
        echo "error";
    }
} else {
    // Handle single sale_id (existing functionality)
    $sale_id = $_GET['sale_id'];
    $sql_main = mysqli_query($conn,"SELECT * FROM tbl_sale where sale_id='$sale_id'");
    $main_data = mysqli_fetch_assoc($sql_main);
    $gross_amount=$main_data['gross_amount'];
    $sale_type=$main_data['sale_type'];
    $amount_recieved=$main_data['gross_amount'];
    $created_date=$main_data['created_date'];
    $invoice_date=$main_data['created_date'];
    $credit_customer=$main_data['customer_name'];
    $sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }      
		$sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$credit_customer");
		$data=mysqli_fetch_assoc($sql);
		$customer_name=$data['username'];
        $customer_address=$data['address_current'];
        $customer_phone=$data['mobile_no1'];
        $customer_cnic=$data['client_cnic'];

    $sql_detail = mysqli_query($conn,"SELECT * FROM tbl_sale_detail where sale_id='$sale_id'");
    $detail_data = mysqli_fetch_assoc($sql_detail);
    $ref_id=$detail_data['invoice_no'];
     $sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$ref_id'");
     $sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$ref_id'");
    $narration="Total Amount Recieved Against ".$ref_id." is ".$amount_recieved." on Date ".$invoice_date." and Customer Name is ".$customer_name."";
    $v_type='CR';

    $sql=mysqli_query($conn, "INSERT INTO tbl_trans(customer_id, invoice_no, narration, total_amount, v_type, bill_status ,payment_method ,created_date, created_by, parent_id) VALUES ('$credit_customer', '$ref_id', '$narration', '$amount_recieved',  '$v_type', 'Completed', 'Cash', '$created_date', '$userid', '$parent_id')");
    $tranid = mysqli_insert_id($conn); 
    $sql=mysqli_query($conn, "Update tbl_sale set status='1', sale_status='Completed', amount_recieved='$gross_amount' where sale_id='$sale_id'");
    $cash_sale='300100100';
    $credit_sale='300100300';
    $stock_acode='100300000';

    $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$cash_sale','$amount_recieved', '0.00','Completed', '$narration', '$created_date', '$userid', '$parent_id')";
                mysqli_query($conn, $sql);

     $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status,narration, created_date, created_by,parent_id) VALUES ('$tranid', '$ref_id', '$stock_acode', '0.00', '$amount_recieved','Completed','$narration', '$created_date', '$userid', '$parent_id')";
                mysqli_query($conn, $sql);

                              
    if($sql)
    {
        header('Location: pos_sale_list.php?completed=done');
    }
}