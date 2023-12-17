<?php
// Include your database connection file
include 'koneksibaru.php';

// Fetch data from the tasks table
$query = "SELECT id, job_name, staff_name, area FROM tasks";
$result = $connectionServernew->query($query);

// Prepare data array
$data = array();
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

// Close the database connection
$connectionServernew->close();

// Output the data as JSON
header('Content-Type: application/json');
echo json_encode(array('data' => $data));
?>
