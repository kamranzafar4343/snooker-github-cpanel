<!doctype html>
<html lang="en">



<?php 
include "includes/head.php";
include "includes/config.php";
?>


<body class="theme-orange"  style="background-color: orange;">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main" >
				<div class="auth-box">
                    <div class="top">
                      <?php 
                        error_reporting(0);
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image1 = $data['user_profile'];
                 
                        ?>
                       <img src="<?php echo $image1; ?>" class="img-responsive logo" alt="Logix'199"  style="width: 70px;"><span style="color: white; font-size: 20px; padding: 15px;"><?php echo $c_name;?></span>
                    </div>
					<div class="card">
                            <?php
                             error_reporting(0);
                            if(isset($_GET['log']) && $_GET['log']=='incorrect' || $_GET['log']=='notfound'){
               
                                    ?>
                                    <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong> One or more details are incorrect. Please try again.
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
                                    if(isset($_GET['log']) && $_GET['log']=='denied'){
               
                                    ?>
                                    <div class="alert alert-danger" id="danger-alert">
  
  <strong>Opps!</strong> Only Admin can Login.
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
              
              if(isset($_GET['log']) && $_GET['log']=='reseted' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Password Reset Succesfully. Please Login again.
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

              if(isset($_GET['registration']) && $_GET['registration']=='successful' ){
                  ?>
                  <div class="alert alert-success" id="success-alert">
  
  <strong>Great!</strong> Registered Succesfully. Please Login.
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

              if(isset($_GET['log']) && $_GET['log']=='blocked' ){
                  ?>
                  <div class="alert alert-danger" id="success-alert">
  
  <strong>Sorry !</strong> Your account has been blocked. Please contact admistration for more details.
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
              ?>
                        <div class="header">
                            <p class="lead">Login to your account</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" action="operations/signin.php" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" name='email' class="form-control" id="signin-email"  placeholder="Email" required="">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Password</label>
                                    <input type="password" name='password' class="form-control" id="signin-password"  placeholder="Password" required="">
                                </div>
                                <div class="form-group clearfix">
                                    <label class="fancy-checkbox element-left">
                                        <input type="checkbox">
                                        <span>Remember me</span>
                                    </label>								
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="login">LOGIN</button>
                                <div class="bottom">
                                  
                                </div>
                            </form>
                            <a href="forgot.php">
                            <button type="button" class="btn btn-danger btn-lg btn-block" name="Forgot">Forgot Password !</button>
                          </a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
