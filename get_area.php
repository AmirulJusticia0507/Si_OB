<?php
include 'koneksibaru.php';

// Buat query untuk mendapatkan data "Area" beserta ID-nya
$query = "SELECT settingarea_id, AREA FROM db_mobile_collection.setting_area";
$result = $connectionServernew->query($query);

// Mengirim data sebagai response JSON
$areaOptions = array();
while ($row = $result->fetch_assoc()) {
    $areaOptions[] = array('id' => $row['settingarea_id'], 'area' => $row['AREA']);
}

// Tutup koneksi setelah selesai menggunakan
$connectionServernew->close();

// Mengirim data sebagai response JSON
echo json_encode($areaOptions);
?>
