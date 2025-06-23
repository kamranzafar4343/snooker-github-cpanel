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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left" ></i></a> Add Staff Members</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Staff Men</li>
                             <li class="breadcrumb-item active">Add</li>
                            

                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>
        
              <?php
              

              if(isset($_GET['add']) && $_GET['add']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great!</strong> Staff Member Added Succesfully.
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
    <?php }?>
              <?php
              

              if(isset($_GET['record']) && $_GET['record']=='exist' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong> Staff Member with Same CNIC already Exist.
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
    <?php }?>
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="body">
                            <?php
                            $edit_id=$_GET['edit_id'];
                           
                            $customer_edit = mysqli_query($conn,"SELECT * FROM tbl_salesmen where s_id='$edit_id'   ");
                                $row = mysqli_fetch_assoc($customer_edit);   
                               
                                    $email=$row['email'];
                                    $username=$row['username'];
                                 
                                    $mobile_no1=$row['mobile_no1'];
                                    $mobile_no2=$row['mobile_no2'];
                                    $address_permanent=$row['address_permanent'];
                                    $address_current=$row['address_current'];
                               
                                    $salemen_residential=$row['salemen_residential'];
                                    $salemen_fathername=$row['salemen_fathername'];
                                    $gender=$row['gender'];
                                    $salemen_cnic=$row['salemen_cnic'];
                                    $user_profile=$row['user_profile'];
                                    $designation=$row['designation'];
                                    $designation = explode(",", $designation);
                                        if (in_array("MO", $designation))
                                          {
                                            $MO='1';
                                          }
                                        if(in_array("AVO", $designation))
                                          {
                                            
                                            $AVO='1';
                                          }
                                        if(in_array("GM", $designation))
                                          {
                                            $GM='1';
                                          }
                                        if(in_array("BM", $designation))
                                          {
                                            $BM='1';
                                          }
                                        if(in_array("SRO", $designation))
                                          {
                                            $SRO='1';
                                          }
                                        if(in_array("SALESMAN", $designation))
                                          {
                                            $Salesman='1';
                                          }
                                    
                                    $salary=$row['salary'];

                            ?>
                                <form action="operations/add_salesmen.php" method="post"  enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-md-6 col-sm-12">
                                    <label>Member Name</label>
                                    <div class="form-group">                                   
                                        <input type="text" name="username" required=""  class="form-control" placeholder="Member Name *" value="<?php echo $username; ?>">
                                    </div>
                                </div>
                              <!--  -->
                                <div class="col-md-4 col-sm-12" hidden="">
                                  <label>Member Email</label>
                                    <div class="form-group">
                                        <input type="text" name="email"   class="form-control" placeholder="Email ID *" value="<?php echo $email; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" style="padding-top: 32px; padding-right: 10px;">
                                    <?php
                                    $sql=mysqli_query($conn, "SELECT * FROM tbl_designation");
                                    
                                    while($data=mysqli_fetch_assoc($sql))
                                    {

                                    $designation_id = $data['designation_id'];
                                    $designation_name = $data['designation_name'];
                                    ?>
                                        <label><?php echo $designation_name;?></label>
                                            <label class="fancy-checkbox">
                                                <input class="checkbox-tick" name="designation[]" type="checkbox" value="<?php echo $designation_name;?>" <?php if(in_array($designation_name, $designation)==$designation_name){?>checked="checked"<?php }?>>

                                                <span></span>
                                            </label>
                                       
                                    <?php }?>
                                </div>
                                    <div class="col-md-2 col-sm-12">
                                  <label>Member Salary</label>
                                    <div class="form-group">
                                        
                                            <input type="text" class="form-control"  name="salary"   type = "text" maxlength = "7" value="<?php echo $salary; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <label>Member Phone 1</label>
                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control"  name="mobile_no1" data-inputmask="'mask': '0399-99999999'" required=""  type = "number" maxlength = "12" value="<?php echo $mobile_no1; ?>">
                                    </div>
                                </div>      
                        
                                <div class="col-md-4 col-sm-12">
                                  <label>Member Phone 2</label>
                                    <div class="form-group">
                                        
                                            <input type="text" class="form-control"  name="mobile_no2" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $mobile_no2; ?>">
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12">
                                  <label>Member Gender</label>
                                    <div class="form-group">
                                         <select class="form-control" name="gender" >
                                          <?php if($gender!=''){?><option><?php echo $gender; ?></option><?php }?>
                                          <option>Male</option>
                                          <option>Female</option>
                                          <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                            
                                <div class="col-md-4 col-sm-12">
                                  <label>Member CNIC</label>
                                    <div class="form-group">
                            
                                         <input type="text"  name="salemen_cnic" class="form-control" data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"   required="" value="<?php echo $salemen_cnic; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label>Member Father Name</label>
                                    <div class="form-group">                                   
                                        <input type="text" name="salemen_fathername"   class="form-control" placeholder="Member Father Name *" value="<?php echo $salemen_fathername; ?>">
                                    </div>
                                </div>
                              <!--  -->
                                <div class="col-md-4 col-sm-12">
                                  <label>Member Residential</label>
                                    <div class="form-group">
                                      <select class="form-control" name="salemen_residential">
                                        <?php if($salemen_residential!=''){
                                         if($salemen_residential=='Personal'){?>
                                            <option><?php echo $salemen_residential; ?></option>
                                            <option>Rent</option>
                                        <?php }?>
                                        <?php if($salemen_residential=='Rent'){?>
                                            <option><?php echo $salemen_residential; ?></option>
                                            <option>Personal</option>
                                        <?php } } else{?>
                                            <option>Personal</option>
                                          <option>Rent</option>
                                        
                                        <?php }?>
                                          
                                        </select>
                                      

                                    </div>
                                </div>    
                        
                               <!--  <div class="col-md-4 col-sm-12">
                                  <label>Sale's Men Occupation</label>
                                    <div class="form-group">
                                         <input type="text" name="salemen_occupation" required=""  class="form-control" placeholder="Sale's Men Occupation *" value="<?php echo $salemen_occupation; ?>">
                                        
                                    </div>
                                </div> -->
                                 <div class="col-md-6 col-sm-12">
                                  <label>Member Permanent Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address_permanent"   class="form-control" placeholder="Member Permanent Address *" value="<?php echo $address_permanent; ?>">
                                         
                                    </div>

                                </div>
                                 <div class="col-md-6 col-sm-12">
                                  <label>Member Current Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address_current"  class="form-control" placeholder="Member Current Address *" value="<?php echo $address_current; ?>">
                                         <input type="hidden" name="edit_id" class="form-control"  value="<?php echo $edit_id; ?>">
                                    </div>

                                </div>
                                
                                 <div class="col-md-8 col-sm-12">
                                      <label for="user_profile">Image</label>
                                    <div class="kv-avatar">
                                        <div class="file-loading">
                                            <input id="user_profile" name="user_profile" type="file">
                                        </div>
                                    </div>
                                </div>
                               
                                <?php if($edit_id !='') {
                                    if($user_profile=='')
                                                    {
                                                        $user_profile='assets/images/userdefault.jpg';
                                                    }
                                                    else
                                                    {
                                                        $user_profile=$user_profile;
                                                    }?>
                                <div class="col-md-4 col-sm-12">
                                    <p>Current Image is</p>
                                    <div class="user_profile"> <img style="height: 20%; width: 20%;" src="<?php echo $user_profile; ?>" class="square-circle" alt="" > </div>
                                </div>     
                                <?php }?>              
                              
                                   
                             

                                 
                                 
                                               
                            </div>
                            <br>

                            <button type="submit" name="add_salemen" class="btn btn-primary submit">Add</button>
                            <button type="button" class="btn btn-danger" onclick="goBack()">Back</button>

                        </div>
                        </form> 

                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
