<!DOCTYPE html>
<html lang="en">

<head>
	<style type="text/css">
		.goog-te-banner-frame.skiptranslate {
			display: none !important;
		}

		body {
			top: 0px !important;
		}
  /* Increase height of all select2 dropdowns */
  .select2-container--default .select2-results__options {
            max-height: 426px !important;
            overflow-y: auto !important;
        }

        /* Alternative more specific selector if needed */
        .select2-results__options {
            max-height: 426px !important;
            overflow-y: auto !important;
        }

	</style>
	<?php
	error_reporting(0);
	ini_set('max_execution_time', 300);
	include "includes/config.php";
	include "includes/session.php";
	include "includes/head.php";
	$hidden_main = "";
	if ($userid != 1) {
		$hidden_main = "visibility: hidden";
	}

	$sql = mysqli_query($conn, "SELECT * FROM tbl_company ");
	$data = mysqli_fetch_assoc($sql);
	$c_name = $data['c_name'];
	$c_address = $data['c_address'];
	$c_phone = $data['c_phone'];
	$c_mobile = $data['c_mobile'];
	$image = $data['user_profile'];
	$lang = $data['lang'];
	$color = $data['color'];
	$over_selling = $data['over_selling'];
	$sql_user = mysqli_query($conn, "SELECT * FROM users where user_id='$userid'");
	$data = mysqli_fetch_assoc($sql_user);
	$user_name = $data['user_name'];
	$hidden = '';
	if (isset($_GET['edit_id']) && isset($_GET['ref_id'])) {
		$ref_id = $_GET['ref_id'];
		$edit_id = $_GET['edit_id'];
		$sql_sale = mysqli_query($conn, "SELECT * FROM tbl_sale where sale_id='$edit_id'");
		$data = mysqli_fetch_assoc($sql_sale);
		$customer_name = $data['customer_name'];
		$table_id = $data['table_id'];
		$created_date = $data['created_date'];


		$sql_customer = mysqli_query($conn, "SELECT fixed_discount FROM tbl_customer where customer_id='$customer_name'");
		$value3 = mysqli_fetch_assoc($sql_customer);
		$customer_type = $value3['customer_type'];
		$fixed_discount = $value3['fixed_discount'];
		$sales_men_edit = $data['sales_men'];
		$net_amount = $data['net_amount'];
		$tax = $data['tax'];
		$gross_amount = $data['gross_amount'];
		$amount_recieved = $data['amount_recieved'];
		$discount = $data['discount'];
		$hidden = 'hidden';
	} else if (isset($_GET['free_id']) && isset($_GET['ref_id'])) {
		$ref_id = $_GET['ref_id'];
		$free_id = $_GET['free_id'];
		$sql_sale = mysqli_query($conn, "SELECT * FROM tbl_sale where sale_id='$free_id'");
		$data = mysqli_fetch_assoc($sql_sale);
		$customer_name = $data['customer_name'];
		$table_id = $data['table_id'];
		$sql_customer = mysqli_query($conn, "SELECT fixed_discount FROM tbl_customer where customer_id='$customer_name'");
		$value3 = mysqli_fetch_assoc($sql_customer);
		$customer_type = $value3['customer_type'];
		$fixed_discount = $value3['fixed_discount'];
		$sales_men_edit = $data['sales_men'];
		$net_amount = $data['net_amount'];
		$tax = $data['tax'];
		$gross_amount = $data['gross_amount'];
		$amount_recieved = $data['amount_recieved'];
		$discount = $data['discount'];
	} else if (isset($_GET['ref_id'])) {
		$ref_id = $_GET['ref_id'];

		$sql_sale = mysqli_query($conn, "SELECT * FROM tbl_sale_temp where ref_id='$ref_id'");
		$data = mysqli_fetch_assoc($sql_sale);
		$customer_name = $data['customer'];
		$sales_men_edit = $data['sales_men'];

		$sql_sale = mysqli_query($conn, "SELECT SUM(amount) as net_amount FROM tbl_sale_temp where ref_id='$ref_id'");
		$data = mysqli_fetch_assoc($sql_sale);

		$net_amount = $data['net_amount'];
		$tax = 0;
		$gross_amount = $data['net_amount'];
		$amount_recieved = $data['net_amount'];
		$discount = 0;
	} else {
		do {
			$ref_id = 'S' . rand(1000000000, 9999999999);
			$sql_sale_temp = mysqli_query($conn, "SELECT temp_id FROM tbl_sale_temp where ref_id='$ref_id'");
			$sql_sale = mysqli_query($conn, "SELECT invoice_no FROM tbl_sale_detail where invoice_no='$ref_id'");
		} while (mysqli_num_rows($sql_sale_temp) > 0 && mysqli_num_rows($sql_sale) > 0);
	}



	?>
	<div id="google_translate_element" style="display:none;"></div>

	<script type="text/javascript">
		function googleTranslateElementInit() {
			new google.translate.TranslateElement({
				pageLanguage: 'en'
			}, 'google_translate_element');
		}

		function setCookie(key, value, expiry) {
			var expires = new Date();
			expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
			document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
		}

		function googleTranslateElementInit() {
			setCookie('googtrans', '/en/<?php echo $lang; ?>', 1);
			new google.translate.TranslateElement({
				pageLanguage: 'en'
			}, 'google_translate_element');
		}
	</script>

	<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
	<meta charset="utf-8" />
	<link rel="icon" href="<?php echo $image; ?>" type="image/x-icon">
	<title>POS | <?php echo $c_name; ?></title>
	<meta name="description" content="Updates and statistics" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<link href="assets/css/stylec619.css?v=1.0" rel="stylesheet" type="text/css" />
	<link href="assets/api/pace/pace-theme-flat-top.css" rel="stylesheet" type="text/css" />
	<link href="assets/api/mcustomscrollbar/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css" />

	<link rel="stylesheet" type="text/css" href="../../cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


	<link rel="shortcut icon" href="assets/media/logos/favicon.html" />

</head>
<!--end::Head-->
<!--begin::Body-->

