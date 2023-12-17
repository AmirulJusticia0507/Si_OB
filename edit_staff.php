<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $staffId = isset($_POST['userid']) ? $_POST['userid'] : null;
    $nik = $_POST['nik'];
    $staff_name = $_POST['staff_name'];
    $description = $_POST['description'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Pastikan $staffId tidak null atau kosong sebelum melanjutkan
    if ($staffId === null || $staffId === '') {
        echo json_encode(array('status' => 'error', 'message' => 'User ID is missing.'));
        exit();
    }

    // Jika password tidak kosong, update juga password dan salt
    if (!empty($password)) {
        $salt = bin2hex(random_bytes(22));
        $hashedPassword = password_hash($password . $salt, PASSWORD_BCRYPT);
        $query = "UPDATE db_mobile_collection.staff SET nik=?, staff_name=?, description=?, username=?, password=?, salt=? WHERE userid=?";
    } else {
        $query = "UPDATE db_mobile_collection.staff SET nik=?, staff_name=?, description=?, username=? WHERE userid=?";
    }

    $stmt = $connectionServernew->prepare($query);

    // Periksa apakah statement berhasil dipersiapkan
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    if (!empty($password)) {
        $stmt->bind_param("ssssssi", $nik, $staff_name, $description, $username, $hashedPassword, $salt, $staffId);
    } else {
        $stmt->bind_param("ssssi", $nik, $staff_name, $description, $username, $staffId);
    }

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
