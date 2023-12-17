<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $area_id = isset($_POST['area_id']) ? $_POST['area_id'] : null;
    $details_area = isset($_POST['details_area']) ? $_POST['details_area'] : '';

    // Validate and sanitize input if necessary

    // Ambil tanggal dan waktu saat ini (format waktu Indonesia)
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');

    // Query untuk insert data ke tabel settingdetails_area
    $query = "INSERT INTO db_mobile_collection.settingdetails_area (area_id, details_area, created_at) VALUES (?, ?, ?)";
    
    $stmt = $connectionServernew->prepare($query);

    // Check for errors in prepare
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    $stmt->bind_param("iss", $area_id, $details_area, $currentDateTime);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success'));
        echo '<script>window.location.href = "settingdetailsarea.php?page=settingdetailsarea";</script>';
        exit();
    } else {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
    }

    $stmt->close();
    $connectionServernew->close();
}
?>
