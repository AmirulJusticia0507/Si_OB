<?php
include 'koneksibaru.php';
include 'phpqrcode/qrlib.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Check for the existence of task ID and staff ID
    if (isset($_GET['id'], $_GET['staff'])) {
        $taskId = $_GET['id'];
        $staffId = $_GET['staff']; // Retrieve staff information from the URL

        // Update the task with the staff information
        $queryUpdateStaff = "UPDATE db_mobile_collection.tasks SET staff_id = ? WHERE id = ?";
        $stmtUpdateStaff = $connectionServernew->prepare($queryUpdateStaff);

        // Check if prepare was successful
        if ($stmtUpdateStaff) {
            $stmtUpdateStaff->bind_param("si", $staffId, $taskId);

            if ($stmtUpdateStaff->execute()) {
                // Successfully updated the staff information
                // Create and display the QR code
                $qrCodeData = "ID: $taskId\nStaff: $staffId";
                QRcode::png($qrCodeData);
                exit;
            } else {
                // Handle error
                echo "Error updating staff information: " . $stmtUpdateStaff->error;
            }

            $stmtUpdateStaff->close();
        } else {
            // Handle prepare error
            echo "Error preparing statement: " . $connectionServernew->error;
        }
    } else {
        echo "Task ID and Staff ID are required.";
    }

    $connectionServernew->close();
}
?>
