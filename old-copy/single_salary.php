<!doctype html>
<html lang="en">


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

<!-- Page Loader -->
<?php
include "includes/loader.php";

?>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Salary  Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Salary Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
 <?php 
  $month=mysqli_real_escape_string($conn,$_POST['month']);
  if($month =='1'){
    $month_name='January';
  }if($month =='2'){
    $month_name='Feburary';
  }if($month =='3'){
    $month_name='March';
  }if($month =='4'){
    $month_name='April';
  }if($month =='5'){
    $month_name='May';
  }if($month =='6'){
    $month_name='June';
  }if($month =='7'){
    $month_name='July';
  }if($month =='8'){
    $month_name='August';
  }if($month =='9'){
    $month_name='September';
  }if($month =='10'){
    $month_name='October';
  }if($month =='11'){
    $month_name='November';
  }if($month =='12'){
    $month_name='December';
  }
  $year =mysqli_real_escape_string($conn,$_POST['year']);
   $date_for = date(''.$year.'-'.$month.'-01');

  // $new_date = date("Y-".$month."-01",strtotime($date."+".$month." month"));

  $salesman=mysqli_real_escape_string($conn,$_POST['salesman']);
if($_POST)
{
  if($month=="All")
  {
    $where_date="";
    
  }else 
  {
    $where_date = "and MONTH(tbl_salary.created_date)='$month' and YEAR(tbl_salary.created_date)='$year'";
    
  }
  if($salesman=="All")
  {
    $where_staff="";
    
  }else 
  {
    $where_date = "Where staff_mem_id='$salesman'";
    
  }
}
else
{
  $now = new \DateTime('now');
   $month = $now->format('m');
   $year = $now->format('Y');
   if($month =='1'){
    $month_name='January';
  }if($month =='2'){
    $month_name='Feburary';
  }if($month =='3'){
    $month_name='March';
  }if($month =='4'){
    $month_name='April';
  }if($month =='5'){
    $month_name='May';
  }if($month =='6'){
    $month_name='June';
  }if($month =='7'){
    $month_name='July';
  }if($month =='8'){
    $month_name='August';
  }if($month =='9'){
    $month_name='September';
  }if($month =='10'){
    $month_name='October';
  }if($month =='11'){
    $month_name='November';
  }if($month =='12'){
    $month_name='December';
  }
  $salesman='All';
  $where_staff='';
  $where_date = "and MONTH(tbl_salary.created_date)='$month' and YEAR(tbl_salary.created_date)='$year'";

}

   ?>


