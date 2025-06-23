<!DOCTYPE html>
<html lang="en" >
<?php 
                        error_reporting(0);
                        include "includes/config.php";
                        include "includes/session.php";
                        $sql=mysqli_query($conn, "SELECT * FROM tbl_company ");
                        $data=mysqli_fetch_assoc($sql);
                        $c_name = $data['c_name'];
                        $c_address = $data['c_address'];
                        $c_phone = $data['c_phone'];
                        $c_mobile = $data['c_mobile'];
                        $c_email = $data['c_email'];
                        $image = $data['user_profile'];

                        $sql_user=mysqli_query($conn, "SELECT * FROM users where user_id='$userid'");
                        $data=mysqli_fetch_assoc($sql_user);
                        $user_name = $data['user_name'];
                        $sale_id=$_GET['sale_id'];
                        
                 
                        ?>
<head>

  <meta charset="UTF-8">
  	
	
  <link rel="mask-icon" type="" href="https://static.codepen.io/assets/favicon/logo-pin-f2d2b6d2c61838f7e76325261b7195c27224080bc099486ddd6dccb469b8e8e6.svg" color="#111" />
  <title>POS | Invoice</title>

  <style>
@media print {
    .page-break { display: block; page-break-before: always; }
    .buttons-cash { display: none;} 
}
      #invoice-POS {
  box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
  padding: 2mm;
  margin: 0 auto;
  width: 44mm;
  background: #FFF;
}
#invoice-POS ::selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS ::moz-selection {
  background: #f31544;
  color: #FFF;
}
#invoice-POS h1 {
  font-size: 1.5em;
  color: #222;
}
#invoice-POS h2 {
  font-size: .9em;
}
#invoice-POS h3 {
  font-size: 1.2em;
  font-weight: 300;
  line-height: 2em;
}
#invoice-POS p {
  font-size: .7em;
  color: #666;
  line-height: 1.2em;
}
#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
  /* Targets all id with 'col-' */
  border-bottom: 1px solid #EEE;
}
#invoice-POS #top {
  min-height: 100px;
}
#invoice-POS #mid {
  min-height: 80px;
}
#invoice-POS #bot {
  min-height: 50px;
}
#invoice-POS #top .logo {
  height: 60px;
  width: 60px;
  background: url(<?php echo $image;?>) no-repeat;
  background-size: 60px 60px;
}
#invoice-POS .clientlogo {
  float: left;
  height: 60px;
  width: 60px;
  background: url(<?php echo $image;?>) no-repeat;
  background-size: 60px 60px;
  border-radius: 50px;
}
#invoice-POS .info {
  display: block;
  margin-left: 0;
}
#invoice-POS .title {
  float: right;
}
#invoice-POS .title p {
  text-align: right;
}
#invoice-POS table {
  width: 100%;
  border-collapse: collapse;
}
#invoice-POS .tabletitle {
  font-size: .5em;
  background: #EEE;
}
#invoice-POS .service {
  border-bottom: 1px solid #EEE;
}
#invoice-POS .item {
  width: 24mm;
}
#invoice-POS .itemtext {
  font-size: .5em;
}
#invoice-POS #legalcopy {
  margin-top: 5mm;
}

    </style>

  <script>
  window.console = window.console || function(t) {};
</script>



  <script>
  if (document.location.search.match(/type=embed/gi)) {
    window.parent.postMessage("resize", "*");
  }
</script>


</head>

