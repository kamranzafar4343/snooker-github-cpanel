 
<html lang="en">
<style type="text/css">
    

</style>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 08:59:42 GMT -->
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
<!-- Overlay For Sidebars -->

<div id="wrapper">
<?php
include "includes/navbar.php";

include "includes/sidebar.php";
?>



                        <?php
                        error_reporting(0);
                         $query=mysqli_query($conn, "SELECT user_privilege,dashboard FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $user_privilege1=$data['user_privilege'];
                                $dashboard=$data['dashboard'];
                                if($user_privilege1=='superadmin')
                                {
                                    $show_dashboard="";
                                }
                                else
                                {
                                    if($dashboard=='1')
                                    {
                                        $show_dashboard="";
                                    }
                                    else
                                    {
                                       $show_dashboard="hidden"; 
                                    }
                                }
                                $date=date('Y-m-d');
                                if($user_privilege=='superadmin')
                                {

                                    $sql=mysqli_query($conn, "SELECT SUM(gross_amount) as total FROM tbl_sale where  date(created_date) = DATE('$date')");

                                    $monthsql=mysqli_query($conn, "SELECT SUM(gross_amount) as total_month FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                    $sql2=mysqli_query($conn, "SELECT SUM(total_price) as dtotal, SUM(amount_recieved) as rtotal, SUM(total_price) as totalprice FROM tbl_installment where created_date = DATE(NOW())");


                                    $monthsql2=mysqli_query($conn, "SELECT SUM(total_price) as dtotal, SUM(amount_recieved) as rtotal, SUM(total_price) as totalprice FROM tbl_installment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                   
                                    $vendorsql = mysqli_query($conn,"SELECT  *  FROM tbl_vendors ");
                                    $custql = mysqli_query($conn,"SELECT  *  FROM tbl_customer ");

                                    $instql = mysqli_query($conn,"SELECT  SUM(per_month_amount) as total  FROM tbl_installment_payment where created_date = DATE(NOW()) ");
                         
                                    $pendinginstql = mysqli_query($conn,"SELECT  SUM(per_month_amount) as total_pending  FROM tbl_installment where created_date = DATE(NOW()) ");
                                    
                                    $instql2=mysqli_query($conn, "SELECT SUM(per_month_amount) as insttotal  FROM tbl_installment_payment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                    $pending_instql_monthly = mysqli_query($conn,"SELECT SUM(per_month_amount) as total_monthly_pending  FROM tbl_installment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                    $recievable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' ");

                                    $payable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_pay FROM `tbl_trans_detail` where LEFT(acode,6)='200200'");

                                    
                                }
                                else
                                {

                                    $query=mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
                                    $data = mysqli_fetch_assoc($query);
                                    $user_privilege=$data['user_privilege'];
                                    $created_by=$data['created_by'];
                                    if($user_privilege=='branch')
                                    {
                                       $created_by=$userid; 
                                    }
                                    else
                                    {
                                        $created_by=$created_by; 
                                    }

                                    $sql=mysqli_query($conn, "SELECT SUM(gross_amount) as total FROM tbl_sale where  created_date = DATE(NOW()) and parent_id='$created_by' ");

                                    $monthsql=mysqli_query($conn, "SELECT SUM(gross_amount) as total_month FROM tbl_sale where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");

                                     

                                    
                                    $sql2=mysqli_query($conn, "SELECT SUM(total_price) as dtotal, SUM(amount_recieved) as rtotal, SUM(total_price) as totalprice FROM tbl_installment where created_date = DATE(NOW()) and parent_id='$created_by'");


                                    $monthsql2=mysqli_query($conn, "SELECT SUM(total_price) as dtotal, SUM(amount_recieved) as rtotal, SUM(total_price) as totalprice FROM tbl_installment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");

                                   
                                    $vendorsql = mysqli_query($conn,"SELECT  *  FROM tbl_vendors where created_by='$created_by'");
                                    $custql = mysqli_query($conn,"SELECT  *  FROM tbl_customer where parent_id='$created_by'");

                                    $instql = mysqli_query($conn,"SELECT  SUM(per_month_amount) as total  FROM tbl_installment_payment where created_date = DATE(NOW()) and parent_id='$created_by'");
                                    $pendinginstql = mysqli_query($conn,"SELECT  SUM(per_month_amount) as total_pending  FROM tbl_installment where created_date = DATE(NOW()) and parent_id='$created_by'");

                                    $instql2=mysqli_query($conn, "SELECT SUM(per_month_amount) as insttotal  FROM tbl_installment_payment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");

                                    $pending_instql_monthly = mysqli_query($conn,"SELECT SUM(per_month_amount) as total_monthly_pending  FROM tbl_installment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())  and parent_id='$created_by'");
                                    $recievable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' and parent_id='$created_by'");

                                    $payable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_pay FROM `tbl_trans_detail` where LEFT(acode,6)='200200' and parent_id='$created_by'");

                                  
                                }
                        
                       
                      
                        $recievable_tot=mysqli_fetch_assoc($recievable);
                        $tot_rec=$recievable_tot['total_rec'];

                        $payable_tot=mysqli_fetch_assoc($payable);
                        $tot_pay=$payable_tot['total_pay'];
                 

                        
                        
                        $tvendor = mysqli_num_rows($vendorsql);
                       
                        $tcust = mysqli_num_rows($custql);
                        
                        

                        $instl=mysqli_fetch_assoc($instql);                        
                        $total = $instl['total'];

                        

                        $instltot=mysqli_fetch_assoc($instql2);
                        $totalinstl = $instltot['insttotal'];

                        $pending_instql=mysqli_fetch_assoc($pendinginstql);
                        $total_pending = $pending_instql['total_pending'];

                        $pending_instql_monthly_result=mysqli_fetch_assoc($pending_instql_monthly);
                        $total_monthly_pending = $pending_instql_monthly_result['total_monthly_pending'];

                        

                        $totalpayable =$totalpay-$totalinstl; 
                        $weekinstal1=mysqli_fetch_assoc($weekisntlsql1);
                        $lweekinstal=mysqli_fetch_assoc($lweek_instl_sql1);
                        $cur_week_cash=$weekinstal1['totalprice'];
                        $l_week_cash=$lweekinstal['totalprice'];
                        if($l_week_cash==''){
                            $l_week_cash=$cur_week_cash;
                        }
                        $instlRatio= ($cur_week_cash/$l_week_cash)*100;
                       

                        $weeksale1=mysqli_fetch_assoc($weeksalesql1);
                        $lweeksale=mysqli_fetch_assoc($lweek_sale_sql1);
                        // print_r($lweeksale);
                        $cur_week_sale=$weekinstal1['totalprice'];
                        $l_week_sale=$lweekinstal['totalprice'];
                        if($l_week_sale==''){
                            $l_week_sale=$cur_week_sale;
                        }
                        $saleRatio= ($cur_week_sale/$l_week_sale)*100;
                        $PendRatio=$saleRatio-$instlRatio;

                        

                        $monthinstal1=mysqli_fetch_assoc($monthisntlsql1);
                        $lmonthinstal=mysqli_fetch_assoc($lmonth_instl_sql1);
                        $cur_month_cash=$monthinstal1['totalprice'];
                        $l_month_cash=$lmonthinstal['totalprice'];
                        if($l_month_cash==''){
                            $l_month_cash=$cur_month_cash;
                        }
                        $monthinstlRatio= ($cur_month_cash/$l_month_cash)*100;
                        
                         
                        while($pdata = mysqli_fetch_assoc($month2)){
                            $a += $pdate['sale_id'];
                            // print_r($a);
                        }
                        

                        $monthsale1=mysqli_fetch_assoc($monthsalesql1);
                        $lmonthsale=mysqli_fetch_assoc($lmonth_sale_sql1);

                            // print_r(
                        // print_r($a);
                        $cur_month_sale=$monthsale1['totalprice'];
                        $l_month_sale=$lmonthsale['totalprice'];
                        if($l_month_sale==''){
                            $l_month_sale=$cur_month_sale;
                        }
                        $monthsaleRatio= ($cur_month_sale/$l_month_sale)*100;
                        $PendMonthRatio=$monthsaleRatio-$monthinstlRatio;
                        // print_r($instlRatio);
                        $data2=mysqli_fetch_assoc($sql2);
                        $monthdata2=mysqli_fetch_assoc($monthsql2);
                        $mdtotal = $monthdata2['dtotal'];
                        $rdtotal = $monthdata2['rtotal'];

                        $dtotal = $data2['dtotal'];
                        
                        if ($dtotal=='') {
                            $dtotal=0;
                        }
                     
                        if ($mdtotal=='') {
                            $mdtotal=0;
                        }
                        if ($rdtotal=='') {
                            $rdtotal=0;
                        }
                        $totalprice=$data2['totalprice'];
                        $monthtotalprice=$monthdata2['totalprice'];
                        // print_r($mdtotal);
                        $today_Instalsale = $dtotal;
                        $month_Instalsale = $mdtotal;
                        // $today_Instalsale = ;
                        $pending_daily=$totalprice-$today_Instalsale;
                        $pending_monthly=$monthtotalprice-$month_Instalsale;
                        // print_r($pending_daily);
                        $data=mysqli_fetch_assoc($sql);
                        $todaysale = $data['total'];
                        // print_r($data);
        $totalamount = $month_sale+$month_Instalsale+$pending_monthly;
        $monthly_sale_p=floor(($month_sale/$totalamount)*100);
        $monthly_Instal_p=floor(($month_Instalsale/$totalamount)*100);
        $monthly_pend_p=floor(($pending_monthly/$totalamount)*100);
        $f_date=date('Y-m-d');
        $t_date=date('Y-m-d');
        $fm_date=date('Y-m-01');
        $tm_date = date("Y-m-01",strtotime($date."+1 month"));

                         ?>

    <div id="main-content">
        <?php
              
                         if(isset($_GET['permission']) && $_GET['permission']=='fail' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Look's like you don't have permission to view this page.
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
              
                if($dashboard==0 && $user_privilege!='superadmin'){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry !</strong> Look's like you don't have permission to view Dashboard.
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
        <div class="container-fluid" <?php echo $show_dashboard;?>>
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> Dashboard</h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>                            
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>  
                   
                    <?php include "includes/graph.php";?>
                </div>
            </div>
  

                <br>
            <div class="row clearfix">
                    
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-info">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php echo number_format($todaysale, 0, ".", ",") ; ?></h3>
                                    <span>Daily Cash Sale</span>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                   <div class="col-lg-3 col-md-6 col-sm-6">
                     <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Credit" target="_blank">
                        <div class="card text-center bg-secondary">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php 
                                    $sql_exp_daily =mysqli_query($conn, "SELECT  SUM(d_amount-c_amount) as daily_exp FROM tbl_trans_detail WHERE left(acode, 3)='500' and DATE(created_date) = DATE(NOW()) and parent_id='$created_by'");
                                    $expsqldaily=mysqli_fetch_assoc($sql_exp_daily);
                                     $daily_exp=$expsqldaily['daily_exp'];
                                    echo number_format($daily_exp, 0, ".", ",") ; ?></h3>
                                    <span>Daily Expence</span>
                                </div>
                            </div>
                        </div>
                  
                    </a>                
                </div> 
                <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card text-center bg-warning">
                            <div class="body">
                                <div class="p-15 text-dark">
                                    <!-- <h3><?php echo number_format($total, 0, ".", ",") ; ?></h3>
                                    <span>Daily Recovery</span> -->
                                    
                                     <h3><?php if($tot_rec){
                                    echo round($tot_rec);}else{echo  "RS - 0";}
                                        ?></h3>
                                        <span>Total Recievable</span>
                                </div>
                            </div>
                        </div>              
                </div> 
                <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card text-center bg-dark">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <?php
                                    $date_for=date('Y-m-d');
                                    $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                    $data = mysqli_fetch_assoc($query);
                                    $user_privilege=$data['user_privilege'];
                                    $pending_today=0;
                                    if($user_privilege=='superadmin')
                                    {

                                      $bsql=mysqli_query($conn,"SELECT * from tbl_installment WHERE installment_status='Pending'");
                                    }
                                    else
                                    {
                                    
                                      $bsql=mysqli_query($conn,"SELECT * from tbl_installment WHERE installment_status='Pending' and created_by='$userid'");
                                      
                                    }
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
                                        
                                        $query_details=mysqli_query($conn,"SELECT * FROM `tbl_installment_payment` WHERE Day('$date_for') between Day(from_Date) and Day(to_date) AND Month('$date_for') between Month(from_Date) and Month(to_date) and Year('$date_for') between Year(from_Date) and Year(to_date) and plan_id='$plan_id'");
                                          if(mysqli_num_rows($query_details)>0)
                                            {
                                              $query_data = mysqli_fetch_assoc($query_details); 
                                              $recoverd_this_month = $query_data['per_month_amount'];
                                              $pending_today += 0;
                                          
                                            }
                                            else
                                            {
                                              $recoverd_this_month = 0;
                                              $pending_today += $installment;
                                            }
                                            
                                       }

                                    }
                                  

                                    ?>
                                    <!-- <h3><?php if($pending_today > 0){echo $pending_today;} else { echo 0;}?></h3>
                                    <span>Daily Pending Recovery</span> -->

                                    <h3><?php echo round($tot_pay); ?></h3>
                                    <span>Total Payable</span>
                                    
                                </div>
                            </div>
                        </div>              
                </div> 
              

            
        </div>  <br>
            <div class="row clearfix">
             
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="single_sale.php?fdate=<?php echo $fm_date ?>&tdate=<?php echo $tm_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-info">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php 
                                    $datamonth=mysqli_fetch_assoc($monthsql);
                                    $month_sale=$datamonth['total_month'];
                                    echo number_format($month_sale, 0, ".", ",") ; ?></h3>
                                    <span>Monthly Cash Sale</span>
                                </div>
                            </div>
                        </div>     
                    </a>         
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="single_sale.php?fdate=<?php echo $fm_date ?>&tdate=<?php echo $tm_date ?>&sale_type=Credit" target="_blank">
                        <div class="card text-center bg-secondary">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php 
                                    $sql_exp_mon =mysqli_query($conn, "SELECT  SUM(d_amount-c_amount) as mon_exp FROM tbl_trans_detail WHERE left(acode, 3)='500' AND MONTH(created_date) = MONTH(CURRENT_DATE()) AND YEAR(created_date) = YEAR(CURRENT_DATE()) AND parent_id='$created_by'");
                                    $expsqlmon_exp=mysqli_fetch_assoc($sql_exp_mon);
                                     $mon_exp=$expsqlmon_exp['mon_exp'];
                                    echo number_format($mon_exp, 0, ".", ",") ; ?></h3>
                                    <span>Monthly Expence</span>
                                </div>
                            </div>
                        </div>     
                    </a>         
                </div>
                
                <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card text-center bg-warning">
                            <div class="body">
                                <div class="p-15 text-dark">
                                    <!-- <h3><?php echo number_format($totalinstl, 0, ".", ",") ; ?></h3>
                                    <span>Monthly  Recovery</span> -->
                                   <!--  <h3><?php echo $tcust; ?></h3>
                                    <span>Total Customer</span> -->
                                    
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
             
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '100100000') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $cash_now=$opening_bal+$cash_in_hand;
                }
                else
                {
                  if($branch_id=='')
                  {
                    $sql="SELECT branch_id FROM users where user_id='$created_by'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_id = $data['branch_id'];
                          
                         }

                  }
                  
                  $sql7=mysqli_query($conn, "SELECT SUM(total_amount) as cash_transfer FROM `tbl_trans` WHERE account_id='$branch_id'");

                  $data7=mysqli_fetch_assoc($sql7);
                  $cash_transfer = $data7['cash_transfer'];

                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '300200100', '$branch_id') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand']+$cash_transfer;

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account_lv2` WHERE acode='$branch_id'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $cash_now=$opening_bal+$cash_in_hand;
                }?>
                
                                <h3>
                                <?php
                                if($cash_now){
                                    echo number_format($cash_now, 0, ".", ",");}else{echo  "RS - 0";}
                                 ?></h3>
                                 <span>Cash in Hand</span>
                                </div>
                            </div>
                        </div>              
                </div> 
                
                <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card text-center bg-dark">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <?php
                                    $date_for=date('Y-m-d');
                                    $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                    $data = mysqli_fetch_assoc($query);
                                    $user_privilege=$data['user_privilege'];
                                    $pending_this_month=0;
                                    if($user_privilege=='superadmin')
                                    {

                                      $bsql=mysqli_query($conn,"SELECT * from tbl_installment WHERE installment_status='Pending'");
                                    }
                                    else
                                    {
                                    
                                      $bsql=mysqli_query($conn,"SELECT * from tbl_installment WHERE installment_status='Pending' and created_by='$userid'");
                                      
                                    }
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
                                        
                                        $query_details=mysqli_query($conn,"SELECT * FROM `tbl_installment_payment` WHERE Month('$date_for') between Month(from_Date) and Month(to_date) and Year('$date_for') between Year(from_Date) and Year(to_date) and plan_id='$plan_id'");
                                          if(mysqli_num_rows($query_details)>0)
                                            {
                                              $query_data = mysqli_fetch_assoc($query_details); 
                                              $recoverd_this_month = $query_data['per_month_amount'];
                                              $pending_this_month += 0;
                                          
                                            }
                                            else
                                            {
                                              $recoverd_this_month = 0;
                                              $pending_this_month += $installment;
                                            }
                                            
                                       }

                                    }
                                  

                                    ?>
                                    <!-- <h3><?php if($pending_this_month > 0){echo $pending_this_month;} else { echo 0;}?></h3>
                                    <span>Monthly Pending Recovery</span> -->

                                   
                                   <form  action="operations/backup.php" method="post" enctype="multipart/form-data">
                                    <button type="submit" class="btn btn-dark" name="create_backup"><h3>Create Backup</h3></button>
                                   
                                    </form>
                                </div>
                            </div>
                        </div>              
                </div> 
            
                
           

            
        </div>
        <div class="row clearfix">
                <div class="col-lg-6">
                    <div class="card" style="max-height: 270px; overflow-y: auto;">
                        
                        <div class="mail-inbox">
                           
                            <div class="col-md-12 mail-right">
                                <div class="header d-flex align-center"  style="padding: 20px 20px 2px 20px;">
                                    <h2>Notification List</h2>
                                    <!-- <form class="ml-auto">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search Mail" aria-label="Search Mail" aria-describedby="search-mail">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="search-mail"><i class="icon-magnifier"></i></span>
                                            </div>
                                        </div>
                                    </form> -->
                                </div>
                                
                                <div class="mail-list" style="max-height: 290px;">
                                    <ul class="list-unstyled">
                                            <?php
                                          
                                                $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                                $data = mysqli_fetch_assoc($query);
                                                $user_privilege=$data['user_privilege'];
                                                if($user_privilege=='superadmin')
                                                {
                                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where stock_status='Pending' and transfer_type='0' and admin_read='0' order by purchase_req_id desc limit 5");
                                                
                                                $count=0;
                                                while($pdata = mysqli_fetch_assoc($sql))   
                                                {
                                                    $count++; 
                                                    if($count=='0')
                                                {?>
                                                    <div class="alert alert-info" id="danger-alert">
  
                                                      <strong>Sorry !</strong> no notification found.
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
                                                <?php }
                                                    $purchase_req_id=$pdata['purchase_req_id'];
                                                    $admin_read=$pdata['admin_read'];
                                                    $remarks=$pdata['po_remarks'];
                                                    $invoice_date=$pdata['created_date'];
                                                    if ($admin_read=='1')
                                                    {
                                                        $read="";
                                                        $hide_button="hidden";
                                                    }
                                                    else
                                                    {
                                                        $read="unread";
                                                        $hide_button="";
                                                    }      
                                                    $location=$pdata['location'];
                                                    $bsql1=mysqli_query($conn,"SELECT * from users where user_id='$location'");
                                                    $pdata1 = mysqli_fetch_assoc($bsql1);
                                                    $branch_name=$pdata1['user_name'];


                                            ?>
                                        <li class="clearfix <?php echo $read;?>">
                                            <div class="mail-detail-right">
                                                <h6 class="sub"><a href="main_purchase_req_list.php" class="mail-detail-expand"><?php echo $branch_name;?></a> has request<span class="badge badge-danger mb-0">Stock Demand</span></h6>
                                                <p class="dep"><span class="m-r-10">[Remarks]</span><?php echo $remarks;?>.</p>
                                                <span class="time"><?php echo $invoice_date;?></span>
                                            </div>
                                            <div class="hover-action" <?php echo $hide_button;?>>
                                                <a class="btn btn-warning mr-2 mark_as_read" href="javascript:void(0);" data-id="<?php echo $purchase_req_id;?>">Mark as read</a>
                                                
                                            </div>
                                        </li>
                                        <?php }
                                         }
                                         else
                                            {
                                                    
                                                  $sql20 = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where location='$userid' and item_transfer!='' and stock_receive_status='Pending' and branch_read='0' order by purchase_req_id desc limit 5");
                                                  $count4=0;
                                                while($pdata = mysqli_fetch_assoc($sql20))   
                                                {
                                                    $count4++; 
                                                   
                                                    if($count4=='0')
                                                {?>
                                                    <div class="alert alert-info" id="danger-alert">
  
                                                      <strong>Sorry !</strong> no notification found.
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
                                                    <?php }
                                                    $purchase_req_id=$pdata['purchase_req_id'];
                                                    $branch_read=$pdata['branch_read'];
                                                    $invoice_no=$pdata['invoice_no'];
                                                    $remarks=$pdata['po_remarks'];
                                                    $invoice_date=$pdata['created_date'];
                                                    $transfer_type=$pdata['transfer_type'];
                                                    $admin_read=$pdata['admin_read'];
                                                    $branch_read=$pdata['branch_read'];
                                                    if($transfer_type=='1')
                                                    {
                                                        $noti='<span class="badge badge-success mb-0"> Direct Transfer # '.$purchase_req_id.'</span>';
                                                         $link='transfer_list.php';
                                                    }
                                                    else if($transfer_type=='2')
                                                    {
                                                        $noti='<span class="badge badge-success mb-0"> Doc # '.$invoice_no.'</span>';
                                                         $link='branch_stock_in_list.php';
                                                    }
                                                    else
                                                    {
                                                        $noti='<span class="badge badge-success mb-0"> Req Transfer # '.$purchase_req_id.'</span>';
                                                        $link='purchase_req_list.php';
                                                    }
                                                   
                                                    if ($user=='superadmin')
                                                    {
                                                        $read="";
                                                    }
                                                    else
                                                    {
                                                        $read="unread";
                                                    }      
                                                    $from_location=$pdata['from_location'];

                                                    $bsql1=mysqli_query($conn,"SELECT * from users where user_id='$from_location'");
                                                    $pdata1 = mysqli_fetch_assoc($bsql1);
                                                    $branch_name=$pdata1['user_name'];


                                            ?>
                                        <li class="clearfix <?php echo $read;?>">
                                            <div class="mail-detail-right">
                                                <h6 class="sub"><a href="<?php echo $link;?>" class="mail-detail-expand"><?php echo $branch_name;?></a> has transferred goods against <?php echo $noti;?></h6>

                                                <p class="dep"><span class="m-r-10">[Remarks]</span><?php echo $remarks;?>. <span class="badge badge-info mb-0"> Pending </span></p>
                                                <span class="time"><?php echo $invoice_date;?></span>

                                            </div>
                                            
                                            <div class="hover-action">
                                                 <a class="btn btn-warning mr-2 mark_as_read" href="javascript:void(0);" data-id="<?php echo $purchase_req_id;?>">Mark as read</a>
                                            </div>
                                        </li>
                                        <?php }
                                        $sql20 = mysqli_query($conn,"SELECT * FROM tbl_local_purchase where branch_id='$userid' and user_read='0' group by pur_req_id desc limit 5");
                                                  $count4=0;
                                                while($pdata = mysqli_fetch_assoc($sql20))   
                                                {
                                                    $count4++; 
                                                   
                                                    if($count4=='0')
                                                {?>
                                                    <div class="alert alert-info" id="danger-alert">
  
                                                      <strong>Sorry !</strong> no notification found.
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
                                                    <?php }
                                                    $pur_req_id=$pdata['pur_req_id'];
                                                    $branch_read=$pdata['branch_read'];
                                                    $invoice_no=$pdata['invoice_no'];
                                                    $remarks=$pdata['remarks'];
                                                    $invoice_date=$pdata['created_date'];
                                                    $transfer_type=$pdata['transfer_type'];
                                                    $admin_read=$pdata['admin_read'];
                                                    $branch_read=$pdata['branch_read'];
                                                 
                                                        $noti='<span class="badge badge-success mb-0">has Allowed Local Purchase Against Stock Demand # '.$pur_req_id.'</span>';
                                                        $link='single_purchase.php';
                                                    
                                                   
                                                    if ($user=='superadmin')
                                                    {
                                                        $read="";
                                                    }
                                                    else
                                                    {
                                                        $read="unread";
                                                    }      
                                                    $from_location=$pdata['from_location'];

                                                    $bsql1=mysqli_query($conn,"SELECT * from users where user_id='1'");
                                                    $pdata1 = mysqli_fetch_assoc($bsql1);
                                                    $branch_name=$pdata1['user_name'];


                                            ?>
                                        <li class="clearfix <?php echo $read;?>">
                                            <div class="mail-detail-right">
                                                <h6 class="sub"><a href="<?php echo $link;?>" class="mail-detail-expand"><?php echo $branch_name;?></a>  <?php echo $noti;?></h6>

                                                <p class="dep"><span class="m-r-10">[Remarks]</span><?php echo $remarks;?>. <span class="badge badge-info mb-0"> Pending </span></p>
                                                <span class="time"><?php echo $invoice_date;?></span>

                                            </div>
                                            
                                            <div class="hover-action">
                                                 <a class="btn btn-warning mr-2 mark_as_read_local" href="javascript:void(0);" data-id="<?php echo $pur_req_id;?>">Mark as read</a>
                                            </div>
                                        </li>
                                        <?php }
                                                }?>
                                       
                                        
                                    </ul>
                                </div>
                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="card top_counter">
                        <div class="body">
                            <div class="icon"><i class="fa fa-user"></i> </div>
                            <div class="content">
                                <div class="text">Total Vendor</div>
                                <h5 class="number"><?php echo $tvendor; ?></h5>
                            </div>
                            <hr>
                            <div class="icon"><i class="fa fa-users"></i> </div>
                            <div class="content">
                                <div class="text">Total Customer</div>
                                <h5 class="number"><?php echo $tcust; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12">
                    <div class="card top_counter">
                        <div class="body">
                            <?php if($privilige == 'branch'){ ?>
                            <div class="icon"><i class="fa fa-money"></i> </div>
                            <div class="content">
                                <div class="text">Total Target</div>
                                <h5 class="number"><?php 

                                $sql=mysqli_query($conn, "SELECT target FROM tbl_branch_target where branch_id='$userid'");  
                                    $data1=mysqli_fetch_assoc($sql);
                                    $target = $data1['target'];

                                if($target){
                                    echo round($target);}else{echo  "RS - 0";}
                                 ?></h5>
                            </div>
                            <hr>
                        <?php }?>
                            <div class="icon"><i class="fa fa-money"></i> </div>
                            <div class="content">
                                <div class="text">Cash In Hand</div>
                                <h5 class="number"><?php 
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
             
                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '300200100', '100100000') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $cash_now=$opening_bal+$cash_in_hand;
                }
                else
                {
                  if($branch_id=='')
                  {
                    $sql="SELECT branch_id FROM users where user_id='$created_by'";
                        $result1 = mysqli_query($conn,$sql);
                        while($data = mysqli_fetch_array($result1) ){
                          
                          $branch_id = $data['branch_id'];
                          
                         }

                  }
                  
                  $sql7=mysqli_query($conn, "SELECT SUM(total_amount) as cash_transfer FROM `tbl_trans` WHERE account_id='$branch_id'");

                  $data7=mysqli_fetch_assoc($sql7);
                  $cash_transfer = $data7['cash_transfer'];

                  $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100', '300100300', '300200100', '$branch_id') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand']+$cash_transfer;

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account_lv2` WHERE acode='$branch_id'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $cash_now=$opening_bal+$cash_in_hand;
                }
                


                                if($cash_now){
                                    echo number_format($cash_now, 0, ".", ",");}else{echo  "RS - 0";}
                                 ?></h5>
                            </div>
                             <hr>
                             <div class="icon"><i class="fa fa-money"></i> </div>
                             <div class="content">
                                <div class="text">Total Recievable</div>
                                <h5 class="number"><?php if($tot_rec){
                                    echo round($tot_rec);}else{echo  "RS - 0";}
                                 ?></h5>
                            </div>
                            <hr>
                            <div class="icon"><i class="fa fa-money"></i> </div>
                            <div class="content">
                                <div class="text">Total Payable</div>
                                <h5 class="number"><?php
                                    echo round($tot_pay);
                                 ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        <div class="row clearfix">
            <div class="col-lg-6 col-md-6">
                    <div class="card text-center">
                        <div class="body">

                            <h5>Income Analysis</h5>
                            <!-- <span>8%    High then last month</span> -->
                            <div class="sparkline-pie m-t-20"><?php

                             echo $monthly_sale_p; ?>,<?php echo $monthly_Instal_p; ?>,<?php echo $monthly_pend_p;?></div>
                            <div class="stats-report m-b-30">
                                <div class="stat-item">
                                <h5>Cash</h5>
                                <b class="col-black"><?php echo ($monthly_sale_p); ?>%</b></div>
                                <div class="stat-item">
                                <h5>Installment</h5>
                                <b class="col-black"><?php echo $monthly_Instal_p; ?>%</b></div>
                                <div class="stat-item">
                                <h5>Pending</h5>
                                <b class="col-black"><?php echo $monthly_pend_p; ?>%</b></div>
                            </div>
                            <span id="sparkline-compositeline">8,4,0,0,0,0,1,4,4,10,10,10,10,0,0,0,4,6,5,9,10</span>
                        </div>
                    </div>                    
                </div>
                
                
                
                <div class="col-lg-6 col-md-12" >
                    <div class="card" style="max-height: 380px;">
                        <div class="header" style="padding: 20px 20px 2px 20px;">
                            <h2><strong>Staff Detail</strong></h2>
                            
                        </div>
                        <div class="body">
                            <div class="table-responsive" style="max-height: 290px;">
                                <table class="table table-hover">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th>#</th> 
                                            <th>UserName</th>          
                                            <th>Designation</th>
                                            <th>Mobile No</th>
                                            <!-- <th>Image</th> -->
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($user_privilege=='superadmin')
                                        {
                                            $bsql=mysqli_query($conn,"SELECT * from tbl_salesmen ") ;
                                        }
                                        else
                                        {
                               
                                            $bsql=mysqli_query($conn,"SELECT * from tbl_salesmen where created_by='$userid'");
                                        }
                                        
                                          $count = 0;
                                    while($value = mysqli_fetch_assoc($bsql))
                                    {
                                        $username = $value['username'];
                                        $designation = $value['designation'];
                                        $mobile = $value['mobile_no1'];
                                        $user_profile = $value['user_profile'];
                                        $count++;
                                    

                                         ?>
                                         <!-- <div class='row'> -->
                                         <tr class='row-eq-height'>
                                             <td><?php echo $count; ?></td>
                                             <td><?php echo $username; ?></td>
                                             <td><?php echo $designation; ?></td>
                                             <td><?php echo $mobile; ?></td>
                                             <!-- <td><img class="img-responsive"  src="<?php echo $user_profile; ?>" style="max-height: 100px;max-width: 100px;"></td> -->


                                         </tr>
                                     <!-- </div> -->
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
<script src="assets_light/bundles/libscripts.bundle.js"></script>
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/toastr/toastr.js"></script>
<script src="assets_light/bundles/chartist.bundle.js"></script>
<script src="assets_light/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->

<script src="assets_light/bundles/mainscripts.bundle.js"></script>
<script src="assets_light/js/index.js"></script>
<script type="text/javascript">
     $('.mark_as_read').on('click',(function(e) {
        
        e.preventDefault();
        var req_id = $(this).attr('data-id');

        $.ajax({
            url:"operations/mark_as_read.php",
            method:"POST",
            data:{req_id:req_id},
            success:function(data){

                location.reload();
            }
        });
    }));
      $('.mark_as_read_local').on('click',(function(e) {
        
        e.preventDefault();
        var req_id = $(this).attr('data-id');

        $.ajax({
            url:"operations/mark_as_read_local.php",
            method:"POST",
            data:{req_id:req_id},
            success:function(data){

                location.reload();
            }
        });
    }));
     
</script>

</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:00:44 GMT -->
</html>