<body >

          <div class="row clearfix" style="padding-right: calc(var(--bs-gutter-x) * 0.5);
    padding-left: calc(var(--bs-gutter-x) * 0.5); margin-top: 30px;">
                <div class="col-12">
                    <div class="card">
                                             <?php
              
              if(isset($_GET['insert']) && $_GET['insert']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Item Added Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>
                                       <?php
                                   }
              
              if(isset($_GET['update']) && $_GET['update']=='successful'){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Item Updated Succesfully.
</div>
              <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
  $("#success-alert").hide();

    $("#success-alert").fadeTo(4000, 500).slideUp(500, function() {
      $("#success-alert").slideUp(500);
    });
  });
    </script>

            
              <?php
              }

              if(isset($_GET['insert']) && $_GET['insert']=='unsuccessful' || isset($_GET['update']) && $_GET['update']=='unsuccessful'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Add Item.
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

                         <form  action="single_salary.php" method="post" enctype="multipart/form-data">
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
                                    <h3  class="text-center">Customer Ledger</h3>

                                  
                                </div>

                            </div>
                              </div>
                                      <div class="row">
                            <div class="clearfix text-center col-md-12" >
                                <div class="info text-center col-md-12"  >
                                   <p>(<?php echo $c_address;?>)<br><?php echo $c_phone;?></p>
                               </div> </div>
                              </div>

                            <div class="row clearfix">
                            
                              <div class="col-md-3 col-sm-12">
                                 <label   for="description">Month </label>
                                    <div class="form-group">
                                  
                                     <select class="form-control select_group" name="month" style="width: 100%;">
                                 
                                        <?php
                                        if($_POST)
                                            {
                                                $month = $_POST['month'];
                                            }
                                            else
                                            {
                                                $date=date('Y-m-d');
                                                $time = new DateTime($date);
                                                $month = $time->format('m');
                                            }
                                            for($a=1; $a<=12; $a++){
                                              if($a =='01'){
                                                $monthname='January';
                                              }if($a =='02'){
                                                $monthname='Feburary';
                                              }if($a =='03'){
                                                $monthname='March';
                                              }if($a =='04'){
                                                $monthname='April';
                                              }if($a =='05'){
                                                $monthname='May';
                                              }if($a =='06'){
                                                $monthname='June';
                                              }if($a =='07'){
                                                $monthname='July';
                                              }if($a =='08'){
                                                $monthname='August';
                                              }if($a =='09'){
                                                $monthname='September';
                                              }if($a =='10'){
                                                $monthname='October';
                                              }if($a =='11'){
                                                $monthname='November';
                                              }if($a =='12'){
                                                $monthname='December';
                                              }
                                            if($a==$month)
                                            {
                                            echo "<option value=$a selected>$monthname</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$a>$monthname</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                                       
                                          
                                    </select>
                                    </div>
                                </div>
                            
                              <div class="col-md-3 col-sm-12">
                                <label for="description">Year </label>
                                    <div class="form-group">
                               <select class="form-control select_group" name="year" >
                                            <?php
                                            if($_POST)
                                            {
                                                $year = $_POST['year'];
                                            }
                                            else
                                            {
                                            $date=date('Y-m-d');
                                            $time = new DateTime($date);
                                            $year = $time->format('Y');
                                            }
                                            for($b=2030; $b>=2015; $b--){
                                            if($b==$year)
                                            {
                                            echo "<option value=$b selected>$b</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$b>$b</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>

                               </select>
                                    </div>
                                </div>
                    
                                <div class="col-md-3 col-sm-12">
                                  <label for="description">Staff </label>
                                    <div class="form-group">
                                        <select class="form-control select_group" name="salesman" >
                                            <option value="All">All</option>
                                            <?php
                                            $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                    $data = mysqli_fetch_assoc($query);
                                    $user_privilege=$data['user_privilege'];
                                    if($user_privilege=='superadmin')
                                    {
                                      $sql="SELECT username,s_id,designation  FROM tbl_salesmen"; 
                                    }
                                    else
                                    {
                                      $sql="SELECT username,s_id,designation  FROM tbl_salesmen where created_by='$userid'"; 
                              
                                    }
                                            
                                        foreach ($conn->query($sql) as $row){
                                        echo "<option value=$row[s_id]>$row[username]</option>"; }
                                        echo "</select>";
                                         ?>
                                    </select>
                                    </div>
                                  </div>
                             
                               

                                <div class="col-md-3 col-sm-12" style="padding-top: 20px;">
                                  <button style="width:100%; " type="submit" class="btn btn-primary" name="purchase_rep" target='_blank'>Search</button>
                                </div>
                                 </div>
                    </form>
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
                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <span ><b>Staff : </b> <?php echo $salesman;?></span>

                          </div>
                          <div class="clearfix text-right col-md-6" >

                            <span ><b>Month :  </b> <?php echo $month_name;?></span> / 
                             <span ><b>Year : </b> <?php echo $year;?></span>
                            
                          </div> 
                             </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th> 
                                                            <th>Name</th>          
                                                            <th>Designation</th>
                                                            <th>Mobile</th>
                                                            <th>Salary</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php
                            
                                  $bsql=mysqli_query($conn,"SELECT tbl_salary.*,tbl_salesmen.* from tbl_salary inner join tbl_salesmen on tbl_salary.staff_mem_id=tbl_salesmen.s_id $where_staff $where_date and tbl_salary.created_by='$userid' GROUP BY  MONTH(tbl_salary.created_date) ") ;


                                    $count = 0;
 $count2=mysqli_num_rows($bsql);

  if($count2=='0')
{?>
<script>
 // window.location.replace("search_salary.php?data=notfound");
   
</script>

<?php }
                                                    
                               
while($value= mysqli_fetch_assoc($bsql))   
                                { 
                                  // echo "<pre>";php rint_r($value);
                                  $username=$value['username'];
                                  $designation=$value['designation'];
                                  $salary = $value['staff_mem_salary'];
                                    
                                         // print_r($value); 
                                  $mobile_no = $value['mobile_no1'];
                                   
$count++;
  ?>
                                                        <tr>
                            <td><?php echo $count;?></td>
                            <td><?php echo $username;?></td>
                            <td><?php echo $designation;?></td>
                            <td><?php echo $mobile_no;?></td>
                            <td><?php echo $salary;?></td>
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
           title: '<?php echo $c_name;?> (Salary Report) for Month : <?php echo $month_name; ?>',
           
          
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

          
          title: '<?php echo $c_name;?> (Salary Report) for Month : <?php echo $month_name; ?>',

          
        },


      ]


    });
} );
</script>
 <script>
    let dateDropdown = document.getElementById('date-dropdown');

    let currentYear = new Date().getFullYear()+1;
    let earliestYear = 1970;

    while (currentYear >= earliestYear) {
      let dateOption = document.createElement('option');
      dateOption.text = currentYear;
      dateOption.value = currentYear;
      dateDropdown.add(dateOption);
      currentYear -= 1;
    }
  </script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
