<style>
           #left-sidebar {
                background-color:rgb(255, 255, 255) !important;
            } 
            
        </style>
<div id="wrapper">

        <div id="left-sidebar" class="sidebar" >
            <div class="sidebar-scroll">
                 <?php 
                            error_reporting(0);
                            $sql=mysqli_query($conn, "SELECT * FROM users where user_id=$userid");
                            // $ds=mysqli_query($conn, "SELECT * FROM users where user_privilege=$privilige");
                            $data=mysqli_fetch_assoc($sql);
                            // $check=mysqli_fetch_assoc($ds);

                            $username = $data['user_name'];
                            $privilige = $data['user_privilege'];
                            $image = $data['user_profile'];
                            $user_email = $data['user_email'];
                            $created_by = $data['created_by'];

                            $c_read=$data['c_read'];
                            $c_write=$data['c_write'];
                            $c_delete=$data['c_delete'];

                            $s_read=$data['s_read'];
                            $s_write=$data['s_write'];
                            $s_delete=$data['s_delete'];

                            $p_read=$data['p_read'];
                            $p_write=$data['p_write'];
                            $p_delete=$data['p_delete'];

                            $a_read=$data['a_read'];
                            $a_write=$data['a_write'];
                            $a_delete=$data['a_delete'];


                            $sql1=mysqli_query($conn, "SELECT COUNT(c_id) as total_customer FROM `tbl_customer`");;
                            $data=mysqli_fetch_assoc($sql1);
                            $total_customer = $data['total_customer'];

                            $sql2=mysqli_query($conn, "SELECT COUNT(s_id) as total_emp FROM `tbl_salesmen`");;
                            $data=mysqli_fetch_assoc($sql2);
                            $total_emp = $data['total_emp'];

                            $sql3=mysqli_query($conn, "SELECT COUNT(v_id) as total_vendor FROM `tbl_vendors`");;
                            $data=mysqli_fetch_assoc($sql3);
                            $total_vendor = $data['total_vendor'];
                            ?>
                <div class="user-account">
                    <img src="<?php if($image!=''){ echo $image;}else{?> assets/images/userdefault.jpg<?php }?>" class="rounded-circle user-photo" alt="User Profile Picture">
                   
                    <div class="dropdown">
                        <span>Welcome</span>
                        <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong><?php echo $username;?></strong></a>                    
                        <ul class="dropdown-menu dropdown-menu-right account animated flipInY">
                            <li><a href="profile.php"><i class="icon-user"></i>My Profile</a></li>
                            <!-- <li><a href="add_company.php"><i class="icon-envelope-open"></i>Messages</a></li> -->
                            <?php if($userid=='1'){?>
                            <li><a href="setting.php"><i class="icon-settings"></i>Settings</a></li>
                            <?php }?>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="icon-power"></i>Logout</a></li>
                        </ul>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-4">
                            <h6><?php echo $total_customer; ?>+</h6>
                            <small>Clients</small>                        
                        </div>
                        <div class="col-4">
                            <h6><?php echo $total_emp;?> + </h6>
                            <small>Employees</small>                        
                        </div>
                        <div class="col-4">                        
                            <h6><?php echo $total_vendor;?> +</h6>
                            <small>Vendors</small>
                        </div>
                    </div>
                </div>
             

                <!-- Nav tabs -->
                <ul class="nav nav-tabs ">
                    
                    <li class="nav-item" ><a class="nav-link " data-value="buy" data-toggle="tab" href="#hr_menu"><small>CONFIG</small></a></li>

                    <li class="nav-item" ><a class="nav-link"  data-toggle="tab" data-value="rent" href="#project_menu"><small>PUR</small></a></li>
                    
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#sub_menu"><small>ACC</small></a></li> 
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#pos_menu"><small>POS</small></a></li>

                </ul>
                
            <!-- Tab panes -->
            <div class="tab-content p-l-0 p-r-0 " style="max-height: calc(80vh - 9rem);overflow-y: auto;">
                
                <div class="tab-pane animated fadeIn active" id="hr_menu" >
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu"  >
                            <li id="dashboard" ><a href="index.php"><i class="icon-speedometer"></i><span>Dashboard</span></a></li> 
                            <?php
                             $sql=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='hr_menu' and parent_id='0'");  
                          while($pdata = mysqli_fetch_assoc($sql)) 

                                {
                                    $page_id= $pdata['page_id'] ;
                                    $page_name= $pdata['page_name'] ;
                                    $icon= $pdata['icon'] ;
                                    $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='hr_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                                    $pageid= $ddata['page_id'];

                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where parent_page_id='$page_id' and user_id='$userid' and W!='0'");
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    if($privilige=='superadmin')
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                    if(mysqli_num_rows($permission)>0)
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                        $hide_main="hidden";
                                                    }
                                                }
                                                }
                     
                          ?>
                                <li <?php echo $hide_main;?>>
                                    <a  class="has-arrow"><i  class="<?php echo $icon;?>"></i><span><?php echo $page_name;?></span></a>
                                    <ul>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='hr_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                                    $pageid= $ddata['page_id'];
                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$pageid' and user_id='$userid'");
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    $W= $perdata['W'];
                                                    if($privilige=='superadmin')
                                                    {?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                                    <?php }
                                                    else if($W=='1')
                                                    {?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                                    <?php }
                                                }?>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='hr_menu' and parent_id='$page_id' and visibility='0'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {?>
                                        <li hidden=""><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                        <?php }?> 
                                    </ul>
                                </li>
                        <?php 
                                        }?> 
                            <li hidden=""><a href="profile.php"><i class="icon-user"></i>My Profile</a></li>
                            <li hidden=""><a href="setting.php"><i class="icon-user"></i>My Profile</a></li>
                        </ul>
                    </nav>
                </div>
      
                <div class="tab-pane animated fadeIn col-xs-12" id="project_menu">
                    <nav class="sidebar-nav">
                        <ul class="main-menu metismenu">
                            
                           
                            <?php
                             $sql=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='project_menu' and parent_id='0'");  
                          while($pdata = mysqli_fetch_assoc($sql)) 

                                {
                                    $page_id= $pdata['page_id'] ;
                                    $page_name= $pdata['page_name'] ;
                                    $icon= $pdata['icon'] ;
                                    if($privilige=='superadmin')
                                     {
                                        if($page_id=='126' || $page_id=='55')
                                        {
                                            $hidden="hidden";
                                        }
                                        else
                                        {
                                           $hidden=""; 
                                        }
                                      }
                                      $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='project_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                                    $pageid= $ddata['page_id'];

                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where parent_page_id='$page_id' and user_id='$userid' and W!='0'");
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    if($privilige=='superadmin')
                                                    {
                                                        if($page_id=='32')
                                                        {
                                                            $hide_main="hidden";
                                                        }
                                                        else
                                                        {
                                                            $hide_main="";
                                                        }
                                                        
                                                    }
                                                    else
                                                    {
                                                    if(mysqli_num_rows($permission)>0)
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                        $hide_main="hidden";
                                                    }
                                                }
                                                }
                                     
                          ?>
                                <li <?php echo $hide_main;?>>
                                    <a  class="has-arrow" ><i  class="<?php echo $icon;?>"></i><span><?php echo $page_name;?></span></a>
                                    <ul>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='project_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                                    $pageid= $ddata['page_id'];
                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$pageid' and user_id='$userid'");
                                                    
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    $W= $perdata['W'];
                                                    if($privilige=='superadmin' && $pageid!='56')
                                                    {
                                                        if($pageid=='46'){

                                                              $sql = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where admin_read='0' and transfer_type='0' order by purchase_req_id asc ");
                                                            
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
                                              
                                                            if($count>5)
                                                                {
                                                                    $count='5+';
                                                                }
                                                                ?>
                                                           <li><a class="mark_as_read2" href="<?php echo $ddata['page_link'];?>.php" ><?php echo $ddata['page_name'];?> <span <?php echo $hidden_counter;?> class="notification-dot text-center text-white " style="top: 6px !important; width: 15px !important;height: 15px !important; background-color: #e72c2c; font-size: 11px; font-weight: bold; position: absolute;    border-radius: 50%;" ><?php echo $count;?></span></a></li> 
                                                        <?php } else { ?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                                    <?php } }
                                                        else if($W=='1')
                                                        {
                                                            if($page_id=='55'){

                                                            $query35 = mysqli_query($conn,"SELECT * FROM tbl_purchase_req where location='$userid' and branch_read='0' and transfer_type='0' and item_transfer!='' order by purchase_req_id asc ");
                                                            
                                                            $count=0;
                                                            while($pdata = mysqli_fetch_assoc($query35))   
                                                            {
                                                                $count++; 
                                                            }
                                                           
                                                            if($count=='0')
                                                            {
                                                                $hidden_counter1="hidden";
                                                            }
                                                            else
                                                            {
                                                                 $hidden_counter1="";
                                                            }
                                                            if($count>5)
                                                                {
                                                                    $count='5+';
                                                                }
                                                            ?>
                                                           <li><a class="mark_as_read1" href="<?php echo $ddata['page_link'];?>.php" ><?php echo $ddata['page_name'];?> <span <?php echo $hidden_counter1;?> class="notification-dot text-center text-white " style="top: 6px !important; width: 15px !important;height: 15px !important; background-color: #e72c2c; font-size: 11px; font-weight: bold; position: absolute;    border-radius: 50%;" ><?php echo $count;?></span></a></li>  
                                                        <?php } else { ?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li>  
                                                    <?php } 
                                                       } }?>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='project_menu' and parent_id='$page_id' and visibility='0'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {?>
                                        <li hidden=""><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                        <?php }?> 
                                    </ul>
                                </li>
                        <?php } ?> 
                         
                            
                        </ul>                        
                    </nav>                    
                </div>
        
                <div class="tab-pane animated fadeIn sub_menu" id="sub_menu">
                    <nav class="sidebar-nav">
                       
                        <ul class="main-menu metismenu">
                            
                           
                            <?php
                             $sql=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='sub_menu' and parent_id='0'");  
                          while($pdata = mysqli_fetch_assoc($sql)) 

                                {
                                    $page_id= $pdata['page_id'] ;
                                    $page_name= $pdata['page_name'] ;
                                    $icon= $pdata['icon'] ;
                                    $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='sub_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                                    $pageid= $ddata['page_id'];
                                                  
                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where parent_page_id='$page_id' and user_id='$userid' and W!='0'");
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    if($privilige=='superadmin')
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                    if(mysqli_num_rows($permission)>0)
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                        $hide_main="hidden";
                                                    }
                                                }
                                                }
                          ?>
                                <li <?php echo $hide_main;?>>
                                    <a  class="has-arrow" ><i  class="<?php echo $icon;?>"></i><span><?php echo $page_name;?></span></a>
                                    <ul>
                                        <?php
                                        
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='sub_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                        $pageid= $ddata['page_id'];
                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$pageid' and user_id='$userid'");
                                                    
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    $W= $perdata['W'];
                                                    if($privilige=='superadmin')
                                                    {?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li>
                                                    <?php }
                                                    else if($W=='1')
                                                    {
                                                       ?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                                    <?php } }?>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='sub_menu' and parent_id='$page_id' and visibility='0'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {?>
                                        <li hidden=""><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                        <?php }?> 
                                    </ul>
                                </li>
                        <?php }?>
                        </ul>
                    </nav>
                </div>
                 <div class="tab-pane animated fadeIn sub_menu" id="pos_menu">
                    <nav class="sidebar-nav">
                       
                        <ul class="main-menu metismenu">
                            
                           
                            <?php
                             $sql=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='pos_menu' and parent_id='0'");  
                          while($pdata = mysqli_fetch_assoc($sql)) 

                                {
                                    $page_id= $pdata['page_id'] ;
                                    $page_name= $pdata['page_name'] ;
                                    $icon= $pdata['icon'] ;
                                    $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='pos_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                                    $pageid= $ddata['page_id'];
                                                  
                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where parent_page_id='$page_id' and user_id='$userid' and W!='0'");
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    if($privilige=='superadmin')
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                    if(mysqli_num_rows($permission)>0)
                                                    {
                                                        $hide_main="";
                                                    }
                                                    else
                                                    {
                                                        $hide_main="hidden";
                                                    }
                                                }
                                                }
                          ?>
                                <li <?php echo $hide_main;?>>
                                    <a  class="has-arrow" ><i  class="<?php echo $icon;?>"></i><span><?php echo $page_name;?></span></a>
                                    <ul>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='pos_menu' and parent_id='$page_id' and visibility='1'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {
                                        $pageid= $ddata['page_id'];
                                                    $permission=mysqli_query($conn, "SELECT * FROM tbl_permission where page_id='$pageid' and user_id='$userid'");
                                                    
                                                    $perdata = mysqli_fetch_assoc($permission);
                                                    $W= $perdata['W'];
                                                    if($privilige=='superadmin')
                                                    {?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li>
                                                    <?php }
                                                    else if($W=='1')
                                                    {
                                                       ?>
                                                    <li ><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                                    <?php } }?>
                                        <?php
                             $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='pos_menu' and parent_id='$page_id' and visibility='0'");  
                                          while($ddata = mysqli_fetch_assoc($sql1))   
                                                {?>
                                        <li hidden=""><a href="<?php echo $ddata['page_link'];?>.php"><?php echo $ddata['page_name'];?></a></li> 
                                        <?php }?> 
                                    </ul>
                                </li>
                        <?php }?>
                        </ul>
                    </nav>
                </div>
              
            </div>          
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {

x=$(location).attr('href');
    var path = window.location.pathname;
    var dashboard = document.getElementById('dashboard');
    var page = path.split("/").pop();

    var nodeValue = $('a[href="'+page+'"]').parents("div").attr("id");
    var sd = $('a[href="'+page+'"]');
   var s = page.split('.').slice(0, -1).join('.')
  // console.log(page)
  // console.log(s)
    $.each($('.nav-tabs').find('li'),function(){
        $menuChildren = $('a[href$="' + s + '.php"]');
        
        var t = $menuChildren[0]
        var z = t.parentElement;
        // console.log(t)
        $x = t.parentElement;
        var v = z.innerHTML;
        $ta = v;
        z.classList.add("active")
        var x = z.parentElement.parentElement;
        x.classList.add("active")
        if($(' .nav-link').attr('href')){
               // $(nodeValue).toggleClass('active')
           
             $.each($('.nav-tabs'),function(){
 
            $(".nav-link").attr("href",function(i,link){
               if(link=='#'+nodeValue){

            var x=$('a[href$="'+nodeValue+'"]')

               $(x).toggleClass('active');
            
               }
               var z = document.getElementById(nodeValue);

               $(z).toggleClass('active')

            })});
          
        }
   
   });

});

</script>       
<script type="text/javascript">
     $('.mark_as_read1').on('click',(function(e) {
        
        e.preventDefault();
        var req_id = '0';
        
        $.ajax({
            url:"operations/mark_as_read.php",
            method:"POST",
            data:{req_id:req_id},
            success:function(data){
                window.location.href = "./purchase_req_list.php";
               // location.reload();
            }
        });
    }));
     $('.mark_as_read2').on('click',(function(e) {
        
        e.preventDefault();
        var req_id = '0';
        
        $.ajax({
            url:"operations/mark_as_read.php",
            method:"POST",
            data:{req_id:req_id},
            success:function(data){
                window.location.href = "./main_purchase_req_list.php";
               // location.reload();
            }
        });
    }));

</script>
   <script type="text/javascript">
        $(document).ready(function() {
        var i = $("#theme_color").val();
        var t=$("body");
       
        t.removeClass("theme-orange"),t.addClass("theme-"+i);
       
       
});
    </script>