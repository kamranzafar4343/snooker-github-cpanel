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
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>

   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Edit Installment</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Edit Installment</li>
                            <li class="breadcrumb-item active">Payed Installment List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                         <?php
              
              if(isset($_GET['added']) && $_GET['added']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Sale has been Added.
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
                         if(isset($_GET['updated']) && $_GET['updated']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Sale has been Updated.
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
                         if(isset($_GET['delete']) && $_GET['delete']=='done' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Installment Payment has been Deleted.
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
              
                         if(isset($_GET['Installment']) && $_GET['Installment']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Installment has been Recieved.
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
              
              if(isset($_GET['Installment']) && $_GET['Installment']=='completed' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Installment's are already Completed.
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
                        <div class="body project_report">
                            <?php
                $page_name=basename($_SERVER['PHP_SELF']);
                $base_page_name=explode('.', $page_name);
                $page=$base_page_name[0];
             
                $sql1=mysqli_query($conn,"SELECT page_id  FROM tbl_menu where page_link='$page'");
                $data = mysqli_fetch_assoc($sql1);
                $page_id=$data['page_id'];
      
                $query=mysqli_query($conn,"SELECT * FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $P=$data['P'];
                $U=$data['U'];
                $D=$data['D'];
                $W=$data['W'];
                if($userid=='1')
                {
                    $P=1;
                    $U=1;
                    $D=1;
                    $W=1;
                }
                                $plan_id=$_GET['planid'];
                                ?>
                      <div class=" text-right">
                              <a href="edit_installment.php?plan_id=<?php echo $plan_id;?>">
                              <button  class="btn btn-success m-b-15" type="button">
                                    <i class="icon-pencil" aria-hidden="true"></i> Edit Guarantor  
                                </button>
                              </a>
                              
                          
                          </div>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead >
                                  
                                        <tr>                                            
                                            <th>Sr #</th>
                                            <th>Customer Name</th>
                                            <th>Customer CNIC</th>
                                            <th>Installment Type</th>
                                           
                                            <th>Amount Recieved</th>
                             
                                            <th>Created by</th>
                                            <th>Created Date</th>
                                       
                                            <th>Action</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                
                                $count=0;
                                $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_installment_payment where plan_id='$plan_id' order by payment_id asc");
                                }
                                else
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_installment_payment where created_by='$userid' and plan_id='$plan_id' order by payment_id asc");
                                }
                                    // $d_id=$_GET['d_id'];
                                
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $plan_id=$pdata['plan_id'];
                                    $local=$pdata['local'];
                                    if($local=='1')
                                    {
                                      $type='Local';
                                    }
                                    else
                                    {
                                      $type='General';
                                    }
                                    
                                    $payment_id=$pdata['payment_id'];
                                    $customer=$pdata['customer'];
                                    $per_month_amount=$pdata['per_month_amount'];
                                    $created_date=$pdata['created_date'];
                                    $created_by=$pdata['created_by'];
                                    $sale_type=$pdata['sale_type'];
                                    $amount_recieved = $pdata['amount_recieved']+$pdata['down_payment'];
                                    $total_price = $pdata['total_price'];
                                    $installment_status = $pdata['installment_status'];
                                    $period = $pdata['period'];
                                    
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username,client_cnic FROM tbl_customer where customer_id='$customer'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername1=$cdata['username'];
                                   $customer_cnic=$cdata['client_cnic'];

                                   $query2 = mysqli_query($conn,"SELECT count(payment_id) as total_installment FROM tbl_installment_payment where plan_id='$plan_id'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query2) ;
                                   $total_installment=$cdata['total_installment'];
                                    $date=date('Y-m-d');
                                    
                                    if($date > $created_date  && $P!='1'){ 
                                        if($user_privilege=='superadmin')
                                        {
                                    
                                            $display="";
                                        }
                                        else
                                        {
                                            $display="hidden";
                                        }
                                    }
                                    else
                                    {
                                     $display="";
                                    }

                                  
                                ?>
                                        <tr>
                                            <td class="project-title" >
                                                <h6><?php echo $count;?></h6>
                                                
                                            </td>
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $customer_cnic;?></td>
                                            <td><?php echo $type;?></td>
                                           
                                            <td><?php echo $per_month_amount;?></td>
                            
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $created_date;?></td>
                                        
                                            <td class="project-actions">
                                                 <a href="single_inst_invoice.php?payment_id=<?php echo $payment_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-printer"></i></a>
                                                <?php if($U=='1'){?>
                                                <a <?php echo $display;?> href="installment_edit.php?editid=<?php echo $payment_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-pencil"></i></a>
                                                <?php }?>
                                                <?php if($D=='1'){?>
                                                <a <?php echo $display;?> href="operations/delete.php?paymentid=<?php echo $payment_id;?>&plan_id=<?php echo $plan_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                                 <?php }?>
                                                 <!--
                                                <a href="operations/delete.php?planid=<?php echo $plan_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" data-type="confirm"><i class="icon-trash"></i></a> -->
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

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js --> 

<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="assets_light/js/pages/ui/dialogs.js"></script>


<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable( {
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
