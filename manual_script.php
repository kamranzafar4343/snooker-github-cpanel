
<?php

include "includes/config.php";
include "includes/session.php";

$invoice_numbers = [
   'S6609714310', 'S7500316586', 'S6025043716', 'S7341920268', 'S2401779058', 'S6362954757', 'S7103321368', 'S1077885541', 'S4689976625', 'S1693331935', 'S6282251156', 'S7862434506', 'S5458699258'
];


// Prepare statement
$sql = "SELECT COUNT(*) as total_entries FROM tbl_trans_detail WHERE invoice_no = ?";
$stmt = $conn->prepare($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice Line Count</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Invoice Line Entries Count</h2>
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Invoice No</th>
                <th>No. of Line Entries</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($invoice_numbers as $invoice_no) {
                $stmt->bind_param("s", $invoice_no);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $count = $row['total_entries'];
                echo "<tr>
                        <td>{$invoice_no}</td>
                        <td>{$count}</td>
                    </tr>";
            }
            $stmt->close();
            $conn->close();
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
