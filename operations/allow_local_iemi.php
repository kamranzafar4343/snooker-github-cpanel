<?php
include "../includes/config.php";
include "../includes/session.php";

	$location=mysqli_real_escape_string($conn, $_POST['branch_id']);
	$purchase_req_id=mysqli_real_escape_string($conn, $_POST['purchase_req_id']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$remarks=mysqli_real_escape_string($conn, $_POST['remarks']);
	
	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
	$stock_status='Completed';
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	$created_by=$userid;

	$sql=mysqli_query($conn, "SELECT branch_id, created_by, user_name  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];
                                $user_name=$data['user_name'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }
    $remarks_from="[ ".$user_name." ] ".$remarks;

    $sql=mysqli_query($conn, "Update tbl_purchase_req set stock_status='LP Allowed', stock_receive_status='LP Allowed' WHERE purchase_req_id='$purchase_req_id'");
	  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
        	$product=explode(',', $_POST["product"][$a]);
        	$item_id=$product[0];
        	$total_items+=$_POST["qty"][$a];
 
            $sql = "INSERT INTO tbl_local_purchase (pur_req_id, branch_id, iemi, product, qty_allowed, qty_purchased,  cash_rate, inst_rate, remarks, allowed_date, user_read) VALUES ('$purchase_req_id', '$location', '$iemi', '$item_id', '" . $_POST["qty"][$a] . "', '0', '" . $_POST["cash_rate"][$a] . "',  '" . $_POST["inst_rate"][$a] . "', '$remarks_from',  '$created_date' , '0')";
            mysqli_query($conn, $sql);

            $sql=mysqli_query($conn, "UPDATE tbl_purchase_req SET item_total='$total_items', item_transfer='0'  WHERE purchase_req_id='$purchase_req_id'");
            
        }

   

	if($sql){
		header('Location: ../main_purchase_req_list.php?allow=done');
	}



?>