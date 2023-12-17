<?php
include 'koneksibaru.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $job_name = $_POST['job_name'];
    $area_id = $_POST['area'];  // Menggunakan ID Area
    $detail_area_id = $_POST['detail_area'];  // Menggunakan ID Detail Area
    $job_task = isset($_POST['job_schedule']) ? implode(',', $_POST['job_schedule']) : '';  // Menangani checkbox job_schedule
    $status_watch = isset($_POST['status_watch']) ? implode(',', $_POST['status_watch']) : '';

    // Generate a unique ID with a maximum of 10 characters
    $uniqueID = generateUniqueID(10);

    // Pastikan untuk menyesuaikan dengan struktur tabel dan field yang sesuai
    $query = "INSERT INTO db_mobile_collection.tasks (id, job_name, area_id, detail_area_id, jobdesk_id, status_watch) VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $connectionServernew->prepare($query);

    // Check for errors in prepare
    if (!$stmt) {
        echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
        exit();
    }

    $stmt->bind_param("ssssss", $uniqueID, $job_name, $area_id, $detail_area_id, $job_task, $status_watch);

    if ($stmt->execute()) {
        // Mendapatkan ID terakhir yang di-generate oleh AUTO_INCREMENT
        $lastInsertedID = $stmt->insert_id;

        // Ambil data jam kerja dari tabel jobdesk
        $queryJobDesk = "SELECT jobs_id, time_start, time_ended FROM db_mobile_collection.jobdesk WHERE jobs_id = ?";
        $stmtJobDesk = $connectionServernew->prepare($queryJobDesk);

        if (!$stmtJobDesk) {
            echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
            $stmt->close();
            $connectionServernew->close();
            exit();
        }

        $stmtJobDesk->bind_param("s", $job_task); // Menggunakan nilai job_task yang dipilih

        if ($stmtJobDesk->execute()) {
            $resultJobDesk = $stmtJobDesk->get_result();
            if ($rowJobDesk = $resultJobDesk->fetch_assoc()) {
                // Update kolom jobdesk_id pada data yang baru ditambahkan
                $queryUpdateJobDesk = "UPDATE db_mobile_collection.tasks SET jobdesk_id = ? WHERE id = ?";
                $stmtUpdateJobDesk = $connectionServernew->prepare($queryUpdateJobDesk);

                if (!$stmtUpdateJobDesk) {
                    echo json_encode(array('status' => 'error', 'message' => $connectionServernew->error));
                    $stmt->close();
                    $stmtJobDesk->close();
                    $connectionServernew->close();
                    exit();
                }

                $stmtUpdateJobDesk->bind_param("ii", $rowJobDesk['jobs_id'], $lastInsertedID);
                $stmtUpdateJobDesk->execute();
                $stmtUpdateJobDesk->close();
            }
        }

        // Menentukan zona waktu Asia/Jakarta
        date_default_timezone_set('Asia/Jakarta');

        // Mendapatkan tanggal dan waktu saat ini
        $currentDate = date('Y-m-d');
        $currentTime = date('H:i:s');

        // Update kolom create_date dan create_time pada data yang baru ditambahkan
        $queryUpdateDateTime = "UPDATE db_mobile_collection.tasks SET create_date = ?, create_time = ? WHERE id = ?";
        $stmtUpdateDateTime = $connectionServernew->prepare($queryUpdateDateTime);
        $stmtUpdateDateTime->bind_param("ssi", $currentDate, $currentTime, $lastInsertedID);
        $stmtUpdateDateTime->execute();

        // Menghitung waktu mulai dan selesai
        $startDateTime = strtotime($currentDate . ' ' . $rowJobDesk['time_start']);
        $endDateTime = strtotime($currentDate . ' ' . $rowJobDesk['time_ended']);
        $taskDateTime = strtotime($currentDate . ' ' . $currentTime);

        // Menentukan status (ontime atau overtime)
        $status = ($taskDateTime >= $startDateTime && $taskDateTime <= $endDateTime) ? 'ontime' : 'overtime';

        // Update kolom status_watch pada data yang baru ditambahkan
        $queryUpdateStatusWatch = "UPDATE db_mobile_collection.tasks SET status_watch = ? WHERE id = ?";
        $stmtUpdateStatusWatch = $connectionServernew->prepare($queryUpdateStatusWatch);
        $stmtUpdateStatusWatch->bind_param("si", $status, $lastInsertedID);
        $stmtUpdateStatusWatch->execute();

        echo json_encode(array('status' => 'success'));
        echo '<script>window.location.href = "alltaskdescription.php?page=alltaskdescription";</script>';
        exit();
    } else {
        echo json_encode(array('status' => 'error', 'message' => $stmt->error));
    }

    $stmt->close();
    $stmtJobDesk->close();
    $connectionServernew->close();
}

function generateUniqueID($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($characters);
    $uniqueID = '';

    for ($i = 0; $i < $length; $i++) {
        $uniqueID .= $characters[rand(0, $charLength - 1)];
    }

    return $uniqueID;
}
?>
