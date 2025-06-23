<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['po']);
	$edit=mysqli_real_escape_string($conn, $_POST['edit']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$item_total=mysqli_real_escape_string($conn, $_POST['item_total']);
	$item_recieved=mysqli_real_escape_string($conn, $_POST['item_recieved']);
	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
	$branch_stock='100900000';
	$ho_stock='100300000';
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
$query=mysqli_query($conn, "SELECT item_recieved,net_amount  FROM tbl_purchase_req where purchase_req_id='$edit_id'");
                                $data = mysqli_fetch_assoc($query);
                                $item_recieved_last=$data['item_recieved'];
                                $net_amount_last=$data['net_amount'];
                                if($item_recieved_last!='0')
																	{
                                		$item_recieved=$item_recieved+$item_recieved_last;
                                		$net_amount=$net_amount+$net_amount_last;
                              		}
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	$created_by=$userid;

if($edit_id!='')
{

	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase_req  SET  gross_amount='$net_amount', net_amount='$net_amount', item_recieved='$item_recieved', stock_receive_status='Completed', stock_rec_date='$created_date' where purchase_req_id='$edit_id'");

		


		$tranid = $edit_id; 
		
		if($edit=='')
		{
			$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id = $edit_id and qty_rec!='' and recieved='0'");
		}
		else
		{
			$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_req_detail WHERE purchase_req_id = $edit_id and qty_rec!=''");
		}


		  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
    				
            $sql = "INSERT INTO tbl_purchase_req_detail (purchase_req_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, cash_rate, inst_rate, created_date, created_by, parent_id,trans_id,trans_parent_id,iemi, recieved) VALUES ('$tranid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["item_serial"][$a] . "', '" . $_POST["pur_item_id"][$a] . "', '" . $_POST["barcode"][$a] . "', '" . $_POST["qty_rec"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["cash_rate"][$a] . "',  '" . $_POST["inst_rate"][$a] . "', '$created_date', '$created_by', '$parent_id','" . $_POST["trans_id"][$a] . "','" . $_POST["trans_parent_id"][$a] . "', '$iemi', '1')";
            mysqli_query($conn, $sql);
            	
              
                  
                                	
        }



    
////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////      


// 	$narration=" Invoice # ".$invoice_no." Transfer Date was ".$invoice_date." Stock Qty Recieved on ".$created_date." was ".$item_recieved." and Total Qty was ".$item_total."";
// 	$v_type='ST';


// 	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(account_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by, parent_id) VALUES ('$branch_stock', '$invoice_no', '$narration', '$net_amount',  '$v_type', '', '$created_date', '$created_by', '$parent_id')");


// $tran_id = mysqli_insert_id($conn); 

// $stock_acode='100300000';

// $narration1 ="Invoice # ".$invoice_no." Net Amount was ".$net_amount." Requested Date was ".$invoice_date." Branch Stock Transfered on ".$created_date."";
// $narration2 ="Invoice # ".$invoice_no." Net Amount was ".$net_amount." Requested Date was ".$invoice_date." HO Stock Effected on ".$created_date."";
// $bill_status='Transfered';

//             $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$branch_stock','$net_amount', '0.00','$bill_status', '$narration1', '$created_date', '$created_by', '$parent_id')";
//             mysqli_query($conn, $sql);

//             $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode', '0.00', '$net_amount', '$bill_status', '$narration2', '$created_date', '$created_by', '$parent_id')";
//             mysqli_query($conn, $sql);
            

  
	if($sql){
		header('Location: ../branch_stock_in_list.php?stock=done');
	}
	 
}
    

?>