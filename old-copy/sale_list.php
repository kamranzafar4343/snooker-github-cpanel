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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Sale List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Sale</li>
                            <li class="breadcrumb-item active">Sale List</li>
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
  
  <strong>Great !</strong> Sale has been Deleted.
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
              
                         if(isset($_GET['updated']) && $_GET['updated']=='fail' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Return has been Added against this sale.
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
                
                       


                $sql="SELECT branch_id,user_privilege,created_by  FROM users where user_id='$userid'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $privilige = $data['user_privilege'];
                          $created_by = $data['created_by'];
                          $branch_id = $data['branch_id'];
                         }
               $sql=mysqli_query($conn, "SELECT branch_id, created_by  FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($sql);
                                $branch_id=$data['branch_id'];
                                $created=$data['created_by'];

                                if($branch_id=='')
                                {
                                  $parent_id=$created;
                                }
                                else
                                {
                                  $parent_id=$userid;
                                }
      
             
                  $sql7=mysqli_query($conn, "SELECT  target FROM `tbl_branch_target` WHERE branch_id='$userid'");

                  $data7=mysqli_fetch_assoc($sql7);
                  $target = $data7['target'];
             
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as sale FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300') and parent_id='$parent_id' and MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                  $data3=mysqli_fetch_assoc($sql3);
                  $sale = $data3['sale'];

                 if($sale>=$target && $branch_id!='')
                 {
                    $hidden="hidden";
                    $alert_show="";

                 }
                 else if($branch_id=='' && $created=='1')
                 {
                    
                    $hidden="";
                    $alert_show="hidden";
                 }
                else
                {
                    $hidden="";
                    $alert_show="hidden";
                }


              ?>
             
                  <div class="alert alert-danger" id="danger-alert" <?php echo  $alert_show;?>>
  
  <strong>Sorry !</strong> Target Completed request for new sale target.
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
  
                        <div class="body project_report">
                             <?php if($W=='1'){?>
                          <div class=" text-right" <?php echo  $hidden;?>>
                            <!-- <a href="add_sale.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Sale
                            </button>
                            </a>  -->
                            <a href="add_sale_iemi.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Sale (IEMI)
                            </button>
                            </a> 
                          <a href="add_local_sale.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Local Sale
                            </button>
                          </a>
                          <a href="add_local_sale_iemi.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Local Sale (IEMI)
                            </button>
                          </a>
                        
                          
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead >
                                  
                                        <tr>                                            
                                            <th >Invoice #</th>
                                            <th>Location</th>
                                            <th>Customer Name</th>
                                            <th>Sale Type</th>
                                         
                                            <th>Net Amount</th>
                                            <th>Discount</th>
                                            <th>Amount Recieved</th>
                                            <th>Created by</th>
                                            <th>Created Date</th>
                                            <?php if($s_write=='1'){?>
                                            <th>Action</th>
                                             <?php }?>
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
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_sale where pos='0' order by sale_id asc");
                                }
                                else
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_sale where pos='0' and created_by='$userid' order by sale_id asc");
                                }
                                    // $d_id=$_GET['d_id'];
                                
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $sale_id=$pdata['sale_id'];
                                    $sale_invoice="Sale_".$sale_id;
                                    $customer_name=$pdata['customer_name'];
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['created_date'];
                                    $created_by=$pdata['created_by'];
                                    $sale_type=$pdata['sale_type'];
                                    $iemi=$pdata['iemi'];
                                    $local=$pdata['local'];
                                    
                                    $amount_recieved = $pdata['amount_recieved'];
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_customer where customer_id='$customer_name'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername1=$cdata['username'];
                                    if($iemi=='0' && $local=='1')
                                    {
                                        $color="background-color: white;";
                                        $href="add_local_sale.php";
                                    }
                                    else if($iemi=='1' && $local=='1')
                                    {
                                       $color="background-color: #abe0e3;";
                                       $href="add_local_sale_iemi.php";
                                    }
                                    else if($iemi=='1' && $local=='0')
                                    {
                                       $color="background-color: #abe0e3;";
                                       $href="add_sale_iemi.php";
                                    }
                                    else if($iemi=='0' && $local=='0')
                                    {
                                       $color="background-color: white;";
                                       $href="add_sale.php";
                                    }
                                    
                                    $date=date('Y-m-d');
                            
                                    if($date > $created_date && $P!='1'){ 
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
                                        <tr style="<?php echo $color;?>">
                                            <td class="project-title" >
                                                <h6><?php echo $sale_invoice;?></h6>
                                                
                                            </td>
                                            <td><?php echo $user_name;?></td>
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $sale_type;?></td>
                                   
                                            <td><?php echo $net_amount;?></td>
                                            <td><?php echo $discount;?></td>
                                             <td><?php echo $amount_recieved;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $created_date;?></td>
                                        
                                            <td class="project-actions">
                                                <a  href="sale_invoice.php?sale_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                              <?php if($U=='1'){?>
                                                <a <?php echo $display;?> href="<?php echo $href;?>?edit_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a>
                                                <?php }?>
                                                <?php if($D=='1'){?>
                                                
                                                <a  <?php echo $display;?>  href="operations/delete.php?sale_id=<?php echo $sale_id;?>&sale_type=<?php echo $sale_type;?>" class="btn btn-sm btn-outline-danger js-sweetalert" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                                <?php }?>
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
        "order": [[ 8, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
