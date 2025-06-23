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
<?php
include "includes/loader.php";

?>

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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Designation List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Designation</li>
                            <li class="breadcrumb-item active">Designation List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                             <?php
              

              if(isset($_GET['delete']) && $_GET['delete']=='successful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great ! </strong>Designation Deleted Successfully.
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
              
              if(isset($_GET['insert']) && $_GET['insert']=='successful' || isset($_GET['update']) && $_GET['update']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Designation Added Succesfully.
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

              if(isset($_GET['insert']) && $_GET['insert']=='unsuccessful' || isset($_GET['update']) && $_GET['update']=='unsuccessful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Add Brand.
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
  
  <strong>Opps!</strong>Failed to Delete Brand, Because Data related to brand Exist in Transactions..!
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
                            <?php if($c_write=='1'){?>
                              <div class="text-right">
                              
                          <button  class="btn btn-success m-b-15" type="button" data-toggle="modal" data-target="#desgmodel">
                                <i class="icon wb-plus" aria-hidden="true"></i> Add Designation
                            </button>
                        
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom table-striped m-b-0 c_list">
                                    <thead>
                                      
                                        <tr>
                                            
                                            <th>Sr</th>
                                           
                                            <th>Designation Name</th>
                                            
                                            <th>Created Date</th>
                                         
                                            <?php if($c_write=='1'){?><th>Action</th><?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_designation ");
                        $count=0;
                        while($data=mysqli_fetch_assoc($sql))
                        {

                        $designation_id = $data['designation_id'];
                        $designation_name = $data['designation_name'];
                        
                        $created_date = $data['created_date'];
                        $newDate = date("d-m-Y", strtotime($created_date));
                        $count++;

                        ?>
                                        <tr>
                                            <td><span><?php echo $count;?></span></td>
                                            
                                            
                                            <td><span><?php echo $designation_name;?></span></td>
                                            <td><span><?php echo $newDate;?></span></td>
                                          <?php if($c_write=='1'){?>
                                            <td>
                                                <a href="#"><button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#desg<?php echo $designation_id;?>" title="Edit"><i class="fa fa-edit"></i></button></a>

                                                <div id="desg<?php echo $designation_id;?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                
                                                  <div class="modal-body">
                                                    <form action="operations/insert.php" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-12">
                                                               
                                              
                                                                <div class="form-row">
                                                             
                                                                    
                                                                 
                                                                   
                                                                    <input type="hidden" name="designation_id" value="<?php echo $designation_id;?>" />
                                                                 
                                                                    <div class="form-group col-md-12"> 
                                                                        <label for="inputState" class="col-form-label"> Designation Name</label>
                                                                        <input type="text"  class="form-control normal"  name="designation_name" style="text-transform:uppercase" id="designation_name" value="<?php echo $designation_name;?>">
                                                     
                                                                    </div>
                                                                   
                                                                                                                                    
                                                                </div>
                                                               
                                                             
                                                                <input type="submit"  class="btn btn-primary" name="designation" id="submit" value="Save"/>
                                                                <button type="button"  class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button> 
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                            
                                                    </form>
      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                                <a href="operations/delete.php?designation_id=<?php echo $designation_id;?>"><button type="button" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="fa fa-trash-o"></i></button></a>
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

<div class="modal fade" id="desgmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
  
      <div class="modal-content">

        
        <!-- Modal body -->
        <div class="modal-body">
           <form action="operations/insert.php" method="post" enctype="multipart/form-data">
                                               
                                                        <div class="row">
                                                            <div class="col-12">
                                                               
                                              
                                                                <div class="form-row">
                                                             
                                                                    <div class="form-group col-md-12"> 
                                                                        <label for="inputState" class="col-form-label"> Designation Name</label>
                                                                        <input type="text"  class="form-control normal"  name="designation_name" style="text-transform:uppercase" id="designation_name">
                                                     
                                                                    </div>
                                                                   
                                                                                                                                    
                                                                </div>
                                                               
                                                             
                                                                <input type="submit"  class="btn btn-primary" name="designation" id="submit" value="Save"/>
                                                                <button type="button"  class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button> 
                                                            </div> <!-- end col -->
                                                        </div> <!-- end row -->
                                            
                                        </form>

        </div>

        
      </div>
    </div>
  </div>
<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
