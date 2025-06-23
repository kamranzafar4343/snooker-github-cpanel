<?php
include "../includes/config.php";
include "../includes/session.php";

if (isset($_POST['record_cash_entry'])) {
    $cash_amount = mysqli_real_escape_string($conn, $_POST['cash_amount']);
    $bank_amount = mysqli_real_escape_string($conn, $_POST['bank_amount']);
    $created_by = mysqli_real_escape_string($conn, $_POST['created_by']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
    $date = date('Y-m-d H:i:s'); // Get current date and time
    if ($cash_amount == '') {
        $cash_amount = 0;
    }
    if ($bank_amount == '') {
        $bank_amount = 0;
    }

    if ($cash_amount > 0 || $bank_amount > 0) {

        // Insert into cash_book
        $sql = mysqli_query($conn, "INSERT INTO cash_book(total_amount, remarks, created_by,type, d_amount, created_at) VALUES('$cash_amount', '$remarks', '$created_by','cash','$cash_amount', '$date')");
        $sql2 = mysqli_query($conn, "INSERT INTO cash_book(total_amount, remarks, created_by,type, d_amount, created_at) VALUES('$bank_amount', '$remarks', '$created_by','bank','$bank_amount', '$date')");

        if ($sql && $sql2) {
            header('Location: ../cash_book.php?add=successfull');
        } else {
            header('Location: ../cash_book.php?add=unsuccessful');
        }
    } else {
        header('Location: ../index.php');
    }
}
