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
<script type="text/javascript">
    
</script>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Purchase List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Purchase</li>
                            <li class="breadcrumb-item active">Purchase List</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>  
                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                    <div class="card">
                         <?php
              if(isset($_GET['edit']) && $_GET['edit']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry  !</strong> Purchase Items already Sold.
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
              if(isset($_GET['added']) && $_GET['added']=='done' ){
                  ?>
                  <div class="alert alert-success" id="danger-alert">
  
  <strong>Great !</strong> Purchase has been Added.
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
  
  <strong>Great !</strong> Purchase has been Updated.
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
  
  <strong>Great !</strong> Purchase has been Deleted.
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
  
  <strong>Sorry  !</strong> Purchase can not be Deleted, Items from this PO have been Sold or trasnfered .
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
              
                         if(isset($_GET['updated']) && $_GET['updated']=='wrong' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry  !</strong> You might have entered wrong amount or amount greater than net amount.
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

              ?>
<?php 
if($_POST)
{
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $where_date='and DATE(invoice_date) between "'.$f_date.'" and "'.$t_date.'"';
}
else
{
    $f_date = date('Y-m-d');  
    $t_date = date('Y-m-d');
    $where_date='and DATE(invoice_date)=DATE(NOW())';
}
?>
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger"   id="danger-alert" style="display:none;">
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
                                </div>
                        <div class="body project_report">
                          <br>

                           <div  class="row">
                         
                          <div class="col-md-6 text-left">
                            <form  action="purchase_list.php" method="post" enctype="multipart/form-data" id='form1'>
                            <div class="row clearfix">
                              <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                              </div>
                              <div class="col-md-4 col-sm-12">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                              </div>
                            
                              <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                                  <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="purchase_rep" target='_blank'>Search</button>
                              </div>
                            </div>
                           </form>
                          </div>
                            <?php if($W=='1'){?>
                          <div class="col-md-6 text-right">
                            <!-- <a href="add_purchase_po.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Purchase PO (IEMI)
                            </button>
                          </a> -->
                         <!--  <a href="purchase_add.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Local Purchase
                            </button>
                          </a> -->
                        <!-- <a href="add_grn.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add GRN (IEMI)
                            </button>
                          </a> -->
                           <!-- <a href="edit_grn_iemi.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Edit GRN (IEMI)
                            </button>
                          </a> -->
                          <!-- <a href="add_po_payment.php">
                          <button  class="btn btn-danger m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i> Payment (IEMI)
                            </button>
                          </a> -->

                          <!-- <a href="add_pending_po_payment.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i> Pending Payment (IEMI)
                            </button>
                          </a> -->
                          <a href="purchase_po.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Purchase PO
                            </button>
                          </a>
                         <!--  <a href="purchase_add.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Local Purchase
                            </button>
                          </a> -->
                           <a href="grn.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add GRN
                            </button>
                          </a>
                          <!-- <a href="edit_grn.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Edit GRN
                            </button>
                          </a> -->

                          
                          
                          <a href="po_payment.php">
                          <button  class="btn btn-danger m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i> Payment
                            </button>
                          </a>

                          <a href="pending_po_payment.php">
                          <button  class="btn btn-warning m-b-15" type="button">
                                <i class="fa fa-usd" aria-hidden="true"></i> Pending Payment
                            </button>
                          </a>
                          </div>
                          <?php }?>
                        </div>
                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead>
                                      
                                        <tr>   
                                            <th>Sr #</th>                                         
                                            <th>Purchase #</th>
                                            <th>Invoice No</th>
                                            <th>Purchase Type</th>
                                            <th>Vendor Name</th>
                                            <th>Stock Status</th>
                                            <!-- <th>Payment Status</th> -->
                                            <th>Net Amount</th>
                                            
                                            <th>Discount</th>
                                            <!-- <th>Amount Payed</th> -->
                                            <th>Created by</th>
                                            <th>Created Date</th>
                                   
                                            <?php if($c_write=='1'){?>
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
                                 $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase where parent_id!='' $where_date order by purchase_id asc");
                                }
                                else
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase where created_by='$userid' $where_date order by purchase_id asc");
                           
                                }
                                
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $purchase_id=$pdata['purchase_id'];
                                    $iemi=$pdata['iemi'];
                                    $vendor_id=$pdata['vendor_id'];
                                    $net_amount=$pdata['net_amount'];
                                    $discount=$pdata['discount'];
                                    $created_date=$pdata['invoice_date'];
                                    $newDate = date("d-m-Y", strtotime($created_date));
                                    $created_by=$pdata['created_by'];
                                    $invoice_no=$pdata['invoice_no'];
                                    $amount_payed=$pdata['amount_payed'];
                                    $bill_status=$pdata['bill_status'];
                                    $remarks=$pdata['po_remarks'];
                                    $payment_status=$pdata['payment_status'];
                                    $amount_recieved = $pdata['amount_recieved'];
                                    $count++;
                                   $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];


                                   $query1 = mysqli_query($conn,"SELECT username FROM tbl_vendors where vendor_id=$vendor_id"); 
                                   
                                   $cdata = mysqli_fetch_assoc($query1) ;
                                   $customername=$cdata['username'];
                                    if($iemi)
                                    {
                                        $color="background-color: #abe0e3;";
                                        $type="IEMI";
                                        if($bill_status=='Pending' && $payment_status=='Pending')
                                        {
                                            $href="add_purchase_po.php";
                                        }
                                        if($bill_status=='Completed' && $payment_status=='Pending' && $amount_payed=='0')
                                        {
                                            $href="add_po_payment.php";
                                        }
                                        if($bill_status=='Completed' && $payment_status=='Pending' && $amount_payed!='0')
                                        {
                                            $href="add_pending_po_payment.php";
                                        }
                                        if($bill_status=='Completed' && $payment_status=='Completed')
                                        {
                                            $href="add_po_payment.php";
                                        }
                                        $invoice='purchase_invoice_iemi.php?purchase_id='.$purchase_id.'';
                                      
                                    }
                                    else
                                    {
                                       $color="background-color: white;";
                                       $type="POS Purchase";
                                       if($bill_status=='Pending' && $payment_status=='Pending')
                                        {
                                            $href="purchase_po.php";
                                        }
                                        if($bill_status=='Completed' && $payment_status=='Pending' && $amount_payed=='0')
                                        {
                                            $href="grn.php";
                                        }
                                        if($bill_status=='Completed' && $payment_status=='Pending' && $amount_payed!='0')
                                        {
                                            $href="pending_po_payment.php";
                                        }
                                        if($bill_status=='Completed' && $payment_status=='Completed')
                                        {
                                            $href="po_payment.php";
                                        }
                                       $invoice='purchase_invoice.php?purchase_id='.$purchase_id.'';
                                    }

                                    $date=date('Y-m-d');
                                    
                                    if($date > $created_date){ 
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
                                        <tr style="<?php echo $color;?>">
                                          <td><?php echo $count;?></td>
                                            <td class="project-title" >
                                                <h6><?php echo "Purchase_".$purchase_id;?></h6>
                                                
                                            </td>
                                            <td class="project-title" >
                                                <h6><?php echo $invoice_no;?></h6>
                                                
                                            </td>
                                              <td class="project-title" >
                                                <h6><?php echo $type;?></h6>
                                                
                                            </td>
                                          
                                            <td><?php echo $customername;?></td>
                                            <td><span class="badge badge-success"><?php echo $bill_status;?></span></td>
                                            <!-- <td><span class="badge badge-info"><?php echo $payment_status;?></span></td> -->
                                            <td><?php echo $net_amount;?></td>
                                            <td><?php echo $discount;?></td>
                                            <!-- <td><?php echo $amount_payed;?></td> -->
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                           
                                             <?php if($p_write=='1'){?>
                                            <td class="project-actions">
                                                <?php if($U=='1'){?>
                                                 <a <?php echo $display;?> href="<?php echo $href;?>?edit_id=<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-danger" title="Edit"><i class="icon-pencil"></i></a>
                                                  <?php }?>
                                                 <?php if($remarks!=''){?>
                                                 <a href="#" data-toggle="modal" data-target="#remarks<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-success" title="Remarks"><i class=" icon-envelope-open"></i></a>
                                             <?php }?>
                                                 <div id="remarks<?php echo $purchase_id;?>" class="modal fade" role="dialog">
                                              <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                
                                                  <div class="modal-body">
                                                    <form action="operations/purchase_edit.php" method="post" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-12">
                                                            
                                                               <p class="m-b-0 m-t-25">Remarks : <?php echo $remarks;?></p>  
                                                            </div> <!-- end col -->

                                                        </div> <!-- end row -->   <hr>
                                                        <button type="button"  class="btn btn-danger text-center" data-dismiss="modal" id="docmode">Close</button>                                          
                                                    </form>      
                                                  </div>
                                                </div>
                                            </div>
                                        </div>
                                                <a href="<?php echo $invoice;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                                <a href="grn_document.php?purchase_id=<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-primary" title="Documents"><i class="icon-paper-clip"></i></a>
                                                <!-- <a <?php echo $display;?> href="<?php echo $href;?>?edit_id=<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-success"><i class="icon-pencil"></i></a> -->
                                                <?php if($D=='1'){?>
                                                <a <?php echo $display;?> href="operations/delete.php?purchase_id=<?php echo $purchase_id;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                                <?php }?>
                                            </td>
                                          <?php }?>
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
<script type="text/javascript">
  
  $("#form1").submit(function(e){
    var from = $("#f_date").val();
    var to = $("#t_date").val();

if(Date.parse(from) > Date.parse(to)){

   e.preventDefault();
    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
    }
});

</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
