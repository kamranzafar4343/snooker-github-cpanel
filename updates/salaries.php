<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:02 GMT -->
<?php
error_reporting(0);
include "includes/session.php";
include "includes/config.php";
include "includes/head.php";
include "user_permission.php";

session_start();

if(isset($_SESSION['adminid'])){


}
else{
   header('Location: login.php'); 
}
?>
<body class="theme-orange">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->


   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Employee List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Employee</li>
                            <li class="breadcrumb-item active">Pay Employee Salary</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                             
                                    <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successfull' || isset($_GET['update']) && $_GET['update']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Salary Added Succesfully.
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
              }

              if(isset($_GET['add']) && $_GET['add']=='fail'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Failed to add salary.
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }
             ?>
             <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='successful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Salary Deleted.
</div>
                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#danger-alert").hide();

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  });
    </script>
            
              <?php
              }
             ?>

                        <div class="body">
                          
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Designation</th>
                                            <th>Phone</th>
                                            <th>Join Date</th>
                                         
                                            <th>Salary</th>
                                             <th>Paid</th>
                                            <?php if($c_write=='1'){?><th>Action</th><?php }?>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $date_now=date('Y-m-d');
                                        // $date_start=date('Y-m-01');
                                        $date_till=date('Y-m-15');

                        $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $sql=mysqli_query($conn, "SELECT * FROM tbl_salesmen");
                                }
                                else
                                {
                                  $sql=mysqli_query($conn, "SELECT * FROM tbl_salesmen where created_by='$userid'");
                                  
                                }
                        
                        $count=0;
                        while($data=mysqli_fetch_assoc($sql))
                        {

                        $id = $data['s_id'];
                        $username = $data['username'];
                        $mobile_no1 = $data['mobile_no1'];
                        $salary = $data['salary'];
                        $userprofile = $data['user_profile'];
                        $email = $data['email'];
                        $created_by = $data['created_by'];
                        $created_date = $data['created_date'];
                        $newDate = date("d-m-Y", strtotime($created_date));
                        $designation = $data['designation'];
                        $sql1=mysqli_query($conn, "SELECT SUM(staff_mem_salary) as paid FROM tbl_salary where staff_mem_id='$id' and MONTH(created_date)=MONTH(CURRENT_DATE())");
                        
                          $data=mysqli_fetch_assoc($sql1);
                          $paid = $data['paid'];
                        if($paid=='')
                        {
                          $paid = 0;
                        }
                        
                        $count++;

                        ?>
                                        
                                        <tr>
                                            <td class="width45">
                                                <img src="<?php if($userprofile){ echo $userprofile;} else{?> assets/images/userdefault.jpg<?php }?>" class="rounded-circle width35" alt="">
                                            </td>
                                            <td>
                                                <h6 class="mb-0"><?php echo $username;?></h6>
                                                <span><?php echo $email;?></span>
                                            </td>
                                            <td><span><?php echo $designation;?></span></td>
                                            <td><span><?php echo $mobile_no1;?></span></td>
                                            <td><?php echo $newDate;?></td>
                              
                                            <td><?php echo $salary;?></td>
                                              <td><?php echo $paid;?></td>
                                            <td>
                                              <?php if($salary>0 && $salary!=''){?>
                                                <a href="payroll.php?s_id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="send salary slip"><i class="fa fa-envelope-o"></i> Pay</button></a>
                                                <a href="#" data-toggle="modal" data-target="#advance<?php echo $id;?>" class="btn btn-sm btn-info" title="Opening"><i class=" icon-envelope-open"></i> Advance</a>
                                              <div id="advance<?php echo $id;?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-body">
                                                     <div class="alert alert-custom alert-danger" role="alert" id="success-alert3" style="display: none;">
                                                            <div class="alert-text"> <strong>Sorry ! </strong>Add advance less than remaing salary !</div>
                                                    </div>
                                                    <form action="operations/advance.php" method="post" enctype="multipart/form-data">
                                                        <div class="row clearfix">
                                                          <div class="col-md-12 col-sm-12">
                                                              <label>Salary</label>
                                                                 <input type="text" class="form-control"  readonly="" tabindex="-1" name="salary" id="salary"  style="border-width: 3px; border-style: transparent;" value="<?php echo $salary;?>"></input>
                                                                  <input type="hidden" name="emp_id" value="<?php echo $id;?>"></input>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                              <label>Paid</label>
                                                                 <input type="text" class="form-control "  readonly="" tabindex="-1"  name="paid" id="paid" style="border-width: 3px; border-style: transparent;" value="<?php echo $paid;?>"></input>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                              <label>Advance</label>
                                                                 <input type="text" class="form-control calculate "  maxlength="7"  name="advance" id="advance" required="" style="border-width: 3px; border-style: transparent;" onchange="check_salary();"></input>
                                                            </div>
                                                            <div class="col-md-12 col-sm-12">
                                                              <label>Remarks</label>
                                                                 <textarea class="form-control "  required="" name="remarks" rows="2"  style="border-width: 3px; border-style: transparent;"></textarea>
                                                            </div>
                                                            
                                                        </div> <hr>
                                                        <button type="submit" d="submit" name="add_advance" class="btn btn-primary">Add</button>
                                                        <button type="button"  class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button>                                          
                                                    </form>      
                                                  </div>
                                                </div>
                                            </div>
                                        </div>

                                                <?php }?>
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


<!-- Javascript -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>

<script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '1');
  }
});
   $("#form1").submit(function(e){
    var salary=$("#salary").val();
    var paid=$("#paid").val();
    var advance=$("#advance").val();
    var remain=Number(salary)-Number(paid);
    if(advance>remain)
    {
      $("#success-alert3").show();
      $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
      $("#success-alert3").slideUp(200);
       });
      return false;
    }
   });
  function check_salary()
  {
    var salary=$("#salary").val();
    var paid=$("#paid").val();
    var advance=$("#advance").val();
    var remain=Number(salary)-Number(paid);
    if(advance>remain)
    {
      $("#success-alert3").show();
      $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
      $("#success-alert3").slideUp(200);
       });
      $("#advance").val('');
      return false;
    }
  }
</script>



</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
