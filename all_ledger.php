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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Customer Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Customer Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
            
            <div class="row clearfix">
                <div class="col-12">
                    <div class="card">
                                             <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Item Added Succesfully.
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
              
              if(isset($_GET['update']) && $_GET['update']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Item Updated Succesfully.
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
  
  <strong>Opps!</strong>Failed to Add Item.
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

              if(isset($_GET['data']) && $_GET['data']=='notfound'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry ! </strong>No Record Found !.
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

                         <form  action="get_ledger.php" method="post" enctype="multipart/form-data" id="form1">
                        <div class="body">

                   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                  <div class="alert alert-danger"   id="danger-alert1">
  
  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date !.
</div>           <div class="row clearfix">
                                <div class="col-md-2 col-sm-12  text-right">
                                         <label   for="description">From Date </label>
                           </div>
                              <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                  
    <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                                  <div class="row clearfix">
                                    <div class="col-md-2 text-right" >
                                         <label for="description">To Date </label>
                                    </div>
                              <div class="col-md-5 ">

                                    <div class="form-group">
                                <input type="date" class="form-control" name="t_date" id="t_date" placeholder="Item Name *" required="" value="<?php echo date('Y-m-d'); ?>">
                                    </div>
                                </div>
                            </div>
                                 <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">Ledger </label>
                                  </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                    <select class="form-control select_group" name="vendors" id='van_id' >
                                        <option value="All">All</option>
                                        <?php

                                
                                  $sql="SELECT left(acode,6) as acode,aname FROM tbl_account UNION SELECT acode,aname FROM tbl_account_lv2";
                                
                                        
                                    foreach ($conn->query($sql) as $row){
                                    echo "<option value=$row[acode]>$row[aname]</option>"; }
                                    echo "</select>";
                                     ?>
                                    </select>
                                        </div>
                                          </div>
                                     </div>
                                      
                               
                          <div style="margin-right: 25%;" class="text-center">
                            <button style="width:25%; " type="submit" class="btn btn-primary" name="purchase_rep" target='_blank'>Search</button>
                        </div>
                    </form>
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
  $(document).ready(function() {
    $(".select_group").select2();
    

    $("#addd_items").addClass('active');
    $("#items").addClass('active');
    
    var btnCust = '<button hidden type="button" class="btn btn-secondary" title="Add picture tags" ' + 
        'onclick="alert(\'Call your custom code here.\')">' +
        '<i class="glyphicon glyphicon-tag"></i>' +
        '</button>'; 
    $("#product_image").fileinput({
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
  $("#danger-alert1").hide();
  $("#form1").submit(function(e){
     var from = $("#f_date").val();
var to = $("#t_date").val();

if(Date.parse(from) > Date.parse(to)){
   e.preventDefault();
   // alert("Invalid Date Range");
     

    $("#danger-alert1").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert1").slideUp(500);
    });
  
   $("$f_date").focus();
    // return false;
    }
});
            function getitem(){
              // alert("item");

    var van_id = $('#van_id').val();
    // alert(van_id)
   
      $.ajax({
                  method: "POST", 
                  url: "operations/get_vendor_items.php",
                  data: {van_id:van_id},
                  dataType: 'json', 
                  encode: true,                 
                })
                .done(function(response){
                   var len = response.length;
                   // alert(len)
                     $("#item_id").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var item_name = response[i]['item_name'];

                            $("#item_id").append("<option value='Alll'>All Item</option><option value='"+id+"'>"+item_name+"</option>");

                        }
           
                    
                });


}
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
