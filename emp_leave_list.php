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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Leave Request</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Employee</li>
                            <li class="breadcrumb-item active">Leave Request</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <?php
              
              if(isset($_GET['approved']) && $_GET['approved']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great ! </strong> Employee Leave Approved Succesfully.
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
  
  <strong>Great ! </strong> Employee Leave Added Succesfully.
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
  
  <strong>Great ! </strong> Employee Leave Deleted Succesfully.
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
                                <li><a href="javascript:void(0);" class="btn btn-info" data-toggle="modal" data-target="#Leave_Request">Add Leave</a></li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0 c_list">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Leave Type</th>
                                            <th>Date</th>
                                            <th>Reason</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                $count=1;
                                $sql=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $team = mysqli_query($conn,"SELECT * FROM tbl_emp_leave");
                                }
                                else
                                {
                                  $team = mysqli_query($conn,"SELECT * FROM tbl_emp_leave  where created_by='$userid' ");
                                }
                               
                                while($edata = mysqli_fetch_assoc($team))   
                                { 
                                    $emp_id=$edata['emp_id'];
                                    $leave_id=$edata['id'];
                                    $f_date=$edata['f_date'];
                                    $t_date=$edata['t_date'];
                                    $leave_type=$edata['leave_type'];
                                    $reason=$edata['reason'];
                                    $status=$edata['status'];
                                    $emp = mysqli_query($conn,"SELECT * FROM tbl_salesmen where s_id='$emp_id'");
                                    $pdata = mysqli_fetch_assoc($emp);
                                    $username=$pdata['username'];
                                    $image=$pdata['user_profile'];
                                    $email=$pdata['email'];
                                    $mobile_no=$pdata['mobile_no'];
                                    $designation=$pdata['designation'];
                                ?>
                                        <tr>
                                            <td class="width45">                                           
                                                <img src="<?php if($image!=''){ echo $image;}else{?> assets/images/userdefault.jpg<?php }?>" class="rounded-circle avatar" alt="">
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?php echo $username;?></h6>                                            
                                            </td>
                                            <td><span><?php echo $designation;?></span></td>
                                            <td><span><?php echo $leave_type;?></span></td>
                                            <td><?php echo $f_date;?> to <?php echo $t_date;?></td>
                                            <td><?php echo $reason;?></td>
                                            <td><?php echo $status;?></td>
                                            <td>
                                                <a href="operations/add_emp_leave.php?approve=<?php echo $leave_id;?>">
                                                <button type="button" class="btn btn-sm btn-success" title="Approved"><i class="fa fa-check"></i></button>
                                                </a>
                                                <a href="operations/add_emp_leave.php?delete=<?php echo $leave_id;?>">
                                                <button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Declined" onclick="return confirm('Are you sure want to delete');"><i class="fa fa-ban"></i></button>
                                                </a>
                                            </td>
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
<div class="modal animated lightSpeedIn" id="Leave_Request" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="title" id="defaultModalLabel">Add Leave Request</h6>
            </div>
            <form action="operations/add_emp_leave.php" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-md-12">
                        <select class="form-control mb-3 show-tick" name="emp_id">
                            <?php
                                           $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege=='superadmin' || $user_privilege=='branch')
                                {
                                 
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$userid'";
                                }
                                else
                                {
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$created_by'";
                                }
                                             
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$vendor)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[user_name] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <select class="form-control mb-3 show-tick" name="leave_type">
                            <option>Select Leave Type</option>
                            <option>Casual Leave (12)</option>
                            <option>Medical Leave</option>
                            <option>Maternity Leave</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="date" name="f_date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="From *">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="date" name="t_date" data-provide="datepicker" data-date-autoclose="true" class="form-control" placeholder="From *">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <textarea rows="6" name="reason" class="form-control no-resize" placeholder="Leave Reason *"></textarea>
                        </div>
                    </div>                    
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="add_leave">Add</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">CLOSE</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Javascript -->
<script src="assets/bundles/libscripts.bundle.js"></script>    
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="../assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 
<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script><!-- bootstrap datepicker Plugin Js --> 

<script src="assets/bundles/mainscripts.bundle.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/pages/ui/dialogs.js"></script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-leave.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
