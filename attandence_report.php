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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Attandence Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Attandence Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php 
 if($_POST)
{ 
  $f_date=mysqli_real_escape_string($conn,$_POST['f_date']);
  $t_date=mysqli_real_escape_string($conn,$_POST['t_date']);
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
  $user=mysqli_real_escape_string($conn,$_POST['users']); 
}
else
{
  $user = 'All';
  $f_date = date('Y-m-d');  
  $t_date = date('Y-m-d');
  $newDate1 = date("d-m-Y", strtotime($f_date));
  $newDate2 = date("d-m-Y", strtotime($t_date));
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
                                    <h3  class="text-center">Attandence Report</h3>

                                  
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
                                  
                                  <strong>Sorry ! </strong>From Date Should be Smaller Then To Date !
                                </div>
                         <form  action="attandence_report.php" method="post" enctype="multipart/form-data" id='form1'>
                        <div class="body">

                            <div class="row clearfix">
                              <div class="col-md-4 col-sm-12">
                                    <div class="form-group">
                                        <label   for="description">From Date </label>
                                        <input type="date" class="form-control" name="f_date" id="f_date" placeholder="Item Name *" required="" value="<?php if($f_date){echo $f_date;}else{?><?php echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                              <div class="col-md-4">
                                     <label for="description">To Date </label>
                                    <div class="form-group">
                                        <input type="date" class="form-control" id="t_date" name="t_date" placeholder="Item Name *" required="" value="<?php if($t_date){echo $t_date;}else{?><?php echo date('Y-m-d');} ?>">
                                    </div>
                                </div>
                                
                                <div class="col-md-4 col-sm-12">
                                    <label for="description">Employee </label>
                                    <div class="form-group">
                                    <select class="form-control users"  name="users">
                                        <option selected="selected" value="All">All</option>
                                           <?php
                                            $sql="SELECT * FROM tbl_salesmen"; 
                                            foreach ($conn->query($sql) as $row){
                                              
                                            if($row['s_id']==$user)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username] - $row[designation]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username] - $row[designation]</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                                        </select>
                                        </div>
                                </div>
                               
                                 <div class="col-md-4 col-sm-12" style="margin-top:30px;">
                                 </div>
                               <div class="col-md-2 col-sm-12" style="margin-top:30px;">
                                        <button style="width:100%; " type="submit" class="btn btn-sm btn-dark" name="detail" onclick="check()" >Detail</button>
                                 </div>
                                  
                                 <div class="col-md-4 col-sm-12" style="margin-top:30px;">
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
                  		if($user=='All')
                  		{
                  			$username='All';
                  			$designation='All';
                  		}
                  		else
                  		{
                  			$sqll=mysqli_query($conn, "SELECT * FROM `tbl_salesmen` where s_id='$user'");
                      
	                        $dataa=mysqli_fetch_assoc($sqll);
	                        $username = $dataa['username']; 
	                        $designation = $dataa['designation']; 
                  		}
                        

                          ?>  

                               <div class="row">
                                   <div class="clearfix text-right col-md-6" >

                            <span > <h3><b>Employee  : </b> <?php echo $username. "-" .$designation;?></h3>
                       </span></div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FROM DATE/TO DATE : </b> <?php echo $newDate1.'/'.$newDate2;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">

   <table id="example" class="display" style="width:100%">
        <thead class="thead-dark">
            <tr>
              <th>#</th> 
              <th>Employee</th>                          
              <th>Designation</th>
              <th>Date</th>
              <th>Attandence</th>
            </tr>
         </thead>
         <tbody>
<?php

if($user=='All')
  	{  
      $where_saleman="";
	}

else{

	$where_saleman="and tbl_attendence.emp_id=".$user."";
  
	}

/*if($user!='All')
{*/
$sql_saleman_present=mysqli_query($conn, "SELECT count(att_id) as total_present FROM `tbl_attendence` WHERE DATE(tbl_attendence.attadance_date)   between '$f_date' and '$t_date' and status='1' $where_saleman");
                      
                        $dataa=mysqli_fetch_assoc($sql_saleman_present);
                        $total_present = $dataa['total_present']; 	