<body id="tc_body" class="header-fixed header-mobile-fixed subheader-enabled aside-enabled aside-fixed" style="background: <?php echo $color; ?> !important; ">
	<!-- Paste this code after body tag -->
	<div class="se-pre-con" style="background: <?php echo $color; ?> !important; ">
		<div class="pre-loader">
			<img class="img-fluid" src=".\uploads\company_img\comp.jpg" width="100" height="100" alt="loading">
		</div>
	</div>
	<!-- pos header -->

	<header class="pos-header bg-white">
		<div class="container-fluid">
			<div class="row align-items-center">
				<div class="col-xl-4 col-lg-4 col-md-6">
					<div class="greeting-text">
						<h3 class="card-label mb-0 font-weight-bold text-primary">WELCOME
						</h3>
						<h3 class="card-label mb-0 ">
							<?php echo $user_name; ?>
						</h3>
					</div>

				</div>
				<div class="col-xl-4 col-lg-5 col-md-6  clock-main">
					<div class="clock">
						<div class="datetime-content">
							<ul>
								<li id="hours"></li>
								<li id="point1">:</li>
								<li id="min"></li>
								<li id="point">:</li>
								<li id="sec"></li>
							</ul>
						</div>
						<div class="datetime-content">
							<div id="Date" class=""></div>
						</div>

					</div>

				</div>
				<div class="col-xl-4 col-lg-3 col-md-12  order-lg-last order-second">

					<div class="topbar justify-content-end">
						<a href="pos_sale_list.php" class='btn btn-sm btn-outline-info'>Sale List</a>&nbsp;
						<div class="dropdown mega-dropdown">
							<div id="id2" class="topbar-item " data-toggle="dropdown" data-display="static">
								<div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3">

									<span class="symbol symbol-35 symbol-light-success">
										<span class="symbol-label bg-primary  font-size-h5 ">

											<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" fill="#fff" class="bi bi-calculator-fill" viewBox="0 0 16 16">
												<path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2zm2 .5v2a.5.5 0 0 0 .5.5h7a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 0-.5-.5h-7a.5.5 0 0 0-.5.5zm0 4v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM4.5 9a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM4 12.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zM7.5 6a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM7 9.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1zM10 6.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5zm.5 2.5a.5.5 0 0 0-.5.5v4a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-.5-.5h-1z" />
											</svg>
										</span>
									</span>
								</div>
							</div>

							<div class="dropdown-menu dropdown-menu-right calu" style="min-width: 248px;">
								<div class="calculator">
									<div class="input" id="input"></div>
									<div class="buttons">
										<div class="operators">
											<div>+</div>
											<div>-</div>
											<div>&times;</div>
											<div>&divide;</div>
										</div>
										<div class="d-flex justify-content-between">
											<div class="leftPanel">
												<div class="numbers">
													<div>7</div>
													<div>8</div>
													<div>9</div>
												</div>
												<div class="numbers">
													<div>4</div>
													<div>5</div>
													<div>6</div>
												</div>
												<div class="numbers">
													<div>1</div>
													<div>2</div>
													<div>3</div>
												</div>
												<div class="numbers">
													<div>0</div>
													<div>.</div>
													<div id="clear">C</div>
												</div>
											</div>
											<div class="equal" id="result">=</div>
										</div>
									</div>
								</div>
							</div>

						</div>
						<div class="topbar-item folder-data">
							<div class="btn btn-icon  w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3" id="keys_model" data-toggle="modal" data-target="#folderpopkeys">
								<img src="keys.png" alt="keys" class="img-fluid" style="width: 30px; height: 30px;">

							</div>

						</div>
						<div class="topbar-item folder-data">
							<div class="btn btn-icon  w-auto h-auto btn-clean d-flex align-items-center py-0 mr-3" id="darft_products_model" data-toggle="modal" data-target="#folderpop">
								<?php
								$sql_pending = mysqli_query($conn, "SELECT  DISTINCT ref_id as pending FROM tbl_sale_temp where user_id='$userid' and status='0'");
								$a = 0;
								while ($data = mysqli_fetch_assoc($sql_pending)) {
									$pending = $data['pending'];
									$a++;
								}
								?>
								<span class="badge badge-pill badge-primary" id="draft_bills"><?php echo $a; ?></span>
								<span class="symbol symbol-35  symbol-light-success">
									<span class="symbol-label bg-warning font-size-h5 ">
										<svg width="20px" height="20px" xmlns="http://www.w3.org/2000/svg" fill="#ffff" viewBox="0 0 16 16">
											<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z"></path>
										</svg>
									</span>
								</span>
							</div>

						</div>

						<div class="dropdown">
							<div class="topbar-item" data-toggle="dropdown" data-display="static">
								<div class="btn btn-icon w-auto h-auto btn-clean d-flex align-items-center py-0">

									<span class="symbol symbol-35 symbol-light-success">
										<span class="symbol-label font-size-h5 ">
											<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-person-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
												<path fill-rule="evenodd" d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"></path>
											</svg>
										</span>
									</span>
								</div>
							</div>

							<div class="dropdown-menu dropdown-menu-right" style="min-width: 150px;">


								<a href="logout.php" class="dropdown-item">
									<span class="svg-icon svg-icon-xl svg-icon-primary mr-2">
										<svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-power">
											<path d="M18.36 6.64a9 9 0 1 1-12.73 0"></path>
											<line x1="12" y1="2" x2="12" y2="12"></line>
										</svg>
									</span>
									Logout
								</a>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</header>
	<div class="contentPOS">
		<?php


		if (isset($_GET['add']) && $_GET['add'] == 'successfull') {
		?>
			<div class="alert alert-success" id="danger-alert">

				<strong>Great!</strong> Client Added Succesfully.
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

		<?php


		//   if(isset($_GET['record']) && $_GET['record']=='exist' ){
		?>
		<!--<div class="alert alert-danger" id="danger-alert">-->

		<!-- <strong>Opps!</strong> Client with Same CNIC already Exist. -->
		<!--</div>-->
		<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
		<script type="text/javascript">
			// $(document).ready(function() {
			//   $("#danger-alert").hide();

			// $("#danger-alert").fadeTo(4000, 500).slideUp(500, function() {
			//   $("#danger-alert").slideUp(500);
			// });
			//   });
		</script>
		<?php
		// }
		?>

		<div class="container-fluid">
			<div class="row">
				<div class="col-xl-4 order-xl-first order-last ">
					<div class="card card-custom gutter-b bg-default border-0" style="max-height: 100%;">

						<div class="card-body">

							<div class="form-group row mb-0">
								<div class="col-md-12">
									<label for="search" class="form-label">Search Product</label>
									<input class="form-control bag-primary" id="product_search_side" placeholder="Type to search..." style="max-height: 50px;">

								</div>
							</div>
							<br>


							<div class="product-items" <?php echo $hidden; ?>>
								<div class="row" id="side_products" style="max-height: 100%;">

								</div>
							</div>
						</div>

					</div>
				</div>

				<div class="col-xl-5 col-lg-8 col-md-12">
					<div class="">
						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
							<div class="card-body">
								<form action="operations/add_sale_pos.php" method="post" enctype="multipart/form-data">
									<div class="d-flex justify-content-between colorfull-select" style="max-width: 100%;">
										<div class="selectmain">
											<label class="text-dark d-flex">Choose a Customer
												<span class="badge badge-secondary white rounded-circle" data-toggle="modal" data-target="#choosecustomer">
													<svg xmlns="http://www.w3.org/2000/svg" class="svg-sm" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_122" x="0px" y="0px" width="512px" height="512px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
														<g>
															<rect x="234.362" y="128" width="43.263" height="256"></rect>
															<rect x="128" y="234.375" width="256" height="43.25"></rect>
														</g>
													</svg>
												</span>

											</label>
											<input class="form-control bag-primary " id="over_selling" value="<?php echo $over_selling; ?>" hidden>
											<select class="form-control" id="customer" name="customer" style="max-width: 100%;" onchange="check_discount();">
												<option value="" selected>Choose a Customer</option>
												<?php

												$query = mysqli_query($conn, "SELECT user_privilege,created_by FROM users where user_id='$userid'");
												$data = mysqli_fetch_assoc($query);
												$user_privilege = $data['user_privilege'];
												$created_by = $data['created_by'];

												if ($user_privilege != 'branch' && $created_by == '1') {

													$sql = "SELECT * FROM tbl_account_lv2 where Left(acode,6)='100200'";
												} else {
													$sql = "SELECT * FROM tbl_account_lv2 where Left(acode,6)='100200' and created_by='$userid'";
												}

												foreach ($conn->query($sql) as $row) {
													$acode = $row['acode'];
													$aname = $row['aname'];
													$bsql = mysqli_query($conn, "SELECT * FROM tbl_customer where  parent_id='$userid' and customer_id='$acode' and blacklist='0'");
													$data = mysqli_fetch_assoc($bsql);
													$seprate_customer_id = $data['seprate_customer_id'];
													$mobile_no1 = $data['mobile_no1'];
													$client_cnic = $data['client_cnic'];
													$customer_by = $data['created_by'];
													$sql = mysqli_query($conn, "SELECT user_name FROM users where user_id='$customer_by'");
													$data = mysqli_fetch_array($sql);
													$branchname = $data['user_name'];
													$iden = str_split($branchname);
													$iden3 = str_split($branchname, 3);
													$iden2 = end($iden3);
													$iden1 = $iden[0];

													if ($row['anmae'] == 'Walk in Customer' && $edit_id == '' && $ref_id == '') {
														echo "<option value=$row[acode] selected>$row[aname]</option>";
													} else if ($row['acode'] == $customer_name && $edit_id != '' && $ref_id != '') {
														echo "<option value=$row[acode] selected>$row[aname]</option>";
													} else if ($row['acode'] == $customer_name && $edit_id == '' && $ref_id != '') {
														echo "<option value=$row[acode] selected>$row[aname]</option>";
													} else {
														echo "<option value=$row[acode]>$row[aname] ($iden1$iden2" . "_" . "$seprate_customer_id) ($mobile_no1) </option>";
													}
												}

												echo "</select>";
												?>
											</select>
										</div>
										<?php
										$date = date('Y-m-d');
										$date_prev = date('Y-m-d', strtotime('-1 day', strtotime($date)));
										$date_next = date('Y-m-d', strtotime('+1 day', strtotime($date)));
										?>
										<div class="d-flex flex-column selectmain">
											<label class="text-dark d-flex">Table </label>
											<input type="hidden" name="created_date" value="<?php echo $date; ?>">

											<select class="form-control" id="table" name="table" style="max-width: 100%;" required="">
												<option value="" selected>Choose Table</option>
												<?php
												if ($edit_id != '' || $free_id != '') {
													$sql = "SELECT * FROM tbl_tables where table_id='$table_id'";
												} else {
													$sql = "SELECT * FROM tbl_tables";
												}
												foreach ($conn->query($sql) as $row) {

													echo "<option value=$row[table_id] selected>$row[table_name] </option>";
												}

												echo "</select>";
												?>
											</select>

										</div>
										<div class="d-flex flex-column selectmain">
											<label class="text-dark d-flex">Ref # </label>
											<input type="text" name="ref_id" readonly tabindex="-1" id="ref_id" required readonly class="form-control" value="<?php echo $ref_id; ?>">
											<input type="hidden" name="sales_men" readonly tabindex="-1" id="sales_men" required readonly class="form-control" value="<?php echo $userid; ?>">
										</div>

									</div>
							</div>
							<div class="card-body">
								<div class="alert alert-danger" id="product-alert" style="display: none;">
									<strong>Sorry !</strong> add atleast one item.
								</div>
								<div class="alert alert-danger" id="select-alert" style="display: none;">
								  <strong>Sorry !</strong> Please select customer first.
								</div>
								<div class="alert alert-danger" id="table-alert" style="display: none;">
									<strong>Sorry !</strong> Please select table first.
								</div>
								<div class="alert alert-danger" id="customer-alert" style="display: none;">
									<strong>Sorry !</strong> for cash sale amount recieved must be equal to total amount.
								</div>
								<div class="alert alert-danger" id="customer-alert1" style="display: none;">
									<strong>Sorry !</strong> for credit sale amount recieved must be equal to zero.
								</div>
								<div class="alert alert-danger" id="product-alert1" style="display: none;">
									<strong>Sorry !</strong> this item is out of stock.
								</div>

								<div class="form-group row mb-0">
									<div class="col-md-12" <?php echo $hidden; ?>>
										<label for="exampleDataList" class="form-label">Search Product</label>
										<select id="product_search" name="product" style="width: 100%; max-height: 50%" onchange="add_item();">
											<option value="" selected="">Select Item</option>
											<?php
											$sql = "SELECT tbl_items.*, tbl_cat.catagory_name, tbl_purchase_detail.* FROM tbl_items INNER JOIN tbl_cat ON tbl_items.category = tbl_cat.id INNER JOIN tbl_purchase_detail ON tbl_items.item_id = tbl_purchase_detail.product WHERE tbl_purchase_detail.qty_rec!='' ";
											foreach ($conn->query($sql) as $row) {


												echo "<option value=$row[item_id]>$row[item_id] - $row[catagory_name] $row[item_name] </option>";
											}


											echo "</select>";
											?>

										</select>

									</div>
								</div>
							</div>
						</div>
						<div class="card card-custom gutter-b bg-white border-0 table-contentpos">
							<br>
							<div class="table-datapos" style="height: 500px !important;">
								<div class="table-responsive">
									<table id="product_info_table" class="display" style="width:100%">
										<thead>
											<tr>
												<th style="width: 50%">Name</th>
												<th>Quantity</th>
												<th>Rate</th>
												<th>Subtotal</th>
												<th class=" text-right no-sort"></th>
											</tr>
										</thead>

										<tbody id="products" style="margin-top: 5px;">
										</tbody>
									</table>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group row mb-0">
									<div class="col-md-12 btn-submit d-flex justify-content-end">
										<table class="table right-table">

											<tbody>
												<tr class="d-flex align-items-center justify-content-between" style="border-top:1px solid #000 !important">
													<th class="border-0 font-size-h5 mb-0 font-size-bold text-info">
														Total Items
													</th>
													<td class="border-0 justify-content-end d-flex text-secondary font-size-base"><input type="number" name="total_items" readonly id="total_items" tabindex="-1" required readonly class="form-control" style="background-color: transparent; border: 0px solid; height: 20px; width: 200px; color: black; font-size: 20px;"><input type="hidden" name="edit_id" id="edit_id" value="<?php echo $edit_id; ?>"><input type="hidden" name="stock" id="stock"></td>

												</tr>
												<tr class="d-flex align-items-center justify-content-between" style="border-bottom: 1px solid #000 !important">
													<th class="border-0 font-size-h4 mb-0 font-size-bold text-danger">
														Subtotal (Rs)
													</th>
													<td class="border-0 justify-content-end d-flex text-dark font-size-base">
														<input type="number" name="sub_total" readonly id="sub_total" tabindex="-1" required readonly class="form-control" style="background-color: transparent; border: 0px solid; height: 25px; width: 200px; color: black; font-size: 25px;">
														<input type="hidden" name="invoice_date" value="<?php echo $created_date; ?>">
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="card-body">
								<div class="form-group row mb-0">
									<div class="col-md-12 btn-submit d-flex justify-content-end">
										<button type="button" class="btn btn-danger mr-2 confirm-delete" title="Delete" onclick="delete_order()">
											<i class="fas fa-trash-alt mr-2"></i>
											Suspand/Cancel
										</button>
										<button type="button" class="btn btn-secondary white" id="draft_order_button" onclick="draft_order()" ;>
											<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-folder-fill svg-sm mr-2" viewBox="0 0 16 16">
												<path d="M9.828 3h3.982a2 2 0 0 1 1.992 2.181l-.637 7A2 2 0 0 1 13.174 14H2.826a2 2 0 0 1-1.991-1.819l-.637-7a1.99 1.99 0 0 1 .342-1.31L.5 3a2 2 0 0 1 2-2h3.672a2 2 0 0 1 1.414.586l.828.828A2 2 0 0 0 9.828 3zm-8.322.12C1.72 3.042 1.95 3 2.19 3h5.396l-.707-.707A1 1 0 0 0 6.172 2H2.5a1 1 0 0 0-1 .981l.006.139z" />
											</svg>
											Draft Order
										</button>
									</div>
								</div>
							</div>



						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-4 col-md-12">
					<div class="card card-custom gutter-b bg-white border-0">
						<div class="card-body">
							<div class="shop-profile">
								<div class="media">
									<div class="bg-primary w-100px h-100px d-flex justify-content-center align-items-center">
										<img src="<?php echo $image; ?>" alt="user" class="img-fluid">
									</div>
									<div class="media-body ml-3">
										<h3 class="title font-weight-bold">The <?php echo $c_name; ?> Shop</h3>
										<p class="phoonenumber">
											<?php echo $c_phone; ?>
										</p>
										<p class="adddress">
											<?php echo $c_address; ?>
										</p>
										<p class="countryname">Pakistan</p>
									</div>
								</div>
							</div>
							<div class="resulttable-pos">
								<table class="table right-table">

									<tbody>
										<tr class="d-flex align-items-center justify-content-between">
											<th class="border-0 font-size-h4 mb-0 font-size-bold text-danger">
												Sale Type
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base">
												<select class="form-control badge-secondary text-white" name="sale_type" id="sale_type" style="width: 180px;" onchange="subAmount();">
													<?php if ($edit_id != '') {
														if ($sale_type == 'Credit') { ?>
															<option>Cash</option>
															<option selected="">Credit</option>
														<?php } else { ?>
															<option selected="">Cash</option>
															<option>Credit</option>
														<?php }
													} else { ?>
														<option>Cash</option>
														<option selected="">Credit</option>
													<?php } ?>
												</select>
											</td>

										</tr>

										<tr class="d-flex align-items-end justify-content-between" style="border-top:1px solid #000 !important; <?php echo $hidden_main; ?>">
											<th class="border-0 ">
												<div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark">
													FIXED DISCOUNT(%)
												</div>
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base"><input type="text" name="fixed_discount" id="fixed_discountt" class="form-control calculate text-right" readonly="" value="<?php echo $fixed_discount; ?>" style="background-color: transparent; border: 1px solid; height: 30px; width: 200px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-center justify-content-between hidden" style="border-top:1px solid #000 !important; <?php echo $hidden_main; ?>">
											<th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
												Amount after fixed discount(Rs)
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base"><input type="text" name="after_fdiscount" id="after_fdiscount" tabindex="-1" readonly class="form-control text-right" style="background-color: transparent; border: 0px solid; height: 30px; width: 100px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-end justify-content-between" style="border-top:1px solid #000 !important;   <?php echo $hidden_main; ?>">
											<th class="border-0 ">
												<div class="d-flex align-items-center font-size-h5 mb-0 font-size-bold text-dark">
													DISCOUNT(Rs)
												</div>
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base"><input type="text" name="discount" id="discount" class="form-control calculate text-right" onchange="subAmount();" value="<?php echo $discount; ?>" style="background-color: transparent; border: 1px solid; height: 30px; width: 200px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-center justify-content-between" style="border-top:1px solid #000 !important; <?php echo $hidden_main; ?>">
											<th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
												Amount after discount(Rs)
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base"><input type="text" name="after_discount" id="after_discount" tabindex="-1" readonly class="form-control text-right" onchange="subAmount();" style="background-color: transparent; border: 0px solid; height: 30px; width: 100px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-center justify-content-between" style="border-top:1px solid #000 !important; <?php echo $hidden_main; ?>">
											<th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
												Tax(%)
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base"><input type="text" name="tax" id="tax" class="form-control calculate text-right" onchange="subAmount();" value="<?php echo $tax; ?>" style="background-color: transparent; border: 1px solid; height: 30px; width: 200px; color: black; font-size: 20px;"></td>

										</tr>

										<tr class="d-flex align-items-center justify-content-between" style="border-top:1px solid #000 !important; <?php echo $hidden_main; ?>">
											<th class="border-0 font-size-h5 mb-0 font-size-bold text-dark">
												Amount after tax(Rs)
											</th>
											<td class="border-0 justify-content-end d-flex text-dark font-size-base"><input type="text" name="after_tax" id="after_tax" tabindex="-1" readonly class="form-control text-right" onchange="subAmount();" value="<?php echo $gross_amount; ?>" style="background-color: transparent; border: 0px solid; height: 30px; width: 100px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-center justify-content-between item-price" style="border-top:1px solid #000 !important">
											<th class="border-0 font-size-h4 mb-0 font-size-bold text-primary">

												Total (Rs)
											</th>
											<td class="border-0 justify-content-end d-flex text-primary font-size-base"><input type="text" name="total_amount" id="total_amount" tabindex="-1" required readonly class="form-control text-right" style="background-color: transparent; border: 0px solid; height: 30px; width: 100px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-center justify-content-between item-price" style="border-top:1px solid #000 !important">
											<th class="border-0 font-size-h4 mb-0 font-size-bold text-info">

												Recieved (Rs)
											</th>
											<td class="border-0 justify-content-end d-flex text-primary font-size-base "><input type="text" name="total_amount_recieved" id="total_amount_recieved" required class="form-control calculate text-right" value="<?php echo $amount_recieved; ?>" onkeyup="subAmountReturn();" onfocus="this.select();" style="background-color: transparent; border: 1px solid; height: 30px; width: 200px; color: black; font-size: 20px;"></td>

										</tr>
										<tr class="d-flex align-items-center justify-content-between item-price" style="border-top:1px solid #000 !important">
											<th class="border-0 font-size-h4 mb-0 font-size-bold text-danger">

												Returned (Rs)
											</th>
											<td class="border-0 justify-content-end d-flex text-primary font-size-base"><input type="text" name="total_amount_return" id="total_amount_return" readonly="" tabindex="-1" required class="form-control text-right" value="<?php if ($amount_recieved) {
																																																																				echo round($amount_recieved - $net_amount);
																																																																			} else {
																																																																				echo 0;
																																																																			} ?>" style="background-color: transparent; border: 0px solid; height: 30px; width: 100px; color: black; font-size: 20px;"></td>


										</tr>

									</tbody>
								</table>
							</div>
							<div class="d-flex justify-content-end align-items-center flex-column buttons-cash">
								<div>
									<button type="submit" class="btn btn-primary white mb-2 submit_form" id="submit_form">
										<i class="fas fa-money-bill-wave mr-2"></i>
										Submit
									</button>

								</div>
								<!-- <div>
									<a href="#" class="btn btn-outline-secondary ">
										<i class="fas fa-credit-card mr-2"></i>
										Pay With Card
									</a>
									
								</div> -->
								<div>
									<a href="index.php" class="btn btn-success white mb-2">
										<i class="fas fa-arrow-left mr-2"></i>
										Back to Dashboard
									</a>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	</form>
	<div class="modal fade text-left" id="choosecustomer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel13" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel13">Add Customer</h3>
					<button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close">
						<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
					</button>
				</div>
				<div class="modal-body">
					<form action="operations/add_client.php" method="post">
						<div class="form-group row">

							<div class="col-md-6">
								<label class="text-body">Customer Name</label>
								<fieldset class="form-group mb-3">
									<input type="text" name="username" required="" class="form-control" placeholder="Client Name *">
								</fieldset>
							</div>
							<div class="col-md-6">
								<label class="text-body">Customer Cell</label>
								<fieldset class="form-group mb-3">

									<input type="text" class="form-control" name="mobile_no1" data-inputmask="'mask': '0399-99999999'" type="number" maxlength="12">

								</fieldset>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label class="text-body">Customer CNIC</label>
								<fieldset class="form-group mb-3">

									<input type="text" name="client_cnic" class="form-control" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X">

								</fieldset>
							</div>
							<div class="col-md-6">
								<label class="text-body">Customer Father Name</label>
								<fieldset class="form-group mb-3">
									<input type="text" name="client_fathername" class="form-control" placeholder="Customer Father Name">
								</fieldset>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-6">
								<label class="text-body">Customer Permanent Address</label>
								<fieldset class="form-group mb-3">
									<input type="text" name="address_permanent" class="form-control" placeholder="Customer Permanent Address">
								</fieldset>
							</div>
							<div class="col-md-6">
								<label class="text-body">Customer Residential Address</label>
								<fieldset class="form-group mb-3">
									<input type="text" name="address_current" class="form-control" placeholder="Customer Residential  Address">
								</fieldset>
							</div>
						</div>
						<div class="form-group row justify-content-end mb-0">
							<div class="col-md-6  text-right">
								<button type="submit" name="addclientspos" class="btn btn-primary">Add Customer</button>

							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade text-left col-sm-12 col-xl-12 col-sm-12" id="folderpopkeys" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel16">Short Keys</h3>
					<button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close" id="close_draft1">
						<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
					</button>
				</div>
				<div class="modal-body pos-ordermain">
					<div class="row" id="darft_product1">
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>Product Search Field focus</strong>
									<p>Press (Shift)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>Form Submit</strong>
									<p>Press (Enter)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>Submit button focus</strong>
									<p>Press (ESC)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>For Keys</strong>
									<p>Press (F2)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>For Draft Orders</strong>
									<p>Press (ALT)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>To Draft Order</strong>
									<p>Press (END)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>For next filed focus</strong>
									<p>Press (TAB)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>For Dashboard</strong>
									<p>Press (F4)</p>
									</p>
								</div>
							</div>
						</div>
						<div class="col-lg-4">
							<div class="pos-order">
								<h3 class="pos-order-title"></h3>
								<div class="orderdetail-pos">
									<p>
										<strong>For Suspand/Delete Order</strong>
									<p>Press (DELETE)</p>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade text-left col-sm-12 col-xl-12 col-sm-12" id="folderpop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel14" style="display: none;" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg " role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h3 class="modal-title" id="myModalLabel14">Draft Orders</h3>
					<button type="button" class="close rounded-pill btn btn-sm btn-icon btn-light btn-hover-primary m-0" data-dismiss="modal" aria-label="Close" id="close_draft">
						<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
							<path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
						</svg>
					</button>
				</div>
				<div class="modal-body pos-ordermain">
					<div class="row" id="darft_product">
						<?php
						$qty = 0;
						$amount = 0;
						$sql_user = mysqli_query($conn, "SELECT * FROM tbl_sale_temp where user_id='$userid' and ref_id!='$ref_id' and status='0' group by ref_id");
						while ($data = mysqli_fetch_assoc($sql_user)) {
							$ref_id_pending = $data['ref_id'];
							$customer = $data['customer'];
							$sales_men = $data['sales_men'];
							$ref_id = $data['ref_id'];

							$sql_detail = mysqli_query($conn, "SELECT SUM(qty) as total_qty, SUM(amount) as total_amount FROM tbl_sale_temp where ref_id='$ref_id'");
							$data_detail = mysqli_fetch_assoc($sql_detail);
							$total_qty = $data_detail['total_qty'];
							$total_amount = $data_detail['total_amount'];

							$sql = mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer");
							$data = mysqli_fetch_assoc($sql);
							$customer_name = $data['username'];
							$customer_address = $data['address_current'];


						?>
							<div class="col-lg-4">

								<div class="pos-order">
									<h3 class="pos-order-title"><?php echo $ref_id; ?></h3>
									<div class="orderdetail-pos">
										<p>
											<strong>Customer Name</strong>
											<?php echo $customer_name; ?>
										</p>
										<p>
											<strong>Address</strong>
											<?php echo $customer_address; ?>
										</p>
										<p>
											<strong>Payment Status</strong>
											Pending
										</p>
										<p>
											<strong>Total Items</strong>
											<?php echo $total_qty; ?>
										</p>
										<p>
											<strong>Amount to Pay</strong>
											Rs <?php echo $total_amount; ?>
										</p>
									</div>
									<div class="d-flex justify-content-end">
										<a href="pos.php?ref_id=<?php echo $ref_id_pending; ?>" class="ml-3" title="Edit"><i class="fas fa-edit"></i></a>
										<a href="#" class="ml-3 delete_order_pending" title="Delete" data-sale="<?php echo $ref_id_pending; ?>"><i class="fas fa-trash-alt"></i></a>
									</div>
								</div>

							</div>
						<?php } ?>
					</div>
				</div>
				<!-- <div class="modal-footer border-0">
			  <div class="row">
				  <div class="col-12">
					<a href="#" class="btn btn-primary">Submit</a>
				  </div>
			  </div>
		  </div> -->
			</div>
		</div>
	</div>


	<ul class="sticky-toolbar nav flex-column bg-primary">

		<li class="nav-item" id="kt_demo_panel_toggle" data-toggle="tooltip" title="" data-placement="right" data-original-title="Check out more demos">
			<a class="btn btn-sm btn-icon text-white" href="#">
				<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-gear fa-spin" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd" d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z"></path>
					<path fill-rule="evenodd" d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z"></path>
				</svg>
			</a>
		</li>
	</ul>
	<div id="kt_color_panel" class="offcanvas offcanvas-right kt-color-panel p-5">
		<div class="offcanvas-header d-flex align-items-center justify-content-between pb-3">
			<h4 class="font-size-h4 font-weight-bold m-0">POS Config
			</h4>
			<a href="#" class="btn btn-sm btn-icon btn-light btn-hover-primary" id="kt_color_panel_close">
				<svg width="20px" height="20px" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor"
					xmlns="http://www.w3.org/2000/svg">
					<path fill-rule="evenodd"
						d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
				</svg>
			</a>
		</div>
		<hr>
		<div class="offcanvas-content">
			<!-- Theme options starts -->
			<div id="customizer-theme-layout" class="customizer-theme-layout">

				<h5 class="mt-1">POS Layout</h5>
				<div class="theme-layout">
					<div class="d-flex justify-content-start">
						<div class="my-3">
							<div class="btn-group btn-group-toggle">
								<label class="btn btn-primary p-2 active">
									<input type="radio" name="layoutOptions" value="false" id="radio-light" checked="">
									Light
								</label>
								<label class="btn btn-primary p-2">
									<input type="radio" name="layoutOptions" value="false" id="radio-dark"> Dark
								</label>

							</div>

						</div>

					</div>
				</div>
				<hr>
				<h5 class="mt-1">RTL Layout</h5>
				<div class="rtl-layout">
					<div class="d-flex justify-content-start">
						<div class="my-3 btn-rtl">
							<div class="toggle">
								<span class="circle"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>

			<!-- Theme options starts -->
			<div id="customizer-theme-colors" class="customizer-theme-colors">
				<h5>POS Colors</h5>
				<ul class="list-inline unstyled-list d-flex">
					<li class="color-box mr-2">
						<div id="color-theme-default" class="d-flex rounded w-20px h-20px" style="background-color: #ae69f5d9;">
						</div>
					</li>
					<li class="color-box mr-2">
						<div id="color-theme-blue" class="d-flex rounded w-20px h-20px" style="background-color: blue;">
						</div>
					</li>
					<li class="color-box mr-2">
						<div id="color-theme-red" class="d-flex rounded w-20px h-20px" style="background-color: red;">
						</div>
					</li>
					<li class="color-box mr-2">
						<div id="color-theme-green" class="d-flex rounded w-20px h-20px" style="background-color: green;">
						</div>
					</li>
					<li class="color-box mr-2">
						<div id="color-theme-yellow" class="d-flex rounded w-20px h-20px" style="background-color: #ffc107;">
						</div>
					</li>
					<li class="color-box mr-2">
						<div id="color-theme-navy-blue" class="d-flex rounded w-20px h-20px" style="background-color: #000080;">
						</div>
					</li>

				</ul>
				<hr>
			</div>


		</div>
	</div>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="assets/js/script.bundle.js"></script>
	<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
	<script>
		$(":input").inputmask();
	</script>

	<script src="assets_light/bundles/libscripts.bundle.js"></script>
	<script src="assets_light/bundles/vendorscripts.bundle.js"></script>
	<link href="assets/select2/dist/css/select2.min.css" rel="stylesheet" />
	<script src="assets/select2/dist/js/select2.min.js"></script>

	<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script><!-- bootstrap datepicker Plugin Js -->
	<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>




	<script type="text/javascript">
		$('.calculate').keyup(function(e) {
			if (/\D/g.test(this.value)) {
				// Filter non-digits from input value.
				this.value = this.value.replace(/\D/g, '1');
			}
		});
	</script>
	<script type="text/javascript">
		$(document).ready(function() {
			$('#customer').select2();
			$('#table').select2();
			$('#product_search').select2();
			$('#product_search').select2('focus');
			$('#product_search').select2('open');
			var product_search_side = $('#product_search_side').val();
			$.ajax({
					method: "POST",
					url: "operations/fetch_items_side.php",
					data: {
						product_search_side: product_search_side
					},
				})
				.done(function(response) {

					$("#side_products").empty();
					$("#side_products").html(response);
				});
		});
		jQuery('#product_search_side').on('keyup', function() {
			var product_search_side = $('#product_search_side').val();
			$.ajax({
					method: "POST",
					url: "operations/fetch_items_side.php",
					data: {
						product_search_side: product_search_side
					},
				})
				.done(function(response) {

					$("#side_products").empty();
					$("#side_products").html(response);
				});
		});
	</script>
	<script type="text/javascript">
		$(document).on('keydown', function(e) {
			if (e.keyCode === 13) { //DELETE key code

				const elem = document.querySelector('.submit_form');

				if (elem === document.activeElement) {
					$("#submit_form").click();
				} else {
					e.preventDefault();
				}
			}
			if (e.keyCode === 27) { //ESC key code
				$('#total_amount_recieved').focus();
			}
			//  if ( e.keyCode === 16 ) { //SHIFT key code

			//  	$('#product_search').select2('focus');
			// 			$('#product_search').select2('open');
			//  }
			if (e.keyCode === 18) { //ESC key code
				$('#darft_products_model').click();
			}
			if (e.keyCode === 115) { //f4 key code
				window.location.replace('index.php');
			}
			if (e.keyCode === 113) { //F2 key code
				$('#keys_model').click();
			}
			if (e.keyCode === 35) { //END key code
				window.location.reload();
			}
			if (e.keyCode === 46) { //DELETE key code
				delete_order();
			}



		});
	</script>
	<script type="text/javascript">
		$("#submit_form").click(function() {
    var sale_type = $('#sale_type').val();
    var table = $('#table').val();
    var customer = $('#customer').val();
    
    // Check if customer is selected
    if(customer == '') {
        $("#select-alert").show();
        $("#select-alert").fadeTo(4000, 500).slideUp(500, function() {
            $("#select-alert").slideUp(500);
        });
        return false;
    }
    
    // Check if table is selected
    if(table == '') {
        $("#table-alert").show();
        $("#table-alert").fadeTo(4000, 500).slideUp(500, function() {
            $("#table-alert").slideUp(500);
        });
        return false;
    }
    
    // Check if at least one product is added
    var net_amount = $('#total_amount').val();
    if(net_amount == '' || net_amount <= 0 || isNaN(net_amount)) {
        $("#product-alert").show();
        $("#product-alert").fadeTo(4000, 500).slideUp(500, function() {
            $("#product-alert").slideUp(500);
        });
        return false;
    }
    
    // Existing validation for cash/credit sale
    if(sale_type == 'Cash') {
        var total_amount_recieved = $('#total_amount_recieved').val();
        var total_amount = $('#total_amount').val();
        if(Number(total_amount_recieved) < Number(total_amount)) {
            $("#customer-alert").show();
            $("#customer-alert").fadeTo(4000, 500).slideUp(500, function() {
                $("#customer-alert").slideUp(500);
            });
            return false;
        }
    } else if(sale_type == 'Credit') {
        var total_amount_recieved = $('#total_amount_recieved').val();
        if(Number(total_amount_recieved) > 0) {
            $('#total_amount_recieved').val('0');
            $("#customer-alert1").show();
            $("#customer-alert1").fadeTo(4000, 500).slideUp(500, function() {
                $("#customer-alert1").slideUp(500);
            });
            return false;
        }
    }
});
	</script>
	<script type="text/javascript">
		jQuery('.delete_order_pending').on('click', function() {
			var ref_id = $(this).attr("data-sale")

			$.ajax({
					method: "POST",
					url: "operations/delete_pending_order.php",
					data: {
						ref_id: ref_id
					},
				})
				.done(function(response) {

					$("#darft_product").empty();
					$("#darft_product").html(response);
					var count_draft = $("#count_draft").val();
					$("#draft_bills").text(count_draft);
					$('#product_search').select2('focus');
					$('#product_search').select2('open');

				});
		});
		jQuery('.edit_order_pending').on('click', function() {
			var ref_id = $(this).attr("data-sale")
			var edit_id = $("#edit_id").val();
			$.ajax({
					method: "POST",
					url: "operations/edit_pending_order.php",
					data: {
						ref_id: ref_id,
						edit_id: edit_id
					},
				})
				.done(function(response) {

					$("#products").empty();
					$("#products").html(response);
					var ref_id_edit = $("#ref_id_edit").val();
					$("#ref_id").val(ref_id_edit);
					subAmount();
					$("#close_draft").click();
					$('#product_search').select2('focus');
					$('#product_search').select2('open');

				});
		});

		function draft_order() {
			var tableProductLength = $("#product_info_table tbody tr").length;
			if (tableProductLength == '0') {
				$("#product-alert").show();

				$("#product-alert").fadeTo(4000, 500).slideUp(500, function() {
					$("#product-alert").slideUp(500);
				});
				return false;
			} else {
				location.reload();
			}
		}
	</script>
	<script type="text/javascript">
		function check_discount() {
			var customer = $("#customer").val();

			$.ajax({
					method: "POST",
					url: "check_discount.php",
					data: {
						customer: customer
					},
				})
				.done(function(response) {

					$("#fixed_discount").val(response);

				});
			get_items_edit();
		}
		get_items_edit();

		function get_items_edit() {

			var ref_id = $("#ref_id").val();
			var edit_id = $("#edit_id").val();
			var customer = $("#customer").val();
			$.ajax({
					method: "POST",
					url: "operations/edit_pending_order.php",
					data: {
						ref_id: ref_id,
						edit_id: edit_id,
						customer: customer
					},
				})
				.done(function(response) {

					$("#products").empty();
					$("#products").html(response);
					var ref_id_edit = $("#ref_id_edit").val();
					$("#ref_id").val(ref_id_edit);
					subAmount();
					$('#product_search').select2('focus');
					$('#product_search').select2('open');


				});
		}

		function add_row_side(item_id1, barcode1, pur_item_id1, sale_rate1, item_serial1) {



			if (isNaN(item_serial1)) {
				item_serial1 = '';
			}
			if (item_id1 == '') {
				return false;
			}

			var item_id1 = item_id1;



			if (item_id1 != '') {
				var itemid = item_id1;
				var barcode = barcode1;
				var item_serial = item_serial1;
				var pur_item_id = pur_item_id1;
				var sale_rate = sale_rate1;

				$.ajax({
						method: "POST",
						url: "operations/get_stock_pos.php",
						data: {
							itemid: itemid
						},
					})
					.done(function(response_stock) {

						if (response_stock != '0') {


							$("#stock").val();
							$("#stock").val(response_stock);
							add_items_from_side(itemid, barcode, pur_item_id, sale_rate, item_serial);

						} else {

							var over_selling = $("#over_selling").val();

							if (over_selling == '0') {
								$("#product-alert1").hide();

								$("#product-alert1").fadeTo(4000, 500).slideUp(500, function() {
									$("#product-alert1").slideUp(500);
								});
								return false;
							} else {
								$("#stock").val();
								$("#stock").val(response_stock);
								add_items_from_side(itemid, barcode, pur_item_id, sale_rate, item_serial);
							}

						}
					});
			}
		}


		function add_items_from_side(item_id, barcode, pur_item_id, sale_rate, item_serial) {


			var ref_id = $("#ref_id").val();
			var customer = $("#customer").val();
			var sales_men = $("#sales_men").val();

			if (item_id == '') {
				return false;
			}

			var stock = $("#stock").val();

			if (item_id != '') {

				$.ajax({
						method: "POST",
						url: "operations/add_temp_items.php",
						data: {
							item_id: item_id,
							barcode: barcode,
							item_serial: item_serial,
							pur_item_id: pur_item_id,
							sale_rate: sale_rate,
							ref_id: ref_id,
							stock: stock,
							customer: customer,
							sales_men: sales_men
						},
					})
					.done(function(response) {

						$("#products").empty();
						$("#products").html(response);
						$('#product_search').select2('focus');
						$('#product_search').select2('open');
						var stock_empty = $('#stock_empty').val();
						var over_selling = $("#over_selling").val();
						var fixed_discount = $('#fixed_discount').val();

						$('#fixed_discountt').val(fixed_discount);
						if (over_selling == '0') {
							if (stock_empty == 0) {
								$("#product-alert1").hide();

								$("#product-alert1").fadeTo(4000, 500).slideUp(500, function() {
									$("#product-alert1").slideUp(500);
								});
							}
						}
						subAmount();

					});
			}

		}

		function add_item() {
			var product_search = $('#product_search').val();

			if (product_search == '') {
				return false;
			}
			$(document).on('keydown', function(e) {
				if (e.keyCode === 13) { //Enter key code
					e.preventDefault();
				}
			});
			var over_selling = $("#over_selling").val();

			$.ajax({
					method: "POST",
					url: "operations/fetch_items.php",
					data: {
						product_search: product_search
					},
					dataType: 'json',
				})
				.done(function(response) {
					var len = response.length;

					//$("#sub_child1").empty();
					for (var i = 0; i < len; i++) {
						var item_id = response[i]['item_id'];
						var barcode = response[i]['barcode'];
						var item_serial = response[i]['item_serial'];
						var pur_item_id = response[i]['pur_item_id'];
						var sale_rate = response[i]['sale_rate'];
						var brand_name = response[i]['brand_name'];

						var item_name = response[i]['item_name'];
					}
					var stock_empty = $('#stock_empty').val();

					var fixed_discount = $('#fixed_discount').val();

					$('#fixed_discountt').val(fixed_discount);
					if (over_selling == '0') {
						check_stock(item_id, barcode, item_serial, pur_item_id, sale_rate, brand_name, item_name);
					} else {
						add_items(item_id, barcode, item_serial, pur_item_id, sale_rate)
					}

				});
		}

		function check_stock(item_id, barcode, item_serial, pur_item_id, sale_rate, brand_name, item_name) {

			var itemid = item_id;

			$.ajax({
					method: "POST",
					url: "operations/get_stock_pos.php",
					data: {
						itemid: itemid
					},
				})
				.done(function(response_stock) {

					if (response_stock != '0') {
						$("#stock").val();
						$("#stock").val(response_stock);
						add_items(item_id, barcode, item_serial, pur_item_id, sale_rate);
						e.preventDefault();
						//add_items();            
					} else {
						$("#product-alert1").hide();

						$("#product-alert1").fadeTo(4000, 500).slideUp(500, function() {
							$("#product-alert1").slideUp(500);
						});
						return false;
					}
				});
		}


		function add_items(item_id, barcode, item_serial, pur_item_id, sale_rate) {

			var ref_id = $("#ref_id").val();
			var customer = $("#customer").val();
			var sales_men = $("#sales_men").val();

			var stock = $("#stock").val();
			if (item_id != '') {

				$.ajax({
						method: "POST",
						url: "operations/add_temp_items.php",
						data: {
							item_id: item_id,
							barcode: barcode,
							item_serial: item_serial,
							pur_item_id: pur_item_id,
							sale_rate: sale_rate,
							ref_id: ref_id,
							stock: stock,
							customer: customer,
							sales_men: sales_men
						},
					})
					.done(function(response) {

						$("#products").empty();
						$("#products").html(response);
						var stock_empty = $('#stock_empty').val();

						if (stock_empty == 0) {
							$("#product-alert1").hide();

							$("#product-alert1").fadeTo(4000, 500).slideUp(500, function() {
								$("#product-alert1").slideUp(500);
							});
						}
						subAmount();
						$('#product_search').select2('focus');
						$('#product_search').select2('open');
						e.preventDefault();
						//$('.product').focus();
						//$('.select-down').select2('open');
						// $('.product').select2('destroy');

					});
			}

		}

		function getTotal(row = null, tr_id) {
			var over_selling = $("#over_selling").val();

			if (row) {

				var qty = $("#qty_" + row).val();
				var rate = $("#rate_" + row).val();
				var amount = qty * rate;
				amount = amount.toFixed(0);

				var stock_qty = $("#stock_qty_" + row).val();

				if (qty == '' || isNaN(qty) || qty == '0') {
					$("#qty_" + row).val('1');
					return false;
				} else {
					qty = $("#qty_" + row).val();
				}

				if (over_selling == '0') {

					if (Number(qty) > Number(stock_qty)) {
						alert("Quantity must be equal or less than stock qty..!");
						$("#qty_" + row).val('1');
						$("#qty_" + row).focus();
						subAmount();
						return false;
					}
				}
				var stock = stock_qty;

				var ref_id = $("#ref_id").val();
				var edit_id = $("#edit_id").val();


				$.ajax({
						method: "POST",
						url: "operations/quantity_update.php",
						data: {
							tr_id: tr_id,
							ref_id: ref_id,
							qty: qty,
							rate: rate,
							amount: amount,
							stock: stock,
							over_selling: over_selling,
							edit_id: edit_id
						},
					})
					.done(function(response) {

						$("#products").empty();
						$("#products").html(response);
						subAmount();
					});

			} else {
				alert('no row !! please refresh the page');
			}
		}

		function subAmount() {


			var tableProductLength = $("#product_info_table tbody tr").length;
			var totalSubAmount = 0;
			var totalItems = 0;
			if (tableProductLength == 0) {
				$("#sub_total").val(totalSubAmount);
				$("#total_items").val(totalItems);
				$("#total_amount").val(totalSubAmount);
				$("#after_discount").val(totalSubAmount);
				$("#after_tax").val(totalSubAmount);
			}

			for (x = 0; x < tableProductLength; x++) {

				var tr = $("#product_info_table tbody tr")[x];

				var count = $(tr).attr('id');

				count = count.substring(4);
				totalSubAmount = Number(totalSubAmount) + Number($("#amount_" + count).val());
				totalItems = Number(totalItems) + Number($("#qty_" + count).val());

			} // /for

			totalSubAmount = totalSubAmount.toFixed(0);

			// sub total
			$("#sub_total").val(totalSubAmount);
			$("#total_items").val(totalItems);
			$("#total_amount").val(totalSubAmount);
			$("#after_discount").val(totalSubAmount);
			$("#after_tax").val(totalSubAmount);
			var fixed_discount = $("#fixed_discountt").val();
			var edit_id = $("#edit_id").val();
			var sale_type = $("#sale_type").val();
			if (sale_type == 'Credit' && edit_id == '') {
				$("#total_amount_recieved").val('');
			}
			if (edit_id == '' && sale_type == 'Cash') {
				$("#total_amount_recieved").val(totalSubAmount);
			}
			if (edit_id != '') {
				$("#total_amount_recieved").val(totalSubAmount);
			}

			var total_amount_recieved = $("#total_amount_recieved").val();
			var discount = $("#discount").val();
			if (discount == '') {
				discount = 0;
				$("#discount").val('0');
			}
			if (total_amount_recieved == '') {
				total_amount_recieved = 0;
				$("#total_amount_recieved").val('0');
			}
			var tax = $("#tax").val();
			if (tax == '') {
				tax = 0;
				$("#tax").val('0');
			}

			if (fixed_discount > 0) {
				var f_dis = (Number(fixed_discount) * Number(totalSubAmount)) / 100;
				f_dis = f_dis.toFixed(0);
				var grandTotal = Number(totalSubAmount) - Number(f_dis);
				grandTotal = grandTotal.toFixed(0);
				$("#after_fdiscount").val(f_dis);
				$("#after_discount").val(grandTotal);
				$("#after_tax").val(grandTotal);
				$("#total_amount").val(grandTotal);
				if (edit_id == '' && sale_type == 'Cash') {
					$("#total_amount_recieved").val(grandTotal);
					var total_amount_recieved = $("#total_amount_recieved").val();
					var total_amount_return = Number(total_amount_recieved) - Number(grandTotal);
					total_amount_return = total_amount_return.toFixed(0);
					$("#total_amount_return").val(total_amount_return);
				}
				//  //$("#total_amount_recieved").val(grandTotal);

			}
			if (discount > 0) {
				var after_fdiscount = $("#after_fdiscount").val();

				var grandTotal = Number(totalSubAmount) - (Number(discount) + Number(after_fdiscount));
				grandTotal = grandTotal.toFixed(0);
				$("#after_discount").val(grandTotal);
				$("#after_tax").val(grandTotal);
				$("#total_amount").val(grandTotal);
				var total_amount_return = $("#total_amount_return").val();
				if (total_amount_return == '0') {
					$("#total_amount_recieved").val(grandTotal);
				}
				if (edit_id == '' && sale_type == 'Cash') {
					$("#total_amount_recieved").val(grandTotal);
					var total_amount_recieved = $("#total_amount_recieved").val();
					var total_amount_return = Number(total_amount_recieved) - Number(grandTotal);
					total_amount_return = total_amount_return.toFixed(0);
					$("#total_amount_return").val(total_amount_return);
				}
				//$("#total_amount_recieved").val(grandTotal);

			}
			if (tax > 0) {
				var after_discount = $("#after_discount").val();
				var total_tax_amount = Number(after_discount) * (Number(tax) / 100);
				var grandTotal = Number(total_tax_amount) + Number(after_discount);
				grandTotal = grandTotal.toFixed(0);
				$("#after_tax").val(grandTotal);
				$("#total_amount").val(grandTotal);
				var total_amount_return = $("#total_amount_return").val();
				if (total_amount_return == '0') {
					$("#total_amount_recieved").val(grandTotal);
				}
				if (edit_id == '' && sale_type == 'Cash') {
					$("#total_amount_recieved").val(grandTotal);
					var total_amount_recieved = $("#total_amount_recieved").val();
					var total_amount_return = Number(total_amount_recieved) - Number(grandTotal);
					total_amount_return = total_amount_return.toFixed(0);
					$("#total_amount_return").val(total_amount_return);
				}
			}
			if (total_amount_recieved > 0) {

				var total_amount_recieved = $("#total_amount_recieved").val();
				var total_amount = $("#total_amount").val();
				var total_amount_return = Number(total_amount_recieved) - Number(total_amount);
				total_amount_return = total_amount_return.toFixed(0);
				$("#total_amount_return").val(total_amount_return);
			}
			//$("#total_amount_recieved").val(grandTotal);



		}

		function subAmountReturn() {
			var total_amount_recieved = $("#total_amount_recieved").val();
			var total_amount = $("#total_amount").val();
			var total_amount_return = Number(total_amount_recieved) - Number(total_amount);
			total_amount_return = total_amount_return.toFixed(0);
			if (total_amount_return >= 0) {
				$("#total_amount_return").val(total_amount_return);
			} else {
				$("#total_amount_return").val('0');
			}
		}

		function removeRow(tr_id) {
			var ref_id = $("#ref_id").val();
			$.ajax({
					method: "POST",
					url: "operations/delete_pos.php",
					data: {
						tr_id: tr_id,
						ref_id: ref_id
					},
				})
				.done(function(response) {

					$("#products").empty();
					$("#products").html(response);
					subAmount();
					$('#product_search').select2('focus');

				});
		}

		function delete_order() {

			var ref_id = $("#ref_id").val();
			$.ajax({
					method: "POST",
					url: "operations/delete_order.php",
					data: {
						ref_id: ref_id
					},
				})
				.done(function(response) {

					$("#products").empty();
					subAmount();
					$('#product_search').select2('focus');
					$('#product_search').select2('open');
				});
		}
	</script>


</body>

</html>