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

     $sql=mysqli_query($conn, "SELECT * FROM users where user_id=$userid");
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

                        ?>
<body class="theme-orange">
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle auth-main">
				<div class="auth-box">
                    <div class="top">
                        <img src="https://wrraptheme.com/templates/lucid/hr/html/assets/images/logo-white.svg" alt="Lucid">
                    </div>
					<div class="card">
                        <div class="body">
                            <div class="user text-center m-b-30">
                                <img src="<?php if($image!=''){ echo $image;}else{?> assets/images/userdefault.jpg<?php }?>" class="rounded-circle" alt="Avatar">
                                <h4 class="name m-t-10"><?php echo $username?></h4>
                                <p><?php echo $user_email?></p>
                            </div>
                            <form action="">
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Enter your password ...">                                    
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>                                
                            </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

<!-- Mirrored from wrraptheme.com/templates/lucid/hr/html/light/page-lockscreen.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 24 Jun 2021 09:01:04 GMT -->
</html>
