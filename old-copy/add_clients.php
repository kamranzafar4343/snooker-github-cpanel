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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left" ></i></a> Add Clients</h2>

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Clients</li>
                             <li class="breadcrumb-item active">Add</li>
                            

                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            <?php
            if(isset($_GET['sale_type']))
            {
                $sale_from=$_GET['sale_type'];
            }
            else
            {
                $sale_from=0;
            }
            ?>
              <?php
              

              if(isset($_GET['add']) && $_GET['add']=='successfull'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great!</strong> Client Added Succesfully.
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
  
  <strong>Opps!</strong> Client with Same CNIC already Exist.
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
                           
                            $customer_edit = mysqli_query($conn,"SELECT * FROM tbl_customer where customer_id='$edit_id'   ");
                                $row = mysqli_fetch_assoc($customer_edit);   
                               
                                    $email=$row['email'];
                                    $username=$row['username'];
                                 
                                    $mobile_no1=$row['mobile_no1'];
                                    $mobile_no2=$row['mobile_no2'];
                                    $address_permanent=$row['address_permanent'];
                                    $address_current=$row['address_current'];
                                    $address_office=$row['address_office'];
                                    $client_occupation=$row['client_occupation'];
                                    $client_residential=$row['client_residential'];
                                    $client_fathername=$row['client_fathername'];
                                    $gender=$row['gender'];
                                    $client_cnic=$row['client_cnic'];
                                    $user_profile=$row['user_profile'];
                                    $client_salary=$row['client_salary'];
                                    $zone=$row['zone'];
                                    $sub_zone=$row['sub_zone'];
                                    $customer_type=$row['customer_type'];
                                    $fixed_discount=$row['fixed_discount'];

                            ?>
                                <form action="operations/add_client.php" method="post"  enctype="multipart/form-data">
                            <div class="row clearfix">
                                  <div class="col-md-4 col-sm-12">
                                    <label>Client Name</label>
                                    <div class="form-group">                                   
                                        <input type="text" name="username" required=""  class="form-control" placeholder="Client Name *" value="<?php echo $username; ?>">
                                        <input type="hidden" name="sale_from" required=""  class="form-control" placeholder="Client Name *" value="<?php echo $sale_from; ?>">
                                    </div>
                                </div>
                              <!--  -->
                               <!--  <div class="col-md-4 col-sm-12">
                                  <label>Client Previous Acc #</label>
                                    <div class="form-group">
                                        <input type="text" name="email" required=""  class="form-control" placeholder="Email ID *" value="<?php echo $email; ?>">
                                    </div>
                                </div> -->
                                <div class="col-md-4 col-sm-12">
                                  <label>Client Phone 1</label>
                                    <div class="form-group">
                                        
                                        <input type="text" class="form-control"  name="mobile_no1" data-inputmask="'mask': '0399-99999999'"  type = "number" maxlength = "12" value="<?php echo $mobile_no1; ?>">
                                    </div>
                                </div>      
                        
                                <div class="col-md-4 col-sm-12">
                                  <label>Client Phone 2</label>
                                    <div class="form-group">
                                        
                                            <input type="text" class="form-control"  name="mobile_no2" data-inputmask="'mask': '0399-99999999'"   type = "number" maxlength = "12" value="<?php echo $mobile_no2; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <label>Client Gender</label>
                                    <div class="form-group">
                                         <select class="form-control" name="gender">
                                          <?php if($gender!=''){?><option><?php echo $gender; ?></option><?php }?>
                                          <option>Male</option>
                                          <option>Female</option>
                                          <option>Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <label>Client CNIC</label>
                                    <div class="form-group">
                            
                                         <input type="text"  name="client_cnic" class="form-control"   data-inputmask="'mask': '99999-9999999-9'"  placeholder="XXXXX-XXXXXXX-X"    value="<?php echo $client_cnic; ?>">
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <label>Client Father Name</label>
                                    <div class="form-group">                                   
                                        <input type="text" name="client_fathername"  class="form-control" placeholder="Client Father Name *" value="<?php echo $client_fathername; ?>">
                                    </div>
                                </div>
                              <!--  -->
                                <div class="col-md-4 col-sm-12">
                                  <label>Client Residential</label>
                                    <div class="form-group">
                                      <select class="form-control" name="client_residential" >
                                  
                                          <?php if($client_residential!=''){
                                            if($client_residential=='Personal'){?>
                                            <option><?php echo $client_residential; ?></option>
                                            <option>Rent</option>
                                            <option>Government</option>
                                        <?php }?>
                                        <?php if($client_residential=='Rent'){?>
                                            <option><?php echo $client_residential; ?></option>
                                            <option>Personal</option>
                                            <option>Government</option>
                                        <?php }?>
                                        <?php if($client_residential=='Government'){?>
                                            <option><?php echo $client_residential; ?></option>
                                            <option>Personal</option>
                                            <option>Rent</option>
                                        <?php } }else {?>
                                            <option>Personal</option>
                                          <option>Rent</option>
                                          <option>Government</option>
                                        <?php }?>
                                         
                                        </select>

                                      

                                    </div>
                                </div>    
                        
                                <div class="col-md-4 col-sm-12">
                                  <label>Client Occupation</label>
                                    <div class="form-group">
                                         <input type="text" name="client_occupation"   class="form-control" placeholder="Client Occupation *" value="<?php echo $client_occupation; ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <label>Client Salary</label>
                                    <div class="form-group">
                                         <input type="text" name="client_salary"   class="form-control" placeholder="Client Salary *" value="<?php echo $client_salary; ?>">
                                        
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" hidden>
                                  <label>Zone</label>
                                    <div class="form-group">
                                        <select class="form-control select_group" name="zone" id="zone_id" onchange="getsubzone();">
                                        <option selected="selected" value="">Choose one</option>
                                        <?php

                                        $sql="SELECT zone_name,zone_id  FROM tbl_zone where parent_zone_id=0"; 


                                        foreach ($conn->query($sql) as $row){

                                        if($row['zone_id']==$zone){

                                        echo "<option value=$row[zone_id] selected>$row[zone_name]</option>"; 

                                        }else{

                                        echo "<option value=$row[zone_id]>$row[zone_name]</option>"; 

                                        }

                                        }

                                         echo "</select>";
                                         ?>
                                        </select>
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                  <label>Client Type</label>
                                    <div class="form-group">
                                        <select class="form-control select_group" id="customer_type" name="customer_type" style="width:100%;" >
                                          <option>Choose Client Type</option>
                                          <?php
                                          
                                        $sql="SELECT type, type_id  FROM tbl_client_type"; 


                                        foreach ($conn->query($sql) as $row){

                                        if($row['type_id']==$customer_type){

                                        echo "<option value=$row[type_id] selected>$row[type]</option>"; 

                                        }else{

                                        echo "<option value=$row[type_id]>$row[type]</option>"; 

                                        }

                                        }

                                         echo "</select>";
                                       
                                         ?>

                                        </select> 
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label>Client Fixed Discount %</label>
                                    <div class="form-group">                                   
                                        <input type="text" name="fixed_discount"  class="form-control" placeholder="Client Fixed Discount % " value="<?php echo $fixed_discount; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12" hidden>
                                  <label>Sub Zone</label>
                                    <div class="form-group">
                                        <select class="form-control select_group" id="sub_zone" name="sub_zone" style="width:100%;" >
                                          <option>Choose Sub Zone</option>
                                          <?php
                                          if($edit_id){
                                        $sql="SELECT zone_name,zone_id  FROM tbl_zone where parent_zone_id!=0"; 


                                        foreach ($conn->query($sql) as $row){

                                        if($row['zone_id']==$sub_zone){

                                        echo "<option value=$row[zone_id] selected>$row[zone_name]</option>"; 

                                        }else{

                                        echo "<option value=$row[zone_id]>$row[zone_name]</option>"; 

                                        }

                                        }

                                         echo "</select>";
                                       }
                                         ?>

                                        </select> 
                                    </div>

                                </div>
                                 <div class="col-md-6 col-sm-12">
                                  <label>Client Permanent Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address_permanent"   class="form-control" placeholder="Client Permanent Address *" value="<?php echo $address_permanent; ?>">
                                         
                                    </div>

                                </div>
                                 <div class="col-md-6 col-sm-12">
                                  <label>Client Residential  Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address_current"   class="form-control" placeholder="Client Residential  Address *" value="<?php echo $address_current; ?>">
                                         <input type="hidden" name="edit_id" class="form-control"  value="<?php echo $edit_id; ?>">
                                    </div>

                                </div>
                                <div class="col-md-6 col-sm-12">
                                  <label>Client Office Address</label>
                                    <div class="form-group">
                                        <input type="text" name="address_office"   class="form-control" placeholder="Client Office Address *" value="<?php echo $address_office; ?>">
                                         
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

                            <button type="submit" name="addclients" class="btn btn-primary">Add</button>
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


   function getsubzone(){

                    var zone_id = $('#zone_id').val();

                      $.ajax({
                                  method: "POST",
                                  url: "operations/get_sub_zone.php",
                                  data: {zone_id:zone_id},
                                  dataType: 'json',                 
                                })
                                .done(function(response){
                       
                                   var len = response.length;

                                     $("#sub_zone").empty();
                                        for( var i = 0; i<len; i++){
                                            var zone_id = response[i]['zone_id'];
                                            var zone_name = response[i]['zone_name'];

                                            $("#sub_zone").append("<option value='"+zone_id+"'>"+zone_name+"</option>");

                                        }
                           
                                    
                                });


                }
</script>
</body>

</html>
