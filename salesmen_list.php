<!doctype html>
<html lang="en">

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
<?php
include "includes/loader.php";

?>
<!-- Overlay For Sidebars -->

<div id="wrapper">

    <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>
   <style type="text/css">
  .search {
  margin-bottom:30px;
  position:relative;
}
.search form {
  padding: 20px 30px;
  height: 70px;
  border: none;
  box-shadow: 0 5px 13px 0px rgba(0, 0, 0, 0.1);
  background: #fff;
}

.search input[type="search"]::-moz-placeholder {color: #0c1f34;}
.search input[type="search"] {  
  font-size:15px;
  font-weight:300;
  width: 100%;
  
  outline: none;
}

.search input[type="submit"] {
  background: url(assets/images/search.png) no-repeat scroll 0 0 / 100% 100%;
  width: 30px;
  height: 30px;
  border: none;
  text-indent: -999999px;
  position:absolute;right:15px;
  bottom:20px;
}

</style>   
   

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">

                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Staff Member</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Staff</li>
                            <li class="breadcrumb-item active">List</li>
                            <?php if($c_write=='1'){?><li class="breadcrumb-item "><a href="add_salemen.php">
                                <button class="btn btn-sm btn-primary">Add Staff</button></a>  </li><?php }?>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <?php
              
              if(isset($_GET['add']) && $_GET['add']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong>Member Added Succesfully.
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
              
              if(isset($_GET['add']) && $_GET['add']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="success-alert">
  
  <strong>Sorry!</strong> Member Not Added.
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
              
              if(isset($_GET['update']) && $_GET['update']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Member Updated Succesfully.
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
             
                      if(isset($_GET['delete']) && $_GET['delete']=='successful' ){
                  ?>
                  <div class="alert alert-danger" id="success-alert">
  
  <strong>Great!</strong> Member Deleted Succesfully.
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

              if(isset($_GET['update']) && $_GET['update']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Update.
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
  
  <strong>Opps!</strong>Failed to Delete staff, Because Data related to staff Exist in Transactions..!
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
             <div class="row clearfix col-md-12 col-lg-12">
                  <div class="search wow fadeInUp col-md-12 col-lg-12">
                    <form>
             <div class="row clearfix col-md-12 col-lg-12">
               
                  <div class="search wow fadeInUp col-md-6 col-lg-6">
                    <select class="form-control mb-3 show-tick select_group " name="branch" id="branch" onchange="get_staff();">

                                  <?php
                                           $sql="SELECT branch_id,created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                               }
                                            if($branch_id=='')
                                            {
                                              $sql="SELECT * FROM users where user_privilege='superadmin' or user_privilege='branch'"; 
                                              ?>
                                              <option value="">All</option>
                                              <?php
                                            }
                                            else
                                            {
                                              $sql="SELECT * FROM users where user_id='$userid'";
                                            }
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['user_id']==$branch)
                                            {
                                            echo "<option value=$row[user_id] selected>$row[user_name]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[user_id]>$row[user_name] </option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                                </select>
                  </div>
                  <div class="search wow fadeInUp col-md-6 col-lg-6">
                           

                                <input class="form-control" type="search" name="staff_name" id="staff_name" placeholder="SEARCH BY NAME.." onkeyup="get_staff();">
                                <!-- <input type="submit" value="submit" onclick="return false;"> -->
                            
                        </div>
                        
               </div> 
               </form>
                        </div>
               </div> 
            <div class="row clearfix" id="staff">

            </div>
    
</div>


<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
</body>
  <script type="text/javascript">
    get_staff();
    function get_staff()
    {
        var name = $("#staff_name").val();
         var branch = $("#branch").val();
        $.ajax({
                    url:"operations/get_staff.php",
                    method:"POST",
                    data:{name:name, branch:branch},
                    success:function(data) { 

                    $("#staff").empty();
                    $("#staff").html(data);
                    }
                   })
    }
  </script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/Sale's Men-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:14 GMT -->
</html>
