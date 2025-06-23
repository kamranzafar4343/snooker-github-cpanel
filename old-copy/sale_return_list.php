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

   <?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Sale Return List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Sale Return</li>
                            <li class="breadcrumb-item active">Sale Return List</li>
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
  
  <strong>Great !</strong> Sale Return has been Added.
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
  
  <strong>Great !</strong> Sale Return has been Updated.
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
                         if(isset($_GET['delete']) && $_GET['delete']=='successful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Great !</strong> Sale Return has been Deleted.
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
              
                         if(isset($_GET['delete']) && $_GET['delete']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Sale Return Items are sold.
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
              
                        <div class="body project_report">
                             <?php if($s_write=='1'){?>
                          <div class=" text-right">
                              <a href="sale_return.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add/Edit Sale Return
                            </button>
                          </a>
                          <!-- <a href="sale_return_iemi.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add/Edit Sale Return (IEMI)
                            </button>
                          </a> -->

                          
                          </div>
                          <?php }?>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead >
                                  
                                        <tr>                                            
                                            <th>Sr #</th>
                                            <th>Sale #</th>
                                            <th>Customer Name</th>
                                            <th>Sale Type</th>
                                           
                                            <th>Net Amount</th>
                                      
                                             <th>Amount Returned</th>
                                            <th>Created by</th>
                                            <th>Created Date</th>

                                            <?php if($c_write=='1'){?>
                                            <th>Action</th>
                                             <?php }?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <?php
                                         $page_name=basename($_SERVER['PHP_SELF']);
                $base_page_name=explode('.', $page_name);
                $page=$base_page_name[0];
             
                $sql1=mysqli_query($conn,"SELECT page_id  FROM tbl_menu where page_link='$page'");
                $data = mysqli_fetch_assoc($sql1);
                $page_id=$data['page_id'];
      
                $query=mysqli_query($conn,"SELECT P, U, D  FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $P=$data['P'];
                $U=$data['U'];
                $D=$data['D'];
                                $count=0;
                                $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                 $sql = mysqli_query($conn,"SELECT * FROM tbl_sale_return order by sale_return_id asc");
                                }
                                else
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_sale_return where created_by='$userid' order by sale_return_id asc");
                           
                                }
                                    // $d_id=$_GET['d_id'];
                                
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $sale_id=$pdata['sale_id'];
                                    $customer_name=$pdata['customer_name'];
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['created_date'];
                                    $created_by=$pdata['created_by'];
                                    //$sale_type=$pdata['sale_type'];
                                    $amount_returned = $pdata['amount_returned'];
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_customer where customer_id='$customer_name'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername1=$cdata['username'];

                                   $query1 = mysqli_query($conn,"SELECT sale_type FROM tbl_sale where sale_id='$sale_id'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $sale_type=$cdata['sale_type'];

                                   $query1 = mysqli_query($conn,"SELECT invoice_no FROM tbl_sale_detail where sale_id='$sale_id'"); 
                          
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $invoice_no=$cdata['invoice_no'];

                                $date=date('Y-m-d');
                                    
                                    if($date >= $created_date  && $P!='1'){ 
                                        if($user_privilege=='superadmin')
                                        {
                                            $U=1;
                                            $D=1;
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
                                            <td class="project-title">
                                                <h6><?php echo $count;?></h6>
                                                
                                            </td>
                                            <td class="project-title">
                                                <h6><?php echo $invoice_no;?></h6>
                                                
                                            </td>
                                            
                                            <td><?php echo $customername1;?></td>
                                            <td><?php echo $sale_type;?></td>
                                            <td><?php echo $net_amount;?></td>
                                          
                                             <td><?php echo $amount_returned;?></td>
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $created_date;?></td>
                                        
                                            <td class="project-actions">
                                               
                                                <?php if($D=='1'){?>
                                                 <a <?php echo $display;?> href="operations/delete.php?sale_return_id=<?php echo $sale_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a> 
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
        "order": [[ 0, "desc" ]]
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
