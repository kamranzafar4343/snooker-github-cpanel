<?php

include "../includes/config.php";
include "../includes/session.php";

$item = $_POST['itemid'];
$itemid=explode(',', $item, 4);

$itemid=$itemid[0];


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

                                  $query = "SELECT sum(qty_rec) as pur_qty FROM tbl_purchase_detail where product = '$itemid' and parent_id='$created_by'";

                                  $result = mysqli_query($conn,$query);
									     while($row = mysqli_fetch_array($result) ){
									      $pur_qty = $row['pur_qty'];


									   }
									   $query = "SELECT sum(qty_rec) as pur_qty_local FROM tbl_single_purchase_detail where product = '$itemid' and parent_id='$created_by'";

                                  $result = mysqli_query($conn,$query);
									     while($row = mysqli_fetch_array($result) ){
									      $pur_qty_local = $row['pur_qty_local'];


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
										   
								$query4 = "SELECT sum(return_qty) as pur_returned_qty FROM tbl_purchase_return_detail where product = '$itemid' and parent_id='$created_by'";
									$result4 = mysqli_query($conn,$query4);
										     while($row4 = mysqli_fetch_array($result4) ){
										      $pur_returned_qty = $row4['pur_returned_qty'];


										   }
								

								$query5 = "SELECT count(plan_id) as lease_qty FROM tbl_installment where item_id = '$itemid' and parent_id='$created_by'";
									$result5 = mysqli_query($conn,$query5);
										     while($row5 = mysqli_fetch_array($result5) ){
										      $lease_qty = $row5['lease_qty'];


										   }

								$query6 = "SELECT sum(qty_rec) as loc_pur_qty FROM tbl_single_purchase_detail where product = '$itemid' and parent_id='$created_by'";

                                  $result6 = mysqli_query($conn,$query6);
									     while($row6 = mysqli_fetch_array($result6) ){
									      $loc_pur_qty = $row6['loc_pur_qty'];


									   }

									
									$pur_qty_total=($pur_qty+ $pur_qty_local)-$pur_returned_qty;
									$sold_qty_total=($sold_qty+$lease_qty)-$sale_returned_qty;
									
								if($user_privilege!='branch' && $created_by=='1')
                               {
                               	$query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and trans_parent_id='$created_by' and recieved='1'";
									$result2 = mysqli_query($conn,$query2);
										     while($row2 = mysqli_fetch_array($result2) ){
										      $tran_qty = $row2['tran_qty'];


										   }
                               	$total_qty=($pur_qty_total-$sold_qty_total)-$tran_qty;
                               }
                               else
                               {

                               	$query2 = "SELECT sum(qty_rec) as tran_qty FROM tbl_purchase_req_detail where product = '$itemid' and parent_id='$created_by' and recieved='1'";
									$result2 = mysqli_query($conn,$query2);
										     while($row2 = mysqli_fetch_array($result2) ){
										            $tran_qty = $row2['tran_qty'];


										   }
                               	$total_qty=($pur_qty_total-$sold_qty_total)+$tran_qty;
                               }
									
                                



echo($total_qty);