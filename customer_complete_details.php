<!doctype html>
<html lang="en">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>

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

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">

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
                            <li class="breadcrumb-item">Customer Details</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
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
@media print {
  * {
    display: none;
  }
  #printableTable {
    display: block;
  }
   .head_det {
    display: block;
  }
}

</style> 
<body>
   <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: 30px;">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body"> 
                        <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1 class="text-center"><?php echo $c_name;?></h1>
                                    <h3  class="text-center">Customer Details</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix text-center col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>

                         

                        <div class="body">

                            <div class="row clearfix">
                                <div class="search wow fadeInUp col-md-6 col-lg-6">
                    <select class="form-control mb-3 show-tick select_group " name="branch" id="branch" onchange="get_client();">

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
                           

                                <input class="form-control" type="search" name="client_name" id="client_name" placeholder="SEARCH BY NAME.." onkeyup="get_client();">
                                <!-- <input type="submit" value="submit" onclick="return false;"> -->
                            
                        </div>
                        
               </div> 

                    </div>
                </div>
            </div>
        </div>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">

                                    <div class="row clearfix">
                                        <div class="col-md-12">
                                            
                                            <div class="table-responsive" id="printableTable">
                                                <div class="row head_det" style="display:none;">
                                            <div class="invoice-top clearfix col-md-12">

                                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                                    <h1 class="text-center">Customer Detail (<?php echo $c_name;?>)</h1>
                                                </div>

                                            </div>
                                              </div> 
                                               <table class="table-striped" style="width:100%" border="1" cellpadding="3">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                            <th>Customer #</th>
                                                            <th>Customer Name </th>
                                                            <th>Customer Number</th>
                                                            <th>Customer CNIC</th>           
                                                            <th>Repeated as Customer</th>
                                                            <th>Open Accounts (Sale ID)</th>
                                                            <th>Close Accounts (Sale ID)</th>
                                                            <th>Repeated as Guarantor</th>
                                                            <th>Guarantor Form ID</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="client_details">


                       
                                                    </tbody>
                                                </table>
                                                <iframe name="print_frame" width="0" height="0" frameborder="0" src="about:blank"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                   
                                    <div class="row clearfix">
                                     
                                        <div class="col-md-12 text-right">                                       
                                            <button class="btn btn-primary"onclick="printDiv()">Print</button>
                                        </div>                                    
                                    
                                    </div>                              
                                </div>  
                        
                            </div>   
                                    
                          
                           
                        </div>
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
      get_client();
    function get_client()
    {
        var name = $("#client_name").val();
        var branch = $("#branch").val();

        $.ajax({
                    url:"operations/get_client_detail.php",
                    method:"POST",
                    data:{name:name, branch:branch},
                    success:function(data) { 
                   
                    $("#client_details").empty();
                    $("#client_details").html(data);
                    }
                   })
    }
  </script>
<script type="text/javascript">
  function printDiv() {
         window.frames["print_frame"].document.body.innerHTML = document.getElementById("printableTable").innerHTML;
         window.frames["print_frame"].window.focus();
         window.frames["print_frame"].window.print();
       }
</script>
<script type="text/javascript">
$(document).ready(function() {
table.buttons('.buttonsToHide').nodes().addClass('hidden');
    $(".select_group").select2();
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: false,
      buttons: [
        {extend: "excel", className: "buttonsToHide"},
        {extend: "pdf", className: "buttonsToHide"},
        {extend: "print", className: "buttonsToHide"}
        ],


    });
} );
</script>


</html>
