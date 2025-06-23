<?php
include "../includes/config.php";
include "../includes/session.php";


if (isset($_GET['id'])) {
	$category=mysqli_real_escape_string($conn, $_GET['id']);
	$sql = mysqli_query($conn,"SELECT * FROM tbl_items where category='$category'");
	if (mysqli_num_rows($sql)==0) {
		$sql=mysqli_query($conn, "DELETE FROM tbl_cat WHERE id=$category");
		$sql=mysqli_query($conn, "DELETE FROM tbl_sub_cat WHERE cat_name=$category");
		$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE brand_id=$category");
	if($sql){
		header('Location: ../catagory_list.php?delete=successful');
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
				   
						
						$sql=mysqli_query($conn, "DELETE FROM tbl_cat WHERE id=$category");
						$sql=mysqli_query($conn, "DELETE FROM tbl_sub_cat WHERE cat_name=$category");
						$sql=mysqli_query($conn, "DELETE FROM tbl_items WHERE category=$category");
						if($sql){
							header('Location: ../catagory_list.php?delete=successful');
						}
                	}
                	else
                	{
                		header('Location: ../catagory_list.php?delete=unsuccessful');
                	}
	}

	
}
}
?>