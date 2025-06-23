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
<?php
include "includes/loader.php";

?>
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
                            <li class="breadcrumb-item">Vendor Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php 
if($_POST)
{
  $vendors = mysqli_real_escape_string($conn,$_POST['vendors']); 
  $f_date = mysqli_real_escape_string($conn,$_POST['f_date']);  
  $t_date = mysqli_real_escape_string($conn,$_POST['t_date']); 
    $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);

  if($branch=='')
{
    $branch_name='All';

}
}
else
{

  $vendors = 'All'; 
  $f_date = date('Y-m-d');  
  $t_date = date('Y-m-d');
    $newDate1 = date("d-m-Y", strtotime($f_date));
    $newDate2 = date("d-m-Y", strtotime($t_date));
  $branch=$userid;
  $branch_name='All';
}
  // $purchase_id=mysqli_real_escape_string($conn,$_GET['purchase_id']);
  // $invoice_no="Purchase_".$purchase_id;

   ?>


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
                                    <h3  class="text-center">Vendor Detail Ledger</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix text-center col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>

                            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
                                <div class="alert alert-danger"   id="danger-alert" style="display:none;">
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date!.
                                </div> 
                         <form  action="get_vendor_item.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-2">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php  if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                            
                                 <div class="col-md-2 col-sm-12">
                                <label for="description">Location </label>
                                    <div class="form-group">
                                <select class="form-control mb-3 show-tick select_group" name="branch" >

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
                                </div>
                                <div class="col-md-3 col-sm-12">
                                    <div class="form-group">
                                        <label for="description">Vendors </label>
                                    <select class="form-control select_group" name="vendors" id='van_id' >
                                        
                                        <?php
                                        $sql="SELECT branch_id,created_by  FROM users where user_id='$userid'";
                                              $result1 = mysqli_query($conn,$sql);
                                              while($data = mysqli_fetch_array($result1) ){
                                                $created_by = $data['created_by'];
                                                $branch_id = $data['branch_id'];
                                               }
                                            if($branch_id=='')
                                            {
                                              $sql="SELECT * FROM tbl_vendors";
                                            ?>
                                            <option value="All">All Vendors</option>
                                            <?php
                                            }
                                            else
                                            {

                                              $sql="SELECT * FROM tbl_vendors where created_by='$userid'";
                                             
                                            }
                                            
                                
                                         
                                    foreach ($conn->query($sql) as $row){
                                        if($row['vendor_id']==$vendors)
                                            {
                                            echo "<option value=$row[vendor_id] selected>$row[username] $row[mobile_no]</option>";
                                            }
                                            else
                                            {
                                            echo "<option value=$row[vendor_id]>$row[username] $row[mobile_no]</option>"; 
                                            }
                                     }
                                    echo "</select>";
                                     ?>
                                    </select>
                                        </div>
                                          </div>
                                          <div class="col-md-3 col-sm-12" style="margin-top:28px;">
                                            <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="purchase_rep" onclick="check()" target='_blank'>Search</button>
                                           </div>
                                     </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
            <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * -1.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5);">
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                        <?php 
                        if($vendors=='All'){
                              $vendornamee="All";
                              $where_vendor="LEFT(acode, 6)='200200'";
                            }else{
                                $where_vendor="acode='$vendors'";
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_vendors where vendor_id=$vendors");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $vendornamee = $dataa['username']; }
                 
                        ?>
                        <div class="row">
                            <div class="invoice-top clearfix col-md-12">

                                <div class="info text-center col-md-12" style="margin-top: 1%;" >
                                    <h1 class="text-center"><?php echo $vendornamee;?></h1>
                                </div>

                            </div>
                              </div>
                            
                       
                          
               <?php
                              ?>  

                               <div class="row">
                                   
                            <div class="clearfix text-right col-md-12" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                               <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>  
                                                            <th>Trans #</th>
                                                            <th>Purchase #</th>
                                                            <th>Date</th>
                                                            <th>Time</th>           
                                                            <th>Account</th>
                                                            <th style="width: 50%;">Narration</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                            <th>Balance</th>
                                                            <th class="text-right">Details</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                    <?php
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

                if($privilige!='branch' && $created_by=='1')
                {
                    $where_location="";
                }
                else
                {
                    $where_location="and parent_id='".$parent_id."'";
                }
                 if($branch=='')
                                      {

                                          $where_branch='';
                                        
                                      }
                                      else
                                      {

                                          $where_branch='and parent_id="'.$branch.'"';
                                         ;

                                      }

                    $sql6=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as opening FROM tbl_trans_detail where DATE(created_date)< '$f_date' and $where_vendor  $where_branch");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql6))
                        {

                        $opening = $row['opening'];
                        if($opening=='')
                        {
                           $opening=0; 
                        }
                    }?>
                        <tr>
                            
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="width: 50%;">Opening Balance</td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td><h4 class="m-b-0 m-t-10"></td>
                            <td class="text-right"><?php echo round($opening);?></td>
                            <td></td>
                            </tr>
                                                  
<?php

$sql5=mysqli_query($conn, "SELECT * FROM tbl_trans_detail where DATE(created_date) between  '$f_date' and '$t_date' and $where_vendor $where_branch");
                      $count=0;
                        while($row=mysqli_fetch_assoc($sql5))
                        {

                        $invoice_no = $row['invoice_no'];
                        $po=explode('_', $invoice_no);
                        $edit=$po[1];
                       
                        $narration = $row['narration'];
                        $created_date = $row['created_date'];
                        $newDate = date("d-m-Y", strtotime($created_date));
                        $d_amount = $row['d_amount'];
                        $created_date = $row['created_date'];
                        $time = new DateTime($created_date);
                        $date = $time->format('Y-m-d');
                        $time = $time->format('h:i');
                        // $parent_id = $row['parent_id'];
                        // $installment_number+=$row['installment_number'];
                        // $count++;
                        

                        $query10 = mysqli_query($conn,"SELECT username FROM tbl_vendors where vendor_id=$vendor_id"); 
                                   
                                   $zdata1 = mysqli_fetch_assoc($query10) ;
                                   $vendor_name=$zdata1['username'];
  
 

      
                                    $acode=$row['left(acode,6)'];
                                    $d_amount=$row['d_amount']; 
                                    $trans_id=$row['trans_id'];
                                    $c_amount=$row['c_amount'];
                                    $narration=$row['narration'];
                                    $acode1=$row['acode'];
                                    

                        $sql=mysqli_query($conn, "SELECT * FROM tbl_account where left(acode,6)=$acode");
                        $data=mysqli_fetch_assoc($sql);
                        $aname = $data['aname'];
                        
                       
                        $sql1=mysqli_query($conn, "SELECT * FROM tbl_account_lv2 where acode=$acode1");
                        $data=mysqli_fetch_assoc($sql1);
                        $aname1 = $data['aname'];
                        $balance_edit=$d_amount-$c_amount;
                        // echo $balance;

$count++;
  ?>
                            <tr>
                            <td><?php echo $trans_id;?></td>
                            <td><a href="edit_ledger.php?invoice_no=<?php echo $invoice_no;?>&acode=<?php echo $acode1;?>&created_at=<?php echo $date;?>" target="_blank"><?php echo $invoice_no;?></a></td>
                            <td><?php echo $newDate;?></td>
                            <td><?php echo $time;?></td>
                            <td><?php echo $aname; ?><?php echo $aname; if($aname1!=''){?> ( <?php echo $aname1;?> ) <?php }?></td>
                            <td style="width: 50%;"><?php echo $narration;?></td>
                            <td class="text-right"><?php echo round($d_amount); $total_damount+=$d_amount;?></td>
                            
                            <td class="text-right"><?php echo round($c_amount); $total_camount+=$c_amount;?></td>
                            <td class="text-right"><?php echo $balance=round(($total_damount-$total_camount)); $total_balance+=$balance;?></td>
                            <td class="text-right"><button type="button" class="btn btn-info text-white "  onclick="get_details(<?php echo $trans_id;?>);">Details</button></td>
                            </tr>
                                                       
                                                      <?php } ?>
                            <tr>

                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>

                            <td style="width: 50%;"><h4 class="m-b-0 m-t-10">Total</h4></td>
                            <td class="text-right"><h4 class="m-b-0 m-t-10"><?php echo round($total_damount);?></h4></td>
                            <td class="text-right"><h4 class="m-b-0 m-t-10"><?php echo round($total_camount);?></h4></td>
                            <td class="text-right"><h4 class="m-b-0 m-t-10"><?php echo $total_balance=round(($total_damount-$total_camount)+$opening);?></h4></td>
                            <td></td>
                            </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">
                                  
                                                                                   
                                            <h3 class="m-b-0 m-t-10">Balance ( <?php echo round($total_balance); ?> )</h3>
                                        </div>                                    
                                        <div class="hidden-print col-md-12 text-right">
                                            <hr>
                                            
                                        </div>
                                    </div>                                    
                                </div>  
                        
                            </div>   
                                            
                          
                            <div class="row clearfix ">
                                <div class="col-md-6 ">
                               
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<button hidden="" type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl" id="open_model">Item Detail</button>

<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true" id="myModal">
  <div class="modal-dialog modal-xl">
    <div class="modal-content" style="padding: 10px;">
        <table class="table table-striped" id="item_detail">
        </table>
        <div class="modal-footer">
         <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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

function get_details(trans_id)
 {


var dataString = 'trans_id='+ trans_id;

    $.ajax({

type: "POST",
url: "operations/get_vendorwise_item.php",
data: dataString,

success: function(responce){
 
  $("#open_model").click();
  $("#item_detail").empty();
  $("#item_detail").html(responce);
}
});

}
</script>
<script type="text/javascript">
$(document).ready(function() {
    $(".select_group").select2();
          $('#example').DataTable({
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   false,
      "ordering": false,
      "info":     false,
      searching: true,
      buttons: [
        
          {
          extend: 'pdf',
          text: 'PDF',
          title: '<?php echo $c_name;?> (Vendor Ledger)',
          orientation: 'landscape',
          text:'<span class="text-default"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          pageSize: 'LEGAL',
          className: 'btn btn-sm btn-outline-dark',
          customize: function (doc) {
                        doc.content[1].table.widths = 
                            Array(doc.content[1].table.body[0].length + 1).join('*').split('');
                            doc.styles.tableHeader = {
                           
                           alignment: 'left'
                         }
                      }  
        },
        {
          extend: 'print',
          className: 'btn btn-sm btn-outline-dark',
          titleAttr: 'print',
          text:'<span class="text-default"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: '<?php echo $c_name;?> (Vendor Ledger)',

          
        },


      ]


    });
} );
</script>
<script type="text/javascript">
  $("#danger-alert").hide();
  $("#form1").submit(function(e){
     var from = $("#f_date").val();
var to = $("#t_date").val();

if(Date.parse(from) > Date.parse(to)){
   e.preventDefault();
   // alert("Invalid Date Range");
     

    $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#danger-alert").slideUp(500);
    });
  
   $("$f_date").focus();
    // return false;
    }
});

</script>

</html>
