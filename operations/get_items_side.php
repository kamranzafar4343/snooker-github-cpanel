<?php

include "../includes/config.php";

if($_POST['cat_id'])
{


$cat_id = $_POST['cat_id'];
$query1 = "SELECT * FROM tbl_items where brand_id='$cat_id'";

$result = mysqli_query($conn,$query1);

error_reporting(0);

 $i=0;
while($row = mysqli_fetch_array($result) ){
 $i++;
$item_id = $row['item_id'];
$barcode = $row['barcode'];
$item_serial = $row['item_serial'];
$pur_item_id = $row['pur_item_id'];
$brand_name = $row['brand_name'];
$item_name = $row['item_name'];
$sale_rate = $row['sale_rate'];
$amount = $row['amount'];
$qty = $row['qty'];
$stock = $row['stock'];
$sql_item=mysqli_query($conn, "SELECT * FROM tbl_items where item_id='$item_id'");
$value1 = mysqli_fetch_assoc($sql_item);
$item_name=$value1['item_name'];
$brand_id=$value1['brand_id'];
$sql_brand=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
$value2 = mysqli_fetch_assoc($sql_brand);
$brand_name=$value2['cat_name'];
     	      echo '                
								<div class="row">
									<div class="col-xl-4 col-lg-2 col-md-3 col-sm-4 col-6">
										<div class="productCard">
											<div class="productThumb">
												<img class="img-fluid" src="" alt="ix">
											</div>
											<div class="productContent">
												<a href="#">
													Men Polo Shirt (M) -MPS[2545-P]
												</a>
											</div>
										</div>
									</div>	
								</div>';
                   
                  }
}
?>