<?php
error_reporting(0);
session_start();
include "includes/session.php";
include "includes/config.php";


if (!isset($_SESSION['adminid'])) {
    header('Location: login.php');
    exit;
}

function getAccountName($acode, $conn)
{
    $query = mysqli_query($conn, "SELECT aname FROM tbl_account WHERE acode = '$acode'");
    if ($row = mysqli_fetch_assoc($query)) {
        return $row['aname'];
    }
    $query2 = mysqli_query($conn, "SELECT aname FROM tbl_account_lv2 WHERE acode = '$acode'");
    if ($row = mysqli_fetch_assoc($query2)) {
        return $row['aname'];
    }
    return 'Unknown';
}

$transactions = [];

if (isset($_GET['voucher_id'])) {
    $voucher_id = mysqli_real_escape_string($conn, $_GET['voucher_id']);
    $payment_sql = mysqli_query($conn, "SELECT * FROM tbl_payment WHERE id = '$voucher_id'");
    $payment_data = mysqli_fetch_assoc($payment_sql);

    $invoice_no = $payment_data['payment_type'] . "_" . $payment_data['id'];
    $payment_type = $payment_data['payment_type'];
    $payment_date = $payment_data['payment_date'];

    $result = mysqli_query($conn, "SELECT * FROM tbl_trans_detail WHERE invoice_no = '$invoice_no'");
    $merged = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $trans_id = $row['trans_id'];
        $acode = $row['acode'];
        $amount = max($row['d_amount'], $row['c_amount']);

        if (!isset($merged[$trans_id])) {
            $merged[$trans_id] = [
                'trans_id' => $trans_id,
                'narration' => $row['narration'],
                'payment_type' => $payment_type,
                'debit_account' => '',
                'credit_account' => '',
                'date' => $payment_date,
                'amount' => $amount
            ];
        }

        if ($row['d_amount'] > 0) {
            $merged[$trans_id]['debit_account'] = getAccountName($acode, $conn);
        } elseif ($row['c_amount'] > 0) {
            $merged[$trans_id]['credit_account'] = getAccountName($acode, $conn);
        }
    }

    $transactions = array_values($merged); // Re-index for output
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Transaction Details</title>
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <style>
        @media print {
            .d-print-none {
                display: none !important;
            }
        }

        .table th,
        .table td {
            vertical-align: middle !important;
            padding: 12px 8px;
        }

        .card {
            background-color: #ffffff;
        }

        .table-striped>tbody>tr:nth-of-type(odd) {
            background-color: #f9f9f9;
        }
    </style>

</head>

<body style="background-color: #f4f6f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <div class="container mt-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Transaction Details - <span class="fw-light">Invoice #<?= $invoice_no ?></span></h4>
                <div class="d-print-none">
                    <button class="btn btn-light btn-sm" onclick="window.print();">
                        🖨️ Print
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="window.location.href='add_payment.php'">
                        ⬅️ Go Back
                    </button>
                </div>
            </div>
            <div class="card-body p-4">
                <table class="table table-bordered table-hover table-striped align-middle shadow-sm">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Trans ID</th>
                            <th>Narration</th>
                            <th>Payment Type</th>
                            <th>Debit Account</th>
                            <th>Credit Account</th>
                            <th>Date</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_amount = 0;
                        foreach ($transactions as $t) {
                            echo "<tr>
                                <td class='text-center'>{$t['trans_id']}</td>
                                <td>{$t['narration']}</td>
                                <td>{$t['payment_type']}</td>
                                <td>{$t['debit_account']}</td>
                                <td>{$t['credit_account']}</td>
                                <td>{$t['date']}</td>
                                <td class='text-end fw-bold'>" . number_format($t['amount'], 2) . "</td>
                            </tr>";
                            $total_amount += $t['amount'];
                        }


                        ?>
                        <tr class="table-info fw-bold">
                            <td colspan="6" class="text-end">Total</td>
                            <td class="text-end" style="font-size: 23px;"><?php

                                                                            if ($payment_type == 'JV') {
                                                                                $total_amount = $total_amount / 2;
                                                                                echo $total_amount;
                                                                            } else {
                                                                                number_format($total_amount, 2);
                                                                                echo $total_amount;
                                                                            }

                                                                            ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

<script>
    document.addEventListener('keydown', function(event) {
        switch (event.key) {
            case 'Enter':
                window.print();
                break;
            case 'Backspace':
                event.preventDefault(); // Prevent the default backspace action
                window.location.href = 'add_payment.php';
                break;
        }
    });
</script>

</html>