<?php
include "../includes/config.php";
include "../includes/session.php";

if (isset($_GET['c_id'])) {
	$customer_id=mysqli_real_escape_string($conn, $_GET['c_id']);
	
	$sql1 = mysqli_query($conn,"SELECT customer_name from tbl_sale Where customer_name='$customer_id'");
	$sql2 = mysqli_query($conn,"SELECT customer_name from tbl_sale_return Where customer_name='$customer_id'");
	$sql3 = mysqli_query($conn,"SELECT customer from tbl_installment Where customer='$customer_id'");
	$sql4 = mysqli_query($conn,"SELECT customer_id from tbl_trans Where customer_id='$customer_id'");
				 
				   	if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0 && mysqli_num_rows($sql3)==0 && mysqli_num_rows($sql4)==0) {

						$sql=mysqli_query($conn, "DELETE FROM tbl_customer WHERE customer_id=$customer_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_account_lv2 WHERE acode=$customer_id");
						if($sql){
							header('Location: ../client_list.php?delete=successful');
						}
                	}
                	else
                	{

                		header('Location: ../client_list.php?delete=unsuccessful');
                	}

}

if (isset($_GET['vendor_id'])) {
	$vendor_id=mysqli_real_escape_string($conn, $_GET['vendor_id']);

				   
				   $sql1 = mysqli_query($conn,"SELECT vendor_id from tbl_purchase Where vendor_id='$vendor_id'");
				   $sql2 = mysqli_query($conn,"SELECT vendor_id from tbl_purchase_return Where vendor_id='$vendor_id'");
				   $sql3 = mysqli_query($conn,"SELECT vendor_id from tbl_trans Where vendor_id='$vendor_id'");
				 
				   	if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0 && mysqli_num_rows($sql3)==0) {

						$sql=mysqli_query($conn, "DELETE FROM tbl_vendors WHERE vendor_id=$vendor_id");
						$sql=mysqli_query($conn, "DELETE FROM tbl_account_lv2 WHERE acode=$vendor_id");
						if($sql){
							header('Location: ../vendor_list.php?delete=successful');
						}
                	}
                	else
                	{
                		header('Location: ../vendor_list.php?delete=unsuccessful');
                	}

}

if (isset($_GET['s_id'])) {
	$s_id=mysqli_real_escape_string($conn, $_GET['s_id']);
	
	$sql1 = mysqli_query($conn,"SELECT * from tbl_sale Where sales_men='$s_id'");
	$sql2 = mysqli_query($conn,"SELECT * from tbl_installment Where sales_men='$s_id'");
	$sql3 = mysqli_query($conn,"SELECT *  from tbl_installment Where avo='$s_id'");
	$sql4 = mysqli_query($conn,"SELECT *  from tbl_installment Where mo='$s_id'");
	$sql5 = mysqli_query($conn,"SELECT *  from tbl_installment Where bm='$s_id'");
				 
				   	if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0 && mysqli_num_rows($sql3)==0 && mysqli_num_rows($sql4)==0 && mysqli_num_rows($sql5)==0) {

						$sql=mysqli_query($conn, "DELETE FROM tbl_salesmen WHERE s_id=$s_id");
					
						if($sql){
							header('Location: ../salesmen_list.php?delete=successful');
						}
                	}
                	else
                	{

                		header('Location: ../salesmen_list.php?delete=unsuccessful');
                	}

}


?>