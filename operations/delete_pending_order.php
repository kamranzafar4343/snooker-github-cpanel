<?php

include "../includes/config.php";
include "../includes/session.php";
$output='';
if($_POST['ref_id'])
{
$ref_id = $_POST['ref_id'];
$created_by = $userid;
$sql_check=mysqli_query($conn, "DELETE FROM tbl_sale_temp where ref_id='$ref_id'  and user_id='$created_by'");


				$qty=0;
			  	$amount=0;
			  	$i=0;
				  	$sql_user=mysqli_query($conn, "SELECT * FROM tbl_sale_temp where user_id='$userid' and status='0' and ref_id!='$ref_id' group by ref_id");
                        while($data=mysqli_fetch_assoc($sql_user)){
                        	$i++;
                        $ref_id_pending = $data['ref_id'];
                        $customer = $data['customer'];
                        $sales_men = $data['sales_men'];
                        $ref_id = $data['ref_id'];
                        $qty += $data['qty'];
                        $amount += $data['amount'];
                       
							$sql=mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer");
							$data=mysqli_fetch_assoc($sql);
							$customer_name=$data['username'];
					        $customer_address=$data['address_current'];
					       
					        
$output.= '                
				<div class="col-lg-4">
				  	
					  <div class="pos-order">
						<h3 class="pos-order-title" >'.$ref_id.'</h3>
						<div class="orderdetail-pos">
							<p>
								<strong>Customer Name</strong>
								'.$customer_name.'
							</p>
							<p>
								<strong>Address</strong>
								'.$customer_address.'
							</p>
							<p>
								<strong>Payment Status</strong>
								Pending
							</p>
							<p>
								<strong>Total Items</strong>
								'.$qty.'
							</p>
							<p>
								<strong>Amount to Pay</strong>
								Rs '.$amount.'
							</p>
						</div>
						<div class="d-flex justify-content-end">

							<a href="pos.php?ref_id='.$ref_id_pending.'"  class="ml-3" title="Edit"><i class="fas fa-edit"></i></a>
							<a href="#"  class="ml-3 delete_order_pending" title="Delete" data-sale="'.$ref_id_pending.'"><i class="fas fa-trash-alt"></i></a>
							
						</div>
					  </div>
					
				  </div> ';
 }
 $output.='<input type="hidden" name="count_draft"  id="count_draft" value="'.$i.'">';
                  
 echo $output;         
}
?>
<script type="text/javascript">
jQuery('.delete_order_pending').on('click', function(){
	 var ref_id = $(this).attr("data-sale")
  	$.ajax({
                method: "POST",
                url: "operations/delete_pending_order.php",
                data: {ref_id:ref_id},             
                })
                .done(function(response){
               
                	$("#darft_product").empty();
                	$("#darft_product").html(response);
                	var count_draft=$("#count_draft").val();
                	$("#draft_bills").text(count_draft);
                	
				});
  });
  </script>