<body translate="no" onload="window.print();">


  <div id="invoice-POS">

    <center id="top">
      <div class="logo"></div>
      <div class="info"> 
        <h2><?php echo $c_name;?></h2>
        <?php
          $sql_date=mysqli_query($conn,"SELECT created_date from tbl_sale_detail where sale_id='$sale_id'");
                      $value2 = mysqli_fetch_assoc($sql_date);
                       $created_date=$value2['created_date'];
                                  $month=date("F", strtotime($created_date));
                                  $day = date("d",strtotime($created_date));
                                  $year = date("Y",strtotime($created_date));
          ?>
        <p><?php echo $month;?> <?php echo $day;?>, <?php echo $year;?></p>
      </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid">
      <div class="info">
        <h2>Contact Info</h2>
        <p> 
          
            Address : <?php echo $c_address;?></br>
            Email   : <?php echo $c_email;?></br>
            Phone   : <?php echo $c_mobile;?></br>
            
        </p>
      </div>
    </div><!--End Invoice Mid-->

    <div id="bot">

                    <div id="table">
                        <table>
                            <tr class="tabletitle">
                                <td class="item"><h2>Item</h2></td>
                                <td class="Hours"><h2>Qty</h2></td>
                                <td class="Rate"><h2>Sub Total</h2></td>
                            </tr>
                            <?php
                            $sql_detail = mysqli_query($conn,"SELECT * FROM tbl_sale_detail where sale_id='$sale_id'");
                                 while($detail_data = mysqli_fetch_assoc($sql_detail)){
                                 	$item_id=$detail_data['product'];
                                 	$qty=$detail_data['qty'];
                                 	$amount=$detail_data['amount'];
                                 
                                 	$sql2=mysqli_query($conn,"SELECT item_name, brand_id from tbl_items where item_id='$item_id'");
									    $value2 = mysqli_fetch_assoc($sql2);
									    $item_name=$value2['item_name'];
									    $brand_id=$value2['brand_id'];
									$sql3=mysqli_query($conn,"SELECT cat_name from tbl_catagory where id='$brand_id'");
									    $value3 = mysqli_fetch_assoc($sql3);
									    $brand_name=$value3['cat_name'];
                            ?>

                            <tr class="service">
                                <td class="tableitem"><p class="itemtext"><?php echo $brand_name;?> <?php echo $item_name;?></p></td>
                                <td class="tableitem"><p class="itemtext"><?php echo $qty;?></p></td>
                                <td class="tableitem"><p class="itemtext">Rs <?php echo $amount;?></p></td>
                            </tr>
                        	<?php }?>
                        	<?php 
                        	$sql_main = mysqli_query($conn,"SELECT * FROM tbl_sale where sale_id='$sale_id'");
                                  $main_data = mysqli_fetch_assoc($sql_main);
                                  $discount=$main_data['discount'];
                                  $tax=$main_data['tax'];
                                  $gross_amount=$main_data['gross_amount'];
                                  $amount_recieved=$main_data['amount_recieved'];
                            ?>
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Discount</h2></td>
                                <td class="payment"><h2>Rs <?php echo round($discount);?></h2></td>
                            </tr>

                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Tax</h2></td>
                                <td class="payment"><h2><?php echo $tax;?>%</h2></td>
                            </tr>
                             <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Total</h2></td>
                                <td class="payment"><h2>Rs <?php echo round($gross_amount);?></h2></td>
                            </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Total Recieved</h2></td>
                                <td class="payment"><h2>Rs <?php echo round($amount_recieved);?></h2></td>
                            </tr>
                            <tr class="tabletitle">
                                <td></td>
                                <td class="Rate"><h2>Total Return</h2></td>
                                <td class="payment"><h2>Rs <?php echo round($amount_recieved-$gross_amount);?></h2></td>
                            </tr>

                        </table>
                    </div><!--End Table-->

                    <div id="legalcopy">
                        <p class="legal"><strong>Thank you for your business!</strong>. 
                        </p>
                    </div>

                </div><!--End InvoiceBot-->
  </div><!--End Invoice-->
   							<div class="d-flex justify-content-end align-items-center flex-column buttons-cash">
								
								<div> 
									<a href="pos.php" class="btn btn-success white mb-2">
										<i class="fas fa-arrow-left mr-2"></i>
										Back to POS
									</a>
								
								</div>
							 </div>






</body>

</html>
