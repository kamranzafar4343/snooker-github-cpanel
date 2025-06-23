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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Category List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Category</li>
                            <li class="breadcrumb-item active">Category List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                             <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='successfull'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great ! </strong>Catagory Deleted Successfully.
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
              } ?>
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

              if(isset($_GET['insert']) && $_GET['insert']=='unsuccessfull' || isset($_GET['update']) && $_GET['update']=='unsuccessfull'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Add Catagory.
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
              

              if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Delete Catagory, Because Data related to Catagory Exist in Transactions..!
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
  
  <strong>Great !</strong> Salary Slip Deleted.
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
                                            <th>Paid Date</th>
                                         
                                            <th>Salary</th>
                                            <?php if($c_write=='1'){?><th>Action</th><?php }?>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <?php 
                        $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $sql=mysqli_query($conn, "SELECT * FROM tbl_salary");
                                }
                                else
                                {
                                  $sql=mysqli_query($conn, "SELECT * FROM tbl_salary where created_by='$userid'");
                                  
                                }
                       
                        $count=0;
                        while($data=mysqli_fetch_assoc($sql))
                        {
                          $id = $data['id'];
                          $invoice_no="Salary_".$id;
                          $staff_mem_id = $data['staff_mem_id'];
                          $salary = $data['staff_mem_salary'];
                          $created_by = $data['created_by'];
                          $created_date = $data['created_date'];
                          $newDate = date("d-m-Y", strtotime($created_date));
                          $sql1=mysqli_query($conn, "SELECT * FROM tbl_salesmen where s_id='$staff_mem_id'");
                          $data1=mysqli_fetch_assoc($sql1);
                        
                        $username = $data1['username'];
        
                        $userprofile = $data1['user_profile'];
                        $email = $data1['email'];
                        $mobile_no1 = $data1['mobile_no1'];
                        $designation = $data1['designation'];

                        $sql1=mysqli_query($conn, "SELECT trans_id FROM tbl_trans where invoice_no='$invoice_no'");
                          $data1=mysqli_fetch_assoc($sql1);
                        
                        $trans_id = $data1['trans_id'];
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
                                            <?php if($c_write=='1'){?>
                                            <td>
                                                <a href="operations/delete.php?salary_id=<?php echo $id;?>"><button type="button" class="btn btn-sm btn-danger" data-toggle="tooltip" data-placement="top" title="delete salary slip" onclick="return confirm('Are you sure want to dele');"><i class="fa fa-bin"></i> Delete</button></a>
                                               <!--  -->
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
</script>



</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
