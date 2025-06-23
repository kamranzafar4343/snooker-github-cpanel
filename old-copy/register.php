<!doctype html>
<html lang="en">


<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:00:55 GMT -->
<?php include "includes/head.php";
?>


<body class="theme-orange"  style="background-color: orange;">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main" >
				<div class="auth-box">
                    <div class="top">
                        <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-white.svg" alt="Store">
                    </div>
					<div class="card">
                             <?php
              

              if(isset($_GET['exist']) && $_GET['exist']=='true' ){
                  ?>
                  <div class="alert alert-danger" id="danger-alert">
  
  <strong>Sorry!</strong> Email already Exists. Please Register with different email.
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
                            <p class="lead">Register new users</p>
                        </div>
                        <div class="body">
                            <form class="form-auth-small" action="operations/signin.php" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Name</label>
                                    <input type="text" name='user_name' class="form-control" id="user_name"  placeholder="Name" required="">
                                </div>
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Role</label>
                                    <select name='user_privilege' class="form-control" id="user_privilege" required="">
                                       <option>-- Choose Role --</option> 
                                       <option>superadmin</option> 
                                       <option>manager</option> 
                                       <option>salesman</option>
                                       <option>accountant</option> 
                                       <option>operator</option> 
                                    </select>
                                    
                                </div>
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
                                <button type="submit" class="btn btn-primary btn-lg btn-block" name="signup">Signup</button>
                                <div class="bottom">
                                    <!-- <span class="helper-text m-b-10"><i class="fa fa-lock"></i> <a href="page-forgot-password.html">Forgot password?</a></span> -->
                                    <span>Already have an account? <a href="login.php">Login</a></span>
                                </div>
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/page-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:00:55 GMT -->
</html>
