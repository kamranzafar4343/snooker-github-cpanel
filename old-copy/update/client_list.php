<?php 
require_once 'includes/config.php'; 
 error_reporting(0);
include "includes/session.php";

include "includes/head.php";
include "user_permission.php";
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
<style type="text/css">
  .webgrid-table-hidden
{
    display: none;
}
</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Client List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Client List</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12">
                   <?php
              
              if(isset($_GET['add']) && $_GET['add']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Client Added Succesfully.
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
  
  <strong>Sorry!</strong> Client Not Added.
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
  
  <strong>Great!</strong> Client Updated Succesfully.
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
             
                      if(isset($_GET['delete']) && $_GET['delete']=='successfull' ){
                  ?>
                  <div class="alert alert-danger" id="success-alert">
  
  <strong>Great!</strong> Client Deleted Succesfully.
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
  
  <strong>Opps!</strong>Failed to Delete Customer, Because Data related to Customer Exist in Transactions..!
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
              

              if(isset($_GET['blocked']) && $_GET['blocked']=='successful'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Well !</strong> Customer has been Blocked!
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
              

              if(isset($_GET['unblocked']) && $_GET['unblocked']=='successful'){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Customer has been Unblocked!
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
                    <div class="card">
                      <div class="body">
                         <?php if($c_write=='1'){?>
                          <div class=" text-right">
                            
                              <a href="add_clients.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="icon wb-plus" aria-hidden="true"></i> Add Customer
                            </button>
                          </a>
                          
                          </div>
                          <?php }?>
                <div class="table-responsive">


        
        <table class="table table-hover table-striped m-b-0 c_list" id="customersTable" style="width: 100%">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">ID</th>
                <th scope="col">Name</th>
                <th scope="col">Mobile</th> 
                <th scope="col">Address</th> 
                <th scope="col">Opening Balance</th>
                <th scope="col">Created By</th>
                <th scope="col">Created Date</th>
                <th scope="col" class="text-right">Action</th> 
                <!--    -->
                                                                 

            </tr>
        </thead>
      </table>
       
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

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/pages/tables/jquery-datatable.js"></script>
<script src="assets_light/js/pages/ui/dialogs.js"></script>
<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        $('#customersTable').dataTable({
            dom: 'Bfrtip',
            select: true,  

            buttons: [
            {
                extend: 'print',
                text: '<?php echo $c_name;?>',
           
                title: '<?php echo $c_name;?> (Client List)',
                 
                
                text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>',
                
                className: 'btn btn-success',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      },
               
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5],
                    modifier: {
                        selected: null
                       
                    }
                }

            },
           
            {
                extend: 'pdf',
                 text: '<?php echo $c_name;?>',
           
                title: '<?php echo $c_name;?> (Client List)',
                 
                
                text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
                
                className: 'btn btn-danger',
          
                     customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      },
                exportOptions: {
                  columns: [ 1, 2, 3, 4, 5],
                    modifier: {
                        selected: null

                    }
                }
            },
            
        ],
                  
            "ajax": "get_client.php",
            "columns": [
                {data: 'count'},
                {data: 'customer_id'},
                {data: 'customer_name'},
                {data: 'mobile_no'},
                {data: 'address'},
                {data: 'opening'},
                {data: 'created_by'},
                {data: 'created_date'},
                {data: 'action'}
            ],
         
        });
     $('#customersTable').on('click','.deleteUser',function(){
     

     var deleteConfirm = confirm("Are you sure you want to delete?");
     if (deleteConfirm == false) {
        return false;

     } 

  });
$('#customersTable').on('click','.BlockUser',function(){
     

     var deleteConfirm = confirm("Are you sure you want to Block?");
     if (deleteConfirm == false) {
        return false;

     } 

  });
$('#customersTable').on('click','.UnBlockUser',function(){
     

     var deleteConfirm = confirm("Are you sure you want to Unblock?");
     if (deleteConfirm == false) {
        return false;

     } 

  });
    });
    </script>

