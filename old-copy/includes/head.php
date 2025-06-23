<head>
     <?php 
 date_default_timezone_set("Asia/Karachi");
                        error_reporting(0);
                        include "includes/config.php";
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $image1 = $data['user_profile'];
                        $lang=$data['lang'];
                        $color=$data['color'];
                        ?>
<title><?php echo $c_name;?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

<style type="text/css">
  .goog-te-banner-frame.skiptranslate{display: none !important;}body{top :0px !important;}
</style>

<link rel="icon" href="<?php echo $image1; ?>" type="image/x-icon">
<!-- VENDOR CSS -->
<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">

<link rel="stylesheet" href="assets/vendor/chartist/css/chartist.min.css">
<link rel="stylesheet" href="assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
<link rel="stylesheet" href="assets/vendor/toastr/toastr.min.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="assets_light/css/main.css">
<link rel="stylesheet" href="assets_light/css/color_skins.css">
<link rel="stylesheet" href="assets_light/css/inbox.css">
<link rel="stylesheet" href="assets/css/bootstrap4.min.css">
<div id="google_translate_element" style="display:none;"></div>

<script type="text/javascript">
function googleTranslateElementInit() {
  new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
function setCookie(key, value, expiry) {
  var expires = new Date();
  expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
  document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}
function googleTranslateElementInit() {
    setCookie('googtrans', '/en/<?php echo $lang;?>',1);
    new google.translate.TranslateElement({
       pageLanguage: 'en'
    }, 'google_translate_element');
}
</script>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
</head>
<?php
error_reporting(0);
               $page_name=basename($_SERVER['PHP_SELF']);
                $base_page_name=explode('.', $page_name);
                $page=$base_page_name[0];
               
                $sql1=mysqli_query($conn,"SELECT page_id  FROM tbl_menu where page_link='$page'");
                $data = mysqli_fetch_assoc($sql1);
                $page_id=$data['page_id'];
                
                $query=mysqli_query($conn,"SELECT R,U,D,W FROM tbl_permission where page_id='$page_id' and user_id='$userid'");
                $data = mysqli_fetch_assoc($query);
                $R=$data['R'];
                $U=$data['U'];
                $D=$data['D'];
                $W=$data['W'];
                if($userid=='1')
                {
                    $R=1;
                    $U=1;
                    $D=1;
                    $W=1;
                }
            
               
                if($R=='0' && $U=='0' && $D=='0' && $W=='0')
                {?>
                        <script type="text/javascript">
                             window.location.href = './index.php?'+'permission=fail';
                        </script>

                <?php }
               
                
               
?>

<script type="text/javascript">


window.addEventListener('keydown', function (event) {
    if (event.altKey && event.code === 'KeyS') {
        window.location.href = './sale_list.php';
    }
    if (event.altKey && event.code === 'KeyV') {
        window.location.href = './add_vendors.php';
    }
     if (event.altKey && event.code === 'KeyC') {
        window.location.href = './add_clients.php';
    }
     if (event.altKey && event.code === 'KeyP') {
        window.location.href = './add_payment.php';
    }
});

</script>