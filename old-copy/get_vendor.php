<?php
include "includes/config.php";

// fetch records
$sql = "SELECT * FROM tbl_vendors";
$result = mysqli_query($conn, $sql);
$count=0;
if(mysqli_num_rows($result)>0)
{
  
while($data = mysqli_fetch_assoc($result)) {
$count++;
                                    $vendor_id=$data['vendor_id'];
                                    $vendor_name=$data['username'];
                                    $mobile_no=$data['mobile_no'];
                                    $address=$data['address'];
                                    $created_by=$data['created_by'];
                                    $created_date=$data['created_date'];
                                    $sql5=mysqli_query($conn, "SELECT user_name FROM users where user_id='$created_by'");
                                    $data = mysqli_fetch_assoc($sql5);
                                    $user_name=$data['user_name'];
                                    
                                    $view='<a href="add_vendors.php?edit_id='.$vendor_id.'"><button class="btn btn-sm btn-primary">View Profile</button></a>';
                                    $delete='<a href="operations/delete_client.php?vendor_id='.$vendor_id.'" class="deleteUser"><button class="btn btn-sm btn-success">Delete</button></a>';
    $action=$view." ".$delete;
    $sql6=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as t_balance FROM tbl_trans_detail where acode='$vendor_id'");
    $data6 = mysqli_fetch_assoc($sql6);
    $t_balance=$data6['t_balance'];
    if($t_balance=='')
    {
      $t_balance=0;
    }

    $sql7=mysqli_query($conn, "SELECT opening_bal FROM tbl_account_lv2 where acode='$vendor_id'");
    $data7 = mysqli_fetch_assoc($sql7);
    $opening_bal=$data7['opening_bal'];
    if($opening_bal=='')
    {
      $opening_bal=0;
    }
    $balance=$t_balance+$opening_bal;
    if($balance=='')
    {
      $balance=0;
    }
    
     $array[] = array(
       "count" => $count,
       "vendor_id" => $vendor_id,
       "vendor_name" => $vendor_name,
       "mobile_no" => $mobile_no,
       "address" => $address,
       "opening" => $balance,
       "created_by" => $user_name,
       "created_date" => $created_date,
       "action" => $action
     );
    // $array[] = $row;
}
}
else
{
  $array[] = array(
       "count" => '',
       "vendor_id" => '',
       "vendor_name" => '',
       "mobile_no" => '',
       "address" => '',
       "opening" => '',
       "created_by" => '',
       "created_date" => '',
       "action" => ''
     );
}
$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
?>