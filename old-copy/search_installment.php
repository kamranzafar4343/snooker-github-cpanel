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
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="m-t-30"><img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-icon.svg" width="48" height="48" alt="Lucid"></div>
        <p>Please wait...</p>        
    </div>
</div>
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
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Recovery  Report</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item"> Recovery Report</li>
                            <li class="breadcrumb-item active"></li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>
<?php 
  

if($_POST)
{
  $month=mysqli_real_escape_string($conn,$_POST['month']);
  $acc_val=mysqli_real_escape_string($conn,$_POST['acc_val']);
  $salesman1=mysqli_real_escape_string($conn,$_POST['salesman']);
  $ser_value=mysqli_real_escape_string($conn,$_POST['ser_value']);;
  
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
   $date_to = date(''.$year.'-'.$month.'-01');
   $date_for = date('Y-m-01',strtotime($date_to));
    $hide='0';

  // $new_date = date("Y-".$month."-01",strtotime($date."+".$month." month"));

  
}
else
{
    $acc_val='0';
    $hide='0';
    $salesman1='All';
    $ser_value='0';
    $date=date('Y-m-d');

    $time = new DateTime($date);
    $year = $time->format('Y');
    $month = $time->format('m');
    $date_to = date(''.$year.'-'.$month.'-01');
    $date_for = date('Y-m-01',strtotime($date_to));
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
}
  if($month=="All")
  {
    $where_date="";
    
  }else 
  {
    $where_date = "and MONTH(created_date)='$month' and YEAR(created_date)='$year'";
    
  }

  // $cat=mysqli_real_escape_string($conn,$_POST['cat']);
  // $items=mysqli_real_escape_string($conn,$_POST['items']); 
  ?>    
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

                         <form  action="search_installment.php" method="post" enctype="multipart/form-data">
                        <div class="body">

                            <div class="row clearfix">
                                <div class="col-md-2 col-sm-12  text-right">
                                         <label   for="description">Month </label>
                           </div>
                              <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                  
                                    <select class="form-control select_group" name="month" >
                                 
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
                            </div>
                                  <div class="row clearfix">
                                    <div class="col-md-2 text-right" >
                                         <label for="description">Year </label>
                                    </div>
                              <div class="col-md-5 ">

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
                            </div>
                                 <div class="row clearfix">
                                    <div class="col-md-2 text-right">
                                         <label for="description">AVO's </label>
                                  </div>
                                <div class="col-md-5 col-sm-12">
                                    <div class="form-group">
                                    <select class="form-control select_group" name="salesman" >
                                        <option value="All">All</option>
                                        <?php
                                        $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $sql="SELECT username,s_id,designation  FROM tbl_salesmen where designation LIKE '%avo%'"; 
                                }
                                else
                                {
                                  $sql="SELECT username,s_id,designation  FROM tbl_salesmen where designation LIKE '%avo%' and  created_by='$userid'"; 
                          
                                }
                                        
                                foreach ($conn->query($sql) as $row){
                                        if($row[s_id]==$salesman1)
                                            {
                                            echo "<option value=$row[s_id] selected>$row[username]</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value=$row[s_id]>$row[username]</option>"; 
                                            }
                                        }
                                            echo "</select>";
                                             ?>
