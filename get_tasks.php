<?php
include 'koneksibaru.php';

$query = "SELECT * FROM db_mobile_collection.tasks";
$result = $connectionServernew->query($query);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode(array('data' => $data));
?>
