<?php

include "../includes/config.php";

	$plan_id = $_POST['planid'];


 error_reporting(0);

$output='';

$sql=mysqli_query($conn, "SELECT * FROM tbl_installment_payment where plan_id = '$plan_id'");
                        $count=0;
                        while($row=mysqli_fetch_assoc($sql))
                        {

                        $item_id = $row['item_id'];
				      	$plan_id = $row['plan_id'];
				   		$created_date = $row['created_date'];
				   		$per_month_amount = $row['per_month_amount'];
				   		$created_by = $row['created_by'];
				   		$parent_id = $row['parent_id'];
				   		$installment_number = $row['installment_number'];
				   		$total_inst+=$installment_number;
				   		$total_paid+=$per_month_amount;
				   		$count++;
				   		
				   		

				   		$query10 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created_by"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $creator_name=$zdata1['user_name'];
                        $query11 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$parent_id"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query11) ;
                                   $branch_name=$zdata1['user_name'];
                

      $output .= '
                                         		<tr>
                           
						                            <td>'.$count.'</td>
						                          
						                            <td>'.$creator_name.'</td>
						                            <td>'.$branch_name.'</td>
						                            <td>Paid Date : '.$created_date.'</td>
						                            
						                            <td class="text-right">For Month  : '.$installment_number.'</td>
						                            <td class="text-right">Amount Paid  : '.round($per_month_amount,2).'</td>

						                        </tr>';
						                        }
	  $output .= '					                        
						                        <tr>
                           
						                            <td></td>
						                            <td></td>
						                            <td></td>
						                            <td></td>
						                            <td class="text-right"><h5>Installments Cleared : '.$total_inst.'</h5></td>
						                            <td class="text-right"><h5>Amount Paid : '.$total_paid.'</h5></td>

						                        </tr>
						                         '
						                        ;
						                        
                                         
      
   




echo $output;

