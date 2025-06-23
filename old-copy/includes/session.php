<?php
session_start();

if(!isset($_SESSION['adminid'])){?>

   <script>
    window.location.href = "login.php?access=denied";
</script>
<!--header("Location: login.php?access=denied");	-->
<?php }
else{
	$userid=$_SESSION['adminid'];
}
?>