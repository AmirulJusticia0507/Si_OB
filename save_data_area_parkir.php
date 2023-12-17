<?php
include 'koneksibaru.php';

// Ambil data dari formulir
$barcodeResult = $_POST['barcodeResult'];
$selectedActions = $_POST['actions'];

// Proses penyimpanan data ke database
if (!empty($barcodeResult) && !empty($selectedActions)) {
    // Handle setiap tindakan yang dipilih
    foreach ($selectedActions as $action) {
        $beforeImage = $_FILES[$action . '_before'];
        $afterImage = $_FILES[$action . '_after'];

        // Tentukan lokasi penyimpanan file
        $uploadPath = 'uploads/area_parkir/';

        // Proses upload file "before"
        $beforeFileName = uploadFile($beforeImage, $uploadPath);

        // Proses upload file "after"
        $afterFileName = uploadFile($afterImage, $uploadPath);

        // Contoh query penyimpanan ke dalam tabel
        $query = "INSERT INTO penilaian_area_parkir (barcodeResult, tindakan, before_image, after_image) VALUES ('$barcodeResult', '$action', '$beforeFileName', '$afterFileName')";

        // Eksekusi query
        $result = $connectionServernew->query($query);

        if (!$result) {
            echo json_encode(array('status' => 'error', 'message' => 'Gagal menyimpan data.'));
            exit();
        }
    }

    echo json_encode(array('status' => 'success', 'message' => 'Data berhasil disimpan.'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Data tidak lengkap.'));
}

// Fungsi untuk menghandle upload file
function uploadFile($file, $uploadPath)
{
    $fileName = $file['name'];
    $fileTmpName = $file['tmp_name'];
    $fileSize = $file['size'];
    $fileError = $file['error'];

    // Tentukan ekstensi yang diizinkan
    $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif');

    // Dapatkan ekstensi file
    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Tentukan nama file baru untuk menghindari duplikasi
    $newFileName = uniqid('', true) . '.' . $fileExt;

    // Tentukan path lengkap untuk menyimpan file
    $uploadFilePath = $uploadPath . $newFileName;

    // Cek apakah ekstensi file diizinkan
    if (in_array($fileExt, $allowedExtensions)) {
        // Cek apakah tidak ada error saat upload
        if ($fileError === 0) {
            // Cek apakah ukuran file tidak melebihi batas yang ditentukan (misalnya, 5 MB)
            if ($fileSize < 5000000) {
                // Pindahkan file ke direktori yang ditentukan
                move_uploaded_file($fileTmpName, $uploadFilePath);
                return $newFileName;
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'Ukuran file terlalu besar.'));
                exit();
            }
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Terjadi error saat mengupload file.'));
            exit();
        }
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Ekstensi file tidak diizinkan.'));
        exit();
    }
}
?>
