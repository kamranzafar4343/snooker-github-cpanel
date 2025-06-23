<?php
include 'includes/config.php'; // Database connection
include 'includes/SimpleXLSX.php'; // Include SimpleXLSX library

use Shuchkin\SimpleXLSX;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["file"])) {
    if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
        die("Error: File upload failed.");
    }

    $allowedExtensions = ['xlsx'];
    $fileName = $_FILES["file"]["name"];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);

    if (!in_array(strtolower($fileExt), $allowedExtensions)) {
        die("Error: Only .xlsx files are allowed.");
    }

    // Load the spreadsheet
    if ($xlsx = SimpleXLSX::parse($_FILES["file"]["tmp_name"])) {
        $rows = $xlsx->rows();
        unset($rows[0]); // Remove header row
        $created_date = date('Y-m-d');
        $created_by = '1';

        foreach ($rows as $row) {
            $item_id = isset($row[0]) ? mysqli_real_escape_string($conn, $row[0]) : '';
            $barcode = isset($row[1]) ? mysqli_real_escape_string($conn, $row[1]) : '';
            $item_name = isset($row[2]) ? mysqli_real_escape_string($conn, $row[2]) : '';
            $brand_name = isset($row[3]) ? mysqli_real_escape_string($conn, $row[3]) : '';
            $purchase = isset($row[4]) ? mysqli_real_escape_string($conn, $row[4]) : '';
            $retail = isset($row[5]) ? mysqli_real_escape_string($conn, $row[5]) : '';
            $quantity = isset($row[6]) ? mysqli_real_escape_string($conn, $row[6]) : 0; // Reading quantity and ensuring it's an integer

            // Check if brand exists, otherwise insert
            $brand_id = null;
            if (!empty($brand_name)) {
                $stmt = mysqli_prepare($conn, "SELECT id FROM tbl_catagory WHERE cat_name = ?");
                mysqli_stmt_bind_param($stmt, "s", $brand_name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $brand_id);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                if (!$brand_id) {
                    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_catagory (cat_name, created_date, created_by) VALUES (?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "sss", $brand_name, $created_date, $created_by);
                    mysqli_stmt_execute($stmt);
                    $brand_id = mysqli_insert_id($conn);
                    mysqli_stmt_close($stmt);
                }
            }

            // Extract category from item name
            $category_id = null;
            if (!empty($item_name)) {
                $item_parts = explode(" ", $item_name);
                $category_name = array_shift($item_parts);
                $item_name = implode(" ", $item_parts);

                $stmt = mysqli_prepare($conn, "SELECT id FROM tbl_cat WHERE catagory_name = ?");
                mysqli_stmt_bind_param($stmt, "s", $category_name);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $category_id);
                mysqli_stmt_fetch($stmt);
                mysqli_stmt_close($stmt);

                if (!$category_id) {
                    $stmt = mysqli_prepare($conn, "INSERT INTO tbl_cat (catagory_name, brand_id, created_date, created_by) VALUES (?, ?, ?, ?)");
                    mysqli_stmt_bind_param($stmt, "siss", $category_name, $brand_id, $created_date, $created_by);
                    mysqli_stmt_execute($stmt);
                    $category_id = mysqli_insert_id($conn);
                    mysqli_stmt_close($stmt);
                }
            }

            // Insert new item
            $stmt = mysqli_prepare($conn, "INSERT INTO tbl_items (item_id, item_name, barcode, brand_id, category, purchase, retail, created_date, created_by) 
                                           VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($stmt, "ssiisssss", $item_id, $item_name, $barcode, $brand_id, $category_id, $purchase, $retail, $created_date, $created_by);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);

            if ($quantity > 0) {
                $amount = $purchase * $quantity;
                date_default_timezone_set("Asia/Karachi");
                $created_date = date("Y-m-d h:i:s");
                $narration = "Opening Stock($quantity) of item barcode $barcode added, Transaction Date was $created_date";
                $v_type = 'SP';
                $invoice_no = 'Opening_stock#' . $item_id;
                $stock_acode = '100300100';
                $net_amount = $purchase * $quantity;

                // Update tbl_items (prepared statement)
                $stmt_update_item = $conn->prepare("UPDATE tbl_items SET purchase = ?, retail = ? WHERE item_id = ?");
                $stmt_update_item->bind_param("dds", $purchase, $retail, $item_id);
                $stmt_update_item->execute();

                // Insert into tbl_purchase
                $stmt_purchase = $conn->prepare("INSERT INTO tbl_purchase(location, iemi, vendor_id, invoice_no, invoice_date, po_remarks, net_amount, gross_amount, discount, bill_status, payment_status, created_by, parent_id) VALUES ('1', '0', ?, ?, ?, '', ?, ?, '0', 'Completed', 'Completed', '1', '1')");
                $stmt_purchase->bind_param("sssdd", $stock_acode, $invoice_no, $created_date, $net_amount, $net_amount);
                $stmt_purchase->execute();

                // Insert into tbl_purchase_detail
                $stmt_detail = $conn->prepare("INSERT INTO tbl_purchase_detail (purchase_id, invoice_no, product, item_serial, pur_item_id, barcode, qty_rec, qty, rate, sale_rate, amount, created_date, created_by, parent_id, iemi) VALUES ('1', ?, ?, '', '1001', ?, ?, ?, ?, ?, ?, ?, '1', '1', '0')");
                $stmt_detail->bind_param("sssdddsss", $invoice_no, $item_id, $barcode, $quantity, $quantity, $purchase, $retail, $amount, $created_date);
                $stmt_detail->execute();

                // Insert transaction and transaction details
                $stmt_trans = $conn->prepare("INSERT INTO tbl_trans(vendor_id, invoice_no, narration, total_amount, v_type, bill_status, created_date, created_by, parent_id) VALUES (?, ?, ?, ?, ?, 'Completed', ?, '1', '1')");
                $stmt_trans->bind_param("sssdss", $stock_acode, $invoice_no, $narration, $net_amount, $v_type, $created_date);
                $stmt_trans->execute();
                $tran_id = $conn->insert_id;

                $stmt_trans_detail = $conn->prepare("INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES (?, ?, ?, ?, '0.00', 'Completed', ?, ?, '1', '1')");
                $stmt_trans_detail->bind_param("isssss", $tran_id, $invoice_no, $stock_acode, $net_amount, $narration, $created_date);
                $stmt_trans_detail->execute();

                $stmt_trans_credit = $conn->prepare("INSERT INTO tbl_trans_detail (trans_id, invoice_no, acode, d_amount, c_amount, bill_status, narration, created_date, created_by, parent_id) VALUES (?, ?, ?, '0.00', ?, 'Completed', ?, ?, '1', '1')");
                $stmt_trans_credit->bind_param("isssss", $tran_id, $invoice_no, $stock_acode, $net_amount, $narration, $created_date);
                $stmt_trans_credit->execute();
            }
        }

        echo "<script>alert('File uploaded successfully!'); window.location.href='item_list.php';</script>";
    } else {
        die("Error: Failed to parse the file.");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Excel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            background-color: #f4f7f9;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .card {
            width: 50%;
            padding: 30px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            background-color: white;
        }

        .card h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 17px;
        }

        .description {
            text-align: center;
            color: #6c757d;
            margin-bottom: 23px;
            font-size: 17px;
        }

        .btn-upload {
            background-color: #007bff;
            border: none;
            padding: 10px;
            font-size: 16px;
            margin-top: 10px;
        }

        .btn-upload:hover {
            background-color: #0056b3;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <h1 style="">Upload Excel File</h1>
            <p class="description" style="font-size: 17px;">Upload an Excel file (.xlsx) to import data into the system.</p>

            <form action="item_import.php" method="post" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="file" class="form-label">Choose File</label>
                    <input class="form-control" type="file" id="file" name="file" accept=".xlsx, .xls" required>
                </div>
                <button class="btn btn-upload w-100" type="submit" style="margin-left:150px; color: #f4f7f9; font-size: 20px; max-width :50%; font-weight:700">Upload File</button>
            </form>
        </div>
        <p class="footer-text">Supported formats: .xlsx</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>