</select>
    </div>
      </div>
 </div>
 <div class="row">
                                    <div class="col-md-2 text-right">
                                   <label>Values</label>
                                   </div>
                                    <div class="col-md-5 col-sm-12">
                                        <select class="form-control select_group" name="ser_value" >
                                       
                                    <?php 
                                   if($_POST)
                                            {
                                                $ser_value = $_POST['ser_value'];
                                            }
                                            else
                                            {
                                                $date=date('Y-m-d');
                                                $time = new DateTime($date);
                                                $month = $time->format('m');
                                            }
                                            for($c=0; $c<=2; $c++){
                                              if($c =='0'){
                                                $value_name='All';
                                              }if($c =='1'){
                                                $value_name='Recovered';
                                              }if($c =='2'){
                                                $value_name='Pending';
                                              }
                                            if($c==$ser_value)
                                            {
                                            echo "<option value='$c' selected>$value_name</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value='$c'>$value_name</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                                         </select>
                                       
                                </div>
                                
                                </div><br>
                                <div class="row">
                                    <div class="col-md-2 text-right">
                                   <label>Accounts</label>
                                   </div>
                                    <div class="col-md-5 col-sm-12">
                                        <select class="form-control select_group" name="acc_val" >
                                       
                                    <?php 
                                   if($_POST)
                                            {
                                                $acc_val = $_POST['acc_val'];
                                            }
                                            else
                                            {
                                                $acc_val = 0;
                                            }
                                            for($a=0; $a<=2; $a++){
                                              if($a =='0'){
                                                $value_name='All';
                                              }if($a =='1'){
                                                $value_name='Regular Account';
                                              }if($a =='2'){
                                                $value_name='Fresh Accounts';
                                              }
                                            if($a==$acc_val)
                                            {
                                            echo "<option value='$a' selected>$value_name</option>"; 
                                            }
                                            else
                                            {
                                            echo "<option value='$a'>$value_name</option>"; 
                                            }
                                            }

                                             echo "</select>";
                                             ?>
                                         </select>
                                       
                                </div>
                                
                                </div><br>

                          <div style="margin-right: 25%;" class="text-center">
                            <button style="width:25%; " type="submit" class="btn btn-primary" name="purchase_rep" target='_blank'>Search</button>
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
          
                            if($salesman1=='All'){
                              $vendornamee="All";
                            }else{
                        $sqll=mysqli_query($conn, "SELECT * FROM tbl_salesmen where  s_id=$salesman1");
                        $dataa=mysqli_fetch_assoc($sqll);
                        $vendornamee = $dataa['username'];
                        
                        if(!$vendornamee){
                          $vendornamee='All';
                        }
                         }  ?>  

                               <div class="row">
                                   <div class="clearfix text-left col-md-6" >

                            <span > <b>AVO  : </b> <?php if($vendorname==''){echo $vendornamee;} else {echo $vendornamee;}?></span>
                            <span > | <b>DATE  : </b> <?php if($date_for==''){echo $date_for;} else {echo $date_for;}?></span>
                          </div> 
                            <div class="clearfix text-right col-md-6" >

                            <span > <b>FOR MONTH : </b> <?php echo $month_name;?>
                       </span></div> </div> 
                            <hr>  
                                              <div class="row clearfix">
                                        <div class="col-md-12">
                                            <div class="table-responsive">
                                                <table id="example" class="display" style="width:100%">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>#</th> 
                                                            <th>Customer ID</th>  
                                                            <th>AVO Now</th>        
                                                            <th>Assigned Employee</th>
                                                            <th>Customer</th>
                                                            <th>Gurantor1</th>
                                                            <th>Gurantor2</th>
                                                            <th>Gurantor3</th>
                                                            <th>Gurantor4</th>
                                                            <th class="text-right">Amount</th>
                                                       
                                                            
                                                            <th class="text-right">Total Installments</th>
                                                            <th class="text-right">Total Paid</th>
                                                            <th class="text-right">Paid Installments</th>
                                                            <th class="hidden-sm-down text-right" hidden>Total Recovery</th>
                                                            <th class="hidden-sm-down text-right">Recoverd</th>
                                                            <th class="text-right">Pending</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                  
<?php

if($acc_val=='0' && $salesman1=="All")
{
  $where_acc="";
  $where="where installment_status='Pending' and";
}
else if($acc_val!='0' && $salesman1!="All")
{

  if($acc_val=='1')
  {
    $where_acc="and created_date <= DATE_FORMAT( CURRENT_DATE - INTERVAL 10 MONTH, '%Y/%m/01' ) and";
  }
  else
  {
    $where_acc="and created_date > DATE_FORMAT( CURRENT_DATE - INTERVAL 10 MONTH, '%Y/%m/01' ) and ";
  }
  $where = "where avo='$salesman1'";
  $where_old = "where old_avo='$salesman1'";
}
else if($acc_val=='0' && $salesman1!="All")
{
  $where_acc="";
  $where = "where avo='$salesman1' and";
  $where_old = "where old_avo='$salesman1' and";
}
else
{

  $where="";
  if($acc_val=='1')
  {
    $where_acc="where created_date <= DATE_FORMAT( CURRENT_DATE - INTERVAL 10 MONTH, '%Y/%m/01' ) and";
  }
  else
  {
    $where_acc="where created_date > DATE_FORMAT( CURRENT_DATE - INTERVAL 10 MONTH, '%Y/%m/01' ) and ";
  }
}

$query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {

                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where $where_acc  created_by!=''");
                                }
                                else
                                {
                                
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where $where_acc  created_by='$userid'");
                                  
                                }
 

$check=mysqli_num_rows($bsql);

 if($check==0){

                               if($user_privilege=='superadmin')
                                {
                               
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where_old $where_acc created_by!=''");
                                }
                                else
                                {
                                  
                                  $bsql=mysqli_query($conn,"SELECT * from tbl_installment  $where_old $where_acc  created_by='$userid'");
                                  
                                }


  //header("Location: search_installment.php?data=notfound");
  $check2=mysqli_num_rows($bsql);   

  if($check2==0)
  {
    ?>
    <script>
  //window.location.replace("search_installment.php?data=notfound");
   
</script>
  <?php }
 }
       

 $count = 0;

while($value1 = mysqli_fetch_assoc($bsql))   
                                { 
                                  $plan_id=$value1['plan_id'];
                                  $installment_status=$value1['installment_status'];
                                  $amount_recieved=$value1['amount_recieved'];
                                  $inst_created_date=$value1['created_date'];
                                  $inst_end_date=$value1['end_date'];
                                  $installment=$value1['per_month_amount'];
                                  if($inst_created_date<$date_for && $inst_end_date>$date_for)
                                  {
                                    $itemsql2=mysqli_query($conn,"SELECT SUM(installment_number) as paid,SUM(per_month_amount) as sum, plan_id from tbl_installment_payment where plan_id='$plan_id'");
                                      $value2 = mysqli_fetch_assoc($itemsql2);  
                                     $paid = $value2['paid'];
                                    if($paid!='')
                                    {
                                       $paid = $value2['paid'];
                                    }
                                    else
                                    {
                                      
                                       $paid = 0;
                                    }
                
                                  $query_details=mysqli_query($conn,"SELECT * FROM `tbl_installment_payment` WHERE Month('$date_for') between Month(from_Date) and Month(to_date) and Year('$date_for') between Year(from_Date) and Year(to_date) and plan_id='$plan_id'");
                                  if(mysqli_num_rows($query_details)>0)
                                    {
                                      $query_data = mysqli_fetch_assoc($query_details); 
                                      $recoverd_this_month = $query_data['per_month_amount'];
                                      $pending_this_month = 0;
                                  
                                    }
                                    else
                                    {
                                      $recoverd_this_month = 0;
                                      $pending_this_month = $installment;
                                    }
                                    $hide=0;
                                  }
                                  else
                                  {
                                    $hide=1;
                                  }
                                    
                              
                                 
                                 
                                  $period = $value1['period'];
                                  $gran1_name = $value1['gran1_name'];
                                  $gran1_mobile_no = $value1['gran1_mobile_no'];
                                  $gran2_name = $value1['gran2_name'];
                                  $gran2_mobile_no = $value1['gran2_mobile_no'];
                                  $gran3_name = $value1['gran3_name'];
                                  $gran3_mobile_no = $value1['gran3_mobile_no'];
                                  $gran4_name = $value1['gran4_name'];
                                  $gran4_mobile_no = $value1['gran4_mobile_no'];
                                  $customer = $value1['customer'];
                                  $down_payment = $value1['down_payment'];
                                  $installment1+=$installment;
                                  
                       
                        $assigned_avo = $value1['assigned_avo'];
                        $avo = $value1['avo'];

                        $total_price = $value1['total_price'];  
                        $query=mysqli_query($conn, "SELECT * FROM tbl_salesmen where  s_id=$assigned_avo");
                        $data4=mysqli_fetch_assoc($query);
                        $salesman_name = $data4['username'];
                         $query=mysqli_query($conn, "SELECT * FROM tbl_salesmen where  s_id=$avo");
                        $data4=mysqli_fetch_assoc($query);
                        $salesman_name_now = $data4['username'];
                         $query1=mysqli_query($conn, "SELECT * FROM tbl_customer where  customer_id=$customer");
                        $data3=mysqli_fetch_assoc($query1);
                        $customer_name = $data3['username']; 
                        $customer_id = $data3['seprate_customer_id'];
                        $mobile_no1 = $data3['mobile_no1'];  
                       
$count++;

if($hide==0)
{
  if($ser_value==0)
  {
    ?>

    <tr>
                                <td><?php echo $count;?></td>
                                <td><?php echo $customer_id;?></td>
                                <td><?php echo $salesman_name_now;?></td>
                                <td><?php echo $salesman_name;?></td>
                                <td><?php echo $customer_name." <br> ".$mobile_no1 ;?></td>
                                <td><?php echo $gran1_name." <br> ".$gran1_mobile_no ;?></td>
                                <td><?php echo $gran2_name." <br> ".$gran2_mobile_no ;?></td>
                                <td><?php echo $gran3_name." <br> ".$gran3_mobile_no ;?></td>
                                <td><?php echo $gran4_name." <br> ".$gran4_mobile_no ;?></td>
                                <td class="text-right"><?php echo $total_price;?></td>
                                <td class="text-right"><?php echo $period-1;?></td>
                                <td class="text-right"><?php echo $paid;?></td>
                                <td class="text-right"><?php echo $amount_recieved;?></td>
                                <td class="text-right"><?php echo round($recoverd_this_month, 0);?></td>
                                <td class="text-right"><?php echo round($pending_this_month, 0);?></td>
    </tr>
  <?php }
  else if($ser_value==1)
  {
    if($recoverd_this_month>0)
      {?>

      <tr>
                                  <td><?php echo $count;?></td>
                                  <td><?php echo $customer_id;?></td>
                                  <td><?php echo $salesman_name_now;?></td>
                                  <td><?php echo $salesman_name;?></td>
                                  <td><?php echo $customer_name." <br> ".$mobile_no1 ;?></td>
                                  <td><?php echo $gran1_name." <br> ".$gran1_mobile_no ;?></td>
                                  <td><?php echo $gran2_name." <br> ".$gran2_mobile_no ;?></td>
                                  <td><?php echo $gran3_name." <br> ".$gran3_mobile_no ;?></td>
                                  <td><?php echo $gran4_name." <br> ".$gran4_mobile_no ;?></td>
                                  <td class="text-right"><?php echo $total_price;?></td>
                                  <td class="text-right"><?php echo $period-1;?></td>
                                  <td class="text-right"><?php echo $paid;?></td>
                                  <td class="text-right"><?php echo $amount_recieved;?></td>
                                  <td class="text-right"><?php echo round($recoverd_this_month, 0);?></td>
                                  <td class="text-right"><?php echo round($pending_this_month, 0);?></td>
      </tr>
  <?php }
  }
  else if($ser_value==2)
  {
    if($recoverd_this_month==0)
      {?>

      <tr>
                                  <td><?php echo $count;?></td>
                                  <td><?php echo $customer_id;?></td>
                                  <td><?php echo $salesman_name_now;?></td>
                                  <td><?php echo $salesman_name;?></td>
                                  <td><?php echo $customer_name." <br> ".$mobile_no1 ;?></td>
                                  <td><?php echo $gran1_name." <br> ".$gran1_mobile_no ;?></td>
                                  <td><?php echo $gran2_name." <br> ".$gran2_mobile_no ;?></td>
                                  <td><?php echo $gran3_name." <br> ".$gran3_mobile_no ;?></td>
                                  <td><?php echo $gran4_name." <br> ".$gran4_mobile_no ;?></td>
                                  <td class="text-right"><?php echo $total_price;?></td>
                                  <td class="text-right"><?php echo $period-1;?></td>
                                  <td class="text-right"><?php echo $paid;?></td>
                                  <td class="text-right"><?php echo $amount_recieved;?></td>
                                  <td class="text-right"><?php echo round($recoverd_this_month, 0);?></td>
                                  <td class="text-right"><?php echo round($pending_this_month, 0);?></td>
      </tr>
  <?php }
  }
}
}?>
                                                       
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row clearfix">
                                        <div class="col-md-6">
                                   
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


    
</div>
            </div>
    
</body>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.print.min.js"></script>
<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
<script src="assets/select2/dist/js/select2.min.js"></script>


 <script type="text/javascript">
  $('.calculate').keyup(function(e)
                                {
  if (/\D/g.test(this.value))
  {
    // Filter non-digits from input value.
    this.value = this.value.replace(/\D/g, '');
  }
});
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
      "mColumns": [0, 1, 2, 3, 4, 5, 8, 9],
      searching: true,
      buttons: [
        {
          extend: 'pdfHtml5',
          
           title: 'Alkareem (Recovery Report)',
          
           orientation : 'landscape',
                pageSize : 'A3',
                

           
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
           customize: function (win) {
             $(win.document.body)
                 .css('font-size', '6pt');
     
             $(win.document.body).find('table')
                 .addClass('compact')
                 .css('font-size', 'inherit');
         },
          
          title: 'Alkareem (Recovery Report)',
          orientation : 'landscape',
                pageSize : 'A3',
               

          
        },


      ]


    });
} );
</script>

<script type="text/javascript">
            function getitem(){

    var cat_id = $('#cat_id').val();
   
      $.ajax({
                  method: "POST",
                  url: "operations/get_items.php",
                  data: {cat_id:cat_id},
                  dataType: 'json',                 
                })
                .done(function(response){
                   var len = response.length;

                     $("#item_id").empty();
                        for( var i = 0; i<len; i++){
                            var id = response[i]['id'];
                            var item_name = response[i]['item_name'];

                            $("#item_id").append("<option value='Alll'>All Item</option><option value='"+id+"'>"+item_name+"</option>");

                        }
           
                    
                });


}
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

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/client-add.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:13 GMT -->
</html>
