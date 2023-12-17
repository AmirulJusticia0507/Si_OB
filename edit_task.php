<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $taskId = $_GET['id'];
    $jobName = $_POST['job_name'];
    $areaId = $_POST['area'];
    $detailAreaId = $_POST['detail_area'];
    
    // Menangani checkbox job_schedule (jam kerja yang dipilih)
    $jobSchedule = isset($_POST['job_schedule']) ? implode(',', $_POST['job_schedule']) : '';

    // Pastikan untuk menyesuaikan dengan struktur tabel dan field yang sesuai
    $query = "UPDATE db_mobile_collection.tasks 
              SET job_name = ?, area_id = ?, detail_area_id = ?, job_schedule = ?
              WHERE id = ?";
    $stmt = $connectionServernew->prepare($query);
    $stmt->bind_param("sssss", $jobName, $areaId, $detailAreaId, $jobSchedule, $taskId);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success'));
        echo '<script>window.location.href = "alltaskdescription.php?page=alltaskdescription";</script>';
        exit();
    } else {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
    }

    $stmt->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid request'));
}
?>
