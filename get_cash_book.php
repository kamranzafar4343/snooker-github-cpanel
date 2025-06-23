<?php
include "includes/config.php";

// fetch records
$sql = "SELECT * FROM cash_book ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
$count = 0;
$array = array(); // Initialize array before the if condition

if (mysqli_num_rows($result) > 0) {
    while ($data = mysqli_fetch_assoc($result)) {
        $count++;

        // Store the data row to prevent overwriting in the user query
        $cash_data = $data;

        // Get user nameP
        $created_by = $cash_data['created_by'];

        $type = $cash_data['type'];

        $sql5 = mysqli_query($conn, "SELECT user_name FROM users WHERE user_id='$created_by'");
        $user_data = mysqli_fetch_assoc($sql5);
        $user_name = $user_data['user_name'] ?? 'Unknown';

        // Format amounts for display
        $c_amount = number_format($cash_data['c_amount'], 0);
        $d_amount = number_format($cash_data['d_amount'], 0);

        // Initialize running_total if not set
        if (!isset($running_total)) {
            $running_total = 0;
        }
        // Running sum of total_amount
        $running_total += $cash_data['total_amount'];
        $total_amount = number_format($running_total, 0);

        // Create edit button with direct link
        $edit = '<a href="edit_cash_book.php?edit_id=' . $cash_data['id'] . '"><button class="btn btn-sm btn-info" style="position:relative; right: -10px; padding: 3px;">Edit</button></a>';
        $c_amount_and_edit = $c_amount . " " . $edit;

        $created_at = $cash_data['created_at']; // Assuming it's already in PKT

        // Convert to DateTime object
        $date = new DateTime($created_at);

        // Format the date
        $formatted_date = $date->format('d-m-Y H:i:s'); 

        $array[] = array(
            "count" => $count,
            "created_at" => $formatted_date,
            "type" => $type,
            "d_amount" => $d_amount,
            "c_amount" => $c_amount_and_edit,
            "total_amount" => $total_amount,
            "created_by" => $user_name,
            "remarks" => $cash_data['remarks'],
        );
    }
}

$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
