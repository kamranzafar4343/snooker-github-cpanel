<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['po']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);
	$item_total=mysqli_real_escape_string($conn, $_POST['item_total']);
	$item_recieved=mysqli_real_escape_string($conn, $_POST['item_recieved']);
  	$gross_amount=mysqli_real_escape_string($conn, $_POST['gross_amount']);
  	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
  	$custom_narration=mysqli_real_escape_string($conn, $_POST['narration']);
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

	if($iemi=='1')
	{
		$PO='PO (IEMI)';
	}
	else
	{
		$PO='PO';
	}
	date_default_timezone_set("Asia/Karachi");
	$created_date=date("Y-m-d h:i:s");
	
	$created_by=$userid;


if($edit_id!='')
{
	 	$sql=mysqli_query($conn, "UPDATE tbl_single_purchase  SET   narration='$custom_narration', net_amount='$net_amount',gross_amount='$gross_amount', item_total='$item_total', item_recieved='$item_recieved', bill_status='Completed', grn_date='$created_date', created_by='$created_by' where purchase_id='$edit_id'");



		$tranid = $edit_id; 
		$invoice_no="Local_Purchase"."_".$edit_id;
	
		$sql=mysqli_query($conn, "DELETE FROM tbl_single_purchase_detail WHERE purchase_id = $edit_id");
	
		$pur_item_id_start='8000';
		$sql=mysqli_query($conn, "SELECT pur_item_id FROM tbl_single_purchase_detail  ORDER BY pur_item_id DESC");
        $data = mysqli_fetch_assoc($sql);
      	$pur_item_id=$data['pur_item_id'];            
		if($pur_item_id>0)
		{
			++$pur_item_id;  
		}
		else
		{
			
			$pur_item_id=$pur_item_id_start;
		}
		  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
    		$pur_item_id++;
    		
            $sql = "INSERT INTO tbl_single_purchase_detail (purchase_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, rate, amount, created_date, created_by, parent_id, iemi) VALUES ('$tranid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["item_serial"][$a] . "', '$pur_item_id','" . $_POST["barcode"][$a] . "', '" . $_POST["qty_rec"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["amount"][$a] . "', '$created_date', '$created_by','$parent_id', '$iemi')";
            mysqli_query($conn, $sql);
        }

 $total = count($_FILES['grn_document']['name']);


for( $i=0 ; $i < $total ; $i++ ) {

  $tmpFilePath = $_FILES['grn_document']['tmp_name'][$i];

  if ($tmpFilePath != ""){
    $newFilePath = "../uploads/Documents/Grn_documents/" . $_FILES['grn_document']['name'][$i];
       $imageFileType = pathinfo($newFilePath,PATHINFO_EXTENSION);

    if($imageFileType != "doc" && $imageFileType != "docx" && $imageFileType != "pdf" ) 
            {

                 header('Location: ../add_local_grn.php?documents=done');
                 exit();
                
            }

    if ($newFilePath > 25000000)
            {
                header('Location: ../add_local_grn.php?large=done');
                exit();
            }
              
    else{
    if(move_uploaded_file($tmpFilePath, $newFilePath)) {

      $sql=mysqli_query($conn, "INSERT INTO tbl_grn_documents (po_id, documents) VALUES ('$edit_id', '$newFilePath')"); 

    }
  }
  }
}     
////////////////////////////////////////////////////////////////// Accounts //////////////////////////////////////////////////////////////      
if($bill_status='Completed')
{
	$narration="Local Purchase ".$PO." # ".$tranid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date."  Complete Stock Received on ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";
	$v_type='SR';
}	
else
{
	$narration="Local Purchase ".$PO." # ".$tranid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date." Stock Qty Received on ".$created_date." was ".$item_recieved." and Total Qty was ".$item_total." (CUSTOM NARRATION =". $custom_narration.")";
	$v_type='SP';
}


$vendor_id=mysqli_real_escape_string($conn, $_POST['vendor']);

	$sql=mysqli_query($conn, "INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, v_type, bill_status ,created_date, created_by,parent_id) VALUES ('$vendor_id', '$invoice_no', '$narration', '$net_amount',  '$v_type', '$bill_status', '$created_date', '$userid','$parent_id')");


$tran_id = mysqli_insert_id($conn); 

$stock_acode='100300000';

$narration1 ="Local Purchase ".$PO." # ".$tranid." Net Amount was ".$net_amount." Transaction Date was ".$invoice_date."  Complete Stock Received on ".$created_date." (CUSTOM NARRATION =". $custom_narration.")";
$narration2 =" Payment Pending to Vendor against ".$PO." # ".$tranid." is ".$net_amount." Transaction Date was ".$invoice_date." (CUSTOM NARRATION =". $custom_narration.")";

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$stock_acode','$net_amount', '0.00','$bill_status', '$narration1', '$created_date', '$userid','$parent_id')";
            mysqli_query($conn, $sql);

            $sql = "INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by,parent_id) VALUES ('$tran_id', '$invoice_no', '$vendor_id', '0.00', '$net_amount', '$bill_status', '$narration2', '$created_date', '$userid','$parent_id')";
            mysqli_query($conn, $sql);
            

  
	if($sql){
		header('Location: ../single_purchase.php?updated=done');
	}
	 
}
    

?>