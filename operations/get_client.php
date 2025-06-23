
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
	$where="where username LIKE '%$name%'";
     $where_location="";
}
else if($name=='' && $branch!='')
{
    $where="";
     $where_location="where created_by='".$branch."'";
}
else
{
    $where="where username LIKE '%$name%'";
    $where_location="and created_by='".$branch."'";
}
$count=1;
                          
                                  $team = mysqli_query($conn,"SELECT * FROM tbl_customer  $where $where_location   order by c_id desc");
                               
                                while($pdata = mysqli_fetch_assoc($team))   
                                { 
                                    $customer_id=$pdata['customer_id'];
                                    $username=$pdata['username'];
                                    $image=$pdata['user_profile'];
                                    $email=$pdata['email'];
                                    $mobile_no=$pdata['mobile_no1'];
                                    $blacklist=$pdata['blacklist'];
                                    $created_by=$pdata['created_by'];
                                    $customer_type=$pdata['customer_type'];
                                    $sql2=mysqli_query($conn, "SELECT type FROM tbl_client_type where type_id='$customer_type'");
                                    $data = mysqli_fetch_assoc($sql2);
                                    $type=$data['type'];
                                    $sql5=mysqli_query($conn, "SELECT user_name FROM users where user_id='$created_by'");
                                    $data = mysqli_fetch_assoc($sql5);
                                    $user_name=$data['user_name'];
                                    $sql4=mysqli_query($conn, "SELECT SUM(CASE WHEN mobile_no2!='' THEN 0 ELSE 1 END + CASE WHEN address_current!='' THEN 0 ELSE 1 END + CASE WHEN address_permanent!='' THEN 0 ELSE 1 END + CASE WHEN address_office!='' THEN 0 ELSE 1 END + CASE WHEN client_fathername!='' THEN 0 ELSE 1 END + CASE WHEN client_occupation!='' THEN 0 ELSE 1 END +  CASE WHEN client_salary!='' THEN 0 ELSE 1 END) as total_perc from tbl_customer where customer_id='$customer_id'");
                                    $data = mysqli_fetch_assoc($sql4);
                                    $total_perc=$data['total_perc'];

                                    if($total_perc=='0')
                                    {
                                        $data_perc='100';
                                    }
                                    else if($total_perc=='1')
                                    {
                                        $data_perc='90';
                                    }
                                    else if($total_perc=='2')
                                    {
                                        $data_perc='80';
                                    }
                                    else if($total_perc=='3')
                                    {
                                        $data_perc='70';
                                    }
                                    else if($total_perc=='4')
                                    {
                                        $data_perc='60';
                                    }
                                    else if($total_perc=='5')
                                    {
                                        $data_perc='40';
                                    }
                                    else if($total_perc=='6')
                                    {
                                        $data_perc='30';
                                    }
                                    else if($total_perc=='7')
                                    {
                                        $data_perc='20';
                                    }
                                    if($image=='')
                                    {
                                    	$image='assets/images/userdefault.jpg';
                                    }
                                    else
                                    {
                                    	$image=$image;
                                    }
                                    if($blacklist==0){
                                        $show='
                                        <a href="operations/blocklist.php?block_id='.$customer_id.'">
                                        <button class="btn btn-sm btn-danger">Block</button></a>'; 
                                    }
                                    else{
                                        $show='
                                        <a href="operations/blocklist.php?unblock_id='.$customer_id.'">
                                        <button class="btn btn-sm btn-warning" onclick="return confirm("Are you sure want to Unblock");">Unblock</button></a>';
                                    }

$output.='
<div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-center">
                            <div class="chart easy-pie-chart-1" data-percent="'.$data_perc.'"> <span><img src='.$image.' alt="user" class="rounded-circle"/></span> </div>
                            <h5>'.$username.'</h5>
                            
                            <h6>'.$type.'</h6>
                             
                            <div class="m-t-15">
                                <a href="add_clients.php?edit_id='.$customer_id.'">
                                <button class="btn btn-sm btn-primary">View Profile</button></a> 
                                '.$show.'
                                 <a href="operations/delete_client.php?c_id='.$customer_id.'" class="delete" data-confirm="Are you sure to delete?">  
                                <button class="btn btn-sm btn-success" >Delete</button></a>
                            </div>
                             <ul class="social-links list-unstyled">
                                <li></li>
                                <li><a title="Locaion" href="javascript:void(0);"><i class="fa  fa-location-arrow"></i> ' .' '.$user_name.'</a></li>
                                <li></li>
                            </ul>
                            
                        </div>
                    </div>
                </div>
';
}
echo $output;
?>
<script src="assets_light/bundles/easypiechart.bundle.js"></script>
<script type="text/javascript">
    var deleteLinks = document.querySelectorAll('.delete');

for (var i = 0; i < deleteLinks.length; i++) {
  deleteLinks[i].addEventListener('click', function(event) {
      event.preventDefault();

      var choice = confirm(this.getAttribute('data-confirm'));

      if (choice) {
        window.location.href = this.getAttribute('href');
      }
  });
}
</script>