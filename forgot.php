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
if(isset($_GET['update']) && $_GET['update']=='done'){?>
<div class="alert alert-success" id="danger-alert">
  <strong>Great !</strong> Password Changed. Please login.
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
if(isset($_GET['update']) && $_GET['update']=='fail'){?>
<div class="alert alert-danger" id="danger-alert">
  <strong>Opps!</strong>  Password not changed.
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
<?php } ?>
                          <div class="alert alert-custom alert-danger" role="alert" id="success-alert4" style="display: none;">
                            <div class="alert-text"> <strong>Sorry ! </strong>No email was found !</div>
                          </div>
                          <div class="alert alert-custom alert-danger" role="alert" id="success-alert3" style="display: none;">
                            <div class="alert-text"> <strong>Sorry ! </strong>Secret was incorrect !</div>
                          </div>
                        <div class="header">
                            <p class="lead">Forgot your Password</p>
                        </div>
                        <div class="body">
                          
                            <form class="form-auth-small" action="operations/forgot.php" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label sr-only">Email</label>
                                    <input type="email" name='email' class="form-control" id="signin-email"  placeholder="Email" required="" onchange="check_email()">
                                </div>
                                 <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">Secret</label>
                                    <input type="text" name='secret' class="form-control" id="signin-secret"  placeholder="Secret" required="" onchange="check_secret()">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label sr-only">New Password</label>
                                    <input type="password" name='password' class="form-control" id="signin-password"  placeholder="New Password" required="">
                                </div>
                                 <button type="submit" class="btn btn-success btn-lg btn-block submit" id="submit" name="forgot" style="display: none">Update Password !</button>
                                
                                <div class="bottom">
                                  
                                </div>
                            </form>
                                <a href="login.php">
                                  <button type="button" class="btn btn-primary btn-lg btn-block">Login</button>
                                </a>
                        </div>
                    </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END WRAPPER -->
</body>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script src="assets_light/bundles/libscripts.bundle.js"></script>    
<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
<script type="text/javascript">


$(function() {
$("#submit").click(function() {
   var secret=$('#signin-secret').val();

    $.ajax({
                url: "operations/check_secret.php",
                type: "POST",
                data: {
                    secret : secret
                },
                
                success: function(dataResult){
                 
                  if(dataResult=='')
                  {
                    $("#signin-secret").val('');
                    $("#success-alert3").show();
                    $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                    $("#success-alert3").slideUp(200);
                    });
                    $(".submit").hide();
                    return false;
                  }
                  else
                  {
                    $(".submit").show();
                  }
                }
            });
  });

});
</script>
<script type="text/javascript">

function  check_email()
{
  var email=$('#signin-email').val();
 
   $.ajax({
                url: "operations/check_email.php",
                type: "POST",
                data: {
                    email : email
                },
                
                success: function(dataResult){
                 
                  if(dataResult=='')
                  {
                    $("#signin-email").val('');
                    $("#success-alert4").show();
                    $("#success-alert4").fadeTo(4000, 200).slideUp(200, function() {
                    $("#success-alert4").slideUp(200);
                    });
                  }
                  
                }
            });
}
function  check_secret()
{
  var secret=$('#signin-secret').val();

    $.ajax({
                url: "operations/check_secret.php",
                type: "POST",
                data: {
                    secret : secret
                },
                
                success: function(dataResult){
                 
                  if(dataResult=='')
                  {
                    $("#signin-secret").val('');
                    $("#success-alert3").show();
                    $("#success-alert3").fadeTo(4000, 200).slideUp(200, function() {
                    $("#success-alert3").slideUp(200);
                    });
                    $(".submit").hide();
                    return false;
                  }
                  else
                  {
                    $(".submit").show();
                  }
                }
            });
}
</script>
</html>
