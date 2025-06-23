<?php

include "../includes/config.php";
include "../includes/session.php";

$itemid = $_POST['itemid'];
$sql=mysqli_query($conn, "SELECT user_privilege,created_by,user_id FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                $user_id=$data['user_id'];
                                
                               if($user_privilege=='branch')
                               {
                               	$created_by=$user_id;
                               }
                               else
                               {
                               	$created_by=$created_by;
                               }
                               $sql1 = "SELECT  SUM(qty_rec) as pur_qty FROM tbl_purchase_detail where product='$itemid' and parent_id='$created_by'";
                                  

				                  $result1 = mysqli_query($conn,$sql1);
				                       while($row1 = mysqli_fetch_array($result1) ){
				                         $pur_qty = $row1['pur_qty'];


				                     }
								$query1 = "SELECT sum(qty) as sold_qty FROM tbl_sale_detail where product = '$itemid' and parent_id='$created_by'";
                                  

									$result1 = mysqli_query($conn,$query1);
									     while($row1 = mysqli_fetch_array($result1) ){
									      $sold_qty = $row1['sold_qty'];


									   }

								

								$query3 = "SELECT sum(returned_qty) as sale_returned_qty FROM tbl_sale_return_detail where product = '$itemid' and parent_id='$created_by'";
									$result3 = mysqli_query($conn,$query3);
										     while($row3 = mysqli_fetch_array($result3) ){
										       $sale_returned_qty = $row3['sale_returned_qty'];


										   }
								
		$total_qty=$pur_qty-($sold_qty-$sale_returned_qty);					
if($total_qty=='' || $total_qty=='0')
{
	$total_qty=0;
}

echo($total_qty);