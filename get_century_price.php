<?php
include "includes/config.php";

// fetch records
$sql = "SELECT id, name, price FROM century;";
$result = mysqli_query($conn, $sql);
$count = 0;
if (mysqli_num_rows($result) > 0) {

    while ($data = mysqli_fetch_assoc($result)) {
        $count++;
        $id = $data['id'];
        $name = $data['name'];
        $price = $data['price'];

        $view = '<a href="edit_century.php?id=' . $id . '"><button class="btn btn-sm btn-primary ">Edit</button></a>';

        $action = $view;



        $array[] = array(
            "count" => $count,
            "id" => $id,
            "name" => $name,
            "price" => $price,
            "action" => $action
        );
        // $array[] = $row;
    }
} else {
    $array[] = array(
        "count" => '',
        "id" => '',
        "name" => '',
        "price" => '',
        "action" => ''
    );
}
$dataset = array(
    "echo" => 1,
    "totalrecords" => count($array),
    "totaldisplayrecords" => count($array),
    "data" => $array
);

echo json_encode($dataset);
