 
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
<?php
include "includes/loader.php";

?>
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
                                if($user_privilege=='superadmin' || $created_by=='1')
                                {

                                    $sql_pur=mysqli_query($conn, "SELECT SUM(gross_amount) as today_purchase FROM tbl_purchase where  date(created_date) = DATE('$date')");


                                    $monthsql_pur=mysqli_query($conn, "SELECT SUM(gross_amount) as monthly_purchase FROM tbl_purchase where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                    $sql=mysqli_query($conn, "SELECT SUM(gross_amount) as total FROM tbl_sale where  date(created_date) = DATE('$date') and sale_type='Cash'");


                                    $monthsql=mysqli_query($conn, "SELECT SUM(gross_amount) as total_month FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and sale_type='Cash'");

                                    $sql2=mysqli_query($conn, "SELECT SUM(total_price) as dtotal, SUM(amount_recieved) as rtotal, SUM(total_price) as totalprice FROM tbl_installment where created_date = DATE(NOW())");

                                    $sql_return=mysqli_query($conn, "SELECT SUM(amount_returned) as total_return FROM tbl_sale_return where  date(created_date) = DATE('$date')");

                                    $sql_return_month=mysqli_query($conn, "SELECT SUM(amount_returned) as total_return_month FROM tbl_sale_return where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                    $sql_salet_month=mysqli_query($conn, "SELECT SUM(gross_amount) as total_sale_month FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");

                                    $sql_salet=mysqli_query($conn, "SELECT SUM(gross_amount) as total_sale FROM tbl_sale  where  date(created_date) = DATE('$date')");

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
                                    $recievable_opening=mysqli_query($conn, "SELECT SUM(opening_bal) as total_rec_open FROM `tbl_account_lv2` where LEFT(acode,6)='100200' ");

                                    $payable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_pay FROM `tbl_trans_detail` where LEFT(acode,6)='200200'");
                                    $payable_opening=mysqli_query($conn, "SELECT SUM(opening_bal) as total_pay_open FROM `tbl_account_lv2` where LEFT(acode,6)='200200' ");

                                    
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
                                    $sql_pur=mysqli_query($conn, "SELECT SUM(gross_amount) as today_purchase FROM tbl_purchase where  date(created_date) = DATE('$date') and parent_id='$created_by'");


                                    $monthsql_pur=mysqli_query($conn, "SELECT SUM(gross_amount) as monthly_purchase FROM tbl_purchase where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");

                                    $sql=mysqli_query($conn, "SELECT SUM(gross_amount) as total FROM tbl_sale where  created_date = DATE(NOW()) and parent_id='$created_by' ");

                                    $monthsql=mysqli_query($conn, "SELECT SUM(gross_amount) as total_month FROM tbl_sale where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");

                                     $sql_return=mysqli_query($conn, "SELECT SUM(amount_returned) as total_return FROM tbl_sale_return where  date(created_date) = DATE('$date')  and parent_id='$created_by'");

                                    $sql_return_month=mysqli_query($conn, "SELECT SUM(amount_returned) as total_return_month FROM tbl_sale_return where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())  and parent_id='$created_by'");

                                    $sql_salet_month=mysqli_query($conn, "SELECT SUM(gross_amount) as total_sale_month FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");

                                    $sql_salet=mysqli_query($conn, "SELECT SUM(gross_amount) as total_sale FROM tbl_sale  where  date(created_date) = DATE('$date') and sale_type='Cash' and parent_id='$created_by'");

                                    
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
                                   

                                    $recievable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_rec FROM `tbl_trans_detail` where LEFT(acode,6)='100200' ");
                                    $recievable_opening=mysqli_query($conn, "SELECT SUM(opening_bal) as total_rec_open FROM `tbl_account_lv2` where LEFT(acode,6)='100200' ");

                                    $payable=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as total_pay FROM `tbl_trans_detail` where LEFT(acode,6)='200200'");
                                    $payable_opening=mysqli_query($conn, "SELECT SUM(opening_bal) as total_pay_open FROM `tbl_account_lv2` where LEFT(acode,6)='200200' ");

                                  
                                }
                        
                        $sql_pur_tot=mysqli_fetch_assoc($sql_pur);
                        $today_purchase=$sql_pur_tot['today_purchase'];

                        $sql_pur_month_tot=mysqli_fetch_assoc($monthsql_pur);
                        $monthly_purchase=$sql_pur_month_tot['monthly_purchase'];

                        $sql_return_tot=mysqli_fetch_assoc($sql_return);
                        $tot_sql_return_today=$sql_return_tot['total_return'];

                        $sql_return_month_tot=mysqli_fetch_assoc($sql_return_month);
                        $total_return_month=$sql_return_month_tot['total_return_month'];

                        $sql_salet_tot=mysqli_fetch_assoc($sql_salet);
                        $total_sale=$sql_salet_tot['total_sale'];

                        $sql_salet_month_tot=mysqli_fetch_assoc($sql_salet_month);
                        $total_sale_month=$sql_salet_month_tot['total_sale_month'];


                        $recievable_tot=mysqli_fetch_assoc($recievable);
                        $tot_rec_before=$recievable_tot['total_rec'];

                        $rec_tot_opening=mysqli_fetch_assoc($recievable_opening);
                        $total_rec_open=$rec_tot_opening['total_rec_open'];

                        $tot_rec=round($tot_rec_before-$total_rec_open);

                        $payable_tot=mysqli_fetch_assoc($payable);
                        $tot_pay_before_opening=$payable_tot['total_pay'];
                        
                        $payable_tot_opening=mysqli_fetch_assoc($payable_opening);
                        $total_pay_open=$payable_tot_opening['total_pay_open'];

                        $tot_pay=round($tot_pay_before_opening-$total_pay_open);
                        
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
                    
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-info">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3 ><?php echo number_format($todaysale, 0, ".", ",") ; ?></h3>
                                    <span >Daily Cash Sale</span>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-danger">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php echo number_format($tot_sql_return_today, 0, ".", ",") ; ?></h3>
                                    <span>Daily Sale Return</span>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-success">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php echo number_format($total_sale, 0, ".", ",") ; ?></h3>
                                    <span>Daily Sale</span>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
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
                <div class="col-lg-2 col-md-6 col-sm-6">
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
                <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card text-center bg-dark">
                            <div class="body">
                                <div class="p-15 text-light">
  

                                    <h3><?php echo round($today_purchase); ?></h3>
                                    <span>Today Purchase</span>
                                    
                                </div>
                            </div>
                        </div>              
                </div> 
                    <div class="col-lg-2 col-md-6 col-sm-6">
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
                <div class="col-lg-2 col-md-6 col-sm-6">
                        <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-danger">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php echo number_format($total_return_month, 0, ".", ",") ; ?></h3>
                                    <span>Monthly Sale Return</span>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-6">
                        <a href="single_sale.php?fdate=<?php echo $f_date ?>&tdate=<?php echo $t_date ?>&sale_type=Cash" target="_blank">
                        <div class="card text-center bg-success">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <h3><?php echo number_format($total_sale_month, 0, ".", ",") ; ?></h3>
                                    <span>Monthly Sale</span>
                                </div>
                            </div>
                        </div>
                        </a> 
                    </div>
                   
              <div class="col-lg-2 col-md-6 col-sm-6">
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
                
               <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card text-center bg-warning">
                            <div class="body">
                                <div class="p-15 text-dark">
                                    
                                    
                                     <h3><?php echo round($tot_pay); ?></h3>
                                    <span>Total Payable</span>
                                </div>
                            </div>
                        </div>              
                </div> 
                <div class="col-lg-2 col-md-6 col-sm-6">
                        <div class="card text-center bg-dark">
                            <div class="body">
                                <div class="p-15 text-light">
                                    <!-- <h3><?php echo number_format($total, 0, ".", ",") ; ?></h3>
                                    <span>Daily Recovery</span> -->
                                    
                                     <h3><?php if($monthly_purchase){
                                    echo round($monthly_purchase);}else{echo  "RS - 0";}
                                        ?></h3>
                                        <span>Monthly Purchase</span>
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
                                                $date=date('Y-m-d');
                                         
                                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_task where status='0' and  created_date='$date' and created_by='$userid' order by task_id desc limit 10");
                                                
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
                                                    $task_id=$pdata['task_id'];
                                                    $status=$pdata['status'];
                                                    $task_name=$pdata['task_name'];
                                                    $task_description=$pdata['task_description'];
                                                    $task_date=$pdata['created_date'];
                                                    if ($status=='1')
                                                    {
                                                        $read="";
                                                        $hide_button="hidden";
                                                    }
                                                    else
                                                    {
                                                        $read="unread";
                                                        $hide_button="";
                                                    }      
                                                    $location=$pdata['created_by'];
                                                    $bsql1=mysqli_query($conn,"SELECT * from users where user_id='$location'");
                                                    $pdata1 = mysqli_fetch_assoc($bsql1);
                                                    $branch_name=$pdata1['user_name'];


                                            ?>
                                        <li class="clearfix <?php echo $read;?>">
                                            <div class="mail-detail-right">
                                                <h6 class="sub"><a href="main_purchase_req_list.php" class="mail-detail-expand"><?php echo $branch_name;?></a> Task<span class="badge badge-danger mb-0"><?php echo $task_name;?></span></h6>
                                                <p class="dep"><span class="m-r-10">[Description]</span><?php echo $task_description;?>.</p>
                                                <span class="time"><?php echo $invoice_date;?></span>
                                            </div>
                                            <div class="hover-action" <?php echo $hide_button;?>>
                                                <a class="btn btn-warning mr-2 mark_as_read" href="javascript:void(0);" data-id="<?php echo $task_id;?>">Mark as done</a>
                                                
                                            </div>
                                        </li>
                                        <?php }?>
                                        
                                        
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

               
             
                 $sql3=mysqli_query($conn, "SELECT SUM(d_amount-c_amount) as cash_in_hand FROM `tbl_trans_detail` WHERE LEFT(acode, 9) in('300100100',  '300100300',  '100100000') and parent_id='$parent_id'");

                  $data3=mysqli_fetch_assoc($sql3);
                  $cash_in_hand = $data3['cash_in_hand'];

                  $sql4=mysqli_query($conn, "SELECT  opening_bal FROM `tbl_account` WHERE acode='100100000'");

                  $data4=mysqli_fetch_assoc($sql4);
                  $opening_bal = $data4['opening_bal'];

                  $sql_credit=mysqli_query($conn, "SELECT SUM(amount_recieved) as total_credit FROM tbl_sale where sale_type='Credit' and parent_id='$created_by'");
                  $data5=mysqli_fetch_assoc($sql_credit);
                  $total_credit = $data5['total_credit'];

                  $cash_now=$opening_bal+$cash_in_hand;
                
           


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

                <div class="col-lg-12 col-md-12" >
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