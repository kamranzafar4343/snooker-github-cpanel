<?php
error_reporting(0);
include "includes/config.php";
include "includes/session.php";
$sql = mysqli_query($conn, "SELECT * FROM tbl_company ");
$data = mysqli_fetch_assoc($sql);
$c_name = $data['c_name'];
$c_address = $data['c_address'];
$c_phone = $data['c_phone'];
$c_mobile = $data['c_mobile'];
$c_email = $data['c_email'];
$image = $data['user_profile'];

$sql_user = mysqli_query($conn, "SELECT * FROM users where user_id='$userid'");
$data = mysqli_fetch_assoc($sql_user);
$user_name = $data['user_name'];
if (isset($_GET['sale_id'])) {

    $sale_id = mysqli_real_escape_string($conn, $_GET['sale_id']);
    $sql = mysqli_query($conn, "SELECT * FROM tbl_sale_detail where sale_id=$sale_id");

    $data_d = mysqli_fetch_assoc($sql);
    $invoice_no = $data_d['invoice_no'];
    $sql = mysqli_query($conn, "SELECT * FROM tbl_sale where sale_id=$sale_id");

    $data = mysqli_fetch_assoc($sql);
    $customer_name = $data['customer_name'];
    $customer_by = $data['created_by'];
    $table_id = $data['table_id'];

    $sql1 = mysqli_query($conn, "SELECT * FROM tbl_customer where customer_id=$customer_name");
    $data1 = mysqli_fetch_assoc($sql1);
    $customername = $data1['username'];
    $client_cnic = $data1['client_cnic'];


    $query = mysqli_query($conn, "SELECT user_name,created_by FROM users where user_id=$created_by");

    $zdata = mysqli_fetch_assoc($query);
    $user_name = $zdata['user_name'];

    $created = $zdata['created_by'];

    $query2 = mysqli_query($conn, "SELECT user_name FROM users where user_id=$created");

    $zdata1 = mysqli_fetch_assoc($query2);
    $branch_name = $zdata1['user_name'];
    $query3 = mysqli_query($conn, "SELECT user_name FROM users where user_id=$customer_by");

    $zdata1 = mysqli_fetch_assoc($query3);
    $customer_from = $zdata1['user_name'];
    $query4 = mysqli_query($conn, "SELECT table_name FROM tbl_tables where table_id=$table_id");

    $zdata2 = mysqli_fetch_assoc($query4);
    $table_name = $zdata2['table_name'];
}
$sql_date = mysqli_query($conn, "SELECT created_date from tbl_sale where sale_id='$sale_id'");
$value2 = mysqli_fetch_assoc($sql_date);
$created_date = $value2['created_date'];
$month = date("F", strtotime($created_date));
$day = date("d", strtotime($created_date));
$year = date("Y", strtotime($created_date));
$hour = date("H", strtotime($created_date));
$min = date("i", strtotime($created_date));
$a = date("a", strtotime($created_date));



?>



