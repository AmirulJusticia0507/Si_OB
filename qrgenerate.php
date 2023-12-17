<?php
include "qrlib.php"; // Memasukkan library phpqrcode

// Mengambil data dari SQL
$query = "SELECT t.id, t.area_id, t.detail_area_id, t.job_name, t.job_task, t.create_at,
       sa.AREA AS setting_area, sda.details_area AS setting_details_area
FROM db_mobile_collection.tasks t
LEFT JOIN db_mobile_collection.setting_area sa ON t.area_id = sa.settingarea_id
LEFT JOIN db_mobile_collection.settingdetails_area sda ON t.detail_area_id = sda.settingdetailsarea_id";

// Eksekusi query
$result = $connectionServernew->query($query);

// Membuat array untuk menyimpan data SQL
$dataArray = array();

while ($row = $result->fetch_assoc()) {
    // Menambahkan setiap baris data ke array
    $dataArray[] = $row;
}

// Menghasilkan QR code untuk setiap baris data
foreach ($dataArray as $data) {
    // Format data sesuai kebutuhan Anda, misalnya:
    $qrData = "ID: {$data['id']}, Job Name: {$data['job_name']}, Task: {$data['job_task']}";

    // Nama file QR code yang akan disimpan (misalnya, sesuaikan dengan ID atau data unik lainnya)
    $filename = "qrcodes/{$data['id']}.png";

    // Membuat QR code dan menyimpannya sebagai file PNG
    QRcode::png($qrData, $filename);

    // Menampilkan URL gambar QR code (Anda dapat menyimpan URL ini dalam database atau memasukkannya langsung ke HTML)
    echo "QR Code for Job '{$data['job_name']}' generated: <img src='{$filename}' alt='QR Code'><br>";
}
?>
