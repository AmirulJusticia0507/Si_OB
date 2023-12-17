<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $area = $_POST['area'];

    // Ambil tanggal dan waktu saat ini (format waktu Indonesia)
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');

    // Query untuk insert data ke tabel setting_area
    $query = "INSERT INTO db_mobile_collection.setting_area (AREA, created_at) VALUES (?, ?)";
    
    $stmt = $connectionServernew->prepare($query);

    // Check for errors in prepare
    if (!$stmt) {
        echo '<script>alert("Error in preparing statement");</script>';
        exit();
    }

    $stmt->bind_param("ss", $area, $currentDateTime);

    if ($stmt->execute()) {
        echo '<script>alert("Data inserted successfully"); window.location.href = "settingarea.php?page=settingarea";</script>';
        exit();
    } else {
        echo '<script>alert("Error in executing statement");</script>';
    }

    $stmt->close();
    $connectionServernew->close();
}
?>
