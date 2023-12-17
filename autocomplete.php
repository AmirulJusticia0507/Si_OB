<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $_POST['query'];

    // Query untuk mengambil data dari tabel setting_area
    $querySettingArea = "SELECT settingarea_id, AREA FROM db_mobile_collection.setting_area WHERE AREA LIKE ?";
    $stmt = $connectionServernew->prepare($querySettingArea);
    
    // Check for errors in prepare
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    $queryParam = '%' . $query . '%';
    $stmt->bind_param('s', $queryParam);
    $stmt->execute();
    
    // Check for errors in execute
    if ($stmt->error) {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
        exit();
    }

    $result = $stmt->get_result();

    // Mengambil hasil sebagai array
    $areas = array();
    while ($row = $result->fetch_assoc()) {
        $areas[] = array(
            'label' => $row['AREA'],         // Nama area yang ditampilkan dalam autocompletion
            'value' => $row['settingarea_id'] // Nilai yang disimpan pada input saat dipilih
        );
    }

    $stmt->close();

    // Mengembalikan hasil sebagai JSON
    echo json_encode($areas);
}
?>
