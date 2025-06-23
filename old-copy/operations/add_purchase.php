<?php
include "../includes/config.php";
include "../includes/session.php";






	$edit_id=mysqli_real_escape_string($conn, $_POST['edit_id']);
	$vendor=mysqli_real_escape_string($conn, $_POST['vendor']);
	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$gross_amount=mysqli_real_escape_string($conn, $_POST['gross_amount']);
	$discount=mysqli_real_escape_string($conn, $_POST['discount']);

	$location=mysqli_real_escape_string($conn, $_POST['location']);
	$invoice_no=mysqli_real_escape_string($conn, $_POST['invoice_no']);
	$invoice_date=mysqli_real_escape_string($conn, $_POST['invoice_date']);
	$po_remarks=mysqli_real_escape_string($conn, $_POST['po_remarks']);
	$iemi=mysqli_real_escape_string($conn, $_POST['iemi']);
	$bill_status='Pending';
	
	$created_by=$userid;

	 //   $sql1 = mysqli_query($conn,"SELECT product from tbl_purchase_detail Where purchase_id='$edit_id'");
	 //   while($data = mysqli_fetch_assoc($sql1))
	 //   {

	 //   	$product=$data['product'];

	 //   	$sql2 = mysqli_query($conn,"SELECT item_serial from tbl_sale_detail Where product='$product'");
		// $sql3 = mysqli_query($conn,"SELECT item_serial from tbl_installment Where item_id='$product'");
		// $sql4 = mysqli_query($conn,"SELECT item_serial from tbl_purchase_req_detail Where product='$product'");
	
		// 	if (mysqli_num_rows($sql2)!=0 || mysqli_num_rows($sql3)!=0  || mysqli_num_rows($sql4)!=0) {
				
		// 		header('Location: ../purchase_list.php?edit=unsuccessful');
		// 		exit;
		// 	}
	 //  }

$sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created_by=$data['created_by'];
                                if($branch_id=='')
                                {
                                  $parent_id=$created_by;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }

if($edit_id!='')
{
	 	$sql=mysqli_query($conn, "UPDATE tbl_purchase SET  location='$location', vendor_id='$vendor', invoice_no='$invoice_no', invoice_date='$invoice_date', po_remarks='$po_remarks', net_amount='$net_amount', gross_amount='$gross_amount', amount_payed='', amount_remaining='', bill_status='Pending', payment_status='Pending', discount='$discount', created_by='$userid',parent_id='$parent_id' where purchase_id='$edit_id'");

	 	$invoice_no="Purchase"."_".$edit_id;
  	
  	$sql=mysqli_query($conn, "DELETE FROM tbl_purchase_detail WHERE purchase_id = $edit_id");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans WHERE invoice_no = '$invoice_no'");
	$sql=mysqli_query($conn, "DELETE FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");

     for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
            $sql = "INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, barcode, qty, qty_rec, rate, sale_rate, amount , created_by, parent_id, iemi) VALUES ('$edit_id', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["barcode"][$a] . "', '" . $_POST["qty"][$a] . "', '0',  '" . $_POST["rate"][$a] . "',  '" . $_POST["sale_rate"][$a] . "', '" . $_POST["amount"][$a] . "',  '$userid', '$parent_id', '$iemi')";

            mysqli_query($conn, $sql);
        }        

  
	if($sql){
		header('Location: ../purchase_list.php?updated=done');
	}
	 
}
//////////////////////////////////////////////
else
{

	$net_amount=mysqli_real_escape_string($conn, $_POST['net_amount']);
	$vendor=mysqli_real_escape_string($conn, $_POST['vendor']);
	$bill_status='Pending';

 	$sql=mysqli_query($conn, "INSERT INTO tbl_purchase(location, iemi, vendor_id, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount,bill_status,payment_status,  created_by, parent_id) VALUES ('$location', '$iemi', '$vendor', '$invoice_no', '$invoice_date', '$po_remarks', '$net_amount', '$gross_amount', '$discount','$bill_status','Pending', '$userid', '$parent_id')");

 	$purchaseid = mysqli_insert_id($conn); 
	$invoice_no="Purchase"."_".$purchaseid;

	  for ($a = 0; $a < count($_POST["qty"]); $a++)
        {
			$sql = "INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, barcode, qty, rate, sale_rate, amount , created_by, parent_id, iemi) VALUES ('$purchaseid', '$invoice_no','" . $_POST["product"][$a] . "', '" . $_POST["barcode"][$a] . "', '" . $_POST["qty"][$a] . "',  '" . $_POST["rate"][$a] . "',  '" . $_POST["sale_rate"][$a] . "', '" . $_POST["amount"][$a] . "',  '$userid', '$parent_id', '$iemi')";



            mysqli_query($conn, $sql);
        }

   

	if($sql){
		header('Location: ../purchase_list.php?added=done');
	}

}

?>