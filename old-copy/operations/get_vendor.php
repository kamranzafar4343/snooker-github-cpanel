<?php
error_reporting(0);
include "../includes/head.php";

include "../includes/config.php";
include "../includes/session.php";
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
$output='';


$count=1;
                                
                                 $team = mysqli_query($conn,"SELECT * FROM tbl_vendors  $where $where_location   order by v_id desc");
                                while($pdata = mysqli_fetch_assoc($team))   
                                { 
                                    $c_id=$pdata['v_id'];
                             
                                   $image=$pdata['user_profile'];
                                   $username=$pdata['username'];
                                   $created_by=$pdata['created_by'];
                                   $sql5=mysqli_query($conn, "SELECT user_name FROM users where user_id='$created_by'");
                                    $data = mysqli_fetch_assoc($sql5);
                                    $user_name=$data['user_name'];
                                     $email=$pdata['email'];
                                     $mobile_no=$pdata['mobile_no'];
                                     $vendor_id=$pdata['vendor_id'];
                                    $sql4=mysqli_query($conn, "SELECT SUM(CASE WHEN address!='' THEN 0 ELSE 1 END ) as total_perc from tbl_vendors where vendor_id='$vendor_id'");
                                    $data = mysqli_fetch_assoc($sql4);
                                    $total_perc=$data['total_perc'];

                                    if($total_perc=='0')
                                    {
                                        $data_perc='100';
                                    }
                                    else
                                    {
                                        $data_perc='67';
                                    }
                                    if($image=='')
                                    {
                                    	$image='assets/images/userdefault.jpg';
                                    }
                                    else
                                    {
                                    	$image=$image;
                                    }

$output.='
<div class="col-lg-3 col-md-6 col-sm-12">
                    <div class="card">
                        <div class="body text-center">
                            <div class="chart easy-pie-chart-1" data-percent="'.$data_perc.'"> <span><img src='.$image.' alt="user" class="rounded-circle"/></span> </div>
                            <h5>'.$username .'</h5>
                            <small>'.$email.'</small>
                            <h6>'.$mobile_no.'</h6>
                             
                            <div class="m-t-15">
                                <a href="add_vendors.php?edit_id='.$vendor_id.'">
                                <button class="btn btn-sm btn-primary">View Profile</button></a>  
                                 <a href="operations/delete_client.php?vendor_id='.$vendor_id.'" class="delete" data-confirm="Are you sure to delete?">  
                                <button class="btn btn-sm btn-success">Delete</button></a>
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