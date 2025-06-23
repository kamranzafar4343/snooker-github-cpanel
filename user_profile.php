<!doctype html>
<html lang="en">

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
                        if (isset($_GET['user_id'])) {
                           $user_id=mysqli_real_escape_string($conn, $_GET['user_id']);
                              $sql=mysqli_query($conn, "SELECT * FROM users where user_id=$user_id");
                              
                        }
                       
                     
                        $data=mysqli_fetch_assoc($sql);
                        $username = $data['user_name'];
                        $image = $data['user_profile'];
                        $user_email = $data['user_email'];
                        $user_country = $data['user_country'];
                        $user_state = $data['user_state'];
                        $user_city = $data['user_city'];
                        $user_address = $data['user_address'];
                        $user_phone = $data['user_phone'];
                        $user_birthday = $data['user_birthday'];
                        $user_gender = $data['user_gender'];
                        $user_password = $data['user_password'];
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

                        $dashboard=$data['dashboard'];

                        ?>
    <div id="main-content" class="profilepage_2 blog-page">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Profile </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pages</li>
                            <li class="breadcrumb-item active">User Profile</li>
                        </ul>
                    </div>            
                    <?php include "includes/graph.php";?>
                </div>
            </div>

            <div class="row clearfix">

                <div class="col-lg-4 col-md-12">
                    <div class="card profile-header">
                        <div class="body">
                            <div class="profile-image"> <img src="<?php if($image!=''){ echo $image;}else{?> assets/images/userdefault.jpg<?php }?>" class="rounded-circle" alt=""> </div>
                            <div>
                                <h4 class="m-b-0"><strong><?php echo $username;?></strong></h4>
                                <span><?php echo $user_address;?></span>
                            </div>
                           <!--  <div class="m-t-15">
                                <button class="btn btn-primary">Follow</button>
                                <button class="btn btn-outline-secondary">Message</button>
                            </div>   -->                          
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                 <div class="card">
                        <div class="header">
                            <h2>Info</h2>
                            <!-- <ul class="header-dropdown">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                                    <ul class="dropdown-menu dropdown-menu-right animated bounceIn">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another Action</a></li>
                                        <li><a href="javascript:void(0);">Something else</a></li>
                                    </ul>
                                </li>
                            </ul> -->
                        </div>
                        <div class="body">
                            <small class="text-muted">Address: </small>
                            <p><?php echo $user_address;?></p>
                          
                            <hr>
                            <small class="text-muted">Email address: </small>
                            <p><?php echo $user_email;?></p>                            
                            <hr>
                            <small class="text-muted">Mobile: </small>
                            <p><?php echo $user_phone;?></p>
                            <hr>
                            <!-- <small class="text-muted">Birth Date: </small>
                            <p class="m-b-0"><?php echo $user_birthday;?></p> -->

                        </div>
                    </div>

            </div>
                   

                    
                </div>

                <div class="col-lg-8 col-md-12">
                               <?php
              
              if(isset($_GET['update']) && $_GET['update']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Profile Updated Succesfully.
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

              if(isset($_GET['update']) && $_GET['update']=='unsuccessful' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong>Failed to Update.
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
                    <div class="card">
                                 
                        <div class="body">
                            <ul class="nav nav-tabs-new">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#Profile">Profile</a></li>
                                <li class="nav-item"><a class="nav-link " data-toggle="tab" href="#Settings">Settings</a></li>
                                
                            </ul>

                    </div>

                    <div class="tab-content padding-0">

                        <div class="tab-pane animated fadeIn " id="Settings">
                                  <div class="card">
                                <div class="body">
                                     <form  action="operations/profile_update.php" method="post">
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <h6>Account Data</h6>
                                           
                                            <div class="form-group">
                                                <input type="email" name="user_email" class="form-control" value="<?php echo $user_email;?>"  placeholder="Email">
                                                <input type="hidden" name="user_id" class="form-control" placeholder="Name" value="<?php echo $user_id;?>">
                                            </div>
                                          
                                        </div>

                                        <div class="col-lg-12 col-md-12">
                                            <h6>Change Password</h6>
                                            <div class="form-group">
                                                <input type="password" name="user_password" class="form-control" placeholder="Current Password" value="<?php echo $user_password;?>">
                                            </div>
                                           
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update_acc">Update</button> &nbsp;&nbsp;
                                    <button type="reset"  class="btn btn-default">Cancel</button>
                                </form>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane animated fadeIn active" id="Profile">

                            <div class="card">
                                 <form  action="operations/profile_update.php" method="post" enctype="multipart/form-data">
                                <div class="body">
                                    <h6>Basic Information</h6>
                                    <div class="row clearfix">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">                                                
                                                <input type="text" name="user_name" class="form-control" placeholder="Name" value="<?php echo $username;?>">
                                                <input type="hidden" name="user_id" class="form-control" placeholder="Name" value="<?php echo $user_id;?>">
                                            </div>
                                             <div class="form-group">
                                                <div class="input-group">
                                                    <input type="file" class="form-control"  name="user_profile">
                                                </div>
                                            </div>
                                           
                                            <div class="form-group">
                                                <label>Gender</label>
                                                <div>
                                                    <label class="fancy-radio">
                                                        <input name="user_gender" value="male" type="radio" checked>
                                                        <span><i></i>Male</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input name="user_gender" value="female" type="radio">
                                                        <span><i></i>Female</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Dashboard</label>
                                                <div>
                                                    <?php
                                                        if($dashboard=='1')
                                                        {
                                                    ?>
                                                    <label class="fancy-radio">
                                                        <input name="dashboard" value="1" type="radio" checked>
                                                        <span><i></i>Show</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input name="dashboard" value="0" type="radio">
                                                        <span><i></i>Hide</span>
                                                    </label>
                                                    <?php }else
                                                    {?>
                                                        <label class="fancy-radio">
                                                        <input name="dashboard" value="1" type="radio" >
                                                        <span><i></i>Show</span>
                                                    </label>
                                                    <label class="fancy-radio">
                                                        <input name="dashboard" value="0" type="radio" checked>
                                                        <span><i></i>Hide</span>
                                                    </label>
                                                    <?php }?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                             
                                                    
                                                    <label>Birthday</label>
                                                
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group">
                                                     <input type="date" name="user_birthday"   class="form-control"  value="<?php echo $user_birthday; ?>">
                                                   
                                                </div>
                                            </div>
                                          
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="user_phone"  placeholder="Phone Number" value="<?php echo $user_phone;?>">
                                            </div>
                                            <div class="form-group">                                                
                                                <input type="text" class="form-control"  name="user_address" placeholder="Address Line" value="<?php echo $user_address;?>">
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="user_city" placeholder="City" value="<?php echo $user_city;?>">
                                            </div>
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="user_state" placeholder="State/Province" value="<?php echo $user_state;?>">
                                            </div>
                                            <div class="form-group">
                                                <select class="form-control" name="user_country">

                                                  
                                                    <option value="PK">Pakistan</option>
                                                  
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="update_gen">Update</button> &nbsp;&nbsp;
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>   
            </div>
            
        </div>
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                     <form  action="operations/profile_update.php" method="post" enctype="multipart/form-data" id="form">
                         <input type="hidden" name="user_id" class="form-control" placeholder="Name" value="<?php echo $user_id;?>">
                    <div class="card">
                                    <div class="body">
                <div class="row clearfix">
                
                
                    <div class="col-12">
                        <h6>Module Permission</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Update</th>
                                        <th>Delete</th>
                                        <th>Past Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                             $sql=mysqli_query($conn, "SELECT * FROM tbl_menu where parent_id='0' order by parent_id asc");  
                          while($pdata = mysqli_fetch_assoc($sql)) 

                                {
                                    $pageid= $pdata['page_id'] ;
                                    $page_name= $pdata['page_name'] ;
                                    $icon= $pdata['icon'] ;
                                    $group_id= $pdata['group_id'] ;
                          ?>
                                 <tr>
                                    <td><label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="W[]" value="0" /> -->
                                                <?php echo $page_name;?>
                                               <input class="checkbox-tick selectAll"  data-id="selectAll_<?php echo $pageid;?>" type="checkbox">
                                                <span ></span>
                                            </label></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                     <?php
                                 $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where group_id='$group_id' and parent_id='$pageid'");  
                                              while($ddata = mysqli_fetch_assoc($sql1))   
                                                    {
                                                        $page_id=$ddata['page_id'];
                                                        
                                                        $sql5=mysqli_query($conn, "SELECT * FROM tbl_permission where user_id='$user_id' and page_id='$page_id'");
                                                        if(mysqli_num_rows($sql5)==0)
                                                        {
                                                                $W=0;
                                                                $R=0;
                                                                $D=0;
                                                                $P=0;
                                                                $U=0;
                                                        }
                                                        else{
                                                         while($edit_data = mysqli_fetch_assoc($sql5)) 

                                                            {
                                                                $W=$edit_data['W'];
                                                                $R=$edit_data['R'];
                                                                $D=$edit_data['D'];
                                                                $P=$edit_data['P'];
                                                                $U=$edit_data['U'];
                                                                
                                                                $page_id_edit= $edit_data['page_id'] ;
                                                            }
                                                        }
                                                        ?>
                                                         <tr>
                                        <!--  <td >
                                  
                                                <input class="form-group" name="page_id[]" type="text" value="<?php echo $ddata['page_id']; ?>">


                                        </td> -->
                                        <input type="hidden" name="page_id[]" value="<?php echo $ddata['page_id']; ?>" />
                                        <input type="hidden" name="parent_page_id[]" value="<?php echo $pageid; ?>" />
                                        <td><?php echo $ddata['page_name'];?></td>
                                       
                                        <td>
                                            <label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="W[]" value="0" /> -->
                                                
                                                <input class="checkbox-tick write" data-id1="selectAll_<?php echo $pageid;?>" name="W[<?php echo $ddata['page_id']; ?>]" type="checkbox" value="1"  <?php if($W=='1'){?>checked=""<?php }?>>
                                                
                                                <span ></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="R[]" value="0" /> -->
                                                
                                                <input class="checkbox-tick write" data-id1="selectAll_<?php echo $pageid;?>" name="R[<?php echo $ddata['page_id']; ?>]" type="checkbox" value="1" <?php if($R=='1'){?>checked=""<?php }?>>
                                                
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="R[]" value="0" /> -->
                                                
                                                <input class="checkbox-tick write" data-id1="selectAll_<?php echo $pageid;?>" name="U[<?php echo $ddata['page_id']; ?>]" type="checkbox" value="1" <?php if($U=='1'){?>checked=""<?php }?>>
                                                
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="fancy-checkbox">
                                                <!-- <input type="hidden" name="D[]" value="0" /> -->

                                                <input class="checkbox-tick write" data-id1="selectAll_<?php echo $pageid;?>" name="D[<?php echo $ddata['page_id']; ?>]" type="checkbox" value="1" <?php if($D=='1'){?>checked=""<?php }?>>
                                                
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="fancy-checkbox">
                                                <!-- <input type="hidden" name="D[]" value="0" /> -->

                                                <input class="checkbox-tick write" data-id1="selectAll_<?php echo $pageid;?>" name="P[<?php echo $ddata['page_id']; ?>]" type="checkbox" value="1" <?php if($P=='1'){?>checked=""<?php }?>>
                                                
                                                <span></span>
                                            </label>
                                        </td>
                                        
                                            </tr>
                                            <?php }?>

                                </tr>
                                
                         <?php }?>
                                
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="permission">Add</button>
                
            </div>
                       
                </div>
            </form>
            </div>
        </div>
    </div>

</div>

<!-- Javascript -->

<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>

<script src="assets_light/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>

<script src="assets_light/bundles/mainscripts.bundle.js"></script>

<script type="text/javascript">
    // when page is ready
   $(".selectAll").click(function(){
      var checked = $(this).is(':checked');
      var data_id = $(this).attr('data-id');
      if(checked){
        $(".write").each(function(){
            var data_id1 = $(this).attr('data-id1');
            if(data_id1===data_id)
            {
                $(this).prop("checked",true);
            }    
       });
     }else{
       $(".write").each(function(){
            var data_id1 = $(this).attr('data-id1');
            if(data_id1===data_id)
            {
                $(this).prop("checked",false);
            }    
       });
     }
        //$("input[type=checkbox]").attr(this).prop('checked', $(this).prop('checked'));

});
</script>
<script>
$(function () {
    $('.knob').knob({
        draw: function () {
            // "tron" case
            if (this.$.data('skin') == 'tron') {

                var a = this.angle(this.cv)  // Angle
                    , sa = this.startAngle          // Previous start angle
                    , sat = this.startAngle         // Start angle
                    , ea                            // Previous end angle
                    , eat = sat + a                 // End angle
                    , r = true;

                this.g.lineWidth = this.lineWidth;

                this.o.cursor
                    && (sat = eat - 0.3)
                    && (eat = eat + 0.3);

                if (this.o.displayPrevious) {
                    ea = this.startAngle + this.angle(this.value);
                    this.o.cursor
                        && (sa = ea - 0.3)
                        && (ea = ea + 0.3);
                    this.g.beginPath();
                    this.g.strokeStyle = this.previousColor;
                    this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sa, ea, false);
                    this.g.stroke();
                }

                this.g.beginPath();
                this.g.strokeStyle = r ? this.o.fgColor : this.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth, sat, eat, false);
                this.g.stroke();

                this.g.lineWidth = 2;
                this.g.beginPath();
                this.g.strokeStyle = this.o.fgColor;
                this.g.arc(this.xy, this.xy, this.radius - this.lineWidth + 1 + this.lineWidth * 2 / 3, 0, 2 * Math.PI, false);
                this.g.stroke();

                return false;
            }
        }
    });
});
</script>

</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/page-profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:00:57 GMT -->
</html>