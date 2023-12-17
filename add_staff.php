<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nik = $_POST['nik'];
    $staff_name = $_POST['staff_name'];
    $description = $_POST['description'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Generate salt
    $salt = bin2hex(random_bytes(22));

    // Hash the password using bcrypt
    $hashedPassword = password_hash($password . $salt, PASSWORD_BCRYPT);

    // Ambil tanggal dan waktu saat ini (format waktu Indonesia)
    date_default_timezone_set('Asia/Jakarta');
    $currentDateTime = date('Y-m-d H:i:s');

    // Query untuk insert data ke tabel staff
    $query = "INSERT INTO db_mobile_collection.staff (nik, staff_name, description, username, password, salt, created_at) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $connectionServernew->prepare($query);

    // Check for errors in prepare
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    $stmt->bind_param("sssssss", $nik, $staff_name, $description, $username, $hashedPassword, $salt, $currentDateTime);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success'));
        echo '<script>window.location.href = "allstaff.php?page=allstaff";</script>';
        exit();
    } else {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
    }

    $stmt->close();
    $connectionServernew->close();
}
?>
