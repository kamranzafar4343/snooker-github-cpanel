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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Contact List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Contact</li>
                            <li class="breadcrumb-item active">Contact List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
              <?php
              
              if(isset($_GET['add']) && $_GET['add']=='done' || isset($_GET['update']) && $_GET['update']=='done'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
                <strong>Great!</strong> Contact Added Succesfully.
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

            
             <?php }
              

              if(isset($_GET['delete']) && $_GET['delete']=='done'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Contact Deleted.
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
                          <div class=" text-right">
                            
                              <a href="#">
                          <button  class="btn btn-success m-b-15" type="button"  data-toggle="modal" data-target=".bd-example-modal-xl" id="open_model">
                                <i class="icon wb-plus" aria-hidden="true"></i> Add Contact
                            </button>
                          </a>
                          <div class="modal bd-centered fade bd-example-modal-xl" tabindex="-1" role="dialog " aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="myModal">
                                  <div class="modal-dialog modal-lg">
                                    <form class="form" action="operations/add_contact.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-content" style="padding: 10px;">
                                        <div class="form-group row text-left">
                                      <label class="col-xl-12 col-lg-12 col-form-label ">Contact Name</label>
                                      <div class="col-lg-12 col-xl-12">
                                        <div class="input-group input-group-lg input-group-solid">
                                          <input type="text" class="form-control form-control-lg form-control-solid" name="contact_name" required="" />
                                        </div>
                                      </div>
                                    </div>
                                    <div class="form-group row text-left">
                                      <label class="col-xl-12 col-lg-12 col-form-label">Contact Number</label>
                                      <div class="col-lg-12 col-xl-12">
                                        <div class="input-group input-group-lg input-group-solid">
                                          <input type="text" class="form-control form-control-lg form-control-solid" id="contact_number"  placeholder="+9239999999999"   maxlength = "13" name="contact_number" required=""   />
                                        </div>
                                        <span>Make you to add number like +9239999999999</span>
                                      </div>
                                    </div>
                                    
                                        <div class="modal-footer">
                                         <button type="submit" class="btn btn-success" name="add_contact">Save</button>
                                         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                                    <a href="#">
                          <button  class="btn btn-info m-b-15" type="button"  data-toggle="modal" data-target=".bd-example-modal-xl-1" id="open_model_message">
                                <i class="icon wb-plus" aria-hidden="true"></i> Add Message
                            </button>
                          </a>
                          <div class="modal bd-centered fade bd-example-modal-xl-1" tabindex="-1" role="dialog " aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="open_model_message">
                                  <div class="modal-dialog modal-lg">
                                    <form class="form" action="operations/add_contact.php" method="post" enctype="multipart/form-data">
                                    <div class="modal-content" style="padding: 10px;">
                                        <div class="form-group row text-left">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Message</label>
                                            <div class="col-lg-12 col-xl-12">
                                              <div class="input-group input-group-lg input-group-solid">
                                                <textarea class="form-control form-control-lg form-control-solid" id="message" name="message" required=""  rows="2"></textarea>
                                             
                                              </div>
                                              <span>Write your message here.</span>
                                            </div>
                                          </div>
                                        <div class="modal-footer">
                                         <button type="submit" class="btn btn-success" name="add_message_main">Save</button>
                                         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </form>
                                  </div>
                                </div>
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                 <table class="table table-hover table-striped m-b-0 c_list" id="customersTable">
                                    <thead>
                                        
                                        <tr>
                                            
                                            <th>Sr</th>
                                            <th>Contact Name</th>
                                            <th>Contact Number</th>
                                            <th>Created Date</th>
                                            <?php if($c_write=='1'){?><th>Action</th><?php }?>
                                        </tr>
                                    </thead>
                                   <tbody>
                                     <?php
                                  $contact_count=0;
                                  $availability=mysqli_query($conn, "SELECT * FROM tbl_contacts WHERE created_by='$user_id'");
                                  while($data=mysqli_fetch_assoc($availability))
                                  {     
                                    $contact_count++;
                                    $contact_id  = $data['contact_id'];
                                    $contact_name  = $data['contact_name'];
                                    $contact_number  = $data['contact_number'];
                                    $from_date  = $data['created_date'];
                                    $fromTime = date('h:i A', strtotime($from_date));
                                    $fromDate=date('l', strtotime($from_date));
                                    $month = date('d F Y', strtotime($from_date));
                                    $messagesql=mysqli_query($conn, "SELECT * FROM tbl_message_main WHERE created_by='$user_id' order by message_id DESC");
                                    $data=mysqli_fetch_assoc($messagesql);
                                    $message  = $data['message'];
                                  
                                    ?>
                                  <tr style="border-bottom: 0.5px solid black;">
                                    <td class="pl-0">
                                      
                                      <span class="text-muted font-weight-bold d-block"><?php echo $contact_count;?></span>
                                    </td>
                                    <td class="pl-0">
                                      <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo $contact_name;?></span>
                                    </td>
                                    <td class="pl-0">
                                      <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo $contact_number;?></span>
                                    </td>
                                    <td class="pl-0">
                                      <span class="text-dark-75 font-weight-bolder d-block font-size-lg"><?php echo $fromDate." ,".$month."  ".$fromTime;?></span>
                                    </td>
                                    <td class="text-right pr-0">
                                      <a href="operations/add_contact.php?contact_id=<?php echo $contact_id;?>" class="btn btn-danger px-2 font-weight-light deleteUser" style="margin-bottom: 3px;">Remove</a>
                                       <a href="#" class="btn btn-success px-2 font-weight-light" style="margin-bottom: 3px;" data-toggle="modal" data-target=".bd-example-modal-xl<?php echo $contact_id;?>" id="open_model">Whatsapp</a>
                                      <div class="modal bd-centered fade bd-example-modal-xl<?php echo $contact_id;?>" tabindex="-1" role="dialog " aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="myModal">
                                        <div class="modal-dialog modal-lg">
                                          <form class="form" action="operations/add_contact.php" method="post" enctype="multipart/form-data">
                                          <div class="modal-content" style="padding: 10px;">
                                              <div class="form-group row text-left">
                                            <label class="col-xl-12 col-lg-12 col-form-label ">Contact Number</label>
                                            <div class="col-lg-12 col-xl-12">
                                              <div class="input-group input-group-lg input-group-solid">
                                                <input type="text" class="form-control form-control-lg form-control-solid" readonly="" name="contact_number" value="<?php echo $contact_number;?>" required="" />
                                                <input type="hidden" name="contact_id" value="<?php echo $contact_id;?>">
                                              </div>
                                            </div>
                                          </div>
                                          <div class="form-group row text-left">
                                            <label class="col-xl-12 col-lg-12 col-form-label">Message</label>
                                            <div class="col-lg-12 col-xl-12">
                                              <div class="input-group input-group-lg input-group-solid">
                                                <textarea class="form-control form-control-lg" id="message" name="message" required=""  rows="2"><?php echo $message;?></textarea>
                                             
                                              </div>
                                              <span>Write your message here.</span>
                                            </div>
                                          </div>
                                          
                                              <div class="modal-footer">
                                               <button type="submit" class="btn btn-success" name="add_message">Send</button>
                                               <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </form>
                                        </div>
                                      </div>
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
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>

    $("#contact_number").inputmask();

   </script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#customersTable').dataTable();
          $('#customersTable').on('click','.deleteUser',function(){
     

     var deleteConfirm = confirm("Are you sure you want to delete?");
     if (deleteConfirm == false) {
        return false;

     } 

  });
    });
    </script>




</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:03 GMT -->
</html>
