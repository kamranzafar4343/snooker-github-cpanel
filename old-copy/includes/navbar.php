    
    <nav class="navbar navbar-fixed-top" >
        <div class="container-fluid">
            <div class="navbar-btn">
                <button type="button" class="btn-toggle-offcanvas"><i class="lnr lnr-menu fa fa-bars"></i></button>
            </div>
           
            <div class="navbar-brand" style="max-width: 10%;">
                <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image = $data['user_profile'];
                        $color = $data['color'];
                 
                        ?>
                <a href="#"><img src="<?php echo $image; ?>" class="img-responsive logo" alt="<?php echo $c_name;?>"  style="max-width: 33px"><span style="color: black; padding: 15px;"><?php echo $c_name;?></span></a>                
            </div>
            
            <div class="navbar-right">
                <input type="hidden" id="theme_color" value="<?php echo $color;?>">
                <form id="navbar-search" class="navbar-form search-form" hidden="">
                    <input value="" class="form-control" placeholder="Search here..." type="text">
                    <button type="button" class="btn btn-default"><i class="icon-magnifier"></i></button>
                </form>               

                <div id="navbar-menu">
                    <ul class="nav navbar-nav">                        
                      
                        <?php
                        $query=mysqli_query($conn, "SELECT user_privilege FROM users where user_id='$userid'");
                                $data = mysqli_fetch_assoc($query);
                                $user_privilege=$data['user_privilege'];
                                if($user_privilege=='superadmin')
                                {
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where admin_read='0' order by purchase_req_id asc limit 5");
                                }
                                else
                                {
                                   
                                  $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where location='$userid' and branch_read='0' and item_transfer!='' order by purchase_req_id asc limit 5");
                                }
                                $count=0;
                                while($pdata = mysqli_fetch_assoc($sql))   
                                {
                                    $count++; 
                                }
                               
                                if($count=='0')
                                {
                                    $hidden_counter="hidden";
                                }
                                else
                                {
                                     $hidden_counter="";
                                }
                        ?>
                        <li class="dropdown" hidden>
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu">
                                <i class="icon-bell"></i>
                                <span <?php echo $hidden_counter;?> class="notification-dot text-center text-white" style="top: 6px !important; width: 15px !important;height: 15px !important; font-size: 11px; font-weight: bold;"><?php echo $count;?></span>
                            </a>

                            <!-- <ul class="dropdown-menu notifications animated shake">
                                <li class="header"><strong>You have 4 new Notifications</strong></li>
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-info text-warning"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text text-white">Campaign <strong>Holiday Sale</strong> is nearly reach budget limit.</p>
                                                <span class="timestamp">10:00 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>                               
                                <li>
                                    <a href="javascript:void(0);">
                                        <div class="media">
                                            <div class="media-left">
                                                <i class="icon-like text-success"></i>
                                            </div>
                                            <div class="media-body">
                                                <p class="text">Your New Campaign <strong>Holiday Sale</strong> is approved.</p>
                                                <span class="timestamp">11:30 AM Today</span>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                 
                                <li class="footer"><a href="./notification.php" class="more">See all notifications</a></li>
                            </ul> -->
                        </li>
                        <li><a href="pos_sale_list.php" class='btn btn-sm btn-outline-info'>Sale List</a></li>
                        <li><a href="pos.php" class='btn btn-sm btn-outline-danger'>POS</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle icon-menu" data-toggle="dropdown"><i class="icon-equalizer"></i></a>
                            <ul class="dropdown-menu user-menu menu-icon animated bounceIn">
                                <li class="menu-heading">GENERAL LINKS</li>
                                <li><a href="./profile.php"><i class="icon-note"></i> <span>Profile</span></a></li>
                                <li><a href="./item_price.php"><i class="icon-credit-card"></i> <span>Item Price</span></a></li>
                                <li><a href="./pos.php"><i class=" icon-share-alt"></i> <span> Add POS</span></a></li>
                                <li><a href="./pos_sale_list.php"><i class="icon-credit-card"></i> <span>POS Sale List</span></a></li>
                                <li><a href="./contact_list.php"><i class="icon-credit-card"></i> <span>Contact List</span></a></li>
                                <li><a href="./task_list.php"><i class="icon-credit-card"></i> <span>Task List</span></a></li>
                                <li class="menu-heading">REPORTS</li>
                                <li><a href="./trail_balance.php"><i class="icon-equalizer"></i> <span>Trial Balance</span></a></li>
                                <li><a href="./inventory.php"><i class="icon-docs"></i> <span>Inventory Report</span></a></li>
                                
                                <?php
                                if($userid=='1')
                                {
                                $query=mysqli_query($conn, "SELECT user_id,user_name FROM users where user_privilege='branch' OR user_privilege='superadmin'");
                                }
                                else
                                {
                                  $query=mysqli_query($conn, "SELECT user_id,user_name FROM users where user_id='$userid'");  
                                }
                                while($data = mysqli_fetch_assoc($query))
                                {
                                 $user_id=$data['user_id'];
                                 $user_name=$data['user_name'];  

                                ?>
                                <li><a href="./daily_report.php?location=<?php echo $user_id?>"><i class="icon-docs"></i> <span>DR (<?php echo $user_name?>)</span></a></li> 
                                <?php }?>                       
                                <li><a href="./day_close.php"><i class="icon-rocket"></i> <span>Day Close Report</span></a></li>       
                                <li><a href="./op_day_close.php"><i class="icon-rocket"></i> <span>Op Day Close Report</span></a></li>       
                                <li><a href="./add_payment.php"><i class="icon-rocket"></i> <span>Payments</span></a></li>
                            </ul>
                        </li>
                        <li><a href="logout.php" class="icon-menu"><i class="icon-login"></i></a></li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>
