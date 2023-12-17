<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_POST['id'];
    $isActive = $_POST['active'];

    // Update status tugas di database
    $query = "UPDATE db_mobile_collection.tasks SET active='$isActive' WHERE id='$taskId'";
    $result = $connectionServernew->query($query);

    if ($result) {
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error'));
    }
}
?>
