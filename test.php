<!DOCTYPE html>
<html>
<head>
    <title>Datatables Example using PHP and MySQL</title>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.css">
</head>
<body>
    <h2 style="text-align:center;">Datatables Server-Side Example</h2>
    <table id="customersTable" class="display" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Brand</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.js" charset="utf8" type="text/javascript"></script>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#customersTable').dataTable({
            "processing": true,
            "ajax": "fetch_data.php",
            "columns": [
                {data: 'item_id'},
                {data: 'cat_name'},
                {data: 'item_name'},
                {data: 'barcode'},
                {data: 'created_date'},
                {data: 'action'}
            ]
        });
    });
    </script>
</body>
</html>