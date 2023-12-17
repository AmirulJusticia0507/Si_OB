<?php
include 'koneksibaru.php';

// Ambil data dari formulir
$barcodeResult = $_POST['barcodeResult'];
$selectedActions = $_POST['actions'];

// Fungsi untuk mendapatkan informasi perangkat dari cookie
function getDeviceInformation() {
    $deviceInfo = isset($_COOKIE['device_info']) ? json_decode($_COOKIE['device_info'], true) : null;
    return $deviceInfo;
}

// Proses penyimpanan data ke database
if (!empty($barcodeResult) && !empty($selectedActions)) {
    // Dapatkan informasi perangkat
    $deviceInfo = getDeviceInformation();
    $deviceName = $deviceInfo['device_name'];
    $deviceType = $deviceInfo['device_type'];

    // Inisialisasi array untuk menyimpan nama file
    $fileNames = array();

    // Loop untuk setiap tindakan
    foreach ($selectedActions as $action) {
        $action = str_replace(" ", "_", $action); // Ganti spasi dengan underscore pada nama tindakan
        $beforeFileKey = "{$action}_before";
        $afterFileKey = "{$action}_after";

        // Periksa apakah file "before" dan "after" ada dalam $_FILES
        if (isset($_FILES[$beforeFileKey]) && isset($_FILES[$afterFileKey])) {
            // Dapatkan nama file
            $beforeFileName = $_FILES[$beforeFileKey]['name'];
            $afterFileName = $_FILES[$afterFileKey]['name'];

            // Tambahkan nama file ke dalam array
            $fileNames[$beforeFileKey] = $beforeFileName;
            $fileNames[$afterFileKey] = $afterFileName;
        } else {
            // Jika file tidak ditemukan, kirim pesan error
            echo json_encode(array('status' => 'error', 'message' => 'File tidak lengkap.'));
            exit;
        }
    }

    // Gabungkan nama file untuk query
    $fileNamesStr = implode("', '", $fileNames);

    // Ambil data dari tabel setting_area dan settingdetails_area
    $queryArea = "SELECT settingarea_id, AREA FROM db_mobile_collection.setting_area WHERE AREA = 'LANTAI DUA'";
    $resultArea = $connectionServernew->query($queryArea);
    $areaData = $resultArea->fetch_assoc();

    $queryDetailsArea = "SELECT settingdetailsarea_id, area_id, details_area FROM db_mobile_collection.settingdetails_area WHERE area_id IN (SELECT settingarea_id FROM db_mobile_collection.setting_area WHERE AREA = 'LANTAI DUA')";
    $resultDetailsArea = $connectionServernew->query($queryDetailsArea);
    $detailsAreaData = $resultDetailsArea->fetch_assoc();

    // Ambil data dari tabel staff
    $queryStaff = "SELECT userid, nickname, staff_name, DESCRIPTION, device_name, fingerprint_data FROM db_mobile_collection.staff";
    $resultStaff = $connectionServernew->query($queryStaff);
    $staffData = $resultStaff->fetch_assoc();

    // Ambil data dari tabel tasks
    $queryTasks = "SELECT id, staff_id, area_id, detail_area_id, jobdesk_id, status_watch, job_name, photo_document, create_date, create_time FROM db_mobile_collection.tasks";
    $resultTasks = $connectionServernew->query($queryTasks);
    $tasksData = $resultTasks->fetch_assoc();

    // Ambil data dari tabel jobdesk
    $queryJobDesk = "SELECT jobs_id, time_start, time_ended FROM db_mobile_collection.jobdesk";
    $resultJobDesk = $connectionServernew->query($queryJobDesk);
    $jobDeskData = $resultJobDesk->fetch_assoc();

    // Contoh query penyimpanan ke dalam tabel penilaian_kinerja_office_boy_lantai_1
    $query = "INSERT INTO penilaian_kinerja_office_boy_lantai_2 (
        kinerjalantai2_id, staff_id, areatempat_id, areadetail_id, pekerjaan_id, waktu, jam, foto_before, foto_after, STATUS
    ) VALUES (
        '{$staffData['userid']}', '{$staffData['userid']}', '{$areaData['settingarea_id']}', '{$detailsAreaData['settingdetailsarea_id']}', '{$tasksData['id']}', 
        '{$barcodeResult}', '" . implode(", ", $selectedActions) . "', '$fileNamesStr', 
        '{$fileNames['before']}', '{$fileNames['after']}', '{$tasksData['status_watch']}'
    )";

    // Eksekusi query
    $result = $connectionServernew->query($query);

    // Jika berhasil, pindahkan file ke direktori yang diinginkan
    if ($result) {
        $targetDir = "/uploads/Lantai2/";

        foreach ($fileNames as $fileKey => $fileName) {
            move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetDir . $fileName);
        }

        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menyimpan data.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
}
?>
