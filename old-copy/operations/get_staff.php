<?php
error_reporting(0);
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
                                
                                 $team = mysqli_query($conn,"SELECT * FROM tbl_salesmen  $where $where_location   order by s_id desc");
                              
                                while($pdata = mysqli_fetch_assoc($team))   
                                { 
                                    $s_id=$pdata['s_id'];
                                    $username=$pdata['username'];
                                    $image=$pdata['user_profile'];
                                    $email=$pdata['email'];
                                    $mobile_no=$pdata['mobile_no'];
                                    $designation=$pdata['designation'];
                                    $created_by=$pdata['created_by'];
                                    $sql5=mysqli_query($conn, "SELECT user_name FROM users where user_id='$created_by'");
                                    $data = mysqli_fetch_assoc($sql5);
                                    $user_name=$data['user_name'];
                                     $sql4=mysqli_query($conn, " SELECT SUM(CASE WHEN email!='' THEN 0 ELSE 1 END + CASE WHEN mobile_no2!='' THEN 0 ELSE 1 END + CASE WHEN address_current!='' THEN 0 ELSE 1 END + CASE WHEN address_permanent!='' THEN 0 ELSE 1 END + CASE WHEN salemen_fathername!='' THEN 0 ELSE 1 END + CASE WHEN salary!='' THEN 0 ELSE 1 END) as total_perc from tbl_salesmen where s_id='$s_id'");
                                    $data = mysqli_fetch_assoc($sql4);
                                    $total_perc=$data['total_perc'];

                                    if($total_perc=='0')
                                    {
                                        $data_perc='100';
                                    }
                                    else if($total_perc=='1')
                                    {
                                        $data_perc='80';
                                    }
                                    else if($total_perc=='2')
                                    {
                                        $data_perc='70';
                                    }
                                    else if($total_perc=='3')
                                    {
                                        $data_perc='60';
                                    }
                                    else if($total_perc=='4')
                                    {
                                        $data_perc='50';
                                    }
                                    else if($total_perc=='5')
                                    {
                                        $data_perc='40';
                                    }
                                    else if($total_perc=='6')
                                    {
                                        $data_perc='30';
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
                            <h5>'.$username . " ( ".   $designation. " )" .'</h5>
                            <small>'.$email.'</small>
                            <h6>'.$mobile_no.'</h6>
                             
                            <div class="m-t-15">
                                <a href="add_salemen.php?edit_id='.$s_id.'">
                                <button class="btn btn-sm btn-primary">View Profile</button></a>  
                                 <a href="operations/delete_client.php?s_id='.$s_id.'" class="delete" data-confirm="Are you sure to delete?">  
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