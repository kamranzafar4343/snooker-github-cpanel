<?php
include "includes/config.php";

if (isset($_POST['sale_ids'])) {
    $ids = json_decode($_POST['sale_ids'], true);
    $total = 0;

    if (!empty($ids)) {
        $safe_ids = array_map('intval', $ids);
        $in_clause = implode(',', $safe_ids);

        $query = "SELECT SUM(gross_amount) as total FROM tbl_sale WHERE sale_id IN ($in_clause)";
        $res = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($res);

        $total = $row['total'] ?? 0;

        echo json_encode([
            'status' => 'success',
            'total_amount' => $total
        ]);
        exit;
    }
}

echo json_encode(['status' => 'error']);
