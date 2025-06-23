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
  border: none !important;
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

<!-- Page Loader -->
<!-- <div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Stock Tracking System</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Stock Tracking System </li>
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
                 <?php    
 // if($_POST){
  // print_r($_POST);
if($_POST)
{
 $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $brand=mysqli_real_escape_string($conn,$_POST['brand']);
  $cat=mysqli_real_escape_string($conn,$_POST['cat']);
  $items=mysqli_real_escape_string($conn,$_POST['items']);
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
  $zero=mysqli_real_escape_string($conn,$_POST['zero']);

  if($branch=='')
{
    $branch_name='All';

}
else
{
    $sql="SELECT user_name FROM users where user_id='$branch'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_name = $data['user_name'];
                          
                         }

}
}
else
{
    
    $cat = "All";
    $items = "All";
    $brand ="All";
    $branch=$userid;
    $branch_name='All';
    $f_date = date('Y-m-d');  
    $t_date = date('Y-m-d');
    $zero='1';


}

   ?>
   <br>
 <div class="row clearfix col-md-12 col-lg-12">
                  <div class="search wow fadeInUp col-md-12 col-lg-12">
                            <form>
                                <input type="search" name="item_identity" id="item_identity" placeholder="Search an Item through product name, Id,serial,barcode number and IMEI.." onkeyup="get_items_stock();">
                                <input type="submit" value="submit" onclick="return false;">
                            </form>
                        </div>
               </div> 
                         
                <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
              
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table m-b-0">
                                    <thead>
                                        <tr>
                                            <th>Product id#</th>                            
                                            <th>Product Name</th>                                      
                                            <th>Product Serial,barcode Or IMEI</th>
                                            <th>Stock Status</th>                                      
                                            <th>Branch</th>                                      
                                            <th>Purchase Price</th>
                                            <th>Sale Price</th>
                                        </tr>
                                    </thead>
                                    <tbody id="stock">
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                 
</div>
</div>

    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>


<script type="text/javascript">
$(document).ready(function() {
    // $(".select_group").select2();
    //       $('#example').DataTable({
    //   dom: 'Bfrtip',
    //   scrollY: true,
    //   scrollX: false,
    //   "paging":   false,
    //   "ordering": false,
    //   "info":     false,
    //   searching: true,
    //   buttons: [
        
    //       {
    //       extend: 'pdf',
    //       text: 'PDF',
    //       title: 'Alkareem (Stock Report)',
    //       orientation: 'landscape',
    //       text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
    //       pageSize: 'LEGAL',
    //       className: 'btn btn-danger',
    //       customize: function (doc) {
    //                     doc.content[1].table.widths = 
    //                         Array(doc.content[1].table.body[0].length + 1).join('*').split('');
    //                         doc.styles.tableHeader = {
                           
    //                        alignment: 'left'
    //                      }
    //                   }  
    //     },
    //     {
    //       extend: 'print',
    //       className: 'btn btn-success',
    //       titleAttr: 'print',
    //       text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
    //       title: 'Alkareem (Stock Report)',

          
    //     },


    //   ]


    // });
} );
</script>
  <script type="text/javascript">
    //get_items_stock();
    function get_items_stock()
    {

        var item_identity = $("#item_identity").val();
 
        $.ajax({
                    url:"operations/get_items_stock.php",
                    method:"POST",
                    data:{item_identity:item_identity},
                    success:function(data) { 
   
                    $("#stock").empty();
                    $("#stock").html(data);
                    }
                   })
    }
  </script>


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
