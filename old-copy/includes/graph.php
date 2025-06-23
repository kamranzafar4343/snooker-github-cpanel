   <?php
                    $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                    $monthsqlsaletotal=mysqli_query($conn, "SELECT SUM(gross_amount) as total FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and sale_type='Cash' order by created_date desc limit 8");
                                    $salegraph1=mysqli_fetch_assoc($monthsqlsaletotal);
                                    $saletotal=$salegraph1['total'];  

                                    $istsqldailytotal=mysqli_query($conn, "SELECT SUM(gross_amount) as month_inst_tot FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())  and sale_type='Credit' order by created_date desc limit 8");
                                    $instgraph1=mysqli_fetch_assoc($istsqldailytotal);
                                    $insttotalgraph=$instgraph1['month_inst_tot'];

                                    $recsqlmonth = mysqli_query($conn,"SELECT  SUM(per_month_amount) as recovery_tot FROM tbl_installment_payment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE())");
                                    $recgraph1=mysqli_fetch_assoc($recsqlmonth);
                                    $rectotalgraph=$recgraph1['recovery_tot'];

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
                                    
                               
                                    $monthsqlsaletotal=mysqli_query($conn, "SELECT SUM(amount_recieved) as total FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by' order by created_date desc limit 8");
                                    $salegraph1=mysqli_fetch_assoc($monthsqlsaletotal);
                                    $saletotal=$salegraph1['total'];  

                                    $istsqldailytotal=mysqli_query($conn, "SELECT SUM(amount_recieved) as total FROM tbl_sale where MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by' order by created_date desc limit 8");
                                    $instgraph1=mysqli_fetch_assoc($istsqldailytotal);
                                    $insttotalgraph=$instgraph1['month_inst_tot'];

                                    $recsqlmonth = mysqli_query($conn,"SELECT  SUM(per_month_amount) as recovery_tot FROM tbl_installment_payment where  MONTH(created_date) = MONTH(CURRENT_DATE())
                                        AND YEAR(created_date) = YEAR(CURRENT_DATE()) and parent_id='$created_by'");
                                    $recgraph1=mysqli_fetch_assoc($recsqlmonth);
                                    $rectotalgraph=$recgraph1['recovery_tot'];

                               
                                    }

                                ?>  
 <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Cash Sale</small>
                                <h6 class="mb-0 mt-1"><i class="icon-diamond"></i> <?php echo round($saletotal);?></h6>
                            </div>
                            <span class="bh_visitors float-right">
                                <?php
                               
                               $date=date('Y-m-d');
                                    $new_date = date('Y-m-d', strtotime($date));
                                    $a=-1;
                                    for($i=0; $i<=8; $i++)
                                    {
                                     $a++;
                                    $needed = date('Y-m-d',strtotime($new_date." -$i day"));
                                   
                                    $monthsqlsale=mysqli_query($conn, "SELECT gross_amount FROM tbl_sale where DATE(created_date) = DATE('$needed') and parent_id='$created_by' and sale_type='Cash' order by created_date desc limit 3");
                                    while($salegraph=mysqli_fetch_assoc($monthsqlsale))
                                    {
                                            $month_sale=$salegraph['gross_amount'];
                                            $month_sale_created_date=$salegraph['created_date'];
                                            echo round($month_sale).",";
                                    }
                                    }
                                ?>

                            </span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Credit Sale</small>
                                <h6 class="mb-0 mt-1"><i class="icon-diamond"></i> <?php echo round($insttotalgraph);?></h6>
                            </div>
                            <span class="bh_visits float-right">
                                <?php
                                 $date=date('Y-m-d');
                                    $new_date = date('Y-m-d', strtotime($date));
                                    $a=-1;
                                    for($i=0; $i<=8; $i++)
                                    {
                                     $a++;
                                    $needed = date('Y-m-d',strtotime($new_date." -$i day"));
                                   
                                    $istsqldaily=mysqli_query($conn, "SELECT gross_amount FROM tbl_sale where DATE(created_date) = DATE('$needed') and parent_id='$created_by' and sale_type='Credit' order by created_date desc limit 3");
                                    while($instgraph=mysqli_fetch_assoc($istsqldaily))
                                        {
                                            $month_sale_ist=$instgraph['gross_amount'];
                                            echo round($month_sale_ist).',';
                                        }
                                    }
                             
                                ?>
                            </span>
                        </div>
                      <!--   <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Recovery</small>
                                <h6 class="mb-0 mt-1"><i class="icon-diamond"></i> <?php echo round($rectotalgraph);?></h6>
                            </div>
                            <span class="bh_chats float-right">
                                 <?php
                                 $date=date('Y-m-d');
                                    $new_date = date('Y-m-d', strtotime($date));
                                    $a=-1;
                                    for($i=0; $i<=8; $i++)
                                    {
                                     $a++;
                                    $needed = date('Y-m-d',strtotime($new_date." -$a day"));

                                    $recsqldaily = mysqli_query($conn,"SELECT  per_month_amount FROM tbl_installment_payment where created_date = '$needed' and parent_id='$created_by' order by created_date desc limit 8");
                                  
                                    while($recgraph=mysqli_fetch_assoc($recsqldaily))
                                        {
                                            $month_rec_grap=$recgraph['per_month_amount'];
                                            echo round($month_rec_grap).',';
                                        }
                                    }
                             
                                ?>
                            </span>
                        </div>
                    </div>
 -->
                    <?php

$query=mysqli_query($conn, "SELECT user_privilege, created_by FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                $created_by=$data['created_by'];
                                if($user_privilege=='superadmin')
                                {
                                  $lock = "";
                                }
                                else
                                {
                                    if($user_privilege!='branch' && $created_by!='1')
                                    {
                                        $sql = mysqli_query($conn,"SELECT SUM(d_amount) as total_sale_till_now FROM `tbl_trans_detail` where acode IN ('300100100', '300100300') and parent_id='$userid'");
                                        $data = mysqli_fetch_assoc($sql);
                                        $total_sale_till_now=$data['total_sale_till_now'];
                                    }
                                    else
                                    {
                                        $sql = mysqli_query($conn,"SELECT SUM(d_amount) as total_sale_till_now FROM `tbl_trans_detail` where acode IN ('300100100', '300100300') and created_by='$userid'");
                                        $data = mysqli_fetch_assoc($sql);
                                        $total_sale_till_now=$data['total_sale_till_now'];
                                        if($total_sale_till_now>0)
                                        {
                                            $lock="hidden";
                                        }
                                    }
                                }

?>