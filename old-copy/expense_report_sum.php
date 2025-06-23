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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Expense Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Expense Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php 
if($_POST)
{
  $account = $_POST['account'];
  $branch=mysqli_real_escape_string($conn,$_POST['branch']);
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
}
else
{
  $account = 'All';
  $branch = 'All';
  $f_date = date('Y-m-d');  
  $t_date = date('Y-m-d');
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  
}

if($account=='All')
{
    $where_acode="where LEFT(acode,6) in('500200', '500100') and";
}

if($account!='All'){

                            $len=strlen($account);
                        
                            if($len=='6')
                            {
                               
                              $where_acode = "where left(acode,6) = '$account' and";  
                            }
                            else
                            {

                                $where_acode = "where acode = '$account' and";
                            }

                }

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
                                    <h3  class="text-center">Expense Report</h3>

                                  
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
                         <form  action="expense_report_sum.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-2 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if($_POST){echo $f_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-2  col-sm-12">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if($_POST){echo $t_date;}else{echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <label for="description">Account </label>
                                    <div class="form-group">
                                    <select class="form-control select_group" name="account" id='van_id' >
                                        <option value="All">All</option>
                                        <?php

                                
                                  $sql="SELECT left(acode,6) as acode,aname FROM tbl_account Where  LEFT(acode,6) in('500200', '500100')  UNION SELECT acode,aname FROM tbl_account_lv2 Where LEFT(acode,6) in('500200', '500100')";
                                
                                        
                                    foreach ($conn->query($sql) as $row){
                                        if($row['acode']==$account)
                                            {
                                            echo "<option value=$row[acode] selected>$row[aname]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[acode]>$row[aname]</option>"; 
                                            }
                                    }
                                    echo "</select>";
                                     ?>
                                    </select>
                                        </div>
                                          </div>   
                               <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark">Search</button>
                                 </div>
                              <!--    <div class="col-md-1 col-sm-12" style="margin-top:30px;">
                                        <a href="index.php"><button style="width:100%; " type="button" class="btn btn-sm btn-danger">Back</button></a>
                                 </div> -->
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
                    
                              <div class="row">
                                   <div class="clearfix text-right col-md-6" >

                            <span ><h3><?php echo $branch_name;?></h3>
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div>
                        <?php 
              

                        $sql="SELECT acode,aname FROM tbl_account UNION SELECT acode,aname FROM tbl_account_lv2 $where_acode ";

                        $vendsql=mysqli_query($conn, $sql);
                        $detail = mysqli_fetch_assoc($vendsql);
                        $username =$detail['aname'];
                       
                      
                        ?>
                       
                            
                       
             

                               
                            <hr> 
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                 <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                                                         
                                                                                                 
                                                                       
                                                            <th>ID</th>
                                                            <th>Account</th>
                                                            <th style="text-align: right;">Amount</th>
                                                          
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  

                              <?php
                              $count=0;
                         $sql2 = "SELECT  * FROM tbl_trans_detail $where_acode  DATE(created_date) between '$f_date' and '$t_date'  group by acode";
                        $vendsql2=mysqli_query($conn, $sql2);
                        $tot_damt=0;
                       
                        while($ndata=mysqli_fetch_assoc($vendsql2)) {

                        $acode=$ndata['acode'];
                        $bsql2=mysqli_query($conn,"SELECT d_amount, c_amount, acode From tbl_trans_detail where DATE(created_date) between '$f_date' and '$t_date' and acode='$acode'");
                         $d_amount=0;
                        $c_amount=0;
                                    while($value1 = mysqli_fetch_assoc($bsql2))
                                    {
                                    $c_amount+=round($value1['c_amount'], 0);
                                    $d_amount+=round($value1['d_amount'], 0);
                                    }                                    
                        // $vendor_id=substr($vendor_id, 0, 6);

                        // if($vendor_id=='100200')
                        // {
                        //     $c_amount=$ndata['d_amount'];    
                        //     $d_amount=$ndata['c_amount']; 
                        // }
                        // else
                        // {
                        //     $c_amount=$ndata['c_amount'];    
                        //     $d_amount=$ndata['d_amount'];
                        // }
                        $sql="SELECT aname FROM tbl_account_lv2 where acode='$acode'";
                        $result1 = mysqli_query($conn,$sql);
                        $data = mysqli_fetch_array($result1);
                          
                        $aname = $data['aname'];
                        if($aname=='')
                        {
                          $sql="SELECT aname FROM tbl_account where acode='$acode'";
                          $result1 = mysqli_query($conn,$sql);
                          $data = mysqli_fetch_array($result1);
                            
                          $aname = $data['aname'];
                        } 
                        $count++;
                        ?>
                        <tr>
                        <td><?php  echo $count;?></td> 

                        <td><?php  echo $aname; ?></td>  
                        <td style="text-align: right;"><?php echo $d_amount; $tot_damt+=$d_amount;?></td>
                        </tr>
                                                       
                         <?php } ?>
                         <tr>
                          <td></td>
                          <td><h5>Total</h5></td>  
                          <td  style="text-align: right;"><h5><?php echo $tot_damt;?></h5></td>
                        
                            <!-- <td><?php echo $total;?></td> -->
                        
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
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
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('customer.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('customer.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
<style type="text/css">
  .data-table-container {
  padding: 10px;
}

.dt-buttons .btn {
  margin-right: 3px;
}

</style>
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
          extend: 'pdfHtml5',
          text: '<?php echo $c_name;?>',
           title: '<?php echo $c_name;?> (Transaction History)',
           
          
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          
          className: 'btn btn-danger',
          
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
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 

          
          title: '<h3 class="text-center"><?php echo $c_name;?></h3><br><h5 class="text-center">(All Account Ledger)</h5>',

          
        },


      ]


    });
} );
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
