<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/emp-all.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:02 GMT -->
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Payslip</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item">Payroll</li>
                            <li class="breadcrumb-item active">Payslip</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">
                <?php 
                if($_POST){

                        $s_id=mysqli_real_escape_string($conn,$_POST['s_id']);
                        $month=mysqli_real_escape_string($conn,$_POST['month']);
                                      if($month =='01'){
                                        $month_name='January';
                                      }if($month =='02'){
                                        $month_name='Feburary';
                                      }if($month =='03'){
                                        $month_name='March';
                                      }if($month =='04'){
                                        $month_name='April';
                                      }if($month =='05'){
                                        $month_name='May';
                                      }if($month =='06'){
                                        $month_name='June';
                                      }if($month =='07'){
                                        $month_name='July';
                                      }if($month =='08'){
                                        $month_name='August';
                                      }if($month =='09'){
                                        $month_name='September';
                                      }if($month =='10'){
                                        $month_name='October';
                                      }if($month =='11'){
                                        $month_name='November';
                                      }if($month =='12'){
                                        $month_name='December';
                                      }
                                       $year =mysqli_real_escape_string($conn,$_POST['year']);;

                                       $where_date = "and MONTH(created_date)='$month' and YEAR(created_date)='$year'";
                                       if($month <='09')
                                       {
                                        $date_now=date($year.'-0'.$month.'-01');
                                        }
                                        else
                                        {
                                            $date_now=date($year.'-'.$month.'-01');
                                        }
                                       }

                            if($_GET)
                            {
                                $hide=0;
                            $s_id=$_GET['s_id'];
                             $now = new \DateTime('now');
                               $month = $now->format('m');
                               $year = $now->format('Y');
                             $where_date = "and MONTH(created_date)='$month' and YEAR(created_date)='$year'";
                             $date_now=date($year.'-'.$month.'-01');
                            }
                                $date_year=date('Y');
                                $date_month=date('m');
                                $searchingYear = $year;
                                      if($month <='09')
                                       {
                                          $searchingMonth='0'.$month;
                                        }
                                        else
                                        {
                                          $searchingMonth=$month;
                                        }
                           
                            if($date_month==$searchingMonth){ 
                                $hide=0;
                            }
                            else{
                                $hide=1;
                            } 
                            $slip = mysqli_query($conn,"SELECT * FROM tbl_salesmen where s_id='$s_id'");
                                $data = mysqli_fetch_assoc($slip);   
                               
                                    $id = $data['s_id'];
                                    $username = $data['username'];
                                    $mobile_no1 = $data['mobile_no1'];
                                    $salary = $data['salary'];
                                    $user_profile = $data['user_profile'];
                                    $email = $data['email'];
                                    $created_by = $data['created_by'];
                                    $created_date = $data['created_date'];
                                    $designation1 = $data['designation'];
                                    $designation = explode(",", $designation1);
                                     
                                    $sql1=mysqli_query($conn, "SELECT SUM(staff_mem_salary) as paid FROM tbl_salary where staff_mem_id='$id' and MONTH(created_date)=MONTH('$date_now')");
                        
                                        $data=mysqli_fetch_assoc($sql1);
                                        $paid = $data['paid'];
                                      if($paid=='')
                                      {
                                        $paid = 0;
                                      }
                                    
                                    $date_prev = date("Y-m-01",strtotime($date_now."-1 month"));
                                    $sql_salary=mysqli_query($conn, "SELECT *  FROM tbl_salary where  staff_mem_id='$id'  $where_date");
                                    if($paid>=$salary || $hide==1)
                                    {
                                        $hidden='hidden';
                                    }
                                    else
                                    {
                                        $hidden='';
                                    }
                                    $sql2=mysqli_query($conn, "SELECT SUM(bonus) as bonus FROM tbl_bonus where emp_id='$id' and MONTH(created_date)=MONTH('$date_now')");
                        
                                      $data=mysqli_fetch_assoc($sql2);
                                      $bonus = $data['bonus'];
                                    if($bonus=='')
                                    {
                                      $bonus = 0;
                                    }
                             
                            
                               
                            ?>
                            <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                        $date=date('Y-m-d');

                        // echo $data['c_phone '];exit();
                 
                        ?>
                <div class="col-lg-12 col-md-12">
                    <div class="card invoice1">                        
                        <div class="body">
                            <div class="invoice-top clearfix">
                                <div class="logo">
                                    <img src="<?php echo $image; ?>" alt="user" class="img-fluid">

                                </div>
                                <div class="info">
                                    <h6><?php echo $c_name;?></h6>
                                    <p><?php echo $c_address;?></p>
                                </div>
                                <div class="info">
                                    <form  action="payroll.php" method="post" enctype="multipart/form-data">
                                    <div class="body">
                                      <div class="row clearfix">
                                    <div class="col-md-5 col-sm-12">
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
                                    
                                    <input type="hidden" name="s_id" value="<?php echo  $s_id; ?>">
                                    </div>
                                    
                                </div>
                                 <div class="col-md-5 col-sm-12">
                                    
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
                                            
                                            echo "<option value=$year selected>$year</option>"; 
                                           
                                            

                                             echo "</select>";
                                             ?>

                               </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12  text-right">
                                             <button type="submit" class="btn btn-primary" >Search</button>
                                    </div>


                                </div>
                             
                            </form>
                        
                            </div>
                                </div>
                                <div class="title">
                                
                                    <p>Salary Month: <?php echo $date_now;?></p>
                                </div><br>
                                
                            </div>
                            <hr>
                            <div class="invoice-mid clearfix">      
                                <div class="clientlogo">
                                    <img src="<?php if($user_profile){ echo $user_profile;} else{?> assets/images/userdefault.jpg<?php }?>" alt="user" class="rounded-circle img-fluid">
                                </div>
                                <div class="info">
                                    <h6><?php echo $username;?></h6>
                                    <p><?php echo $designation1;?><br><?php echo $email;?></p>
                                </div>
                            </div>

                            <div class="row clearfix">
                                
                                <div class="col-lg-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-hover">
                                            <thead class="thead-success">
                                                <tr>
                                                    <th>#</th>
                                                    <th>Salary</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Basic Salary</td>
                                                    <td><?php echo $salary;?></td>
                                                </tr>
                                                <tr>
                                                    <td>1</td>
                                                    <td>Advance Salary</td>
                                                    <td><?php echo $paid;?></td>
                                                </tr>
                                           
                                                <tr>
                                                    <td>2</td>
                                                    <td>Bonus</td>
                                                    <td><?php echo $bonus;?></td>
                                                </tr>
                                               
                                                <tr>
                                                    <td></td>
                                                    <td><strong>Total Earnings</strong></td>
                                                    <td><strong><?php echo ($salary - $paid)+$bonus;?></strong></td>
                                                </tr>
                                            </tbody>                                            
                                        </table>
                                    </div>
                                </div>
                                                   
                            <hr>
                            <div class="row clearfix">
                              
                                <div class="col-md-12 text-left">
                                    <p ><b>Total Salary:</b> <?php echo round($salary) ;?></p>
                                    <p ><b>Total Advance:</b> <?php echo round($paid) ;?> </p>
                                    <p ><b>Total Bonus:</b> <?php echo round($bonus) ;?> </p>
                                    <h5 >Net Salary : <?php $amount=round(($salary - $paid));echo round(($salary - $paid) + $bonus);?> /-</h5>
                                </div>                                    
                                <div class="hidden-print col-md-12 text-left">
                                    <hr>
                                    <form action="operations/add_salary.php" method="post"  enctype="multipart/form-data">
                                        <input type="hidden" name="staff_mem_id" value="<?php echo $id;?>">
                                        <input type="hidden" name="staff_mem_salary" value="<?php echo $amount;?>">
                                        
                                        <button class="btn btn-primary" type="Submit" <?php echo $hidden;?>>Submit</button>
                                           
                                    </form>
                                   <!--  <button class="btn btn-outline-secondary" onclick="window.print();"><i class="icon-printer"></i></button> -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</div>

<!-- Javascript -->
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>
</body>
 <script>
    $(document).ready(function() {
    $(".select_group").select2();
});

  </script>
<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/payroll-payslip.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
