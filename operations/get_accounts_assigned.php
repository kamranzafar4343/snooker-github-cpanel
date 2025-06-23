	<?php
include "../includes/config.php";
include "../includes/session.php";

$avo_assigned=$_POST['avo_assigned'];

$query = "SELECT customer,plan_id FROM tbl_installment where assigned_avo='$avo_assigned' and installment_status='Pending'";

$result = mysqli_query($conn,$query);
if(mysqli_num_rows($result)>0)
{
	error_reporting(0);


     while($row = mysqli_fetch_array($result) ){
     	$customer_id = $row['customer'];
     	$plan_id = $row['plan_id'];
     	$sql=mysqli_query($conn,"SELECT username,mobile_no1,client_cnic FROM tbl_customer WHERE customer_id='$customer_id'");
        $detail = mysqli_fetch_assoc($sql);
        $username =$detail['username'];
        $mobile_no1 =$detail['mobile_no1'];
        $client_cnic =$detail['client_cnic'];

      $customer_detail = "Plan_".$plan_id." (".$username.")(".$mobile_no1.")(".$client_cnic.")";

      $users_arr[] = array("plan_id" => $plan_id, "customer_detail" => $customer_detail);
   }
 
}
else
{
	$users_arr[] = array("plan_id" => '', "customer_detail" => '');
}


echo json_encode($users_arr);