$sql_saleman_absent=mysqli_query($conn, "SELECT count(att_id) as total_absent FROM `tbl_attendence` WHERE DATE(tbl_attendence.attadance_date)   between '$f_date' and '$t_date' and status='0' $where_saleman");
                      
                        $dataa=mysqli_fetch_assoc($sql_saleman_absent);
                        $total_absent = $dataa['total_absent'];

                        if($total_present == '')
                        {
                        	$total_present=0;
                        }
                        if($total_absent == '')
                        {
                        	$total_absent=0;
                        }
// }
// else
// {
// 	$total_present=0;
// 	$total_absent=0;
// }
$csql=mysqli_query($conn, "SELECT * FROM tbl_attendence where DATE(tbl_attendence.attadance_date)   between '$f_date' and '$t_date' $where_saleman");
$count=0;
while($value = mysqli_fetch_assoc($csql))   
      { 
        $emp_id=$value['emp_id'];
        $attadance_date=$value['attadance_date'];
        $attadance_dt = date("d-m-Y H:i a", strtotime($attadance_date));
        $status=$value['status']; 
        if($status=='1')
        {
           $display="<span class='badge badge-success'>Present</span>";
        }
        else if($status=='0')
        {
           $display="<span class='badge badge-danger'>Absent</span>";
        } 

$sql_saleman=mysqli_query($conn, "SELECT * FROM `tbl_salesmen` where s_id='$emp_id'");
                      
                        $dataa=mysqli_fetch_assoc($sql_saleman);
                        $username = $dataa['username']; 
                        $designation = $dataa['designation'];

                     
        $count++;
                        
?>  
<tr>
  <td><?php echo $count;?></td>
  <td><?php echo $username;?></td>
  <td><?php echo $designation;?></td>
  <td><?php echo $attadance_dt;?></td>
  <td><?php echo $display;?></td>
</tr>

<?php } ?>

   
         </tbody>
          <tfoot>
                                      <tr class="bg-dark text-white">
                                        <th><h5>Total</h5></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th><h5><span><?php echo $total_present;?></span></h5></th>
                                        
                                        
                                      </tr>
                                    </tfoot>
       </table>

                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
                                        </div>
                                        <div class="col-md-6 text-right">                          
                                             <h3 class="m-b-0 m-t-10">Total Presents (<span><?php echo $total_present;?></span>)</h3>
                                             <h3 class="m-b-0 m-t-10" >Total Absents (<span><?php echo $total_absent;?></span>)</h3>
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
<!-- Javascript -->
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
  $(".users").select2();
          $('#example').DataTable({
      "bPaginate": true,
      "bLengthChange": true,
      "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
      dom: 'Bfrtip',
      scrollY: true,
      scrollX: false,
      "paging":   true,
      "ordering": false,
      "info":     false,
      searching: true,
      "processing": true,
      
      buttons: [
        'pageLength',
          {
          extend: 'pdf',
          orientation: 'portrait',
          pageSize: 'LEGAL',
          footer: true,
          title: '<?php echo $c_name;?> (Attandence Report)',
          message: '<?php echo $username;?> \n Date : (<?php echo $newDate1.'/'.$newDate2;?>)',
          text:'<span class="text-white"><i class="fa fa-file-pdf-o"></i></span><span class="text"> PDF</span>',
          className: 'btn btn-danger',
         
        },
        {
          extend: 'print',
          footer: true,
          className: 'btn btn-success',
          titleAttr: 'print',
          text:'<span class="text-white"><i class="fa fa-print"></i></span><span class="text"> Print</span><br>', 
          title: '<?php echo $c_name;?> (Attandence Report)',
          message: 'Employee : <?php echo $username;?> <br> For Date : (<?php echo $newDate1.'/'.$newDate2;?>)',

          
        },


      ]
   
    });
} );
</script>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('stock.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('stock.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>
<script type="text/javascript">
  function GoBackWithRefresh(event) {
    if ('referrer' in document) {
        // window.location = document.referrer;
        window.location = ('employee_attandence.php');
        /* OR */
        //location.replace(document.referrer);
    } else {
      window.location('employee_attandence.php');
        // window.history.back().back();
        // window.history.back();
    }
}
</script>


</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
