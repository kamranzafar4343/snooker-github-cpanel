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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Vendor Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Vendor Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header bg-secondary text-white">
                        <h4>Assign AVO</h4>
                    </div>
            

                         <form  action="operations/insert.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                                 <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">AVO</label>
                                  </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                         <input type="hidden" name="assign" id="assign" value="1">
                                    <select class="form-control mb-3 show-tick select2" name="avo_old" id="avo_old" onchange="get_accounts();" required="">
                                        <option value="">Select AVO</option>
                            <?php
                                           $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege=='superadmin' || $user_privilege=='branch')
                                {
                                 
                                  $sql="SELECT * FROM tbl_salesmen where  designation Like '%AVO%'";
                                }
                                else
                                {
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$created_by' and designation Like '%AVO%'";
                                }
                                             
                                            foreach ($conn->query($sql) as $row){
                                            
                                            echo "<option value=$row[s_id]>$row[username] ($row[designation])</option>"; 
                                            
                                            }

                                             echo "</select>";
                                             ?>
                        </select>
                                        </div>
                                          </div>
                                     </div>
                                     <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">AVO Accounts</label>
                                  </div>
                                  <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                         <select class="js-example-basic-multiple" id="accounts" name="accounts[]" multiple="multiple" style="width: 100%;" required="">
                                        <option value="">Select Account</option>
                                         
                                        </select>
                                     </div>
                                 </div>
                             </div>
                                     <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">Member to Assign </label>
                                  </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                    <select class="form-control mb-3 show-tick select2" name="avo_new" id="avo_new" required="">
                                        <option value="">Select Member</option>
                            <?php
                                           $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege=='superadmin' || $user_privilege=='branch')
                                {
                                  $sql="SELECT * FROM tbl_salesmen";
                                }
                                else
                                {
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$created_by'";
                                }
                                             
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$vendor)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username] ($row[designation])</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] ($row[designation])</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                        </select>
                                        </div>
                                          </div>
                                   
                                 </div>
                                 
                                      
                               
                          <div style="margin-right: 25%;" class="text-center">
                            <button style="width:25%; " type="submit" class="btn btn-primary submit" name="assign_avo">Assign</button>
                        </div>
                    </form>
                    </div>
                </div>
        
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                            <div class="card-header bg-secondary text-white">
                        <h4>Unassign AVO</h4>
                    </div>

            

                         <form  action="operations/insert.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                                 <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">Assigned Member </label>
                                  </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                        <input type="hidden" name="unassign" id="unassign" value="0">
                                    <select class="form-control mb-3 show-tick select2" name="avo_assigned" id="avo_assigned" required="" onchange="get_accounts_assigned();">
                                        <option value="">Select Member</option>
                            <?php
                                           $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege=='superadmin' || $user_privilege=='branch')
                                {
                                  $sql="SELECT * FROM tbl_salesmen";
                                }
                                else
                                {
                                  $sql="SELECT * FROM tbl_salesmen where created_by='$created_by'";
                                }
                                             
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$vendor)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username] ($row[designation])</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] ($row[designation])</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                        </select>
                                        </div>
                                          </div>
                                   
                                 </div>
                                     <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">Accounts</label>
                                  </div>
                                  <div class="col-md-5 col-sm-12">
                                        <div class="form-group">
                                         <select class="js-example-basic-multiple" id="accounts_unassign" name="accounts_unassign[]" multiple="multiple" style="width: 100%;" required="">
                                        <option value="">Select Account</option>
                                         
                                        </select>
                                     </div>
                                 </div>
                             </div>
                                     
                                 
                                      
                               
                          <div style="margin-right: 25%;" class="text-center">
                            <button style="width:25%; " type="submit" class="btn btn-primary" name="unassign_avo">Unassign</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
    
</div>


<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/easypiechart.bundle.js"></script> <!-- easypiechart Plugin Js -->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>


<script src="assets/fileinput/fileinput.min.js"></script>
<link href="assets/fileinput/fileinput.min.css" rel="stylesheet" />


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

  get_accounts();
            function get_accounts(){
              // alert("item");

    var avo=$('#avo_old').val();
   
      $.ajax({
                  method: "POST", 
                  url: "operations/get_accounts.php",
                  data: {avo:avo},
                  dataType: 'json', 
                  encode: true,                 
                })
                .done(function(response){
                   var len = response.length;
                 
                     $("#accounts").empty();
                      
                        for( var i = 0; i<len; i++){
                            var plan_id = response[i]['plan_id'];
                            var customer_detail = response[i]['customer_detail'];

                            $("#accounts").append("<option value='"+plan_id+"'>"+customer_detail+"</option>");

                        }
           
                    
                });
            }
             get_accounts_assigned();
            function get_accounts_assigned(){
              // alert("item");

    var avo_assigned=$('#avo_assigned').val();
   
      $.ajax({
                  method: "POST", 
                  url: "operations/get_accounts_assigned.php",
                  data: {avo_assigned:avo_assigned},
                  dataType: 'json', 
                  encode: true,                 
                })
                .done(function(response){
                   var len = response.length;
                   // alert(len)
                     $("#accounts_unassign").empty();
                      
                        for( var i = 0; i<len; i++){
                            var plan_id = response[i]['plan_id'];
                            var customer_detail = response[i]['customer_detail'];

                            $("#accounts_unassign").append("<option value='"+plan_id+"'>"+customer_detail+"</option>");

                        }
           
                    
                });
            }
                </script>
<script type="text/javascript">
  $(document).ready(function() {
    $(".select2").select2();



  });
    $('.submit').click(function(e){
    var avo_new= $("#avo_new").val();
    var avo_old= $("#avo_old").val();
 

    if(avo_old==avo_new)
    {
      alert('Please maker sure to choose different avo..');
      return false;
    }
    

});
$(document).ready(function() {
    $(".js-example-basic-multiple").select2({
    placeholder: " Select a Account ",
    allowClear: true
});
});

</script>

</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
