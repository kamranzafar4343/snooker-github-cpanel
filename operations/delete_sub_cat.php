<?php
include "../includes/config.php";
include "../includes/session.php";

if (isset($_GET['id'])) {
	$sub_category=mysqli_real_escape_string($conn, $_GET['id']);
	$sql = mysqli_query($conn,"SELECT * FROM tbl_items where sub_category='$sub_category'");
	if (mysqli_num_rows($sql)==0) {
		$sql=mysqli_query($conn, "DELETE FROM tbl_sub_cat WHERE id=$sub_category");
		$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE sub_category=$sub_category");
	if($sql){
		header('Location: ../sub_catagory_list.php?delete=successful');
	}
	}
	else
	{

           while($pdata = mysqli_fetch_assoc($sql))   
                { 
				   $item_id=$pdata['item_id'];
				   
				    $sql1 = mysqli_query($conn,"SELECT item_id from tbl_installment Where item_id='$item_id'");
				   $sql2 = mysqli_query($conn,"SELECT product from tbl_sale_detail Where product='$item_id'");
				   $sql3 = mysqli_query($conn,"SELECT product from tbl_purchase_detail Where product='$item_id'");
				   $sql4 = mysqli_query($conn,"SELECT product from tbl_purchase_return_detail Where product='$item_id'");
				   $sql5 = mysqli_query($conn,"SELECT product from tbl_sale_return_detail Where product='$item_id'");
				   	if (mysqli_num_rows($sql1)==0 && mysqli_num_rows($sql2)==0 && mysqli_num_rows($sql3)==0 && mysqli_num_rows($sql4)==0 && mysqli_num_rows($sql5)==0) {

						$sql=mysqli_query($conn, "DELETE FROM tbl_sub_cat WHERE id=$sub_category");
						$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE sub_category=$sub_category");
						if($sql){
							header('Location: ../sub_catagory_list.php?delete=successful');
						}
                	}
                	else
                	{
                		header('Location: ../sub_catagory_list.php?delete=unsuccessful');
                	}
	}

	
}
}
?>