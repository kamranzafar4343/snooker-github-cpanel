<?php

include "../includes/config.php";

	$plan_id = $_POST['planid'];


// $query = "SELECT * FROM tbl_installment_payment where plan_id = '$plan_id'";

// $result = mysqli_query($conn,$query);

 error_reporting(0);

// /$output='';
$sql=mysqli_query($conn, "SELECT * FROM tbl_plan_notes where plan_id = '$plan_id'");
                        $count=0;
                        while($row=mysqli_fetch_assoc($sql))
                        {

                        $plan_notes = $row['plan_notes'];
				      	$plan_id = $row['plan_id'];
				   		$created_date = $row['created_date'];
				   		
				   		$count++;
                

      $output .= '
                                         		<tr>
                           
						                            <td>'.$plan_id.'</td>
						                            <td>'.$plan_notes.'</td>
						                            <td class="text-right">'.$created_date.'</td>
						                        </tr>';
						                        
                                         
      
   



}
echo $output;

