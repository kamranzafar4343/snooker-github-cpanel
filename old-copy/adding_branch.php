<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
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
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>
<!-- Overlay For Sidebars -->

<div id="wrapper">

    <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Add Branchs</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Branchs</li>
                            <li class="breadcrumb-item active">Add</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

             <div class="alert alert-success" id="success-alert" style="display: none;">
  
              <strong>Great!</strong> Branch Added Succesfully.
            </div>
            <div class="alert alert-danger" id="email-alert" style="display: none;">
  
              <strong>Ooops!</strong> Email Already Exist.
            </div>
            <div class="alert alert-danger" id="error-alert" style="display: none;">
  
              <strong>Ooops!</strong> Form Submit Error.
            </div>
              
       
  
  
    
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                            <?php
                            $edit_id=$_GET['edit_id'];
                           
                            $customer_edit = mysqli_query($conn,"SELECT * FROM tbl_vendors where v_id='$edit_id'   ");
                                $row = mysqli_fetch_assoc($customer_edit);   
                               
                                    $email=$row['email'];
                                    $username=$row['username'];
                                 
                                    $mobile_no=$row['mobile_no'];
                                    $user_profile=$row['user_profile'];
                                    $address=$row['address'];




                                    

                            ?>
                        <form action="operations/insert.php" method="post" id="form1" enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group">                                   
                                        <input type="text" name="branchname" id="branchname" required=""  class="form-control" placeholder="Branch Name *" value="">
                                     
                                    </div>
                                </div>
                                       
                                
                                 <div class="col-md-4 col-sm-12">
                                    <div class="form-group">                                   
                                        <input type="email" name="email" id="email" required=""  class="form-control email" placeholder="Email *" value="<?php echo $branchname; ?>">
                                       
                                    </div>
                                </div>
                                        
                              <!--  -->
                                 
                        
                                <div class="col-md-4 col-sm-12" hidden="">
                                    <div class="form-group">
                                        <input type="text" name="contact_no" id="contact_no" class="form-control calculate" minlength="10" maxlength="11" placeholder="Contact No" value="<?php echo $contact_no; ?>">
                                      
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12" hidden="">
                                    <div class="form-group">
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control calculate" minlength="10" maxlength="11" placeholder="Mobile No" value="<?php echo $mobile_no; ?>">
                                 
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12" hidden>
                                    <div class="form-group">
                                        <input type="text" name="owner_name" id="owner_name" class="form-control " placeholder="Owner Name" value="<?php echo $owner_name; ?>">
                                      
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="password" name="user_password" id="user_password" required="" class="form-control password" placeholder="Password" value="<?php echo $password;?>">
                                      
                                    </div>
                                </div>
                                  <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <input type="password" name="confirm_password" id="confirm_password" required="" class="form-control repeat" placeholder="Confirm Password" value="<?php echo $confirm_password;?>">
                                     

                                    </div>
                                </div>
                                   
                                <div class="col-md-8 col-sm-12">
                                    <div class="form-group">
                                        <input type="text" name="address" id="address" class="form-control" required="" placeholder="Address" value="<?php echo $address; ?>">
                                  
                                         <input type="hidden" name="edit_id" id="edit_id" class="form-control"  value="<?php echo $edit_id; ?>">
                                    </div>

                                </div>
                               

                                 
                                 
                                               
                            </div>
                   
                                   
                <button type="submit" name="signup_branch" id="signup_branch" class="btn btn-primary">Add</button>
                <button type="button"  class="btn btn-danger" onclick="GoBackWithRefresh();return false;">Back</button>

                        </div>
                        </form> 

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
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
  <script>      
        $(function() {

$("#signup_branch").click(function() {

var password = $(".password").val();
var repeat = $(".repeat").val();

if(password!=repeat)
{
    alert("Please make sure both passwords are same");
    $(".password").focus();
    return false;
}

    });
});
    var validateEmail = function(elementValue) {
    var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return emailPattern.test(elementValue);
}



$('.email').change(function() {

    var value = $(this).val();
    var valid = validateEmail(value);

    if (!valid) {


        $(this).css('color', 'red');
       alert('Please Enter valid Email..');
       $('.email').focus();
       $(".submit").hide();
      return false;


       
    } else {


        $(this).css('color', '#000');
        $(".submit").show();

    }
});
function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        window.location = document.referrer;
        /* OR */
        //location.replace(document.referrer);
    } else {
        window.history.back();
    }
}
</script> 
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
