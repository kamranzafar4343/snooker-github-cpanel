<!doctype html>
<html lang="en">


<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";


session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>
<body class="theme-orange">

    <!-- Page Loader -->
<?php
include "includes/loader.php";

?>

   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Attendance </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Employee</li>
                            <li class="breadcrumb-item active">Attendance </li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <?php
              
              if(isset($_GET['approved']) && $_GET['approved']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great ! </strong> Employee Attendance Added Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }?>
              <?php
              
              if(isset($_GET['add']) && $_GET['add']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great ! </strong> Employee Attendance Added Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }?>
              <?php
              
              if(isset($_GET['delete']) && $_GET['delete']=='successful' ){
                  ?>
                  <div class="alert alert-danger" id="success-alert">
  
  <strong>Great ! </strong> Attendance Deleted Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }?>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>Employee List</h2>
                            <ul class="header-dropdown">
                                <li><a href="attandence_report.php" class="btn btn-info">Check Attendance</a></li>
                            </ul>
                        </div>
                         <?php
                                if(isset($_POST['search']))
                                {
                                    
                                    $employe=$_POST['emp_id'];
                                    $date=$_POST['f_date'];
                                    if($employe=='All')
                                    {
                                        $where="";
                                    }
                                    else
                                    {
                                        $where="and s_id='$employe'";

                                    }
                                    
                                }
                                else
                                {
                                    
                                    $date=date('Y-m-d');
                                     $where="";
                                }
                        ?>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0 c_list">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Phone</th>
                                            <th>CNIC</th>
                                            <th>Created Date</th>
                                          
                                            <th>Action/Status</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>

                                <?php
                                $date_today=date('Y-m-d');
                                $count=1;
                                $sql=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                   
                                  $team = mysqli_query($conn,"SELECT * FROM tbl_salesmen where created_by!='' $where");
                                }
                                else
                                {
                                  $team = mysqli_query($conn,"SELECT * FROM tbl_salesmen  where created_by='$userid' $where");
                                }
                               
                                while($pdata = mysqli_fetch_assoc($team))   
                                { 
                                    $s_id=$pdata['s_id'];
                                    $username=$pdata['username'];
                                    $created_date=$pdata['created_date'];
                                    $designation=$pdata['designation'];
                                    $mobile_no1=$pdata['mobile_no1'];
                                    $salemen_cnic=$pdata['salemen_cnic'];
                                   
                                        $att = mysqli_query($conn,"SELECT * FROM tbl_attendence  where date(attadance_date)='$date' and emp_id='$s_id'");
                                    
                                    
                                    if(mysqli_num_rows($att)>0)
                                    {
                                        $hidden="hidden";
                                        $data = mysqli_fetch_assoc($att);
                                        $status=$data['status'];
                                        if($status=='1')
                                        {
                                            $display="<span class='badge badge-success'>Present</span>";
                                        }
                                        else if($status=='0')
                                        {
                                            $display="<span class='badge badge-danger'>Absent</span>";
                                        }
                                        
                                    }
                                    else
                                    {
                                        $hidden="";
                                        $display="";
                                    }
                                ?>
                                        <tr>
                                            <td class="width45">                                           
                                                <img src="assets/images/userdefault.jpg" class="rounded-circle avatar" alt="">
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?php echo $username;?></h6>                                            
                                            </td>
                                            <td><span><?php echo $designation;?></span></td>
                                            <td><span><?php echo $mobile_no1;?></span></td>
                                            <td><span><?php echo $salemen_cnic;?></span></td>
                                            <td><span><?php echo $created_date;?></span></td>
                                            <?php if(isset($_POST) && $date!=$date_today)
                                            {?>
                                             <td><?php echo $display;?></td>
                                            <?php }else {?>
                                            <td>

                                                <?php echo $display;?>
                                                <a href="operations/add_attandance.php?emp_id=<?php echo $s_id;?>" <?php echo $hidden;?>>
                                                <button type="button" class="btn btn-sm btn-success" title="Approved"><i class="fa fa-check"> Present </i></button>
                                                </a>
                                                <a href="operations/add_attandance.php?emp_id_abb=<?php echo $s_id;?>" <?php echo $hidden;?>>
                                                <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Declined" onclick="return confirm('Are you sure want to mark this employee absent.');"><i class="fa fa-ban">Absent</i></button>
                                                </a>
                                            </td>
                                            <?php }?>
                                        </tr>
                                    <?php }?>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Default Size -->

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="../assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script><!-- bootstrap datepicker Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/pages/ui/dialogs.js"></script>

<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
</body>
<script type="text/javascript">
    $(document).ready(function() {
    $(".saleman").select2();
});
</script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-leave.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
