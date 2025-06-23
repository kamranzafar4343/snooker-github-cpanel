
<?php

include "../includes/config.php";

	$plan_id = $_POST['planid'];


// $query = "SELECT * FROM tbl_installment_payment where plan_id = '$plan_id'";

// $result = mysqli_query($conn,$query);

 error_reporting(0);

// /$output='';
 $query12 = mysqli_query($conn,"SELECT period, installment_status, per_month_amount, created_date, created_by FROM tbl_installment where plan_id=$plan_id"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query12) ;
                                   $period=$zdata1['period'];
                                   $created_date1=$zdata1['created_date'];
                                   $created_by=$zdata1['created_by'];
                                   $installment_status=$zdata1['installment_status'];
                               
          							if($installment_status=='Completed')
          							{
          								$month_amount=0;
          							}
          							else
          							{
          								$month_amount=$zdata1['per_month_amount'];
          							}
$sql=mysqli_query($conn, "SELECT * FROM tbl_installment_payment where plan_id = '$plan_id'");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql))
                        {

              $item_id = $row['item_id'];
				      $plan_id = $row['plan_id'];
				   		$created_date = $row['from_date'];
				   		$per_month_amount = $row['per_month_amount'];
				   		$rec_by = $row['created_by'];
				   		$parent_id = $row['parent_id'];
				   		$installment_number+=$row['installment_number'];
				   		$count++;
				   		

				   		$query10 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$created_by"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $creator_name=$zdata1['user_name'];
                        $query11 = mysqli_query($conn,"SELECT user_name FROM users where user_id=$parent_id"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query11) ;
                                   $branch_name=$zdata1['user_name'];

                                  
          							
          							
          								

      $output .= '
                                         		<tr>
                           
						                            <td hidden>'.$count.'</td>
						                            <td>For Month  : '.$row['installment_number'].'</td>
						                            <td>Amount Paid  : '.round($per_month_amount).'</td>
						                            
						                            <td>'.$creator_name.'</td>
						                            <td>'.$branch_name.'</td>
						                            <td>Paid</td>
						                            <td class="text-right">Paid Date : '.$created_date.'</td>
						                        </tr>';
						                    }

			               
	if($count==0){

		$count=0;
		  $date = date($created_date1);
			$date_check = date('Y-m-23', strtotime($date)); 

			 $created_date = date('Y-m-01', strtotime($date));

			
			$y=1;
		
			for ($y = $installment_number+2; $y <= $period; $y++) {
                	
                	$a++;
			$needed = date('Y-m-01',strtotime($created_date." +$a month"));
			$output .= '
                                         		<tr>
                           
						                            <td hidden>'.$y.'</td>
						                            <td>For Month : 1</td>
						                            <td>Amount to Pay  : '.round($month_amount).'</td>
						                            
						                            <td></td>
						                            <td></td>
						                            <td>'.$installment_status.'</td>
						                            <td class="text-right">Paid Before : '.$needed.'</td>
						                        </tr>';
						                      }
	}
	else{
		
	$sql=mysqli_query($conn, "SELECT * FROM tbl_installment_payment where plan_id = '$plan_id' order by payment_id desc limit 1");
	$zdata2 = mysqli_fetch_assoc($sql) ;
  $last_created_date=$zdata2['from_date'];
  $last_installment_number=$zdata2['installment_number'];
 	$last_created_date;
		
		$period=$period;
		$installment_number;
	
		$date = date($last_created_date);

		$created_date = date('Y-m-01', strtotime($date));

			


$a=$last_installment_number-1;

                for ($y = $installment_number+1; $y <= $period; $y++) {
                	
                	$a++;
	$needed = date('Y-m-01',strtotime($created_date." +$a month"));

    $output .= '
                                         		<tr>
                           
						                            <td hidden>'.$y.'</td>
						                            <td>For Month : 1</td>
						                            <td>Amount to Pay  : '.round($month_amount).'</td>
						                            
						                            <td></td>
						                            <td></td>
						                            <td>'.$installment_status.'</td>
						                            <td class="text-right">Paid Before : '.$needed.'</td>
						                        </tr>';
					                        }


}

echo $output;

