<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $settingarea_id = $_POST['settingarea_id'];
    $area = $_POST['area'];

    // Query untuk update data ke tabel setting_area
    $query = "UPDATE db_mobile_collection.setting_area SET AREA=? WHERE settingarea_id=?";
    
    $stmt = $connectionServernew->prepare($query);
    $stmt->bind_param("si", $area, $settingarea_id);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success'));
        echo '<script>window.location.href = "settingarea.php?page=settingarea";</script>';
        exit();
    } else {
        echo json_encode(array('status' => 'error'));
    }

    $stmt->close();
    $connectionServernew->close();
}
?>
