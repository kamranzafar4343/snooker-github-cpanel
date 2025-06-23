<?php

include "../includes/config.php";

$purchase_id = $_POST['purchase_id'];
$invoice_no="Purchase_".$purchase_id;
$vendor_id = $_POST['vendor_id'];
// $query = "SELECT * FROM tbl_installment_payment where plan_id = '$plan_id'";

// $result = mysqli_query($conn,$query);

 error_reporting(0);
  $output=0;  
 
$sql=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where invoice_no = '$invoice_no' and acode='$vendor_id'");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql))
                        {

              $invoice_no = $row['invoice_no'];
				      $narration = $row['narration'];
				   		$created_date = $row['created_date'];
				   		$d_amount = $row['d_amount'];
				   		$created_date = $row['created_date'];
				   		// $parent_id = $row['parent_id'];
				   		// $installment_number+=$row['installment_number'];
				   		// $count++;
				   		

				   		$query10 = mysqli_query($conn,"SELECT username FROM tbl_vendors where vendor_id=$vendor_id"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $vendor_name=$zdata1['username'];

      echo  '
                                         		<tr>
                           
						                            <td>'.$invoice_no.'</td>
						                            <td>'.$vendor_name.'</td>
						                            <td>'.$narration.'</td>
						                            
						                            <td>'.$d_amount.'</td>
						                            <td>'.$created_date.'</td>
						                        
						                        </tr>';
						                    }





