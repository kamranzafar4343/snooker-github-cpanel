
<?php
error_reporting(0);
include "../includes/config.php";
include "../includes/session.php";
$output='';

$name=$_POST['name'];
$branch=$_POST['branch'];
if($name=='' && $branch=='')
{
	$where="";
    $where_location="";
}
else if($name!='' && $branch=='')
{
	$where="where tbl_customer.username LIKE '%$name%' OR tbl_customer.mobile_no1 LIKE '%$name%' OR tbl_customer.client_cnic LIKE '%$name%'";
     $where_location="";
}
else if($name=='' && $branch!='')
{
    $where="";
     $where_location="where tbl_customer.created_by='".$branch."'";
}
else
{
    $where="where tbl_customer.username LIKE '%$name%' OR tbl_customer.mobile_no1 LIKE '%$name%' OR tbl_customer.client_cnic LIKE '%$name%'";
    $where_location="and tbl_customer.created_by='".$branch."'";
}
$count=1;

                                  $team = mysqli_query($conn,"SELECT * FROM tbl_installment INNER JOIN tbl_customer ON tbl_installment.customer = tbl_customer.customer_id $where $where_location group by tbl_installment.customer");
                               
                                while($value1 = mysqli_fetch_assoc($team))   
                                { 

                                  $gran1_name = $value1['gran1_name'];
                                  $gran1_mobile_no = $value1['gran1_mobile_no'];
                                  $gran2_name = $value1['gran2_name'];
                                  $gran2_mobile_no = $value1['gran2_mobile_no'];
                                  $gran3_name = $value1['gran3_name'];
                                  $gran3_mobile_no = $value1['gran3_mobile_no'];
                                  $gran4_name = $value1['gran4_name'];
                                  $gran4_mobile_no = $value1['gran4_mobile_no'];
                                  $customer = $value1['customer'];
                                   $customer_name = $value1['username'];

                                    $customer_id = $value1['seprate_customer_id'];
                                    $mobile_no1 = $value1['mobile_no1']; 
                                    $customer_by=$value1['created_by'];
                                    $client_cnic=$value1['client_cnic'];
                                    $created_date=$value1['created_date'];
                                  $sql=mysqli_query($conn, "SELECT count(plan_id) as repeated FROM tbl_installment where customer='$customer'");
                                  $data = mysqli_fetch_array($sql);
                                  $repeated = $data['repeated'];

                                  $sql=mysqli_query($conn, "SELECT count(plan_id) as opened FROM tbl_installment where customer='$customer' and installment_status='Pending'");
                                  $data = mysqli_fetch_array($sql);
                                  $opened = $data['opened'];

                                  $sql=mysqli_query($conn, "SELECT count(plan_id) as closed FROM tbl_installment where customer='$customer' and installment_status='Completed'");
                                  $data = mysqli_fetch_array($sql);
                                  $closed = $data['closed'];
                    
                                  $sql=mysqli_query($conn, "SELECT count(plan_id) as gran FROM tbl_installment where  (gran1_client_cnic Like '%$client_cnic%' OR gran2_client_cnic Like '%$client_cnic%' OR gran3_client_cnic Like '%$client_cnic%' OR gran4_client_cnic Like '%$client_cnic%')");
                                  $data = mysqli_fetch_array($sql);
                                  $gran = $data['gran'];

                                 
                                    $sql=mysqli_query($conn, "SELECT user_name FROM users where user_id='$customer_by'");
                                              $data = mysqli_fetch_array($sql);
                                                $branchname = $data['user_name'];
                                                $iden = str_split($branchname);
                                                $iden3 = str_split($branchname,3);
                                                $iden2=end($iden3);
                                                $iden1=$iden[0];
           
                                    $sql_open=mysqli_query($conn, "SELECT * FROM tbl_installment where customer='$customer' and installment_status='Pending'");
                                    $data_open='';
                                    while($data = mysqli_fetch_array($sql_open))
                                      {
                                       $plan_id = $data['plan_id'];
                                       $data_open.=''."( ".$plan_id ." )".''; 
                                      }
                                  $sql_close=mysqli_query($conn, "SELECT * FROM tbl_installment where customer='$customer' and installment_status='Completed'");
                                    $data_close='';
                                    while($data = mysqli_fetch_array($sql_close))
                                      {
                                       $plan_id = $data['plan_id'];
                                       $data_close.=''."( ".$plan_id ." )".''; 
                                      }  
                                  $sql_gran=mysqli_query($conn, "SELECT plan_id AS gran_id FROM tbl_installment where  (gran1_client_cnic Like '%$client_cnic%' OR gran2_client_cnic Like '%$client_cnic%' OR gran3_client_cnic Like '%$client_cnic%' OR gran4_client_cnic Like '%$client_cnic%')");
                                  $data_gran='';
                                    while($data = mysqli_fetch_array($sql_gran))
                                      {
                                       $gran_id = $data['gran_id'];
                                       $data_gran.=''."( ".$gran_id ." )".''; 
                                      } 
$output.='
                            <tr>
                            <td>'.$iden1.$iden2."_".$customer_id.'</td>
                            <td>'.$customer_name.'</td>
                            <td>'.$mobile_no1.'</td>
                            <td>'.$client_cnic.'</td>
                            <td>'.$repeated.'</td>
                            <td>'.$opened." <br> ".$data_open .'</td>
                            <td>'.$closed." <br> ".$data_close .'</td>
                            <td>'.$gran.'</td>
                            <td>'.$data_gran.'</td>
                            </tr>
';
}

echo $output;
?>