<script>
    $(":input").inputmask();

   </script>
<!-- Javascript -->
<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>

<script src="assets/fileinput/fileinput.min.js"></script>
<link href="assets/fileinput/fileinput.min.css" rel="stylesheet" />
 <script>
function goBack() {
  window.history.back();
}
</script> 
<script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select_group").select2();
    

    $("#addd_items").addClass('active');
    $("#items").addClass('active');
    
    var btnCust = '<button hidden type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#user_profile").fileinput({
        overwriteInitial: true,
        maxFileSize: 1500,
        showClose: false,
        showCaption: false,
        browseLabel: '',
        removeLabel: '',
        browseIcon: 'Add Image',
        removeIcon: 'Remove Image',
        removeTitle: 'Cancel or reset changes',
        elErrorContainer: '#kv-avatar-errors-1',
        msgErrorClass: 'alert alert-block alert-danger',
        // defaultPreviewContent: '<img src="/uploads/default_avatar_male.jpg" alt="Your Avatar">',
        layoutTemplates: {main2: '{preview} ' +  btnCust + ' {remove} {browse}'},
        allowedFileExtensions: ["jpg", "png", "gif"]
    });

  });
</script>
<script type="text/javascript">
    $(function() {
$(".submit").click(function() {

   if($("input[type='checkbox']:checked").length == 0)
   {
    alert('Please Select atleast one Designation..!');
    return false;
   }


});
});
</script>
</body>

</html>
