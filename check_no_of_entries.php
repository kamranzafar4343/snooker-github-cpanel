<?php

include "includes/config.php";
include "includes/session.php";

$invoice_numbers = [
    'S6741439743',
    'S9716636119',
    'S4968191580',
    'S8767074495',
    'S2097682788',
    'S9542300892',
    'S8409414451',
    'S7855515122',
    'S1609114728',
    'S3719525045',
    'S3803343773',
    'S8477576091',
    'S9405659277',
    'S2053860675',
    'S1603201650',
    'S6752623961',
    'S5942387995',
    'S2898250732',
    'S6120939601',
    'S8840829628',
    'S7811661069',
    'S9335034445',
    'S1899164281',
    'S4712468862',
    'S1892689202',
    'S6458373886',
    'S6664333897',
    'S7849624847',
    'S2536588408',
    'S4332649922',
    'S3556409535',
    'S4217840050',
    'S4002646371',
    'S5882692694',
    'S4756683656',
    'S6704654414',
    'S5669297689',
    'S5251609530',
    'S1107574784',
    'S4098642333',
    'S1830656387',
    'S2616379477',
    'S5921844939',
    'S4759525894',
    'S8493244030',
    'S2992238506',
    'S6679161393',
    'S5106474257',
    'S3264428659',
    'S9259847685',
    'S9190762611',
    'S5062374993',
    'S9747729376',
    'S9233478554',
    'S3928971268',
    'S6986483773',
    'S6998910865',
    'S6864760372',
    'S6157170537',
    'S1680165098',
    'S5860031617',
    'S6389940560',
    'S4263220854',
    'S9110401224',
    'S5475029863',
    'S6114069839',
    'S4469830274',
    'S3357684197',
    'S5795283515',
    'S4118198636',
    'S6820354299',
    'S3680334137',
    'S6157714489',
    'S8803030798',
    'S3484756158',
    'S1237344897',
    'S2229103538',
    'S7507930300',
    'S1695271292',
    'S9479672720',
    'S3241289159',
    'S7430330555',
    'S9976633411',
    'S9311834777',
    'S4127511993',
    'S6822078596',
    'S6119075418',
    'S2822504106',
    'S9357329477',
    'S2904540328',
    'S9346730909',
    'S7470161887',
    'S4238143923',
    'S5495903700',
    'S6652886532',
    'S4837950339',
    'S5104903589',
    'S4589804020',
    'S9880173208',
    'S8412281968',
    'S6991319423',
    'S7521278313',
    'S7203807431',
    'S9576037694',
    'S6251708603',
    'S7153244241',
    'S3106339703',
    'S4186580994',
    'S5664763194'
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