<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
            <!doctype html>
            <html>

            <head>
                <meta charset="utf-8">
                <title>KOT</title>
                <base href="#" />
                <meta http-equiv="cache-control" content="max-age=0" />
                <meta http-equiv="cache-control" content="no-cache" />
                <meta http-equiv="expires" content="0" />
                <meta http-equiv="pragma" content="no-cache" />
                <link rel="icon" href="<?php echo $image; ?>" type="image/x-icon">
                <link href="assets/dist/styles.css" rel="stylesheet" type="text/css" />
                <style type="text/css" media="all">
                    @media print {
                        .page-break {
                            display: block;
                            page-break-before: always;
                        }

                        .buttons-cash {
                            display: none;
                        }

                        .logo {
                            display: none;
                        }
                    }

                    body {
                        color: #000;
                    }

                    .logo {
                        max-width: 100%;
                        height: auto;
                        display: block;
                    }

                    .btn {
                        margin-bottom: 5px;
                    }

                    .table {
                        border-radius: 3px;
                    }

                    .table th {
                        background: #f5f5f5;
                    }

                    .table th,
                    .table td {
                        vertical-align: middle !important;
                    }

                    h3 {
                        margin: 4px 0;
                    }

                    @media print {
                        .no-print {
                            display: none;
                        }

                        #wrapper {
                            max-width: 680px;
                            width: 100%;
                            min-width: 250px;
                            margin: 0 auto;
                        }

                        table {

                        border-collapse: collapse;
                    }

                    /*tr {
 border-bottom:solid #000 !important;
}*/

                    th,
                    td {
                        padding: 6px;
                        text-align: left;

                    }
                    }

                    table {
                        border-collapse: collapse;

                    }

                    tr {}

                    th,
                    td {
                        padding: 6px;
                        text-align: left;

                    }
                </style>
            </head>

            <body>

                <!-- Move shortcut hint outside wrapper and make it more prominent -->
                <!-- <div class="no-print" style="position: fixed; left: 250px; top: 40px;">
                    <div style="background: #f8f9fa; 
                                 border: 2px solid #28a745; 
                                 padding: 10px 15px; 
                                 border-radius: 8px;
                                 box-shadow: 0 2px 5px rgba(0,0,0,0.1);
                                 animation: pulse 2s infinite;">
                        <span style="font-size: 16px; color: #333;">
                            <i class="fa fa-keyboard-o" style="margin-right: 5px;"></i>
                            Press <strong style="color: #28a745">Enter</strong> to Print
                        </span>
                    </div>
                </div>
                <div class="no-print" style="position: fixed; left: 250px; top: 108px;">
                    <div style="background: #ffe6e6; /* light pink */
                 border: 2px solid #ff4d4d; /* bright red border */
                 padding: 10px 15px; 
                 border-radius: 8px;
                 box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                 animation: pulse 2s infinite;">
                        <span style="font-size: 16px; color: #333;">
                            <i class="fa fa-keyboard-o" style="margin-right: 5px;"></i>
                            Press <strong style="color: #ff1a1a;">Backspace</strong> to go back
                        </span>
                    </div>
                </div> -->
                <!-- Add animation keyframes -->
                <style>
                    @keyframes pulse {
                        0% {
                            transform: scale(1);
                        }

                        50% {
                            transform: scale(1.05);
                        }

                        100% {
                            transform: scale(1);
                        }
                    }
                </style>

                <div id="wrapper">
                    <div id="receiptData" style="width: auto; max-width: 480px; min-width: 150px; margin: 0 auto;">
                        <div id="receipt-data">
                            <div style="margin-top: -10px;">
                                <div style="text-align: center; margin-bottom: 15px;">
                                    <h1 style="font-size: 32px; margin: 10px 0; font-weight: bold; border-bottom: 2px solid #000; padding-bottom: 10px;">
                                        KOT
                                    </h1>
                                </div>

                                <div style="background-color: #f8f8f8; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #ddd;">
                                    <div style="display: flex; justify-content: space-between; margin-bottom: 10px;">
                                        <div style="font-size: 24px; font-weight: bold;">
                                            <span style="color: #000;"><?php echo date('g:i A ', strtotime($created_date)); ?></span>
                                        </div>
                                        <div style="font-size: 20px; font-weight: bold;">
                                            <span style="color: #000;"><?php echo $table_name; ?></span>
                                        </div>
                                    </div>
                                    <div style="display: flex; justify-content: space-between;">
                                        <div style="font-size: 24px; font-weight: bold;">
                                            <span style="color: #000;"><?php echo $month . " " . $day . ", " . $year ?></span>
                                        </div>
                                        <div style="font-size: 20px; font-weight: bold;">
                                            <span style="color: #000;"><?php echo $invoice_no; ?></span>
                                        </div>
                                    </div>
                                </div>

                                <table class="table" style="width: 100%; border: 2px solid #000; border-radius: 8px; overflow: hidden;">
                                    <thead>
                                        <tr style="background-color: #333; color: black;">
                                            <th style="padding: 12px; border-bottom: 2px solid #000; width: 15%; font-size: 18px;">QTY</th>
                                            <th style="padding: 12px; border-bottom: 2px solid #000; width: 55%; font-size: 18px;">ITEM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql_detail = mysqli_query($conn, "SELECT * FROM tbl_sale_detail where sale_id='$sale_id'");
                                        while ($detail_data = mysqli_fetch_assoc($sql_detail)) {
                                            $item_id = $detail_data['product'];
                                            $qty = $detail_data['qty'];

                                            $sql2 = mysqli_query($conn, "SELECT item_name, brand_id from tbl_items where item_id='$item_id'");
                                            $value2 = mysqli_fetch_assoc($sql2);
                                            $item_name = $value2['item_name'];
                                            $brand_id = $value2['brand_id'];

                                            $sql3 = mysqli_query($conn, "SELECT cat_name from tbl_catagory where id='$brand_id'");
                                            $value3 = mysqli_fetch_assoc($sql3);
                                            $brand_name = $value3['cat_name'];
                                        ?>
                                            <tr style="border-bottom: 1px solid #ddd;">
                                                <td style="padding: 12px; font-size: 20px; text-align: center;"><strong><?php echo $qty; ?></strong></td>
                                                <td style="padding: 12px; font-size: 20px; text-align: center;"><?php echo $item_name; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                                <div style="margin-top: 20px; text-align: right; padding: 10px; background-color: #f8f8f8; border-radius: 5px;">
                                    <p style="font-size: 18px; margin: 0; text-align:center">
                                        <strong>Server:</strong>
                                        <span style="color: #333; text-align: center;"><?php echo $customer_from; ?></span>
                                    </p>
                                </div>

                                <div id="buttons" style="padding-top:20px;" class="no-print">
                                    <hr style="border-top: 1px dashed #ccc;">
                                    <span class="col-xs-12">
                                        <a class="btn btn-block btn-primary" style="margin-bottom: 15px; font-size: 18px; padding: 10px;" href="#" onclick="window.print();">Print</a>
                                        <a class="btn btn-block btn-danger" style="font-size: 18px; padding: 10px;" href="pos.php?dinein_items=1">Cancel</a>
                                    </span>
                                    <div style="clear:both;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </body>

            <script type="text/javascript">
   window.print();
  onafterprint = function () {
               window.location.href = "pos.php?dinein_items=1";
            }
</script>

            </html>