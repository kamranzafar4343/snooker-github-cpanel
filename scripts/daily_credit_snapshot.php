<?php


file_put_contents(__DIR__ . "/cron_log.txt", "Cron ran at: " . date('Y-m-d H:i:s') . "\n", FILE_APPEND);

// Create a new MySQLi connection
$host = "localhost";
$user = "admin_2alitownsnooker";
$password = "*SdC.m*vW%Uj";
$database = "admin_2alitownsnooker";

$conn = new mysqli($host, $user, $password, $database);

// Check for connection errors
if ($conn->connect_error) {
    file_put_contents(__DIR__ . "/cron_log.txt", "Connection failed: " . $conn->connect_error . "\n", FILE_APPEND);
    exit("DB connection failed");
}

    // Calculate today's total credit sales
    $sql_credit = mysqli_query($conn, "SELECT SUM(net_amount) as credit_total
        FROM tbl_sale
        WHERE DATE(created_date) = CURDATE()
        AND sale_type = 'Credit'");

    $data1 = mysqli_fetch_assoc($sql_credit);
    $credit_total = $data1['credit_total'] ?? 0;

    // Insert snapshot
    $query = mysqli_query($conn, "INSERT INTO daily_credit_totals (credit_total)
        VALUES ('$credit_total')");

if ($query) {
    file_put_contents(__DIR__ . "/cron_log.txt", "[" . date('Y-m-d H:i:s') . "] Inserted successfully: $credit_total\n", FILE_APPEND);
} else {
    file_put_contents(__DIR__ . "/cron_log.txt", "Insert error: " . $conn->error . "\n", FILE_APPEND);
}

$conn->close();