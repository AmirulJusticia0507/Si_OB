<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $areaId = $_POST['area_id'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "DELETE FROM db_mobile_collection.setting_area WHERE settingarea_id = ?";
    $stmt = $connectionServernew->prepare($query);
    $stmt->bind_param("s", $areaId);
    
    // Check for errors in prepare
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    // Jalankan prepared statement
    $stmt->execute();

    // Check for errors in execute
    if ($stmt->error) {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
        exit();
    }

    // Tutup prepared statement
    $stmt->close();

    echo json_encode(array('status' => 'success'));
    echo '<script>window.location.href = "settingarea.php?page=settingarea";</script>';
    exit();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
}
?>
