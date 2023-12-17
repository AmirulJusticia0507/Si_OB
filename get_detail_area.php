<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['area_id'])) {
    $areaId = $_GET['area_id'];

    // Query untuk mendapatkan detail area berdasarkan area_id yang dipilih
    $query = "SELECT settingdetailsarea_id, details_area FROM db_mobile_collection.settingdetails_area WHERE area_id = ?";
    $stmt = $connectionServernew->prepare($query);
    $stmt->bind_param('s', $areaId);
    $stmt->execute();
    $result = $stmt->get_result();
    $detailsAreas = $result->fetch_all(MYSQLI_ASSOC);
    $stmt->close();

    // Mengembalikan hasil sebagai JSON
    echo json_encode($detailsAreas);
}
?>
