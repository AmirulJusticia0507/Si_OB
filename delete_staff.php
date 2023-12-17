<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $employeeData = $_POST['userid'];

    // Gunakan prepared statement untuk mencegah SQL Injection
    $query = "DELETE FROM db_mobile_collection.staff WHERE userid = ?";
    $stmt = $connectionServernew->prepare($query);
    $stmt->bind_param("i", $employeeData); // Menggunakan "i" karena userid bertipe integer
    
    // Check for errors in prepare
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    // Jalankan prepared statement
    $stmt->execute();

    // Check for errors in execute
    if ($stmt->error) {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
        exit();
    }

    // Tutup prepared statement
    $stmt->close();

    echo json_encode(array('status' => 'success'));
    echo '<script>window.location.href = "allstaff.php?page=allstaff";</script>';
    exit();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
}
?>
