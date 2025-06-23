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
                        if ($_GET['edit_id']) {
                            
                           $edit_id=mysqli_real_escape_string($conn, $_GET['edit_id']);

                           
                              $sql=mysqli_query($conn, "SELECT * FROM tbl_permission where user_id=$edit_id");
                              
                        }
                        if (isset($_GET['user_id'])) {

                           $user_id=mysqli_real_escape_string($conn, $_GET['user_id']);
                              
                        }
                     
                    
                       

                        ?>
    <div id="main-content" class="profilepage_2 blog-page">
        <div class="container-fluid">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-6 col-md-8 col-sm-12">
                        <h2><a href="javascript:void(0);" class="btn btn-xs btn-link btn-toggle-fullwidth"><i class="fa fa-arrow-left"></i></a> User Permission </h2>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html"><i class="icon-home"></i></a></li>
                            <li class="breadcrumb-item">Pages</li>
                            <li class="breadcrumb-item active">User Permission</li>
                        </ul>
                    </div>            
                    <div class="col-lg-6 col-md-4 col-sm-12 text-right">
                        <div class="bh_chart hidden-xs">
                            <div class="float-left m-r-15">
                                <small>Visitors</small>
                                <h6 class="mb-0 mt-1"><i class="icon-user"></i> 1,784</h6>
                            </div>
                            <span class="bh_visitors float-right">2,5,1,8,3,6,7,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Visits</small>
                                <h6 class="mb-0 mt-1"><i class="icon-globe"></i> 325</h6>
                            </div>
                            <span class="bh_visits float-right">10,8,9,3,5,8,5</span>
                        </div>
                        <div class="bh_chart hidden-sm">
                            <div class="float-left m-r-15">
                                <small>Chats</small>
                                <h6 class="mb-0 mt-1"><i class="icon-bubbles"></i> 13</h6>
                            </div>
                            <span class="bh_chats float-right">1,8,5,6,2,4,3,2</span>
                        </div>
                    </div>
                </div>
            </div>

           
                                <div class="row clearfix">
                <div class="col-lg-12 col-md-12">
                     <form  action="operations/profile_update.php" method="post" enctype="multipart/form-data" id="form">
                         <input type="hidden" name="user_id" class="form-control" placeholder="Name" value="<?php echo $edit_id;?>">
                    <div class="card">
                                    <div class="body">
                <div class="row clearfix">

                    <div class="col-12">
                        <h6>Module Permission</h6>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>   <label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="W[]" value="0" /> -->
                                                UnCheck All
                                               <input class="checkbox-tick" id="selectAll" type="checkbox" checked="">
                                                <span ></span>
                                            </label></th>
                                        <th>Read</th>
                                        <th>Write</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                            if($edit_id)
                                    {
                                        while($edit_data = mysqli_fetch_assoc($sql)) 

                                        {
                                            $W=$edit_data['W'];
                                            $R=$edit_data['R'];
                                            $D=$edit_data['D'];
                                            $page_id= $edit_data['page_id'] ;

                                            $sql1=mysqli_query($conn, "SELECT * FROM tbl_menu where page_id='$page_id' and visibility='1'");  
                                              while($ddata = mysqli_fetch_assoc($sql1))   
                                                    {
                                                        $page_name=$ddata['page_name'];
                                                        ?>
                                            
                                            
                     
                                                         <tr>
                       
                                        <input type="hidden" name="page_id[]" value="<?php echo $page_id; ?>" />
                                        <td><?php echo $page_name;?></td>
                                      
                                        <td>
                                            <label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="W[]" value="0" /> -->
                                           
                                                <input class="checkbox-tick" name="W[<?php echo $page_id; ?>]" type="checkbox" value="1" <?php if($W=='1'){?>checked=""<?php }?>>
                                                
                                                <span ></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="fancy-checkbox">
                                               <!--  <input type="hidden" name="R[]" value="0" /> -->
                                                
                                                <input class="checkbox-tick" name="R[<?php echo $page_id; ?>]" type="checkbox" value="1" <?php if($R=='1'){?>checked=""<?php }?>>
                                                
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="fancy-checkbox">
                                                <!-- <input type="hidden" name="D[]" value="0" /> -->

                                                <input class="checkbox-tick" name="D[<?php echo $page_id; ?>]" type="checkbox" value="1" <?php if($D=='1'){?>checked=""<?php }?>>
                                                
                                                <span></span>
                                            </label>
                                        </td>
                                
                                            </tr>
                                            <?php } }
                                            }
                                             ?>

                                </tr>
                                
                       
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
<script type="text/javascript">
    // when page is ready
    $(document).ready(function() {
         // on form submit
        $("#form").on('submit', function() {
            // to each unchecked checkbox
            $(this).find('input[type=checkbox]:not(:checked)').each(function () {
                // set value 0 and check it
                $(this).attr('checked', true).val(0);
            });
        })
    })
</script>
<script type="text/javascript">
    // when page is ready
   $("#selectAll").click(function(){
        $("input[type=checkbox]").prop('checked', $(this).prop('checked'));

});
</script>
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/page-profile2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:00:57 GMT -->
</html>