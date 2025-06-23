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
 <style type="text/css">
     .card-header
     {
        border-bottom: 1px solid black !important;
     }
     @media print {
  .nodisplay {
    display: none;
  }
}
 </style>
<?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>

    <div id="main-content">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">                        
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Vouchers List</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Vouchers</li>
                            <li class="breadcrumb-item active">Vouchers List</li>
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
  
  <strong>Great !</strong> Payment has been Added.
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
  
  <strong>Great !</strong> Payment has been Updated.
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
  
  <strong>Great !</strong> Payment has been Deleted.
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
                
                $query=mysqli_query($conn,"SELECT P, U, D, W  FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
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
                        
                        <div class="body project_report">
                            
                             <div class=" text-right">
                                <?php if($userid=='1'){?>
                            <?php 
                            if(isset($_GET['branch_id']))
                            {
                                $branch_id=$_GET['branch_id'];
                                
                            }
                            else
                            {
                                $branch_id='1';
                               
                            }
                            ?>
                            
                            <?php
                            $sql=mysqli_query($conn, "SELECT * FROM users where user_privilege='branch' or user_privilege='superadmin' order by user_id asc");
                            $count=0;
                            while($data=mysqli_fetch_assoc($sql))
                            {
                                if($branch_id==$data['user_id'])
                                {
                                    $color="btn-success";
                                }
                                else
                                {
                                     $color="btn-secondary";
                                }
                                ?>

                              <a href="add_payment.php?branch_id=<?php echo $data['user_id'];?>">
                              <button  class="btn <?php echo $color;?> m-b-15" type="submit" name='branch'>
                                    <i class="icon wb-plus" aria-hidden="true"></i><?php echo $data['user_name'];?>
                                </button>
                              </a>
                             <?php }?>
                            <?php }?>
                          </div>
                          
                             <?php if($W=='1'){?>
                          <div class=" text-right">
                              <a href="add_cash_payment.php">
                          <button  class="btn btn-success m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add Vouchers
                            </button>
                          </a>
                          <a href="add_jv_payment.php">
                          <button  class="btn btn-info m-b-15" type="button">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> Add JV
                            </button>
                          </a>
                        
                          </div>
                          <?php }?>

                            <div class="row mb-3">
                                <div class="col-md-8">
                                    <form method="GET" class="form-inline">
                                        <?php 
                                        // Set default dates to current date if not set
                                        $current_date = date('Y-m-d');
                                        $from_date = isset($_GET['from_date']) ? $_GET['from_date'] : $current_date;
                                        $to_date = isset($_GET['to_date']) ? $_GET['to_date'] : $current_date;
                                        
                                        if(isset($_GET['branch_id'])) { ?>
                                            <input type="hidden" name="branch_id" value="<?php echo $_GET['branch_id']; ?>">
                                        <?php } ?>
                                        <div class="input-group">
                                            <input type="date" name="from_date" class="form-control" style="margin-right: 26px;" value="<?php echo $from_date; ?>" required>
                                            <input type="date" name="to_date" class="form-control" style="margin-right: 26px;" value="<?php echo $to_date; ?>" required>
                                            <button type="submit" style="margin-right: 26px;" class="btn btn-primary">Filter</button>
                                            <?php if($from_date != $current_date || $to_date != $current_date) { ?>
                                                <a href="<?php echo isset($_GET['branch_id']) ? 'add_payment.php?branch_id='.$_GET['branch_id'] : 'add_payment.php'; ?>" class="btn btn-secondary">Reset</a>
                                            <?php } ?>
                                        </div>
                                    </form>
                                </div>

                            <div class="table-responsive">
                                <table class="table table-hover js-basic-example dataTable table-custom m-b-0" id="example">
                                    <thead >
                                  
                                        <tr>                                            
                                            <th>Sr #</th>
                                            <th>Narration</th>
                                        
                                            <th>Payment Type</th>
                                            <th>Accounts</th>
                                            
                                            <th>Total Amount</th>
                                            <th>Voucher Status</th>
                                            
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
                              
                                        $query=mysqli_query($conn,"SELECT P  FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                                        $data = mysqli_fetch_assoc($query);
                                        $P=$data['P'];
                                $count=0;
                                $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                    $sql = "SELECT * FROM tbl_payment WHERE DATE(payment_date) BETWEEN '$from_date' AND '$to_date'";
                                    if(isset($_GET['branch_id'])) {
                                        $branch_id = $_GET['branch_id'];
                                        $sql .= " AND created_by='$branch_id'";
                                    }
                                    $sql .= " ORDER BY id desc";
                                    $sql = mysqli_query($conn, $sql);
                                }
                                else
                                {
                                    $sql = "SELECT * FROM tbl_payment WHERE created_by='$userid' AND DATE(payment_date) BETWEEN '$from_date' AND '$to_date' ORDER BY id desc";
                                    $sql = mysqli_query($conn, $sql);
                                }
                                    // $d_id=$_GET['d_id'];
                                
                                while($pdata = mysqli_fetch_assoc($sql))   
                                { 
                                    $id=$pdata['id'];
                                    $remarks=$pdata['remarks'];
                                    $total=$pdata['total'];
                                    $invoice_no=$pdata['payment_type']."_".$pdata['id'];
                                    $payment_date=$pdata['payment_date'];
                                    $payment_type=$pdata['payment_type'];
                                    $created_date=$pdata['created_date'];
                                    $newDate = date("d-m-Y", strtotime($payment_date));
                                    $created_by=$pdata['created_by'];

                                    $sql5 = mysqli_query($conn,"SELECT * FROM tbl_trans_detail  where invoice_no='$invoice_no'");
                                    if(mysqli_num_rows($sql5)>0){
                                    $pdata = mysqli_fetch_assoc($sql5);
                                    $narration=$pdata['narration'];
                                    $query1 = mysqli_query($conn,"SELECT acode FROM tbl_trans_detail where invoice_no='$invoice_no'"); 
                                    $status="<span class='badge badge-success'>Completed</span>";
                                     $edit='';
                                  }
                                  else
                                  {
                                    $sql7 = mysqli_query($conn,"SELECT * FROM tbl_voucher_detail  where invoice_no='$invoice_no'");
                                    $pdata = mysqli_fetch_assoc($sql7);
                                    $narration=$pdata['narration'];
                                    $trans_id=$pdata['trans_id'];
                                    $query1 = mysqli_query($conn,"SELECT acode FROM tbl_voucher_detail where invoice_no='$invoice_no'"); 
                                    $status="<span class='badge badge-danger'>Pending</span>";
                                    $edit='<a  href="operations/complete_voucher.php?voucher_id='.$trans_id.'" class="btn btn-sm btn-outline-primary" title="Complete">Complete</a>';
                                   
                                  }
                                  
                                  $count++;

                                  $query = mysqli_query($conn,"SELECT user_name,user_profile FROM users where user_id=$created_by"); 
                                   
                                   $zdata = mysqli_fetch_assoc($query) ;
                                   $user_name=$zdata['user_name'];
                                   $user_profile=$zdata['user_profile'];
                              
                                  
                                  $date=date('Y-m-d');
                                    
                                    if($date > DATE($created_date) && $P!='1'){ 

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
                                            <td><?php echo $narration;?></td>
                                            <td><?php echo $payment_type;?></td>
                                            <td>
                                              <?php
                                              while($zdata = mysqli_fetch_assoc($query1))
                                                 {
                                                 $acode=$zdata['acode'];
                                                  
                                                $query2 = mysqli_query($conn,"SELECT aname FROM tbl_account where acode='$acode'"); 
                                                
                                                $zdata = mysqli_fetch_assoc($query2);
                                                 
                                                 $aname=$zdata['aname'];
                                                 if($aname=='')
                                                 {
                                                   $query3 = mysqli_query($conn,"SELECT aname FROM tbl_account_lv2 where acode='$acode'"); 
                                                 
                                                    $zdata = mysqli_fetch_assoc($query3);
                                                     
                                                     $aname=$zdata['aname'];
                                                 }
                                                ?>
                                                 <p><?php echo $aname; ?></p><?php } ?></td>
                                                
                                            
                                            
                                            <td><?php echo $total;?></td>
                                            <td><?php echo $status;?></td>
                               
                                            <td>
                                                <ul class="list-unstyled team-info">
                                                    <li><img src="<?php if($user_profile!=''){ echo $user_profile;}else{?> assets/images/userdefault.jpg<?php }?>" data-toggle="tooltip" data-placement="top" title="Created by <?php echo $user_name;?>" alt="Created by <?php echo $user_name;?>"></li>
                                         
                                                </ul>
                                            </td>
                                            <td><?php echo $newDate;?></td>
                                        
                                            <td class="project-actions">
                                              <?php if($user_id==1){echo $edit;}?>
                                               <a  href="payment_invoice.php?voucher_id=<?php echo $id;?>" class="btn btn-sm btn-outline-primary" title="Print"><i class="icon-eye"></i></a>
                                               <?php if($D=='1'){?>
                                                <a <?php echo $display;?> href="operations/delete.php?voucher_id=<?php echo $id;?>&payment_type=<?php echo $payment_type;?>" class="btn btn-sm btn-outline-danger js-sweetalert" title="Delete" onclick="return confirm('Are you sure want to delete');"><i class="icon-trash"></i></a>
                                                <?php }?>
                                            </td>
                                           
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                        <tfoot>
                                      <tr class="bg-dark text-white">
                                        <th><h5>Total</h5></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h5><span class="total"></span></h5></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                      </tr>
                                    </tfoot>
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
    $('#example').DatasTable( {
        "order": [[ 0, "asc" ]],
              "footerCallback": function ( row, data, start, end, display ) {
            var api = this.api(), data;
            
            var intVal = function ( i ) {
                return typeof i === 'string' ?
                    i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
            };

            netTotal = api
                .column( 4, { page: 'current'} )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(0);
      
          
            $(".total").html(netTotal);

        } 
    } );
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/project-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:10 GMT -->
</html>
