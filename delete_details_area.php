<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $detailsareaId = $_POST['settingdetailsarea_id'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "DELETE FROM db_mobile_collection.settingdetails_area WHERE settingdetailsarea_id = ?";
    $stmt = $connectionServernew->prepare($query);
    $stmt->bind_param("s", $detailsareaId);

    // Jalankan prepared statement
    $stmt->execute();

    // Periksa apakah penghapusan berhasil
    if ($stmt->affected_rows > 0) {
        echo json_encode(array('status' => 'success'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to delete. ' . $stmt->error));
    }

    // Tutup prepared statement
    $stmt->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
}
?>
